<?php
	/**
	 * View a single page
	 *
	 * @package ElggPages
	 */
	
	$page_guid = (int) get_input('guid');
	$page = get_entity($page_guid);
	if (!$page) {
		forward();
	}
	
	// load pages library
	elgg_load_library('elgg:pages');
	
	elgg_set_page_owner_guid($page->getContainerGUID());
	
	group_gatekeeper();
	
	$container = elgg_get_page_owner_entity();
	
	$title = $page->title;
	if($page->draft=='draft')
		$title = $title . " (" . elgg_echo("pages_tools:draft_indicator") . ")";
	
	// make breadcrumb
	elgg_push_breadcrumb(elgg_echo("pages"), "pages/all");
	if (elgg_instanceof($container, 'group')) {
		elgg_push_breadcrumb($container->name, "pages/group/$container->guid/all");
	} else {
		elgg_push_breadcrumb($container->name, "pages/owner/$container->username");
	}
	pages_prepare_parent_breadcrumbs($page);
	elgg_push_breadcrumb($title);
	
	$content = elgg_view_entity($page, array('full_view' => true));
	$isroot = pages_tools_get_root_page($page)==$page;
	if($isroot)
	{
		$content .= '<br />';
		$content .= '<br />';
		$content .= '<div class=\'unselectablecorpseflow\'>';
		$content .= elgg_view('pages/sidebar/navigationtop', array('page' => $page));
		$content .= '</div>';
		$content .= '<br />';
		$content .= '<div class=\'unselectablecorpseflow\'>';
		$content .= elgg_view('pages/sidebar/pagedetails', array('page' => $page));
		$content .= '</div>';
	}
	
	if(!$isroot && $page->draft=='draft')
	{
		$options = array(
		'relationship' => 'discussion',
		'relationship_guid' => $page_guid,
		'inverse_relationship' => false,
		'limit' => 1,
		);
		$discussion = elgg_get_entities_from_relationship($options);
		
		if($discussion)
		{
			$group = get_entity($discussion[0]->container_guid);
			$content .= '<br />';
			$content .= '<br />';
			$content .= elgg_view_entity($discussion[0], array('full_view' => true));
			if ($discussion[0]->status == 'closed') {
				$content .= elgg_view('discussion/replies', array(
			'entity' => $discussion[0],
			'show_add_form' => false,
			));
			$content .= elgg_view('discussion/closed');
			} elseif ($group->canWriteToContainer(0, 'object', 'groupforumtopic') || elgg_is_admin_logged_in()) {
			$content .= elgg_view('discussion/replies', array(
			'entity' => $discussion[0],
			'show_add_form' => true,
			));
			} else {
			$content .= elgg_view('discussion/replies', array(
			'entity' => $discussion[0],
			'show_add_form' => false,
			));
			}
		}
	}
	
	if($page->allow_comments != "no"){
	if(!$discussion || $page->draft!='draft')
		$content .= elgg_view_comments($page);
	}
	
	// rules of stories
	$childrensPages = pages_tools_get_ordered_children(pages_tools_get_root_page($page));
	$rootPage = pages_tools_get_root_page($page);
	if(end($childrensPages)->guid == $page->guid || $rootPage->storytype=='gamebook')
	{
		$continue = '';
		if($rootPage->storytype=='gamebook')
			$continue = 'pages_tools:continuegamestory';
		if($rootPage->storytype=='normal')
			$continue = 'pages_tools:continuestory';
		if($rootPage->storytype=='exqcorpse')
			$continue = 'pages_tools:continuecorpse';
			
		// can add subpage if can edit this page and write to container (such as a group)
		if ($page->canEdit() && $container->canWriteToContainer(0, 'object', 'page')) {
			$wholocked= pages_tools_check_story_lock($page->guid);
			if( $wholocked == elgg_get_logged_in_user_guid() || $wholocked==null)
			{
			//if ($page->canEdit()) {
				if($page->draft=='publish' && pages_tools_is_my_turn($page->getGUID()))
				{
					$url = "pages/continue/$page->guid";
					elgg_register_menu_item('title', array(
						'name' => 'subpage',
						'href' => $url,
						'text' => elgg_echo($continue),
						'link_class' => 'elgg-button elgg-button-submit',
					));
				}
				if($page->draft=='draft' && $page->owner_guid==elgg_get_logged_in_user_guid())
				{
					$url = "pages/approve/$page->guid";
					elgg_register_menu_item('title', array(
						'name' => 'subpage',
						'href' => $url,
						'text' => elgg_echo("pages_tools:approve_draft"),
						'link_class' => 'elgg-button elgg-button-submit',
					));
				}
			}
			else
			{
			$username = get_user($wholocked)->username;
			$url = "profile/$username";
				elgg_register_menu_item('title', array(
					'name' => 'subpage',
					'href' => $url,
					'text' => elgg_echo('pages_tools:locked_by',$username),
					'link_class' => 'elgg-locked-by',
					));
			}
		}
		
		
	}
	
	elgg_load_css("lightbox");
	elgg_load_js("lightbox");
	
	//elgg_register_menu_item('title', array(
	//					'name' => 'export',
	//					'href' => "pages/export/" . $page->getGUID(),
	//					'text' => elgg_echo('export'),
	//					'link_class' => 'elgg-button elgg-button-action pages-tools-lightbox',
	//));
	
	
	if($isroot)
	{
			$child = pages_tools_get_ordered_children($page);
			if($child)
			{	
			
				$options = array(
					"type" => "object",
					"subtype" => "page",
					"limit" => false,
					"metadata_name_value_pairs" => array("parent_guid" => $page->getGUID()));	
				
				$children = elgg_get_entities_from_metadata($options);
				
				elgg_register_menu_item('title', array(
				'name' => 'subpage',
				'href' => "pages/view/" . end($children)->getGUID(),
				'text' => elgg_echo('pages_tools:read_story'),
				'link_class' => 'elgg-button elgg-button-submit',));
				
				if(pages_tools_can_request_participation($page->getGUID()) && $page->owner_guid!=elgg_get_logged_in_user_guid())
				{
					$url = "pages/requestparticipation/$page->guid";
					elgg_register_menu_item('title', array(
						'name' => 'request',
						'href' => $url,
						'text' => elgg_echo("pages_tools:request_participation"),
						'link_class' => 'elgg-button elgg-button-submit',
					));
				}
				
				if(pages_tools_has_invitation($page->getGUID()))
				{
					$url = "pages/acceptinvitation/$page->guid";
					elgg_register_menu_item('title', array(
						'name' => 'invitation',
						'href' => $url,
						'text' => elgg_echo("pages_tools:accept_invitation"),
						'link_class' => 'elgg-button elgg-button-submit',
					));
				}
				
				if(pages_tools_has_request_participation($page->getGUID()))
				{
					elgg_register_menu_item('title', array(
						'selected'  => true,
						'name' => 'request',
						'href' => false,
						'text' => elgg_echo("pages_tools:request_applied"),
						'link_class' => 'elgg-button elgg-button-submit',
					));
				}


			}

		$body = elgg_view_layout('content', array(
		'filter' => '',
		'content' => $content,
		'title' => $title,
		//'sidebar' => elgg_view('pages/sidebar/navigation'),
	));
	}
	else
	{
	$body = elgg_view_layout('content', array(
		'filter' => '',
		'content' => $content,
		'title' => $title,
		'sidebar' => elgg_view('pages/sidebar/navigation'),
	));
	}
	
	echo elgg_view_page($title, $body);
