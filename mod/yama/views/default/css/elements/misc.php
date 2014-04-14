/* ***************************************
	MISC
*************************************** */
#login-dropdown {
	position: absolute;
	top:-30px;
	right:10px;    
	z-index: 9001;
}

/* ***************************************
	AVATAR UPLOADING & CROPPING
*************************************** */

#current-user-avatar {
	border-right:1px solid #011f4b;
}
#avatar-croppingtool {
	border-top: 1px solid #fff;
}
#user-avatar {
	float: left;
}
#user-avatar-preview {
	float: left;
	position: relative;
	overflow: hidden;
	width: 100px;
	height: 100px;
}

/* ***************************************
	FRIENDS COLLECTIONS
*************************************** */

#friends_collections_accordian li {
	color: #d2d8de;
}
#friends_collections_accordian li h2 {
    background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bglime40.png) repeat;
	color: #FFF;
	cursor: pointer;
	font-size: 1.0em;
	margin: 10px 0;
	padding: 4px 4px 6px 6px;
}
#friends_collections_accordian li h2:hover {
    background: url(<?php echo $vars['url']; ?>mod/yama/graphics/gradients/bg30.png) repeat;
	color:white;
}
#friends_collections_accordian .friends_collections_controls {
	float: right;
	font-size: 70%;
}
#friends_collections_accordian .friends-picker-main-wrapper {
	display: none;
	padding: 0;
}
