<?php
/**
 * Navigation
 */
?>

/* ***************************************
	PAGINATION
*************************************** */
.elgg-pagination {
	margin: 10px 0;
	display: block;
	text-align: center;
}
.elgg-pagination li {
	display: inline;
	margin: 0 6px 0 0;
	text-align: center;
}
.elgg-pagination a, .elgg-pagination span {
	padding: 2px 6px;
	color:#788A9A;
	font-size: 12px;
}
.elgg-pagination a:hover {
	color:#151515;
	text-decoration: none;
}
.elgg-pagination .elgg-state-disabled span {
	color:#151515;
}
.elgg-pagination .elgg-state-selected span {
	color: #000;
}

/* ***************************************
	TABS
*************************************** */
.elgg-tabs {
	margin-bottom: 1px;
	border-bottom: 1px solid #fff;
	display: table;
	width: 100%;
	color: #000;
}
.elgg-tabs li {
	float: left;
	border: 1px solid #fff;
	border-bottom-width: 0;
	background: #1E1F21;
	margin: 0 0 0 10px;
}
.elgg-tabs a {
	text-decoration: none;
	display: block;
	padding: 3px 10px 0 10px;
	text-align: center;
	height: 21px;
	color: #d2d8de;
}
.elgg-tabs a:hover {
	color: #000;
	background:#5A5A5A;
}
.elgg-tabs .elgg-state-selected {
	background: none;
}
.elgg-tabs .elgg-state-selected a {
	position: relative;
	color: #E2E2E2;
	border-bottom: 1px solid #E2E2E2;
}

/* ***************************************
	BREADCRUMBS
*************************************** */
.elgg-breadcrumbs {
	font-size: 80%;
	font-weight: bold;
	line-height: 1.2em;
	color:#909090;
}
.elgg-breadcrumbs > li {
	display: inline-block;
}
.elgg-breadcrumbs > li:after {
	content: "\003E";
	padding: 0 4px;
	font-weight: normal;
}
.elgg-breadcrumbs > li > a {
	display: inline-block;
}
.elgg-breadcrumbs > li > a:hover {
}
.elgg-main .elgg-breadcrumbs {
	position: relative;
	top: -6px;
	left: 0;
}

/* ***************************************
	TOPBAR MENU
*************************************** */
.elgg-menu-topbar {
    font-size:90%;
    text-transform: uppercase;
	float: left;

}
.elgg-menu-topbar > li {
	float: left;
}
.elgg-menu-topbar > li > a {
	padding: 2px 15px 0;
	margin-top: 1px;
}
.elgg-menu-topbar > li > a:hover {
	text-decoration: none;
	color: #000;
}
.elgg-menu-topbar-alt {
	float: right;
}
.elgg-menu-topbar-alt > li > a{
	padding-right:0;
}
.elgg-menu-topbar-default > li > a{
	padding-left:0;
}

.elgg-menu-topbar .elgg-icon {
	vertical-align: middle;
	margin-top: -1px;
}

.elgg-menu-topbar > li > a.elgg-topbar-logo {
	margin-top: 0;
	padding-left: 5px;
	width: 38px;
	height: 20px;
}

.elgg-menu-topbar > li > a.elgg-topbar-avatar {
	width: 18px;
	height: 18px;
}

/* ***************************************
	SITE MENU
*************************************** */
.elgg-menu-site {
	z-index: 1;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #123d54;
    text-transform: uppercase;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg50.png) repeat;
	box-shadow: inset 0 0 15px 2px #fff; /* inner glow */
	color: #000

}
.elgg-menu-site > li > a {
	font-family: Arial, Tahoma, Verdana, sans-serif;
	font-weight: bold;
	padding: 3px 13px 0px 13px;
	height: 18px;
	box-shadow: inset 0 0 2px 1px #fff; /* inner glow */
}

.elgg-menu-site > li > a:hover {
	text-decoration: none;
}

