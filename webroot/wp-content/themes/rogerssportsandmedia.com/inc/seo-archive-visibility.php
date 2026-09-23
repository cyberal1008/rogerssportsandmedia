<?php
/**
 * Technical SEO: remove accidental archive URLs from the front end.
 *
 * The RSM Technical SEO Audit flagged a large block of indexable URLs that were
 * never designed to be pages. They exist only because register_post_type() and
 * register_taxonomy() default to publicly queryable, so WordPress happily serves
 * a full page for things like:
 *
 *   /?rsm_region=toronto        /?rsm_network=tubi        /?speaker=anthony-attard
 *   /?post_type=rsm_show        /event/                   /author/<user>/
 *
 * Nothing in the theme or the rsm-broadcast mu-plugin links to any of them:
 * there is not a single get_term_link() or get_post_type_archive_link() call in
 * the codebase, and every one of these taxonomies is registered with
 * 'rewrite' => false, i.e. no pretty permalink was ever intended. They are pure
 * data containers that drive sliders and meta boxes via WP_Query.
 *
 * Rather than editing the shared mu-plugin, the registration arguments are
 * adjusted here through core's filters, and a request guard turns the withdrawn
 * URLs into genuine 404s. The guard is what actually produces the 404: stripping
 * 'public' alone is not sufficient, because WordPress then drops the now-unknown
 * query vars and falls through to the front page with a 200 (see
 * rsm_seo_force_404_for_withdrawn_urls() below).
 *
 * Admin term management (show_ui / show_admin_column) is deliberately left
 * intact so editors keep managing terms exactly as before.
 *
 * KNOWN TRADE-OFF: the three fully withdrawn post types (rsm_show,
 * rsm_highlight, rsm_solution) lose the editor's Preview and View buttons,
 * because core gates those on is_post_type_viewable(). They are registered with
 * 'rewrite' => false and have no front-end URL of their own - they are only ever
 * rendered inside sliders on other pages - so there was nothing meaningful to
 * preview, but the buttons do disappear.
 *
 * NOTE: rewrite rules must be flushed after deploying this (Settings >
 * Permalinks > Save, or `wp rewrite flush`).
 *
 * @package rogerssportsandmedia.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Taxonomies whose front-end archives should not exist.
 *
 * All are registered with 'rewrite' => false by the rsm-broadcast mu-plugin, so
 * they are only reachable as ?taxonomy=term query strings.
 *
 * @return string[]
 */
function rsm_seo_private_taxonomies() {
	return apply_filters(
		'rsm_seo_private_taxonomies',
		array(
			'rsm_day',
			'rsm_network',
			'rsm_radio_category',
			'rsm_region',
			'rsm_show_category',
			'speaker',

			/*
			 * Tags are never surfaced on the front end: there is no the_tags(),
			 * get_the_tag_list(), get_tag_link() or tag cloud anywhere in either
			 * theme, and no query uses tag__in / has_tag(). The 81 /tag/<slug>/
			 * archives and their pagination were therefore indexable, thin and
			 * entirely unlinked.
			 *
			 * Categories are deliberately NOT listed here: they power the real
			 * /the-latest/news/ style archives via get_category_link().
			 */
			'post_tag',
		)
	);
}

/**
 * Post types whose archive index should not exist.
 *
 * 'full' also withdraws single views: these three are registered with
 * 'rewrite' => false, so their entries have no permalink structure and are only
 * ever rendered inside sliders on other pages.
 *
 * 'archive_only' keeps single posts reachable (they have real, linked URLs) and
 * removes just the unlinked archive index.
 *
 * @return array<string, string>
 */
function rsm_seo_private_post_types() {
	return apply_filters(
		'rsm_seo_private_post_types',
		array(
			'rsm_show'      => 'full',
			'rsm_highlight' => 'full',
			'rsm_solution'  => 'full',
			'event'         => 'archive_only',

			// NB: 'radios' is only the rewrite slug. The registered post type
			// key is 'rsm-radio' (see mu-plugins/rsm-broadcast/lib/PostType/
			// Radio.php: SLUG = 'radios', TYPE = 'rsm-radio').
			'rsm-radio'     => 'archive_only',
		)
	);
}

