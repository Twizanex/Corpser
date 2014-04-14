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
	 
	
	// Change this value at module configuration interface
	$DEFAULT_EXPIRATION_DAYS = 7;
	$DEFAULT_WALLEDGARDEN = false;
	$DEFAULT_EMAIL_ADDRESS = "noreply@".get_site_domain($CONFIG->site_guid); // Change this value at module configuration interface
?>	 

	<p>
	<h3><?php echo elgg_echo('invitations:default:email'); ?>: </h3>
	<?php
		$frommail = ($vars['entity']->systememail ? $vars['entity']->systememail : $DEFAULT_EMAIL_ADDRESS);
		echo elgg_view('input/text', array('internalname' => 'params[systememail]', 'value' => $frommail));
		echo "<p>&nbsp;</p>"
	?>
</p>
	
	
	<h3><?php echo elgg_echo('invitations:default:expdays'); ?>: </h3>
	<?php
		$expdays = ($vars['entity']->expdays ? $vars['entity']->expdays : $DEFAULT_EXPIRATION_DAYS);
		echo elgg_view('input/text', array('internalname' => 'params[expdays]', 'value' => $expdays));
		echo "<p>&nbsp;</p>"
	?>
	
	<h3><?php echo elgg_echo('invitations:default:allowedusers'); ?>: </h3>
	<?php
		if ($vars['entity']->allowedusers == "all") {
			$checked1 = "checked = \"checked\"";
			$checked2 = "";
			$checked3 = "";
		}
		if ($vars['entity']->allowedusers == "none") {
			$checked1 = "";
			$checked2 = "checked = \"checked\"";
			$checked3 = "";
		}
		if ($vars['entity']->allowedusers == "admin") {
			$checked1 = "";
			$checked2 = "";
			$checked3 = "checked = \"checked\"";
		}
	?>	
	<input type="radio" name="params[allowedusers]" id="radio" class="input-radio" value="all" <?php echo $checked1; ?> /><?php echo elgg_echo('invitations:default:label:all');?>
	<input type="radio" name="params[allowedusers]" id="radio" class="input-radio" value="none" <?php echo $checked2; ?> /><?php echo elgg_echo('invitations:default:label:none');?>
	<input type="radio" name="params[allowedusers]" id="radio" class="input-radio" value="admin" <?php echo $checked3; ?> /><?php echo elgg_echo('invitations:default:label:admin');?>
	<p><?php echo elgg_echo('invitations:default:label:all') ?>: <?php echo elgg_echo('invitations:default:desc:all') ?></p>
	<p><?php echo elgg_echo('invitations:default:label:none') ?>: <?php echo elgg_echo('invitations:default:desc:none') ?></p>
	<p><?php echo elgg_echo('invitations:default:label:admin') ?>: <?php echo elgg_echo('invitations:default:desc:admin') ?></p>
	<p>&nbsp;</p>
	
	
	
	<h3><?php echo elgg_echo('invitations:default:walledgarden'); ?>: </h3>
	<?php
		if ($vars['entity']->walledgarden == "enabled") {
			$checked1 = "checked = \"checked\"";
			$checked2 = "";
		}
		if ($vars['entity']->walledgarden == "disabled") {
			$checked1 = "";
			$checked2 = "checked = \"checked\"";
		}
	?>	
	<input type="radio" name="params[walledgarden]" id="radio" class="input-radio" value="enabled" <?php echo $checked1; ?> /><?php echo elgg_echo('invitations:default:label:enable');?>
	<input type="radio" name="params[walledgarden]" id="radio" class="input-radio" value="disabled" <?php echo $checked2; ?> /><?php echo elgg_echo('invitations:default:label:disable');?>
	<p>&nbsp;</p>
	
	
	
	<h3><?php echo elgg_echo('invitations:default:enableforgottenpassword'); ?>: </h3>
	<?php
		if ($vars['entity']->forgottenpassword == "enabled") {
			$checked1 = "checked = \"checked\"";
			$checked2 = "";
		}
		if ($vars['entity']->forgottenpassword == "disabled") {
			$checked1 = "";
			$checked2 = "checked = \"checked\"";
		}
	?>
	<input type="radio" name="params[forgottenpassword]" id="radio" class="input-radio" value="enabled" <?php echo $checked1; ?> /><?php echo elgg_echo('invitations:default:label:enable');?>
	<input type="radio" name="params[forgottenpassword]" id="radio" class="input-radio" value="disabled" <?php echo $checked2; ?> /><?php echo elgg_echo('invitations:default:label:disable');?>
	<p>&nbsp;</p>
	
	
	
	<h3><?php echo elgg_echo('invitations:default:enableregistration'); ?>: </h3>
	<?php
		if ($vars['entity']->registration == "enabled") {
			$checked1 = "checked = \"checked\"";
			$checked2 = "";
		}
		if ($vars['entity']->registration == "disabled") {
			$checked1 = "";
			$checked2 = "checked = \"checked\"";
		}
	?>
	<input type="radio" name="params[registration]" id="radio" class="input-radio" value="enabled" <?php echo $checked1; ?> /><?php echo elgg_echo('invitations:default:label:enable');?>
	<input type="radio" name="params[registration]" id="radio" class="input-radio" value="disabled" <?php echo $checked2; ?> /><?php echo elgg_echo('invitations:default:label:disable');?>
	<p>&nbsp;</p>
