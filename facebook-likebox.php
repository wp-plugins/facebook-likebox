<?php 
/*
Plugin Name: Facebook Likebox
Plugin URI: http://tech-banker.com
Description: Let people share pages and content from your site back to their Facebook profile with one click, so all their friends can read them.
Author: Tech Banker
Version: 1.0.3
Author URI: http://tech-banker.com
*/

//////////////////////////////////////////// Define Facebook Likebox Constants //////////////////////////////////////

if (!defined("FACEBOOK_LIKEBOX_PLUGIN_DIR")) define("FACEBOOK_LIKEBOX_PLUGIN_DIR", plugin_dir_path( __FILE__ ));
if (!defined("facebook_likebox")) define("facebook_likebox", "facebook_likebox");
if(!defined("FACEBOOK_LIKEBOX_TOOLTIP")) define("FACEBOOK_LIKEBOX_TOOLTIP", plugins_url(plugin_basename(dirname(__FILE__))."/assets/images/questionmark_icon.png" , dirname(__FILE__)));
if (!defined("tech_bank")) define("tech_bank", "tech-banker");

/////////////////////////////////////////// Call Install Script on Plugin Activation ////////////////////////////////

if(!function_exists("plugin_install_script_for_facebook_likebox"))
{
	function plugin_install_script_for_facebook_likebox()
	{
		global $wpdb;
		if (is_multisite())
		{
			$blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach($blog_ids as $blog_id)
			{
				switch_to_blog($blog_id);
				if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/install-script.php"))
				{
					include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/install-script.php";
				}
				restore_current_blog();
			}
		}
		else
		{
			if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/install-script.php"))
			{
				include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/install-script.php";
			}
		}
	}
}

///////////////////////////////////// Functions for Returing Table Names /////////////////////////////////

if(!function_exists("facebook_settings_tbl"))
{
	function facebook_settings_tbl()
	{
		global $wpdb;
		return $wpdb->prefix . "facebook_settings";
	}
}

if(!function_exists("facebook_settings_meta_tbl"))
{
	function facebook_settings_meta_tbl()
	{
		global $wpdb;
		return $wpdb->prefix . "facebook_settings_meta";
	}
}

if(!function_exists("facebook_settings_licensing_tbl"))
{
	function facebook_settings_licensing_tbl()
	{
		global $wpdb;
		return $wpdb->prefix . "facebook_settings_licensing";
	}
}

///////////////////////////////////// Call CSS & JS Scripts - Back End ///////////////////////////////////

if(!function_exists("admin_panel_css_calls_for_facebook_likebox"))
{
	function admin_panel_css_calls_for_facebook_likebox()
	{
		wp_enqueue_style("farbtastic");
		wp_enqueue_style("tech-banker-framework.css", plugins_url("/assets/css/framework.css", __FILE__));
		wp_enqueue_style("facebook-likebox-custom.css", plugins_url("/assets/css/facebook-likebox-custom.css", __FILE__));
		wp_enqueue_style("custom-ui.css", plugins_url("/assets/css/custom-ui.css", __FILE__));
	}
}

if(!function_exists("admin_panel_js_calls_for_facebook_likebox"))
{
	function admin_panel_js_calls_for_facebook_likebox()
	{
		wp_enqueue_script("jquery");
		wp_enqueue_script("farbtastic");
		wp_enqueue_script("jquery-ui-datepicker");
		wp_enqueue_script("jquery.dataTables.min.js", plugins_url("/assets/js/jquery.dataTables.min.js", __FILE__));
		wp_enqueue_script("jquery.Tooltip.js", plugins_url("/assets/js/jquery.Tooltip.js", __FILE__));
		wp_enqueue_script("jquery.validate.min.js", plugins_url("/assets/js/jquery.validate.min.js", __FILE__));
	}
}

////////////////////////////////////////// Call CSS & JS Script - Front End ////////////////////////////////////////////

if(!function_exists("frontend_plugin_css_styles_facebook_likebox"))
{
	function frontend_plugin_css_styles_facebook_likebox()
	{
		wp_enqueue_style("facebook-likebox-frontend.css", plugins_url("/assets/css/facebook-likebox-frontend.css", __FILE__));
	}
}

if(!function_exists("frontend_plugin_js_calls_for_facebook_likebox"))
{
	function frontend_plugin_js_calls_for_facebook_likebox()
	{
		wp_enqueue_script("jquery");
	}
}

///////////////////////////////////// Include Menus on Admin Area //////////////////////////////////////////

