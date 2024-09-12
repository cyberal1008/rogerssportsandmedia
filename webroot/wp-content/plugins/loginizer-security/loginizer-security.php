<?php
/*
Plugin Name: Loginizer Security
Plugin URI: https://loginizer.com
Description: Loginizer is a WordPress plugin which helps you fight against bruteforce attack by blocking login for the IP after it reaches maximum retries allowed. You can blacklist or whitelist IPs for login using Loginizer.
Version: 1.9.1
Text Domain: loginizer
Author: Softaculous
Author URI: https://www.loginizer.com
License: LGPLv2.1
*/

/*
Copyright (C) 2013 Loginizer (email : support@loginizer.com)
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if(!function_exists('add_action')){
	echo 'You are not allowed to access this page directly.';
	exit;
}

// Plugin already loaded
if(defined('LOGINIZER_PREMIUM')){
	return;
}

// TODO:: Add Require Plugins in the WordPress plugin comment, to make loginizer-security dependent on the free version.
$_tmp_plugins = get_option('active_plugins');
$_lz_version = get_option('loginizer_version');

function loginizer_pro_is_network_active($plugin){
	$is_network_wide = false;
	
	// Handling network site
	if(!is_multisite()){
		return $is_network_wide;
	}
	
	$_tmp_plugins = get_site_option('active_sitewide_plugins');

	if(!empty($_tmp_plugins) && preg_grep('/.*\/'.$plugin.'\.php$/', array_keys($_tmp_plugins))){
		$is_network_wide = true;
	}
	
	return $is_network_wide;
}

$req_free_update = !empty($_lz_version) && version_compare($_lz_version, '1.8.9', '<');

if(
	!defined('SITEPAD') && (
	!(in_array('loginizer/loginizer.php', $_tmp_plugins) || 
	loginizer_pro_is_network_active('loginizer')) || 
	!file_exists(WP_PLUGIN_DIR . '/loginizer/loginizer.php') || 
	!empty($req_free_update) )
){
	add_action('plugins_loaded', 'loginizer_pro_load_updater');

	function loginizer_pro_load_updater(){

		// Nag informing the user to install the free version.
		if(current_user_can('activate_plugins')){
			add_action('admin_notices', 'loginizer_pro_free_version_nag', 9);
			add_action('admin_menu', 'loginizer_pro_add_menu', 9);
		}
		
		$is_network_wide = loginizer_pro_is_network_active('loginizer-security');
		$_lz_version = get_option('loginizer_version');
		$req_free_update = !empty($_lz_version) && version_compare($_lz_version, '1.8.9', '<');
		
		if($is_network_wide){
			$free_installed = get_site_option('loginizer_free_installed');
		}else{
			$free_installed = get_option('loginizer_free_installed');
		}
		
		if(!empty($free_installed)){
			return;
		}
		
		// Include the necessary stuff
		include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
		include_once(ABSPATH . 'wp-admin/includes/plugin.php');
		include_once(ABSPATH . 'wp-admin/includes/file.php');
		
		if(file_exists(WP_PLUGIN_DIR . '/loginizer/loginizer.php') && is_plugin_inactive('/loginizer/loginizer.php') && empty($req_free_update)) {
			
			if($is_network_wide){
				update_site_option('loginizer_free_installed', time());
			}else{
				update_option('loginizer_free_installed', time());
			}
			
			activate_plugin('loginizer/loginizer.php', '', $is_network_wide);
			remove_action('admin_notices', 'loginizer_pro_free_version_nag', 9);
			remove_action('admin_menu', 'loginizer_pro_add_menu', 9);
			return;
		}
		
		// Includes necessary for Plugin_Upgrader and Plugin_Installer_Skin
		include_once(ABSPATH . 'wp-admin/includes/misc.php');
		include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

		// Filter to prevent the activate text
		add_filter('install_plugin_complete_actions', 'loginizer_pro_prevent_activation_text', 10, 3);

		$upgrader = new Plugin_Upgrader(new WP_Ajax_Upgrader_Skin());
		
		// Upgrade the plugin to the latest version of free already installed.
		if(!empty($req_free_update) && file_exists(WP_PLUGIN_DIR . '/loginizer/loginizer.php')){
			$installed = $upgrader->upgrade('loginizer/loginizer.php');
		}else{
			$installed = $upgrader->install('https://downloads.wordpress.org/plugin/loginizer.zip');
		}
		
		if(!is_wp_error($installed) && $installed){
			
			if($is_network_wide){
				update_site_option('loginizer_free_installed', time());
			}else{
				update_option('loginizer_free_installed', time());
			}
			
			activate_plugin('loginizer/loginizer.php', '', $is_network_wide);
			remove_action('admin_notices', 'loginizer_pro_free_version_nag', 9);
			remove_action('admin_menu', 'loginizer_pro_add_menu', 9);
		}
	}
	
	// Do not shows the activation text if 
	function loginizer_pro_prevent_activation_text($install_actions, $api, $plugin_file){
		if($plugin_file == 'loginizer/loginizer.php'){
			return array();
		}

		return $install_actions;
	}

	function loginizer_pro_free_version_nag(){
		
		$lz_version = get_option('loginizer_version');
		
		$lower_version = __('You have not installed the free version of Loginizer. Loginizer Security depends on the free version, so you must install it first in order to use Loginizer Security.');
		
		if(!empty($lz_version) && version_compare($lz_version, '1.8.9', '<')){
			$lower_version = __('You are using an older version of the free version of Loginizer, please update Loginizer to work without any issues');
		}

		echo '<div class="notice notice-error">
			<p style="font-size:16px;">'.esc_html($lower_version).' <a href="'.admin_url('plugin-install.php?s=loginizer&tab=search').'" class="button button-primary">Install/Update Now</a></p>
		</div>';
	}

	function loginizer_pro_add_menu(){
		add_menu_page('Loginizer Security', 'Loginizer Security', 'activate_plugins', 'loginizer-security', 'loginizer_pro_menu_page');
	}

	function loginizer_pro_menu_page(){
		echo '<div style="color: #333;padding: 50px;text-align: center;">
			<h1 style="font-size: 2em;margin-bottom: 10px;">Loginizer Free version is not installed / outdated!</h>
			<p style=" font-size: 16px;margin-bottom: 20px; font-weight:400;">Loginizer Security depends on the free version of Loginizer, so you need to install / update the free version first.</p>
			<a href="'.admin_url('plugin-install.php?s=loginizer&tab=search').'" style="text-decoration: none;font-size:16px;">Install/Update Now</a>
		</div>';
	}
	
	return;
}

function loginizer_security_load_plugin_textdomain(){
    load_plugin_textdomain( 'loginizer', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

add_action( 'plugins_loaded', 'loginizer_security_load_plugin_textdomain' );

define('LOGINIZER_PRO_FILE', __FILE__);
define('LOGINIZER_PREMIUM', __FILE__);

include_once(dirname(__FILE__).'/init.php');