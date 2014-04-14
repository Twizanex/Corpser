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
?>
//<script>
    $(document).ready(function() {
        $("#left-panel").hoverIntent(function() {
            if ($(this).css("left") == "-120px") {
                $(this).animate({left: "0"});
                $(this).children(".menu").fadeIn("slow");
                $("#click_for_menu").fadeOut("slow");
            }
            if ($(this).css("left") == "0px") {
                $(this).animate({left: "-120"});
                $(this).children(".menu").fadeOut("slow");
                $("#click_for_menu").fadeIn("slow");
            }
        });
    });