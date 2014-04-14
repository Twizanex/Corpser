<?php
/**
 * Topbar Logo
 */

namespace hypeJunction\ThemeX;

?>

<h1>
	<?php
	echo elgg_view('output/url', array(
		'text' => elgg_view('output/img', array(
			'src' => elgg_normalize_url('/mod/' . PLUGIN_ID . '/graphics/logo.png'),
		)),
		'href' => 'http://hypejunction.com/'
	));
	?>
</h1>
