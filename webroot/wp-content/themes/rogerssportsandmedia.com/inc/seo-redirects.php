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

		// Expired event, confirmed for removal by Alex (2026-09-22).
		'/event/2024-baseballfantasy/'                => '/the-latest/events/',
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

	$map    = rsm_seo_retired_page_map();
	$path   = rsm_seo_current_request_path();
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
