<?php

	/**
	 * Elgg invitations plugin
	 * This plugin allows to send message to custom email you specify at module configuration area
	 * 
	 * @package Invitations
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Ralf Heinrich
	 * @copyright Ralf Heinrich 2008
	 * @link /www.daten-punk.de
	 */

	require_once(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . "/engine/start.php");

	global $CONFIG;
	
	// block non-admin users
	admin_gatekeeper();
	
	// Get the user 
	$guid = get_input('guid');
	$obj = get_entity($guid);
	
	if ( ($obj instanceof ElggUser) && ($obj->canEdit()))
	{
		$result = $obj->allowinvitations = 'no';
		if ($result)
			system_message(elgg_echo('invitations:usersetting:disallow:yes'));
		else
			register_error(elgg_echo('invitations:usersetting:disallow:no'));
	}
	else
		register_error(elgg_echo('invitations:usersetting:disallow:no'));	
	
	forward($_SERVER['HTTP_REFERER']);

?>