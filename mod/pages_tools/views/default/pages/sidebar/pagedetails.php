<?php
	/**
	 * Navigation menu for a user's or a group's pages
	 *
	 * @uses $vars['page'] Page object if manually setting selected item
	 */
	
	$page_guid = (int) get_input("guid");
	$page = false;
	if(!empty($page_guid)){
		$page = get_entity($page_guid);
	}
	
	$selected_page = elgg_extract("page", $vars, $page);

	// do we have a selected page
	if(pages_tools_is_valid_page($selected_page)){
		// make the navigation tree
		echo $selected_page;
		if(pages_tools_register_navigation_tree($selected_page)){
			$title = elgg_echo("pages:page_details");
			//$title .= "<span " . elgg_format_attributes(array("class" => "float-alt", "title" => elgg_echo("pages_tools:navigation:tooltip"))) . ">";
			//$title .= elgg_view_icon("info");
			//$title .= "</span>";
			
			// get the navigation menu
			$menu = "hello";
			echo elgg_view_module("aside", $title, $menu);
		}
	}
	