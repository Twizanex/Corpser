<?php
/**
 * PreLoadMe
 */

elgg_register_event_handler('init', 'system', 'preloadme_init');

function preloadme_init() {

	elgg_extend_view('css/elgg', 'preloadme/css');
	elgg_extend_view('page/elements/body','preloadme/preloader',100);
	elgg_extend_view('page/elements/footer','preloadme/script');

}