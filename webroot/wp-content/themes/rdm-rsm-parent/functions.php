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

register_sidebar(
	array(
		'name'          => 'Footer Area 5',
		'id'            => 'footer-5',
		'description'   => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget-5 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	)
);

register_sidebar(
	array(
		'name'          => 'Footer Area 6',
		'id'            => 'footer-6',
		'description'   => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget-6 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	)
);

function page_tagcat_settings() {
	register_taxonomy_for_object_type( 'category', 'page' );
}

add_action( 'init', 'page_tagcat_settings' );

function page_tagcat_support_query( $wp_query ) {
	if ( $wp_query->get( 'category_name' ) ) {
		$wp_query->set( 'post_type', 'any' );
	}
}

add_action( 'pre_get_posts', 'page_tagcat_support_query' );

add_image_size( 'hero', 1920, 1005, true );
add_image_size( 'hero-1366', 1366, 715, true );
add_image_size( 'hero-768', 768, 402, true );
add_image_size( 'hero-375', 375, 196, true );

add_image_size( 'portrait', 475, 720, true );
add_image_size( 'portrait-320', 320, 485, true );
add_image_size( 'portrait-80', 80, 121, true );

add_image_size( 'landscape', 810, 608, true );
add_image_size( 'landscape-577', 577, 433, true );
add_image_size( 'landscape-375', 375, 281, true );

add_image_size( 'wide', 810, 456, true );
add_image_size( 'wide-577', 577, 324, true );
add_image_size( 'wide-375', 375, 210, true );

add_image_size( 'square', 810, 810, true );
add_image_size( 'square-577', 577, 577, true );
add_image_size( 'square-375', 375, 375, true );

add_filter( 'image_size_names_choose', 'custom_image_sizes' );
function custom_image_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'hero'      => __( 'Hero' ),
		'portrait'  => __( 'Portrait' ),
		'landscape' => __( 'Landscape' ),
		'wide'      => __( 'Wide' ),
		'square'    => __( 'Square' ),
	) );
}

function get_data_items( $post_id, $taxonomy ) {
	$post_terms = get_the_terms( $post_id, $taxonomy );
	$return_val = "";
	if($post_terms){
		$return_val = implode( "|", wp_list_pluck( $post_terms, 'slug' ) );
	}

	return $return_val;
}

/**
 * Zoninator filters and actions
 */

function add_zoninator_post_types() {

	if ( class_exists( 'RSM\Broadcast\PostType\Highlights' )  ) {
		$available_post_types = array(
			\RSM\Broadcast\PostType\Highlights::SLUG,
			\RSM\Broadcast\PostType\Solutions::SLUG,
		);
		foreach ( $available_post_types as $post_type ) {
			add_post_type_support( $post_type, 'zoninator_zones' );
		}

	}
}

add_action( 'zoninator_pre_init', 'add_zoninator_post_types' );


function update_zoninator_search_args( $args ) {
	if ( isset( $args['orderby'] ) ) {
		$args['orderby'] = 'relevance';
	}

	if ( isset( $args['posts_per_page'] ) ) {
		$args['posts_per_page'] = (int) $args['posts_per_page'] + 10;
	}

	return $args;
}

add_filter( 'zoninator_search_args', 'update_zoninator_search_args' );