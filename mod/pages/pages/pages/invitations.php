<?php
/**
 * List all pages invitations
 */
gatekeeper();

$page_guid = get_input('guid');
$page = get_entity($page_guid);
if (!$page) {
	register_error(elgg_echo('noaccess'));
	$_SESSION['last_forward_from'] = current_page_url();
	forward('');
}
$user = elgg_get_logged_in_user_guid();
if ($user != $page->owner_guid) {
	register_error(elgg_echo('noaccess'));
	forward();
}

$container = get_entity($page->container_guid);

$title = $page->title;

if (elgg_instanceof($container, 'group')) {
	elgg_push_breadcrumb($container->name, "pages/group/$container->guid/all");
} else {
	elgg_push_breadcrumb($container->name, "pages/owner/$container->username");
}

elgg_push_breadcrumb($title, "pages/view/$page_guid");
pages_prepare_parent_breadcrumbs($page);
elgg_push_breadcrumb(elgg_echo('pages_tools:view_invitations'));

$content = elgg_view("pages/invitationrequests", array(
	"guid" => $page_guid
));

$params = array(
	"content" => $content,
	"title" => $title,
	"filter" => "",
);
$body = elgg_view_layout("content", $params);

// draw page
echo elgg_view_page($title, $body);


