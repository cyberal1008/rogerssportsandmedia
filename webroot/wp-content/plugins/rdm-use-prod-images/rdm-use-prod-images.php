<?php
/**
 * Plugin Name:       RDM Use Production Images
 * Description:       Allow Sandbox Envs to Use Production Images 
 * Version:           1.0
 * Author:            Rogers Sports and Media
 * Author URI:        https://github.com/phillipsv
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

 // Allow images to be loaded from the assets[1-4] subdomain in order to parallelize content loading on the site.
// NOTE: Set up to only occur on the staging and production environments.
function modify_attachment_url_subdomain( $url, $id ) {
	global $str_active_env;

	// We may change this value, so create a new one that's not the global value.
	$str_image_env = $str_active_env;

	// If on the production environment, return the regular URL
	// and exit immediately.
	if ( $str_image_env == 'prod' ) {
		return $url;
	}else{
    // we are on a sandbox env, let's set the image env to prod
        $str_image_env = 'prod';
    }

	// Get the first letter of the file to use to select what subdomain to load from.
	$arr_url = parse_url($url);
	if ( !isset($arr_url['path']) ) {
		return $url;
	}
	$arr_path = explode('/', $arr_url['path']);
	$str_filename = end($arr_path);
	$str_firstletter = $str_filename[0];

	// Figure out the domain of the site by popping off the first section (the subdomain).
	$arr_domain = explode('.', $arr_url['host']);
	array_shift($arr_domain);
	$str_domain = implode('.', $arr_domain);

	// Pick a number between 1 and 4 based on the first letter of the file (and 1 for anything not listed).
    $num_asset_domain = 1;
    $arr_alphabet = array('a' => '1', 'b' => '2', 'c' => '3', 'd' => '4', 'e' => '1', 'f' => '2', 'g' => '3', 'h' => '4', 'i' => '1', 'j' => '2', 'k' => '3', 'l' => '4', 'm' => '1', 'n' => '2', 'o' => '3', 'p' => '4', 'q' => '1', 'r' => '2', 's' => '3', 't' => '4', 'u' => '1', 'v' => '2', 'w' => '3', 'x' => '4', 'y' => '1', 'z' => '2');
    if ( isset($arr_alphabet[$str_firstletter]) ) {
    	$num_asset_domain = $arr_alphabet[$str_firstletter];
    }

    // TODO: Re-enable this when asset subdomains are set up for these sites.
    // Set the updated host.
    $arr_url['host'] = 'www' . '.' . $str_domain;

    // Rejoin the URL together as a single string and return it.
    return unparse_url($arr_url);
}
function unparse_url( $parsed_url ) {
	$scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
	$host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
	$port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
	$user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
	$pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
	$pass     = ($user || $pass) ? "$pass@" : '';
	$path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
	$query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
	$fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';

	return "$scheme$user$pass$host$port$path$query$fragment";
}
// Replace srcset paths
add_filter('wp_calculate_image_srcset', function($sources)
{
	foreach($sources as &$source) 
	{
		if(!file_exists($source['url'])) 
		{
			$source['url'] = modify_attachment_url_subdomain( $source['url'], $id=null );
		}
	}
	return $sources;
});
// Replace attachment path
add_filter('wp_get_attachment_url', 'modify_attachment_url_subdomain', 10, 2);