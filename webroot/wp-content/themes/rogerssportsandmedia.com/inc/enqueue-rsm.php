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
		wp_enqueue_style( 'child-styles-1', get_stylesheet_directory_uri() . '/assets/style.css', array(), $css_version );

		if (!is_page_template('page_admanager-new.php')) {
			wp_enqueue_style( 'child-styles-2', get_stylesheet_directory_uri() . '/assets/home/main.min.css', array('parent-styles'), $css_version );
			if (!is_page_template('page_aboutus.php')) {
				wp_enqueue_style( 'child-styles-3', get_stylesheet_directory_uri() . '/assets/styles/reskin-alt.css', array('parent-styles'), $css_version );
			}
		}
		
		wp_enqueue_style( 'child-styles-4', get_stylesheet_directory_uri() . '/assets/ad-manager-new/main-alt.css', array('parent-styles'), $css_version );
		wp_enqueue_style( 'child-styles-5', get_stylesheet_directory_uri() . '/assets/styles/custom.css', array('parent-styles'), $css_version );

		if ( is_page_template('page_upfront_2025.php') ) {
			wp_enqueue_style( 'upfront-2025', get_stylesheet_directory_uri() . '/assets/upfront-2025.css', array('parent-styles'), '1.0.3' );
		}
		
		$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . '/assets/rsm.min.js' );
		wp_enqueue_script( 'child-scripts', get_stylesheet_directory_uri() . '/assets/rsm.min.js', array(), $js_version, true );
		if ( is_page() && (
			is_page_template( 'page_upfront.php' ) ||
			is_page_template( 'page_tubi.php' )
		)) {
			wp_enqueue_script( 'programslider-js', get_stylesheet_directory_uri() . "/assets/home/scripts/programslider.js", array(), $js_version, true );
		}

		if (
			is_page_template( 'page_hgtv.php' ) ||
			is_page_template( 'page_tv.php' ) ||
			is_page_template( 'page_upfront_2025.php' )
		) {
			wp_enqueue_script( 'showsslider-js', get_stylesheet_directory_uri() . "/assets/home/scripts/showsslider.js", array(), '1.0.2', true );
		}

		if (
			is_page_template( 'page_2025-mlb-world-series.php' )
		) {
			wp_enqueue_script( 'presentationslider-js', get_stylesheet_directory_uri() . "/assets/home/scripts/presentationslider.js", array(), '1.0.0', true );
		}
	}
} // endif function_exists( 'load_rsm_stylesheet' ).

add_action( 'wp_enqueue_scripts', 'load_rsm_stylesheet' );
