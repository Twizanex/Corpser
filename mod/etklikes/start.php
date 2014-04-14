<?php
/**
 * Easytalkee Ajax Likes plugin
 *
 */ 
 
elgg_register_event_handler('init', 'system', 'likes_init');

function likes_init() {

	elgg_extend_view('css/elgg', 'etklikes/css');
	elgg_extend_view('js/elgg', 'etklikes/js');

	// registered with priority < 500 so other plugins can remove likes
	elgg_register_plugin_hook_handler('register', 'menu:river', 'likes_river_menu_setup', 400);
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'likes_entity_menu_setup', 400);

	$actions_base = elgg_get_plugins_path() . 'etklikes/actions/etklikes';
	elgg_register_action('etklikes/add', "$actions_base/add.php");
	elgg_register_action('etklikes/delete', "$actions_base/delete.php");
	elgg_register_action('etklikes/deletebylikeid', "$actions_base/deletebylikeid.php");	
}

	function is_valid_page($entity){
		$result = false;
		
		if(!empty($entity)){
			if(elgg_instanceof($entity, "object", "page_top") || elgg_instanceof($entity, "object", "page")){
				$result = true;
			}
		}
		
		return $result;
	}
	
	function get_root_page(ElggObject $entity){
		$result = false;
		
		if(is_valid_page($entity)){
			if(elgg_instanceof($entity, "object", "page_top")){
				$result = $entity;
			} elseif(isset($entity->parent_guid)){
				$parent = get_entity($entity->parent_guid);
				
				$result = get_root_page($parent);
			}
		}
		
		return $result;
	}

/**
 * Add likes to entity menu at end of the menu
 */
function likes_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}
	
	$parent = get_root_page($params['entity']);
	if($parent){
		$entity=$parent;}
	else{
		$entity = $params['entity'];}

	// likes button
	$options = array(
		'name' => 'likes',
		'text' => elgg_view('etklikes/button', array('entity' => $entity)),
		'href' => false,
		'priority' => 1000,
	);
	$return[] = ElggMenuItem::factory($options);

	// likes count
	$count = elgg_view('etklikes/count', array('entity' => $entity));
	if ($count || true) {
		$options = array(
			'name' => 'likes_count',
			'text' => $count,
			'href' => false,
			'priority' => 1001,
		);
		$return[] = ElggMenuItem::factory($options);
	}

	return $return;
}

/**
 * Add a like button to river actions
 */
function likes_river_menu_setup($hook, $type, $return, $params) {
	if (elgg_is_logged_in()) {
		$item = $params['item'];

		// only like group creation #3958
		if ($item->type == "group" && $item->view != "river/group/create") {
			return $return;
		}

		// don't like users #4116
		if ($item->type == "user") {
			return $return;
		}
	
		
		$object = $item->getObjectEntity();
		if (!elgg_in_context('widgets') && $item->annotation_id == 0) {
			if ($object->canAnnotate(0, 'likes')) {
				// like button
				//$options = array(
				//	'name' => 'likes',
				//	'href' => false,
				//	'text' => elgg_view('etklikes/button', array('entity' => $object)),
				//	'is_action' => true,
				//	'priority' => 100,
				//);
				//$return[] = ElggMenuItem::factory($options);

				// likes count
				$count = elgg_view('etklikes/count', array('entity' => $object));
				if ($count) {
					$options = array(
						'name' => 'likes_count',
						'text' => $count,
						'href' => false,
						'priority' => 101,
					);
					$return[] = ElggMenuItem::factory($options);
				}
			}
		}
	}

	return $return;
}

/**
 * Count how many people have liked an entity.
 *
 * @param  ElggEntity $entity
 *
 * @return int Number of likes
 */
function likes_count($entity) {
	$type = $entity->getType();
	$params = array('entity' => $entity);
	$number = elgg_trigger_plugin_hook('likes:count', $type, $params, false);

	if ($number) {
		return $number;
	} else {
		return $entity->countAnnotations('likes');
	}
}

/**
 * Return the json result to front end AJAX call
 *
 * @param  bool $isSuccessful
 * @param  String $msg
 * @param  ElggEntity $entity
 *
 */
function returnAjaxResult($isSuccessful = true, $msg = "",$entity = null) {
	if ($entity) {
		$button = elgg_view('etklikes/button', array('entity' => $entity));
		$count = elgg_view('etklikes/count', array('entity' => $entity));
		$json = array('success' => $isSuccessful,'message'=>$msg,'guid'=>$entity->guid,'button'=>$button,'count'=>$count);
	}
	else
		$json = array('success' => $isSuccessful,'message'=>$msg);
	echo json_encode($json);
}




/**
 * Notify $user that $liker liked his $entity.
 *
 * @param type $user
 * @param type $liker
 * @param type $entity 
 */
function likes_notify_user(ElggUser $user, ElggUser $liker, ElggEntity $entity) {
	
	if (!$user instanceof ElggUser) {
		return false;
	}
	
	if (!$liker instanceof ElggUser) {
		return false;
	}
	
	if (!$entity instanceof ElggEntity) {
		return false;
	}
	
	$title_str = $entity->title;
	if (!$title_str) {
		$title_str = elgg_get_excerpt($entity->description);
	}

	$site = get_config('site');

	$subject = elgg_echo('likes:notifications:subject', array(
					$liker->name,
					$title_str
				));

	$body = elgg_echo('likes:notifications:body', array(
					$user->name,
					$liker->name,
					$title_str,
					$site->name,
					$entity->getURL(),
					$liker->getURL()
				));

	notify_user($user->guid,
				$liker->guid,
				$subject,
				$body
			);
}