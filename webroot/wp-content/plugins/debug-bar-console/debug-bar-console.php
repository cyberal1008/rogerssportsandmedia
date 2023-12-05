<?php
/*
 Plugin Name: Debug Bar Console
 Description: Adds a PHP/SQL console to the debug bar. Requires the debug bar plugin. Requires a `Super Admin / Administrator` role
 Author: koopersmith/Jonathan Bouganim/Arjoon Nagarajah
 Version: 1.0
 Author URI: http://darylkoop.com/
 */

add_filter('debug_bar_panels', 'debug_bar_console_panel');
function debug_bar_console_panel( $panels ) {
	require_once 'class-debug-bar-console.php';
	// Debug_Bar_Console::flush_init();
	
	// if we are a developer so all the roles
	if ( ! is_debug_bar_console_allowed() ) { return $panels; }


	$panels[] = new Debug_Bar_Console();
	return $panels;
}

add_action('debug_bar_enqueue_scripts', 'debug_bar_console_scripts');
function debug_bar_console_scripts() {
	if ( ! is_debug_bar_console_allowed() )
		return;

	$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '.dev' : '';

	// Codemirror
	wp_enqueue_style( 'debug-bar-codemirror', plugins_url( "codemirror/lib/codemirror.css", __FILE__ ), array(), '2.22' );
	wp_enqueue_script( 'debug-bar-codemirror', plugins_url( "codemirror/debug-bar-codemirror.js", __FILE__ ), array(), '2.22' );

	wp_enqueue_style( 'debug-bar-console', plugins_url( "css/debug-bar-console$suffix.css", __FILE__ ), array( 'debug-bar', 'debug-bar-codemirror' ), '20120317' );
	wp_enqueue_script( 'debug-bar-console', plugins_url( "js/debug-bar-console$suffix.js", __FILE__ ), array( 'debug-bar', 'debug-bar-codemirror' ), '20120317' );

}

function is_debug_bar_console_allowed() {
	$current_user = wp_get_current_user();
	return array_key_exists('delete_users', $current_user->allcaps);
}
