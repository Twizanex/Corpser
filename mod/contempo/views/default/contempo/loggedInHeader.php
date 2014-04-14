<?php
$user = elgg_get_logged_in_user_entity();
$icon = elgg_view_entity_icon($user, 'large', array(
    'use_hover' => false,
    'use_link' => false,
	));
$url = $CONFIG->url;
$logouturl = $url = elgg_add_action_tokens_to_url($url . "action/logout");
?>
<div class="loggedInHeader">
    <div class="userIcon">
	<h2>Welcome</h2>
	<h3><?php echo $user->name; ?></h3>
	<?php if (elgg_is_admin_logged_in()) { ?>
    	<a class="adminlink" href="<?php echo $CONFIG->url; ?>admin"><?php echo elgg_echo ('admin'); ?></a><div style="clear:both;"></div>
	<?php } ?>
	<?php echo $icon; ?>
    </div>
    <div class="loggedInHeaderMenu">

	<span class="main dashboardlink"><?php echo elgg_echo('dashboard'); ?></span>
	<span class="main profilelink"><?php echo elgg_echo('profile'); ?></span>
	<span class="main friendslink"><?php echo elgg_echo('friends'); ?></span>
	<span class="main emaillink"><?php echo elgg_echo('contempo:email'); ?></span>
	<span class="main edit" style="float:left;"><?php echo elgg_echo('edit'); ?></span>
	<span class="childholder">
	    <span class="child profileeditlink"><?php echo elgg_echo('profile'); ?></span>
	    <span class="child avatareditlink"><?php echo elgg_echo('avatar'); ?></span>
	    <span class="child settingslink"><?php echo elgg_echo('settings'); ?></span>
	</span>
	<div style="clear:both;"></div>
	<span class="main logoutlink"><?php echo elgg_echo('logout'); ?></span>

    </div>
    <div class="loggedInHeaderText">
	<h2><?php echo elgg_echo('contempo:wire'); ?></h2>

	<?php echo elgg_view_form('thewire/add'); ?>
    </div>
</div>
<script>
    (function(){
	var url = "<?php echo $CONFIG->url; ?>";
	var username = "<?php echo elgg_get_logged_in_user_entity()->username; ?>";
	var logouturl = "<?php echo $logouturl; ?>";
	$(".main").live('hover',function(e){
	    $(".childholder").hide();
	    $(this).siblings().removeClass('active');
	    e.stopPropagation();
	});
	$("#thewire-textarea").focus(function(e){
	    $(".childholder").hide();
	    $(".main").siblings().removeClass('active');
	    e.stopPropagation();
	});
	$(".edit").live('hover',function(e){
	    $(this).addClass('active');
	    $(".childholder").show();
	    e.stopPropagation();
	});
	$(".dashboardlink").live('click',function(e){
	    window.location = url+'dashboard';
	    e.stopPropagation();
	});
	$(".profilelink").live('click',function(e){
	    window.location = url+'profile/'+username;
	    e.stopPropagation();
	});
	$(".friendslink").live('click',function(e){
	    window.location = url+'friends/'+username;
	    e.stopPropagation();
	});
	$(".emaillink").live('click',function(e){
	    window.location = url+'messages/'+username;
	    e.stopPropagation();
	});
	$(".profileeditlink").live('click',function(e){
	    window.location = url+'profile/'+username+'/edit';
	    e.stopPropagation();
	});
	$(".avatareditlink").live('click',function(e){
	    window.location = url+'avatar/edit/'+username;
	    e.stopPropagation();
	});
	$(".settingslink").live('click',function(e){
	    window.location = url+'settings/user/'+username;
	    e.stopPropagation();
	});
	$(".logoutlink").live('click',function(e){
	    window.location = logouturl
	    e.stopPropagation();
	});
	$(document).click(function(e){
	    $(".childholder").hide();
	    $(".main").siblings().removeClass('active');
	    e.stopPropagation();
	});
    })();
</script>