<?php
/**
 * storys
 *
 * @package story
 *
 * @todo
 * - Either drop support for "publish date" or duplicate more entity getter
 * functions to work with a non-standard time_created.
 * - Pingbacks
 * - Notifications
 * - River entry for posts saved as drafts and later published
 */

elgg_register_event_handler('init', 'system', 'story_init');

/**
 * Init story plugin.
 */
function story_init() {

	elgg_register_library('elgg:story', elgg_get_plugins_path() . 'story/lib/story.php');

	// add a site navigation item
	$item = new ElggMenuItem('story', elgg_echo('story:storys'), 'story/all');
	elgg_register_menu_item('site', $item);

	elgg_register_event_handler('upgrade', 'upgrade', 'story_run_upgrades');

	// add to the main css
	elgg_extend_view('css/elgg', 'story/css');

	// register the story's JavaScript
	$story_js = elgg_get_simplecache_url('js', 'story/save_draft');
	elgg_register_simplecache_view('js/story/save_draft');
	elgg_register_js('elgg.story', $story_js);

	// routing of urls
	elgg_register_page_handler('story', 'story_page_handler');

	// override the default url to view a story object
	elgg_register_entity_url_handler('object', 'story', 'story_url_handler');

	// notifications - need to register for unique event because of draft/published status
	elgg_register_event_handler('publish', 'object', 'object_notifications');
	elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'story_notify_message');

	// add story link to
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'story_owner_block_menu');

	// pingbacks
	//elgg_register_event_handler('create', 'object', 'story_incoming_ping');
	//elgg_register_plugin_hook_handler('pingback:object:subtypes', 'object', 'story_pingback_subtypes');

	// Register for search.
	elgg_register_entity_type('object', 'story');

	// Add group option
	add_group_tool_option('story', elgg_echo('story:enablestory'), true);
	elgg_extend_view('groups/tool_latest', 'story/group_module');

	// add a story widget
	elgg_register_widget_type('story', elgg_echo('story'), elgg_echo('story:widget:description'));

	// register actions
	$action_path = elgg_get_plugins_path() . 'story/actions/story';
	elgg_register_action('story/save', "$action_path/save.php");
	elgg_register_action('story/auto_save_revision', "$action_path/auto_save_revision.php");
	elgg_register_action('story/delete', "$action_path/delete.php");

	// entity menu
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'story_entity_menu_setup');

	// ecml
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'story_ecml_views_hook');
}

/**
 * Dispatches story pages.
 * URLs take the form of
 *  All storys:       story/all
 *  User's storys:    story/owner/<username>
 *  Friends' story:   story/friends/<username>
 *  User's archives: story/archives/<username>/<time_start>/<time_stop>
 *  story post:       story/view/<guid>/<title>
 *  New post:        story/add/<guid>
 *  Edit post:       story/edit/<guid>/<revision>
 *  Preview post:    story/preview/<guid>
 *  Group story:      story/group/<guid>/all
 *
 * Title is ignored
 *
 * @todo no archives for all storys or friends
 *
 * @param array $page
 * @return bool
 */
