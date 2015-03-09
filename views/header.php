<?php 
if (!is_user_logged_in())
{
	return;
}
else 
{
	switch($fblb_role)
	{
		case "administrator":
			$user_role_permission = "manage_options";
		break;
		case "editor":
			$user_role_permission = "publish_pages";
		break;
		case "author":
			$user_role_permission = "publish_posts";
		break;
		case "subscriber":
			$user_role_permission = "edit_post";
		break;
		case "contributor":
			$user_role_permission = "read";
		break;
	}
	if (!current_user_can($user_role_permission))
	{
		return;
	}
	else
	{
	?>
	<div id="welcome-panel" class="welcome-panel" style="width:1000px;padding:0px !important;background-color: #f9f9f9 !important">
		<div class="welcome-panel-content">
			<img src="<?php echo plugins_url("/assets/images/facebook-likebox.png" , dirname(__FILE__)); ?>" />
		</div>
	</div>
	<h2 class="nav-tab-wrapper" style="max-width: 1000px;">
		<a class="nav-tab coustom-nav-tab" id="facebook_likebox" href="admin.php?page=facebook_likebox">
			<?php _e("Facebook Pages", facebook_likebox);?>
		</a>
		<a class="nav-tab coustom-nav-tab" id="fblb_general_Settings" href="admin.php?page=fblb_general_Settings">
			<?php _e("General Settings", facebook_likebox);?>
		</a>
		<a class="nav-tab coustom-nav-tab" id="fblb_recommendations" href="admin.php?page=fblb_recommendations">
			<?php _e("Recommendations", facebook_likebox);?>
		</a>
		<a class="nav-tab coustom-nav-tab" id="fblb_our_other_services" href="admin.php?page=fblb_our_other_services">
			<?php _e("Our Other Services", facebook_likebox);?>
		</a>
	</h2>
	<script>
		jQuery(document).ready(function()
		{
			jQuery(".nav-tab-wrapper > a#<?php echo $_REQUEST["page"];?>").addClass("nav-tab-active");
		});
	</script>
	<?php 
	}
}
?>