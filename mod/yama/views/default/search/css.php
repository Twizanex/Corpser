<?php
/**
 * Elgg Search css
 * 
 */
?>

/**********************************
Search plugin
***********************************/
.elgg-page-header .elgg-search {
	bottom: 5px;
	height: 23px;
	position: absolute;
	right: 8px;
    top:56px;

}
.elgg-page-header .elgg-search input[type=text] {
	width: 100px;
	box-shadow: 0 0 9px 1px #fff; /* drop shadow */
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/wire.png) repeat;
	color: #000;
	
}
.elgg-page-header .elgg-search input[type=submit] {
	color: black;
	font: 10px/100% Arial, Helvetica, sans-serif;
	font-weight: regular;
	background:#45c7ff;
	height: 18px;
	margin:0;
    padding:3px 6px 5px 6px;
	cursor: pointer;
    width: auto;
}
.elgg-page-header .elgg-search input[type=submit]:hover {
	background: #FFF;
	color: #000;
	box-shadow: 0 0 9px 0 #fff; /* drop shadow */
	
}
.elgg-search input[type=text] {
	font-family:Arial, Helvetica, sans-serif;
	background-color:#45c7ff;
	border:1px solid #a6a6a6;
	color:#151515;
	font-size:12px;
	margin:0;
	height:15px;
    padding:0 6px;
}
.elgg-search input[type=text]:focus, .elgg-search input[type=text]:active {
	background-color:#FFF;
	border:1px solid #fff;
	color:#fff;
	box-shadow: 0 0 65px 0 #00C5F9; /* drop shadow */
	
}

.search-list li {
	padding: 2px 0 0;
}
.search-heading-category {
	margin-top: 10px;
}

.search-highlight {
	background-color: #b3daff;
}
.search-highlight-color1 {
	background-color: #b3daff;
}
.search-highlight-color2 {
	background-color: #8bffff;
}
.search-highlight-color3 {
	background-color: #fdffb5;
}
.search-highlight-color4 {
	background-color: #b2b2b2;
}
.search-highlight-color5 {
	background-color: #3086d8;
}
