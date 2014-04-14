<?php 
/**
 * Custom Content module
 *
 */

$context = get_context();
if($context == 'pages')
{
	$path = explode("/", $_SERVER["REQUEST_URI"]);
	if(($path[4]=='view' || $path[4]=='invitations' || $path[4]=='details') && $path[5])
	{
		$page = get_entity($path[5]);
		if($page && pages_tools_get_root_page($page)==$page)
		{
			$text = $text . '<ul class="elgg-menu elgg-menu-page elgg-menu-page-default"><li class="elgg-menu-item-bookmarklet ';
			if($path[4]=='view')
				$text = $text . 'elgg-state-selected';
			$text = $text . '"><a title="';
			$text = $text . elgg_echo('pages_tools:view_description'); 
			$text = $text . '" href="';
			$text = $text . elgg_get_site_url() . "pages/view/" . $path[5];
			$text = $text . '">';
			$text = $text . elgg_echo('pages_tools:view_description');
			$text = $text . '</a>';
			
			$text = $text . '<ul class="elgg-menu elgg-menu-page elgg-menu-page-default"><li class="elgg-menu-item-bookmarklet ';
			if($path[4]=='details')
				$text = $text . 'elgg-state-selected';
			$text = $text . '"><a title="';
			$text = $text . elgg_echo('pages_tools:view_details'); 
			$text = $text . '" href="';
			$text = $text . elgg_get_site_url() . "pages/details/" . $path[5];
			$text = $text . '">';
			$text = $text . elgg_echo('pages_tools:view_details');
			$text = $text . '</a>';
		
			if($page->owner_guid==elgg_get_logged_in_user_guid()){
			$text = $text . '<ul class="elgg-menu elgg-menu-page elgg-menu-page-default"><li class="elgg-menu-item-bookmarklet ';
			if($path[4]=='invitations')
				$text = $text . 'elgg-state-selected';
			$text = $text . '"><a title="';
			$text = $text . elgg_echo('pages_tools:view_invitations'); 
			$text = $text . '" href="';
			$text = $text . elgg_get_site_url() . "pages/invitations/" . $path[5];
			$text = $text . '">';
			$text = $text . elgg_echo('pages_tools:view_invitations');
			$text = $text . '</a>';}
		}
	}
	echo elgg_view_module('aside', $title, $text, array('class' => 'elgg-module-custom-content'));
}
?>

