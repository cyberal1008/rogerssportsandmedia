<?php
/**
 * Rogers Sports and Media's functions and definitions
 *
 * @package rogerssportsandmedia.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'load_rsm_stylesheet' ) ) {
	/**
	 * Load theme's CSS & script sources.
	 */
	function load_rsm_stylesheet() {

		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$css_version    = $theme_version . '.' . filemtime( get_template_directory() . '/style.css' );
		$parent_connect = 'parent-connect'; // This is 'rdm-rsm-parent-style'.

		wp_enqueue_style( $parent_connect, get_template_directory_uri() . '/style.css', array(), $css_version );
		wp_enqueue_style( 'child-connect', get_stylesheet_directory_uri() . '/style.css', array(), $css_version );
		wp_enqueue_style( 'child-styles', get_stylesheet_directory_uri() . '/assets/style.css', array(), $css_version );

		$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . '/assets/rsm.min.js' );
		wp_enqueue_script( 'child-scripts', get_stylesheet_directory_uri() . '/assets/rsm.min.js', array(), $js_version, true );
	}
} // endif function_exists( 'load_rsm_stylesheet' ).

add_action( 'wp_enqueue_scripts', 'load_rsm_stylesheet' );
