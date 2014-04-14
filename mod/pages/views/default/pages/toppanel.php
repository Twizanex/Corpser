<?php
/**
 * A user's page invitations
 *
 * @uses $vars['invitations'] Array of ElggGroups
 */
 
gatekeeper();
elgg_load_js('jquery.nouislider');
elgg_load_css('jquery.nouislider');
$page_guid = get_input('guid');
$page = get_entity($page_guid);
		if(!$page)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward();
		}
		
//Poner todas las condiciones necesarias para mostar el panel
		