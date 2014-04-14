<?php
/**
 * View for story objects
 *
 * @package story
 */

$full = elgg_extract('full_view', $vars, FALSE);
$story = elgg_extract('entity', $vars, FALSE);

if (!$story) {
	return TRUE;
}

$owner = $story->getOwnerEntity();
$container = $story->getContainerEntity();
$categories = elgg_view('output/categories', $vars);

if($story->storytype=='normal'){
   $storytype = elgg_echo('story:shortnormal');}
if($story->storytype=='exqcorpse'){
   $storytype = elgg_echo('story:exquisitecorpse');}
if($story->storytype=='Gamebook'){
   $storytype = elgg_echo('story:gamebook');}
   
$excerpt = $story->excerpt;
if (!$excerpt) {
	$excerpt = elgg_get_excerpt($story->description);
}

$owner_icon = elgg_view_entity_icon($owner, 'tiny');
$owner_link = elgg_view('output/url', array(
	'href' => "story/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));
$date = elgg_view_friendly_time($story->time_created);

// The "on" status changes for comments, so best to check for !Off
if ($story->comments_on != 'Off') {
	$comments_count = $story->countComments();
	//only display if there are commments
	if ($comments_count != 0) {
		$text = elgg_echo("comments") . " ($comments_count)";
		$comments_link = elgg_view('output/url', array(
			'href' => $story->getURL() . '#story-comments',
			'text' => $text,
			'is_trusted' => true,
		));
	} else {
		$comments_link = '';
	}
} else {
	$comments_link = '';
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'story',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$subtitle = "$storytype $author_text $date $comments_link $categories";

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
	$metadata = '';
}

if ($full) {

	$body = elgg_view('output/longtext', array(
		'value' => $story->description,
		'class' => 'story-post',
	));

	$params = array(
		'entity' => $story,
		'title' => false,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	echo elgg_view('object/elements/full', array(
		'summary' => $summary,
		'icon' => $owner_icon,
		'body' => $body,
	));

} else {
	// brief view

	$params = array(
		'entity' => $story,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'content' => $excerpt,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block($owner_icon, $list_body);
}
