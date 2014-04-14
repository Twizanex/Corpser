<?php
/**
 * Delete story entity
 *
 * @package Blog
 */

$story_guid = get_input('guid');
$story = get_entity($story_guid);

if (elgg_instanceof($story, 'object', 'story') && $story->canEdit()) {
	$container = get_entity($story->container_guid);
	if ($story->delete()) {
		system_message(elgg_echo('story:message:deleted_post'));
		if (elgg_instanceof($container, 'group')) {
			forward("story/group/$container->guid/all");
		} else {
			forward("story/owner/$container->username");
		}
	} else {
		register_error(elgg_echo('story:error:cannot_delete_post'));
	}
} else {
	register_error(elgg_echo('story:error:post_not_found'));
}

forward(REFERER);