function story_page_handler($page) {

	elgg_load_library('elgg:story');

	// forward to correct URL for story pages pre-1.8
	story_url_forwarder($page);

	// push all storys breadcrumb
	elgg_push_breadcrumb(elgg_echo('story:storys'), "story/all");

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	$page_type = $page[0];
	switch ($page_type) {
		case 'owner':
			$user = get_user_by_username($page[1]);
			if (!$user) {
				forward('', '404');
			}
			$params = story_get_page_content_list($user->guid);
			break;
		case 'friends':
			$user = get_user_by_username($page[1]);
			if (!$user) {
				forward('', '404');
			}
			$params = story_get_page_content_friends($user->guid);
			break;
		case 'archive':
			$user = get_user_by_username($page[1]);
			if (!$user) {
				forward('', '404');
			}
			$params = story_get_page_content_archive($user->guid, $page[2], $page[3]);
			break;
		case 'view':
			$params = story_get_page_content_read($page[1]);
			break;
		case 'read': // Elgg 1.7 compatibility
			register_error(elgg_echo("changebookmark"));
			forward("story/view/{$page[1]}");
			break;
		case 'add':
			gatekeeper();
			$params = story_get_page_content_edit($page_type, $page[1]);
			break;
		case 'edit':
			gatekeeper();
			$params = story_get_page_content_edit($page_type, $page[1], $page[2]);
			break;
		case 'group':
			$group = get_entity($page[1]);
			if (!elgg_instanceof($group, 'group')) {
				forward('', '404');
			}
			if (!isset($page[2]) || $page[2] == 'all') {
				$params = story_get_page_content_list($page[1]);
			} else {
				$params = story_get_page_content_archive($page[1], $page[3], $page[4]);
			}
			break;
		case 'all':
			$params = story_get_page_content_list();
			break;
		default:
			return false;
	}

	if (isset($params['sidebar'])) {
		$params['sidebar'] .= elgg_view('story/sidebar', array('page' => $page_type));
	} else {
		$params['sidebar'] = elgg_view('story/sidebar', array('page' => $page_type));
	}

	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}

/**
 * Format and return the URL for storys.
 *
 * @param ElggObject $entity story object
 * @return string URL of story.
 */
function story_url_handler($entity) {
	if (!$entity->getOwnerEntity()) {
		// default to a standard view if no owner.
		return FALSE;
	}

	$friendly_title = elgg_get_friendly_title($entity->title);

	return "story/view/{$entity->guid}/$friendly_title";
}

/**
 * Add a menu item to an ownerblock
 */
function story_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "story/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('story', elgg_echo('story'), $url);
		$return[] = $item;
	} else {
		if ($params['entity']->story_enable != "no") {
			$url = "story/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('story', elgg_echo('story:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
}

/**
 * Add particular story links/info to entity menu
 */
function story_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}

	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);
	if ($handler != 'story') {
		return $return;
	}

	if ($entity->status != 'published') {
		// draft status replaces access
		foreach ($return as $index => $item) {
			if ($item->getName() == 'access') {
				unset($return[$index]);
			}
		}

		$status_text = elgg_echo("story:status:{$entity->status}");
		$options = array(
			'name' => 'published_status',
			'text' => "<span>$status_text</span>",
			'href' => false,
			'priority' => 150,
		);
		$return[] = ElggMenuItem::factory($options);
	}

	return $return;
}

/**
 * Set the notification message body
 * 
 * @param string $hook    Hook name
 * @param string $type    Hook type
 * @param string $message The current message body
 * @param array  $params  Parameters about the story posted
 * @return string
 */
function story_notify_message($hook, $type, $message, $params) {
	$entity = $params['entity'];
	$to_entity = $params['to_entity'];
	$method = $params['method'];
	if (elgg_instanceof($entity, 'object', 'story')) {
		$descr = $entity->excerpt;
		$title = $entity->title;
		$owner = $entity->getOwnerEntity();
		return elgg_echo('story:notification', array(
			$owner->name,
			$title,
			$descr,
			$entity->getURL()
		));
	}
	return null;
}

/**
 * Register storys with ECML.
 */
function story_ecml_views_hook($hook, $entity_type, $return_value, $params) {
	$return_value['object/story'] = elgg_echo('story:storys');

	return $return_value;
}

/**
 * Upgrade from 1.7 to 1.8.
 */
function story_run_upgrades($event, $type, $details) {
	$story_upgrade_version = elgg_get_plugin_setting('upgrade_version', 'storys');

	if (!$story_upgrade_version) {
		 // When upgrading, check if the Elggstory class has been registered as this
		 // was added in Elgg 1.8
		if (!update_subtype('object', 'story', 'Elggstory')) {
			add_subtype('object', 'story', 'Elggstory');
		}

		elgg_set_plugin_setting('upgrade_version', 1, 'storys');
	}
}
