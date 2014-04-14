<?php
/**
 * Elgg header logo
 * removed <?php echo $site_name; ?>
 */
$site = elgg_get_site_entity();
$site_name = $site->name;
$site_url = elgg_get_site_url();
?>

<h1>
	<a class="elgg-heading-site" href="<?php echo $site_url; ?>">
	</a>
</h1>
