<?php
/**
 * Elgg likes button
 *
 * @uses $vars['entity']
 */

if (!isset($vars['entity'])) {
	return true;
}

$guid = $vars['entity']->getGUID();

// check to see if the user has already liked this
if (elgg_is_logged_in() && $vars['entity']->canAnnotate(0, 'likes')) {
	if (!elgg_annotation_exists($guid, 'likes')) {
		$params = array(
			'id' => "etklikebutton{$guid}",
			'href' => 'javascript:void(0);',
			'onclick' =>"elgg.etklikes.add({$guid});",
			'text' => elgg_view_icon('star'),
			'title' => elgg_echo('likes:likethis'),
			'is_trusted' => true,
		);
		$likes_button = elgg_view('output/url', $params);
	} else {
		$params = array(
			'id' => "etklikebutton{$guid}",
			'href' => 'javascript:void(0);',
			'onclick' =>"elgg.etklikes.delete({$guid});",
			'text' => elgg_view_icon('star-alt'),
			'title' => elgg_echo('likes:remove'),
			'is_trusted' => true,
		);
		$likes_button = elgg_view('output/url', $params);
	}
}

echo $likes_button;
