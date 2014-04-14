<?php
/**
 * A user's page invitations
 *
 * @uses $vars['invitations'] Array of ElggGroups
 */
gatekeeper();
$who_picked = get_input('who_picked');
$page_guid = get_input('guid');

if(!$who_picked || !$page_guid)
{
	register_error(elgg_echo("pages_tools:cannot_invite"));
	forward(REFERER);
}
$count = 0;
foreach($who_picked as $userInvited)
{
	if(!check_entity_relationship($userInvited, 'invited_to', $page_guid) && $userInvited!=elgg_get_logged_in_user_guid())
		{
			add_entity_relationship($userInvited, 'invited_to', $page_guid);
			$count++;
			//avisar correo
		}
}

system_message(elgg_echo("pages_tools:membersinvited", $count));
forward(REFERER);