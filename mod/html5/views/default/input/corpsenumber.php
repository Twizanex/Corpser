<?php 
$defaults = array(
	'class' => 'elgg-input-number',
);

$vars = array_merge($defaults, $vars);

$vars['type'] = 'title';

?>
<input type="number" id="corpsenumber" pattern="\d*" title=<?php echo elgg_echo('pages_tools:corpses_number')?> placeholder=<?php echo elgg_echo('pages_tools:corpses_number_placeholder')?> <?php echo elgg_format_attributes($vars); ?> required/>