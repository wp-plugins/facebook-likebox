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
		/////////////////////////////// Creating Class For Save Facebook Likebox Data //////////////////////////////
		
		if(!class_exists("save_facebook_likebox_data"))
		{
			class save_facebook_likebox_data
			{
				function insert_data($tbl, $data)
				{
					global $wpdb;
					$wpdb->insert($tbl,$data);
				}
				function update_data($tbl,$data, $where)
				{
					global $wpdb;
					$wpdb->update($tbl,$data, $where);
				}
				function delete_data($tbl, $where)
				{
					global $wpdb;
					$wpdb->delete($tbl, $where);
				}
				function bulk_delete($tbl, $col, $where)
				{
					global $wpdb;
					$wpdb->query
					(
						"DELETE FROM ".$tbl." WHERE ".$col." IN (".$where.")"
					);
				}
			}
		}
		if(isset($_REQUEST["param"]))
		{
			$object_save_data = new save_facebook_likebox_data();
			switch ($_REQUEST["param"])
			{
				case "add_new_facebook_likebox":
					if(wp_verify_nonce($_REQUEST["_wpnonce"], "add_facebook_likebox"))
					{
						$add_facebook_setting = array();
						$add_facebook_setting["type"] = "facebook_likebox";
						$object_save_data->insert_data(facebook_settings_tbl(), $add_facebook_setting);
						$setting_id = $wpdb->insert_id;
						$add_facebook_setting_meta = array();
						$add_facebook_setting_meta["language"] = esc_attr($_REQUEST["ux_ddl_language"]);
						$add_facebook_setting_meta["display_type"] = esc_attr($_REQUEST["ux_ddl_display_type"]);
						
						switch ($_REQUEST["ux_ddl_display_type"])
						{
							case "like box":
								$add_facebook_setting_meta["title"] = esc_attr($_REQUEST["ux_txt_title"]);
								$add_facebook_setting_meta["facebook_page_url"] = esc_url($_REQUEST["ux_txt_facebook_page_url"]);
								$add_facebook_setting_meta["facebook_page_id"] = esc_attr($_REQUEST["ux_txt_facebook_page_id"]);
								$add_facebook_setting_meta["show_faces_like_box"] = esc_attr($_REQUEST["ux_ddl_show_faces_like_box"]);
								$add_facebook_setting_meta["color_scheme"] = esc_attr($_REQUEST["ux_ddl_color_scheme"]);
								$add_facebook_setting_meta["connections"] = esc_attr($_REQUEST["ux_txt_connections"]);
								$add_facebook_setting_meta["width"] = esc_attr($_REQUEST["ux_txt_width"]);
								$add_facebook_setting_meta["header"] = esc_attr($_REQUEST["ux_ddl_header"]);
								$add_facebook_setting_meta["height"] = esc_attr($_REQUEST["ux_txt_height"]);
								$add_facebook_setting_meta["streams"] = esc_attr($_REQUEST["ux_ddl_streams"]);
								$add_facebook_setting_meta["border_color"] = esc_attr($_REQUEST["ux_txt_border_color"]);
							break;
							case "like button":
								$add_facebook_setting_meta["share_button"] = esc_attr($_REQUEST["ux_rdl_share_button"]);
								if($_REQUEST["ux_rdl_share_button"] == "true")
								{
									$add_facebook_setting_meta["title"] = esc_attr($_REQUEST["ux_txt_title"]);
									$add_facebook_setting_meta["facebook_page_url"] = esc_url($_REQUEST["ux_txt_facebook_page_url"]);
									$add_facebook_setting_meta["facebook_page_id"] = esc_attr($_REQUEST["ux_txt_facebook_page_id"]);
								}
								$add_facebook_setting_meta["button_color_scheme"] = esc_attr($_REQUEST["ux_ddl_button_color_scheme"]);
								$add_facebook_setting_meta["show_faces_like_button"] = esc_attr($_REQUEST["ux_ddl_show_faces_like_button"]);
								$add_facebook_setting_meta["button_style"] = esc_attr($_REQUEST["ux_ddl_button_style"]);
								$add_facebook_setting_meta["font"] = esc_attr($_REQUEST["ux_ddl_font"]);
							break;
							case "like box button":
								$add_facebook_setting_meta["title"] = esc_attr($_REQUEST["ux_txt_title"]);
								$add_facebook_setting_meta["facebook_page_url"] = esc_url($_REQUEST["ux_txt_facebook_page_url"]);
								$add_facebook_setting_meta["facebook_page_id"] = esc_attr($_REQUEST["ux_txt_facebook_page_id"]);
								$add_facebook_setting_meta["show_faces_like_box"] = esc_attr($_REQUEST["ux_ddl_show_faces_like_box"]);
								$add_facebook_setting_meta["color_scheme"] = esc_attr($_REQUEST["ux_ddl_color_scheme"]);
								$add_facebook_setting_meta["connections"] = esc_attr($_REQUEST["ux_txt_connections"]);
								$add_facebook_setting_meta["width"] = esc_attr($_REQUEST["ux_txt_width"]);
								$add_facebook_setting_meta["header"] = esc_attr($_REQUEST["ux_ddl_header"]);
								$add_facebook_setting_meta["height"] = esc_attr($_REQUEST["ux_txt_height"]);
								$add_facebook_setting_meta["streams"] = esc_attr($_REQUEST["ux_ddl_streams"]);
								$add_facebook_setting_meta["button_color_scheme"] = esc_attr($_REQUEST["ux_ddl_button_color_scheme"]);
								$add_facebook_setting_meta["show_faces_like_button"] = esc_attr($_REQUEST["ux_ddl_show_faces_like_button"]);
								$add_facebook_setting_meta["button_style"] = esc_attr($_REQUEST["ux_ddl_button_style"]);
								$add_facebook_setting_meta["font"] = esc_attr($_REQUEST["ux_ddl_font"]);
								$add_facebook_setting_meta["border_color"] = esc_attr($_REQUEST["ux_txt_border_color"]);
							break;
						}
						
						foreach ($add_facebook_setting_meta as $key => $value)
						{
							$insert_facebook_setting_meta_array = array();
							$insert_facebook_setting_meta_array["setting_id"] = $setting_id;
							$insert_facebook_setting_meta_array["meta_key"] = $key;
							$insert_facebook_setting_meta_array["meta_value"] = $value;
							$object_save_data->insert_data(facebook_settings_meta_tbl(), $insert_facebook_setting_meta_array);
						}
						die();
					}
				break;
				case "single_likebox_delete":
					if(wp_verify_nonce($_REQUEST["_wpnonce"], "delete_likebox"))
					{
						$delete_likebox_meta_array = array();
						$delete_likebox_meta_array["setting_id"] = intval($_REQUEST["setting_id"]);
						$object_save_data->delete_data(facebook_settings_meta_tbl(), $delete_likebox_meta_array);
						$delete_likebox_array = array();
						$delete_likebox_array["setting_id"] = intval($_REQUEST["setting_id"]);
						$object_save_data->delete_data(facebook_settings_tbl(), $delete_likebox_array);
						die();
					}
				break;
				case "delete_all_likebox":
					if(wp_verify_nonce($_REQUEST["_wpnonce"], "delete_all_likebox"))
					{
						$setting_id = isset($_REQUEST["facebook_likebox_data"]) ? implode(",",$_REQUEST["facebook_likebox_data"]) : "0";
						$object_save_data->bulk_delete(facebook_settings_meta_tbl(), "setting_id",$setting_id);
						$object_save_data->bulk_delete(facebook_settings_tbl(), "setting_id",$setting_id);
						die();
					}
				break;
				case "plugin_settings":
					if(wp_verify_nonce($_REQUEST["_wpnonce"], "plugin_settings"))
					{
						$facebook_meta_plugin_settings = array();
						$facebook_meta_plugin_settings["facebook_app_id"] = isset($_REQUEST["ux_txt_app_id"]) ? $_REQUEST["ux_txt_app_id"] : "717700741660857";
						$facebook_meta_plugin_settings["administrator"] = "1";
						$facebook_meta_plugin_settings["editor"] = isset($_REQUEST["ux_chk_editor"]) ? "1" : "0";
						$facebook_meta_plugin_settings["author"] = isset($_REQUEST["ux_chk_author"]) ? "1" : "0";
						$facebook_meta_plugin_settings["contributor"] = isset($_REQUEST["ux_chk_contributor"]) ? "1" : "0";
						$facebook_meta_plugin_settings["subscriber"] = isset($_REQUEST["ux_chk_admin_subscriber"]) ? "1" : "0";
						$facebook_meta_plugin_settings["top_bar_menu"] = $_REQUEST["ux_rdl_enable_menu"] ? "1" : "0";
						foreach ($facebook_meta_plugin_settings as $key => $value)
						{
							$wpdb->query
							(
								$wpdb->prepare
								(
									"UPDATE ".facebook_settings_meta_tbl()." SET meta_value = $value WHERE meta_key = %s",
									$key
								)
							);
						}
						die();
					}
				break;
			}
		}
	}
}
?>