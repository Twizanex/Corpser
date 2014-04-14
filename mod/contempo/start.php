<?php

elgg_register_event_handler('init', 'system', 'contempo_init');

function contempo_init() {
    global $CONFIG;
    elgg_register_css('contempo',$CONFIG->url.'mod/contempo/css/contempo.css');
    elgg_load_css('contempo');
    elgg_extend_view('page/elements/header','contempo/header');
    elgg_register_css('lobster','http://localhost/sites/elgg/lobster.css');
    elgg_load_css('lobster');
    elgg_register_css('arimo','http://fonts.googleapis.com/css?family=Lato');
    elgg_load_css('arimo');
	
	$item = new ElggMenuItem('notifications', '<img src="http://localhost/sites/elgg/icon2.png">', 'live_notifications/all');
	elgg_register_menu_item('site', $item);
	$item2 = new ElggMenuItem('messages', '<img src="http://localhost/sites/elgg/icon3.png">', 'messages');
	elgg_register_menu_item('site', $item2);
}
?>
