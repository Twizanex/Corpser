<?php
/**
 * Edit story form
 *
 * @package story
 */

$story = get_entity($vars['guid']);
$vars['entity'] = $story;

$draft_warning = $vars['draft_warning'];
if ($draft_warning) {
	$draft_warning = '<span class="mbm elgg-text-help">' . $draft_warning . '</span>';
}

$action_buttons = '';
$delete_link = '';
$preview_button = '';

if ($vars['guid']) {
	// add a delete button if editing
	$delete_url = "action/story/delete?guid={$vars['guid']}";
	$delete_link = elgg_view('output/confirmlink', array(
		'href' => $delete_url,
		'text' => elgg_echo('delete'),
		'class' => 'elgg-button elgg-button-delete float-alt'
	));
}

// published storys do not get the preview button
if (!$vars['guid'] || ($story && $story->status != 'published')) {
	$preview_button = elgg_view('input/submit', array(
		'value' => elgg_echo('preview'),
		'name' => 'preview',
		'class' => 'mls',
	));
}

$save_button = elgg_view('input/submit', array(
	'value' => elgg_echo('save'),
	'name' => 'save',
));
$action_buttons = $save_button . $preview_button . $delete_link;

$title_label = elgg_echo('title');
$title_input = elgg_view('input/text', array(
	'name' => 'title',
	'id' => 'story_title',
	'value' => $vars['title']
));

$excerpt_label = elgg_echo('story:excerpt');
$excerpt_input = elgg_view('input/text', array(
	'name' => 'excerpt',
	'id' => 'story_excerpt',
	'value' => _elgg_html_decode($vars['excerpt'])
));

$body_label = elgg_echo('story:body');
$body_input = elgg_view('input/longtext', array(
	'name' => 'description',
	'id' => 'story_description',
	'value' => $vars['description']
));

$save_status = elgg_echo('story:save_status');
if ($vars['guid']) {
	$entity = get_entity($vars['guid']);
	$saved = date('F j, Y @ H:i', $entity->time_created);
} else {
	$saved = elgg_echo('story:never');
}

$status_label = elgg_echo('story:status');
$status_input = elgg_view('input/dropdown', array(
	'name' => 'status',
	'id' => 'story_status',
	'value' => $vars['status'],
	'options_values' => array(
		'draft' => elgg_echo('story:status:draft'),
		'published' => elgg_echo('story:status:published')
	)
));

$comments_label = elgg_echo('story:comments');
$comments_input = elgg_view('input/dropdown', array(
	'name' => 'comments_on',
	'id' => 'story_comments_on',
	'value' => $vars['comments_on'],
	'options_values' => array('On' => elgg_echo('on'), 'Off' => elgg_echo('off'))
));

$tags_label = elgg_echo('tags');
$tags_input = elgg_view('input/tags', array(
	'name' => 'tags',
	'id' => 'story_tags',
	'value' => $vars['tags']
));

$access_label = elgg_echo('story:access');
$access_input = elgg_view('input/access', array(
	'name' => 'access_id',
	'id' => 'story_access_id',
	'value' => $vars['access_id']
));

$categories_input = elgg_view('input/categories', $vars);

$storytype_label = elgg_echo('story:storytype');
$storytype_input = elgg_view('input/dropdown', array(
	'name' => 'storytype',
	'id' => 'storytype',
	'value' => $vars['storytype'],
	'options_values' => array('normal' => elgg_echo('story:normal'),
	                          'gamebook' => elgg_echo('story:gamebook'), 
	                          'exqcorpse' => elgg_echo('story:exquisitecorpse'))
));

// hidden inputs
$container_guid_input = elgg_view('input/hidden', array('name' => 'container_guid', 'value' => elgg_get_page_owner_guid()));
$guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['guid']));

echo <<<___HTML

$draft_warning

<div>
	<label for="story_title">$title_label</label>
	$title_input
</div>

<div>
	<label for="story_excerpt">$excerpt_label</label>
	$excerpt_input
</div>

<div>
	<label for="story_description">$body_label</label>
	$body_input
</div>

<div>
	<label for="story_tags">$tags_label</label>
	$tags_input
</div>

$categories_input

<div>
	<label for="story_comments_on">$comments_label</label>
	$comments_input
</div>

<div>
	<label for="story_access_id">$access_label</label>
	$access_input
</div>

<div>
	<label for="story_status">$status_label</label>
	$status_input
</div>

<div>
	<label for="storytype">$storytype_label</label>
	$storytype_input
</div>

<div class="elgg-foot">
	<div class="elgg-subtext mbm">
	$save_status <span class="story-save-status-time">$saved</span>
	</div>

	$guid_input
	$container_guid_input

	$action_buttons
</div>

___HTML;
