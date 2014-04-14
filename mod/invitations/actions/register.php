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
	 
	 
	require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");

	//global $CONFIG;
	
	$expiration_days = get_plugin_setting('expdays', 'invitations');
		
	$invitation_guid = get_input('i');
	$code = get_input('c');
	$invitation_guid = (int)$invitation_guid;
	$invitation = get_entity($invitation_guid);

	
	// If we're not logged in, display the registration page
		if (!isloggedin()) {
			// If invitation is not valid, redirect to start page
			if ($invitation) {
				if (code_error($invitation, $code)) {
					register_error(code_error($invitation, $code));
					forward();
				} else if (invitation_expired($invitation->time_created, $expiration_days)) {
					register_error(invitation_expired($invitation->time_created, $expiration_days));
					forward();
				} else if (invitatio_used($invitation)) {
					register_error(invitatio_used($invitation));
					forward();
				} else {
					//echo page_draw(elgg_echo('register'), elgg_view("account/forms/register"));
					echo page_draw(elgg_echo('register'), elgg_view("invitations/invitationsregisterform"));
					}
			}
	// Otherwise, forward to the index page
		} else {
			forward();
		}
	
	
	
	function invitation_expired($time, $expiration_days) {
		$diff = time() - ((int) $time);
		$diff = round($diff / 86400);
		#return $diff;
		if ($diff > $expiration_days)
			//return " expired ";
			return sprintf(elgg_echo('invitations:register:error:expired'),$expiration_days);
	}
	
	function code_error($invitation, $code) {
		if ($invitation->code != $code)
			//return " false code ";
			return elgg_echo('invitations:register:error:coderror');
	}
	
	
	function invitatio_used($invitation) {
		if ($invitation->status != 0)
			//return " already used ";
			return elgg_echo('invitations:register:error:used');
	}
	
?>