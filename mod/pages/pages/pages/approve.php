<?php
/**
 * Create a new page
 *
 * @package ElggPages
 */

gatekeeper();

$page_guid = (int) get_input('guid');
$page = get_entity($page_guid);
if (!$page) {
	register_error(elgg_echo("pages_tools:no_story"));
	forward(REFERER);
}
if($page->owner_guid!=elgg_get_logged_in_user_guid())
{
	register_error(elgg_echo('pages_tools:error:cantapprove'));
	forward(REFERER);
}
if(!pages_tools_approve_revision($page_guid))
{
	register_error(elgg_echo('pages_tools:error:cantdoapprove'));
	//forward(REFERER);
}
else
	system_message(elgg_echo("pages_tools:corpse_approved"));
	
if(!pages_tools_step_turn($page_guid))
{
	register_error(elgg_echo('pages_tools:error:step_turn'));
	//forward(REFERER);
}	
forward(pages_tools_get_root_page($page)->getURL());