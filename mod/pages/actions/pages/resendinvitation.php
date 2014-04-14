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

$relation = check_entity_relationship($invited_guid, 'invited_to', $page_guid);
if(!$relation)
{
	register_error(elgg_echo("pages_tools:error:no_invited"));
	forward(REFERER);
}

//Lets wait a little in order to resend more invitation to the same person (30 minutes)
if(time()<($relation->time_created+(60 * 30)))
{
	register_error(elgg_echo("pages_tools:wait_to_resend_invitation"));
	forward(REFERER);
}

if(!delete_relationship($relation->id))
{
	register_error(elgg_echo("pages_tools:cannot_resend_invitation"));
	forward(REFERER);
}

if($member!=elgg_get_logged_in_user_guid()){
	add_entity_relationship($invited_guid, 'invited_to', $page_guid);
	system_message(elgg_echo("pages_tools:success_invitation_resend"));
	forward(REFERER);
	}
	