<?php
    elgg_register_event_handler('init', 'system', 'jQueryCDN_init');
 
    function jQueryCDN_init() {
        // Unregister Elgg's Jquery
        elgg_unregister_js('jquery');
        // Register CDN jQuery
        elgg_register_js('jquery-cdn', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js', 'head');
        // Load CDN jQuery
        elgg_load_js('jquery-cdn'); 
 
        // Unregister Elgg's Jquery UI
        elgg_unregister_js('jquery-ui');    
        // Register CDN jQuery UI
        elgg_register_js('jquery-ui-cdn', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js', 'head'); 
        // Load CDN jQuery UI
        elgg_load_js('jquery-ui-cdn');      
    }       
?>