if(!function_exists("create_global_menus_for_facebook_likebox"))
{
	function create_global_menus_for_facebook_likebox()
	{
		global $wpdb, $current_user;
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
		switch($fblb_role)
		{
			case "administrator":
				if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/menus.php"))
				{
					include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/menus.php";
				}
			break;
			case "editor":
				if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/menus.php"))
				{
					include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/menus.php";
				}
			break;
			case "author":
				if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/menus.php"))
				{
					include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/menus.php";
				}
			break;
			case "contributor":
				if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/menus.php"))
				{
					include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/menus.php";
				}
			break;
			case "subscriber":
				if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/menus.php"))
				{
					include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/menus.php";
				}
			break;
		}
	}
}

/////////////////////////////////////////////// Adding Top-bar Menus /////////////////////////////////////////

if(!function_exists("add_facebook_likebox_admin_bar"))
{
	function add_facebook_likebox_admin_bar($meta = TRUE)
	{
		global $wp_admin_bar, $wpdb,$current_user;
		if (!is_user_logged_in())
		{
			return;
		}
		else
		{
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
			$setting_data = $wpdb->get_var
			(
				$wpdb->prepare
				(
					"SELECT meta_value FROM ".facebook_settings_meta_tbl()." WHERE meta_key=%s",
					"top_bar_menu"
				)
			);
			if($setting_data == "1")
			{
				switch($fblb_role)
				{
					case "administrator":
						if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/top-bar-menus.php"))
						{
							include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/top-bar-menus.php";
						}
					break;
					case "editor":
						if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/top-bar-menus.php"))
						{
							include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/top-bar-menus.php";
						}
					break;
					case "author":
						if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/top-bar-menus.php"))
						{
							include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/top-bar-menus.php";
						}
					break;
					case "contributor":
						if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/top-bar-menus.php"))
						{
							include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/top-bar-menus.php";
						}
					break;
					case "subscriber":
						if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/top-bar-menus.php"))
						{
							include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/top-bar-menus.php";
						}
					break;
				}
			}
		}
	}
}

///////////////////////////////////////// Register Ajax Based Functions ////////////////////////////////////////

if(!function_exists("facebook_likebox_actions"))
{
	function facebook_likebox_actions()
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
		if(isset($_REQUEST["action"]))
		{
			if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/facebook-likebox-class.php"))
			{
				include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/lib/facebook-likebox-class.php";
			}
		}
	}
}

////////////////////////////////////////// Add Shortcodes Functions //////////////////////////////////////

add_shortcode("facebook_likebox", "facebook_likebox_short_code");

function facebook_likebox_short_code($atts)
{
	extract(shortcode_atts(array(
	"facebook_app_id" => "",
	"title" => "",
	"show_faces_like_box" => "",
	"facebook_page_url" => "",
	"facebook_page_id" => "",
	"button_style" => "",
	"language" => "",
	"show_faces_like_button" => "",
	"display_type" => "",
	"color_scheme" => "",
	"connections" => "",
	"width" => "",
	"header" => "",
	"height" => "",
	"button_color_scheme" => "",
	"streams" => "",
	"font" => "",
	"border_color" => "",
	"share_button" => "",
	), $atts));
	return extract_short_code_for_facebook_likebox($facebook_app_id, $title, $show_faces_like_box, $facebook_page_url, $facebook_page_id, $button_style, $language, $show_faces_like_button, $display_type, $color_scheme, $connections, $width, $header, $height, $button_color_scheme, $streams, $font, $border_color, $share_button);
}

function extract_short_code_for_facebook_likebox($facebook_app_id, $title, $show_faces_like_box, $facebook_page_url, $facebook_page_id, $button_style, $language, $show_faces_like_button , $display_type, $color_scheme, $connections, $width, $header, $height, $button_color_scheme, $streams, $font, $border_color, $share_button)
{
	ob_start();
	if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/facebook-likebox-frontend.php"))
	{
		include_once FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/facebook-likebox-frontend.php";
	}
	$facebook_likebox_output = ob_get_clean();
	wp_reset_query();
	return $facebook_likebox_output;
}

