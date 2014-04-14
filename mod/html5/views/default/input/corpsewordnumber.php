<?php 
$defaults = array(
	'class' => 'elgg-input-number',
);

$vars = array_merge($defaults, $vars);

$vars['type'] = 'title';

?>
<input type="number" id="corpserminwords" pattern="\d*" title=<?php echo elgg_echo('pages_tools:corpse_word_number')?> placeholder=<?php echo elgg_echo('pages_tools:corpse_word_number_placeholder')?> <?php echo elgg_format_attributes($vars); ?> required/>