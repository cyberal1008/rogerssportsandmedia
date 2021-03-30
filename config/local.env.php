<?php
define( 'DOMAIN_CURRENT_SITE', 'local-www.rogerssportsandmedia.com' );

$_env = array(
	'DB_HOST'                   => 'localhost',
	'DB_NAME'                   => 'rogerssportsandmedia',
	'DB_USER'                   => 'root',
	'DB_PASSWORD'               => 'root',
	'RDM_USE_PRODUCTION_IMAGES' => 'https://www.rogerssportsandmedia.com',
	'WP_DEBUG'                  => true,
	'SCRIPT_DEBUG'              => true,
	'WP_DEBUG_DISPLAY'          => true,
	'CONCATENATE_SCRIPTS'       => false,
	'SAVEQUERIES'               => true,

	'WP_SITEURL'                => 'http://' . DOMAIN_CURRENT_SITE,
	'WP_HOME'                   => 'http://' . DOMAIN_CURRENT_SITE,

	/**
	 * Remove WP_CRON
	*/
	'DISABLE_WP_CRON'           => true,

	// 'redis_server'              => array(
	// 	'host'     => 'localhost',
	// 	'port'     => '6379',
	// 	'site'     => 'RSM',
	// 	'database' => 2,
	// ),

);


// Allow these default dev settings to be overridden locally by a config that is not committed.
$active_env = trim( file_get_contents( dirname( __FILE__ ) . '/active-env' ) );
if ( file_exists( dirname( __FILE__ ) . "/{$active_env}-overrides.env.php" ) ) {
	$override = include "{$active_env}-overrides.env.php";
	$_env     = array_merge( $_env, $override );
}


return $_env;
