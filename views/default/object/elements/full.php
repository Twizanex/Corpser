<?php
/**
 * Object full rendering
 *
 * Sample output:
 * <div class="elgg-content">
 *     <div class="elgg-image-block">
 *     </div>
 *     <div class="elgg-output">
 *     </div>
 * </div>
 *
 * @uses $vars['entity']   ElggEntity
 * @uses $vars['icon']     HTML for the content icon
 * @uses $vars['summary']  HTML for the content summary
 * @uses $vars['body']     HTML for the content body
 * @uses $vars['class']    Optional additional class for the content wrapper
 */

$icon = elgg_extract('icon', $vars);
$summary = elgg_extract('summary', $vars);
$body = elgg_extract('body', $vars);
$class = elgg_extract('class', $vars);
$entity = elgg_extract('entity', $vars);

if($entity->subtype==6 && $entity->owner_guid==elgg_get_logged_in_user_entity())
	$panel = elgg_view('pages/toppanel', array(
			'entity' => $entity,));

if ($class) {
	$class = "elgg-content clearfix $class";
} else {
	$class = "elgg-content clearfix";
}

$header = elgg_view_image_block($icon, $summary);

echo <<<HTML
<div class="$class">
$header
$panel
$body
</div>
HTML;
