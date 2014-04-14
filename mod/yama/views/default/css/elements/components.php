<?php
/**
 * Components CSS
 */
?>

/* ***************************************
	Image Block
*************************************** */
.elgg-image-block {
	padding: 1px 0;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/main.jpg) repeat;
	box-shadow: inset 0 0 11px 0 #fff; /* inner glow */
	
}
.elgg-image-block .elgg-image {
	border-top: 0px solid #fff;
	border-left: 1px solid #00C5F9;
	float: left; 0px
	margin-right: 0px;
}
.elgg-image-block .elgg-image-alt {
	float: right; 1px
	margin-right: 1px;
}

/* ***************************************
	List
*************************************** */
.elgg-list {
	margin: 0px 0;
	clear: both;
}
.elgg-list > li {
	border-top: 1px solid #fff;

}

.elgg-item .elgg-subtext {
	color:#000;
	margin-bottom: 5px;
}
.elgg-item .elgg-content {
	margin: 10px 5px;
}



/* ***************************************
	Gallery
*************************************** */
.elgg-gallery {
	margin-right: auto;
	margin-left: auto;
}
.elgg-gallery td {
	padding: 2px;
}
.elgg-gallery-fluid > li {
	float: left;
}
.elgg-gallery-users > li {
	margin: 0 2px;
}

/* ***************************************
	Tables
*************************************** */
.elgg-table {
	width: 100%;
	border-top: 1px solid #5A5A5A;
	color: #000;
}
.elgg-table td, .elgg-table th {
	padding: 4px 8px;
	border: 1px solid #fff;
}
.elgg-table th {
    background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg50.png) repeat;
}
.elgg-table tr:nth-child(odd), .elgg-table tr.odd {

}
.elgg-table tr:nth-child(even), .elgg-table tr.even {

}
.elgg-table-alt {
	width: 100%;
	border: 1px solid #5A5A5A
	color: #000;
}
.elgg-table-alt td {
	padding: 4px 0;
	border: 1px solid #5A5A5A;
}
.elgg-table-alt td:first-child {
	width: 200px;
	border: 1px solid #5A5A5A;
}
.elgg-table-alt tr:hover {
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/main.jpg) repeat;
	border: 1px solid #fff;
}

/* ***************************************
	Owner Block
*************************************** */
.elgg-owner-block {
	margin-bottom: 20px;
}

/* ***************************************
	Messages
*************************************** */
.elgg-message {
	color: white;
	font-weight: bold;
	display: block;
	padding: 3px 10px;
	cursor: pointer;
	opacity: 0.9;
}
.elgg-state-success {
	background-color: black;
}
.elgg-state-error {
	background-color: red;
}
.elgg-state-notice {
	background-color: #4690D6;
}

/* ***************************************
	River
*************************************** */

.elgg-list-river a:link{
    color: #00C5F9;

}
.elgg-list-river > li {
	color: #606060;
}
.elgg-river-item {
	padding: 1px 0;
}
.elgg-river-item .elgg-pict {
	margin-right: 20px;
}
.elgg-river-timestamp {
	color:#00C5F9
	font-size: 85%;
	font-style: italic;
	line-height: 1.2em;
}

.elgg-river-attachments,
.elgg-river-message,
.elgg-river-content {
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/main.jpg) repeat;
	box-shadow: inset 0 0 35px 3px #fff; /* inner glow */
	font-size: 100%;
	line-height: 1.5em;
	margin: 8px 0 5px 0;
	padding-left: 5px;
}
.elgg-river-attachments .elgg-avatar,
.elgg-river-attachments .elgg-icon {
	float: left;
}
.elgg-river-layout .elgg-input-dropdown {
	float: right;
	margin: 10px 0;
}

.elgg-river-comments-tab {
	display: block;
	background-color: #151515;
    color:#FFF;
	margin-top: 5px;
	width: auto;
	float: right;
	font-size: 85%;
	padding: 1px 7px;
}

<?php //@todo components.php ?>
.elgg-river-comments {
	margin: 0;
	border-top: none;
    color:#FFF;
}
.elgg-river-comments li:first-child {

}
.elgg-river-comments li:last-child {

}
.elgg-river-comments li {
	background-color: #151515;
	border-bottom: none;
	padding: 4px;
	margin-bottom: 2px;
}
.elgg-river-comments .elgg-media {
	padding: 0;
}
.elgg-river-more {
	background-color: #151515;
	padding: 2px 4px;
	font-size: 85%;
	margin-bottom: 2px;
}

<?php //@todo location-dependent styles ?>
.elgg-river-item form {
	background-color: #151515;
	padding: 4px;
	
	height: 30px;
}
.elgg-river-item input[type=text] {
	width: 80%;
}
.elgg-river-item input[type=submit] {
	margin: 0 0 0 10px;
}


/* **************************************
	Comments (from elgg_view_comments)
************************************** */
.elgg-comments {
	margin-top: 4px;s
}
.elgg-comments > form {
	margin-top: 15px;
}

/* ***************************************
	Image-related
*************************************** */
.elgg-photo {
    box-shadow: 0 0 4px 2px #000; /* drop shadow */
	padding-right: 0px;
	padding-bottom: 0px;

}

/* ***************************************
	Tags
*************************************** */
.elgg-tags {
	display: inline;
	font-size: 85%;
}
.elgg-tags li {
	display: inline;
	margin-right: 5px;
}
.elgg-tags li:after {
	content: ",";
}
.elgg-tags li:last-child:after {
	content: "";
}
.elgg-tagcloud {
	text-align: justify;
}
