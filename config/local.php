<?php
define( 'DOMAIN_CURRENT_SITE', 'local-www.rogerssportsandmedia.com' );
// ** MySQL settings ** //
define( 'DB_NAME', 'rogerssportsandmedia' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'root' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
define( 'COOKIE_DOMAIN', $_SERVER['HTTP_HOST'] );

define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', true );
define( 'WP_CACHE', true );

define( 'CONCATENATE_SCRIPTS', false );
define( 'SAVEQUERIES', true );
define( 'WP_SITEURL', 'http://' . DOMAIN_CURRENT_SITE );
define( 'WP_HOME', 'http://' . DOMAIN_CURRENT_SITE );
define( 'DISABLE_WP_CRON', true );

define( 'WP_REDIS_HOST', '127.0.0.1' );
define( 'WP_REDIS_PORT', '6379' );
define( 'WP_REDIS_DATABASE', '2' );
define( 'WP_CACHE_KEY_SALT', 'RSM' );

define('SCRIPT_DEBUG', true);

$table_prefix = 'rsm_wp_';

define( 'DISALLOW_FILE_MODS', true );
define( 'DISALLOW_FILE_EDIT', true );