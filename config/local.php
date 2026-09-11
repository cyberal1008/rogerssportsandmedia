<?php
define( 'DOMAIN_CURRENT_SITE', 'local-www.rogerssportsandmedia.com' );
// ** MySQL settings ** //
define( 'DB_NAME', 'rogerssportsandmedia' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'root' );
// Use WORDPRESS_DB_HOST if set, or host.docker.internal when inside Docker container, or 127.0.0.1:3306 on local host
if ( getenv( 'WORDPRESS_DB_HOST' ) ) {
	define( 'DB_HOST', getenv( 'WORDPRESS_DB_HOST' ) );
} elseif ( file_exists( '/.dockerenv' ) ) {
	define( 'DB_HOST', 'host.docker.internal:3306' );
} else {
	define( 'DB_HOST', '127.0.0.1:3306' );
}
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
define( 'COOKIE_DOMAIN', isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : DOMAIN_CURRENT_SITE );

define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', true );
define( 'WP_CACHE', true );

define( 'CONCATENATE_SCRIPTS', false );
define( 'SAVEQUERIES', true );
define( 'WP_SITEURL', 'https://' . DOMAIN_CURRENT_SITE );
define( 'WP_HOME', 'https://' . DOMAIN_CURRENT_SITE );
define( 'DISABLE_WP_CRON', true );

// Redis configuration (use container hostname 'redis' in Docker, 127.0.0.1 on host)
if ( getenv( 'REDIS_HOST' ) ) {
	$redis_host = getenv( 'REDIS_HOST' );
} elseif ( file_exists( '/.dockerenv' ) ) {
	$redis_host = 'redis';
} else {
	$redis_host = '127.0.0.1';
}

$redis_server = array(
	'host'     => $redis_host,
	'port'     => getenv( 'REDIS_PORT' ) ?: '6379',
	'database' => '2',
);

define( 'WP_CACHE_KEY_SALT', 'RSM' );

define('SCRIPT_DEBUG', true);

$table_prefix = 'rsm_wp_';

define( 'DISALLOW_FILE_MODS', true );
define( 'DISALLOW_FILE_EDIT', true );