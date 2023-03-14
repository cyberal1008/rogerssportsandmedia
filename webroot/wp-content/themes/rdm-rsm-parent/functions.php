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
	return array_merge(
		$sizes,
		array(
			'hero'      => __( 'Hero' ),
			'portrait'  => __( 'Portrait' ),
			'landscape' => __( 'Landscape' ),
			'wide'      => __( 'Wide' ),
			'square'    => __( 'Square' ),
		)
	);
}

function get_data_items( $post_id, $taxonomy ) {
	$post_terms = get_the_terms( $post_id, $taxonomy );
	$return_val = '';
	if ( $post_terms ) {
		$return_val = implode( '|', wp_list_pluck( $post_terms, 'slug' ) );
	}

	return $return_val;
}

/**
 * Zoninator filters and actions
 */

function add_zoninator_post_types() {

	if ( class_exists( 'RSM\Broadcast\PostType\Highlights' ) ) {
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

function fix_category_pagination( $query_string = array() ) {
	if ( isset( $query_string['category_name'] )
			&& isset( $query_string['name'] ) && $query_string['name'] === 'page'
			&& isset( $query_string['page'] ) ) {
		$paged = trim( $query_string['page'], '/' );
		if ( is_numeric( $paged ) ) {
			unset( $query_string['name'] );
			unset( $query_string['page'] );
			$query_string['paged'] = (int) $paged;
		}
	}
	return $query_string;
}
add_filter( 'request', 'fix_category_pagination' );

function image_metadata_js( $response, $attachment ) {
	foreach ( $response['sizes'] as $size => $datas ) {
		$response['sizes'][ $size ]['srcset'] = wp_get_attachment_image_srcset( $attachment->ID, $size );
		$response['sizes'][ $size ]['sizes']  = wp_get_attachment_image_sizes( $attachment->ID, $size );
	}

	return $response;
}

add_filter( 'wp_prepare_attachment_for_js', 'image_metadata_js', 10, 2 );

add_filter(
	'embed_oembed_html',
	function ( $html, $url, $attr, $post_id ) {
		if ( strpos( $html, 'youtube.com' ) !== false || strpos( $html, 'youtu.be' ) !== false ) {
			return '<div class="video-container">' . $html . '</div>';
		} else {
			return $html;
		}
	},
	10,
	4
);

function facebook_pixel_code() {
	?>
	<!-- Facebook Pixel Code -->
	<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window,document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '615661576161288');
		fbq('track', 'PageView');
	</script>
	<noscript>
		<img height="1" width="1"
		src="https://www.facebook.com/tr?id=615661576161288&ev=PageView
		&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->
	<?php
}

function linkedin_pixel_code() {
	?>
	<script type="text/javascript"> _linkedin_partner_id = "3613641"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script><script type="text/javascript"> (function(l) { if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])}; window.lintrk.q=[]} var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(window.lintrk); </script> <noscript> <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=3613641&fmt=gif" /> </noscript>
	<?php
}

function google_tracking_code() {
	?>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11083871196"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date()); gtag('config', 'AW-11083871196');
	</script>
	<?php
}
