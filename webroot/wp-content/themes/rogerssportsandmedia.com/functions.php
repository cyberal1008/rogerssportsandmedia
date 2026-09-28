<?php
/**
 * Loads RSM template scripts & functions.
 *
 * @package rogerssportsandmedia.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$parent_includes = array(
	'/enqueue-rsm.php',                         // Enqueue scripts and styles for rogerssportsandmedia.com.
	'/seo-hidden-h1.php',                       // Screen-reader-only H1s for pages missing one (SEO audit P2-06).
	'/seo-archive-visibility.php',              // Withdraw accidental archive URLs flagged by the SEO audit.
	'/seo-redirects.php',                       // Retire pages flagged for removal by the SEO audit (301s).
);

foreach ( $parent_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

function config_vars_menu() {
	add_submenu_page(
		'options-general.php',
		'Credentials',
		'RSM Config',
		'manage_options',
		'config-vars-page',
		'config_vars_page_contents'
	);
}
add_action( 'admin_menu', 'config_vars_menu' );

function config_vars_page_contents() {
    ?>
    <h1> <?php esc_html_e( 'RSM Config', 'my-plugin-textdomain' ); ?> </h1>
    <form method="POST" action="options.php">
    <?php
		settings_fields( 'config-vars-page' );
		do_settings_sections( 'config-vars-page' );
		submit_button();
    ?>
    </form>
    <?php
}
add_action( 'admin_init', 'config_vars_page_init' );

function config_vars_page_init() {
    add_settings_section(
        'journey_builder_settings_section',
        'Journey Builder Settings',
        'journey_builder_settings_section_callback_function',
        'config-vars-page'
    );

	add_settings_field(
		'journey_builder_client_id',
		'JOURNEY_BUILDER_CLIENT_ID',
		'config_textbox_callback',
		'config-vars-page',
		'journey_builder_settings_section',
		array ('journey_builder_client_id')
	);

	add_settings_field(
		'journey_builder_client_secret',
		'JOURNEY_BUILDER_CLIENT_SECRET',
		'config_textbox_callback',
		'config-vars-page',
		'journey_builder_settings_section',
		array('journey_builder_client_secret')
	);

	add_settings_field(
		'journey_builder_account_id',
		'JOURNEY_BUILDER_ACCOUNT_ID',
		'config_textbox_callback',
		'config-vars-page',
		'journey_builder_settings_section',
		array('journey_builder_account_id')
	);

	add_settings_field(
		'journey_builder_event_definition_key',
		'JOURNEY_BUILDER_EVENT_DEFINITION_KEY',
		'config_textbox_callback',
		'config-vars-page',
		'journey_builder_settings_section',
		array('journey_builder_event_definition_key')
	);

	add_settings_field(
		'disney_launch_event_definition_key',
		'DISNEY_LAUNCH_EVENT_DEFINITION_KEY',
		'config_textbox_callback',
		'config-vars-page',
		'journey_builder_settings_section',
		array('disney_launch_event_definition_key')
	);

	add_settings_field(
		'ad_manager_event_definition_key',
		'AD_MANAGER_EVENT_DEFINITION_KEY',
		'config_textbox_callback',
		'config-vars-page',
		'journey_builder_settings_section',
		array('ad_manager_event_definition_key')
	);

	register_setting( 'config-vars-page', 'journey_builder_client_id' );
	register_setting( 'config-vars-page', 'journey_builder_client_secret' );
	register_setting( 'config-vars-page', 'journey_builder_account_id' );
	register_setting( 'config-vars-page', 'disney_launch_event_definition_key' );
	register_setting( 'config-vars-page', 'ad_manager_event_definition_key' );
}

function journey_builder_settings_section_callback_function() {
    echo '<p>Configuration information for journey builder related settings</p>';
}

function config_textbox_callback($args) {
	$option = get_option($args[0]);
	echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}

/**
 * Add the `audio-landing` body class on the Audio template so its
 * wrapper overrides in assets/audio-landing/main.min.css still apply
 * (the class previously lived on <html> in the template's own <head>).
 */
add_filter( 'body_class', function ( $classes ) {
	if ( is_page_template( 'page_audio.php' ) ) {
		$classes[] = 'audio-landing';
	}
	return $classes;
} );

add_filter('rest_authentication_errors', function($result) {
    // If a previous authentication check was applied,
    // pass that result along without modification.
    if (true === $result || is_wp_error( $result )) {
        return $result;
    }

    // No authentication has been performed yet.
    // Return an error if user is not logged in.
    if (!is_user_logged_in()) {
        return new WP_Error(
            'rest_not_logged_in',
            __('You are not currently logged in.'),
            array('status' => 401)
        );
    }

    // Our custom authentication check should have no effect
    // on logged-in requests
    return $result;
});