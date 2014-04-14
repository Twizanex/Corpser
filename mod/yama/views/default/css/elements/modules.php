/* ***************************************
	Modules
*************************************** */
.elgg-module {
	overflow: hidden;
	margin-bottom: 2px;
    color: #000;
	box-shadow: 0 0 2px 1px #fff; /* drop shadow */
}

/* Aside */
.elgg-module-aside .elgg-head {
	margin-bottom: 5px;
	padding-bottom: 5px;
	box-shadow: 0 0 2px 1px #fff; /* drop shadow */
}

.elgg-module-aside .elgg-head h3 {
color: #979797;
border-top: 1px solid #fff;
border-bottom: 1px solid #fff;

}

.custom-index .elgg-module-aside .elgg-head h3 {
color: #000;
}

.custom-index .elgg-module-featured  h2 {
color: #000;
}

.elgg-module-aside a:link, .elgg-module-aside a:visited {
color: #000;
text-decoration: none;
border: 1px solid #fff;
}

.elgg-module-aside a:hover, .elgg-module-aside a:active {
color: #000;
text-decoration: underline;
}


/* Info */
.elgg-module-info > .elgg-head {
	padding: 5px 0;
	margin-bottom: 5px;

}
.elgg-module-info > .elgg-head * {
	color: #000;
}

/* Popup */
.elgg-module-popup {
    background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg50.png) repeat;
    color: #000;
	border: 1px solid #fff;	
	
	z-index: 9999;
	margin-bottom: 0;
	padding: 5px;

}
.elgg-module-popup > .elgg-head {
	margin-bottom: 5px;
}
.elgg-module-popup > .elgg-head * {
	color: #000;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg50.png) repeat;
}

/* Dropdown */
.elgg-module-dropdown {
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg50.png) repeat;
    color: #000;
	border:5px solid #CCC;
	
	display:none;
	
	width: 210px;
	padding: 12px;
	margin-right: 0px;
	z-index:100;
	
	-webkit-box-shadow: 0 3px 3px rgba(0, 0, 0, 0.45);
	-moz-box-shadow: 0 3px 3px rgba(0, 0, 0, 0.45);
	box-shadow: 0 3px 3px rgba(0, 0, 0, 0.45);
	
	position:absolute;
	right: 0px;
	top: 100%;
}

/* Featured */
.elgg-module-featured {
background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg30.png) repeat;
border: 1px solid #fff;
color: #000;
}
.elgg-module-featured > .elgg-head {
	padding: 5px;
    border-bottom: 1px solid #fff;
    background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg50.png) repeat;
    color: #000;
}
.elgg-module-featured > .elgg-head * {
	color:#FFF;
    text-transform: uppercase;
}
.elgg-module-featured > .elgg-body {
	padding: 10px;
}

/* ***************************************
	Widgets
*************************************** */
.elgg-widgets {
	float: right;
	min-height: 30px;
}
.elgg-widget-add-control {
	float: right;
	text-align: right;
	margin: 5px 5px 2px;
}
.elgg-widgets-add-panel {
	padding: 10px;
	margin: 0 5px 15px;
    border: 1px solid #fff;

}
<?php //@todo location-dependent style: make an extension of elgg-gallery ?>
.elgg-widgets-add-panel li {
	float: left;
	margin: 2px 2px;
	width: 200px;
	padding: 4px;
	border: 2px solid #fff;
	background: #be154d;
	font-weight: bold;
	color: #000;
}
.elgg-widgets-add-panel li a {
	display: block;
}
.elgg-widgets-add-panel .elgg-state-available {
	color: #FFF;
	cursor: pointer;
}
.elgg-widgets-add-panel .elgg-state-available:hover {
	background:#2190ff;
}
.elgg-widgets-add-panel .elgg-state-unavailable {
    background:#ffdce1;
	color:#151515;
}

.elgg-module-widget {
	margin: 0 4px 4px;
	position: relative;
    border: 1px solid #fff;
    background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/main.jpg) repeat;
    color: #000;
	box-shadow: 0 0 2px 1px #fff; /* drop shadow */
}
.elgg-module-widget:hover {
	box-shadow: 0 0 2px 1px #000; /* drop shadow */

}
.elgg-module-widget > .elgg-head {
	color: #FFF;
    border-bottom: 1px solid #fff;
    background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg30.png) repeat;
	height: 40px;
	overflow: hidden;
	border-top: 1px solid #fff;

}
.elgg-module-widget > .elgg-head h3 {
	float: left;
	padding: 4px 45px 0 20px;
	color: #FFF;
	background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg50.png) repeat;
	box-shadow: 0 0 3px 1px #fff; /* drop shadow */
	border-left: 1px solid #fff;
	border-bottom: 1px solid #fff;
	border-top: 1px solid #fff;
	
}
.elgg-module-widget.elgg-state-draggable > .elgg-head {
	cursor: move;
}
.elgg-module-widget > .elgg-head a {
	position: absolute;
	top: 4px;
	display: inline-block;
	width: 18px;
	height: 18px;
	padding: 2px 2px 0 0;
}
a.elgg-widget-collapse-button {
	right: 50px;
	height: 20px;
	color: #000;

}
a.elgg-widget-collapse-button:hover,
a.elgg-widget-collapsed:hover {
	color: #2981d9;
	text-decoration: none;
}
a.elgg-widget-collapse-button:before {
	content: "\25BC";
}
a.elgg-widget-collapsed:before {
	content: "\25BA";
}
a.elgg-widget-delete-button {
	left: 110px;
	height: 15px;
}
a.elgg-widget-edit-button {
	left: 80px;
}
.elgg-module-widget > .elgg-body {
	width: 100%;
	overflow: hidden;


}
.elgg-widget-edit {
	display: none;
	width: 96%;
	padding: 2%;
    border-bottom: 1px soild #fff;
background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/editbk.png) repeat;

}
.elgg-widget-content {
	padding: 10px;
}
.elgg-widget-content .elgg-form-messageboard-add{
	margin-right: 10px;
}
.elgg-widget-placeholder {
	border: 1px solid #fff;
	margin-bottom: 2px;
}