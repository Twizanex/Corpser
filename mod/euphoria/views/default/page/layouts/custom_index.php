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
$hometext = elgg_get_plugin_setting("hometext","euphoria");
if (!$hometext) {
    $hometext = "<h1>Edit this home text in your admin panel.</h1>";
}
$nivo_theme = elgg_get_plugin_setting("nivo_theme","euphoria");
if (!$nivo_theme) {
    $nivo_theme = "theme-default";
}
$slide1 = elgg_get_plugin_setting("slide1","euphoria");
if (!$slide1) {
    $slide1 = elgg_get_site_url()."mod/euphoria/graphics/slide1.png";
}
$slide2 = elgg_get_plugin_setting("slide2","euphoria");
if (!$slide2) {
    $slide2 = elgg_get_site_url()."mod/euphoria/graphics/slide2.png";
}
$slide3 = elgg_get_plugin_setting("slide3","euphoria");
if (!$slide3) {
    $slide3 = elgg_get_site_url()."mod/euphoria/graphics/slide3.png";
}
$slide4 = elgg_get_plugin_setting("slide4","euphoria");
if (!$slide4) {
    $slide4 = elgg_get_site_url()."mod/euphoria/graphics/slide4.png";
}
elgg_load_js("nivo-slider");
elgg_load_css("nivo-slider");
switch ($nivo_theme) {
    case "theme-default":
        elgg_load_css("nivo-slider-theme-default");
        break;
    case "theme-light":
        elgg_load_css("nivo-slider-theme-light");
        break;
    case "theme-dark":
        elgg_load_css("nivo-slider-theme-dark");
        break;
    case "theme-bar":
        elgg_load_css("nivo-slider-theme-bar");
        break;
}
?>
<div class="slider-wrapper <?php echo $nivo_theme; ?>">
    <div id="slider" class="nivoSlider">
        <img src="<?php echo $slide1; ?>" alt="" />
        <img src="<?php echo $slide2; ?>" alt="" />
        <img src="<?php echo $slide3; ?>" alt="" />
        <img src="<?php echo $slide4; ?>" alt="" />
    </div>
    <div id="htmlcaption" class="nivo-html-caption">
        <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>. 
    </div>
</div>
<div style='margin-top:10px;'>
    <?php echo $hometext; ?>    
</div>
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
</script>