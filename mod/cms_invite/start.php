<?php

elgg_register_event_handler('init', 'system', 'cms_invite_init');

/**
 * Initialize the cms_invite_friend plugin.
 */
function cms_invite_init() {
	
	elgg_unregister_action('register');
	$filename =  elgg_get_plugins_path() . "cms_invite/actions/register.php";
	elgg_register_action('register', $filename, 'public');	
	
	elgg_register_library('elgg:cms_invite_users', elgg_get_plugins_path() . 'cms_invite/lib/users.php');	
	elgg_load_library('elgg:cms_invite_users');
	
	elgg_extend_view('css/elgg', 'cms_invite/css');
    elgg_extend_view('icon/user/default','cms_invite/icon');
    
    // Register a page handler, so we can have nice URLs
	elgg_register_page_handler('cms_invite','cms_invite_page_handler');
    
}

function cms_invite_page_handler($page){

	$base = elgg_get_plugins_path() . 'cms_invite/pages/cms_invite';

	switch ($page[0]) {
		case 'invited':
			set_input('username', $page[1]);
			require_once "$base/invited.php";
			break;

	}
	return true;
}