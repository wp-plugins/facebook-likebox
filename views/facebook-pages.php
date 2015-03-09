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
		$add_facebook_likebox = wp_create_nonce("add_facebook_likebox");
		$delete_likebox = wp_create_nonce("delete_likebox");
		$delete_all_likebox = wp_create_nonce("delete_all_likebox");
		
		if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/queries.php"))
		{
			include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/queries.php";
		}
		
		function generate_shortcode($data)
		{
			switch ($data["display_type"])
			{
				case "like box":
					$shortcode = "[facebook_likebox title=\"".$data["title"]."\" facebook_page_url=\"".$data["facebook_page_url"]."\" facebook_page_id=\"".$data["facebook_page_id"]."\" language=\"".$data["language"]."\" display_type=\"".$data["display_type"].
						"\" connections=\"".$data["connections"]."\" width=\"".$data["width"]."\" height=\"".$data["height"]."\" streams=\"".$data["streams"]."\" show_faces_like_box=\"".$data["show_faces_like_box"].
						"\" color_scheme=\"".$data["color_scheme"]."\" header=\"".$data["header"]."\"]";
				break;
				case "like button":
					if($data["share_button"] == "true")
					{
						$shortcode = "[facebook_likebox share_button=\"".$data["share_button"]."\" title=\"".$data["title"]."\" facebook_page_url=\"".$data["facebook_page_url"]."\" facebook_page_id=\"".$data["facebook_page_id"]."\" language=\"".$data["language"].
							"\" display_type=\"".$data["display_type"]."\" button_style=\"".$data["button_style"]."\" show_faces_like_button=\"".$data["show_faces_like_button"]."\" button_color_scheme=\"".$data["button_color_scheme"]."\" font=\"".$data["font"]."\"]";
					}
					else 
					{
						$shortcode = "[facebook_likebox share_button=\"".$data["share_button"]."\" language=\"".$data["language"]."\" display_type=\"".$data["display_type"].
							"\" button_style=\"".$data["button_style"]."\" show_faces_like_button=\"".$data["show_faces_like_button"]."\" button_color_scheme=\"".$data["button_color_scheme"]."\" font=\"".$data["font"]."\"]";
					}
				break;
				case "like box button":
					$shortcode = "[facebook_likebox title=\"".$data["title"]."\" facebook_page_url=\"".$data["facebook_page_url"]."\" facebook_page_id=\"".$data["facebook_page_id"]."\" language=\"".$data["language"]."\" display_type=\"".$data["display_type"].
						"\" connections=\"".$data["connections"]."\" width=\"".$data["width"]."\" height=\"".$data["height"]."\" streams=\"".$data["streams"]."\" show_faces_like_box=\"".$data["show_faces_like_box"].
						"\" button_style=\"".$data["button_style"]."\" show_faces_like_button=\"".$data["show_faces_like_button"]."\" color_scheme=\"".$data["color_scheme"].
						"\" header=\"".$data["header"]."\" button_color_scheme=\"".$data["button_color_scheme"]."\" font=\"".$data["font"]."\"]";
				break;
			}
			return $shortcode;
		}
		$language = array(
				"af_ZA" => "Afrikaans",
				"ar_AR" => "Arabic",
				"az_AZ" => "Azeri",
				"be_BY" => "Belarusian",
				"bg_BG" => "Bulgarian", 
				"bn_IN" => "Bengali", 
				"bs_BA" => "Bosnian", 
				"ca_ES" => "Catalan", 
				"cs_CZ" => "Czech", 
				"cy_GB" => "Welsh", 
				"da_DK" => "Danish", 
				"de_DE" => "German", 
				"el_GR" => "Greek", 
				"en_US" => "English (US)", 
				"en_GB" => "English (UK)", 
				"eo_EO" => "Esperanto", 
				"es_ES" => "Spanish (Spain)", 
				"es_LA" => "Spanish", 
				"et_EE" => "Estonian", 
				"eu_ES" => "Basque", 
				"fa_IR" => "Persian", 
				"fb_LT" => "Leet Speak", 
				"fi_FI" => "Finnish", 
				"fo_FO" => "Faroese", 
				"fr_FR" => "French (France)", 
				"fr_CA" => "French (Canada)", 
				"fy_NL" => "Netherlands (NL)", 
				"ga_IE" => "Irish", 
				"gl_ES" => "Galician", 
 				"hi_IN" => "Hindi", 
				"hr_HR" => "Croatian", 
				"hu_HU" => "Hungarian", 
				"hy_AM" => "Armenian", 
				"id_ID" => "Indonesian", 
				"is_IS" => "Icelandic", 
				"it_IT" => "Italian", 
				"ja_JP" => "Japanese", 
				"ka_GE" => "Georgian", 
				"km_KH" => "Khmer", 
				"ko_KR" => "Korean", 
				"ku_TR" => "Kurdish", 
				"la_VA" => "Latin", 
				"lt_LT" => "Lithuanian", 
				"lv_LV" => "Latvian", 
				"mk_MK" => "Macedonian", 
				"ml_IN" => "Malayalam", 
				"ms_MY" => "Malay", 
				"nb_NO" => "Norwegian (bokmal)", 
				"ne_NP" => "Nepali", 
				"nl_NL" => "Dutch", 
				"nn_NO" => "Norwegian (nynorsk)", 
				"pa_IN" => "Punjabi", 
				"pl_PL" => "Polish", 
				"ps_AF" => "Pashto", 
				"pt_PT" => "Portuguese (Portugal)", 
				"pt_BR" => "Portuguese (Brazil)", 
				"ro_RO" => "Romanian", 
				"ru_RU" => "Russian", 
				"sk_SK" => "Slovak", 
				"sl_SI" => "Slovenian", 
				"sq_AL" => "Albanian", 
				"sr_RS" => "Serbian", 
				"sv_SE" => "Swedish", 
				"sw_KE" => "Swahili", 
				"ta_IN" => "Tamil", 
				"te_IN" => "Telugu", 
				"th_TH" => "Thai", 
				"tl_PH" => "Filipino", 
				"tr_TR" => "Turkish", 
				"uk_UA" => "Ukrainian",
				"ur_PK" => "Urdu",
 				"vi_VN" => "Vietnamese", 
				"zh_CN" => "Simplified Chinese (China)", 
				"zh_HK" => "Traditional Chinese (Hong Kong)", 
				"zh_TW" => "Traditional Chinese (Taiwan)"
			);
		?>
		<div id="message" class="top-right message" style="display: none;">
			<div class="message-notification"></div>
			<div class="message-notification ui-corner-all growl-success">
				<div onclick="message_close();" id="close-message" class="message-close">x</div>
				<div class="message-header"><?php _e("Success!", facebook_likebox); ?></div>
				<div class="message-message"><?php _e("Successfully Saved!", facebook_likebox); ?></div>
			</div>
		</div>
		<div id="top-error" class="top-right top-error" style="display: none;">
			<div class="top-error-notification"></div>
			<div class="top-error-notification ui-corner-all growl-top-error" >
				<div onclick="error_message_close();" id="close-top-error" class="top-error-close">x</div>
				<div class="top-error-header"><?php _e("Error!", facebook_likebox); ?></div>
				<div class="top-error-top-error" id="error_message_div"></div>
			</div>
		</div>
		<form id="ux_frm_facebook_pages" class="layout-form form_width">
			<div class="fluid-layout">
				<div class="layout-span12">
					<div class="widget-layout">
						<div class="widget-layout-title">
							<h4>
								<?php _e("Facebook Pages", facebook_likebox); ?>
							</h4>
						</div>
						<div class="widget-layout-body">
							<div class="framework_tabs">
								<ul class="framework_tab-links">
									<li class="active">
										<a href="#ux_facebook_like_boxes"><?php _e("Facebook Like Boxes", facebook_likebox); ?></a>
									</li>
									<li>
										<a href="#ux_add_new_facebook_like_box"><?php _e("Add New Facebook Like Box", facebook_likebox); ?></a>
									</li>
								</ul>
								<div class="framework_tab-content">
									<div id="ux_facebook_like_boxes" class="framework_tab active">
										<div class="widget-layout" style="margin-bottom: 0px;">
											<div class="widget-layout-title">
												<h4>
													<?php _e("Facebook Like Box Settings", facebook_likebox); ?>
												</h4>
											</div>
											<div class="widget-layout-body">
												<div class="layout-control-group">
													<select id="ux_ddl_bulk_action" name="ux_ddl_bulk_action" class="layout-span2">
														<option value="bulk_action"><?php _e("Bulk Action", facebook_likebox); ?></option>
														<option value="delete"><?php _e("Delete", facebook_likebox); ?></option>
													</select> 
													<input type="button" id="ux_btn_apply" name="ux_btn_apply" onclick="bulk_delete_likebox();" class="btn btn-success" value="<?php _e("Apply", facebook_likebox); ?>">
												</div>
												<div id="ux_cls_separator-doubled" class="separator-doubled"></div>
												<table class="widefat" id="ux_facebook_likebox_settings_data" style="background-color: #fff !important;">
													<thead>
														<tr>
															<th id="ux_th_selectall_likebox">
																<input type="checkbox" id="ux_chk_selectall_likebox" onclick="select_all_facebook_likebox();">
															</th>
															<th id="ux_th_facebook_id"><?php _e("Facebook ID", facebook_likebox); ?></th>
															<th id="ux_th_facebook_page_url"><?php _e("Facebook Page URL", facebook_likebox); ?></th>
															<th id="ux_th_shortcode"><?php _e("Short Code", facebook_likebox); ?></th>
															<th id="ux_th_action"><?php _e("Action", facebook_likebox); ?></th>
														</tr>
													</thead>
													<tbody>
														<?php
														$count = 0;
														foreach ($get_facebook_data as $data)
														{
															$alternate = ($count++ % 2) == 0 ? "alternate" : "";
															?>
															<tr class=<?php echo $alternate; ?>>
																<td>
																	<input type="checkbox" class="checkbox_action" id="ux_chk_select" name="delete_select_likebox[]" value="<?php echo $data["setting_id"]; ?>">
																</td>
																<td><?php echo isset($data["facebook_page_id"]) ? $data["facebook_page_id"] : ""; ?></td>
																<td><?php echo isset($data["facebook_page_url"]) ? $data["facebook_page_url"] : ""; ?></td>
																<td>
																	<?php
																	$shortcode = generate_shortcode($data);
																	echo isset($shortcode) ? $shortcode : "";
																	?>
																</td>
																<td>
																	<a href="#" onclick="delete_facebook_likebox(<?php echo $data["setting_id"]; ?>)"><?php _e("Delete", facebook_likebox); ?></a>
																</td>
															</tr>
															<?php
														}
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div id="ux_add_new_facebook_like_box" class="framework_tab">
										<div class="layout-control-group">
											<input type="submit" id="ux_btn_top_save_changes" name="ux_btn_top_save_changes" class="btn btn-success" value="<?php _e("Save Changes", facebook_likebox); ?>"/>
										</div>
										<div class="separator-doubled fb_page_seperator"></div>
										<div class="widget-layout">
											<div class="widget-layout-title">
												<h4>
													<?php _e("Facebook Like Box", facebook_likebox); ?>
												</h4>
											</div>
											<div class="widget-layout-body">
												<div class="fluid-layout">
													<div class="layout-span12 responsive">
														<div class="layout-control-group">
															<label class="layout-control-label_fblb"><?php _e("Display Type", facebook_likebox); ?> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Display Type", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
																</span>
															</label>
															<div class="layout-controls">
																<select id="ux_ddl_display_type" name="ux_ddl_display_type" class="layout-span11" onchange="change_display_type();" onblur="shortCodeGenerator();">
																	<option value="like box"><?php _e("Like Box", facebook_likebox); ?></option>
																	<option value="like button"><?php _e("Like Button", facebook_likebox); ?></option>
																	<option value="like box button"><?php _e("Like Box & Button", facebook_likebox); ?></option>
																</select>
															</div>
														</div>
														<div class="layout-control-group share_btn" style="display: none;">
															<label class="layout-control-label_fblb"><?php _e("Share Button", facebook_likebox); ?> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Share Button", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>" />
																</span>
															</label>
															<div class="layout-controls rdl_facebook">
																<input type="radio" id="ux_rdl_share_button_yes" class="share_button" name="ux_rdl_share_button" checked="checked" value="true" onclick="share_button();"> <?php _e("Yes", facebook_likebox ); ?>
																<input type="radio" id="ux_rdl_share_button_no" class="share_button" name="ux_rdl_share_button" value="false" onclick="share_button();"> <?php _e("No", facebook_likebox ); ?>
															</div>
														</div>
														<div class="layout-control-group display_type">
															<label class="layout-control-label_fblb"><?php _e("Title", facebook_likebox); ?> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Title", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>" />
																</span>
															</label>
															<div class="layout-controls">
																<input type="text" id="ux_txt_title" name="ux_txt_title" class="layout-span11" value="<?php _e("Facebook Like Box", facebook_likebox); ?>" onblur="shortCodeGenerator();" placeholder="<?php _e("Title", facebook_likebox); ?>"/>
															</div>
														</div>
														<div class="layout-control-group share_class">
															<label class="layout-control-label_fblb"><?php _e("Facebook Page Url", facebook_likebox); ?> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Facebook Page Url", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
																</span>
															</label>
															<div class="layout-controls">
																<input type="text" id="ux_txt_facebook_page_url" name="ux_txt_facebook_page_url" class="layout-span11" value="http://www.facebook.com/techbanker" onblur="shortCodeGenerator();" placeholder="<?php _e("Facebook Page Url", facebook_likebox); ?>"/>
															</div>
														</div>
														<div class="layout-control-group share_class">
															<label class="layout-control-label_fblb"><?php _e("Facebook Page ID", facebook_likebox); ?> :
																<span class="hovertip" data-original-title="<?php _e("Facebook Page ID", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
																</span>
															</label>
															<div class="layout-controls">
																<input type="text" id="ux_txt_facebook_page_id" name="ux_txt_facebook_page_id" class="layout-span11" value="" onblur="shortCodeGenerator();" placeholder="<?php _e("Facebook Page id", facebook_likebox); ?>"/>
															</div>
														</div>
														<div class="layout-control-group">
															<label class="layout-control-label_fblb"><?php _e("Language", facebook_likebox); ?> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Language", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
																</span>
															</label>
															<div class="layout-controls">
																<select id="ux_ddl_language" name="ux_ddl_language" class="layout-span11" onblur="shortCodeGenerator();">
																	<?php
																	foreach ($language as $key => $value) 
																	{
																		?>
																		<option value=<?php echo $key; ?>><?php echo $value; ?></option>
																		<?php
																	}
																	?>
																</select>
															</div>
														</div>
														<div class="layout-control-group display_type">
															<label class="layout-control-label_fblb"><?php _e("Show Faces For Like Box", facebook_likebox); ?> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Show Faces For Like Box", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
																</span>
															</label>
															<div class="layout-controls">
																<select id="ux_ddl_show_faces_like_box" name="ux_ddl_show_faces_like_box" class="layout-span11" onblur="shortCodeGenerator();">
																	<option value="yes"><?php _e("Yes", facebook_likebox); ?></option>
																	<option value="no"><?php _e("No", facebook_likebox); ?></option>
																</select>
															</div>
														</div>
														<div class="layout-control-group display_type">
															<label class="layout-control-label_fblb"><?php _e("Header", facebook_likebox); ?> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Header", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
																</span>
															</label>
															<div class="layout-controls">
																<select id="ux_ddl_header" name="ux_ddl_header" class="layout-span11" onblur="shortCodeGenerator();">
																	<option value="yes"><?php _e("Yes", facebook_likebox); ?></option>
																	<option value="no"><?php _e("No", facebook_likebox); ?></option>
																</select>
															</div>
														</div>
														<div class="layout-control-group display_type">
															<label class="layout-control-label_fblb"><?php _e("Color Scheme", facebook_likebox); ?> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Color Scheme", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
																</span>
															</label>
															<div class="layout-controls">
																<select id="ux_ddl_color_scheme" name="ux_ddl_color_scheme" class="layout-span11" onblur="shortCodeGenerator();">
																	<option value="light"><?php _e("Light", facebook_likebox); ?></option>
																	<option value="dark"><?php _e("Dark", facebook_likebox); ?></option>
																</select>
															</div>
														</div>
														<div class="layout-control-group display_type_button" style="display: none;">
															<label class="layout-control-label_fblb"><?php _e("Button Style", facebook_likebox); ?> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Button Style", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
																</span>
															</label>
															<div class="layout-controls">
																<select id="ux_ddl_button_style" name="ux_ddl_button_style" class="layout-span11" onblur="shortCodeGenerator();">
																	<option value="standard"><?php _e("Standard", facebook_likebox); ?></option>
																	<option value="button_count"><?php _e("Button Count", facebook_likebox); ?></option>
																	<option value="box_count"><?php _e("Box Count", facebook_likebox); ?></option>
																</select>
															</div>
														</div>
														<div class="layout-control-group display_type">
															<label class="layout-control-label_fblb"><?php _e("Connections", facebook_likebox); ?><span class="span-text"><?php _e( "(max. 100) ", facebook_likebox ); ?></span> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Connections", facebook_likebox) ;?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
																</span>
															</label>
															<div class="layout-controls">
																<input type="text" id="ux_txt_connections" name="ux_txt_connections" class="layout-span11" value="6" onblur="shortCodeGenerator();" placeholder="<?php _e("Connections", facebook_likebox); ?>"/>
															</div>
														</div>
														<div class="layout-control-group display_type_button" style="display: none;">
															<label class="layout-control-label_fblb"><?php _e("Button Color Scheme", facebook_likebox); ?> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Button Color Scheme", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
																</span>
															</label>
															<div class="layout-controls">
																<select id="ux_ddl_button_color_scheme" name="ux_ddl_button_color_scheme" class="layout-span11" onblur="shortCodeGenerator();">
																	<option value="light"><?php _e("Light", facebook_likebox); ?></option>
																	<option value="dark"><?php _e("Dark", facebook_likebox); ?></option>
																</select>
															</div>
														</div>
														<div class="layout-control-group display_type">
															<label class="layout-control-label_fblb"><?php _e("Width", facebook_likebox); ?><span class="span-text"><?php _e( "(px) ", facebook_likebox); ?></span> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Width", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>" />
																</span>
															</label>
															<div class="layout-controls">
																<input type="text" id="ux_txt_width" name="ux_txt_width" class="layout-span11" value="300" onblur="shortCodeGenerator();" placeholder="<?php _e("Width", facebook_likebox); ?>"/>
															</div>
														</div>
														<div class="layout-control-group display_type">
															<label class="layout-control-label_fblb"><?php _e("Height", facebook_likebox); ?><span class="span-text"><?php _e( "(px) ", facebook_likebox); ?></span> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Height", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
																</span>
															</label>
															<div class="layout-controls">
																<input type="text" id="ux_txt_height" name="ux_txt_height" class="layout-span11" value="300" onblur="shortCodeGenerator();" placeholder="<?php _e("Height", facebook_likebox); ?>"/>
															</div>
														</div>
														<div class="layout-control-group display_type_button" style="display: none;">
															<label class="layout-control-label_fblb"><?php _e("Font", facebook_likebox); ?> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Font", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>"/>
																</span>
															</label>
															<div class="layout-controls">
																<select id="ux_ddl_font" name="ux_ddl_font" class="layout-span11" onblur="shortCodeGenerator();">
																	<option value="arial"><?php _e("Arial", facebook_likebox); ?></option>
																	<option value="tahoma"><?php _e("Tahoma", facebook_likebox); ?></option>
																	<option value="verdana"><?php _e("Verdana", facebook_likebox); ?></option>
																	<option value="lucida grande"><?php _e("Lucida Grande", facebook_likebox); ?></option>
																	<option value="segoe ui"><?php _e("Segoe UI", facebook_likebox); ?></option>
																	<option value="trebuchet ms"><?php _e("Trebuchet MS", facebook_likebox); ?></option>
																</select>
															</div>
														</div>
														<div class="layout-control-group display_type">
															<label class="layout-control-label_fblb"><?php _e("Streams", facebook_likebox); ?> : <span class="error">*</span>
																<span class="hovertip" data-original-title="<?php _e("Streams", facebook_likebox); ?>">
																	<img class="tooltip_img" src="<?php echo FACEBOOK_LIKEBOX_TOOLTIP; ?>" />
																</span>
															</label>
															<div class="layout-controls">
																<select id="ux_ddl_streams" name="ux_ddl_streams" class="layout-span11" onblur="shortCodeGenerator();">
																	<option value="yes"><?php _e("Yes", facebook_likebox); ?></option>
																	<option value="no"><?php _e("No", facebook_likebox); ?></option>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="widget-layout">
											<div class="widget-layout-title">
												<h4>
													<?php _e("Short Code", facebook_likebox); ?>
												</h4>
											</div>
											<div class="widget-layout-body" id="ux_shortcode"></div>
										</div>
										<div class="separator-doubled fb_page_seperator"></div>
										<div class="layout-control-group">
											<input type="submit" id="ux_btn_bottom_save_changes" name="ux_btn_bottom_save_changes" class="btn btn-success" value="<?php _e("Save Changes", facebook_likebox); ?>"/>
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
			var facebook_likebox_checkbox_id = [];
			jQuery(document).ready(function()
			{
				jQuery("#ux_ddl_language").val("en_US");
				jQuery(".hovertip").tooltip({placement: "right"});
				oTable_facebook_likebox = jQuery("#ux_facebook_likebox_settings_data").dataTable
				({
					"bJQueryUI": false,
					"bAutoWidth": true,
					"sPaginationType": "full_numbers",
					"sDom": "<\"datatable-header\"fl>t<\"datatable-footer\"ip>",
					"oLanguage": 
					{
						"sLengthMenu": "<span>Show entries:</span> _MENU_"
					},
					"aaSorting": 
					[
						[ 0, "asc" ]
					],
					"aoColumnDefs": 
					[
						{ "bSortable": false, "aTargets": [] }
					]
				});
				jQuery(".dataTables_length").css("display","none");
				jQuery(".dataTables_filter").css("float","right");
				jQuery(".dataTables_filter").css("margin-bottom","10px");
				shortCodeGenerator();
			});
			jQuery(".framework_tabs .framework_tab-links a").on("click", function(e)
			{
				var currentAttrValue = jQuery(this).attr("href");
				// Show & Hide Tabs
				jQuery(".framework_tabs " + currentAttrValue).show().siblings().hide();
				// Change & remove current tab to active
				jQuery(this).parent("li").addClass("active").siblings().removeClass("active");
				e.preventDefault();
			});

			if (typeof(select_all_facebook_likebox) != "function")
			{
				function select_all_facebook_likebox()
				{
					var bulk_check = jQuery("#ux_chk_selectall_likebox").prop("checked");
					jQuery(oTable_facebook_likebox.fnGetNodes()).find(":checkbox").each(function(index, element) 
					{
						if(element.id != "ux_chk_selectall_likebox")
						{
							var checkbox_id_value = jQuery(element).val();
							if(bulk_check)
							{
								var checkbox_id_index = facebook_likebox_checkbox_id.indexOf(checkbox_id_value);
								if(checkbox_id_index == -1)
								{
									facebook_likebox_checkbox_id.push(checkbox_id_value);
									jQuery(element).attr("checked","checked");
								}
							}
							else
							{
								jQuery(element).removeAttr("checked");
								var checkbox_id_index = facebook_likebox_checkbox_id.indexOf(checkbox_id_value);
								if(checkbox_id_index != -1)
								{
									facebook_likebox_checkbox_id.splice(checkbox_id_index);
								}
							}
						}
					});
				}
			}

			if (typeof(share_button) != "function")
			{
				function share_button()
				{
					var share = jQuery(".share_button").prop("checked");
					if(share == true)
					{
						jQuery(".share_class").css("display", "block");
						shortCodeGenerator();
					}
					else
					{
						jQuery(".share_class").css("display", "none");
						shortCodeGenerator();
					}
				}
			}
			
			if (typeof(change_display_type) != "function")
			{
				function change_display_type()
				{
					var display_type = jQuery("#ux_ddl_display_type").val();
					var share = jQuery(".share_button").prop("checked");
					switch(display_type)
					{
					case "like box":
						jQuery(".display_type").css("display", "block");
						jQuery(".display_type_button").css("display", "none");
						jQuery(".share_btn").css("display", "none");
						jQuery(".share_class").css("display", "block");
						shortCodeGenerator();
					break;
					case "like button":
						jQuery(".display_type_button").css("display", "block");
						jQuery(".display_type").css("display", "none");
						jQuery(".share_btn").css("display", "block");
						if (share == true)
						{
							jQuery(".share_class").css("display", "block");
						}
						else
						{
							jQuery(".share_class").css("display", "none");
						}
						shortCodeGenerator();
					break;
					case "like box button":
						jQuery(".display_type").css("display", "block");
						jQuery(".display_type_button").css("display", "block");
						jQuery(".share_btn").css("display", "none");
						jQuery(".share_class").css("display", "block");
						shortCodeGenerator();
					break;
					}
				}
			}
			
			if (typeof(bulk_delete_likebox) != "function")
			{
				function bulk_delete_likebox()
				{
					jQuery("#top-error").css("display", "none");
					facebook_likebox_checkbox_id = jQuery("input[type=checkbox][name=delete_select_likebox\\[\\]]:checked").map(function() { return this.value; }).get();
					if(jQuery("#ux_ddl_bulk_action").val() == "delete")
					{
						if (facebook_likebox_checkbox_id.length > 0)
						{
							if (facebook_likebox_checkbox_id.length == 1)
							{
								var confirm_delete = confirm("<?php _e("Are you sure, you want to delete this Likebox ?", facebook_likebox); ?>");
							}
							else
							{
								var confirm_delete = confirm("<?php _e("Are you sure, you want to delete these all Likebox ?", facebook_likebox); ?>");
							}
							
							if(confirm_delete == true)
							{
								jQuery.post(ajaxurl,
								{
									facebook_likebox_checkbox_id : facebook_likebox_checkbox_id,
									param: "delete_all_likebox",
									action: "delete_all_likebox_library",
									_wpnonce: "<?php echo $delete_all_likebox; ?>"
								},
								function (data)
								{
									window.location.reload();
								});
							}
						}
						else
						{
							jQuery("#message").css("display", "none");
							jQuery("#error_message_div").html("<?php _e("Please select any one likebox to delete", facebook_likebox); ?>");
							jQuery("#top-error").css("display", "block");
						}
					}
				}
			}
			
			// code for shortcode
			if (typeof(shortCodeGenerator) != "function")
			{
				function shortCodeGenerator()
				{
					var share = jQuery("#ux_rdl_share_button_yes").prop("checked") == true ? "true" : "false" ;
					var title = jQuery("#ux_txt_title").val();
					var show_faces_like_box = jQuery("#ux_ddl_show_faces_like_box").val();
					var facebook_page_url = jQuery("#ux_txt_facebook_page_url").val();
					var facebook_page_id = jQuery("#ux_txt_facebook_page_id").val();
					var button_style = jQuery("#ux_ddl_button_style").val();
					var language = jQuery("#ux_ddl_language").val();
					var show_faces_like_button = jQuery("#ux_ddl_show_faces_like_button").val();
					var display_type = jQuery("#ux_ddl_display_type").val();
					var color_scheme = jQuery("#ux_ddl_color_scheme").val();
					var connections = jQuery("#ux_txt_connections").val();
					var width = jQuery("#ux_txt_width").val();
					var header = jQuery("#ux_ddl_header").val();
					var height = jQuery("#ux_txt_height").val();
					var button_color_scheme = jQuery("#ux_ddl_button_color_scheme").val();
					var streams = jQuery("#ux_ddl_streams").val();
					var font = jQuery("#ux_ddl_font").val();
					
					switch(display_type)
					{
						case "like box":
							var shortcode = "[facebook_likebox title=\""+title+"\" facebook_page_url=\""+facebook_page_url+"\" facebook_page_id=\""+facebook_page_id+
								"\" language=\""+language+"\" display_type=\""+display_type+"\" show_faces_like_box=\""+show_faces_like_box+"\" color_scheme=\""+color_scheme+
								"\" connections=\""+connections+"\" width=\""+width+"\" header=\""+header+"\" height=\""+height+"\" streams=\""+streams+"\"]";
						break;
						case "like button":
							if(share == "true")
							{
								var shortcode = "[facebook_likebox title=\""+title+"\" facebook_page_url=\""+facebook_page_url+"\" facebook_page_id=\""+facebook_page_id+"\" share_button=\""+share+"\" button_style=\""+button_style+"\" language=\""+language+"\" show_faces_like_button=\""+show_faces_like_button+"\" display_type=\""+display_type+
									"\" button_color_scheme=\""+button_color_scheme+"\" font=\""+font+"\"]";
							}
							else
							{
								var shortcode = "[facebook_likebox share_button=\""+share+"\" button_style=\""+button_style+"\" language=\""+language+"\" show_faces_like_button=\""+show_faces_like_button+"\" display_type=\""+display_type+
									"\" button_color_scheme=\""+button_color_scheme+"\" font=\""+font+"\"]";
							}
						break;
						case "like box button":
							var shortcode = "[facebook_likebox title=\""+title+"\" show_faces_like_box=\""+show_faces_like_box+"\" facebook_page_url=\""+facebook_page_url+"\" facebook_page_id=\""+facebook_page_id+"\" button_style=\""+button_style+
								"\" language=\""+language+"\" show_faces_like_button=\""+show_faces_like_button+"\" display_type=\""+display_type+"\" color_scheme=\""+color_scheme+"\" connections=\""+connections+
								"\" width=\""+width+"\" header=\""+header+"\" height=\""+height+"\" button_color_scheme=\""+button_color_scheme+"\" streams=\""+streams+"\" font=\""+font+"\"]";
						break;
					}
					jQuery("#ux_shortcode").html(shortcode);
				}
			}

			if (typeof(delete_facebook_likebox) != "function")
			{
				function delete_facebook_likebox(setting_id)
				{
					var confirm_delete = confirm("<?php _e("Are you sure, you want to delete this Likebox ?", facebook_likebox); ?>");
					if(confirm_delete == true)
					{
						jQuery.post(ajaxurl,
						{
							setting_id: setting_id,
							param: "single_likebox_delete",
							action: "delete_likebox_library",
							_wpnonce: "<?php echo $delete_likebox; ?>"
						},
						function (data)
						{
							window.location.reload();
						});
					}
				}
			}
			
			jQuery("#ux_frm_facebook_pages").validate
			({
				rules :
				{
					ux_txt_title :
					{
						required:true
					},
					ux_txt_facebook_page_url :
					{
						required:true,
						url:true
					},
					ux_txt_facebook_page_id :
					{
						number:true
					},
					ux_txt_connections :
					{
						required:true,
						number: true,
						range: [1,100]
					},
					ux_txt_width :
					{
						required:true,
						number:true
					},
					ux_txt_height :
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
					jQuery("body").append(overlay);
					jQuery.post(ajaxurl,jQuery(form).serialize()+"&param=add_new_facebook_likebox&action=facebook_likebox_library&_wpnonce=<?php echo $add_facebook_likebox; ?>", function(data)
					{
						jQuery("body,html").animate({scrollTop: jQuery("body,html").position().top}, "slow");
						setTimeout(function () 
						{
							jQuery("#message").css("display", "block");
							jQuery(".loader_opacity").remove();
							jQuery(".opacity_overlay").remove();
							jQuery("#message").css("display","block");
							window.location.reload();
						}, 
						2000);
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

			if (typeof(error_message_close) != "function")
			{
				function error_message_close()
				{
					jQuery("#top-error").css("display", "none");
				}
			}
		</script>
		<?php
	}
}
?>