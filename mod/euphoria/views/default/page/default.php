<?php

/*
 * Project Name:            Euphoria Theme
 * Project Description:     Theme for Elgg 1.8
 * Author:                  Shane Barron - SocialApparatus
 * License:                 GNU General Public License (GPL) version 2
 * Website:                 http://socia.us
 * Contact:                 sales@socia.us
 * 
 * File Version:            1.0
 * Last Updated:            5/11/2013
 */
// backward compatability support for plugins that are not using the new approach
// of routing through admin. See reportedcontent plugin for a simple example.
if (elgg_get_context() == 'admin') {
    if (get_input('handler') != 'admin') {
        elgg_deprecated_notice("admin plugins should route through 'admin'.", 1.8);
    }
    elgg_admin_add_plugin_settings_menu();
    elgg_unregister_css('elgg');
    echo elgg_view('page/admin', $vars);
    return true;
}

// render content before head so that JavaScript and CSS can be loaded. See #4032
$topbar = elgg_view('page/elements/topbar', $vars);
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));
$header = elgg_view('page/elements/header', $vars);
$body = elgg_view('page/elements/body', $vars);
$footer = elgg_view('page/elements/footer', $vars);

// Set the content type
header("Content-type: text/html; charset=UTF-8");

$lang = get_current_language();
$username = elgg_get_logged_in_user_entity()->username;
$url = elgg_get_site_url();
$ts = time();
$token = generate_action_token($ts);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang; ?>" lang="<?php echo $lang; ?>">
    <head>
        <?php echo elgg_view('page/elements/head', $vars); ?>
    </head>
    <body>
        <div class="elgg-page elgg-page-default">
            <div id="left-panel">
                <?php if (!elgg_is_logged_in()) { ?>
                    <div class='menu'>
                        <h3>Welcome</h3>
                        <ul>
                            <li><a href='<?php echo $url; ?>login'>Login</a></li>
                            <li><a href='<?php echo $url; ?>register'>Register</a></li>
                        </ul>
                    </div>
                <?php } ?>
                <div class='menu'>
                    <h3>Site Navigation</h3>
                    <?php
                    echo elgg_view_menu('site');
                    ?>
                </div>
                <?php if (elgg_is_logged_in()) { ?>
                    <div class='menu'>
                        <h3>Your Account</h3>
                        <ul>
                            <li><a href='<?php echo $url; ?>dashboard'>Your Dashboard</a></li>
                            <li><a href='<?php echo $url; ?>profile/<?php echo $username; ?>'>Your Profile</a></li>
                            <li><a href='<?php echo $url; ?>messages/inbox/<?php echo $username; ?>'>Your Inbox [<?php echo count_unread_messages(); ?>]</a></li>
                            <li><a href='<?php echo $url; ?>settings/user/<?php echo $username; ?>'>Your Settings</a></li>
                            <li><a href='<?php echo $url; ?>profile/<?php echo $username; ?>/edit'>Edit Profile</a></li>
                            <li><a href='<?php echo $url; ?>avatar/edit/<?php echo $username; ?>'>Edit Avatar</a></li>
                            <li><a href='<?php echo $url; ?>action/logout?__elgg_ts=<?php echo $ts; ?>&__elgg_token=<?php echo $token; ?>'>Logout</a></li>
                            <?php if (elgg_is_admin_logged_in()) { ?>
                            <li><a href='<?php echo $url; ?>admin'>Admin</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <span id='click_for_menu' class='rotate'>Hover for Menu</span>
            </div>
            <div class="elgg-page-messages">
                <?php echo $messages; ?>
            </div>

            <div class="elgg-page-header">
                <div class="elgg-inner">
                    <?php echo $header; ?>
                </div>
            </div>
            <div class="elgg-page-body">
                <div class="elgg-inner">
                    <?php echo $body; ?>
                </div>
            </div>
            <div class="elgg-page-footer">
                <div class="elgg-inner">
                    <?php echo $footer; ?>
                </div>
            </div>
        </div>
        <?php echo elgg_view('page/elements/foot'); ?>
    </body>
</html>