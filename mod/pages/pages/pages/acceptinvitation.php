<?php
/**
 * Request a participation in story
 *
 * @package ElggPages
 */

gatekeeper();

$page_guid = (int) get_input('guid');
pages_tools_accept_invitation($page_guid);

