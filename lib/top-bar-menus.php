<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////
/////////								Creating Top-bar Menus								///////////
///////////////////////////////////////////////////////////////////////////////////////////////////////

if (!is_user_logged_in())
{
	return;
}
else
{
	$wp_admin_bar->add_menu(array(
		"id" => "facebook_likebox",
		"title" => "<img src=\"".plugins_url("/assets/images/icon.png",dirname(__FILE__))."\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Facebook Likebox" ,
		"href" => site_url()."/wp-admin/admin.php?page=facebook_likebox",
	));
	$wp_admin_bar->add_menu(array(
		"parent" => "facebook_likebox",
		"id" => "facebook_pages",
		"href" => site_url()."/wp-admin/admin.php?page=facebook_likebox",
		"title" => __("Facebook Pages",facebook_likebox))									/* set the sub-menu name */
	);
	$wp_admin_bar->add_menu(array(
		"parent" => "facebook_likebox",
		"id" => "system_status",
		"href" => site_url()."/wp-admin/admin.php?page=fblb_system_status",
		"title" => __("System Status",facebook_likebox))									/* set the sub-menu name */
	);
	$wp_admin_bar->add_menu(array(
		"parent" => "facebook_likebox",
		"id" => "general_settings",
		"href" => site_url()."/wp-admin/admin.php?page=fblb_general_Settings",
		"title" => __("General Settings",facebook_likebox))									/* set the sub-menu name */
	);
}
?>