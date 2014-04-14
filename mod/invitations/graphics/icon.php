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
	require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");

	
	$size = strtolower(get_input('size'));
	if (!in_array($size,array('large','medium','small','tiny','master','topbar')))
		$size = "medium";
	
	/*
	$success = false;
	
	$filehandler = new ElggFile();
	$filehandler->owner_guid = $group->owner_guid;
	$filehandler->setFilename("groups/" . $group->guid . $size . ".jpg");
	
	$success = false;
	if ($filehandler->open("read")) {
		if ($contents = $filehandler->read($filehandler->size())) {
			$success = true;
		} 
	}
	*/
	
	$contents = @file_get_contents($CONFIG->pluginspath . "invitations/graphics/{$size}.png");
	
	header("Content-type: image/png");
	header("Pragma: public");
	header("Cache-Control: public");
	echo $contents;
?>