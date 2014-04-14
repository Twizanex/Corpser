<?php
/**
 * Register the Elggstory class for the object/story subtype
 */

if (get_subtype_id('object', 'story')) {
	update_subtype('object', 'story', 'ElggStory');
} else {
	add_subtype('object', 'story', 'ElggStory');
}
