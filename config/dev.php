<?php
define( 'DOMAIN_CURRENT_SITE', 'int-www.rogerssportsandmedia.com' );
// ** MySQL settings ** //
define( 'DB_NAME', getenv( 'RDM_RDS_DATABASE' ) );
define( 'DB_USER', getenv( 'RDM_RDS_USERNAME' ) );
define( 'DB_PASSWORD', getenv( 'RDM_RDS_PASSWORD' ) );
define( 'DB_HOST', getenv( 'RDM_RDS_URL' ) );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
// define('COOKIE_DOMAIN', $_SERVER['HTTP_HOST']);
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_CACHE', true );

define( 'CONCATENATE_SCRIPTS', false );
define( 'SAVEQUERIES', true );
define( 'WP_SITEURL', 'https://' . DOMAIN_CURRENT_SITE );
define( 'WP_HOME', 'https://' . DOMAIN_CURRENT_SITE );
define( 'DISABLE_WP_CRON', true );

define( 'WP_REDIS_HOST', getenv( 'REDIS_HOST' ) );
define( 'WP_REDIS_PORT', getenv( 'RDM_REDIS_PORT' ) );
define( 'WP_REDIS_DATABASE', getenv( 'RDM_REDIS_DATABASE' ) );
define( 'WP_CACHE_KEY_SALT', 'RSM' );


$table_prefix = 'rsm_wp_';

define( 'FORCE_SSL_ADMIN', true );
if ( $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}
