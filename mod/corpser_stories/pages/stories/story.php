<?php
/**
* hello, world page
*/

$title = "Story";
$content = "Hello, World!";
$vars = array('content' => $content,);
$body = elgg_view_layout('one_sidebar', $vars);
echo elgg_view_page($title, $body);