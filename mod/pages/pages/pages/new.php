<?php
/**
 * Create a new page
 *
 * @package ElggPages
 */

gatekeeper();

$container_guid = (int) get_input('guid');
$container = get_entity($container_guid);
if (!$container) {

}

$parent_guid = 0;
$page_owner = $container;
if (elgg_instanceof($container, 'object')) {
	$parent_guid = $container->getGUID();
	$page_owner = $container->getContainerEntity();
}

elgg_set_page_owner_guid($page_owner->getGUID());

$descstory=array(elgg_echo('pages:desc1'),elgg_echo('pages:desc2'),elgg_echo('pages:desc3'),elgg_echo('pages:desc4'),elgg_echo('pages:desc5'));

if($parent_guid==0){
	$title = elgg_echo('pages:addtitle', array($descstory[array_rand($descstory)]));
	$titleFormal = elgg_echo('pages:add');
}
else
{
	$title = elgg_echo('pages:addtitleCorpse', array($descstory[array_rand($descstory)]));
	$titleFormal = elgg_echo('pages:addtitle');
}

elgg_push_breadcrumb($titleFormal);

$vars = pages_prepare_form_vars(null, $parent_guid);
$form_vars = array();
$content = elgg_view_form('pages/edit', $form_vars, $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);
