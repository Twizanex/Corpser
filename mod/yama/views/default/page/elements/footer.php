<?php
/**
 * Elgg footer
 * The standard HTML footer that displays across the site
 *
 * @package Elgg
 * @subpackage Core
 *
 */
$site = elgg_get_site_entity();
$site_name = $site->name;
echo elgg_view_menu('footer', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));
?>

&copy; Copyright <?php echo date('Y');?> <?php echo $site->name; ?> - <a href="http://www.yamaazizi.com" title="Arweb : Yama Azizi">Yama</a>