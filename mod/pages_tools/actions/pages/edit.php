<?php
	/**
	 * Create or edit a page
	 *
	 * @package ElggPages
	 */
	
	$user = elgg_get_logged_in_user_entity();
	$variables = elgg_get_config("pages");
	$input = array();
	foreach ($variables as $name => $type) {
		$input[$name] = get_input($name);
		if ($name == "title") {
			$input[$name] = htmlspecialchars(get_input($name, "", false), ENT_QUOTES, "UTF-8");
		}
		if ($type == "tags") {
			$input[$name] = string_to_tag_array($input[$name]);
		}
	}
	//to save variables that are not already defined in start.php (mod/pages)
	$iscontainer = get_input('iscontainer');
	$input['iscontainer'] = get_input('iscontainer');
	$input['rating'] = get_input('rating');
	
	if($iscontainer == 'colective')
	{
		$input['storytype'] = get_input('storytype');
		$input['corpses_word_number'] = get_input('corpses_word_number');
		$input['corpses_word_number_max'] = get_input('corpses_word_number_max');
		$input['whogroup'] = get_input('whogroup');
	}
	else
	{
		$input['storytype'] = get_input('indstorytype');
	}
	
	if($input['storytype']!='exqcorpse')
	{
		$input['corpses_number'] = get_input('corpses_number');
	}
	else
	{
		$input['corpses_rounds'] = get_input('corpses_rounds');
	}
	
	$input['story_status'] = get_input('story_status');
	$input['draft'] = get_input('draft');
	
	if($input['story_status']=="No")
	{
	  $input['turn']=$user->getGUID();
	}
		
	
	// Get guids
	$page_guid = (int) get_input("page_guid");
	if($iscontainer == 'colective')
	{
		$container_guid = (int) get_input("container_guid");
	}
	else
	{
		$container_guid = $user->getGUID();
	}
	$parent_guid = (int) get_input("parent_guid");
	
	$oldpageEdit = get_entity($page_guid);
	$oldstatus = $oldpageEdit->draft;
	
	// allow comments
	$allow_comments = get_input("allow_comments", "yes");
	
	elgg_make_sticky_form("page");
	
	if (!$input["title"]) {
		register_error(elgg_echo("pages:error:no_title"));
		forward(REFERER);
	}
	
	if ($page_guid) {
		$page = get_entity($page_guid);
		if (!$page || !$page->canEdit()) {
			register_error(elgg_echo("pages:error:no_save"));
			forward(REFERER);
		}
		$new_page = false;
	} else {
		$page = new ElggObject();
		if ($parent_guid) {
			$page->subtype = "page";
		} else {
			$page->subtype = "page_top";
		}
		$new_page = true;
	}
	
	if (sizeof($input) > 0) {
		// don't change access if not an owner/admin
		$can_change_access = true;
		
		if ($user && $page) {
			$can_change_access = ($user->isAdmin() || ($user->getGUID() == $page->owner_guid));
		}
		
		foreach ($input as $name => $value) {
			if (($name == "access_id" || $name == "write_access_id") && !$can_change_access) {
				continue;
			}
			if ($name == "parent_guid") {
				continue;
			}
			$page->$name = $value;
		}
		$page->write_access_id=ACCESS_LOGGED_IN;
	}
	
	// need to add check to make sure user can write to container
	$page->container_guid = $container_guid;
	
	// allow moving of subpages
	if ($parent_guid && ($parent_guid != $page_guid)) {
		// Check if parent isn't below the page in the tree
		if (!$new_page && ($page->parent_guid != $parent_guid)) {
			$tree_page = get_entity($parent_guid);
			
			while (($tree_page->parent_guid > 0) && ($page_guid != $tree_page->getGUID())) {
				$tree_page = get_entity($tree_page->parent_guid);
			}
			
			// If is below, bring all child elements forward
			if ($page_guid == $tree_page->getGUID()) {
				$previous_parent = (int) $page->parent_guid;
				
				$options = array(
					"type" => "object",
					"subtype" => "page",
					"container_guid" => $page->getContainerGUID(),
					"limit" => false,
					"metadata_name_value_pairs" => array(
						"name" => "parent_guid",
						"value" => $page->getGUID()
					)
				);
				
				if ($children = elgg_get_entities_from_metadata($options)) {
					foreach ($children as $child) {
						$child->parent_guid = $previous_parent;
					}
				}
			}
		}
		$page->parent_guid = $parent_guid;
	}
	
	if($new_page && pages_tools_get_root_page($page)->storytype=='normal' || $new_page && pages_tools_get_root_page($page)->storytype=='exqcorpse'){
			$page->parent_guid = pages_tools_get_root_page($page)->getGUID();}
	
	
	// allow comments
	$page->allow_comments = $allow_comments;
	
	// check for publication/expiration date
	$publication_date = get_input("publication_date");
	$expiration_date = get_input("expiration_date");
	
	// first reset publication status
	unset($page->unpublished);
	
	$page->publication_date = $publication_date;
	if(!empty($publication_date)){
		if(strtotime($publication_date) > time()){
			$page->unpublished = true;
		}
	}
	
	$page->expiration_date = $expiration_date;
	$page->access_id = ACCESS_LOGGED_IN;
	if(!empty($expiration_date)){
		if($new_page){
			// new pages can't expire directly
			if(strtotime($expiration_date) < time()){
				register_error(elgg_echo("pages_tools:actions:edit:error:expiration_date"));
			}
		} else {
			if(strtotime($expiration_date) < time()){
				$page->unpublished = true;
			}
		}
	}
	system_message("story status: " . $input['story_status']);
	system_message("old story status: " . $oldpageEdit->story_status);
	
	// save the page
	if ($page->save()) {
	
		elgg_clear_sticky_form("page");
		
		if(pages_tools_get_root_page($page)!=$page)
			pages_tools_revision_sent($page->getGUID(), $new_page);
			
		// Now save description as an annotation
		$page->annotate("page", $page->description, $page->access_id);
		
		$corpsedraft = null;
		if(!$page->parent_guid)
			$corpsedraft = elgg_get_entities(array('types' =>'object', 'subtypes'=>'storydraft', 'owner_guids' => elgg_get_logged_in_user_guid()));
		else
			$corpsedraft = elgg_get_entities(array('types' =>'object', 'subtypes'=>'corpsedraft', 'owner_guids' => elgg_get_logged_in_user_guid()));
	
		if($corpsedraft)
		{
			foreach($corpsedraft as $corpse)
			{
			delete_entity($corpse->guid);
			}
		}
		
		if(!$parent_guid)
		{
		//If the story will be edited for a fixed amount of group users, lets create a relationship for each user
		$options = array(
		'type' => 'user',
		'relationship' => 'invited_to',
		'relationship_guid' => $page_guid,
		'inverse_relationship' => true,
		'limit' => 0,
		);
		$invited = elgg_get_entities_from_relationship($options);
		
		if(!$invited && $input['story_status']=="1")
		{
		system_message("debo invitar");
		if($input['whogroup']=='chosen')
		{
			system_message("elegidos");
			$who_picked = get_input('who_picked' . $container_guid);
			pages_tools_invite_editors($page_guid, $who_picked);
		}
		else
		{
			system_message("a todos");
			pages_tools_invite_editors($page_guid);
		}
		}
		}
		system_message(elgg_echo("pages:saved"));
	
		if ($new_page && !$page->unpublished) {
			if (pages_tools_get_root_page($page)!=$page){
			    add_to_river("river/object/page/create", "create", $user->getGUID(), $page->getGUID());}
			else{
			    add_to_river("river/object/page_top/create", "create", $user->getGUID(), $page->getGUID());}
		} 
		elseif($page->getOwnerGUID() != $user->getGUID()) {
			// not the owner edited the page, notify the owner
			$subject = elgg_echo("pages_tools:notify:edit:subject", array($page->title));
			$msg = elgg_echo("pages_tools:notify:edit:message", array($page->title, $user->name, $page->getURL()));
			
			notify_user($page->getOwnerGUID(), $user->getGUID(), $subject, $msg);
		}
		
		if (($new_page && pages_tools_get_root_page($page)==$page && $page->draft!='draft') || (!$new_page && $page->draft!='draft' && $oldstatus=="draft")){
			forward("pages/edit/$page->guid");}
		else{
			//Notify followers
			$subject = elgg_echo("pages_tools:notify:newcorpsefollow:subject", array($page->title));
			$msg = elgg_echo("pages_tools:notify:newcorpsefollow:message", array($page->title, $user->name, $page->getURL()));
			
			$rootannotations = pages_tools_get_root_page($page)->getAnnotations('like',10000);
			foreach($rootannotations as $suscription){
				notify_user($page->getOwnerGUID(), $suscription->owner_guid, $subject, $msg);}
			
			if(!pages_tools_get_ordered_children($page) && pages_tools_get_root_page($page)==$page && $page->draft!='draft')
			{forward("pages/add/$page->guid");}
			else{
			forward($page->getURL());}
		}
			
		
	} else {
		register_error(elgg_echo("pages:error:no_save"));
		forward(REFERER);
	}
