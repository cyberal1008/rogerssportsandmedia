<?php
/**
 * Technical SEO: hidden H1 headings.
 *
 * Adds a screen-reader-only <h1> to pages that ship without one, per the
 * "P2-06 Missing H1" tab of the RSM Technical SEO Audit checklist. The heading
 * is present in the markup for crawlers and assistive tech but is not visible
 * in the rendered layout, so page designs are unchanged.
 *
 * The heading is injected into the finished document, and only when the page
 * contains no <h1> of its own, so a template that later starts rendering a real
 * heading can never end up with two. Buffering is started only on the handful
 * of mapped URLs, so every other request is untouched.
 *
 * The copy is intentionally hardcoded rather than exposed as a CMS field: these
 * are one-off SEO corrections that are not expected to change. To amend a
 * heading, edit rsm_seo_hidden_h1_map() below or hook the
 * 'rsm_seo_hidden_h1_map' filter.
 *
 * @package rogerssportsandmedia.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Map of site-relative request paths to their H1 copy.
 *
 * Keys are lowercase, leading- and trailing-slashed paths.
 *
 * @return array<string, string>
 */
function rsm_seo_hidden_h1_map() {
	$map = array(
		'/'                                          => 'Rogers Sports & Media',
		'/2025-blue-jays-season-wrap/'               => '2025 Toronto Blue Jays Wrap-Up - Rogers Sports & Media',
		'/2025-mlbpostseason/'                       => '2025 MLB Postseason - Rogers Sports & Media',
		'/2025-stanley-cup-playoffs-wrap/'           => '2025 Stanley Cup Playoffs: Season Wrap - Rogers Sports & Media',
		'/about-us/'                                 => 'About Us - Rogers Sports & Media',
		'/ad-solutions/'                             => 'Advertising Solutions - Rogers Sports & Media',
		'/bravo/'                                    => 'Bravo - Rogers Sports & Media',
		'/citynews/'                                 => 'CityNews - Rogers Sports & Media',
		'/citytv/'                                   => 'Citytv - Rogers Sports & Media',
		'/citytvplus/'                               => 'Citytv+ - Rogers Sports & Media',
		'/contact-us/'                               => 'Contact Us - Rogers Sports & Media',
		'/discovery-2/'                              => 'discovery+ - Rogers Sports & Media',
		'/discovery/'                                => 'Discovery Now Available In Canada - Rogers Sports & Media',
		'/disney-plus/'                              => 'Disney+ Rogers Sports & Media',
		'/entertainment/'                            => 'Entertainment - Rogers Sports & Media',
		'/food-network/'                             => 'Food Network - Rogers Sports & Media',
		'/fsa/'                                      => 'FullStream Ahead - Rogers Sports & Media',
		'/fx/'                                       => 'FX - Rogers Sports & Media',
		'/hgtv/'                                     => 'HGTV - Rogers Sports & Media',
		'/id/'                                       => 'ID - Rogers Sports & Media',
		'/join-our-team/'                            => 'Join Our Team - Rogers Sports & Media',
		'/kiss917/'                                  => 'KiSS 917 - Rogers Sports & Media',
		'/magnolia/'                                 => 'Magnolia - Rogers Sports & Media',
		'/news-policy/'                              => 'News Policy - Rogers Sports & Media',
		'/omni/'                                     => 'OMNI - Rogers Sports & Media',
		'/out-of-home/'                              => 'Out-of-Home Advertising - Rogers Sports & Media',
		'/podcasts/'                                 => 'Podcasts - Rogers Sports & Media',
		'/privacy-policy-fr/'                        => 'Politique en matière de vie privée - Rogers Sports & Media',
		'/radio/'                                    => 'Radio Stations and Audio Streaming - Rogers Sports & Media',
		'/rogers-advertising-policy/'                => 'Rogers Advertising Policy - Rogers Sports & Media',
		'/rsm-radio-creative-production-guidelines/'  => 'Radio Creative & Production Guidelines - Rogers Sports & Media',
		'/sitemap/'                                  => 'SITEMAP - Rogers Sports & Media',
		'/sports/'                                   => 'Sports - Rogers Sports & Media',
		'/sportsnet-plus/'                           => 'Sportsnet+ - Rogers Sports & Media',
		'/standard-sales-terms-and-conditions/'      => 'Standard Sales Terms and Conditions - Rogers Sports & Media',
		'/terms-conditions/'                         => 'ROGERS SPORTS & MEDIA TERMS AND CONDITIONS OF USE',
		'/terms-of-service/'                         => 'Terms & Conditions - Rogers Sports & Media',
		'/terms/'                                    => 'Terms - Rogers Sports & Media',
		'/the-latest/'                               => 'The Latest Archives - Rogers Sports & Media',
		'/the-latest/events/'                        => 'Events Archives - Rogers Sports & Media',
		'/the-latest/news/'                          => 'Latest News - Rogers Sports & Media',
		'/tubi/'                                     => 'Tubi - Rogers Sports & Media',
		'/upfront-26/'                               => 'Upfront 26 - Rogers Sports & Media',
		'/upfront-2023/'                             => 'UPFRONT 2023 - Rogers Sports & Media',
		'/what-we-do/creative-solutions/'            => 'Creative Solutions - Rogers Sports & Media',
		'/who-we-are-2/'                             => 'Who We Are - Rogers Sports & Media',
	);

	/**
	 * Filters the hidden H1 lookup table.
	 *
	 * @param array<string, string> $map Path => heading text.
	 */
	return apply_filters( 'rsm_seo_hidden_h1_map', $map );
}

