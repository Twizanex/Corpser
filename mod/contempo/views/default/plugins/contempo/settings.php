<?php

$registrationText = $vars['entity']->registrationText;
if (!$registrationText)
    $registrationText = "<h2 style='text-align: center;'>WELCOME TO OUR WEBSITE!</h2><p>&nbsp;</p><p><img src='" . $CONFIG->url . "mod/contempo/graphics/headerimage.png' border='0' alt='headerimage.png' style='border: 0px; float: left; margin-right: 10px;' /> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'</p><p><strong>'This text can be modified from the admin panel.'</strong></p>";
$homepage = $vars['entity']->homepage;
if (!$homepage)
    $homepage = "<p><img src='" . $CONFIG->url . "mod/contempo/graphics/homeimage.png' border='0' alt='homeimage.png' style='border: 0px; float: left; margin: 10px;' /></p><h2 style='text-align: center;'>Welcome to our website!</h2><p>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'</p><p>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'</p><p><strong>'This text can be modified from the admin panel.'</strong></p>";
echo "<label>Registration Text</label>";
echo elgg_view('input/longtext', array('name' => 'params[registrationText]', 'value' => $registrationText));
echo "<label>Home Page Content</label>";
echo elgg_view('input/longtext', array('name' => 'params[homepage]', 'value' => $homepage));
?>
