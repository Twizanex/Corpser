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

	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	
	global $CONFIG;
		
	gatekeeper();
	
	
	
	if(page_owner() != $_SESSION['user']->guid)
	forward($CONFIG->wwwroot."pg/invitations/".$_SESSION['user']->username."/list");


	//set the title
	$area2 = elgg_view_title($title = elgg_echo('invitations:list:title:yours'));

	// Get objects
	set_context('search');
	$area2 .= list_entities("object","invitation",$_SESSION['user']->guid,10,false);
	$body = elgg_view_layout('two_column_left_sidebar', $area1, $area2);
	
	// Finally draw the page
	page_draw(elgg_echo('invitations:list:title:yours'), $body);
?>