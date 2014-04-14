<?php
/**
 * Likes English language file
 */

$english = array(
	'likes:this' => 'is following this',
	'likes:deleted' => 'Your follow has been removed',
	'likes:see' => 'See who are following this',
	'likes:remove' => 'Unfollow this',
	'likes:notdeleted' => 'There was a problem removing your follow',
	'likes:likes' => 'You now are following this item',
	'likes:failure' => 'There was a problem following this story',
	'likes:alreadyliked' => 'You have already following this story',
	'likes:notfound' => 'The story you are trying to follow cannot be found',
	'likes:likethis' => 'Follow this',
	'likes:userlikedthis' => '%s follower',
	'likes:userslikedthis' => '%s followers',
	'likes:river:annotate' => 'are following',

	'river:likes' => 'is following %s %s',

	// notifications. yikes.
	'likes:notifications:subject' => '%s is following your story "%s"',
	'likes:notifications:body' =>
'Hi %1$s,

%2$s is following your story "%3$s" on %4$s

See your original post here:

%5$s

or view %2$s\'s profile here:

%6$s

Thanks,
%4$s
',
	
);

add_translation('en', $english);