.elgg-menu-site-default {
	position: absolute;
	bottom: 0;
	left: 0;
	height: 23px;
}
.elgg-menu-site-default > li {
	float: left;
	margin-right: 1px;
}
.elgg-menu-site-default > li > a {
	color: black;
}
.elgg-menu-site > li > ul {
	display: none;
}
.elgg-menu-site > li:hover > ul {
	display: block;
}
.elgg-menu-site-default > .elgg-state-selected > a,
.elgg-menu-site-default > li:hover > a {
	padding-bottom:1px;
   	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg30.png) repeat;
    color: #000;
    border-bottom:none;	
	box-shadow: inset 0 0 5px 2px #fff; /* inner glow */
}

.elgg-menu-site-more {
	position: relative;
	width: 100%;
	min-width: 150px;
}

.elgg-menu-site-more > li > a {
    background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg30.png) repeat;
    color: #000;
	font-size: smaller;
}

.elgg-menu-site-more > li > a:hover {
    background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg40.png) repeat;
    color: #00C5F9;
	font-size: smaller;
	box-shadow: inset 0 0 5px 2px #000; /* inner glow */
}

.elgg-menu-site-more > li:last-child > a,
.elgg-menu-site-more > li:last-child > a:hover {

}

.elgg-more > a:before {
	content: "\25BC";
	font-size: smaller;
	margin-right: 4px;
}

/* ***************************************
	TITLE
*************************************** */
.elgg-menu-title {
	float: right;
}

.elgg-menu-title > li {
	display: inline-block;
	margin-left: 4px;
}

/* ***************************************
	FILTER MENU
*************************************** */
.elgg-menu-filter {
	margin-bottom: 5px;
	border-bottom: 1px solid #fff;
	display: table;
	width: 100%;
}
.elgg-menu-filter > li {
	float: left;
	border: 1px solid #fff;
	border-bottom-width: 0;
	background: #151515;
	margin: 0 0 0 10px;

}
.elgg-menu-filter > li:hover {
	background: #4a80ff;
}
.elgg-menu-filter > li > a {
	text-decoration: none;
	display: block;
	padding: 3px 10px 0;
	text-align: center;
	height: 21px;
	color: #d2d8de;
}
.elgg-menu-filter > li > a:hover {
	color: #3744fa;
	background:#909090;

}
.elgg-menu-filter > .elgg-state-selected {
	background: none;
}
.elgg-menu-filter > .elgg-state-selected > a {
	position: relative;
	color: #000;
}

