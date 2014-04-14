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
$default_items = elgg_extract('default', $vars['menu'], array());

echo '<ul>';
echo "<li><a href='" . elgg_get_site_url() . "'>Home</a></li>";
foreach ($default_items as $menu_item) {
    echo elgg_view('navigation/menu/elements/item', array('item' => $menu_item));
}
echo '</ul>';