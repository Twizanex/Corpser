<?php
/**
 * PreLoadMe
 */
?>

body {
    overflow: hidden;
}

/* Preloader */

#preloader {
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background-color:#fff; /* change if the mask should have another color then white */
    z-index:99; /* makes sure it stays on top */
}

#status {
    width:200px;
    height:200px;
    position:absolute;
    left:50%; /* centers the loading animation horizontally one the screen */
    top:50%; /* centers the loading animation vertically one the screen */
    <?php if (!elgg_get_plugin_setting('preloader_url', 'preloadme')) { ?>
        background-image:url(<?php echo elgg_get_site_url(); ?>_graphics/ajax_loader.gif);
    <?php } else { ?>
        background-image:url(<?php echo elgg_get_plugin_setting('preloader_url', 'preloadme') ?>);
    <?php } ?>
    background-repeat:no-repeat;
    background-position:center;
    margin:-100px 0 0 -100px; /* is width and height divided by two */
}

.elgg-page-header { 
	z-index: 100;
}