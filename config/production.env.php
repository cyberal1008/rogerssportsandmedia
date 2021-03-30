<?php
define('DOMAIN_CURRENT_SITE', 'www.rogerssportsandmedia.com');

$_env = array(
    'DB_HOST'     => '',
    'DB_NAME'     => '',
    'DB_USER'     => '',
    'DB_PASSWORD' => '',

    # These WP_DEBUG* constants could be enabled if we know an Administrator is logged into WordPress; but for now we should just always have them turned off
    'WP_DEBUG' => false,         # use production environment defaults for displaying errors (all should be turned off)
    'WP_DEBUG_DISPLAY' => false, # errors should never be displayed on production (redundant w/ WP_DEBUG=false, but re-emphasizes point)
    'WP_DEBUG_LOG' => false,     # when true, errors are be logged to wp-content/debug.log (this bad; again, redundant w/ WP_DEBUG=false); the VirtualHost config should specify where errors are logged to
    'SCRIPT_DEBUG' => isset($_GET['debug']),
    'CONCATENATE_SCRIPTS' => !isset($_GET['debug']),
    'WP_CACHE' => !isset($_GET['debug']),
    'COMPRESS_SCRIPTS' => !isset($_GET['debug']),
    'COMPRESS_CSS' => !isset($_GET['debug']),
    'SAVEQUERIES' => false,
		'DISABLE_WP_CRON' => true,

    'WP_SITEURL' => 'https://' . DOMAIN_CURRENT_SITE,
    'WP_HOME' => 'https://' . DOMAIN_CURRENT_SITE,

    'AUTOMATIC_UPDATER_DISABLED' => true,

    'RDM_STREAMS_MONTH_LIMIT' => '2',

    'redis_server' => array(
        'host' => '',
        'port' => '',
        'site' => 'FLR',
        'database' => 2,
    ),

    'WP_REDIS_DISABLE_FAILBACK_FLUSH' => true,
    'WP_CACHE' => true,
    'batcache' => array(
    	// Expire batcache items aged this many seconds (zero to disable batcache)
    	'max_age' => 300,
    	// Zero disables sending buffers to remote datacenters (req/sec is never sent)
    	'remote' => 0,
    	// Only batcache a page after it is accessed this many times... (two or more)
    	'times' => 0,
    	// ...in this many seconds (zero to ignore this and use batcache immediately)
    	'seconds' => 0,
    	// Name of memcached group. You can simulate a cache flush by changing this.
    	'group' => 'batcache',
    	// If you conditionally serve different content, put the variable values here.
    	'unique' => array(),
    	// Add headers here. These will be sent with every response from the cache.
    	'headers' => array(),
    	// Set true to enable redirect caching.
    	'cache_redirects' => false,
    	// This is set to the response code during a redirect.
    	'redirect_status' => false,
    	// This is set to the redirect location.
    	'redirect_location' => false,
    	// These headers will never be cached. Apply strtolower.
    	'uncached_headers' => array('transfer-encoding'),
    	// Set false to hide the batcache info <!-- comment -->
    	'debug' => true,
    	// Set false to disable Last-Modified and Cache-Control headers
    	'cache_control' => true,
    	// Change this to cancel the output buffer. Use batcache_cancel();
    	'cancel' => false,
    ),
);

$_SERVER['HTTPS'] = 'on';

// Allow these default dev settings to be overridden locally by a config that is not committed
$active_env = trim (file_get_contents(dirname(__FILE__) . "/active-env"));
if( file_exists(dirname(__FILE__) . "/{$active_env}-overrides.env.php") ){
    $override = include "{$active_env}-overrides.env.php" ;
    $_env = array_merge($_env, $override);
    }


return $_env;


