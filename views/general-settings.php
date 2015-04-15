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
		$settings_plugin = wp_create_nonce("plugin_settings");
		
		if (file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/queries.php"))
		{
			include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/queries.php";
		}
		foreach ($get_setting_data as $data)
		{
			$facebook_app_id = $data["facebook_app_id"];
			$administrator = $data["administrator"];
			$editor = $data["editor"];
			$author = $data["author"];
			$contributor = $data["contributor"];
			$subscriber = $data["subscriber"];
			$top_bar_menu = $data["top_bar_menu"];
		}
		?>
		<div id="message" class="top-right message" style="display: none;">
			<div class="message-notification"></div>
			<div class="message-notification ui-corner-all growl-success" >
				<div onclick="message_close();" id="close-message" class="message-close">x</div>
				<div class="message-header"><?php _e("Success!", facebook_likebox); ?></div>
				<div class="message-message"><?php _e("Plugin Settings has been updated", facebook_likebox); ?></div>
			</div>
		</div>
		<form class="layout-form form_width" id="frm_facebook_settings">
			<div class="fluid-layout">
				<div class="layout-span12">
					<div class="widget-layout">
						<div class="widget-layout-title">
							<h4>
								<?php _e("General Settings", facebook_likebox); ?>
							</h4>
						</div>
						<div class="widget-layout-body">
							<div class="fluid-layout">
								<div class="layout-span12 responsive">
									<div class="layout-control-group">
										<label class="layout-control-label_fblb"><?php _e("Facebook App id", facebook_likebox); ?> : 
											<span class="hovertip" data-original-title ="<?php _e("App id", facebook_likebox) ;?>">
												<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
											</span>
										</label>
										<div class="layout-controls custom-layout-controls-facebook">
											<input type="text" id="ux_txt_app_id" name="ux_txt_app_id" class="layout-span4" value="<?php echo $facebook_app_id ? $facebook_app_id : ""; ?>" placeholder="<?php _e("App id", facebook_likebox); ?>" />
										</div>
									</div>
									<div class="layout-control-group">
										<label class="layout-control-label_fblb"><?php _e("Show FB Likebox Menu", facebook_likebox); ?> :
											<span class="hovertip" data-original-title ="<?php _e("Allows you to control the capabilities of Facebokk Likebox among different roles of WordPress users.",facebook_likebox); ?>">
												<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
											</span>
										</label>
										<div class="layout-controls custom-layout-controls-facebook ">
											<span class="check-bottom">
												<input type="checkbox" id="ux_chk_admin" name="ux_chk_admin" disabled="disabled" value="1" <?php echo $administrator == "1" ? "checked=\"checked\"" : ""; ?> />
												<label class="fb-layout-controls-label">
													<?php _e("Administrator", facebook_likebox); ?>
												</label>
											</span>
											<span class="check-bottom">
												<input type="checkbox" id="ux_chk_editor" name="ux_chk_editor" value="1" <?php echo $editor == "1" ? "checked=\"checked\"" : ""; ?>/>
												<label class="fb-layout-controls-label">
													<?php _e("Editor", facebook_likebox); ?>
												</label>
											</span>
											<span class="check-bottom">
												<input type="checkbox" id="ux_chk_author" name="ux_chk_author" value="1" <?php echo $author == "1" ? "checked=\"checked\"" : ""; ?>/>
												<label class="fb-layout-controls-label">
													<?php _e("Author", facebook_likebox); ?>
												</label>
											</span>
											<span class="check-bottom">
												<input type="checkbox" id="ux_chk_contributor" name="ux_chk_contributor" value="1" <?php echo $contributor == "1" ? "checked=\"checked" : ""; ?>/>
												<label class="fb-layout-controls-label">
													<?php _e("Contributor", facebook_likebox); ?>
												</label>
											</span>
											<span class="check-bottom">
												<input type="checkbox" id="ux_chk_admin_subscriber" name="ux_chk_admin_subscriber" value="1" <?php echo $subscriber == "1" ? "checked=\"checked" : ""; ?>/>
												<label class="fb-layout-controls-label">
													<?php _e("Subscriber", facebook_likebox); ?>
												</label>
											</span>
										</div>
									</div>
									<div class="layout-control-group">
										<label class="layout-control-label_fblb"><?php _e("FB Likebox Menu Top Bar", facebook_likebox); ?> : 
											<span class="hovertip" data-original-title ="<?php _e("Allows you to enable or disable Facebook Likebox for top menu bar among different roles of WordPress users.",facebook_likebox); ?>">
												<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
											</span>
										</label>
										<div class="layout-controls custom-layout-controls-facebook">
											<?php
												if($top_bar_menu == "1")
												{
													?>
													<input type="radio" id="ux_rdl_enable_menu_enabled" name= "ux_rdl_enable_menu" checked="checked" value="1" > <?php _e( "Enable", facebook_likebox ); ?>
													<input type="radio" id="ux_rdl_enable_menu_disabled" name="ux_rdl_enable_menu" value="0" > <?php _e( "Disable", facebook_likebox ); ?>
													<?php
												}
												else
												{
													?>
													<input type="radio" id="ux_rdl_enable_menu_enabled" name= "ux_rdl_enable_menu" value="1" > <?php _e( "Enable", facebook_likebox ); ?>
													<input type="radio" id="ux_rdl_enable_menu_disabled" checked="checked"  name="ux_rdl_enable_menu" value="0" > <?php _e( "Disable", facebook_likebox ); ?>
													<?php
												}
											?>
										</div>
									</div>
									<div class="separator-doubled"></div>
									<div class="layout-control-group">
										<div class="layout-controls">
											<input type="submit" value="<?php _e("Save Changes", facebook_likebox); ?>" id="ux_btn_general_settings_save" class="btn btn-success" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<script type="text/javascript">
			jQuery(".hovertip").tooltip({placement: "right"});
			jQuery("#frm_facebook_settings").validate
			({
				rules :
				{
					ux_txt_app_id :
					{
						required:true,
						number:true
					}
				},
				errorPlacement: function(error, element)
				{
					jQuery(element).css("background-color", "#FFCCCC");
					jQuery(element).css("border", "1px solid red");
				},
				submitHandler: function(form)
				{
					var overlay_opacity = jQuery("<div class=\"opacity_overlay\"></div>");
					jQuery("body").append(overlay_opacity);
					var overlay = jQuery("<div class=\"loader_opacity\"><div class=\"processing_overlay\"></div></div>");
					jQuery("body").append(overlay)
					jQuery.post(ajaxurl,jQuery(form).serialize()+"&param=plugin_settings&action=plugin_settings_library&_wpnonce=<?php echo $settings_plugin;?>", function (data)
					{
						jQuery("body,html").animate({scrollTop: jQuery("body,html").position().top}, "slow");
						setTimeout(function ()
						{
							jQuery("#message").css("display", "block");
							jQuery(".loader_opacity").remove();
							jQuery(".opacity_overlay").remove();
						}, 
						2000);
						setTimeout(function () 
						{
							jQuery("#message").css("display", "none");
							window.location.href = "admin.php?page=fblb_general_Settings";
						},
						4000);
					});
				}
			});
	
			if (typeof(message_close) != "function")
			{
				function message_close()
				{
					jQuery("#message").css("display", "none");
				}
			}
		</script>
		<?php 
	}
}
?>