<?php
/**
 * Technical SEO: retire the pages flagged for removal.
 *
 * The RSM Technical SEO Audit marked a set of pages in red as "remove": empty
 * shells, outdated campaign landing pages, and duplicates of a canonical page
 * that still exists. Every one of them was returning 200 and was indexable.
 *
 * Serving a 301 from here retires them immediately, without waiting on a
 * content pass: search engines drop the old URL and consolidate any equity into
 * the destination, and anyone following an old link lands somewhere useful
 * rather than on an empty page.
 *
 * Trashing the underlying page in wp-admin afterwards is optional cleanup, and
 * these redirects keep working once it happens.
 *
 * All destinations were confirmed to return 200, and the map is asserted to be
 * loop-free (no destination is itself a source).
 *
 * This file also retires the event and rsm-radio post types wholesale,
 * 301-ing every URL shape they had (singles, archive, pagination, and
 * ?post_type=/?<type>= query forms) to their replacement hub.
 *
 * Depends on rsm_seo_current_request_path() from seo-hidden-h1.php, which
 * functions.php loads first.
 *
 * @package rogerssportsandmedia.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Map of retired page paths to their replacement.
 *
 * Keys and values are lowercase, leading- and trailing-slashed paths.
 *
 * @return array<string, string>
 */
function rsm_seo_retired_page_map() {
	$map = array(
		// Empty or outdated one-day-sale campaign pages.
		'/onedaysale-halifax/'                        => '/',
		'/onedaysale-kingston/'                       => '/',
		'/onedaysale-ottawa/'                         => '/',

		// Outdated campaign and contest pages.
		'/oongalee-x-rsm-contest/'                    => '/',
		'/sportsnet-app-contest/'                     => '/sportsnet-plus/',
		'/funfront/'                                  => '/',
		'/funfronts/'                                 => '/',
		'/studio-2-go/'                               => '/ad-solutions/',
		'/ccsa/'                                      => '/',
		'/upfront-2024/'                              => '/upfront-26/',

		// Empty shells that have a real equivalent.
		'/advertise-with-us/'                         => '/ad-solutions/',
		'/media-inquiries/'                           => '/contact-us/',
		'/citynews-launch/'                           => '/citynews/',
		'/mlb-tv/'                                    => '/sports/',
		'/events/'                                    => '/the-latest/events/',
		'/ad-manager/'                                => '/ad-solutions/',

		// Superseded duplicates.
		'/privacy-policy-old/'                        => '/privacy-policy/',
		'/standard-sales-terms-and-condition/'        => '/standard-sales-terms-and-conditions/',
		'/modalites-normalisees-regissant-les-ventes/' => '/standard-sales-terms-and-conditions/',
		'/who-we-are-3/'                              => '/about-us/',
		'/what-we-do/advanced-solutions/'             => '/what-we-do/creative-solutions/',

		// Retired news category archives, consolidated into the main hub.
		'/the-latest/news/'                           => '/the-latest/',
		'/the-latest/media-release/'                  => '/the-latest/',
		'/the-latest/community/'                      => '/the-latest/',
	);

	/**
	 * Filters the retired page redirect map.
	 *
	 * @param array<string, string> $map Old path => new path.
	 */
	return apply_filters( 'rsm_seo_retired_page_map', $map );
}

/**
 * Issues a 301 for retired pages.
 *
 * Runs early on template_redirect so the redirect happens whether the page is
 * still published, already trashed, or gone entirely.
 */
function rsm_seo_redirect_retired_pages() {
	if ( is_admin() || is_feed() || is_embed() ) {
		return;
	}

	if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return;
	}

	$map  = rsm_seo_retired_page_map();
	$path = rsm_seo_current_request_path();

	// Treat paginated archive pages as their archive root for the lookup.
	if ( preg_match( '#^/the-latest/(news|media-release|community)/page/[0-9]+/$#', $path, $matches ) ) {
		$path = '/the-latest/' . $matches[1] . '/';
	}

	$target = isset( $map[ $path ] ) ? $map[ $path ] : '';

	if ( '' === $target ) {
		return;
	}

	// Never redirect a path onto itself.
	if ( $target === $path ) {
		return;
	}

	wp_safe_redirect( home_url( $target ), 301 );
	exit;
}
add_action( 'template_redirect', 'rsm_seo_redirect_retired_pages', 1 );

/**
 * Map of retired post types to their rewrite slug and replacement.
 *
 * The event post type (key 'event', slug /event/, see mu-plugins/rsm-broadcast/
 * lib/PostType/Events.php) and the rsm-radio post type (key 'rsm-radio', slug
 * /radios/, see PostType/Radio.php) are both being retired wholesale.
 *
 * @return array<string, array{prefix: string, target: string}>
 */
function rsm_seo_retired_post_type_map() {
	$map = array(
		'event'     => array(
			'prefix' => '/event/',
			'target' => '/the-latest/events/',
		),
		'rsm-radio' => array(
			'prefix' => '/radios/',
			'target' => '/radio/',
		),
	);

	/**
	 * Filters the retired post type redirect map.
	 *
	 * @param array<string, array{prefix: string, target: string}> $map Post type => prefix/target.
	 */
	return apply_filters( 'rsm_seo_retired_post_type_map', $map );
}

/**
 * Issues a 301 for every URL shape a retired post type ever had.
 *
 * Covers singles (published, trashed, or deleted), the archive and its
 * pagination, and the ?post_type=<type> / ?<type>=<slug> query forms. Runs
 * early on template_redirect, same as rsm_seo_redirect_retired_pages(), so it
 * fires whether or not the underlying post still exists.
 */
function rsm_seo_redirect_retired_post_types() {
	if ( is_admin() || is_feed() || is_embed() || is_preview() ) {
		return;
	}

	if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return;
	}

	$map  = rsm_seo_retired_post_type_map();
	$path = rsm_seo_current_request_path();

	foreach ( $map as $route ) {
		// Never redirect a path onto itself.
		if ( 0 === strpos( $path, $route['prefix'] ) && $path !== $route['target'] ) {
			wp_safe_redirect( home_url( $route['target'] ), 301 );
			exit;
		}
	}

	$requested_post_type = isset( $_GET['post_type'] ) ? sanitize_key( wp_unslash( $_GET['post_type'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( isset( $map[ $requested_post_type ] ) ) {
		wp_safe_redirect( home_url( $map[ $requested_post_type ]['target'] ), 301 );
		exit;
	}

	// ?event=<slug> and ?rsm-radio=<slug>, the singular query var for each type.
	foreach ( $map as $post_type => $route ) {
		if ( isset( $_GET[ $post_type ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			wp_safe_redirect( home_url( $route['target'] ), 301 );
			exit;
		}
	}
}
add_action( 'template_redirect', 'rsm_seo_redirect_retired_post_types', 1 );

/**
 * Keeps the retired post types out of the Yoast sitemap.
 *
 * @param bool   $excluded  Whether the post type is excluded.
 * @param string $post_type Post type name.
 * @return bool
 */
function rsm_seo_exclude_retired_post_type_sitemap( $excluded, $post_type ) {
	return isset( rsm_seo_retired_post_type_map()[ $post_type ] ) ? true : $excluded;
}
add_filter( 'wpseo_sitemap_exclude_post_type', 'rsm_seo_exclude_retired_post_type_sitemap', 10, 2 );
