<?php
/**
 * R.E.D.i Planner REST submission route.
 *
 * Handles POST /wp-json/redi/v1/submit. The browser posts the form here and
 * we forward the submission by email to the R.E.D.i mailbox, where a Power
 * Automate rule picks it up and writes it to SharePoint. The servers relay
 * mail through local Postfix (which also rewrites the From address to
 * no-reply@infra.rogersdigitalmedia.com), so wp_mail() is all we need.
 * Submissions only pass through this server, nothing is stored.
 *
 * Heads up: /wp-json/* must stay excluded from the Akamai redirect rules,
 * otherwise POSTs here lose their bodies on the trailing-slash redirect.
 *
 * @package rdm-rsm-parent
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/class-redi-planner-validator.php';
require_once __DIR__ . '/admin.php';

const REDI_PLANNER_NONCE_ACTION  = 'redi_planner_submit';
const REDI_PLANNER_RATE_LIMIT    = 5;      // max submissions per window, per IP.
const REDI_PLANNER_RATE_WINDOW   = 600;    // window length in seconds.

/**
 * Field options shared by the form template and the validator.
 */
function redi_planner_get_config() {
	return require __DIR__ . '/config.php';
}

add_action( 'rest_api_init', function () {
	register_rest_route( 'redi/v1', '/submit', array(
		'methods'             => 'POST',
		'callback'            => 'redi_planner_handle_submit',
		// Public form. The nonce check happens inside the handler instead,
		// so we control the error shape the form receives.
		'permission_callback' => '__return_true',
	) );
} );

function redi_planner_handle_submit( WP_REST_Request $request ) {
	$body = $request->get_json_params();
	if ( ! is_array( $body ) ) {
		return new WP_REST_Response( array( 'success' => false, 'message' => 'Invalid request.' ), 400 );
	}

	// The nonce is printed into the form page via wp_create_nonce().
	// It works for anonymous visitors, and Akamai's 10 minute page cache
	// is well inside the nonce lifetime.
	if ( ! wp_verify_nonce( $request->get_header( 'X-Redi-Nonce' ), REDI_PLANNER_NONCE_ACTION ) ) {
		return new WP_REST_Response( array( 'success' => false, 'message' => 'Session expired. Please reload the page.' ), 403 );
	}

	// Honeypot check. The hidden "website" field is one humans never fill in.
	// Reply with a success shape so bots don't learn they were caught, and
	// forward nothing.
	if ( ! empty( $body['website'] ) ) {
		return new WP_REST_Response( array( 'success' => true, 'requestId' => redi_planner_request_id() ), 200 );
	}

	if ( ! redi_planner_rate_limit_ok() ) {
		return new WP_REST_Response( array( 'success' => false, 'message' => 'Too many submissions. Please try again in a few minutes.' ), 429 );
	}

	$validator = new Redi_Planner_Validator( redi_planner_get_config() );
	$result    = $validator->validate( $body );

	if ( ! $result['valid'] ) {
		return new WP_REST_Response( array( 'success' => false, 'errors' => $result['errors'] ), 400 );
	}

	$payload                = $result['data'];
	$payload['requestId']   = redi_planner_request_id();
	$payload['requestDate'] = gmdate( 'c' );

	// Instant-only submissions never leave the site. The form doesn't call
	// this route for them, but enforce it here as well just in case.
	if ( ! $payload['requestDetailedPlan'] ) {
		return new WP_REST_Response( array( 'success' => true, 'requestId' => $payload['requestId'], 'forwarded' => false ), 200 );
	}

	// Where submissions go, set at Settings > R.E.D.i Planner. Refuse the
	// submission when it's not configured so nothing silently disappears.
	$to = sanitize_email( get_option( 'redi_planner_dest_email' ) );
	if ( empty( $to ) ) {
		error_log( 'REDI-PLANNER: no destination email configured, rejected submission ' . $payload['requestId'] );
		return new WP_REST_Response( array( 'success' => false, 'message' => 'This form is not accepting submissions yet. Please try again later.' ), 503 );
	}

	// The body is plain text. Labeled lines up top for anyone reading it,
	// then the JSON payload between markers so the Power Automate flow can
	// parse that instead of the prose. Postfix rewrites the From header to
	// no-reply@infra.rogersdigitalmedia.com no matter what we set here, and
	// the receiving mail rule keys on that address plus the subject.
	$sent = wp_mail(
		$to,
		'R.E.D.i Planner Submission — ' . $payload['requestId'],
		redi_planner_email_body( $payload ),
		array( 'Content-Type: text/plain; charset=UTF-8' )
	);

	// A duplicate submission is better than a lost one, so let the user retry.
	if ( ! $sent ) {
		error_log( 'REDI-PLANNER mail send failed (' . $payload['requestId'] . ') to ' . $to );
		return new WP_REST_Response( array( 'success' => false, 'message' => 'We couldn\'t submit your plan request. Please try again.' ), 502 );
	}

	return new WP_REST_Response( array( 'success' => true, 'requestId' => $payload['requestId'], 'forwarded' => true ), 200 );
}

