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
	global $CONFIG;
	
	action_gatekeeper();

	// Get variables
		$username = get_input('username');
		$password = get_input('password');
		$password2 = get_input('password2');
		$email = get_input('email');
		$name = get_input('name');
		
		$invitation_guid = get_input('i');
		$code = get_input('c');
		
		$invitation = get_entity($invitation_guid);
		
		$admin = get_input('admin');
		if (is_array($admin)) $admin = $admin[0];
		
		

	// For now, just try and register the user
	
			try {
				if (((trim($password)!="") && (strcmp($password, $password2)==0)) && ($guid = register_user($username, $password, $name, $email)) ) {
					
					$new_user = get_entity($guid);
					if (($guid) && ($admin))
					{
						admin_gatekeeper(); // Only admins can make someone an admin
						$new_user->admin = 'yes';
					}
					
					if (!$new_user->admin)
						$new_user->disable('new_user');	// Now disable if not an admin
					
					// Send email validation on register only
					//request_email_validation($guid); // use this for elgg 1.0
					request_user_validation($guid); // use this for svn version rev 2175 and later
					
					$invitation	->	status = 1;
					$invitation	->	inviteeintname = $name;
					$invitation ->	inviteeguid = $guid;
					system_message(sprintf(elgg_echo("registerok"),$CONFIG->sitename));
					
					forward(); // Forward on success, assume everything else is an error...
				} else {
					register_error(elgg_echo("registerbad"));
				}
			} catch (RegistrationException $r) {
				register_error($r->getMessage());
			}

			
		$qs = explode('?',$_SERVER['HTTP_REFERER']);
		$qs = $qs[0];
		$qs .= "?u=" . rawurlencode($username) . "&e=" . rawurlencode($email) . "&n=" . rawurlencode($name) . "&i=" . rawurlencode($invitation_guid) . "&c=" . rawurlencode($code);
		
		forward($qs);

?>