/**
 * Withdraws the public archive for the flagged taxonomies.
 *
 * @param array  $args     Taxonomy registration arguments.
 * @param string $taxonomy Taxonomy key.
 * @return array Filtered arguments.
 */
function rsm_seo_filter_taxonomy_args( $args, $taxonomy ) {
	if ( ! in_array( $taxonomy, rsm_seo_private_taxonomies(), true ) ) {
		return $args;
	}

	$args['public']             = false;
	$args['publicly_queryable'] = false;
	$args['show_in_nav_menus']  = false;

	/*
	 * Drop the permastruct too. post_tag is re-registered by core on init:0
	 * with an explicit rewrite array, and WP_Taxonomy::add_rewrite_rules()
	 * would otherwise keep serving /tag/<slug>/ from a stale rule.
	 */
	$args['rewrite'] = false;

	// Keep the admin experience unchanged.
	$args['show_ui']           = true;
	$args['show_admin_column'] = isset( $args['show_admin_column'] ) ? $args['show_admin_column'] : true;

	return $args;
}
add_filter( 'register_taxonomy_args', 'rsm_seo_filter_taxonomy_args', 10, 2 );

/**
 * Withdraws unlinked post type archives, and single views where none exist.
 *
 * @param array  $args      Post type registration arguments.
 * @param string $post_type Post type key.
 * @return array Filtered arguments.
 */
function rsm_seo_filter_post_type_args( $args, $post_type ) {
	$targets = rsm_seo_private_post_types();

	if ( ! isset( $targets[ $post_type ] ) ) {
		return $args;
	}

	$args['has_archive'] = false;

	if ( 'full' === $targets[ $post_type ] ) {
		$args['publicly_queryable']  = false;
		$args['exclude_from_search'] = true;
		$args['show_in_nav_menus']   = false;
	}

	// Keep the editing screens available. Note that for the 'full' types above,
	// publicly_queryable => false also removes the Preview / View buttons,
	// because core gates them on is_post_type_viewable(). See the file header.
	$args['show_ui']      = true;
	$args['show_in_menu'] = isset( $args['show_in_menu'] ) ? $args['show_in_menu'] : true;

	return $args;
}
add_filter( 'register_post_type_args', 'rsm_seo_filter_post_type_args', 10, 2 );

/**
 * Sends a real 404 for every URL shape this file withdraws.
 *
 * Withdrawing a taxonomy or post type is not enough on its own. WordPress
 * strips the query vars it no longer recognises, which can leave a request with
 * no vars at all; WP::handle_404() then treats it as the home query and
 * deliberately refuses to 404, so /tag/foo/ or /?rsm_region=toronto would be
 * served as the front page with a 200 and become a duplicate. This guard makes
 * the outcome explicit and independent of rewrite-rule state.
 */
function rsm_seo_force_404_for_withdrawn_urls() {
	if ( is_admin() || is_feed() || is_embed() ) {
		return;
	}

	if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return;
	}

	// Never interfere with logged-in editors previewing content.
	if ( is_preview() || is_customize_preview() ) {
		return;
	}

	if ( ! rsm_seo_request_is_withdrawn() ) {
		return;
	}

	global $wp_query;

	$wp_query->set_404();
	status_header( 404 );
	nocache_headers();

	$template = get_query_template( '404' );

	if ( $template ) {
		include $template;
	}

	exit;
}
add_action( 'template_redirect', 'rsm_seo_force_404_for_withdrawn_urls', 2 );

/**
 * Whether the current request targets a withdrawn archive.
 *
 * Inspects the raw request rather than the parsed query, because the query vars
 * that identify these URLs are exactly the ones WordPress has just discarded.
 *
 * @return bool
 */
