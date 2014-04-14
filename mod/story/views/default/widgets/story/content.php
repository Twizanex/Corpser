<?php
/**
 * User story widget display view
 */

$num = $vars['entity']->num_display;

$options = array(
	'type' => 'object',
	'subtype' => 'story',
	'container_guid' => $vars['entity']->owner_guid,
	'limit' => $num,
	'full_view' => FALSE,
	'pagination' => FALSE,
);
$content = elgg_list_entities($options);

echo $content;

if ($content) {
	$story_url = "story/owner/" . elgg_get_page_owner_entity()->username;
	$more_link = elgg_view('output/url', array(
		'href' => $story_url,
		'text' => elgg_echo('story:morestorys'),
		'is_trusted' => true,
	));
	echo "<span class=\"elgg-widget-more\">$more_link</span>";
} else {
	echo elgg_echo('story:nostorys');
}
