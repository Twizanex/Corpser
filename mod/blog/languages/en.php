<?php
/**
 * Blog English language file.
 *
 */

$english = array(
	'blog' => 'Stories',
	'blog:blogs' => 'Stories',
	'blog:revisions' => 'Revisions',
	'blog:archives' => 'Archives',
	'blog:blog' => 'Story',
	'item:object:blog' => 'Stories',

	'blog:title:user_blogs' => '%s\'s Stories',
	'blog:title:all_blogs' => 'All Stories',
	'blog:title:friends' => 'Friends\' Stories',

	'blog:group' => 'Group story',
	'blog:enableblog' => 'Enable group story',
	'blog:write' => 'Create a story',

	// Editing
	'blog:add' => 'Create a story',
	'blog:edit' => 'Edit story',
	'blog:excerpt' => 'Epigraph',
	'blog:body' => 'Preface',
	'blog:save_status' => 'Last saved: ',
	'blog:never' => 'Never',

	// Statuses
	'blog:status' => 'Status',
	'blog:status:draft' => 'Draft',
	'blog:status:published' => 'Published',
	'blog:status:unsaved_draft' => 'Unsaved Draft',

	'blog:revision' => 'Revision',
	'blog:auto_saved_revision' => 'Auto Saved Revision',

	// messages
	'blog:message:saved' => 'Story saved.',
	'blog:error:cannot_save' => 'Cannot save story.',
	'blog:error:cannot_write_to_container' => 'Insufficient access to save story to group.',
	'blog:messages:warning:draft' => 'There is an unsaved draft of this story!',
	'blog:edit_revision_notice' => '(Old version)',
	'blog:message:deleted_post' => 'Story deleted.',
	'blog:error:cannot_delete_post' => 'Cannot delete story.',
	'blog:none' => 'No stories',
	'blog:error:missing:title' => 'Please enter a story title!',
	'blog:error:missing:description' => 'Please enter the preface of your story!',
	'blog:error:cannot_edit_post' => 'This story may not exist or you may not have permissions to edit it.',
	'blog:error:revision_not_found' => 'Cannot find this revision.',

	// river
	'river:create:object:blog' => '%s published a story %s',
	'river:comment:object:blog' => '%s commented on the story %s',

	// notifications
	'blog:newpost' => 'A new story',
	'blog:notification' =>
'
%s made a new story.

%s
%s

View and comment on the new story:
%s
',

	// widget
	'blog:widget:description' => 'Display your latest stories',
	'blog:moreblogs' => 'More stories',
	'blog:numbertodisplay' => 'Number of stories to display',
	'blog:noblogs' => 'No stories'
);

add_translation('en', $english);
