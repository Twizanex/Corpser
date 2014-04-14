<?php
/**
 * Describe plugin here
 */

elgg_register_event_handler('init', 'system', 'easy_tabs_init');

function easy_tabs_init() {

	// Extend the main CSS file
    elgg_extend_view('css/elgg', 'easy_tabs/css');
      
    elgg_register_js('jquery-haschange', elgg_get_site_url().'mod/easy_tabs/vendors/jquery.hashchange.min.js', 'head');
    elgg_register_js('jquery-1-7-1-min', elgg_get_site_url().'mod/easy_tabs/vendors/jquery-1.7.1.min.js', 'head');

   elgg_register_js('jquery-easytabs', elgg_get_site_url().'mod/easy_tabs/vendors/jquery.easytabs.js', 'head');
 
    $tabs_js = elgg_get_simplecache_url('js', 'easy_tabs/tabs');
    elgg_register_simplecache_view('js/easy_tabs/tabs');
    elgg_register_js('comhype_tabs_js', $tabs_js, 'head');
        
}
