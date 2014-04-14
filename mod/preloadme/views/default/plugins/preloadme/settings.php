<?php
/**
 * PreLoadMe
 */

$instructions = "If you want to use your own preloader image then please enter the URL. Leave blank for the default preloader. (ex. http://i.imgur.com/k8gYUaA.jpg)";

$preloader_text = "Preloader URL";
$preloader_url = elgg_view('input/text', array(
	'name' => 'params[preloader_url]',
	'value' => $vars['entity']->preloader_url,
	'class' => 'elgg-input-thin',
));

$settings = <<<__HTML
<div class="elgg-content-thin mtm"><p>$instructions</p></div>
<div><label>$preloader_text</label><br /> $preloader_url</div>
__HTML;

echo $settings;