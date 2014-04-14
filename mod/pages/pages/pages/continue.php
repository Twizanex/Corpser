<?php
/**
 * Continue a story
 *
 * @package ElggPages
 */

gatekeeper();

$page_guid = (int)get_input('guid');
$page = get_entity($page_guid);

if (!$page) {
	register_error(elgg_echo('noaccess'));
	forward('');
}

$container = $page->getContainerEntity();
if (!$container) {
	register_error(elgg_echo('noaccess'));
	forward('');
}

if($page->iscontainer == 'colective')
{
	if($page->storytype == 'gamebook')
	{
		forward("pages/add/$page->guid");
	}
}
else
{
	if($page->indstorytype == 'gamebook')
	{
		forward("pages/add/$page->guid");
	}
}

if(pages_tools_set_story_lock($page_guid, elgg_get_logged_in_user_guid()))
{
	forward("pages/add/$page->guid");
}
else
{
	register_error(elgg_echo('pages:story_already_locked'));
	forward(REFERER);
}
