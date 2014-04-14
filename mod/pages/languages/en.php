<?php
/**
 * Pages languages
 *
 * @package ElggPages
 */

$english = array(

	/**
	 * Menu items and titles
	 */

	'pages' => "Stories",
	'pages:owner' => "%s's stories...",
	'pages:friends' => "Friends stories...",
	'pages:all' => "All site stories...",
	'pages:add' => "Create a New Story",
	'pages:addCorpse' => "Continue the Story",
	'pages:addtitleCorpse' => "Continue the story with a new %s Corpse!",
	'pages:addtitle' => "Create a new %s Story!",
	
	'pages:shortnormal' => "Story",
	'pages:exquisitecorpse' => "Exquisite Corpse",
	'pages:gamebook' => "Gamebook",
	
	'pages:desc1' => "amazing",
	'pages:desc2' => "lovely",
	'pages:desc3' => "inspiring",
	'pages:desc4' => "great",
	'pages:desc5' => "awesome",
	

	'pages:group' => "Group corpses",
	'groups:enablepages' => 'Enable group corpses',

	'pages:edit' => "Edit this Corpse",
	'pages:editstory' => "Edit this Story",
	'pages:delete' => "Delete this corpse",
	'pages:history' => "History",
	'pages:view' => "View corpse",
	'pages:revision' => "Revision",
	'pages:current_revision' => "Current Revision",
	'pages:revert' => "Revert",

	'pages:navigation' => "Corpse Flow",
	'pages:new' => "A new corpse",
	'pages:notification' =>
'%s added a new corpse:

%s
%s

View and comment on the new page:
%s
',
	'item:object:page_top' => 'Top-level corpses',
	'item:object:page' => 'Corpses',
	'pages:nogroup' => 'This group does not have any corpses yet',
	'pages:more' => 'More corpses',
	'pages:none' => 'No corpses created yet',

	/**
	* River
	**/

	'river:create:object:page' => '%s created a corpse %s',
	'river:create:object:page_top' => '%s created a story %s',
	'river:update:object:page' => '%s updated a corpse %s',
	'river:update:object:page_top' => '%s updated a story %s',
	'river:comment:object:page' => '%s commented on a corpse titled %s',
	'river:comment:object:page_top' => '%s commented on a story titled %s',

	/**
	 * Form fields
	 */

	'pages:title' => 'Title',
	'pages:description' => 'Content',
	'pages:tags' => 'Tags',
	'pages:parent_guid' => 'Parent corpse',
	'pages:access_id' => 'Read access',
	'pages:write_access_id' => 'Write access',

	/**
	 * Status and error messages
	 */
	'pages:noaccess' => 'No access to corpse',
	'pages:cantedit' => 'You cannot edit this corpse',
	'pages:saved' => 'Corpse saved',
	'pages:notsaved' => 'Corpse could not be saved',
	'pages:error:no_title' => 'You must specify a title for this corpse.',
	'pages:delete:success' => 'The corpse was successfully deleted.',
	'pages:delete:failure' => 'The corpse could not be deleted.',
	'pages:revision:delete:success' => 'The corpse revision was successfully deleted.',
	'pages:revision:delete:failure' => 'The corpse revision could not be deleted.',
	'pages:revision:not_found' => 'Cannot find this revision.',

	/**
	 * Page
	 */
	'pages:strapline' => 'Last updated %s by %s',

	/**
	 * History
	 */
	'pages:revision:subtitle' => 'Revision created %s by %s',

	/**
	 * Widget
	 **/

	'pages:num' => 'Number of corpses to display',
	'pages:widget:description' => "This is a list of your corpses.",

	/**
	 * Submenu items
	 */
	'pages:label:view' => "View corpse",
	'pages:label:edit' => "Edit corpse",
	'pages:label:history' => "Corpse history",

	/**
	 * Sidebar items
	 */
	'pages:sidebar:this' => "This corpse",
	'pages:sidebar:children' => "Corpse flow",
	'pages:sidebar:parent' => "Parent",

	'pages:newchild' => "Follow this corpse",
	'pages:backtoparent' => "Back to '%s'",
);

add_translation("en", $english);
