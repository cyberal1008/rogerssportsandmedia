<?php

if(!defined('ABSPATH')){
	die('HACKING ATTEMPT');
}

// ==== Actions ====
add_action('wp_ajax_loginizer_pro_version_notice', 'loginizer_pro_version_notice');


// ==== FUNCTIONS ====
function loginizer_pro_version_notice(){
	check_admin_referer('loginizer_version_notice', 'security');

	if(!current_user_can('activate_plugins')){
		wp_send_json_error(__('You do not have required access to do this action', 'loginizer'));
	}
	
	$type = '';
	if(!empty($_REQUEST['type'])){
		$type = sanitize_text_field(wp_unslash($_REQUEST['type']));
	}

	if(empty($type)){
		wp_send_json_error(__('Unknow version difference type', 'loginizer'));
	}
	
	update_option('loginizer_version_'. $type .'_nag', time() + WEEK_IN_SECONDS);
	wp_send_json_success();
}