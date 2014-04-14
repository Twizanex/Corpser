<?php

function hj_mechanics_setup_default_scoring_rules($hook, $type, $return, $params) {

	/**
	 * EVENT : OBJECT
	 */
	$events = array('create', 'update', 'delete');

	$types['object'] = array(
		'blog',
		'bookmarks',
		'page',
		'page_top',
		'file',
		'thewire',
		'groupforumtopic',
		// hypeJunction objects
		'hjforumtopic',
		'hjalbum',
		'hjalbumimage',
		'hjplace',
		'hjeducation',
		'hjexperience',
		'hjlanguage',
		'hjportfoliofile',
		'hjskill',
		'favorite_track',
		'playlist',
		'track'
	);

	$types['group'] = array(
		'default'
	);

	$types['annotation'] = array(
		'comment',
		'group_topic_post',
		'likes',
		'starrating'
	);


	foreach ($events as $event) {
		foreach ($types as $type => $subtypes) {
			foreach ($subtypes as $subtype) {
				$return['event']["$event:$type:$type:$subtype"][] = array(
					'conditions' => array(),
					'unique_name' => "$event:$type:$subtype"
				);

// Add reverse (get points when your entity was acted upon)
				if (($type == 'metadata' || $type == 'annotation' || $type == 'relationship') && $event == 'create') {
// Metadata of an object that describes the relationship
// We will see if owner of this entity is user, else we will assume the entity is user

					switch ($type) {
						case 'annotation' :
							$user_meta = 'entity_guid';
							$return['event']["$event:$type:$type:$subtype"][] = array(
								'conditions' => array(),
								'unique_name' => "$event:$type:$subtype:reverse",
								'reverse' => true,
								'user' => $user_meta
							);
							break;

						case 'relationship' :
							$user_meta = 'guid_two';
							$return['event']["$event:$subtype:$type:$subtype"][] = array(
								'conditions' => array(),
								'unique_name' => "$event:$type:$subtype:reverse",
								'reverse' => true,
								'user' => $user_meta
							);
							break;

						default :
							break;
					}
				}
			}
		}
	}
	/**
	 * User login and profile updates
	 */
	$return['event']["login:user:user:default"][] = array(
		'conditions' => array(),
		'unique_name' => "login:user:default"
	);

	$return['event']["profileupdate:user:user:default"][] = array(
		'conditions' => array(),
		'unique_name' => "profileupdate:user:default"
	);

	$return['event']["profileiconupdate:user:user:default"][] = array(
		'conditions' => array(),
		'unique_name' => "profileiconupdate:user:default"
	);

	/**
	 * Groups join / leave
	 */
	$return['event']["create:member:relationship:member"][] = array(
		'conditions' => array(),
		'user' => 'guid_one',
		'unique_name' => "join:group:user"
	);
	$return['event']["leave:group:user:default"][] = array(
		'conditions' => array(),
		'unique_name' => "leave:group:user"
	);

	$return['event']["create:friend:relationship:friend"][] = array(
		'conditions' => array(),
		'user' => 'guid_one',
		'unique_name' => "create:relationship:friend"
	);
	$return['event']["delete:friend:relationship:friend"][] = array(
		'conditions' => array(),
		'user' => 'guid_one',
		'unique_name' => "delete:relationship:friend"
	);

	$return['event']["create:friend:relationship:friend"][] = array(
		'conditions' => array(),
		'user' => 'guid_two',
		'reverse' => true,
		'unique_name' => "create:relationship:friend:reverse"
	);


	/**
	 * hjAnnotation
	 */
	$annotation_names = array('generic_comment', 'likes', 'group_topic_post', 'hjforumpost');

	foreach ($events as $event) {
		foreach ($annotation_names as $aname) {
			$return['event']["$event:object:object:hjannotation"][] = array(
				'conditions' => array(
					array(
							'metadata_name' => 'annotation_name',
							'metadata_value' => $aname
						)
				),
				'unique_name' => "$event:object:hjannotation:$aname"
			);

			if ($event == 'create') {
				$return['event']["$event:object:object:hjannotation"][] = array(
					'conditions' => array(
						array(
							'metadata_name' => 'annotation_name',
							'metadata_value' => $aname
						)
					),
					'reverse' => true,
					'user' => 'owner_guid',
					'unique_name' => "$event:object:hjannotation:$aname:reverse"
				);
			}
		}
	}

	return $return;
}

