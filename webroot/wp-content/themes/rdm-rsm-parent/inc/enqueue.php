<?php
/**
 * Rdm-rsm-parent functions and definitions
 *
 * @package rdm-rsm-parent
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'parent_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function parent_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/style.css' );
		wp_enqueue_style( 'parent-styles', get_template_directory_uri() . '/assets/style.css', array(), $css_version );
		// wp_enqueue_style( 'bootstrap4', get_template_directory_uri() . '/assets/bootstrap.css', array(), $css_version );
		$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/parent.min.js' );
		wp_enqueue_script( 'parent-scripts', get_template_directory_uri() . '/assets/parent.min.js', array(), $js_version, true );
		wp_localize_script( 'parent-scripts', 'video_settings', array(
			'account' => sanitize_text_field ( get_option( 'brightcove_account_id' ) ),
			'player'  => sanitize_text_field ( get_option( 'brightcove_player_id' ) )
		) );
	}
} // endif function_exists( 'parent_scripts' ).

add_action( 'wp_enqueue_scripts', 'parent_scripts' );

// wp enqueue scripts for portfolio page
add_action( 'wp_enqueue_scripts', function () {
	if ( is_page() && stripos( get_page_template_slug(), 'portfolio' ) !== false ) {
		wp_enqueue_script( 'solutions-js', get_template_directory_uri() .  "/assets/scripts/solutions.js", "parent-scripts", '', true );
		wp_enqueue_script( 'portfolio-js', get_template_directory_uri() . "/assets/scripts/portfolio.js", "parent-scripts", '', true );
	}
	if ( is_page() && ( get_post_field( 'post_name' ) === 'television-and-streaming' || get_post_field( 'post_name' ) === 'upfront' ) ) {
		wp_enqueue_script( 'television-js', get_template_directory_uri() . "/assets/scripts/television.js", "parent-scripts", '', true );
	}
	if ( is_page() && get_post_field( 'post_name' ) === 'radio-podcasts' ) {
		wp_enqueue_script( 'radio-js', get_template_directory_uri() . "/assets/scripts/radio.js", "parent-scripts", '', true );
	}
	if (is_page() && is_page_template( 'page_portfolio.php' )){
		wp_enqueue_script( 'portfolio-scroll-js', get_template_directory_uri() . "/assets/scripts/scroll-animation.js", "parent-scripts", '', true );
	}
} );

//wp enqueue script for legal page
add_action( 'wp_enqueue_scripts', function () {
	if (is_page() && is_page_template( 'page-legal.php' )){
		wp_enqueue_script( 'portfolio-js', get_template_directory_uri() . "/assets/scripts/scroll-animation.js", "parent-scripts", '', true );
	}
	if (is_page() && is_page_template( 'page-whoweare.php' )){
		wp_enqueue_script( 'portfolio-js', get_template_directory_uri() . "/assets/scripts/scroll-animation.js", "parent-scripts", '', true );
	}
} );

//wp enqueue script for homepage
add_action( 'wp_enqueue_scripts', function () {
	if (is_home()){
		wp_enqueue_script( 'home-js', get_template_directory_uri() . "/assets/scripts/home.js", "parent-scripts", '', true );
	}
} );
