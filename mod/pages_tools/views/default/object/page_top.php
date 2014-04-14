<?php
/**
 * View for page object
 *
 * @package ElggPages
 *
 * @uses $vars['entity']    The page object
 * @uses $vars['full_view'] Whether to display the full view
 * @uses $vars['revision']  This parameter not supported by elgg_view_entity()
 */


$full = elgg_extract('full_view', $vars, FALSE);
$page = elgg_extract('entity', $vars, FALSE);
$revision = elgg_extract('revision', $vars, FALSE);
$parent_guid = elgg_extract('parent_guid', $vars, FALSE);
$isroot = pages_tools_get_root_page($page) == $page;

if (!$page) {
	return TRUE;
}

// pages used to use Public for write access
if ($page->write_access_id == ACCESS_PUBLIC) {
	// this works because this metadata is public
	$page->write_access_id = ACCESS_LOGGED_IN;
}

if($page->storytype=='normal'){
   $storytype = elgg_echo('pages_tools:shortnormal');}
if($page->storytype=='exqcorpse'){
   $storytype = elgg_echo('pages_tools:exquisitecorpse');}
if($page->storytype=='gamebook'){
   $storytype = elgg_echo('pages_tools:gamebook');}

if ($revision) {
	$annotation = $revision;
} else {
	$annotation = $page->getAnnotations('page', 1, 0, 'desc');
	if ($annotation) {
		$annotation = $annotation[0];
	}
}

if ($isroot){
	//$page_icon = elgg_view('pages/icon', array('annotation' => $annotation, 'size' => 'small'));
	$page_icon = elgg_view_entity_icon($page, 'medium');
	}

$editor = get_entity($annotation->owner_guid);
$editor_link = elgg_view('output/url', array(
	'href' => "pages/owner/$editor->username",
	'text' => $editor->name,
	'is_trusted' => true,
));

$date = elgg_view_friendly_time($annotation->time_created);
$editor_text = elgg_echo('pages:strapline', array($date, $editor_link));
$categories = elgg_view('output/categories', $vars);

// show comments
$comments_link = '';
if($page->allow_comments != "no"){
	$comments_count = $page->countComments();
	//only display if there are commments
	if ($comments_count != 0 && !$revision) {
		$text = elgg_echo("comments") . " ($comments_count)";
		$comments_link = elgg_view('output/url', array(
			'href' => $page->getURL() . '#page-comments',
			'text' => $text,
			'is_trusted' => true,
		));
	}
}

// group string
$group_string = "";
$container = $page->getContainerEntity();
if(elgg_instanceof($container, "group") && ($container->getGUID() != elgg_get_page_owner_guid())){
	$group_link = elgg_view("output/url", array(
		"text" => $container->name,
		"href" => $container->getURL(),
		"is_trusted" => true
	));
	
	$group_string = elgg_echo("river:ingroup", array($group_link));
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'pages',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$subtitle = "$storytype $editor_text $group_string $comments_link $categories";

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets') || $revision) {
	$metadata = '';
}

if ($full) {
	if (!$isroot){
	$body = elgg_view('output/nofullscreenslidertext', array('value' => $annotation->value, 'page' => $page));}
	else {
	$body = elgg_view('output/nofullscreenslidertext', array('value' => $annotation->value));}

	$params = array(
		'entity' => $page,
		'title' => false,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	echo elgg_view('object/elements/full', array(
		'entity' => $page,
		'title' => false,
		'icon' => $page_icon,
		'summary' => $summary,
		'body' => $body,
	));

} else {
	// brief view

	$excerpt = elgg_get_excerpt($page->description);

	$params = array(
		'entity' => $page,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'content' => $excerpt,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block($page_icon, $list_body);
}