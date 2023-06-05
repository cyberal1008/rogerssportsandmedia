<?php
/**
 * Loads RSM template scripts & functions.
 *
 * @package rogerssportsandmedia.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$parent_includes = array(
	'/enqueue-rsm.php',                         // Enqueue scripts and styles for rogerssportsandmedia.com.
);

foreach ( $parent_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}
