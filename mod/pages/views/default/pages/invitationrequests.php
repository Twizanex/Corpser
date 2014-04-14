<?php
/**
 * A user's page invitations
 *
 * @uses $vars['invitations'] Array of ElggGroups
 */
 
gatekeeper();
elgg_load_js('jquery.nouislider');
elgg_load_css('jquery.nouislider');
$page_guid = get_input('guid');
$page = get_entity($page_guid);
		if(!$page)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward();
		}

$invitations = pages_tools_get_invited_users($page_guid);
$requests = pages_tools_get_participation_requests($page_guid);

echo '<br>';
echo '<h3>' . elgg_echo('pages_tools:current_invitations') . '</h3>';
$roundNo = elgg_get_entities(array('subtypes'=>'round', 'container_guid'=>$page_guid, 'limit'=>0, 'count'=>true ));
		
if($roundNo>1)
	echo '<p class="mtm">' . elgg_echo('Page_tools:invitations_round_more_one') . "</p>";
else
{
if ($invitations && is_array($invitations)) {
	$user = elgg_get_logged_in_user_entity();
	echo '<ul class="elgg-list">';
	foreach ($invitations as $member) {
			$icon = elgg_view_entity_icon($member, 'tiny', array('use_hover' => 'true'));

			$member_title = elgg_view('output/url', array(
				'href' => $member->getURL(),
				'text' => $member->name,
				'is_trusted' => true,
			));

			$url = "action/pages/killinvitation?page_guid={$page_guid}&invited_guid={$member->getGUID()}";
			$delete_button = elgg_view('output/confirmlink', array(
					'href' => $url,
					'confirm' => elgg_echo('Pages_tools:invite:remove:check'),
					'text' => elgg_echo('delete'),
					'class' => 'elgg-button elgg-button-delete mlm',
			));
			
			$url = "action/pages/resendinvitation?page_guid={$page_guid}&invited_guid={$member->getGUID()}";
			$resend_button = elgg_view('output/confirmlink', array(
					'href' => $url,
					'confirm' => elgg_echo('Pages_tools:invite:resend:check'),
					'text' => elgg_echo('pages_tools:resend_invitation'),
					'class' => 'elgg-button elgg-button-submit',
			));
			
			$relation = check_entity_relationship($member->getGUID(), 'invited_to', $page_guid);
			$time = elgg_echo('pages_tools:time_invited') . ' ' . elgg_get_friendly_time($relation->time_created);
			$body = <<<HTML
<h4>$member_title</h4>
<p class="elgg-subtext">$time</p>
HTML;
			$alt = $resend_button . $delete_button;

			echo '<li class="pvs">';
			echo elgg_view_image_block($icon, $body, array('image_alt' => $alt));
			echo '</li>';
		
	}
	echo '</ul>';
} else {
		echo '<p class="mtm">' . elgg_echo('groups:invitations:none') . "</p>";
}

}

			$groupMembers = get_group_members($page->container_guid,false);
			$MembersToInvite = array();
			
			foreach($groupMembers as $groupMember)
			{
				$canInvite = true;
				foreach($invitations as $invitation)
				{
					if($groupMember->getGUID()==$invitation->getGUID() || $groupMember->getGUID()==elgg_get_logged_in_user_guid())
						$canInvite = false;
				}
				if($canInvite)
					array_push($MembersToInvite,$groupMember);
			}

			if(count($MembersToInvite)>0)
			{

			$url = "action/pages/empty";
			$button = elgg_view('output/confirmlink', array(
					'href' => $url,
					'confirm' => false,
					'text' => '<a id="invitebutton">' . elgg_echo('Pages_tools:invite_more') . '</a>',
					'class' => '',
			));
			
			echo '<div class="rightbutton">';
			echo $button;
			echo '</div><br />';
			
			echo "<div id=\"invited\">";
			
			$form .= "<div class=centeredpicker>";
			$form .= "<br />";
			$form .= elgg_view("input/friendspicker", array('name' => 'who_picked', 'value' => $pageEdit->who_picked, 'entities' => $MembersToInvite, 'highlight' => 'all'));
			
			$form .= '<div>';
			$form .= elgg_view('input/submit', array('value' => elgg_echo('pages_tools:send_invitation')));
			$form .= elgg_view('input/hidden', array("name" => 'guid', "value" => $page_guid));
			$form .= '</div>';
			$form .= "</div>";
			
			echo elgg_view("input/form", array("body" => $form,
										"action" => "action/pages/sendinvitation",
										"class" => "elgg-form-alt"));
										
			echo "</div>";
			
			echo '<script>
				$( "#invitebutton" ).click(function(){
				$( "#invited" ).slideDown();
				$( "#invitebutton" ).slideUp();});

				function hideInvitation()
				{
					$( "#invited" ).slideUp();
				};
				hideInvitation();
				</script>';
				}

				echo '<br>';echo '<br>';
				echo '<h3>' . elgg_echo('pages_tools:current_participation_requests') . '</h3>';
				if($roundNo>1)
					echo '<p class="mtm">' . elgg_echo('pages_tools:invitations_round_more_one') . "</p>";
				else
				
				if($page->whogroup=='chosen')
					echo '<p class="mtm">' . elgg_echo('pages_tools:invitations_does_not_allowed_requests') . "</p>";
				else
				{
				if ($requests && is_array($requests)) {
					$user = elgg_get_logged_in_user_entity();
					echo '<ul class="elgg-list">';
					foreach ($requests as $member) {
					system_message($member->getGUID());
					$icon = elgg_view_entity_icon($member, 'tiny', array('use_hover' => 'true'));

					$member_title = elgg_view('output/url', array(
						'href' => $member->getURL(),
						'text' => $member->name,
						'is_trusted' => true,
					));

					$url = "action/pages/killrequest?user_guid={$user->getGUID()}&page_guid={$page_guid}&invited_guid={$member->getGUID()}";
					$delete_button = elgg_view('output/confirmlink', array(
						'href' => $url,
						'confirm' => elgg_echo('Pages_tools:denyrequest'),
						'text' => elgg_echo('Pages_tools:confirm_denyrequest'),
						'class' => 'elgg-button elgg-button-delete mlm',
					));
			
					$url = "action/pages/acceptrequest?user_guid={$user->getGUID()}&page_guid={$page_guid}&invited_guid={$member->getGUID()}";
					$resend_button = elgg_view('output/confirmlink', array(
						'href' => $url,
						'confirm' => elgg_echo('Pages_tools:invite:accept_request'),
						'text' => elgg_echo('pages_tools:accept_request'),
						'class' => 'elgg-button elgg-button-submit',
					));
			
					$relation = check_entity_relationship($member->getGUID(), 'request_participation_to', $page_guid);
					$time = elgg_echo('pages_tools:request_applied') . ' ' . elgg_get_friendly_time($relation->time_created);
					$body = <<<HTML
					<h4>$member_title</h4>
					<p class="elgg-subtext">$time</p>
HTML;
			$alt = $resend_button . $delete_button;

			echo '<li class="pvs">';
			echo elgg_view_image_block($icon, $body, array('image_alt' => $alt));
			echo '</li>';
		
	}
	echo '</ul>';
} else {
		echo '<p class="mtm">' . elgg_echo('pages_tools:participation_requests_none') . "</p>";
}
}