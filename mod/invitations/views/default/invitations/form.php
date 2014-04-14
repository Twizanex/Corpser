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
	 
	 
	 $fromname = get_input('fn');
	  	$toname = get_input('tn');
	  	$mailto = get_input('mt');
	  	$message = get_input('m');
	  	
	 if (isloggedin() AND !get_input('fn'))
	 	$fromname = ($_SESSION['user']->name);
	 
	 
	 $form_body = "<p>" . elgg_echo('invitations:formintrotrext') . "</p>";
	 $form_body .= "<p><label>" . elgg_echo('invitations:label:fromname') . "<br />" . elgg_view('input/text' , array('internalname' => 'fromname', 'class' => "general-textarea", 'value' => $fromname)) . "</label><br />";
	 $form_body .= "<label>" . elgg_echo('invitations:label:toname') . "<br />" . elgg_view('input/text' , array('internalname' => 'toname', 'class' => "general-textarea", 'value' => $toname)) . "</label><br />";
	
	
	 $form_body .= "<label>" . elgg_echo('invitations:label:mailto') . "<br />" . elgg_view('input/text' , array('internalname' => 'mailto', 'class' => "general-textarea", 'value' => $mailto)) . "</label><br />";
	
	 #$form_body .= "<label>" . elgg_echo('invitations:label:message') . "<br />" . elgg_view('input/longtext' , array('internalname' => 'message', 'class' => "general-textarea", 'value' => $message)) . "</label><br />";

	 $form_body .= "<label>".elgg_echo('invitations:label:message')."<br /><textarea class=\"input-textarea\" name=\"message\">".$message."</textarea></label><br />";
	 $form_body .= elgg_view('input/hidden', array('internalname' => 'action', 'value' => 'invitations/send'));
	
	 $form_body .= elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('invitations:button:send'))) . "</p>";
	 
?>
	<?php echo elgg_view('input/form', array('action' => "{$vars['url']}action/invitations/send", 'body' => $form_body)) ?>
	
	


	 