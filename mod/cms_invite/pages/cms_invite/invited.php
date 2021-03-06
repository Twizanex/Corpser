<?php
/**
 * Elgg friends page
 *
 * @package Elgg.Core
 * @subpackage Social.Friends
 */

$owner = elgg_get_page_owner_entity();
if (!$owner) {
	// unknown user so send away (@todo some sort of 404 error)
	forward();
}

$title = elgg_echo("cms_invite:joined", array($owner->name));

$options = array(
	'relationship' => 'host',
	'relationship_guid' => $owner->getGUID(),
);
$content = elgg_list_entities_from_relationship($options);

$params = array(
	'content' => $content,
	'title' => $title,
);

//
elgg_push_context('friends');
//

$body = elgg_view_layout('one_sidebar', $params);

echo elgg_view_page($title, $body);



