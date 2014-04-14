<?php
	$user = elgg_get_page_owner_entity();
	$userguid = $user->guid;
	$username = $user->username;
	
	if ($vars['size'] == 'large') {

		
		$hosted = elgg_get_entities_from_relationship(array('relationship' => 'host', 'relationship_guid' => $userguid, 'count' => true));
		$conector = elgg_echo("cms_invite:connector") . $hosted;

	    if ($hosted >=0) {
?>
				
        	<div class="cms_invite_profile">
        		<a href="/cms_invite/invited/<?php echo $username;?>">
	        		<div><?php echo elgg_view_icon('link') . $conector;?></div>
        		</a>
        	</div>
        	

    	<?php } ?>
	    
	<?php } ?>	    

    
