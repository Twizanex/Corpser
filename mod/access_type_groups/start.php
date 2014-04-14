<?php
/**
 *Access Type Groups
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Krishna Shetty
 * @copyright Krishna Shetty 2012
 */

/**
 *
 */


function access_type_groups_init() {

        elgg_register_plugin_hook_handler('access:collections:write', 'all', 'access_type_groups_write_acl_plugin_hook');
}

/**
 * Return the write access for the current group if the user has write access to it.
 */
function access_type_groups_write_acl_plugin_hook($hook, $entity_type, $returnvalue, $params) {
	$page_owner = elgg_get_page_owner_entity();
	$user_guid = $params['user_id'];
	$user = get_entity($user_guid);
	if (!$user) {
		return $returnvalue;
	}

        $my_groups = get_users_membership($user_guid);
        if ($my_groups) {
			foreach ($my_groups as $group) {
				$returnvalue[$group->group_acl] = elgg_echo('groups:group') . ': ' . $group->name;
			}
                        return $returnvalue;
	}
}

elgg_register_event_handler('init','system','access_type_groups_init');
?>