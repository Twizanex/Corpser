<?php
/**
* Hello world plugin
*/
elgg_register_event_handler('init', 'system', 'stories_init');
function stories_init() {
  elgg_register_page_handler('story', 'story_page_handler');
  
  // add a menu item to primary site navigation
  $item = new ElggMenuItem('story', 'Stories', 'story/all');
  elgg_register_menu_item('site', $item);
  
  elgg_register_entity_url_handler('object', 'story', 'stories_url');
  
  // Register some actions
	$action_base = elgg_get_plugins_path() . 'corpser_stories/actions';
	elgg_register_action("story/edit", "$action_base/stories/edit.php");
	elgg_register_action("story/delete", "$action_base/stories/delete.php");
	elgg_register_action("annotations/story/delete", "$action_base/annotations/page/delete.php");
	
	// Extend the main css view
	elgg_extend_view('css/elgg', 'story/css');
	
	// Register javascript needed for sidebar menu
	$js_url = 'mod/pages/vendors/jquery-treeview/jquery.treeview.min.js';
	elgg_register_js('jquery-treeview', $js_url);
	$css_url = 'mod/pages/vendors/jquery-treeview/jquery.treeview.css';
	elgg_register_css('jquery-treeview', $css_url);
	
	// Register entity type for search
	elgg_register_entity_type('object', 'story');

	// Register granular notification for this type
	register_notification_object('object', 'story', elgg_echo('story:new'));
	elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'story_notify_message');
  
}
function story_page_handler($page, $identifier) {
  $plugin_path = elgg_get_plugins_path();
  $base_path = $plugin_path . 'corpser_stories/pages/stories';
// select page based on first URL segment after /hello/
  switch ($page[0]) {	
  case 'world':
    require "$base_path/story.php";
    break;
  default:
    echo "request for $identifier $page[0]";
  break;
}
// return true to let Elgg know that a page was sent to browser
return true;
}
