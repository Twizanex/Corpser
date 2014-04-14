<?php
/**
 * Blog helper functions
 *
 * @package Blog
 */


/**
 * Get page components to view a story post.
 *
 * @param int $guid GUID of a story entity.
 * @return array
 */
function story_get_page_content_read($guid = NULL) {

	$return = array();

	$story = get_entity($guid);

	// no header or tabs for viewing an individual story
	$return['filter'] = '';

	if (!elgg_instanceof($story, 'object', 'story')) {
		register_error(elgg_echo('noaccess'));
		$_SESSION['last_forward_from'] = current_page_url();
		forward('');
	}

	$return['title'] = $story->title;

	$container = $story->getContainerEntity();
	$crumbs_title = $container->name;
	if (elgg_instanceof($container, 'group')) {
		elgg_push_breadcrumb($crumbs_title, "story/group/$container->guid/all");
	} else {
		elgg_push_breadcrumb($crumbs_title, "story/owner/$container->username");
	}

	elgg_push_breadcrumb($story->title);
	$return['content'] = elgg_view_entity($story, array('full_view' => true));
	// check to see if we should allow comments
	if ($story->comments_on != 'Off' && $story->status == 'published') {
		$return['content'] .= elgg_view_comments($story);
	}

	return $return;
}

/**
 * Get page components to list a user's or all storys.
 *
 * @param int $container_guid The GUID of the page owner or NULL for all storys
 * @return array
 */
function story_get_page_content_list($container_guid = NULL) {

	$return = array();

	$return['filter_context'] = $container_guid ? 'mine' : 'all';

	$options = array(
		'type' => 'object',
		'subtype' => 'story',
		'full_view' => false,
	);

	$current_user = elgg_get_logged_in_user_entity();

	if ($container_guid) {
		// access check for closed groups
		group_gatekeeper();

		$options['container_guid'] = $container_guid;
		$container = get_entity($container_guid);
		if (!$container) {

		}
		$return['title'] = elgg_echo('story:title:user_storys', array($container->name));

		$crumbs_title = $container->name;
		elgg_push_breadcrumb($crumbs_title);

		if ($current_user && ($container_guid == $current_user->guid)) {
			$return['filter_context'] = 'mine';
		} else if (elgg_instanceof($container, 'group')) {
			$return['filter'] = false;
		} else {
			// do not show button or select a tab when viewing someone else's posts
			$return['filter_context'] = 'none';
		}
	} else {
		$return['filter_context'] = 'all';
		$return['title'] = elgg_echo('story:title:all_storys');
		elgg_pop_breadcrumb();
		elgg_push_breadcrumb(elgg_echo('story:storys'));
	}

	elgg_register_title_button();

	// show all posts for admin or users looking at their own storys
	// show only published posts for other users.
	$show_only_published = true;
	if ($current_user) {
		if (($current_user->guid == $container_guid) || $current_user->isAdmin()) {
			$show_only_published = false;
		}
	}
	if ($show_only_published) {
		$options['metadata_name_value_pairs'] = array(
			array('name' => 'status', 'value' => 'published'),
		);
	}

	$list = elgg_list_entities_from_metadata($options);
	if (!$list) {
		$return['content'] = elgg_echo('story:none');
	} else {
		$return['content'] = $list;
	}

	return $return;
}

/**
 * Get page components to list of the user's friends' posts.
 *
 * @param int $user_guid
 * @return array
 */
function story_get_page_content_friends($user_guid) {

	$user = get_user($user_guid);
	if (!$user) {
		forward('story/all');
	}

	$return = array();

	$return['filter_context'] = 'friends';
	$return['title'] = elgg_echo('story:title:friends');

	$crumbs_title = $user->name;
	elgg_push_breadcrumb($crumbs_title, "story/owner/{$user->username}");
	elgg_push_breadcrumb(elgg_echo('friends'));

	elgg_register_title_button();

	if (!$friends = get_user_friends($user_guid, ELGG_ENTITIES_ANY_VALUE, 0)) {
		$return['content'] .= elgg_echo('friends:none:you');
		return $return;
	} else {
		$options = array(
			'type' => 'object',
			'subtype' => 'story',
			'full_view' => FALSE,
		);

		foreach ($friends as $friend) {
			$options['container_guids'][] = $friend->getGUID();
		}

		// admin / owners can see any posts
		// everyone else can only see published posts
		$show_only_published = true;
		$current_user = elgg_get_logged_in_user_entity();
		if ($current_user) {
			if (($user_guid == $current_user->guid) || $current_user->isAdmin()) {
				$show_only_published = false;
			}
		}
		if ($show_only_published) {
			$options['metadata_name_value_pairs'][] = array(
				array('name' => 'status', 'value' => 'published')
			);
		}

		$list = elgg_list_entities_from_metadata($options);
		if (!$list) {
			$return['content'] = elgg_echo('story:none');
		} else {
			$return['content'] = $list;
		}
	}

	return $return;
}

