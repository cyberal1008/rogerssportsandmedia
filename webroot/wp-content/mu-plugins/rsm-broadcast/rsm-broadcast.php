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

namespace RSM\Broadcast;


set_include_path( __DIR__ . '/models' );

spl_autoload_register( function ( $class_name ) {
	if ( false !== strpos( $class_name, __NAMESPACE__ ) ) {
		$classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR;
		// remove default namespace from the path
		$class_file = str_replace( __NAMESPACE__ . "\\", '', $class_name );
		$class_file = str_replace( '\\', DIRECTORY_SEPARATOR, $class_file ) . '.php';
		// echo $class_file;
		require_once $classes_dir . $class_file;
	}
} );

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
