<?php
	/**
	 * Create or edit a page
	 *
	 * @package ElggPages
	 */
	$data = get_input('draftdata');
	$context = get_input('context');
	$parent_guid = get_input('parent_guid');
	$title = get_input('title');

	//system_message("hola, este es mi parentid: " . $parent_guid);
	//system_message("hola, este es mi title: " . $title);
	$user = elgg_get_logged_in_user_guid();
	
	$subtype = null;
	$continue = explode(' ',elgg_echo('pages:addtitleCorpse'));
	$create = explode(' ',elgg_echo('pages:addtitle'));
	
	if(strstr($context, $continue[0]))
	{
		//system_message("estoy en corpse");
		$subtype = 'corpsedraft';
	}
	if(strstr($context, $create[0]))
	{
		//system_message("estoy en story");
	    $subtype = 'storydraft';
	}
	
	$corpsedraft = null;
	if($subtype == 'corpsedraft')
		$corpsedraft = elgg_get_entities(array('types' =>'object', 'subtypes'=>$subtype, 'owner_guids' => $user, 'container_guids' => $parent_guid ));
	
	if($subtype == 'storydraft')
		$corpsedraft = elgg_get_entities(array('types' =>'object', 'subtypes'=>$subtype, 'owner_guids' => $user));
		
	if($corpsedraft)
	{
		$corpsedraft[0]->description = $data;
		$corpsedraft[0]->title = $title;
		if(!$corpsedraft[0]->save())
			system_message(elgg_echo('pages_tools:draft_not_created'));
	}
	else
	{
		$object = new ElggObject();
		$object->subtype = $subtype;
		$object->access_id = 2;
		$object->title = $title;
		if($subtype == 'corpsedraft')
			$object->container_guid = $parent_guid;
		$object->description = $data;
		if(!$object->save())
			system_message(elgg_echo('pages_tools:draft_not_created'));
	}
	/*
	if($corpsedraft)
	{
		foreach($corpsedraft as $corpse)
		{
		delete_entity($corpse->guid);
		}
	}
		
	$object = new ElggObject();
	$object->subtype = $subtype;
	$object->access_id = 2;
	$object->title = $title;
	$object->container_guid = $parent_guid;
	$object->description = $data;
	if(!$object->save())
		system_message(elgg_echo('pages_tools:draft_not_created'));*/