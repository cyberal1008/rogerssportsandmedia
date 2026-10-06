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
			$main_css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . '/assets/home/main.min.css' );
			wp_enqueue_style( 'child-styles-2', get_stylesheet_directory_uri() . '/assets/home/main.min.css', array('parent-styles'), $main_css_version );
			if (!is_page_template('page_aboutus.php') && !is_page_template( 'page_admanager_v3.php' )) {
				wp_enqueue_style( 'child-styles-3', get_stylesheet_directory_uri() . '/assets/styles/reskin-alt.css', array('parent-styles'), $css_version );
			}
		}
		
		wp_enqueue_style( 'child-styles-4', get_stylesheet_directory_uri() . '/assets/ad-manager-new/main-alt.css', array('parent-styles'), $css_version );
		wp_enqueue_style( 'child-styles-5', get_stylesheet_directory_uri() . '/assets/styles/custom.css', array('parent-styles'), '1.0.21' );

		if ( is_page_template( array( 'page_audio.php', 'page_podcasts.php', 'page_tsc.php' ) ) ) {
			wp_enqueue_style( 'audio-landing', get_stylesheet_directory_uri() . '/assets/audio-landing/main.min.css', array('parent-styles'), $css_version );
		}

		if ( is_page_template( array( 'page_advanced-solutions.php', 'page_whatwedo.php' ) ) ) {
			wp_enqueue_style( 'reskin', get_stylesheet_directory_uri() . '/assets/styles/reskin.css', array('parent-styles'), $css_version );
		}

		if ( is_page_template('page_upfront_2025.php') ) {
			wp_enqueue_style( 'upfront-2025', get_stylesheet_directory_uri() . '/assets/upfront-2025.css', array('parent-styles'), '1.0.3' );
		}
		
		$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . '/assets/rsm.min.js' );
		wp_enqueue_script( 'child-scripts', get_stylesheet_directory_uri() . '/assets/rsm.min.js', array(), $js_version, true );
		if ( is_page() && (
			is_page_template( 'page_upfront.php' ) ||
			is_page_template( 'page_tubi.php' )
		)) {
			wp_enqueue_script( 'programslider-js', get_stylesheet_directory_uri() . "/assets/home/scripts/programslider.js", array(), '1.0.4', true );
		}

		if (
			is_page_template( 'page_hgtv.php' ) ||
			is_page_template( 'page_tv.php' ) ||
			is_page_template( 'page_upfront_2025.php' ) ||
			is_page_template( 'page_flexible.php' )
		) {
			wp_enqueue_script( 'showsslider-js', get_stylesheet_directory_uri() . "/assets/home/scripts/showsslider.js", array(), '1.0.6', true );
		}

		if (
			is_page_template( 'page_admanager_v3.php' )
		) {
			wp_enqueue_script( 'ad-manager-v3-js', get_stylesheet_directory_uri() . "/assets/ad-manager-v3/ad-manager-v3.js", array(), '1.0.0', true );
		}

		if (
			is_page_template( 'page_2025-mlb-world-series.php' ) ||
			is_page_template( 'page_banner-preso-video.php' )
		) {
			wp_enqueue_script( 'presentationslider-js', get_stylesheet_directory_uri() . "/assets/home/scripts/presentationslider.js", array(), '1.0.0', true );
		}
	}
} // endif function_exists( 'load_rsm_stylesheet' ).

if ( ! function_exists( 'reorder_rsm_stylesheet_deps' ) ) {
	function reorder_rsm_stylesheet_deps() {
		if ( empty( $GLOBALS['template'] ) ) {
			return;
		}

		$template = basename( $GLOBALS['template'] );

		$late_handles_map = array(
			'single.php'                      => array( 'child-styles-2', 'child-styles-3' ),
			'category-the-latest.php'         => array( 'child-styles-2', 'child-styles-3' ),
			'category-whats-happening.php'    => array( 'child-styles-2', 'child-styles-3' ),
			'page_whoweare.php'               => array( 'child-styles-2', 'child-styles-3' ),
			'page_creative-solutions.php'     => array( 'child-styles-2', 'child-styles-3', 'child-styles-5' ),
			'page_sportsnetplus.php'          => array( 'child-styles-2', 'child-styles-3', 'child-styles-5' ),
			'page_tubi.php'                   => array( 'child-styles-2', 'child-styles-3', 'child-styles-5' ),
			'page_upfront.php'                => array( 'child-styles-2', 'child-styles-3', 'child-styles-5' ),
			'page_podcasts.php'               => array( 'audio-landing', 'child-styles-2', 'child-styles-3', 'child-styles-5' ),
			'page_tsc.php'                    => array( 'audio-landing', 'child-styles-3', 'child-styles-5' ),
			'page_advanced-solutions.php'     => array( 'reskin', 'child-styles-5' ),
			'page_whatwedo.php'               => array( 'reskin' ),
		);

		if ( ! isset( $late_handles_map[ $template ] ) ) {
			return;
		}

		$late = $late_handles_map[ $template ];

		$all = array_filter(
			array( 'child-styles-2', 'child-styles-3', 'child-styles-4', 'child-styles-5', 'audio-landing', 'reskin' ),
			function( $handle ) {
				return wp_style_is( $handle, 'enqueued' );
			}
		);

		$early = array_diff( $all, $late );

		$styles   = wp_styles();
		$previous = null;

		foreach ( $late as $handle ) {
			if ( ! wp_style_is( $handle, 'enqueued' ) ) {
				continue;
			}

			if ( ! isset( $styles->registered[ $handle ] ) ) {
				$previous = $handle;
				continue;
			}

			$extra_deps = $early;
			if ( $previous ) {
				$extra_deps[] = $previous;
			}

			$styles->registered[ $handle ]->deps = array_values(
				array_unique( array_merge( $styles->registered[ $handle ]->deps, $extra_deps ) )
			);

			$previous = $handle;
		}
	}
} // endif function_exists( 'reorder_rsm_stylesheet_deps' ).

add_action( 'wp_enqueue_scripts', 'reorder_rsm_stylesheet_deps', 20 );

add_action( 'wp_enqueue_scripts', 'load_rsm_stylesheet' );
