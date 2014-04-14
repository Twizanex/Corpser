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
    	
    	
	 

	 // Initialize action action_gatekeeper();
	 	action_gatekeeper();

	
	
	// Get variables
		$site = get_entity($CONFIG->site_guid);
		$sitename = $site->name;
		
		$sitenamesubject = utf8_decode($sitename);
		
		if (is_callable('mb_encode_mimeheader')) $sitenamefrom = mb_encode_mimeheader(utf8_decode($sitename),"UTF-8", "B");
		else $sitenamefrom = $sitename;

		$sitenamebody = utf8_decode($sitename);	
		
		$fromname = get_input('fromname');
		$toname = get_input('toname');
		$mailto = get_input('mailto');
		$subject = get_input('subject');
		$subject = sprintf(elgg_echo("invitations:email:subject"), $fromname, $sitenamesubject);
		if (is_callable('mb_encode_mimeheader'))
			$subject = mb_encode_mimeheader($subject,"UTF-8", "B");
		
		$message = get_input('message');
		$mailfrom = get_plugin_setting('systememail', 'invitations');
		
		
		
		
	// Set Header
		if ($mailfrom)
			$from = $mailfrom;
		else
			$from = 'noreply@' . get_site_domain($CONFIG->site_guid); // Handle a fallback
		
    	$headers = "From: \"$sitenamefrom\" <$from>\r\n"
			. "Content-Type: text/plain; charset=UTF-8; format=flowed\r\n"
    		. "MIME-Version: 1.0\r\n"
    		. "Content-Transfer-Encoding: 8bit\r\n";
	



		
	// Name cleanup
		function name_cleanup($toname) {
			return ereg_replace("[^a-zA-Z0-9_.,;:]", "", $toname);
    	}
		
	// Send message	
		if (is_email_address($mailto)) {  				
	  		if ( ($mailto!="") && ($toname!="") )  {
				//Generate Code
				$code = generate_random_cleartext_password();
				// New invitation object
				$invitation = new ElggObject();
				$invitation	->	subtype = "invitation";
				$invitation	->	title = $toname;
				//$invitation	->	description = $mailto;
				$invitation	->	access_id = 2; //0 private / 1 logged in / 2 public
				$invitation	->	owner_guid = $_SESSION['user']->getGUID();
				$invitation	->	code = $code;
				$invitation	->	invitee = $toname;
				$invitation	->	inviteemail = $mailto;
				$invitation	->	inviter = $fromname;
				//$invitation	->	status = 0; //status will be set to 1 when registering
				$invitation	->	save();
				$inv_guid = $invitation->getGUID();
				
				// Generate Link
				$link = $CONFIG->site->url . "action/invitations/register?i=$inv_guid&c=$code";
				
				// Compose Message
				$cmessage = sprintf(elgg_echo('invitations:email:mailbody'),$toname, $fromname, $sitenamebody, $link);
				if ($message)
					$cmessage .= sprintf(elgg_echo('invitations:email:mailbodyuser:message'), utf8_decode($message));	
				$cmessage = utf8_encode(html_entity_decode($cmessage));
				
				// Save Message as Metadata (set private)
				create_metadata($invitation->getGUID(), 'message', $message,'text', $_SESSION['guid'], 2);
				
				
				mail($mailto,$subject,$cmessage,$headers);
				
				system_message(elgg_echo("invitations:send:successful"));
				forward($invitation->getURL()); //And that's it! Finally, we'll forward to the invitation view page
				
				
				
			} else {
				register_error(elgg_echo("invitations:send:unsuccessful"));			
				$retry = explode('?',$_SERVER['HTTP_REFERER']);
	  			$retry = $retry[0];
		
	  			$retry .= "?fn=" . rawurlencode($fromname) . "&mt=" . rawurlencode($mailto) . "&m=" . rawurlencode($message);

	  			forward($retry);
			}	  			
	  			
		} else {
	  		register_error(elgg_echo("invitations:email:invalid"));	
	  		$retry = explode('?',$_SERVER['HTTP_REFERER']);
	  		$retry = $retry[0];
		
	  		$retry .= "?fn=" . rawurlencode($fromname) . "&tn=" . rawurlencode($toname) . "&mt=" . rawurlencode($mailto) . "&m=" . rawurlencode($message);

	  		forward($retry);
		}	
?>