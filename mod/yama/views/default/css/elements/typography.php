<?php
/**
 * CSS typography
 */
?>

/* ***************************************
	Typography
*************************************** */
body {
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/main.jpg) repeat;
	font-size: 80%;
	line-height: 1.4em;
	font-family: "Lucida Grande", Arial, Tahoma, Verdana, sans-serif;
    color:#000;
}

a {
	color: #000;
}

a:hover,
a.selected { <?php //@todo remove .selected ?>
	color: #151515;
	text-decoration: underline;
}

p {
	margin-bottom: 15px;
}

p:last-child {
	margin-bottom: 0;
}

pre, code {
	font-family: Monaco, "Courier New", Courier, monospace;
	font-size: 12px;
	
	background:#EBF5FF;
	color:#000000;
	overflow:auto;

	overflow-x: auto; /* Use horizontal scroller if needed; for Firefox 2, not needed in Firefox 3 */

	white-space: pre-wrap;
	word-wrap: break-word; /* IE 5.5-7 */
	
}

pre {
	padding:3px 15px;
	margin:0px 0 15px 0;
	line-height:1.3em;
}

code {
	padding:2px 3px;
}

.elgg-monospace {
	font-family: Monaco, "Courier New", Courier, monospace;
}

blockquote {
	line-height: 1.3em;
	padding:3px 15px;
	margin:0px 0 15px 0;
    background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg50.png) repeat;
	border:none;
	color:#000;
}

h1, h2, h3, h4, h5, h6 {
	font-weight: regular;
	color:#00000;
    text-transform : uppercase;
}

h1 { font-size: 1.6em; }
h2 { font-size: 1.35em; line-height: 1.1em; padding-bottom:2px}
h3 { font-size: 1.1em; }
h4 { font-size: 1.0em; }
h5 { font-size: 0.9em; }
h6 { font-size: 0.8em; }

.elgg-heading-site, .elgg-heading-site:hover {
    height:86px;
    width:224px;
	font-size: 2em;
	line-height: 1.4em;
	color: #000;
	font-family: Arial, Helvetica, sans-serif;
	text-decoration: none;
}
.elgg-heading-site img {
	margin-top:10px;
}

.elgg-heading-main {
	float: left;
	max-width: 530px;
	margin-right: 10px;
    color: #000;
}
.elgg-heading-basic {
	color: #0054A7;
	font-size: 1.2em;
	font-weight: bold;
}

.elgg-subtext {
	color:#151515;
	font-size: 85%;
	line-height: 1.2em;
	font-style: regular;
}

.elgg-text-help {
	display: block;
	font-size: 35%;
	font-style: italic;
}

.elgg-quiet {
	color:#788A9A;
}

.elgg-loud {
	color: #0054A7;
}

/* ***************************************
	USER INPUT DISPLAY RESET
*************************************** */
.elgg-output {
	margin-top: 10px;
}

.elgg-output dt { font-weight: bold }
.elgg-output dd { margin: 0 0 1em 1em }

.elgg-output ul, ol {
	margin: 0 1.5em 1.5em 0;
	padding-left: 1.5em;
}
.elgg-output ul {
	list-style-type: disc;
}
.elgg-output ol {
	list-style-type: decimal;
}
.elgg-output table {
	border: 1px solid #ccc;
}
.elgg-output table td {
	border: 1px solid #ccc;
	padding: 3px 5px;
}
.elgg-output img {
	max-width: 100%;
}