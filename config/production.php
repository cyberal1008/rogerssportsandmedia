<?php
define( 'DOMAIN_CURRENT_SITE', 'www.rogerssportsandmedia.com' );
// ** MySQL settings ** //
define( 'DB_NAME', getenv( 'RDM_RDS_DATABASE' ) );
define( 'DB_USER', getenv( 'RDM_RDS_USERNAME' ) );
define( 'DB_PASSWORD', getenv( 'RDM_RDS_PASSWORD' ) );
define( 'DB_HOST', getenv( 'RDM_RDS_URL' ) );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
define( 'MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL);
define( 'MYSQL_SSL_CA', '/etc/rdm_cloudops_ssl/rds-combined-ca-bundle.pem');
// define('COOKIE_DOMAIN', $_SERVER['HTTP_HOST']);
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_CACHE', true );

define( 'CONCATENATE_SCRIPTS', false );
define( 'SAVEQUERIES', true );
define( 'WP_SITEURL', 'https://' . DOMAIN_CURRENT_SITE );
define( 'WP_HOME', 'https://' . DOMAIN_CURRENT_SITE );
define( 'DISABLE_WP_CRON', true );

$redis_server = array(
	'host'     => getenv( 'RDM_ELASTICACHE_URL' ),
	'port'     => getenv( 'RDM_ELASTICACHE_PORT' ),
	'database' => getenv( 'RDM_ELASTICACHE_DATABASE' ),
);

define( 'WP_CACHE_KEY_SALT', 'RSM' );

$table_prefix = 'rsm_wp_';

define( 'DISALLOW_FILE_MODS', true );
define( 'DISALLOW_FILE_EDIT', true );

define( 'FORCE_SSL_ADMIN', true );
if ( $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}
