<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
global $CONFIG;

gatekeeper();
 
$guid = (int) get_input('invitation');

if (($invitation = get_entity($guid)) && ($invitation->delete())) {
	system_message(elgg_echo('invitations:widget:delete:deleted'));
	forward($_SERVER['HTTP_REFERER']);
} else {
	register_error(elgg_echo('invitations:widget:delete:deleted:error'));
	forward($_SERVER['HTTP_REFERER']);

}

forward($_SERVER['HTTP_REFERER']);

?>