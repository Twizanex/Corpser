
<script type="text/javascript">
$(document).ready(function () {
    $('a.invitations_more_info').click(function () {
		$(this.parentNode).children("[class=invitations_desc]").slideToggle("fast");
		return false;
    });
}); /* end document ready function */
</script>

	<?php

		// get the time the invitation is valid
	    $expiration_days = get_plugin_setting('expdays', 'invitations');
	    
	    //get the num of invitations the user want to display
		$num = $vars['entity']->num_display;
		
		//if no number has been set, default to 4
		if(!$num)
			$num = 4;
			
        //grab the users invitation items
		$invitations = get_entities('object', 'invitation',$vars['entity']->owner_guid, "", $num, 0, false);

		
		if($invitations){

			foreach($invitations as $s){
			
				//get the owner
				$owner = $s->getOwnerEntity();

				//get the time
				$friendlytime = friendly_time($s->time_created);
				
				
				//get the status
				if (($s->status==0) && (invitation_expired($s->time_created, $expiration_days)==false))
					$status = elgg_echo('invitations:status:pending');
				if (($s->status==0) && (invitation_expired($s->time_created, $expiration_days)==true))
					$status = elgg_echo('invitations:status:expired');
				if ($s->status==1)
					$status = elgg_echo('invitations:status:used');
				if ($s->status==1 && !get_entity($s->inviteeguid)->name)
					$status = elgg_echo('invitations:status:usednotconfirmed');
					
				
				
				

				//get the user icon
				$icon = elgg_view(
						"profile/icon", array(
										'entity' => $owner,
										'size' => 'tiny',
									  )
					);

				//get the invitation title
				if ($vars['entity']->owner_guid == $_SESSION['user']->guid)
					$info = "<p><a href=\"{$s->getURL()}\">".elgg_echo('invitation').": {$s->invitee}</a><br />";
				else
					$info = "<p><a href=\"{$s->getURL()}\">".elgg_echo('invitation')."</a><br />";
				$info .= "<span class=\"invitations_widget_time\">".$friendlytime."</span>";
				$info .= "</p>";
				
				//get the user details				
				$details = "<p>";
				$details .= elgg_echo('invitations:widget:label:status').$status."<br />";
				$details .= elgg_echo('invitations:widget:label:invitee').$s->invitee."<br />";
				$details .= elgg_echo('invitations:widget:label:inviteemail').$s->inviteemail."<br />";
				$details .= elgg_echo('invitations:widget:label:sentas').$s->inviter;
				$details .= "</p>";
				
								
				// if invitee has registered: display name
				if(get_entity($s->inviteeguid)->name)
					$details .= "<p>".elgg_echo('invitations:widget:label:registered')."<a href=\"".get_entity($s->inviteeguid)->getURL()."\">".get_entity($s->inviteeguid)->name."</a></p>";
				
				// if invitations has expired: set delete link
				if (invitation_expired($s->time_created, $expiration_days)==true)
				$details .= "<p><a href=\"".$vars['url']."action/invitations/delete?invitation=".$s->getGUID()."\" onclick=\"return confirm('".elgg_echo("invitations:widget:delete:confirm")."');\">".elgg_echo('invitations:widget:label:delete')."</a></p>";
				
				

				// get the invitation details and "more"-link and details only for page owner
				if ($vars['entity']->owner_guid == $_SESSION['user']->guid) {
					//get the invitation details
					$info .= "<a href=\"javascript:void(0);\" class=\"invitations_more_info\">". elgg_echo('invitations:widget:moreinfo') ."</a><br /><div class=\"invitations_desc\">{$details}</div>";
				}
				
				//display 
				echo "<div class=\"invitations_widget_wrapper\">";
				echo "<div class=\"invitations_widget_content\">" . $info . "</div>";
				echo "</div>";

			}

			if ($_SESSION['user']->guid == page_owner()) {
				$user_invitations_list = $vars['url'] . "pg/invitations/" . $_SESSION['user']->username . "/list";
				echo "<a href=\"{$user_invitations_list}\">".elgg_echo('invitations:widget:link:yourinvitations')."</a>";
			}

		}
	
	
		function invitation_expired($time, $expiration_days) {
			$diff = time() - ((int) $time);
			$diff = round($diff / 86400);
			#return $diff;
			if ($diff > $expiration_days) {
				return true;
			} else {
				return false;
			}
		}
	?>