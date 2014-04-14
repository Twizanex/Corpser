<?php 
$defaults = array(
	'class' => 'elgg-input-text',
);

$vars = array_merge($defaults, $vars);

$vars['type'] = 'title';

?>
<input type="text" tabindex="0" title=<?php echo elgg_echo('pages_tools:title')?> <?php echo elgg_format_attributes($vars); ?> required/>