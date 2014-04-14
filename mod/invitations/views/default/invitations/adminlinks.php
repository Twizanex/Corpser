<?php

?>

<a href="<?php echo $vars['url']; ?>action/invitations/userallow?guid=<?php echo $vars['entity']->guid; ?>"><?php echo elgg_echo("invitations:usersetting:label:allow"); ?></a>
<a href="<?php echo $vars['url']; ?>action/invitations/userdisallow?guid=<?php echo $vars['entity']->guid; ?>"><?php echo elgg_echo("invitations:usersetting:label:disallow"); ?></a>