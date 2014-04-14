<?php
/**
 * Main content filter
 *
 * Select between user, friends, and all content
 *
 * @uses $vars['filter_context']  Filter context: all, friends, mine
 * @uses $vars['filter_override'] HTML for overriding the default filter (override)
 * @uses $vars['context']         Page context (override)
 */

if (isset($vars['filter_override'])) {
	echo $vars['filter_override'];
	return true;
}

$context = elgg_extract('context', $vars, elgg_get_context());

if (elgg_is_logged_in() && $context) {
	$username = elgg_get_logged_in_user_entity()->username;

	$tabs = array(
        
		'all' => array(
			'text' => elgg_echo('all'),
			'href' => (isset($vars['all_link'])) ? $vars['all_link'] : "$context/all #tabs-ajax-all",	
                        'data-target' => '#tabs-ajax-all',
                        'item_class' => 'tab',
			'priority' => 200,
		),
		'mine' => array(
			'text' => elgg_echo('mine'),
			'href' => (isset($vars['all_link'])) ? $vars['all_link'] : "$context/owner/$username #tabs-ajax-mine",
			'data-target' => '#tabs-ajax-mine',
                        'item_class' => 'tab',
			'priority' => 300
		),
		'friend' => array(
			'text' => elgg_echo('friends'),
			'href' => (isset($vars['friend_link'])) ? $vars['friend_link'] : "$context/friends/$username #tabs-ajax-friends",
			'data-target' => '#tabs-ajax-friends',
                        'item_class' => 'tab',
			'priority' => 400,
		),
	);
	
	foreach ($tabs as $name => $tab) {
		$tab['name'] = $name;
		
		elgg_register_menu_item('filter', $tab);
	}
echo '<div id="easy-tabs">';
	echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz tabs'));

  
}
