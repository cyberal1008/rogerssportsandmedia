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

	register_setting( 'config-vars-page', 'journey_builder_client_id' );
	register_setting( 'config-vars-page', 'journey_builder_client_secret' );
	register_setting( 'config-vars-page', 'journey_builder_account_id' );
	register_setting( 'config-vars-page', 'journey_builder_event_definition_key' );
}

function journey_builder_settings_section_callback_function() {
    echo '<p>Configuration information for journey builder related settings</p>';
}

function config_textbox_callback($args) {
	$option = get_option($args[0]);
	echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}