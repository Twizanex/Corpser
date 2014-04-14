<?php
/**
 * story sidebar menu showing revisions
 *
 * @package story
 */

//If editing a post, show the previous revisions and drafts.
$story = elgg_extract('entity', $vars, FALSE);

if (elgg_instanceof($story, 'object', 'story') && $story->canEdit()) {
	$owner = $story->getOwnerEntity();
	$revisions = array();

	$auto_save_annotations = $story->getAnnotations('story_auto_save', 1);
	if ($auto_save_annotations) {
		$revisions[] = $auto_save_annotations[0];
	}

	// count(FALSE) == 1!  AHHH!!!
	$saved_revisions = $story->getAnnotations('story_revision', 10, 0, 'time_created DESC');
	if ($saved_revisions) {
		$revision_count = count($saved_revisions);
	} else {
		$revision_count = 0;
	}

	$revisions = array_merge($revisions, $saved_revisions);

	if ($revisions) {
		$title = elgg_echo('story:revisions');

		$n = count($revisions);
		$body = '<ul class="story-revisions">';

		$load_base_url = "story/edit/{$story->getGUID()}";

		// show the "published revision"
		if ($story->status == 'published') {
			$load = elgg_view('output/url', array(
				'href' => $load_base_url,
				'text' => elgg_echo('story:status:published'),
				'is_trusted' => true,
			));

			$time = "<span class='elgg-subtext'>"
				. elgg_view_friendly_time($story->time_created) . "</span>";

			$body .= "<li>$load : $time</li>";
		}

		foreach ($revisions as $revision) {
			$time = "<span class='elgg-subtext'>"
				. elgg_view_friendly_time($revision->time_created) . "</span>";

			if ($revision->name == 'story_auto_save') {
				$revision_lang = elgg_echo('story:auto_saved_revision');
			} else {
				$revision_lang = elgg_echo('story:revision') . " $n";
			}
			$load = elgg_view('output/url', array(
				'href' => "$load_base_url/$revision->id",
				'text' => $revision_lang,
				'is_trusted' => true,
			));

			$text = "$load: $time";
			$class = 'class="auto-saved"';

			$n--;

			$body .= "<li $class>$text</li>";
		}

		$body .= '</ul>';

		echo elgg_view_module('aside', $title, $body);
	}
}