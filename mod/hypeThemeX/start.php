<?php

/**
 * Responsive Theme for Elgg
 *
 * @package hypeJunction
 * @subpackage ThemeX
 *
 * @author Ismayil Khayredinov <ismayil.khayredinov@gmail.com>
 */

namespace hypeJunction\ThemeX;

const PLUGIN_ID = 'hypeThemeX';

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');
elgg_register_event_handler('pagesetup', 'system', __NAMESPACE__ . '\\setup_menus', 999);

/**
 * Initialize the plugin
 */
function init() {

	if (elgg_in_context('admin')) {
		return;
	}

	elgg_extend_view('css/elgg', 'css/theme/custom', 999);
	elgg_extend_view('css/elgg', 'css/theme/plugins', 999);

	elgg_extend_view('page/elements/head', 'framework/fonts/font-awesome');
	elgg_extend_view('page/elements/head', 'framework/fonts/open-sans');
	elgg_extend_view('page/elements/head', 'framework/metatags/viewport');

	elgg_unextend_view('page/elements/header', 'search/header');

	elgg_register_js('modernizr', '/mod/' . PLUGIN_ID . '/vendors/foundation/js/vendor/modernizr.js', 'head', 100);
	elgg_register_js('fastclick', '/mod/' . PLUGIN_ID . '/vendors/foundation/js/vendor/fastclick.js', 'head', 110);

	elgg_register_js('jquery', '/mod/' . PLUGIN_ID . '/vendors/jquery/js/jquery-1.11.0.min.js', 'head', 120);
	elgg_register_js('jquery-migrate', '/mod/' . PLUGIN_ID . '/vendors/jquery/js/jquery-migrate-1.2.1.min.js', 'head', 130);
	elgg_register_js('jquery-ui', '/mod/' . PLUGIN_ID . '/vendors/jquery/js/jquery-ui-1.10.4.min.js', 'head', 140);
	elgg_register_css('jquery-ui', '/mod/' . PLUGIN_ID . '/vendors/jquery/css/smoothness/jquery-ui-1.10.4.min.css');

	elgg_register_js('foundation', '/mod/' . PLUGIN_ID . '/vendors/foundation/js/foundation.min.js', 'footer', 200);

	elgg_register_simplecache_view('js/theme/init');
	elgg_register_js('elgg.theme', elgg_get_simplecache_url('js', 'theme/init'), 'footer', 900);

	elgg_load_js('modernizr');
	elgg_load_js('fastclick');

	elgg_load_js('jquery'); // Foundation needs higher version of jquery than that in Elgg
	elgg_load_js('jquery-migrate');
	elgg_load_js('jquery-ui');

	elgg_load_js('foundation'); // loads Foundation js

	elgg_load_js('elgg.theme');
	elgg_load_css('jquery-ui');
}

/**
 * Customize the topbar menu so that it works with Foundation
 */
function setup_menus() {

	elgg_unregister_menu_item('topbar', 'elgg_logo');

	elgg_register_menu_item('topbar', array(
		'name' => 'logo',
		'href' => false,
		'text' => elgg_view('page/elements/topbar_logo'),
		'item_class' => 'name',
		'section' => 'title-area',
	));

	elgg_register_menu_item('topbar', array(
		'name' => 'toggle',
		'href' => '#',
		'text' => elgg_echo('menu'),
		'item_class' => 'toggle-topbar menu-icon',
		'priority' => 900,
		'section' => 'title-area',
	));

	if (elgg_is_admin_logged_in()) {
		$counter = '';
		$admin_notices = elgg_get_entities(array(
			'types' => 'object',
			'subtypes' => 'admin_notice',
			'count' => true
		));
		if ($admin_notices) {
			$counter = '<span class="messages-new">' . $admin_notices . '</span>';
		}
		elgg_register_menu_item('topbar', array(
			'name' => 'administration',
			'href' => 'admin',
			'text' => elgg_view_icon('dashboard') . elgg_echo('admin') . $counter,
			'priority' => 100,
			'section' => 'alt',
		));
	}
}
