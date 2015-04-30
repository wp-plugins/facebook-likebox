<?php
switch($fblb_role)
{
	case "administrator":
		$cb_user_role_permission = "manage_options";
		break;
	case "editor":
		$cb_user_role_permission = "publish_pages";
		break;
	case "author":
		$cb_user_role_permission = "publish_posts";
		break;
	
}
if (!current_user_can($cb_user_role_permission))
{
	return;
}
else
{
	?>
	<form id="frm_auto_update" class="layout-form form_width">
		<div class="fluid-layout">
			<div class="layout-span12">
				<div class="widget-layout">
					<div class="widget-layout-title">
						<h4><?php _e("Plugin Updates", facebook_likebox); ?></h4>
					</div>
					<div class="widget-layout-body">
						<div class="fluid-layout">
							<div class="layout-span12 responsive">
								<div class="layout-control-group">
									<label class="layout-control-label"><?php _e("Plugin Updates", facebook_likebox); ?> :</label>
									<div class="layout-controls custom-layout-controls-facebook">
										<?php $facebook_updates = get_option("facebook-like-automatic_update");?>
										<input type="radio" name="ux_contact_update" id="ux_enable_update" onclick="facebook_likebox_autoupdate(this);" <?php echo $facebook_updates == "1" ? "checked=\"checked\"" : "";?> value="1"><label style="vertical-align: baseline;"><?php _e("Enable", facebook_likebox); ?></label>
										<input type="radio" name="ux_contact_update" id="ux_disable_update" onclick="facebook_likebox_autoupdate(this);" <?php echo $facebook_updates == "0" ? "checked=\"checked\"" : "";?> style="margin-left: 10px;" value="0"><label style="vertical-align: baseline;"><?php _e("Disable", facebook_likebox); ?></label>
									</div>
								</div>
								<div class="layout-control-group" style="margin:10px 0 10px 0 ;">
									<strong><i>This feature allows the plugin to update itself automatically when a new version is available on WordPress Repository.<br/>This allows to stay updated to the latest features. If you would like to disable automatic updates, choose  the disable option above.</i></strong>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		function facebook_likebox_autoupdate(control)
		{
			var facebook_updates = jQuery(control).val();
			jQuery.post(ajaxurl, "facebook_updates="+facebook_updates+"&param=facebook_plugin_updates&action=add_facebook_form_library", function(data)
			{
			});
		}
	</script>
<?php 
}
?>