/**
 * Returns the site-relative, normalised path for the current request.
 *
 * @return string Path with leading and trailing slashes, e.g. "/radio/".
 */
function rsm_seo_current_request_path() {
	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/'; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitised
	$path        = wp_parse_url( $request_uri, PHP_URL_PATH );

	if ( ! is_string( $path ) || '' === $path ) {
		$path = '/';
	}

	// Strip the install sub-directory when WordPress is not at the domain root.
	$home_path = wp_parse_url( home_url( '/' ), PHP_URL_PATH );
	if ( is_string( $home_path ) && '/' !== $home_path && 0 === strpos( $path, $home_path ) ) {
		$path = substr( $path, strlen( $home_path ) - 1 );
	}

	$path = strtolower( rawurldecode( $path ) );
	$path = '/' . trim( $path, '/' );

	return '/' === $path ? '/' : $path . '/';
}

/**
 * Returns the hidden H1 text for the current request, if one is configured.
 *
 * @return string Heading text, or an empty string when not applicable.
 */
function rsm_seo_hidden_h1_text() {
	if ( is_admin() || is_feed() || is_embed() || is_404() || is_paged() ) {
		return '';
	}

	if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return '';
	}

	$map  = rsm_seo_hidden_h1_map();
	$path = rsm_seo_current_request_path();

	return isset( $map[ $path ] ) ? $map[ $path ] : '';
}

/**
 * Prints the clipping styles for the hidden H1, only on pages that render one.
 */
function rsm_seo_hidden_h1_styles() {
	if ( '' === rsm_seo_hidden_h1_text() ) {
		return;
	}

	echo '<style id="rsm-seo-hidden-h1-css">.rsm-seo-hidden-h1{position:absolute!important;width:1px;height:1px;margin:-1px;padding:0;overflow:hidden;clip:rect(0,0,0,0);clip-path:inset(50%);white-space:nowrap;border:0;}</style>';
}
add_action( 'wp_head', 'rsm_seo_hidden_h1_styles', 5 );

/**
 * Injects the hidden H1 into the rendered markup when the page has none.
 *
 * Running on the finished document (rather than printing at wp_body_open)
 * guarantees we never create a second H1 if a template later starts rendering
 * a real one, and it works for templates that do not call wp_body_open().
 *
 * @param string $html Buffered page markup.
 * @return string Markup, with the hidden H1 injected when appropriate.
 */
function rsm_seo_inject_hidden_h1( $html ) {
	$text = rsm_seo_hidden_h1_text();

	if ( '' === $text || ! is_string( $html ) || '' === $html ) {
		return $html;
	}

	// Leave the document untouched when it already exposes a heading.
	if ( preg_match( '/<h1[\s>\/]/i', $html ) ) {
		return $html;
	}

	if ( ! preg_match( '/<body\b[^>]*>/i', $html, $match, PREG_OFFSET_CAPTURE ) ) {
		return $html;
	}

	$heading  = sprintf( '<h1 class="rsm-seo-hidden-h1">%s</h1>', esc_html( $text ) );
	$position = $match[0][1] + strlen( $match[0][0] );

	return substr( $html, 0, $position ) . $heading . substr( $html, $position );
}

/**
 * Starts buffering the response on the small set of pages that need a hidden H1.
 */
function rsm_seo_buffer_hidden_h1() {
	if ( '' === rsm_seo_hidden_h1_text() ) {
		return;
	}

	ob_start( 'rsm_seo_inject_hidden_h1' );
}
add_action( 'template_redirect', 'rsm_seo_buffer_hidden_h1', 0 );
