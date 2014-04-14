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

elgg_register_event_handler('init', 'system', 'euphoria_init');

function euphoria_init() {
    elgg_extend_view("css/elgg", "euphoria/css");
    elgg_extend_view("js/elgg", "euphoria/js");
    elgg_unextend_view('page/elements/header', 'search/header');
    elgg_register_js("jquery", "//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", "head", 0);
    elgg_register_js("jquery-migrate", "http://code.jquery.com/jquery-migrate-1.2.1.min.js", "head", 1);
    elgg_register_js("jquery-ui", "//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js", "head", 2);
    elgg_load_js("jquery-migrate");
    elgg_register_js("jquery-hoverintent", elgg_get_site_url() . "mod/euphoria/vendors/hoverintent/jquery.hoverIntent.minified.js");
    elgg_load_js("jquery-hoverintent");
    elgg_register_css("varela", "http://fonts.googleapis.com/css?family=Varela+Round");
    elgg_load_css("varela");
    elgg_register_js("nivo-slider", elgg_get_site_url() . "mod/euphoria/vendors/nivo-slider/jquery.nivo.slider.pack.js");
    elgg_register_css("nivo-slider-theme-default", elgg_get_site_url() . "mod/euphoria/vendors/nivo-slider/themes/default/default.css");
    elgg_register_css("nivo-slider-theme-light", elgg_get_site_url() . "mod/euphoria/vendors/nivo-slider/themes/light/style.css");
    elgg_register_css("nivo-slider-theme-dark", elgg_get_site_url() . "mod/euphoria/vendors/nivo-slider/themes/dark/dark.css");
    elgg_register_css("nivo-slider-theme-bar", elgg_get_site_url() . "mod/euphoria/vendors/nivo-slider/themes/bar/bar.css");
    elgg_register_css("nivo-slider", elgg_get_site_url() . "mod/euphoria/vendors/nivo-slider/nivo-slider.css");
}