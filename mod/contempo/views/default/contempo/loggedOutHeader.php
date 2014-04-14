<?php
$registrationText = elgg_get_plugin_setting('registrationText', 'contempo');
if (!$registrationText) {
    $registrationText = "<h2 style='text-align: center;'>WELCOME TO OUR WEBSITE!</h2><p>&nbsp;</p><p><img src='".$CONFIG->url."mod/contempo/graphics/headerimage.png' border='0' alt='headerimage.png' style='border: 0px; float: left; margin-right: 10px;' /> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'</p><p><strong>'This text can be modified from the admin panel.'</strong></p>";
}
?>
<div class="loggedOutHeaderLeft">
    <?php echo $registrationText; ?><br/>
    <span class="registerbutton headerButton">Register</span>
    <span class="loginbutton headerButton active">Login</span>
</div>
<div class='newHeaderForm login'>
    <div style='width:100%;height:60px;'></div>
    <h2>Login</h2>
    <?php echo elgg_view_form('login'); ?>
</div>
<div class='newHeaderForm register'>
    <div style="width:1005;height:12px;"></div>
    <h2>Register</h2>
    <?php echo elgg_view_form('register'); ?>
</div>
<script>
    (function(){
	$(".loginbutton").live('click',function(){
	    $(".register").hide();
	    $(".login").show();
	    $(this).siblings().removeClass('active');
	    $(this).addClass('active');

	});
	$(".registerbutton").live('click',function(){
	    $(".login").hide();
	    $(".register").show();
	    $(this).siblings().removeClass('active');
	    $(this).addClass('active');
	});
    })();
</script>