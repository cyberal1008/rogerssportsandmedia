<?php
define( 'DOMAIN_CURRENT_SITE', 'int-www.rogerssportsandmedia.com' );
// ** MySQL settings ** //
define( 'DB_NAME', RDM_RDS_DATABASE );
define( 'DB_USER', RDM_RDS_USERNAME );
define( 'DB_PASSWORD', RDM_RDS_PASSWORD );
define( 'DB_HOST', RDM_RDS_URL );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
define( 'COOKIE_DOMAIN', $_SERVER['HTTP_HOST'] );

define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_CACHE', true );

define( 'CONCATENATE_SCRIPTS', false );
define( 'SAVEQUERIES', true );
define( 'WP_SITEURL', 'http://' . DOMAIN_CURRENT_SITE );
define( 'WP_HOME', 'http://' . DOMAIN_CURRENT_SITE );
define( 'DISABLE_WP_CRON', true );

$redis_server = array(
	'host'     => '' . REDIS_HOST,
	'port'     => RDM_REDIS_PORT,
	'site'     => 'RSM',
	'database' => RDM_REDIS_DATABASE,
);

$table_prefix = 'rsm_wp_';
