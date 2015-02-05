<?php
//------------------------------------------------------------------------------------------------------------------//
//											CODE FOR CREATING MENUS													//
//------------------------------------------------------------------------------------------------------------------//

if (!is_user_logged_in())
{
	return;
}
else
{
	add_menu_page("Facebook Likebox", "Facebook Likebox", "read", "facebook_likebox", "", plugins_url("assets/images/icon.png", dirname(__FILE__)));
	add_submenu_page("facebook_likebox", "Facebook Pages", __("Facebook Pages", facebook_likebox), "read", "facebook_likebox", "facebook_likebox");
	add_submenu_page("facebook_likebox", "System Status", __("System Status", facebook_likebox), "read", "fblb_system_status", "fblb_system_status");
	add_submenu_page("facebook_likebox", "General Settings", __("General Settings", facebook_likebox), "read", "fblb_general_Settings", "fblb_general_Settings");
	
	//--------------------------------------------------------------------------------------------------------------//
	//											CODE FOR CREATING PAGES												//
	//--------------------------------------------------------------------------------------------------------------//
	
	if(!function_exists("facebook_likebox"))
	{
		function facebook_likebox()
		{
			global $wpdb, $current_user, $user_role_permission;
			if(is_super_admin())
			{
				$fblb_role = "administrator";
			}
			else
			{
				$fblb_role = $wpdb->prefix . "capabilities";
				$current_user->role = array_keys($current_user->$fblb_role);
				$fblb_role = $current_user->role[0];
			}
			if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/header.php"))
			{
				include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/header.php";
			}
			if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/facebook-pages.php"))
			{
				include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/facebook-pages.php";
			}
		}
	}
	
	if(!function_exists("fblb_system_status"))
	{
		function fblb_system_status()
		{
			global $wpdb, $current_user, $user_role_permission;
			if(is_super_admin())
			{
				$fblb_role = "administrator";
			}
			else
			{
				$fblb_role = $wpdb->prefix . "capabilities";
				$current_user->role = array_keys($current_user->$fblb_role);
				$fblb_role = $current_user->role[0];
			}
			if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/header.php"))
			{
				include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/header.php";
			}
			if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/system-status.php"))
			{
				include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/system-status.php";
			}
		}
	}
	
	if(!function_exists("fblb_general_Settings"))
	{
		function fblb_general_Settings()
		{
			global $wpdb, $current_user, $user_role_permission;
			if(is_super_admin())
			{
				$fblb_role = "administrator";
			}
			else
			{
				$fblb_role = $wpdb->prefix . "capabilities";
				$current_user->role = array_keys($current_user->$fblb_role);
				$fblb_role = $current_user->role[0];
			}
			if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/header.php"))
			{
				include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/header.php";
			}
			if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/general-settings.php"))
			{
				include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/general-settings.php";
			}
		}
	}
}
?>