class Facebook_Likebox_Widget extends WP_Widget
{
	function Facebook_Likebox_Widget()
	{
		$widget_ops = array("classname" => "Facebook_Likebox_Widget", "description" => "Uses Facebook Likebox" );
		$this->WP_Widget("Facebook_Likebox_Widget", "Facebook Likebox", $widget_ops);
	}
	function form($instance)
	{
		if(file_exists(FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/facebook-likebox-widget.php"))
		{
			include FACEBOOK_LIKEBOX_PLUGIN_DIR."/views/facebook-likebox-widget.php";
		}
	}
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance["title"] = stripslashes($new_instance["title"]);
		$instance["fbl_language"] = stripslashes($new_instance["fbl_language"]);
		$instance["display_type"] = $new_instance["display_type"];
		$instance["facebook_page_id"] = $new_instance["facebook_page_id"];
		$instance["facebook_page_url"] = $new_instance["facebook_page_url"];
		$instance["connections"] = $new_instance["connections"];
		$instance["width"] = $new_instance["width"];
		$instance["height"] = $new_instance["height"];
		$instance["border_color"] = $new_instance["border_color"];
		$instance["streams"] = $new_instance["streams"];
		$instance["color_scheme"] = $new_instance["color_scheme"];
		$instance["show_faces_like_box"] = $new_instance["show_faces_like_box"];
		$instance["header"] = $new_instance["header"];
		$instance["button_style"] = $new_instance["button_style"];
		$instance["button_color_scheme"] = $new_instance["button_color_scheme"];
		$instance["show_faces_like_button"] = $new_instance["show_faces_like_button"];
		$instance["font"] = $new_instance["font"];
		return $instance;
	}
	function widget($args, $instance)
	{
		extract($args);
	
		$title = empty($instance["title"]) ? "" : apply_filters("widget_title", $instance["title"]);
		$fbl_language = empty($instance["fbl_language"]) ? "en_US" : $instance["fbl_language"];
		$display_type = empty($instance["display_type"]) ? "likebox" : $instance["display_type"];
		$facebook_page_id = empty($instance["facebook_page_id"]) ? "" : $instance["facebook_page_id"];
		$facebook_page_url = empty($instance["facebook_page_url"]) ? "http://www.facebook.com/techbanker" : $instance["facebook_page_url"];
		$connections = empty($instance["connections"]) ? "6" : $instance["connections"];
		$width = empty($instance["width"]) ? "300" : $instance["width"];
		$height = empty($instance["height"]) ? "300" : $instance["height"];
		$border_color = empty($instance["border_color"]) ? "000000" : $instance["border_color"];
		$streams = empty($instance["streams"]) ? "yes" : $instance["streams"];
		$color_scheme = empty($instance["color_scheme"]) ? "light" : $instance["color_scheme"];
		$show_faces_like_box = empty($instance["show_faces_like_box"]) ? "yes" : $instance["show_faces_like_box"];
		$header = empty($instance["header"])? "yes" : $instance["header"];
		$button_style = empty($instance["button_style"]) ? "standard" : $instance["button_style"];
		$button_color_scheme = empty($instance["button_color_scheme"])? "light" : $instance["button_color_scheme"];
		$show_faces_like_button = empty($instance["show_faces_like_button"]) ? "yes" : $instance["show_faces_like_button"];
		$font = empty($instance["font"]) ? "arial" : $instance["font"];
	
		($streams == "yes") ? "true" : "false";
		($show_faces_like_box == "yes") ? "true" : "false";
		($header == "yes") ? "true" : "false";
		($show_faces_like_button == "yes") ? "true" : "false";
	
		echo $before_widget;
		echo $before_title . $title . $after_title;
		
		global $wpdb;
		$facebook_app_id = $wpdb->get_var
		(
			$wpdb->prepare
			(
				"SELECT meta_value FROM ".facebook_settings_meta_tbl()." WHERE meta_key=%s",
				"facebook_app_id"
			)
		);
		?>
		<script>
			var facebook_appid = <?php echo $facebook_app_id; ?>;
			window.fbAsyncInit = function() 
			{
				FB.init({
				appId : facebook_appid,
				xfbml : true,
				version : "v2.2"
				});
			};
		
			(function(d, s, id)
			{
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/<?php echo $fbl_language; ?>/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}
			(document, "script", "facebook-jssdk"));
		</script>
		<?php
		
		switch ($instance["display_type"])
		{
			case "like box":
				$result = "<div id=fb-root></div>
					<script>(function(d, s, id){
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) {return;}
					js = d.createElement(s); js.id = id;
					js.src = //connect.facebook.net/en_US/sdk.js;
					fjs.parentNode.insertBefore(js, fjs);
					}(document, script, facebook-jssdk));</script>";
				
				$result.= "<div class=fb-like-box data-href=".$facebook_page_url." data-colorscheme=".$color_scheme." data-width=".$width." data-height=".$height." data-show-faces=".$show_faces_like_box." data-header=".$header." data-stream=".$streams." data-display-type=".$display_type." connections=".$connections." ></div>";
				echo $result;
			break;
			case "like button":
				?>
				<div class="fb-like" data-send="true" data-href="<?php echo $facebook_page_url; ?>" data-layout="<?php echo $button_style; ?>" data-colorscheme="<?php echo $button_color_scheme; ?>" style="font:<?php echo $font; ?>" data-action="like" data-share="true" style="margin-bottom: 15px;" data-show-faces="<?php echo $show_faces_like_button; ?>" ></div>
				<?php
			break;
			case "like box button":
				?>
				<div class="fb-like" data-send="true" data-href="<?php echo $facebook_page_url; ?>" data-layout="<?php echo $button_style; ?>" data-colorscheme="<?php echo $button_color_scheme; ?>" style="font:<?php echo $font; ?>" data-action="like" data-share="true" style="margin-bottom: 15px;" data-show-faces="<?php echo $show_faces_like_button; ?>" ></div>
				<?php
				$result = "<div id=fb-root></div>
					<script>(function(d, s, id){
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) {return;}
					js = d.createElement(s); js.id = id;
					js.src = //connect.facebook.net/en_US/sdk.js;
					fjs.parentNode.insertBefore(js, fjs);
					}(document, script, facebook-jssdk));</script>";
				
				$result.= "<div class=fb-like-box data-href=".$facebook_page_url." data-colorscheme=".$color_scheme." data-width=".$width." data-height=".$height." data-show-faces=".$show_faces_like_box." data-header=".$header." data-stream=".$streams." data-display-type=".$display_type." connections=".$connections."></div>";
				echo $result;
			break;
		}
		
