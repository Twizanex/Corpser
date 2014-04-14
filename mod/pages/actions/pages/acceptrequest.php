<?php
/**
 * A user's page invitations
 *
 * @uses $vars['invitations'] Array of ElggGroups
 */
gatekeeper();
$page_guid = get_input('page_guid');
$invited_guid = get_input('invited_guid');

$page = get_entity($page_guid);
		if(!$page)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward();
		}

$relation = check_entity_relationship($invited_guid, 'request_participation_to', $page_guid);
if(!$relation)
{
	register_error(elgg_echo("pages_tools:error:no_invited"));
	forward(REFERER);
}

if(!pages_tools_accept_request($invited_guid, $page_guid)
{
	register_error(elgg_echo("pages_tools:error:cannot_accept"));
	forward(REFERER);
}
else
{
	system_message(elgg_echo("pages_tools:success_accept_request"));
	forward(REFERER);
}
	