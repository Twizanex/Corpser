<?php
/**
 * CSS form/input elements
 */
?>

/* ***************************************
	Form Elements
*************************************** */
fieldset > div {
	margin-bottom: 15px;
}
fieldset > div:last-child {
	margin-bottom: 0;
}
.elgg-form-alt > fieldset > .elgg-foot {
	border: 1px solid #FFE200;
	padding: 10px 0;
}

label {
	font-weight: normal;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #979797;
}

.custom-index label {
color: #909090;
}

input, textarea {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	padding: 5px;
	width: 95%;
	background-color: #FFCC6F;
	color:#FB7300;
	border:1px solid #fff;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/wire.png) repeat;
	box-shadow: 0 0 2px 1px #fff; /* drop shadow */
}

input:focus, textarea:focus {
	background-color: #6281be;
	color:#0DA8EE;
	box-shadow: 0 0 3px 0 #0DA8EE; /* drop shadow */
}
textarea {
	height: 200px;
}
.elgg-longtext-control {
	float: right;
	margin-left: 14px;
	font-size: 80%;
	cursor: pointer;
}
.elgg-input-access {
	margin:5px 0 0 0;
}
input[type="checkbox"],
input[type="radio"] {
	margin:0 3px 0 0;
	padding:0;
	border:none;
	width:auto;
}
.elgg-input-checkboxes.elgg-horizontal li,
.elgg-input-radio.elgg-horizontal li {
	display: inline;
	padding-right: 10px;
}

.elgg-form-account input[type="text"],
.elgg-form-account input[type="password"] {
	width: 300px;
}

.elgg-form-login, .elgg-form-account {
	max-width: 450px;
}

/* ***************************************
	FRIENDS PICKER
*************************************** */
.friends-picker-main-wrapper {
	margin-bottom: 15px;
}
.friends-picker-container h3 {
	font-size:4em !important;
	text-align: left;
	margin:10px 0 20px !important;
	color:#d2d8de !important;
	background: none !important;
	padding:0 !important;
}
.friends-picker .friends-picker-container .panel ul {
	text-align: left;
	margin: 0;
	padding:0;
}
.friends-picker-wrapper {
	margin: 0;
	padding:0;
	position: relative;
	width: 100%;
}
.friends-picker {
	position: relative;
	overflow: hidden;
	margin: 0;
	padding:0;
	width: 690px;
	height: auto;
    background: #FFF;
    color: #000;
}
.friendspicker-savebuttons {
	margin:0 10px 10px;
}
.friends-picker .friends-picker-container { /* long container used to house end-to-end panels. Width is calculated in JS  */
	position: relative;
	left: 0;
	top: 0;
	width: 100%;
	list-style-type: none;
}
.friends-picker .friends-picker-container .panel {
	float:left;
	height: 100%;
	position: relative;
	width: 730px;
	margin: 0;
	padding:0;
}
.friends-picker .friends-picker-container .panel .wrapper {
	margin: 0;
	padding:4px 10px 10px 10px;
	min-height: 230px;
}
.friends-picker-navigation {
	margin: 10px 0 10px;
	padding:0 0 10px;
}
.friends-picker-navigation ul {
	list-style: none;
	padding-left: 0;
}
.friends-picker-navigation ul li {
	float: left;
	margin:0;
}
.friends-picker-navigation a {
	font-weight: bold;
	text-align: center;
    background: #FFF;
    color: #000;
	text-decoration: none;
	display: block;
	padding: 0;
	width:20px;
}
.tabHasContent {
	background: white; color:#000 !important;
}
.friends-picker-navigation li a:hover {
	background:#909090;
	color:white !important;
}
.friends-picker-navigation li a.current {
	background: #909090;
	color:white !important;
}
.friends-picker-navigation-l, .friends-picker-navigation-r {
	position: absolute;
	top: 46px;
	text-indent: -9000em;
}
.friends-picker-navigation-l a, .friends-picker-navigation-r a {
	display: block;
	height: 40px;
	width: 40px;
}
.friends-picker-navigation-l {
	right: 48px;
	z-index:1;
}
.friends-picker-navigation-r {
	right: 0;
	z-index:1;
}
.friends-picker-navigation-l {
	background: url("<?php echo elgg_get_site_url(); ?>mod/yama/graphics/friendspicker.png") no-repeat left top;
}
.friends-picker-navigation-r {
	background: url("<?php echo elgg_get_site_url(); ?>mod/yama/graphics/friendspicker.png") no-repeat -60px top;
}
.friends-picker-navigation-l:hover {
	background: url("<?php echo elgg_get_site_url(); ?>mod/yama/graphics/friendspicker.png") no-repeat left -44px;
}
.friends-picker-navigation-r:hover {
	background: url("<?php echo elgg_get_site_url(); ?>mod/yama/graphics/friendspicker.png") no-repeat -60px -44px;
}
.friendspicker-savebuttons .elgg-button-submit,
.friendspicker-savebuttons .elgg-button-cancel {
	margin:5px 20px 5px 5px;
}
.friendspicker-members-table {
	background: #dedede;
	margin:10px 0 0;
	padding:10px 10px 0;
}

/* ***************************************
	USER PICKER
*************************************** */

.user-picker .user-picker-entry {
	clear:both;
	height:25px;
	padding:5px;
	margin-top:5px;
	border-bottom:1px solid #cccccc;
}
.user-picker-entry .elgg-button-delete {
	margin-right:10px;
}
/* ***************************************
      DATE PICKER
**************************************** */
.ui-datepicker {
	display: none;

	margin-top: 3px;
	width: 208px;
	background-color: white;
	border: 1px solid #0054A7;
	overflow: hidden;

	-webkit-box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.5);
	-moz-box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.5);
	box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.5);
}
.ui-datepicker-inline {
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}

.ui-datepicker-header {
	position: relative;
	background: #4690D6;
	color: white;
	padding: 2px 0;
	border-bottom: 1px solid #0054A7;
}
.ui-datepicker-header a {
	color: black;
}
.ui-datepicker-prev, .ui-datepicker-next {
    position: absolute;
    top: 5px;
	cursor: pointer;
}
.ui-datepicker-prev {
    left: 6px;
}
.ui-datepicker-next {
    right: 6px;
}
.ui-datepicker-title {
    line-height: 1.8em;
    margin: 0 30px;
    text-align: center;
	font-weight: bold;
}
.ui-datepicker-calendar {
	margin: 4px;
}
.ui-datepicker th {
	color: #0054A7;
	border: none;
    font-weight: bold;
    padding: 5px 6px;
    text-align: center;
}
.ui-datepicker td {
	padding: 1px;
}
.ui-datepicker td span, .ui-datepicker td a {
    display: block;
    padding: 2px;
	line-height: 1.2em;
    text-align: right;
    text-decoration: none;
}
.ui-datepicker-calendar .ui-state-default {
	border: 1px solid #ccc;
    color: #4690D6;;
	background: #fafafa;
}
.ui-datepicker-calendar .ui-state-hover {
	border: 1px solid #aaa;
    color: #0054A7;
	background: #eee;
}
.ui-datepicker-calendar .ui-state-active,
.ui-datepicker-calendar .ui-state-active.ui-state-hover {
	font-weight: bold;
    border: 1px solid #0054A7;
    color: #0054A7;
	background: #E4ECF5;
}
