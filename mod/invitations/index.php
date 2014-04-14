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
	 
	// Load Elgg engine
	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	 	
	global $CONFIG;
	 
	gatekeeper();
	 
	if (!isadminloggedin()) {
		if (get_plugin_setting('allowedusers', 'invitations') == "none" && get_entity($_SESSION['user']->guid)->allowinvitations != "yes") {
			register_error(elgg_echo('invitations:error:notallowed'));	
			forward();
		}
		if (get_plugin_setting('allowedusers', 'invitations') == "all" && get_entity($_SESSION['user']->guid)->allowinvitations == "no") {
			register_error(elgg_echo('invitations:error:notallowed'));	
			forward();
		}
	}
	if (get_plugin_setting('allowedusers', 'invitations') == "admin" && !isadminloggedin()) {
		register_error(elgg_echo('invitations:error:notallowed'));	
		forward();
	}
		
	 
	 
	 if(page_owner() != $_SESSION['user']->guid)
	 	forward($CONFIG->wwwroot."pg/invitations/" . $_SESSION['user']->username);
	 
	 
	 // Get the current page's owner
		$page_owner = page_owner_entity();
		if ($page_owner === false || is_null($page_owner)) {
			$page_owner = $_SESSION['user'];
			set_page_owner($_SESSION['guid']);
		}
	
	
	// Display form
		$area2 = elgg_view_title(elgg_echo('invitations:page:title')); // set the title	
		$area2 .= elgg_view("invitations/form"); //Get the form	
		
	// Draw page
		page_draw(elgg_echo('invitations:page:title'),elgg_view_layout("two_column_left_sidebar", $area1, $area2));
	
?>