		echo $after_widget;
	}
}

add_action( "widgets_init", create_function("", "return register_widget(\"Facebook_Likebox_Widget\");"));

$is_option_auto_update = get_option("facebook-like-automatic_update");

if($is_option_auto_update == "" || $is_option_auto_update == "1")
{
	if (!wp_next_scheduled("facebook_likebox_auto_update"))
	{
		wp_schedule_event(time(), "daily", "facebook_likebox_auto_update");
	}
	add_action("facebook_likebox_auto_update", "facebook_plugin_autoUpdate");
}
else
{
	wp_clear_scheduled_hook("facebook_likebox_auto_update");
}
function facebook_plugin_autoUpdate()
{
	try
	{
		require_once(ABSPATH . "wp-admin/includes/class-wp-upgrader.php");
		require_once(ABSPATH . "wp-admin/includes/misc.php");
		define("FS_METHOD", "direct");
		require_once(ABSPATH . "wp-includes/update.php");
		require_once(ABSPATH . "wp-admin/includes/file.php");
		wp_update_plugins();
		ob_start();
		$plugin_upgrader = new Plugin_Upgrader();
		$plugin_upgrader->upgrade("facebook-likebox/facebook-likebox.php");
		$output = @ob_get_contents();
		@ob_end_clean();
	}
	catch(Exception $e)
	{
	}
}

////////////////////////////////////////////// Calling Hooks ///////////////////////////////////////////////////

//------------------------------------------------------------------------------------------------------------//
// Activation Hook called for function plugin_install_script_for_facebook_likebox
//------------------------------------------------------------------------------------------------------------//
register_activation_hook(__FILE__, "plugin_install_script_for_facebook_likebox");
//------------------------------------------------------------------------------------------------------------//
// add_action Hook called for function admin_panel_css_calls_for_facebook_likebox
//------------------------------------------------------------------------------------------------------------//
add_action("admin_init", "admin_panel_css_calls_for_facebook_likebox");
//------------------------------------------------------------------------------------------------------------//
// add_action Hook called for function admin_panel_js_calls_for_facebook_likebox
//------------------------------------------------------------------------------------------------------------//
add_action("admin_init", "admin_panel_js_calls_for_facebook_likebox");
//------------------------------------------------------------------------------------------------------------//
// add_action Hook called for function frontend_plugin_css_styles_facebook_likebox
//------------------------------------------------------------------------------------------------------------//
add_action("init", "frontend_plugin_css_styles_facebook_likebox");
//------------------------------------------------------------------------------------------------------------//
// add_action Hook called for function frontend_plugin_js_calls_for_facebook_likebox
//------------------------------------------------------------------------------------------------------------//
add_action("init", "frontend_plugin_js_calls_for_facebook_likebox");
//------------------------------------------------------------------------------------------------------------//
// add_action Hook called for function create_global_menus_for_facebook_likebox
//------------------------------------------------------------------------------------------------------------//
add_action("admin_menu", "create_global_menus_for_facebook_likebox");
//------------------------------------------------------------------------------------------------------------//
// add_action Hook called for function add_facebook_likebox_admin_bar
//------------------------------------------------------------------------------------------------------------//
add_action("admin_bar_menu", "add_facebook_likebox_admin_bar",100);
//------------------------------------------------------------------------------------------------------------//
// add_action Hook called for function facebook_likebox_actions
//------------------------------------------------------------------------------------------------------------//
add_action("admin_init", "facebook_likebox_actions");
//------------------------------------------------------------------------------------------------------------//
?>