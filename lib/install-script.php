<?php
require_once(ABSPATH . "wp-admin/includes/upgrade.php");

/////////////////////////////// Creating Class For Save Facebook Likebox Data //////////////////////////////
if(!class_exists("save_licensing_data"))
{
	class save_licensing_data
	{
		function insert($tbl, $data)
		{
			global $wpdb;
			$wpdb->insert($tbl, $data);
		}
	}
}

///////////////////////////////// Creating Table For Facebook Likebox //////////////////////////////////

if(!function_exists("create_table_facebook_setting"))
{
	function create_table_facebook_setting()
	{
		$sql = "CREATE TABLE IF NOT EXISTS ".facebook_settings_tbl()." (
				`setting_id` int(10) NOT NULL AUTO_INCREMENT,
				`type` varchar(100) NOT NULL,
				PRIMARY KEY (`setting_id`)
			)ENGINE=InnoDB DEFAULT CHARSET = utf8 COLLATE utf8_general_ci";
		dbDelta($sql);
	}
}

if(!function_exists("create_table_facebook_setting_licensing"))
{
	function create_table_facebook_setting_licensing()
	{
		$sql = "CREATE TABLE IF NOT EXISTS ".facebook_settings_licensing_tbl()." (
				`licensing_id` int(10) NOT NULL AUTO_INCREMENT,
				`version` varchar(100) NOT NULL,
				`type` varchar(100) NOT NULL,
				`url` varchar(100) NOT NULL,
				`api_key` varchar(100) NOT NULL,
				`order_id` int(10) NOT NULL,
				PRIMARY KEY (`licensing_id`)
			)ENGINE=InnoDB DEFAULT CHARSET = utf8 COLLATE utf8_general_ci";
		dbDelta($sql);
	}
}

if(!function_exists("create_table_facebook_setting_meta"))
{
	function create_table_facebook_setting_meta()
	{
		$sql = "CREATE TABLE IF NOT EXISTS ".facebook_settings_meta_tbl()." (
				`meta_id` int(10) NOT NULL AUTO_INCREMENT,
				`setting_id` int(10) NOT NULL,
				`meta_key` varchar(100) NOT NULL,
				`meta_value` longtext NOT NULL,
				PRIMARY KEY (`meta_id`)
			)ENGINE=InnoDB DEFAULT CHARSET = utf8 COLLATE utf8_general_ci";
		dbDelta($sql);
	}
}

$version = get_option("facebook-likebox-version-number");
switch ($version)
{
	case "":
		$insert_data = new save_licensing_data();
		
		create_table_facebook_setting();
		
		$facebook_setting = array();
		$facebook_setting["type"] = "general_settings";
		$insert_data->insert(facebook_settings_tbl(), $facebook_setting);
		$last_id = $wpdb->insert_id;
		
		create_table_facebook_setting_meta();
		
		$facebook_setting_meta = array();
		$facebook_setting_meta["administrator"] = "1";
		$facebook_setting_meta["editor"] = "1";
		$facebook_setting_meta["author"] = "1";
		$facebook_setting_meta["contributor"] = "0";
		$facebook_setting_meta["subscriber"] = "0";
		$facebook_setting_meta["top_bar_menu"] = "1";
		$facebook_setting_meta["facebook_app_id"] = "717700741660857";
		foreach ($facebook_setting_meta as $key => $value)
		{
			$meta_array = array();
			$meta_array["setting_id"] = $last_id;
			$meta_array["meta_key"] = $key;
			$meta_array["meta_value"] = $value;
			$insert_data->insert(facebook_settings_meta_tbl(), $meta_array);
		}
		
		create_table_facebook_setting_licensing();
		
		$licensing_data = array();
		$licensing_data["version"] = "1.0";
		$licensing_data["type"] = "Facebook Likebox";
		$licensing_data["url"] = site_url();
		$insert_data->insert(facebook_settings_licensing_tbl(), $licensing_data);
	break;
}
update_option("facebook-like-automatic_update",1);
update_option("facebook-likebox-version-number","1.0");
?>