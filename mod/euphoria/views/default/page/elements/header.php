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

// link back to main site.
echo elgg_view('page/elements/header_logo', $vars);

// drop-down login
echo elgg_view('core/account/login_dropdown');

// insert site-wide navigation
// echo elgg_view_menu('site');