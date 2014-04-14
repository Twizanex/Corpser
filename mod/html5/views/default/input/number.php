<?php 
$defaults = array(
	'class' => 'elgg-input-number',
);

$vars = array_merge($defaults, $vars);

$vars['type'] = 'number';

?>
<input type="number" pattern="\d*" title=<?php echo elgg_echo('pages_tools:number')?> <?php echo elgg_format_attributes($vars); ?> />