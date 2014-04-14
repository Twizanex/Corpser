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
	 
	$username = get_input('u');
	$email = get_input('e');
	$name = get_input('n');
	
	$invitation_guid = get_input('i');
	$code = get_input('c');
	$invitation_guid = (int)$invitation_guid;
	$invitation = get_entity($invitation_guid);
	
	$invitersentname = $invitation->inviter;
	$invitername = get_user($invitation->owner_guid)->name; 
	$invitationstatus = $invitation->status;
	

	$admin_option = false;
	if (($_SESSION['user']->admin) && ($vars['show_admin'])) 
		$admin_option = true;
	
	
	
	if ($invitersentname == $invitername) {
		$content_body = "<p>".sprintf(elgg_echo('invitations:register:content:body:invitedby'),$invitername)."</p>";
	} else {
		$content_body = "<p>".sprintf(elgg_echo('invitations:register:content:body:invitedby'),$invitersentname)."<br />";
		$content_body .= "(".sprintf(elgg_echo('invitations:register:content:body:knownas'),$invitername).")</p>";
	}
	
	$content_body .= "<p>".elgg_echo('invitations:register:content:body:confirmationmail')."</p>";
	
	$form_body = "<p><label>" . elgg_echo('name') . "<br />" . elgg_view('input/text' , array('internalname' => 'name', 'class' => "general-textarea", 'value' => $name)) . "</label><br />";
	$form_body .= "<label>" . elgg_echo('email') . "<br />" . elgg_view('input/text' , array('internalname' => 'email', 'class' => "general-textarea", 'value' => $email)) . "</label><br />";
	$form_body .= "<label>" . elgg_echo('username') . "<br />" . elgg_view('input/text' , array('internalname' => 'username', 'class' => "general-textarea", 'value' => $username)) . "</label><br />";
	$form_body .= "<label>" . elgg_echo('password') . "<br />" . elgg_view('input/password' , array('internalname' => 'password', 'class' => "general-textarea")) . "</label><br />";
	$form_body .= "<label>" . elgg_echo('passwordagain') . "<br />" . elgg_view('input/password' , array('internalname' => 'password2', 'class' => "general-textarea")) . "</label><br />";
	
	if ($admin_option)
		$form_body .= elgg_view('input/checkboxes', array('internalname' => "admin", 'options' => array(elgg_echo('admin_option'))));
	
	$form_body .= elgg_view('input/hidden', array('internalname' => 'i', 'value' => $invitation_guid));
	$form_body .= elgg_view('input/hidden', array('internalname' => 'c', 'value' => $code));
	$form_body .= elgg_view('input/hidden', array('internalname' => 'action', 'value' => 'invitationregister'));
	$form_body .= elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('register'))) . "</p>";
?>

	
	<div id="register-box" class="invitations_register-box">
	<h2><?php echo elgg_echo('register'); ?></h2>
	<?php 
	echo elgg_view('input/form', array('action' => "{$vars['url']}action/invitationregister", 'body' => $form_body));
	?>
	</div>
	
	<div id="two_column_left_sidebar_maincontent" class="invitations_register-content">
	<div id="content_area_user_title">
		<h2><?php echo elgg_echo('invitations:register:content:headline'); ?></h2>
	</div>
	<?php 
	echo $content_body;
	?>
	</div>