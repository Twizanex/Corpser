<?php

	require_once(dirname(__FILE__) . "/lib/functions.php");
	require_once(dirname(__FILE__) . "/lib/hooks.php");

	function pages_tools_init(){
		// register DOM PDF as a library
		elgg_register_library("dompdf", dirname(__FILE__) . "/vendors/dompdf.php");
		// register Epub Creator as a library
		elgg_register_library("epub", dirname(__FILE__) . "/vendors/PHPepub/EPub.php");
		
		// extend site css
		elgg_extend_view("css/elgg", "pages_tools/css/site");
		
		// extend site js
		elgg_extend_view("js/elgg", "pages_tools/js/site");
		
		// register JS library
		elgg_register_js("jquery.tree", elgg_get_site_url() . "mod/pages_tools/vendors/jstree/jquery.tree.min.js");
		elgg_register_css("jquery.tree", elgg_get_site_url() . "mod/pages_tools/vendors/jstree/themes/classic/style.css");
		
		elgg_register_js("epubreader", elgg_get_site_url() . "mod/pages_tools/vendors/epub.js-master/demo/js/reader.min.js");
		elgg_register_js("inflate", elgg_get_site_url() . "mod/pages_tools/vendors/epub.js-master/demo/js/libs/inflate.js");
		elgg_register_js("epubrender", elgg_get_site_url() . "mod/pages_tools/vendors/epub.js-master/build/epub.js");
		elgg_register_js("epubhook", elgg_get_site_url() . "mod/pages_tools/vendors/epub.js-master/demo/js/hooks.min.js");
		elgg_register_js("fullscreen", elgg_get_site_url() . "mod/pages_tools/vendors/epub.js-master/demo/js/libs/screenfull.min.js");
		elgg_register_js("zip", elgg_get_site_url() . "mod/pages_tools/vendors/epub.js-master/demo/js/libs/zip.min.js");
		
		elgg_register_css("epubreadercss1", elgg_get_site_url() . "mod/pages_tools/vendors/epub.js-master/demo/css/annotator.css");
		elgg_register_css("epubreadercss2", elgg_get_site_url() . "mod/pages_tools/vendors/epub.js-master/demo/css/main.css");
		elgg_register_css("epubreadercss3", elgg_get_site_url() . "mod/pages_tools/vendors/epub.js-master/demo/css/normalize.css");
		elgg_register_css("epubreadercss4", elgg_get_site_url() . "mod/pages_tools/vendors/epub.js-master/demo/css/popup.css");
		
		elgg_register_js("garlic", elgg_get_site_url() . "mod/pages_tools/vendors/garlic/garlic.min.js");
		
		elgg_register_js("jquery.bxslider", elgg_get_site_url() . "mod/pages_tools/vendors/bxslider/jquery.bxslider.min.js");
		elgg_register_css("jquery.bxslider", elgg_get_site_url() . "mod/pages_tools/vendors/bxslider/themes/classic/jquery.bxslider.css");
		
		// add widgets (overrule default pages widget, to add group support)
		elgg_register_widget_type("pages", elgg_echo("pages"), elgg_echo("pages:widget:description"), "profile,dashboard,groups");
		elgg_register_widget_type("index_pages", elgg_echo("pages"), elgg_echo("pages_tools:widgets:index_pages:description"), "index", true);
		
		// register plugin hooks
		elgg_register_plugin_hook_handler("route", "pages", "pages_tools_route_pages_hook");
		elgg_register_plugin_hook_handler("register", "menu:entity", "pages_tools_entity_menu_hook");
		elgg_register_plugin_hook_handler("permissions_check:comment", "object", "pages_tools_permissions_comment_hook");
		elgg_register_plugin_hook_handler("widget_url", "widget_manager", "pages_tools_widget_url_hook");
		elgg_register_plugin_hook_handler("cron", "daily", "pages_tools_daily_cron_hook");
		
		// register actions
		//elgg_register_action("pages/export", dirname(__FILE__) . "/actions/export.php", "public");
		elgg_register_action("pages/reorder", dirname(__FILE__) . "/actions/reorder.php");
		
		// overrule action
		elgg_register_action("pages/edit", dirname(__FILE__) . "/actions/pages/edit.php");
		elgg_register_action("pages/savedraft", dirname(__FILE__) . "/actions/pages/savedraft.php");
		elgg_register_action("pages/invite", dirname(__FILE__) . "/actions/pages/invite.php");
	}

	// register default Elgg events
	elgg_register_event_handler("init", "system", "pages_tools_init");
	