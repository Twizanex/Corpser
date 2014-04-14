<?php
/**
 * CSS buttons
 */
?>
/* **************************
	BUTTONS
************************** */

/* Base */
.elgg-button {
	font-size: 14px;
	font: 10px/100% Arial, Helvetica, sans-serif;
	font-weight: regular;
	color: #000;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg30.png) repeat;
    border:none;
	width: auto;
	padding: 4px 6px;
	cursor: pointer;
	outline: none;
	box-shadow: inset 0 0 10px 2px #fff; /* inner glow */
	
}
a.elgg-button {
    line-height:1.6em;
	padding: 3px 6px;
}
.elgg-button:hover {
	background: #00C5F9;
	color: #000;
}

/* **************************
	SUBMIT
************************** */
.elgg-button:focus,
.elgg-button-submit:focus,
.elgg-button-submit {
	color: #fff;
	background:#00C5F9;
    border:none;
}
.elgg-button-submit:hover {
	background: #fff;
	color: #000;
}
.elgg-button-submit.elgg-state-disabled {
	background: #999;
	cursor: default;
}

/* **************************
	CANCEL
************************** */
.elgg-button-cancel:focus,
.elgg-button-cancel {
	color: #FFF;
	background:#ffcc00;
    border:none;
}
.elgg-button-cancel:hover {
	background: #FADA58;
}

/* **************************
	ACTION
************************** */
.elgg-button-action:focus,
.elgg-button-action {
	margin-bottom:6px;
	height: 20px;
    line-height:1.6em;
	color: #FFF;
	background:#00C5F9;
    border:none;
}
.elgg-button-action:hover {
	background:#909090;
	color: black;
}

/* **************************
	DELETE
************************** */
.elgg-button-delete,
.elgg-button-delete:focus {
	margin-bottom:6px;
	padding: 4px 10px;
    line-height:1.6em;
	color: #FFF;
	background:#909090;
    border:none;
}
.elgg-button-delete:hover {
	background:red;
	color:#FFF;
}
/* **************************
	DROPDOWN
************************** */
.elgg-button-dropdown {
    font-family:Arial, Helvetica, sans-serif;
    font-size:60%;
    text-transform: uppercase;
    font-weight:normal;
	color: #FFF;
	background:#909090;   
	padding:3px 6px;
	text-decoration:none;
	display:block;
	position:relative;
	margin-left:0;
}

.elgg-button-dropdown:after {
	content: " \25BC ";
	font-size:smaller;
}

.elgg-button-dropdown:hover {
	background: none;
	color: #88D2F2;
	text-decoration:none;
}

.elgg-button-dropdown.elgg-state-active {
	background:#88f2a8;
	outline: none;
	color: #88D2F2;
}
