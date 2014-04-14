<?php


	function pages_tools_invite_editors($page_guid, $members=null)
	{
		$entity = get_entity($page_guid);
		if(!$entity)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward(REFERER);
		}
		$ischosen = $members;
		if(!$members)
		{
			system_message("no members");
			$group = get_entity($entity->container_guid);
			if(!$group)
			{
				system_message("nogroup");
				return false;
			}
			$count = $group->getMembers(0, 0, true);
			$members = $group->getMembers($count);
		}
		else
			$count = count($members);
		
		system_message("invitaciones: " . $count);
		
		foreach($members as $member) {
				if($ischosen)
				{
					if($member!=elgg_get_logged_in_user_guid()){
						add_entity_relationship($member, 'invited_to', $page_guid);}
					else
						$count = $count - 1;
				}
				else
				{
					if($member->getGUID()!=elgg_get_logged_in_user_guid()){
						add_entity_relationship($member->getGUID(), 'invited_to', $page_guid);}
					else
						$count = $count - 1;
				}
				//invitar por correo
			}
		
		system_message(elgg_echo("pages_tools:membersinvited"), $count);
		
		return true;
	}
	
	function pages_tools_get_invited_users($page_guid)
	{
		$entity = get_entity($page_guid);
		if(!$entity)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward(REFERER);
		}
		
		$options = array(
		'type' => 'user',
		'relationship' => 'invited_to',
		'relationship_guid' => $page_guid,
		'inverse_relationship' => true,
		'limit' => 0,
		);
		return elgg_get_entities_from_relationship($options);
	}
	
	function pages_tools_get_participation_requests($page_guid)
	{
		$entity = get_entity($page_guid);
		if(!$entity)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward(REFERER);
		}
		
		$options = array(
		'type' => 'user',
		'relationship' => 'request_participation_to',
		'relationship_guid' => $page_guid,
		'inverse_relationship' => true,
		'limit' => 0,
		);
		return elgg_get_entities_from_relationship($options);
	}
	
	function pages_tools_accept_request($invited_guid, $page_guid)
	{
		add_entity_relationship($invited_guid, 'editing', $page_guid);
		//avisar por correo
	}
	
	function pages_tools_can_approve($page_guid)
	{
		$entity = get_entity($page_guid);
		if(!$entity)
		{
			return false;
		}
		
		$rootstory = pages_tools_get_root_page($page_guid);
		if(!$rootstory)
		{
			return false;
		}
		
		if($entity->draft='draft' && $rootstory->owner_guid==elgg_get_logged_in_user_guid())
			return true;
		return false;
	}
	
	function pages_tools_is_invited($page_guid)
	{
		$entity = get_entity($page_guid);
		if(!$entity)
		{
			return false;
		}
		
		$roundNo = elgg_get_entities(array('subtypes'=>'round', 'container_guid'=>$page_guid, 'limit'=>0, 'count'=>true ));
		
		if($roundNo>1)
		{
			return false;
		}
		
		if(!check_entity_relationship(elgg_get_logged_in_user_guid(), 'invited_to', $page_guid))
		{
			return false;
		}
		if(check_entity_relationship(elgg_get_logged_in_user_guid(), 'editing', $page_guid))
		{
			return false;
		}
		return true;
	}
	
	function pages_tools_accept_invitation($page_guid)
	{
		$entity = get_entity($page_guid);
		if(!$entity)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward(REFERER);
		}
		
		$roundNo = elgg_get_entities(array('subtypes'=>'round', 'container_guid'=>$page_guid, 'limit'=>0, 'count'=>true ));
		
		if($roundNo>1)
		{
			register_error(elgg_echo("pages_tools:error:already_started"));
			forward(REFERER);
		}
		
		if(!check_entity_relationship(elgg_get_logged_in_user_guid(), 'invited_to', $page_guid))
		{
			register_error(elgg_echo("pages_tools:error:no_invited"));
			forward(REFERER);
		}
		if(check_entity_relationship(elgg_get_logged_in_user_guid(), 'editing', $page_guid))
		{
			register_error(elgg_echo("pages_tools:error:already_editing"));
			forward(REFERER);
		}
			add_entity_relationship(elgg_get_logged_in_user_guid(), 'editing', $page_guid);
			//avisar por correo
			system_message(elgg_echo("pages_tools:invitation_accepted"));
			forward(REFERER);
	}
	
	function pages_tools_reject_invitation($page_guid, $user)
	{
		$entity = get_entity($page_guid);
		if(!$entity)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward(REFERER);
		}
		$invited_relationship = check_entity_relationship($user, 'invited_to', $pageguid);
		if(!$invited_relationship)
		{
			register_error(elgg_echo("pages_tools:error:no_invited"));
			forward(REFERER);
		}
		return delete_relationship($invited_relationship->id);
		
	}
	
	function pages_tools_create_round($page_guid)
	{
		$entity = get_entity($page_guid);
		if(!$entity)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward(REFERER);
		}
		
		$roundNo = elgg_get_entities(array('subtypes'=>'round', 'container_guid'=>$page_guid, 'limit'=>0, 'count'=>true ));
		
		if($roundNo >= $entity->corpses_rounds)
			return false;
		
		$round = new ElggObject();
		$round->subtype = "round";
		$round->access_id = 2;
		$round->container_guid = $page_guid;
		$round->title = String($roundNo + 1);
		$round->save();
		
		$options = array(
		'type' => 'user',
		'relationship' => 'editing',
		'relationship_guid' => $page_guid,
		'inverse_relationship' => true,
		'limit' => 0,
		);
		$editors = elgg_get_entities_from_relationship($options);
		shuffle($editors);
		$i = 1;
		foreach($editors as $editor)
		{
			$turn = new ElggObject();
			$turn->subtype = "turn";
			$turn->access_id = 2;
			$turn->container_guid = $round;
			$turn->title = String($i);
			$turn->description = 'notassigned';
			$turn->save();
			add_entity_relationship($editors->getGUID(), 'assigned', $turn->getGUID());
			$i++;
		}
		
		return pages_tools_step_turn($page_guid);
	}
	
	function pages_tools_close_story($page_guid)
	{
		$entity = get_entity($page_guid);
		if(!$entity)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward(REFERER);
		}
		$entity->story_status = 'closed';
		$entity->save();
		//avisar por correo
	}
	
	function pages_tools_step_turn($page_guid)
	{
		$result = false;
		$entity = get_entity($page_guid);
		if(!$entity)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward(REFERER);
		}
		
		$roundNo = elgg_get_entities(array('subtypes'=>'round', 'container_guid'=>$page_guid, 'limit'=>0 ));
		
		if(!$roundNo)
			return false;
		$turns =  elgg_get_entities(array('subtypes'=>'turn', 'container_guid'=>end($roundNo)->getGUID(), 'limit'=>0 ));
		
		if(!$turns)
			return false;
		
		$i=0;
		$pos=null;
		foreach($turns as $turn)
		{
			$i++;
			if($turn->description=='notassigned')
			{
				if($i==1)
				{
					$turn->description='active';
					$result=true;
					//avisar
				}
				else
					$turn->description='queue';
			}
			else
			{
				if($turn->description=='done')
					continue;
				if($turn->description=='active')
				{
					$pos=$i;
					$turn->description='done';
				}
				if($turn->description=='queue')
					continue;
			}
			$turn->save();
		}
		if($pos)
		{	
			$turns[$i]->description='active';
			$turns[$i]->save();
			$result = true;
			//avisar
		}
		
		return $result;
	}
	
	function pages_tools_remember_invitation($pageguid, $user)
	{
	}
	
	function pages_tools_revision_sent($page_guid, $newpage)
	{
		system_message("pages_tools_revision_sent");
		//tengo que crear una nueva discución sobre el corpse.
		$entity = get_entity($page_guid);
		if(!$entity)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward(REFERER);
		}
		system_message("pages_tools_revision_sent keep story");
		if($newpage)
		{
			$topic = new ElggObject();
			$topic->subtype = 'groupforumtopic';
			$topic->title = elgg_echo("pages_tools:discussion_title_for_corpse") . ": " . $entity->title;
			$topic->description = elgg_echo("pages_tools:discussion_description_for_corpse", $entity->title);
			$topic->status = 'open';
			$topic->access_id = 2;
			$topic->container_guid = $entity->container_guid;
			$topic->save();
			add_entity_relationship($page_guid, 'discussion', $topic->getGUID());
		}
		
		
	}
	
	function pages_tools_is_my_turn($page_guid)
	{
		return true;
	}
	
	function pages_tools_can_request_participation($page_guid)
	{
		$page = get_entity($page_guid);
		if(!$page)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward(REFERER);
		}
			
		if($page->whogroup=='chosen')
			return false;
		
		$group = get_entity($page->container_guid);
		
		if(!$group || $group->type!='group')
			return false;
		
		if(!$group->isMember(get_entity(elgg_get_logged_in_user_guid())))
			return false;
		
		if(check_entity_relationship(elgg_get_logged_in_user_guid(), 'editing', $page_guid))
			return false;
			
		if(check_entity_relationship(elgg_get_logged_in_user_guid(), 'request_participation_to', $page_guid))
			return false;
			
		if(check_entity_relationship(elgg_get_logged_in_user_guid(), 'invited_to', $page_guid))
			return false;
		
		return true;
	}
	
	function pages_tools_has_request_participation($page_guid)
	{
		$page = get_entity($page_guid);
		if(!$page)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward(REFERER);
		}
		
		if(check_entity_relationship(elgg_get_logged_in_user_guid(), 'request_participation_to', $page_guid))
			return true;
		return false;
	}
	
	function pages_tools_has_invitation($page_guid)
	{
		$page = get_entity($page_guid);
		if(!$page)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward(REFERER);
		}
		if(check_entity_relationship(elgg_get_logged_in_user_guid(), 'editing', $page_guid))
			return false;
		
		if(check_entity_relationship(elgg_get_logged_in_user_guid(), 'invited_to', $page_guid))
			return true;
		return false;
	}
	
	function pages_tools_set_request_participation($page_guid)
	{
		$page = get_entity($page_guid);
		if(!$page)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward(REFERER);
		}
		
		if($page->whogroup=='chosen')
		{
			register_error(elgg_echo("pages_tools:story_does_not_allow_requests"));
			forward(REFERER);
		}
		
		$group = get_entity($page->container_guid);
		
		if(!$group || $group->type!='group')
			return false;
		
		if(!$group->isMember(get_entity(elgg_get_logged_in_user_guid())))
		{
			register_error(elgg_echo("pages_tools:cannot_apply_for_request"));
			forward(REFERER);
		}
		
		if(check_entity_relationship(elgg_get_logged_in_user_guid(), 'editing', $page_guid))
		{
			register_error(elgg_echo("pages_tools:user_already_request"));
			forward(REFERER);
		}
		
		if(add_entity_relationship(elgg_get_logged_in_user_guid(), 'request_participation_to', $page_guid))
			system_message("pages_tools_revision_sent keep story");
		else
			register_error(elgg_echo("pages_tools:user_already_request"));
		forward(REFERER);
	}
	
	function pages_tools_approve_revision($page_guid)
	{
		$entity = get_entity($page_guid);
		if(!$entity)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward(REFERER);
		}
		$entity->draft='publish';
		$entity->save();
		//avisar
		return true;
	}
	
	function pages_tools_delete_page($pageguid)
	{
	}

	function pages_tools_check_story_lock($page_guid)
	{
		$options = array(
		'type' => 'user',
		'relationship' => 'lockedby',
		'relationship_guid' => $page_guid,
		'inverse_relationship' => false,
		'limit' => 1,
		);
		$lock = elgg_get_entities_from_relationship($options);
		
		if(!$lock)
		{
			return null;
		}
		else
		{
			return $lock[0]->getGUID();
		}
	}
		
	function pages_tools_set_story_lock($page_guid, $user_guid)
	{
		$entity = get_entity($page_guid);
		$lock = pages_tools_check_story_lock($page_guid);
		
		if(!$lock)
		{
			if($entity->iscontainer=='colective' && $entity->storytype!='gamebook' || $entity->iscontainer!='colective' && $entity->indstorytype!='gamebook')
			{
				return add_entity_relationship($page_guid, 'lockedby', $user_guid);
			}
			else
			{
				return true;
			}
		}
		
		if($lock== $user_guid)
		{
			return true;
		}
		else
		{
			//another user lock this story
			return false;
		}
	}

	function pages_tools_is_valid_page($entity){
		$result = false;
		
		if(!empty($entity)){
			if(elgg_instanceof($entity, "object", "page_top") || elgg_instanceof($entity, "object", "page")){
					$result = true;
			}
		}
		
		return $result;
	}
	
	function pages_tools_get_ordered_children(ElggObject $page){
		$result = false;
		
		if(!empty($page) && pages_tools_is_valid_page($page)){
			
			$options = array(
				"type" => "object",
				"subtype" => "page",
				"limit" => false,
				"metadata_name_value_pairs" => array("parent_guid" => $page->getGUID())
			);
			
			if($children = elgg_get_entities_from_metadata($options)){
				$result = array();
				
				foreach($children as $child){
					$order = $child->order;
					if($order === NULL){
						$order = $child->time_created;
					}
					
					while(array_key_exists($order, $result)){
						$order++;
					}
					
					$result[$order] = $child;
				}
				
				ksort($result);
			}
		}
		
		return $result;
	}
	
	/**
	 * Render the index for every page below the provided page
	 * 
	 * @param ElggObject $page
	 * @return boolean
	 */
	function pages_tools_render_index(ElggObject $page){
		$result = false;
		
		if(!empty($page) && pages_tools_is_valid_page($page)){
			if($children = pages_tools_get_ordered_children($page)){
				$result = "";
				
				foreach($children as $child){
					$result .= "<li>" . elgg_view("output/url", array("text" => $child->title, "href" => "#page_" . $child->getGUID(), "title" => $child->title));
					
					if($child_index = pages_tools_render_index($child)){
						$result .= "<ul>" . $child_index . "</ul>";
					}
					
					$result .= "</li>";
				}
			}
		}
		
		return $result;
	}
	
	function pages_tools_render_childpages(ElggObject $page){
		$result = false;
		
		if(!empty($page) && pages_tools_is_valid_page($page)){
			if($children = pages_tools_get_ordered_children($page)){
				$result = "";
				
				foreach($children as $child){
					$result .= "<h3>" . elgg_view("output/url", array("text" => $child->title, "href" => false, "name" => "page_" . $child->getgUID())) . "</h3>";
					$result .= elgg_view("output/longtext", array("value" => $child->description));
					$result .= "<p style='page-break-after:always;'></p>";
					
					if($child_pages = pages_tools_render_childpages($child)){
						$result .= $child_pages;
					}
				}
			}
		}
		
		return $result;
	}
	
	/**
	 * Register a complete tree to a menu in order to display navigation
	 * 
	 * @param ElggObject $page
	 */
	function pages_tools_register_navigation_tree(ElggObject $entity){
		$result = false;
		if(pages_tools_is_valid_page($entity)){
			if($root_page = pages_tools_get_root_page($entity)){
				
				$class = "";
				if(!$root_page->canEdit()){
					$class = "no-edit";
				}
				
				if(pages_tools_register_navigation_tree_children($root_page)){
				
					$result = true;
					
					// register root page
					elgg_register_menu_item("pages_nav", array(
						"name" => "page_" . $root_page->getGUID(),
						"text" => $root_page->title,
						"href" => $root_page->getURL(),
						"rel" => $root_page->getGUID(),
						"item_class" => $class,
						"class" => "pages-tools-wrap"
					));
				}
			}
		}
		
		return $result;
	}
	
	function pages_tools_register_navigation_tree_children(ElggObject $parent_entity, $depth = 0){
		$result = false;
		
		if(pages_tools_is_valid_page($parent_entity)){
		
			if($children = pages_tools_get_ordered_children($parent_entity)){
				$result = true;
				
				foreach($children as $order => $child){
					$class = "";
					if(!$child->canEdit()){
						$class = "no-edit";
					}
					
					$params = array(
						"name" => "page_" . $child->getGUID(),
						"text" => $child->title,
						"title" => $child->title,
						"href" => $child->getURL(),
						"rel" => $child->getGUID(),
						"item_class" => $class,
						"parent_name" => "page_" . $parent_entity->getGUID(),
						"priority" => $order
					);
					
					if($depth < 4){
						$params["class"] = "pages-tools-wrap";
					}
					
					// register this item to the menu
					elgg_register_menu_item("pages_nav", $params);
					
					// register child elements
					pages_tools_register_navigation_tree_children($child, $depth + 1);
				}
			}
		}
		
		return $result;
	}
	
	function pages_tools_get_root_page(ElggObject $entity){
		$result = false;
		
		if(pages_tools_is_valid_page($entity)){
			if(elgg_instanceof($entity, "object", "page_top")){
				$result = $entity;
			} elseif(isset($entity->parent_guid)){
				$parent = get_entity($entity->parent_guid);
				
				$result = pages_tools_get_root_page($parent);
			}
		}
		
		return $result;
	}
	
	function pages_tools_use_advanced_publication_options(){
		static $result;
		
		if(!isset($result)){
			$result = false;
			
			if(($setting = elgg_get_plugin_setting("advanced_publication", "pages_tools")) && ($setting == "yes")){
				$result = true;
			}
		}
		
		return $result;
	}
	
	function pages_tools_create_epub($corpse){
		elgg_load_library("epub");
		
		$content_start =
		"<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"
		. "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\"\n"
		. "    \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\n"
		. "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n"
		. "<head>"
		. "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n"
		. "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles.css\" />\n"
		. "<title>Test Book</title>\n"
		. "</head>\n"
		. "<body>\n";

		$bookEnd = "</body>\n</html>\n";
		$fileDir = dirname(__FILE__) . '\cache';
		
		$book = new EPub();
		$book->setTitle($corpse->title);
		$book->setIdentifier("http://JohnJaneDoePublications.com/books/TestBook.html", EPub::IDENTIFIER_URI); // Could also be the ISBN number, prefered for published books, or a UUID.
		$book->setLanguage(get_current_language()); // Not needed, but included for the example, Language is mandatory, but EPub defaults to "en". Use RFC3066 Language codes, such as "en", "da", "fr" etc.
		$book->setDescription("This is a brief description\nA test ePub book as an example of building a book in PHP");
		$book->setAuthor($corpse->getContainerEntity()->name);
		$book->setPublisher("Corpser", "http://www.corpser.net"); // I hope this is a non existant address :)
		$book->setDate(time()); // Strictly not needed as the book date defaults to time().
		$book->setRights("Copyright in progress."); // As this is generated, this _could_ contain the name or licence information of the user who purchased the book, if needed. If this is used that way, the identifier must also be made unique for the book.
		$book->setSourceURL($corpse->getURL());
		
		$cssData = "body {\n  margin-left: .5em;\n  margin-right: .5em;\n  text-align: justify;\n}\n\np {\n  font-family: serif;\n  font-size: 10pt;\n  text-align: justify;\n  text-indent: 1em;\n  margin-top: 0px;\n  margin-bottom: 1ex;\n}\n\nh1, h2 {\n  font-family: sans-serif;\n  font-style: italic;\n  text-align: center;\n  background-color: #6b879c;\n  color: white;\n  width: 100%;\n}\n\nh1 {\n    margin-bottom: 2px;\n}\n\nh2 {\n    margin-top: -2px;\n    margin-bottom: 2px;\n}\n";

		$book->addCSSFile("styles.css", "css1", $cssData);
		
		$text = $corpse->description;
		if ($parse_urls) {
			$text = parse_urls($text);
		}

		$text = filter_tags($text);

		$text = elgg_autop($text);
		
		$chapter = $content_start . $text . $bookEnd;
		$book->addChapter($corpse->title, $corpse->getGUID() . ".html", $chapter, true, EPub::EXTERNAL_REF_ADD);
		
		if(!$book->finalize())
			return false;
			
		return $fileDir . '\\' . $book->saveBook($corpse->getGUID(),$fileDir);
	}
	
	function pages_tools_get_publication_wheres(){
		static $result;
		
		if(!isset($result)){
			$result = array();
			
			if(pages_tools_use_advanced_publication_options()){
				$unpublished_id = add_metastring("unpublished");
				$dbprefix = elgg_get_config("dbprefix");
				
				$query = "(e.guid NOT IN (";
				$query .= "SELECT entity_guid";
				$query .= " FROM " . $dbprefix . "metadata";
				$query .= " WHERE name_id = " . $unpublished_id;
				$query .= "))";
				
				$result[] = $query;
			}
		}
		
		return $result;
	}
	