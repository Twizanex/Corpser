<?php
/**
 * Elgg containers plugin
 *
 * @package Elggcontainers
 */
    elgg_register_event_handler('init', 'system', 'containers_init');

/**
 * Initialise containers plugin
 *
 */
function containers_init() {
    $root = dirname(__FILE__);
	//elgg_register_js('jquery', 'mod/containers/vendor/jquery-1.10.2.js');
	//elgg_register_js('jqueryui', 'mod/containers/vendor/jquery-ui-1.10.4.custom.js');
	//elgg_register_css('jqueryui', 'mod/containers/vendor/jquery-ui-1.10.4.custom.css');
	//elgg_register_js('baloon', 'mod/containers/vendor/jsbaloon.js');
	elgg_register_js("jquery.nouislider", elgg_get_site_url() . "mod/pages_tools/vendors/slider/jquery.nouislider.js");
	elgg_register_css("jquery.nouislider", elgg_get_site_url() . "mod/pages_tools/vendors/slider/jquery.nouislider.css");
	
   	elgg_extend_view('css/elgg', 'containers/css');
    elgg_extend_view('object/summary/extend', 'output/containers', 0);
    elgg_unregister_action('bookmarks/save');
    elgg_unregister_action('bl	og/save');
    $action_path = "$root/actions/bookmarks";
    elgg_register_action('bookmarks/save', "$action_path/save.php");
    $action_path = "$root/actions/blog";
    elgg_register_action('blog/save', "$action_path/save.php");
}