/**
 * Builds a representative payload for the admin "send test email" button,
 * so the receiving side can set up its parsing without a real form
 * submission. Values come from the live config so the sample always matches
 * what the form can actually submit.
 */
function redi_planner_sample_payload() {
	$config = redi_planner_get_config();
	return array(
		'campaignName'        => 'TEST submission from the admin page',
		'campaignMarket'      => in_array( 'Ontario', $config['markets'], true ) ? 'Ontario' : $config['markets'][0],
		'mediaContent'        => $config['media_content'][0],
		'advertiserCategory'  => $config['categories'][0],
		'campaignBudget'      => (float) max( 25000, $config['budget_min'] ),
		'campaignPlatforms'   => array_slice( $config['platforms'], 0, 2 ),
		'startDate'           => gmdate( 'Y-m-d', strtotime( '+30 days' ) ),
		'durationWeeks'       => (int) $config['durations'][0],
		'requestDetailedPlan' => true,
		'emailAddress'        => 'test.requester@example.com',
		'requestId'           => 'REDI-TEST-' . strtoupper( bin2hex( random_bytes( 4 ) ) ),
		'requestDate'         => gmdate( 'c' ),
	);
}

/**
 * Maps the internal payload to the field names the receiving Power Automate
 * flow expects in the JSON block (its contract, confirmed 2026-08-28).
 */
function redi_planner_export_payload( array $payload ) {
	return array(
		'RequestID'           => $payload['requestId'],
		'RequestDate'         => $payload['requestDate'],
		'CampaignName'        => $payload['campaignName'],
		'CampaignMarket'      => $payload['campaignMarket'],
		'CampaignBudget'      => $payload['campaignBudget'],
		'CampaignPlatforms'   => $payload['campaignPlatforms'],
		'MediaContent'        => $payload['mediaContent'],
		'StartDate'           => $payload['startDate'],
		'CampaignDuration'    => $payload['durationWeeks'],
		'AdvertiserCategory'  => $payload['advertiserCategory'],
		'RequestDetailedPlan' => $payload['requestDetailedPlan'],
		'EmailAddress'        => $payload['emailAddress'],
	);
}

/**
 * Builds the plain text email body for a detailed plan submission.
 */
function redi_planner_email_body( array $payload ) {
	$lines = array(
		'R.E.D.i Planner — detailed plan request',
		'',
		'Request ID:      ' . $payload['requestId'],
		'Request Date:    ' . $payload['requestDate'],
		'Campaign Name:   ' . $payload['campaignName'],
		'Market:          ' . $payload['campaignMarket'],
		'Budget:          ' . $payload['campaignBudget'],
		'Platforms:       ' . implode( ', ', $payload['campaignPlatforms'] ),
		'Media Content:   ' . $payload['mediaContent'],
		'Start Date:      ' . $payload['startDate'],
		'Duration (wks):  ' . $payload['durationWeeks'],
		'Category:        ' . $payload['advertiserCategory'],
		'Email Address:   ' . ( $payload['emailAddress'] ?? '' ),
		'',
		'--- PAYLOAD JSON START ---',
		wp_json_encode( redi_planner_export_payload( $payload ) ),
		'--- PAYLOAD JSON END ---',
	);
	return implode( "\r\n", $lines );
}

function redi_planner_request_id() {
	return 'REDI-' . strtoupper( bin2hex( random_bytes( 8 ) ) );
}

/**
 * Sliding window counter per client IP, kept in a transient.
 * True-Client-IP is what Akamai passes through in production, and
 * REMOTE_ADDR covers local and staging. It can be spoofed when not behind
 * Akamai, which is fine for what this protects.
 */
function redi_planner_rate_limit_ok() {
	$ip    = $_SERVER['HTTP_TRUE_CLIENT_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';
	$key   = 'redi_rl_' . md5( $ip );
	$count = (int) get_transient( $key );

	if ( $count >= REDI_PLANNER_RATE_LIMIT ) {
		return false;
	}
	set_transient( $key, $count + 1, REDI_PLANNER_RATE_WINDOW );
	return true;
}