function rsm_seo_request_is_withdrawn() {
	if ( is_author() ) {
		return true;
	}

	$path = rsm_seo_current_request_path();

	// /tag/<slug>/ and its pagination, plus /author/<nicename>/.
	if ( preg_match( '#^/(tag|author)/#', $path ) ) {
		return true;
	}

	$query = array();

	if ( isset( $_SERVER['REQUEST_URI'] ) ) {
		$query_string = wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_QUERY ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitised

		if ( $query_string ) {
			parse_str( $query_string, $query );
		}
	}

	if ( empty( $query ) ) {
		return false;
	}

	$private_taxonomies = rsm_seo_private_taxonomies();

	/*
	 * Core exposes the built-in post_tag taxonomy through the legacy `tag`
	 * query var rather than the taxonomy key. Check its direct query forms
	 * explicitly because the raw-request guard cannot rely on registration
	 * filters having removed them from the parsed query.
	 */
	if ( in_array( 'post_tag', $private_taxonomies, true ) && ( isset( $query['tag'] ) || isset( $query['tag_id'] ) ) ) {
		return true;
	}

	foreach ( $private_taxonomies as $taxonomy ) {
		if ( isset( $query[ $taxonomy ] ) ) {
			return true;
		}
	}

	$post_types = rsm_seo_private_post_types();

	if ( isset( $query['post_type'] ) ) {
		$requested = (array) $query['post_type'];

		foreach ( $requested as $post_type ) {
			if ( isset( $post_types[ $post_type ] ) && 'full' === $post_types[ $post_type ] ) {
				return true;
			}
		}
	}

	return false;
}

/**
 * Drops the author permastruct so WordPress stops advertising author URLs.
 */
function rsm_seo_remove_author_rewrites( $rules ) {
	return array();
}
add_filter( 'author_rewrite_rules', 'rsm_seo_remove_author_rewrites' );

/**
 * Removes the author sitemap provider so the URLs are not submitted to Google.
 *
 * This site serves its sitemap through Yoast, which unconditionally disables
 * core's sitemaps (wp_sitemaps_enabled => false). The core filter below is
 * therefore only a fallback for if Yoast is ever removed; the Yoast filter is
 * the one that does the work today. Without it Yoast keeps submitting
 * /author/<nicename>/ URLs that now return 404.
 *
 * @param object $provider    Sitemap provider.
 * @param string $provider_name Provider name.
 * @return object|false Provider, or false to drop it.
 */
function rsm_seo_remove_author_sitemap( $provider, $provider_name ) {
	return ( 'users' === $provider_name ) ? false : $provider;
}
add_filter( 'wp_sitemaps_add_provider', 'rsm_seo_remove_author_sitemap', 10, 2 );

// Yoast: returning no users drops the author sitemap from the index entirely.
add_filter( 'wpseo_sitemap_exclude_author', '__return_empty_array' );

/**
 * Keeps the withdrawn taxonomies out of the Yoast sitemap.
 *
 * @param bool   $excluded Whether the taxonomy is excluded.
 * @param string $taxonomy Taxonomy name.
 * @return bool
 */
function rsm_seo_exclude_taxonomy_sitemap( $excluded, $taxonomy ) {
	return in_array( $taxonomy, rsm_seo_private_taxonomies(), true ) ? true : $excluded;
}
add_filter( 'wpseo_sitemap_exclude_taxonomy', 'rsm_seo_exclude_taxonomy_sitemap', 10, 2 );

/**
 * Whether the current request is a paginated archive page.
 *
 * The audit flagged 64 /the-latest/<category>/page/N/ URLs as duplicates. They
 * cannot be deleted - they are how the news archive is browsed - but they have
 * no independent value in search, so they are marked noindex,follow. Crawlers
 * still walk through them to reach the posts; they just stop indexing the
 * paginated views themselves. Page 1 of each archive is untouched.
 *
 * @return bool
 */
function rsm_seo_is_paginated_archive() {
	return ( ! is_admin() && is_paged() && ( is_archive() || is_home() || is_search() ) );
}

/**
 * Marks paginated archives noindex via Yoast, which owns the robots tag here.
 *
 * @param array $robots Yoast robots directives.
 * @return array Filtered directives.
 */
function rsm_seo_yoast_noindex_paginated( $robots ) {
	if ( rsm_seo_is_paginated_archive() ) {
		$robots['index'] = 'noindex';
	}

	return $robots;
}
add_filter( 'wpseo_robots_array', 'rsm_seo_yoast_noindex_paginated' );

/**
 * Core fallback for the same rule, used if Yoast is ever deactivated.
 *
 * @param array $robots Core robots directives.
 * @return array Filtered directives.
 */
function rsm_seo_core_noindex_paginated( $robots ) {
	if ( rsm_seo_is_paginated_archive() ) {
		$robots['noindex'] = true;
		$robots['follow']  = true;
	}

	return $robots;
}
add_filter( 'wp_robots', 'rsm_seo_core_noindex_paginated' );