/**
 * Get page components to show storys with publish dates between $lower and $upper
 *
 * @param int $owner_guid The GUID of the owner of this page
 * @param int $lower      Unix timestamp
 * @param int $upper      Unix timestamp
 * @return array
 */
function story_get_page_content_archive($owner_guid, $lower = 0, $upper = 0) {

	$now = time();

	$owner = get_entity($owner_guid);
	elgg_set_page_owner_guid($owner_guid);

	$crumbs_title = $owner->name;
	if (elgg_instanceof($owner, 'user')) {
		$url = "story/owner/{$owner->username}";
	} else {
		$url = "story/group/$owner->guid/all";
	}
	elgg_push_breadcrumb($crumbs_title, $url);
	elgg_push_breadcrumb(elgg_echo('story:archives'));

	if ($lower) {
		$lower = (int)$lower;
	}

	if ($upper) {
		$upper = (int)$upper;
	}

	$options = array(
		'type' => 'object',
		'subtype' => 'story',
		'full_view' => FALSE,
	);

	if ($owner_guid) {
		$options['container_guid'] = $owner_guid;
	}

	// admin / owners can see any posts
	// everyone else can only see published posts
	if (!(elgg_is_admin_logged_in() || (elgg_is_logged_in() && $owner_guid == elgg_get_logged_in_user_guid()))) {
		if ($upper > $now) {
			$upper = $now;
		}

		$options['metadata_name_value_pairs'] = array(
			array('name' => 'status', 'value' => 'published')
		);
	}

	if ($lower) {
		$options['created_time_lower'] = $lower;
	}

	if ($upper) {
		$options['created_time_upper'] = $upper;
	}

	$list = elgg_list_entities_from_metadata($options);
	if (!$list) {
		$content = elgg_echo('story:none');
	} else {
		$content = $list;
	}

	$title = elgg_echo('date:month:' . date('m', $lower), array(date('Y', $lower)));

	return array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
}

/**
 * Get page components to edit/create a story post.
 *
 * @param string  $page     'edit' or 'new'
 * @param int     $guid     GUID of story post or container
 * @param int     $revision Annotation id for revision to edit (optional)
 * @return array
 */
function story_get_page_content_edit($page, $guid = 0, $revision = NULL) {

	elgg_load_js('elgg.story');

	$return = array(
		'filter' => '',
	);

	$vars = array();
	$vars['id'] = 'story-post-edit';
	$vars['class'] = 'elgg-form-alt';

	$sidebar = '';
	if ($page == 'edit') {
		$story = get_entity((int)$guid);

		$title = elgg_echo('story:edit');

		if (elgg_instanceof($story, 'object', 'story') && $story->canEdit()) {
			$vars['entity'] = $story;

			$title .= ": \"$story->title\"";

			if ($revision) {
				$revision = elgg_get_annotation_from_id((int)$revision);
				$vars['revision'] = $revision;
				$title .= ' ' . elgg_echo('story:edit_revision_notice');

				if (!$revision || !($revision->entity_guid == $guid)) {
					$content = elgg_echo('story:error:revision_not_found');
					$return['content'] = $content;
					$return['title'] = $title;
					return $return;
				}
			}

			$body_vars = story_prepare_form_vars($story, $revision);

			elgg_push_breadcrumb($story->title, $story->getURL());
			elgg_push_breadcrumb(elgg_echo('edit'));
			
			elgg_load_js('elgg.story');

			$content = elgg_view_form('story/save', $vars, $body_vars);
			$sidebar = elgg_view('story/sidebar/revisions', $vars);
		} else {
			$content = elgg_echo('story:error:cannot_edit_post');
		}
	} else {
		elgg_push_breadcrumb(elgg_echo('story:add'));
		$body_vars = story_prepare_form_vars(null);

		$title = elgg_echo('story:add');
		$content = elgg_view_form('story/save', $vars, $body_vars);
	}

	$return['title'] = $title;
	$return['content'] = $content;
	$return['sidebar'] = $sidebar;
	return $return;	
}