/* ***************************************
	PAGE MENU
*************************************** */
.elgg-menu-page {
	margin-bottom: 15px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000;
	padding: 3px 20px;
	background: -webkit-gradient(
		inear, left top, left bottom, 
		from(#afd9fa),
		to(#588fad));
		-moz-border-radius: 6px;
		-webkit-border-radius: 6px;
		border-radius: 6px;
		border: 1px solid #fff;
		background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/main.jpg) top;
		box-shadow: inset 0 0 10px 2px #fff; /* inner glow */
}

.elgg-menu-page a {
	display: block;
	margin: 0 0 3px;
	padding: 2px 4px 2px 0;
}
.elgg-menu-page a:hover {
	box-shadow: 0 0 2px 0 #fff; /* drop shadow */
	color: #45C7FF;
	text-decoration: none;
}
.elgg-menu-page li.elgg-state-selected > a {
	color: #fff;
	border: 1px solid #fff;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/main.jpg) top;
	box-shadow: 0 0 2px 0 #fff; /* drop shadow */
}
.elgg-menu-page .elgg-child-menu {
	display: none;
	margin-left: 15px;
}
.elgg-menu-page .elgg-menu-closed:before, .elgg-menu-opened:before {
	display: inline-block;
	padding-right: 4px;
}
.elgg-menu-page .elgg-menu-closed:before {
	content: "\002B";
}
.elgg-menu-page .elgg-menu-opened:before {
	content: "\002D";
}

/* ***************************************
	HOVER MENU
*************************************** */
.elgg-menu-hover {
	display: none;
	position: absolute;
	z-index: 10000;

	width: 160px;
	border: solid 1px;
	border-color: #151515;
    background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg40.png) repeat;
	box-shadow: 0 0 6px 1px #fff; /* drop shadow */

}
.elgg-menu-hover > li {
	border-bottom: 1px solid #ddd;
}
.elgg-menu-hover > li:last-child {
	border-bottom: none;
}
.elgg-menu-hover .elgg-heading-basic {
	display: block;
}
.elgg-menu-hover a {
	padding: 2px 8px;
	font-size: 92%;
}
.elgg-menu-hover a:hover {
	color:#FFF;
	background: #151515;
	text-decoration: none;
}
.elgg-menu-hover-admin a {
	color: red;
}
.elgg-menu-hover-admin a:hover {
	color: white;
	background-color: red;
}

/* ***************************************
	SITE FOOTER
*************************************** */
.elgg-menu-footer > li,
.elgg-menu-footer > li > a {
	display: inline-block;
}

.elgg-menu-footer > li:after {
	content: "\007C";
	padding: 0 4px;
}

.elgg-menu-footer-default {
	float: right;
}

.elgg-menu-footer-alt {
	float: left;
}

/* ***************************************
	GENERAL MENU
*************************************** */
.elgg-menu-general > li,
.elgg-menu-general > li > a {
	display: inline-block;
	color: #999;
}

.elgg-menu-general > li:after {
	content: "\007C";
	padding: 0 4px;
}

/* ***************************************
	ENTITY AND ANNOTATION
*************************************** */
<?php // height depends on line height/font size ?>
.elgg-menu-entity, elgg-menu-annotation {
	float: right;
	margin-left: 15px;
	font-size: 90%;
	color: #151515;
	line-height: 16px;
	height: 16px;
}
.elgg-menu-entity > li, .elgg-menu-annotation > li {
	margin-left: 15px;
}
.elgg-menu-entity > li > a, .elgg-menu-annotation > li > a {
	color: #151515;
}
.elgg-menu-entity > li > a:hover, .elgg-menu-annotation > li > a:hover {
	color:#788A9A;
}
<?php // need to override .elgg-menu-hz ?>
.elgg-menu-entity > li > a, .elgg-menu-annotation > li > a {
	display: block;
}
.elgg-menu-entity > li > span, .elgg-menu-annotation > li > span {
	vertical-align: baseline;
}

/* ***************************************
	OWNER BLOCK
*************************************** */
.elgg-menu-owner-block li a {
	display: block;
	margin: 3px 0 5px 0;
	padding: 2px 4px 2px 0;
	border: 1px solid #fff;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/main.jpg) top;
	box-shadow: inset 0 0 10px 2px #fff; /* inner glow */
}
.elgg-menu-owner-block li a:hover {
	text-decoration: none;
	box-shadow: 0 0 5px #000; /* outer glow */
	color: #000;
}
.elgg-menu-owner-block li.elgg-state-selected > a {
	color: red;
}

/* ***************************************
	LONGTEXT
*************************************** */
.elgg-menu-longtext {
	float: right;
}

/* ***************************************
	RIVER
*************************************** */
.elgg-menu-river {
	float: right;
	margin-left: 15px;
	font-size: 90%;
	color: #151515;
	line-height: 16px;
	height: 16px;
}
.elgg-menu-river > li {
	display: inline-block;
	margin-left: 5px;
}
.elgg-menu-river > li > a {
	color: #151515;
	height: 16px;
}
.elgg-menu-river > li > a:hover {
	color:#788A9A;
}
<?php // need to override .elgg-menu-hz ?>
.elgg-menu-river > li > a {
	display: block;
}
.elgg-menu-river > li > span {
	vertical-align: baseline;
}

/* ***************************************
	SIDEBAR EXTRAS (rss, bookmark, etc)
*************************************** */
.elgg-menu-extras {
	margin-bottom: 10px;
}