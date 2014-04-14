<?php

	/**
	 * Elgg invitations plugin
	 * This plugin allows to send message to custom email you specify at module configuration area
	 * 
	 * @package Invitations
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Ralf Heinrich
	 * @copyright Ralf Heinrich 2008
	 * @link /www.daten-punk.de
	 */

	
	// Get size
	if (!in_array($vars['size'],array('small','medium','large','tiny','master','topbar')))
		$vars['size'] = "medium";
			
	// Get any align and js
	if (!empty($vars['align'])) {
		$align = " align=\"{$vars['align']}\" ";
	} else {
		$align = "";
	}
	
	if ($icontime = $vars['entity']->icontime) {
		$icontime = "{$icontime}";
	} else {
		$icontime = "default";
	}
	
	
?>


<div class="icon">
<a href="<?php echo $vars['entity']->getURL(); ?>" class="icon" ><img src="<?php echo $vars['url']; ?>mod/invitations/graphics/icon.php?size=<?php echo $vars['size']; ?>" border="0" <?php echo $align; ?> title="<?php echo $name; ?>" <?php echo $vars['js']; ?> /></a>
</div>