/**
 * Pull together story variables for the save form
 *
 * @param ElggBlog       $post
 * @param ElggAnnotation $revision
 * @return array
 */
function story_prepare_form_vars($post = NULL, $revision = NULL) {

	// input names => defaults
	$values = array(
		'title' => NULL,
		'description' => NULL,
		'status' => 'published',
		'access_id' => ACCESS_DEFAULT,
		'comments_on' => 'On',
		'excerpt' => NULL,
		'tags' => NULL,
		'container_guid' => NULL,
		'storytype' => NULL,
		'guid' => NULL,
		'draft_warning' => '',
	);

	if ($post) {
		foreach (array_keys($values) as $field) {
			if (isset($post->$field)) {
				$values[$field] = $post->$field;
			}
		}

		if ($post->status == 'draft') {
			$values['access_id'] = $post->future_access;
		}
	}

	if (elgg_is_sticky_form('story')) {
		$sticky_values = elgg_get_sticky_values('story');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}
	
	elgg_clear_sticky_form('story');

	if (!$post) {
		return $values;
	}

	// load the revision annotation if requested
	if ($revision instanceof ElggAnnotation && $revision->entity_guid == $post->getGUID()) {
		$values['revision'] = $revision;
		$values['description'] = $revision->value;
	}

	// display a notice if there's an autosaved annotation
	// and we're not editing it.
	if ($auto_save_annotations = $post->getAnnotations('story_auto_save', 1)) {
		$auto_save = $auto_save_annotations[0];
	} else {
		$auto_save = false;
	}

	if ($auto_save && $auto_save->id != $revision->id) {
		$values['draft_warning'] = elgg_echo('story:messages:warning:draft');
	}

	return $values;
}

/**
 * Forward to the new style of URLs
 * 
 * Pre-1.7.5
 * Group storys page: /story/group:<container_guid>/
 * Group story view:  /story/group:<container_guid>/read/<guid>/<title>
 * 1.7.5-1.8
 * Group storys page: /story/owner/group:<container_guid>/
 * Group story view:  /story/read/<guid>
 * 
 *
 * @param string $page
 */
function story_url_forwarder($page) {

	$viewtype = elgg_get_viewtype();
	$qs = ($viewtype === 'default') ? "" : "?view=$viewtype";

	$url = "story/all";

	// easier to work with & no notices
	$page = array_pad($page, 4, "");

	// group usernames
	if (preg_match('~/group\:([0-9]+)/~', "/{$page[0]}/{$page[1]}/", $matches)) {
		$guid = $matches[1];
		$entity = get_entity($guid);
		if (elgg_instanceof($entity, 'group')) {
			if (!empty($page[2])) {
				$url = "story/view/$page[2]/";
			} else {
				$url = "story/group/$guid/all";
			}
			register_error(elgg_echo("changebookmark"));
			forward($url . $qs);
		}
	}

	if (empty($page[0])) {
		return;
	}

	// user usernames
	$user = get_user_by_username($page[0]);
	if (!$user) {
		return;
	}

	if (empty($page[1])) {
		$page[1] = 'owner';
	}

	switch ($page[1]) {
		case "read":
			$url = "story/view/{$page[2]}/{$page[3]}";
			break;
		case "archive":
			$url = "story/archive/{$page[0]}/{$page[2]}/{$page[3]}";
			break;
		case "friends":
			$url = "story/friends/{$page[0]}";
			break;
		case "new":
			$url = "story/add/$user->guid";
			break;
		case "owner":
			$url = "story/owner/{$page[0]}";
			break;
	}

	register_error(elgg_echo("changebookmark"));
	forward($url . $qs);
}
