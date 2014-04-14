<?php
/**
 * Elgg embed CSS - standard across all themes
 * 
 * @package embed
 */
?>
#fancybox-outer{
    background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg80.png) repeat;
}
.embed-wrapper {
	width: 730px;
	min-height: 400px;
	margin: 20px 15px;
}
.embed-wrapper h2 {
	color: #FFF;
	margin-bottom: 10px;
}
.embed-wrapper .elgg-item {
	cursor: pointer;
}

/* ***************************************
	EMBED TABBED PAGE NAVIGATION
*************************************** */
.embed-wrapper .elgg-tabs a:hover {
	color: #FFF;
	background:#909090;
}

.embed-wrapper p {
	color: #333;
}
.embed-item {
	padding-left: 5px;
	padding-right: 5px;
}
.embed-item:hover {
	background-color: #151515;
}
