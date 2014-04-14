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
	
	
	// Get config
	global $CONFIG;
	 
	 
	function userinvitationsallowed() {
		if (get_plugin_setting('allowedusers', 'invitations') == "none" && get_entity($_SESSION['user']->guid)->allowinvitations == "yes")
		return true;
		if (get_plugin_setting('allowedusers', 'invitations') == "all" && get_entity($_SESSION['user']->guid)->allowinvitations != "no")
		return true;
		if (isadminloggedin())
		return true;
	}
	
	 

	
	/**
	 * File plugin initialisation functions.
	 */
	 
	 function invitation_init() {
		// Get config
		global $CONFIG;
		
		// Load the language file
		register_translations($CONFIG->pluginspath . "invitations/languages/");
	
		// Load menu for logged in users
		if (isloggedin() && userinvitationsallowed())
		add_menu(elgg_echo('invitations:plugin:name'), $CONFIG->wwwroot . "pg/invitations/" . $_SESSION['user']->username);
		
		

		// Extend CSS
		extend_view('css', 'invitations/css');
		
		// Extend hover-over and profile menu	
	    //extend_view('profile/menu/links','invitations/list');
	    //extend_view('profile/menu/links','file/menu');
		//extend_view('groups/right_column','file/groupprofile_files');
		
		// Extend context menu with admin logbrowsre link

			if (isadminloggedin()) {
				extend_view('profile/menu/adminlinks','invitations/adminlinks',10000);
			}
		
		// Register a page handler, so we can have nice URLs
		register_page_handler('invitations','invitations_page_handler');
		
		// Add a new invitations widget
		if (isloggedin() && userinvitationsallowed())
		add_widget_type('invitations',elgg_echo("invitations:plugin:name"),elgg_echo("invitations:widget:description"));
		
		// Register a URL handler for files
		register_entity_url_handler('invitations_url','object','invitation');
		
		// Register entity type
		#register_entity_type('object','invitation');
		
	}
	
	
	/**
	 * Invitations page handler
	 *
	 * @param array $page Array of page elements, forwarded by the page handling mechanism
	 */
	
	
	function invitations_page_handler($page) {
		
		global $CONFIG;
		
		// The username should be the file we're getting
		if (isset($page[0])) {
			set_input('username',$page[0]);
		}
		
		if (isset($page[1])) 
		{
    		switch($page[1]) 
    		{
    			case "read":
    				set_input('guid',$page[2]);
					@include(dirname(dirname(dirname(__FILE__))) . "/entities/index.php");
				break;
				case "list":  
    				set_input('username', $page[0]);
    				include($CONFIG->pluginspath . "invitations/list.php");
          		break;
          		case "listadmin":  
    				set_input('username', $page[0]);
    				include($CONFIG->pluginspath . "invitations/listadmin.php");
          		break;
          		default:
    				set_input('username', $page[0]);
    				include($CONFIG->pluginspath . "invitations/index.php");
    			break;
    		}
		}
		else
		{
			// Include the standard profile index
			include($CONFIG->pluginspath . "invitations/index.php");
		}
		
	}
	
	
	
	/**
	 * Sets up submenus for the file system.  Triggered on pagesetup.
	 *
	 */
	function invitations_submenus() {
		
		global $CONFIG;		
			
		// General submenu options
			
		if (get_context() == "invitations") {
			if (userinvitationsallowed()) {
				add_submenu_item(elgg_echo('invitations:submenu:new'), $CONFIG->wwwroot."pg/invitations/".$_SESSION['user']->username);
				add_submenu_item(elgg_echo('invitations:submenu:yours'), $CONFIG->wwwroot."pg/invitations/".$_SESSION['user']->username."/list/");
			}
			if (isadminloggedin())
				add_submenu_item(elgg_echo('invitations:submenu:admin'), $CONFIG->wwwroot."pg/invitations/".$_SESSION['user']->username."/listadmin/");
		}
	}	

	
	/**
	 * Populates the ->getUrl() method for invitations objects
	 *
	 * @param ElggEntity $entity The Invitation
	 * @return string bookmarked item URL
	 */
		function invitations_url($entity) {
			
			global $CONFIG;
			$title = $entity->title;
			$title = friendly_title($title);
			return $CONFIG->url . "pg/invitations/" . $entity->getOwnerEntity()->username . "/read/" . $entity->getGUID() . "/" . $title;
			
		}

	
	
	/**
	 * Sets up walledgarden
	 *
	 */
	function invwalledgarden_init() {	
		global $CONFIG;
		
		if (get_plugin_setting('walledgarden', 'invitations') == "enabled") {
			$CONFIG->disable_registration = true;
		}
		
		if (get_plugin_setting('registration', 'invitations') == "enabled") {
			$allowedpages[] = "account/register.php";
			$CONFIG->disable_registration = false;
		}
		
		if (get_plugin_setting('forgottenpassword', 'invitations') == "enabled") {
			$allowedpages[] = "account/forgotten_password.php";
			$allowedpages[] = "action/user/passwordreset";
			$allowedpages[] = "actions/user/requestnewpassword";
		}
		
		
		$allowed=false;
		$path = $_SERVER['REQUEST_URI'];
		$allowedpages[] = "action/invitations/register";
		$allowedpages[] = "action/invitationregister";
		
		for ($i = 0, $cnt = count($allowedpages); $i < $cnt; $i++) {
			if(strpos($path, $allowedpages[$i])) {
				$allowed=true;
			}
		}
		
		
		if ($allowed == false) {
			if (current_page_url() != $CONFIG->url && get_plugin_setting('walledgarden', 'invitations') == "enabled") 
				extend_view('pageshells/pageshell', 'walledgarden/walledgarden');
		}	
	}
	
	
	
	
	
	// Make sure init is called on initialisation
	register_elgg_event_handler('init','system','invitation_init');
	register_elgg_event_handler('init','system','invwalledgarden_init');
	register_elgg_event_handler('pagesetup','system','invitations_submenus');
	
	// Register actions
	register_action('invitations',false,$CONFIG->pluginspath . "invitations/actions/register.php");
	register_action('invitations/send',false,$CONFIG->pluginspath . "invitations/actions/send.php");
	register_action('invitations/register',false,$CONFIG->pluginspath . "invitations/actions/register.php");
	register_action('invitationregister',false,$CONFIG->pluginspath."invitations/actions/invitationregisteraction.php");
	register_action('invitations/delete',false,$CONFIG->pluginspath."invitations/actions/delete.php");
	register_action('invitations/userallow',false,$CONFIG->pluginspath."invitations/actions/admin/user/invitationsuserallow.php");
	register_action('invitations/userdisallow',false,$CONFIG->pluginspath."invitations/actions/admin/user/invitationsuserdisallow.php");
		

?>