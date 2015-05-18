<?php 
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
		js.src = "//connect.facebook.net/<?php echo $language; ?>/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}
	(document, "script", "facebook-jssdk"));
</script>

<?php
switch ($display_type)
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
		
		$result.= "<div class=fb-like-box data-href=".$facebook_page_url." data-colorscheme=".$color_scheme." data-width=".$width." data-height=".$height." data-show-faces=".$show_faces_like_box." data-header=".$header." data-stream=".$streams." data-display-type=".$display_type." connections=".$connections." data-border-color=".$border_color."></div>";
		echo $result;
	break;
	case "like button":
		?>
		<div class="fb-like" data-send="true" data-href="<?php echo $facebook_page_url; ?>" data-layout="<?php echo $button_style; ?>" data-colorscheme="<?php echo $button_color_scheme; ?>" data-show-faces="<?php echo $show_faces_like_button; ?>" style="font:<?php echo $font; ?>" data-action="like" data-share="<?php echo $share_button; ?>" style="margin-bottom: 15px;"></div>
		<?php
	break;
	case "like box button":
		?>
		<div class="fb-like" data-send="true" data-href="<?php echo $facebook_page_url; ?>" data-colorscheme="<?php echo $button_color_scheme; ?>" data-layout="<?php echo $button_style; ?>" data-show-faces="<?php echo $show_faces_like_button; ?>" style="font:<?php echo $font; ?>" data-action="like" data-share="<?php echo $share_button; ?>" style="margin-bottom: 15px;"></div>
		<?php
		$result = "<div id=fb-root></div>
			<script>(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = //connect.facebook.net/en_US/sdk.js;
			fjs.parentNode.insertBefore(js, fjs);
			}(document, script, facebook-jssdk));</script>";
		
		$result.= "<div class=fb-like-box data-href=".$facebook_page_url." data-colorscheme=".$color_scheme." data-width=".$width." data-height=".$height." data-show-faces=".$show_faces_like_box." data-header=".$header." data-stream=".$streams." data-display-type=".$display_type." connections=".$connections." border-color=".$border_color."></div>";
		echo $result;
	break;
}
?>