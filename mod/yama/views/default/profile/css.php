<?php
/**
 * Elgg Profile CSS
 * 
 * @package Profile
 */
?>
/* ***************************************
	Profile
*************************************** */
.profile {
	float: left;
	margin-bottom:9px;
}
.profile .elgg-inner {
	margin: 0 6px;
    box-shadow: 0 0 2px 1px #fff; /* drop shadow */
    background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/main.jpg) right;
	color: #6699CC;
	
	
}
#profile-details {
	padding: 2px; 
	border-top: 1px solid #fff;
	border-right: 1px solid #fff;
	color: #000;
}
#profile-details h2{
	color: #000; 
	text-align: center;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/main.jpg) repeat;
	box-shadow: 0 0 2px 1px #fff; /* drop shadow */
	
}
/*** ownerblock ***/
#profile-owner-block {
	width: 200px;
	float: left;
	border-right: 1px solid #fff;
	border-top: 1px solid #fff;
	border-bottom: 1px solid #fff;
	padding: 0px;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/main.jpg) repeat;
	box-shadow: 0 0 2px 1px #fff; /* drop shadow */
	
	
}
#profile-owner-block .large {
	margin-bottom: 5px;
}
#profile-owner-block a.elgg-button-action {
	margin-bottom: 1px;
	text-align: center;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/main.jpg) repeat;
	box-shadow: 0 0 2px 0 #fff; /* drop shadow */
	color: #000;
	
}
.profile-content-menu a {
	display: block;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #123d54;
	margin: 2px 0 5px 0;
	padding: 2px 4px 2px 0;
	text-align: center;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg30.png) repeat;
	
}
.profile-content-menu a:hover {
	text-decoration: none;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bt.png) repeat;
	box-shadow: inset 0 0 10px 2px #fff; /* inner glow */
	
}
.profile-admin-menu {
	display: none;
}
.profile-admin-menu-wrapper a {
	display: block;
	margin: 3px 0 5px 0;
	padding: 2px 4px 2px 0;
}
.profile-admin-menu-wrapper {
}
.profile-admin-menu-wrapper li a {
	color: red;
	margin-bottom: 0;
}
.profile-admin-menu-wrapper a:hover {
	color: black;
}
/*** profile details ***/
#profile-details .odd {
	margin: 0 0 2px;
	padding: 2px 0;
}
#profile-details .even {
	margin: 0 0 2px;
	padding: 2px 0;
}
.profile-aboutme-title {
    ox-shadow: 0 0 6px 2px #fff; /* drop shadow */
	margin: 0;
	padding: 3px 0;
	text-align: center;
	color: #00C5F9;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/main.jpg) repeat;
}
.profile-aboutme-contents {
	width:400px;
	height: 190px;
	padding: 6px;
	padding: 1px 0 0 0;
	text-align: left;
	font: 50% Arial, Helvetica, sans-serif;
	color: #000;
	padding: 10px;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/7.gif) repeat;
	overflow:auto;
    box-shadow: 0 0 6px 2px #B4B4B4; /* drop shadow */
	

}
.profile-banned-user {
	border: 1px solid red;
	padding: 4px 8px;
}
/* ***************************************
	Modules - AVATAR
*************************************** */
.elgg-sidebar #profile-owner-block{
	background:none;
    height:200px;
	padding:5px;
	margin:0 0 20px 0;
	border: 1px solid #fff;
    overflow:hidden; 
}
