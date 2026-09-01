<?php
/**
 * R.E.D.i Planner admin page (Settings > R.E.D.i Planner).
 *
 * Just the destination mailbox for now, so it can be pointed at a test
 * inbox per environment without a deploy. More planner settings will land
 * here as the tool grows.
 *
 * @package rdm-rsm-parent
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_menu', function () {
	add_options_page(
		'R.E.D.i Planner',
		'R.E.D.i Planner',
		'manage_options',
		'redi-planner',
		'redi_planner_render_admin_page'
	);
} );

function redi_planner_handle_admin_save() {
	if ( ! isset( $_POST['redi_admin_save'] ) ) {
		return false;
	}
	check_admin_referer( 'redi_planner_admin' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Insufficient permissions.' );
	}

	update_option( 'redi_planner_dest_email', sanitize_email( trim( $_POST['dest_email'] ?? '' ) ) );
	return true;
}

/**
 * Sends a sample submission email to the configured address, same subject
 * and body format as a real form submission. Returns a notice to display,
 * or null when the button wasn't clicked.
 */
function redi_planner_handle_admin_test() {
	if ( ! isset( $_POST['redi_admin_send_test'] ) ) {
		return null;
	}
	check_admin_referer( 'redi_planner_admin_test' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Insufficient permissions.' );
	}

	$to = sanitize_email( get_option( 'redi_planner_dest_email' ) );
	if ( empty( $to ) ) {
		return array( 'ok' => false, 'text' => 'Set and save a submission email first.' );
	}

	$payload = redi_planner_sample_payload();
	$sent    = wp_mail(
		$to,
		'R.E.D.i Planner Submission — ' . $payload['requestId'],
		redi_planner_email_body( $payload ),
		array( 'Content-Type: text/plain; charset=UTF-8' )
	);

	if ( ! $sent ) {
		return array( 'ok' => false, 'text' => 'The test email could not be sent. Check the PHP error log.' );
	}
	return array( 'ok' => true, 'text' => sprintf( 'Test email sent to %s (%s).', $to, $payload['requestId'] ) );
}

function redi_planner_render_admin_page() {
	$saved  = redi_planner_handle_admin_save();
	$tested = redi_planner_handle_admin_test();
	?>
	<div class="wrap">
		<h1>R.E.D.i Planner</h1>
		<?php if ( $saved ) : ?>
			<div class="notice notice-success is-dismissible"><p>Settings saved.</p></div>
		<?php endif; ?>
		<?php if ( $tested ) : ?>
			<div class="notice notice-<?php echo $tested['ok'] ? 'success' : 'error'; ?> is-dismissible"><p><?php echo esc_html( $tested['text'] ); ?></p></div>
		<?php endif; ?>
		<p>Settings for the campaign planner form on <code>/redi-planner/</code>.</p>

		<form method="post">
			<?php wp_nonce_field( 'redi_planner_admin' ); ?>
			<input type="hidden" name="redi_admin_save" value="1" />

			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="dest_email">Submission email</label></th>
					<td>
						<input type="email" class="regular-text" id="dest_email" name="dest_email"
							value="<?php echo esc_attr( get_option( 'redi_planner_dest_email', '' ) ); ?>"
							placeholder="name@rci.rogers.com" />
						<p class="description">Where form submissions are emailed. Required. The form rejects submissions until this is set.</p>
					</td>
				</tr>
			</table>

			<?php submit_button( 'Save Settings' ); ?>
		</form>

		<h2>Test email</h2>
		<p>Sends a sample submission (marked TEST, same format as a real one) to the saved address above. Handy for checking delivery and setting up the receiving automation without filling in the form.</p>
		<form method="post">
			<?php wp_nonce_field( 'redi_planner_admin_test' ); ?>
			<input type="hidden" name="redi_admin_send_test" value="1" />
			<?php submit_button( 'Send Test Email', 'secondary' ); ?>
		</form>
	</div>
	<?php
}
