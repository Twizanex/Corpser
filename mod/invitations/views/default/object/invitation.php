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

	global $CONFIG;
	
	$invitation = $vars['entity'];
	$invitation_guid = $invitation->getGUID();
	$title = $invitation->title;
	$owner = $vars['entity']->getOwnerEntity();
	$friendlytime = friendly_time($vars['entity']->time_created);
	
	
	//get the status
	$expiration_days = get_plugin_setting('expdays', 'invitations');
	$status = $invitation->status;
	
	$time = round((time() - ((int)$invitation->time_created)) / 86400);
	
	if (($invitation->status==0) && ($time < $expiration_days))
		$status = elgg_echo('invitations:status:pending');
	if (($invitation->status==0) && ($time > $expiration_days))
		$status = elgg_echo('invitations:status:expired');
	if ($invitation->status==1)
		$status = elgg_echo('invitations:status:usednotconfirmed');
	if (($invitation->status==1) && (get_entity($invitation->inviteeguid)->name))
		$status = elgg_echo('invitations:status:usedby')."<a href=\"".get_entity($invitation->inviteeguid)->getURL()."\"> ".get_entity($invitation->inviteeguid)->name."</a>";
	

	
	
	
	
	if (get_context() == "search") { 	// Start search listing version 
		
			if (($vars['entity']->owner_guid == $_SESSION['user']->guid) || isadminloggedin()) {
				$info = "<p>".elgg_echo('invitation').": <a href=\"{$invitation->getURL()}\">{$title}</a></p>";
				$info .= "<p class=\"owner_timestamp\"><a href=\"{$owner->getURL()}\">{$owner->name}</a> {$friendlytime} - ".elgg_echo('invitations:status').": {$status}";
				if ((($time > $expiration_days) || (get_entity($invitation->inviteeguid)->name)) && ($vars['entity']->owner_guid == $_SESSION['user']->guid))
				$info .= " - <a href=\"".$vars['url']."action/invitations/delete?invitation=".$invitation->getGUID()."\" onclick=\"return confirm('".elgg_echo("invitations:widget:delete:confirm")."');\">".elgg_echo('invitations:widget:label:delete')."</a></p>";
				else
				$info .= "</p>";
			}else{
				$info = "<p>".elgg_echo('invitation')."</p>";
				$info .= "<p class=\"owner_timestamp\"><a href=\"{$owner->getURL()}\">{$owner->name}</a> {$friendlytime} - ".elgg_echo('invitations:status').": {$status}";
			}
			
			
			
			
			if(get_entity($invitation->inviteeguid)->name && isloggedin())
			$icon = elgg_view("profile/icon",array('entity' => get_entity($invitation->inviteeguid), 'size' => 'small'));
			else
			$icon = elgg_view("invitations/icon", array('size' => 'small', 'entity' => $invitation));
			
			echo elgg_view_listing($icon, $info);
		
	} else {							// Start main version
	
			set_context('invitations');
			
			if (($vars['entity']->owner_guid == $_SESSION['user']->guid) || isadminloggedin() ) {
?>
<div class="invitations_single">
	<div class="invitations_title_wrapper">
		<div class="invitations_title_icon"><?php echo elgg_view("invitations/icon", array('size' => 'medium', 'entity' => $invitation)); ?></div>
		<div class="invitations_title"><h2><?php echo elgg_echo('invitation') ?> <a href="<?php echo $invitation->getURL(); ?>"><?php echo $title; ?></a></h2></div>
		<div class="invitations_owner">
			<div class="invitations_tinyicon"><?php echo elgg_view("profile/icon",array('entity' => $owner, 'size' => 'tiny'));?></div>
			<p class="invitations_owner_details"><?php echo elgg_echo('invitations:label:sentby') ?><b><a href="<?php echo $vars['url']; ?>pg/file/<?php echo $owner->username; ?>"><?php echo $owner->name; ?></a></b> <small><?php echo $friendlytime; ?></small></p>
			<div class="invitations_clear"></div>
		</div>
	</div>
		
	<div class="invitations_maincontent">			
		<div class="invitations_meta_row">
			<div class="invitations_meta_label"><?php echo elgg_echo('invitations:label:invitee') ?></div>
			<div class="invitations_meta_info"><?php echo $invitation->invitee ?></div>
			<div class="invitations_clear"></div>
		</div>
		<div class="invitations_meta_row">
			<div class="invitations_meta_label"><?php echo elgg_echo('invitations:label:inviteemail') ?></div>
			<div class="invitations_meta_info"><?php echo $invitation->inviteemail ?></div>
			<div class="invitations_clear"></div>
		</div>
		<div class="invitations_meta_row">
			<div class="invitations_meta_label"><?php echo elgg_echo('invitations:label:sentas') ?></div>
			<div class="invitations_meta_info"><?php echo $invitation->inviter ?></div>
			<div class="invitations_clear"></div>
		</div>
		<div class="invitations_meta_row">
			<div class="invitations_meta_label"><?php echo elgg_echo('invitations:label:status') ?></div>
			<div class="invitations_meta_info"><?php echo $status ?></div>
			<div class="invitations_clear"></div>
		</div>
		<?php if (($invitation->status==1) && (get_entity($invitation->inviteeguid)->name)): ?>
		<div class="invitations_meta_row">
			<div class="invitations_meta_label"><?php echo elgg_echo('invitations:label:registered') ?></div>
			<div class="invitations_meta_info">
				<div class="invitations_tinyicon"><?php echo elgg_view("profile/icon",array('entity' => get_entity($invitation->inviteeguid), 'size' => 'tiny')) ?></div>
				<a href="<?php echo get_entity($invitation->inviteeguid)->getURL() ?>"><?php echo get_entity($invitation->inviteeguid)->name ?></a> 
			</div>
			<div class="invitations_clear"></div>
		</div>
		<?php endif ?>
		<?php if ($vars['entity']->owner_guid == $_SESSION['user']->guid): ?>
		<div class="invitations_meta_row">
			<div class="invitations_meta_label"><?php echo elgg_echo('invitations:label:message') ?></div>
			<div class="invitations_meta_info"><?php echo nl2br($invitation->message) ?></div>
			<div class="invitations_clear"></div>
		</div>
		<?php endif ?>
	</div>
				
	<?php if (($time > $expiration_days) || (get_entity($invitation->inviteeguid)->name)): ?>
	<div class="invitations_controls">
		<p><a href="<?php echo $vars['url'] ?>action/invitations/delete?invitation=<?php echo $invitation->getGUID() ?>" onclick="return confirm('<?php echo elgg_echo("invitations:widget:delete:confirm") ?>');"><?php echo elgg_echo('invitations:widget:label:delete') ?></a></p>
	</div>
	<?php endif ?>
</div>


<?php
			}else{
?>

<div class="invitations_single">
		<div class="invitations_title_wrapper">
			<div class="invitations_title_icon"><?php echo elgg_view("invitations/icon", array('size' => 'medium', 'entity' => $invitation)); ?></div>
			<div class="invitations_title"><h2><?php echo elgg_echo('invitations:invitation') ?></h2></div>
			<div class="invitations_owner">
				<p class="invitations_owner_details"><small><?php echo $friendlytime; ?></small><br /><?php echo elgg_echo('invitations:entity:notallowed') ?></p>
				<div class="invitations_clear"></div>
			</div>
		</div>
</div>


<?php
			}
	}

?>