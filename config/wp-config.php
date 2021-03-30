<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

/**
 * wp-config.php for RDM Core
 * derived from X-Team's implementation
 * @version 2011-12-09
 * @author Joe Hohetyz <joe.hohertz@rci.rogers.com>
 * @author Weston Ruter <weston@x-team.com>
 *
 * =CHANGELOG=
 * 2012-04-18 Import to RDM Core, and subsequent conversions
 * 2011-12-09 Using WPIZED_MOBILE_SUBDOMAIN config, and encapsulating logic into
 *            functions to help with leaking variables into global namespace.
 */

/**
 * Notice that the configuration options (like user credentials) are located
 * outside of the document root, so the "Securing wp-config.php" is satisfied:
 * http://codex.wordpress.org/Hardening_WordPress#Securing_wp-config.php
 */
function _rdm_load_configs(){
	$rdm_envs_dir = null;

        // not sure we need this, look at simplifying FIXME
	$rdm_envs_dir_candidate = realpath(dirname(__FILE__) . "/../config");
	if( file_exists("{$rdm_envs_dir_candidate}/wordpress-config.class.php") ){
		$rdm_envs_dir = $rdm_envs_dir_candidate;
	}
	if( is_null($rdm_envs_dir) ){
		header( 'HTTP/1.0 500 Internal Server Error' );
		trigger_error( 'config dir not found', E_USER_ERROR );
		die();
	}
	
	try {
		// @todo We can rename wordpress-config.class.php to rdm-config.class.php and place in docroot
		require_once "{$rdm_envs_dir}/wordpress-config.class.php";
		global $rdm_envs;
		$rdm_envs = new RDM_WordPress_Config($rdm_envs_dir);
		$rdm_envs->extract();
		define( 'RDM_ACTIVE_ENV', $rdm_envs->active_env );
	}
	catch( Exception $e ){
		trigger_error( $e->getMessage(), E_USER_ERROR );
		die();
	}
}
_rdm_load_configs();


/**
 * Don't let WordPress get confused by requests to origin and mobile domains
 * Define RDM_ORIGIN_SUBDOMAIN in your default.env.php
 */
function _rdm_rewrite_host_variables(){
	if( defined('RDM_ORIGIN_SUBDOMAIN') ){
		$regexp = sprintf('/(^|\.)%s[\.\-]/', RDM_ORIGIN_SUBDOMAIN);
		$_SERVER['SERVER_NAME'] = preg_replace($regexp, '', $_SERVER['SERVER_NAME']);
		$_SERVER['HTTP_HOST']   = preg_replace($regexp, '', $_SERVER['HTTP_HOST']);
	}
}
_rdm_rewrite_host_variables();

/**
 * This is a very ugly hack that is necessary so that we can prevent wp_favicon_request()
 * from taking its fateful action. Then in each theme's functions.php we check the
 * path only (ignoring the query string) to get a successful match.
 */
if( $_SERVER['REQUEST_URI'] == '/favicon.ico' ){
	$_SERVER['REQUEST_URI'] .= "?disable=wp_favicon_request";
}

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') ){
	define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


