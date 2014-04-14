<?php
/**
 * Story English language file.
 *
 */

$english = array(
	'story' => 'Stories',
	'story:storys' => 'Stories',
	'story:revisions' => 'Revisions',
	'story:archives' => 'Archives',
	'story:story' => 'Story',
	'item:object:story' => 'Stories',

	'story:title:user_storys' => '%s\'s Stories',
	'story:title:all_storys' => 'All Stories',
	'story:title:friends' => 'Friends\' Stories',
	
	'story:access' => 'Access',
	'story:storytype' => 'Story Type',
	'story:comments' => 'Comments',
	
	'story:normal' => 'Normal Story',
	'story:gamebook' => 'Gamebook Story',
	'story:exquisitecorpse' => 'Exquisite Corpse Story',
	
	'story:shortnormal' => 'Story',
	'story:shortgamebook' => 'Gamebook',
	'story:shortexquisitecorpse' => 'Exquisite Corpse',

	'story:group' => 'Group story',
	'story:enablestory' => 'Enable group story',
	'story:write' => 'Create a story',

	// Editing
	'story:add' => 'Create a story',
	'story:edit' => 'Edit story',
	'story:excerpt' => 'Epigraph',
	'story:body' => 'Preface',
	'story:save_status' => 'Last saved: ',
	'story:never' => 'Never',

	// Statuses
	'story:status' => 'Status',
	'story:status:draft' => 'Draft',
	'story:status:published' => 'Published',
	'story:status:unsaved_draft' => 'Unsaved Draft',

	'story:revision' => 'Revision',
	'story:auto_saved_revision' => 'Auto Saved Revision',

	// messages
	'story:message:saved' => 'Story saved.',
	'story:error:cannot_save' => 'Cannot save story.',
	'story:error:cannot_write_to_container' => 'Insufficient access to save story to group.',
	'story:messages:warning:draft' => 'There is an unsaved draft of this story!',
	'story:edit_revision_notice' => '(Old version)',
	'story:message:deleted_post' => 'Story deleted.',
	'story:error:cannot_delete_post' => 'Cannot delete story.',
	'story:none' => 'No stories',
	'story:error:missing:title' => 'Please enter a story title!',
	'story:error:missing:description' => 'Please enter the preface of your story!',
	'story:error:cannot_edit_post' => 'This story may not exist or you may not have permissions to edit it.',
	'story:error:revision_not_found' => 'Cannot find this revision.',

	// river
	'river:create:object:story' => '%s published a story %s',
	'river:comment:object:story' => '%s commented on the story %s',

	// notifications
	'story:newpost' => 'A new story',
	'story:notification' =>
'
%s made a new story.

%s
%s

View and comment on the new story:
%s
',

	// widget
	'story:widget:description' => 'Display your latest stories',
	'story:morestorys' => 'More stories',
	'story:numbertodisplay' => 'Number of stories to display',
	'story:nostorys' => 'No stories'
);

add_translation('en', $english);
