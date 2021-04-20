<?php
/**
 * Rdm-rsm-parent functions and definitions
 *
 * @package rdm-rsm-parent
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$parent_includes = array(
	'/enqueue.php',                         // Enqueue parent theme scripts and styles.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/class-rsm-customizer-settings.php',
);

foreach ( $parent_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

// This theme uses wp_nav_menu() in one location.
register_nav_menus(
	array(
		'primary' => __( 'Primary Menu', 'rdm-rsm-parent' ),
	)
);

add_theme_support( 'post-thumbnails' );

add_filter( 'nav_menu_css_class', 'special_nav_class', 10, 2 );

function special_nav_class( $classes, $item ) {
	if ( in_array( 'current-menu-item', $classes ) ) {
		$classes[] = 'active ';
	}
	return $classes;
}

function remove_core_updates() {
	global $wp_version;
	return (object) array(
		'last_checked'    => time(),
		'version_checked' => $wp_version,
	);
}
add_filter( 'pre_site_transient_update_core', 'remove_core_updates' );
add_filter( 'pre_site_transient_update_plugins', 'remove_core_updates' );
add_filter( 'pre_site_transient_update_themes', 'remove_core_updates' );


register_sidebar(
	array(
		'name'          => 'Footer Area 1',
		'id'            => 'footer-1',
		'description'   => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget-1 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	)
);

register_sidebar(
	array(
		'name'          => 'Footer Area 2',
		'id'            => 'footer-2',
		'description'   => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget-2 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	)
);

register_sidebar(
	array(
		'name'          => 'Footer Area 3',
		'id'            => 'footer-3',
		'description'   => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	)
);

register_sidebar(
	array(
		'name'          => 'Footer Area 4',
		'id'            => 'footer-4',
		'description'   => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget-4 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	)
);
