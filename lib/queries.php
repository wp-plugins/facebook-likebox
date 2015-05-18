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
		$facebook_data = $wpdb->get_results
		(
			"SELECT * FROM ".facebook_settings_tbl()." INNER JOIN ".facebook_settings_meta_tbl()." ON ".facebook_settings_tbl().".setting_id = ".facebook_settings_meta_tbl().".setting_id"
		);
		if(!function_exists("get_data_from_db"))
		{
			function get_data_from_db($type,$facebook_data)
			{
				$facebook_settings_array = array();
				$facebook_meta_array = array();
				foreach ($facebook_data as $row)
				{
					if ($row->type == $type)
					{
						foreach ($row as $InnerRow)
						{
							$facebook_meta_array[$row->meta_key] = $row->meta_value;
							$facebook_meta_array["setting_id"] = $row->setting_id;
						}
						$facebook_settings_array[$row->setting_id] = $facebook_meta_array;
					}
				}
				return $facebook_settings_array;
			}
		}
		
		switch($_REQUEST["page"])
		{
			case "facebook_likebox" :
				$get_facebook_data = get_data_from_db("facebook_likebox", $facebook_data);
			break;
			case "fblb_general_Settings":
				$get_setting_data = get_data_from_db("general_settings", $facebook_data);
			break;
		}
		
		$publish_pages = $wpdb->get_results
		(
			$wpdb->prepare
			(
				"SELECT ID,post_name FROM " . $wpdb->posts . " WHERE (post_type = %s) AND post_status = %s",
				"page",
				"publish"
			)
		);
		
		$publish_posts = $wpdb->get_results
		(
			$wpdb->prepare
			(
				"SELECT ID,post_name FROM " . $wpdb->posts . " WHERE (post_type = %s) AND post_status = %s",
				"post",
				"publish"
			)
		);
	}
}
?>