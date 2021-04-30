<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           RSM Broadcast
 *
 * @wordpress-plugin
 * Plugin Name:       RSM Broadcast
 * Plugin URI:        https://github.com/digitalmedia/rogerssportsandmedia/tree/master/webroot/wp-content/mu-plugins/rsm-Broadcast
 * Description:       Custom Post types taxonomies for RSM Broadcast"
 * Version:           1.0.0
 * Author:            Rogers Sports and Media
 * Author URI:        https://github.com/phillipsv
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rdm-Broadcast
 */

use RSM\Broadcast\Plugin;

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

\define( 'RSM_BROADCAST_LOCALE', 'rsm-broadcast' );
\define( 'RSM_BROADCAST_VERSION', '1.0.0' );

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */

$plugin = new Plugin();
$plugin->run();
