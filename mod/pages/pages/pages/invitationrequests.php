<?php
/**
 * A user's page invitations
 *
 * @uses $vars['invitations'] Array of ElggGroups
 */
 system_message("invitationrequest se ejecuta");
$page_guid = get_input('guid');
system_message($page_guid);
$invitations = pages_tools_get_invited_users($page_guid);

if (!$invitations && is_array($invitations)) {
	$user = elgg_get_logged_in_user_entity();
	echo '<ul class="elgg-list">';
	foreach ($invitations as $member) {
			$memberEntity = get_entity($member);
			$icon = elgg_view_entity_icon($memberEntity, 'tiny', array('use_hover' => 'true'));

			$member_title = elgg_view('output/url', array(
				'href' => $memberEntity->getURL(),
				'text' => $memberEntity->name,
				'is_trusted' => true,
			));

			$url = "action/pages/killinvitation?user_guid={$user->getGUID()}&page_guid={$page->getGUID()}&invited_guid={$member}";
			$delete_button = elgg_view('output/confirmlink', array(
					'href' => $url,
					'confirm' => elgg_echo('Pages_tools:invite:remove:check'),
					'text' => elgg_echo('delete'),
					'class' => 'elgg-button elgg-button-delete mlm',
			));

			$body = <<<HTML
<h4>$group_title</h4>
<p class="elgg-subtext">$group->briefdescription</p>
HTML;
			$alt = $delete_button;

			echo '<li class="pvs">';
			echo elgg_view_image_block($icon, $body, array('image_alt' => $alt));
			echo '</li>';
		
	}
	echo '</ul>';
} else {
		echo '<p class="mtm">' . elgg_echo('groups:invitations:none') . "</p>";
}