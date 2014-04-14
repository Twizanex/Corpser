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
//<style>
    * {}
    body {
        background:url(<?php echo elgg_get_site_url(); ?>mod/euphoria/graphics/dots.png) center center repeat #1CA8DD;
        color:#59192A;
        font-family: 'Varela Round', sans-serif;
    }
    .elgg-page-header {
        background:none;
    }
    #left-panel {
        position:fixed;
        top:0px;
        left:-120px;
        width:150px;
        height:100%;
        background:#000000;
        z-index:100000000;
        cursor:pointer;
    }
    #left-panel a {
        color:#8D8D8D;
        display:block;
        height:34px;
        line-height:34px;
        display:block;
        background:#1F2228;
        margin:1px 0px;
        text-decoration:none;
        padding-left:20px;
        font-size:16px;
        text-shadow:.5px .5px 0px #000000;
    }
    #left-panel a:hover {
        background:#000000;
        color:#ffffff;
        text-decoration:none;
    }
    #left-panel h3 {
        color:#ffffff;
        text-align:center;
        padding:0px;
        margin-left:-10px;
        height:auto;
        display:block;
        height:38px;
        line-height:38px;
    }
    #left-panel .menu {
        display:none;
    }
    .elgg-page-default .elgg-page-body > .elgg-inner { 
        border:none;
        background:#ffffff;
        padding:8px;
        width:974px;
    }
    .elgg-page-default .elgg-page-footer > .elgg-inner {
        border:none;
        background:#ffffff;
        padding:8px;
        width:974px;
    }
    .elgg-heading-site, .elgg-heading-site:hover {
        color:#ffffff;
        font-family: 'Varela Round', sans-serif;
        text-shadow:none;
        text-decoration:none;
        font-style:normal;
    }
    .elgg-module-highlight,
    .elgg-module-highlight:hover {
        box-shadow:none;
        background:#ffffff;
    }
    .elgg-module-highlight h2 {
        color:#1F2228;
    }
    .elgg-module-featured {
        border-color:#ffffff;
    }
    .elgg-module-featured .elgg-head{
        background:#ffffff;
    }
    .elgg-menu-page li.elgg-state-selected > a {
        background-color:#1F2228;
        color:#ffffff;
    }
    .elgg-menu-page li a {
        color:#1F2228;
    }
    .elgg-menu-page li a:hover {
        background:#1F2228;
    }
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color:#1F2228;
    }
    #click_for_menu {
        text-align:center;
        position:absolute;
        right:-38px;
        top:50%;
        color:#ffffff;
    }
    .rotate {
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }
    .elgg-button-dropdown,
    .elgg-button-dropdown:hover{
        background:#333333;
        border:none;
    }
    .elgg-button-dropdown:hover {
        color:#ffffff;
    }
    .elgg-module-featured > .elgg-head * {
        color:#1F2228;
    }