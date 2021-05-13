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
		wp_enqueue_style( 'bootstrap4', get_template_directory_uri() . '/assets/bootstrap.css', array(), $css_version );
		$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/parent.min.js' );
		wp_enqueue_script( 'parent-scripts', get_template_directory_uri() . '/assets/parent.min.js', array(), $js_version, true );
		wp_localize_script( 'parent-scripts', 'video_settings', array(
			'account' => get_option( 'brightcove_account_id' ),
			'player'  => get_option( 'brightcove_player_id' )
		) );
	}
} // endif function_exists( 'parent_scripts' ).

add_action( 'wp_enqueue_scripts', 'parent_scripts' );

// wp enqueue scripts for television
add_action( 'wp_enqueue_scripts', function () {
	if ( is_page() && stripos( get_the_title(), 'television' ) !== false ) {
		wp_enqueue_script( 'television-js', get_template_directory_uri() . "/assets/scripts/television.js", "parent-scripts", '', true );
	}
	if ( is_page() && get_post_field( 'post_name' ) === 'radio-podcasts' ) {
		wp_enqueue_script( 'radio-js', get_template_directory_uri() . "/assets/scripts/radio.js", "parent-scripts", '', true );
	}
	if (is_page() && is_page_template( 'page_portfolio.php' )){
		wp_enqueue_script( 'portfolio-js', get_template_directory_uri() . "/assets/scripts/scroll-animation.js", "parent-scripts", '', true );
	}
} );
