<?php
/**
 * Technical SEO: route "The Latest" posts under /the-latest/.
 *
 * Yoast SEO filters 'post_link_category' at priority 10 to pick the post's
 * "primary category" for use in the permalink. That choice doesn't always
 * match the section of the site a post actually belongs to.
 *
 * Here, any post filed in the 'the-latest' category (or one of its
 * descendant categories) is forced to use the 'the-latest' term itself for
 * the permalink, so the resulting URL is always /the-latest/<postname>/
 * regardless of which specific sub-category Yoast would otherwise pick.
 * Posts outside that category tree are left untouched.
 *
 * @package rogerssportsandmedia.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Forces posts under the "the-latest" category tree to permalink there.
 *
 * Runs at priority 20 so it overrides Yoast SEO's primary category filter
 * on 'post_link_category', which runs at priority 10.
 *
 * @param WP_Term       $category   The category WordPress will use in the permalink.
 * @param array<int|WP_Term> $categories The post's categories.
 * @param WP_Post       $post       The post being linked.
 * @return WP_Term The category to use in the permalink.
 */
function rsm_seo_post_link_category( $category, $categories, $post ) {
	$the_latest = get_term_by( 'slug', 'the-latest', 'category' );

	if ( ! $the_latest instanceof WP_Term ) {
		return $category;
	}

	if ( empty( $categories ) || ! is_array( $categories ) ) {
		return $category;
	}

	foreach ( $categories as $cat ) {
		$term_id = is_object( $cat ) ? $cat->term_id : $cat;

		if ( (int) $term_id === (int) $the_latest->term_id || term_is_ancestor_of( $the_latest, $term_id, 'category' ) ) {
			return $the_latest;
		}
	}

	return $category;
}
add_filter( 'post_link_category', 'rsm_seo_post_link_category', 20, 3 );

/**
 * Redirects stale /the-latest/<old-category>/ post URLs to the correct permalink.
 *
 * WordPress core's redirect_canonical() does not catch this case: it only
 * redirects away from a wrong category path when the post no longer belongs
 * to that category. Here, posts routed under "the-latest" by
 * rsm_seo_post_link_category() above can still carry a now-stale nested
 * category in the requested URL (e.g. /the-latest/news/<postname>/) while
 * still belonging to that category, so core leaves the mismatched URL
 * returning 200. This 301-redirects such requests to the canonical
 * /the-latest/<postname>/ permalink.
 *
 * Runs at priority 5, before rsm_seo_buffer_hidden_h1() (priority 0 runs
 * first, but output buffering has not started output yet at this point).
 */
function rsm_seo_redirect_stale_the_latest_urls() {
	if ( is_admin() || is_preview() || is_feed() || ! is_singular( 'post' ) ) {
		return;
	}

	$permalink = get_permalink();

	if ( ! is_string( $permalink ) || '' === $permalink ) {
		return;
	}

	$permalink_path = wp_parse_url( $permalink, PHP_URL_PATH );

	if ( ! is_string( $permalink_path ) || '' === $permalink_path ) {
		return;
	}

	$permalink_path  = strtolower( $permalink_path );
	$permalink_path  = '/' . trim( $permalink_path, '/' );
	$permalink_path  = '/' === $permalink_path ? '/' : $permalink_path . '/';
	$requested_path  = rsm_seo_current_request_path();

	if ( 0 !== strpos( $permalink_path, '/the-latest/' ) ) {
		return;
	}

	if ( $requested_path === $permalink_path ) {
		return;
	}

	$query_string = isset( $_SERVER['QUERY_STRING'] ) ? wp_unslash( $_SERVER['QUERY_STRING'] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitised

	if ( '' !== $query_string ) {
		$permalink .= ( false === strpos( $permalink, '?' ) ? '?' : '&' ) . $query_string;
	}

	wp_safe_redirect( $permalink, 301 );
	exit;
}
add_action( 'template_redirect', 'rsm_seo_redirect_stale_the_latest_urls', 5 );
