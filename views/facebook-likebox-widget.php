<?php
$instance = wp_parse_args((array) $instance, array( "title" => "", "fbl_language" => "en_US", "display_type" => "", "facebook_page_id" => "", "facebook_page_url" => "http://www.facebook.com/techbanker", "connections" => "6", "width" => "300", "height" => "300", "border_color" => "000000", "streams" => "", "color_scheme" => "", "show_faces_like_box" => "",
		"header" => "", "button_style" => "", "button_color_scheme" => "", "show_faces_like_button" => "", "font" => ""));
$title = stripslashes($instance["title"]);
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
?>

<div class="widget_heading">
	<b><?php _e("Facebook Like Box Widget", facebook_likebox); ?></b>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("title"); ?>"><?php _e("Title :", facebook_likebox); ?></label>
	<div>
		<input id=" <?php echo $this->get_field_id("title"); ?> " name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($title); ?>" class="controls_style" />
	</div>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("fbl_language"); ?>"><?php _e("Language :", facebook_likebox); ?></label>
	<div>
		<select name="<?php echo $this->get_field_name("fbl_language"); ?>" id="<?php echo $this->get_field_id("fbl_language"); ?>" class="controls_style" >
			<option value="af_ZA" <?php if($fbl_language == "af_ZA") echo "selected=yes"; ?> ><?php _e("Afrikaans", facebook_likebox); ?></option>
			<option value="ar_AR" <?php if($fbl_language == "ar_AR") echo "selected=yes"; ?> ><?php _e("Arabic", facebook_likebox); ?></option>
			<option value="az_AZ" <?php if($fbl_language == "az_AZ") echo "selected=yes"; ?> ><?php _e("Azeri", facebook_likebox); ?></option>
			<option value="be_BY" <?php if($fbl_language == "be_BY") echo "selected=yes"; ?> ><?php _e("Belarusian", facebook_likebox); ?></option>
			<option value="bg_BG" <?php if($fbl_language == "bg_BG") echo "selected=yes"; ?> ><?php _e("Bulgarian", facebook_likebox); ?></option>
			<option value="bn_IN" <?php if($fbl_language == "bn_IN") echo "selected=yes"; ?> ><?php _e("Bengali", facebook_likebox); ?></option>
			<option value="bs_BA" <?php if($fbl_language == "bs_BA") echo "selected=yes"; ?> ><?php _e("Bosnian", facebook_likebox); ?></option>
			<option value="ca_ES" <?php if($fbl_language == "ca_ES") echo "selected=yes"; ?> ><?php _e("Catalan", facebook_likebox); ?></option>
			<option value="cs_CZ" <?php if($fbl_language == "cs_CZ") echo "selected=yes"; ?> ><?php _e("Czech", facebook_likebox); ?></option>
			<option value="cy_GB" <?php if($fbl_language == "cy_GB") echo "selected=yes"; ?> ><?php _e("Welsh", facebook_likebox); ?></option>
			<option value="da_DK" <?php if($fbl_language == "da_DK") echo "selected=yes"; ?> ><?php _e("Danish", facebook_likebox); ?></option>
			<option value="de_DE" <?php if($fbl_language == "de_DE") echo "selected=yes"; ?> ><?php _e("German", facebook_likebox); ?></option>
			<option value="el_GR" <?php if($fbl_language == "el_GR") echo "selected=yes"; ?> ><?php _e("Greek", facebook_likebox); ?></option>
			<option value="en_US" <?php if($fbl_language == "en_US") echo "selected=yes"; ?> ><?php _e("English (US)", facebook_likebox); ?></option>
			<option value="en_GB" <?php if($fbl_language == "en_GB") echo "selected=yes"; ?> ><?php _e("English (UK)", facebook_likebox); ?></option>
			<option value="eo_EO" <?php if($fbl_language == "eo_EO") echo "selected=yes"; ?> ><?php _e("Esperanto", facebook_likebox); ?></option>
			<option value="es_ES" <?php if($fbl_language == "es_ES") echo "selected=yes"; ?> ><?php _e("Spanish (Spain)", facebook_likebox); ?></option>
			<option value="es_LA" <?php if($fbl_language == "es_LA") echo "selected=yes"; ?> ><?php _e("Spanish", facebook_likebox); ?></option>
			<option value="et_EE" <?php if($fbl_language == "et_EE") echo "selected=yes"; ?> ><?php _e("Estonian", facebook_likebox); ?></option>
			<option value="eu_ES" <?php if($fbl_language == "eu_ES") echo "selected=yes"; ?> ><?php _e("Basque", facebook_likebox); ?></option>
			<option value="fa_IR" <?php if($fbl_language == "fa_IR") echo "selected=yes"; ?> ><?php _e("Persian", facebook_likebox); ?></option>
			<option value="fb_LT" <?php if($fbl_language == "fb_LT") echo "selected=yes"; ?> ><?php _e("Leet Speak", facebook_likebox); ?></option>
			<option value="fi_FI" <?php if($fbl_language == "fi_FI") echo "selected=yes"; ?> ><?php _e("Finnish", facebook_likebox); ?></option>
			<option value="fo_FO" <?php if($fbl_language == "fo_FO") echo "selected=yes"; ?> ><?php _e("Faroese", facebook_likebox); ?></option>
			<option value="fr_FR" <?php if($fbl_language == "fr_FR") echo "selected=yes"; ?> ><?php _e("French (France)", facebook_likebox); ?></option>
			<option value="fr_CA" <?php if($fbl_language == "fr_CA") echo "selected=yes"; ?> ><?php _e("French (Canada)", facebook_likebox); ?></option>
			<option value="fy_NL" <?php if($fbl_language == "fy_NL") echo "selected=yes"; ?> ><?php _e("Netherlands (NL)", facebook_likebox); ?></option>
			<option value="ga_IE" <?php if($fbl_language == "ga_IE") echo "selected=yes"; ?> ><?php _e("Irish", facebook_likebox); ?></option>
			<option value="gl_ES" <?php if($fbl_language == "gl_ES") echo "selected=yes"; ?> ><?php _e("Galician", facebook_likebox); ?></option>
			<option value="hi_IN" <?php if($fbl_language == "hi_IN") echo "selected=yes"; ?> ><?php _e("Hindi", facebook_likebox); ?></option>
			<option value="hr_HR" <?php if($fbl_language == "hr_HR") echo "selected=yes"; ?> ><?php _e("Croatian", facebook_likebox); ?></option>
			<option value="hu_HU" <?php if($fbl_language == "hu_HU") echo "selected=yes"; ?> ><?php _e("Hungarian", facebook_likebox); ?></option>
			<option value="hy_AM" <?php if($fbl_language == "hy_AM") echo "selected=yes"; ?> ><?php _e("Armenian", facebook_likebox); ?></option>
			<option value="id_ID" <?php if($fbl_language == "id_ID") echo "selected=yes"; ?> ><?php _e("Indonesian", facebook_likebox); ?></option>
			<option value="is_IS" <?php if($fbl_language == "is_IS") echo "selected=yes"; ?> ><?php _e("Icelandic", facebook_likebox); ?></option>
			<option value="it_IT" <?php if($fbl_language == "it_IT") echo "selected=yes"; ?> ><?php _e("Italian", facebook_likebox); ?></option>
			<option value="ja_JP" <?php if($fbl_language == "ja_JP") echo "selected=yes"; ?> ><?php _e("Japanese", facebook_likebox); ?></option>
			<option value="ka_GE" <?php if($fbl_language == "ka_GE") echo "selected=yes"; ?> ><?php _e("Georgian", facebook_likebox); ?></option>
			<option value="km_KH" <?php if($fbl_language == "km_KH") echo "selected=yes"; ?> ><?php _e("Khmer", facebook_likebox); ?></option>
			<option value="ko_KR" <?php if($fbl_language == "ko_KR") echo "selected=yes"; ?> ><?php _e("Korean", facebook_likebox); ?></option>
			<option value="ku_TR" <?php if($fbl_language == "ku_TR") echo "selected=yes"; ?> ><?php _e("Kurdish", facebook_likebox); ?></option>
			<option value="la_VA" <?php if($fbl_language == "la_VA") echo "selected=yes"; ?> ><?php _e("Latin", facebook_likebox); ?></option>
			<option value="lt_LT" <?php if($fbl_language == "lt_LT") echo "selected=yes"; ?> ><?php _e("Lithuanian", facebook_likebox); ?></option>
			<option value="lv_LV" <?php if($fbl_language == "lv_LV") echo "selected=yes"; ?> ><?php _e("Latvian", facebook_likebox); ?></option>
			<option value="mk_MK" <?php if($fbl_language == "mk_MK") echo "selected=yes"; ?> ><?php _e("Macedonian", facebook_likebox); ?></option>
			<option value="ml_IN" <?php if($fbl_language == "ml_IN") echo "selected=yes"; ?> ><?php _e("Malayalam", facebook_likebox); ?></option>
			<option value="ms_MY" <?php if($fbl_language == "ms_MY") echo "selected=yes"; ?> ><?php _e("Malay", facebook_likebox); ?></option>
			<option value="nb_NO" <?php if($fbl_language == "nb_NO") echo "selected=yes"; ?> ><?php _e("Norwegian (bokmal)", facebook_likebox); ?></option>
			<option value="ne_NP" <?php if($fbl_language == "ne_NP") echo "selected=yes"; ?> ><?php _e("Nepali", facebook_likebox); ?></option>
			<option value="nl_NL" <?php if($fbl_language == "nl_NL") echo "selected=yes"; ?> ><?php _e("Dutch", facebook_likebox); ?></option>
			<option value="nn_NO" <?php if($fbl_language == "nn_NO") echo "selected=yes"; ?> ><?php _e("Norwegian (nynorsk)", facebook_likebox); ?></option>
			<option value="pa_IN" <?php if($fbl_language == "pa_IN") echo "selected=yes"; ?> ><?php _e("Punjabi", facebook_likebox); ?></option>
			<option value="pl_PL" <?php if($fbl_language == "pl_PL") echo "selected=yes"; ?> ><?php _e("Polish", facebook_likebox); ?></option>
			<option value="ps_AF" <?php if($fbl_language == "ps_AF") echo "selected=yes"; ?> ><?php _e("Pashto", facebook_likebox); ?></option>
			<option value="pt_PT" <?php if($fbl_language == "pt_PT") echo "selected=yes"; ?> ><?php _e("Portuguese (Portugal)", facebook_likebox); ?></option>
			<option value="pt_BR" <?php if($fbl_language == "pt_BR") echo "selected=yes"; ?> ><?php _e("Portuguese (Brazil)", facebook_likebox); ?></option>
			<option value="ro_RO" <?php if($fbl_language == "ro_RO") echo "selected=yes"; ?> ><?php _e("Romanian", facebook_likebox); ?></option>
			<option value="ru_RU" <?php if($fbl_language == "ru_RU") echo "selected=yes"; ?> ><?php _e("Russian", facebook_likebox); ?></option>
			<option value="sk_SK" <?php if($fbl_language == "sk_SK") echo "selected=yes"; ?> ><?php _e("Slovak", facebook_likebox); ?></option>
			<option value="sl_SI" <?php if($fbl_language == "sl_SI") echo "selected=yes"; ?> ><?php _e("Slovenian", facebook_likebox); ?></option>
			<option value="sq_AL" <?php if($fbl_language == "sq_AL") echo "selected=yes"; ?> ><?php _e("Albanian", facebook_likebox); ?></option>
			<option value="sr_RS" <?php if($fbl_language == "sr_RS") echo "selected=yes"; ?> ><?php _e("Serbian", facebook_likebox); ?></option>
			<option value="sv_SE" <?php if($fbl_language == "sv_SE") echo "selected=yes"; ?> ><?php _e("Swedish", facebook_likebox); ?></option>
			<option value="sw_KE" <?php if($fbl_language == "sw_KE") echo "selected=yes"; ?> ><?php _e("Swahili", facebook_likebox); ?></option>
			<option value="ta_IN" <?php if($fbl_language == "ta_IN") echo "selected=yes"; ?> ><?php _e("Tamil", facebook_likebox); ?></option>
			<option value="te_IN" <?php if($fbl_language == "te_IN") echo "selected=yes"; ?> ><?php _e("Telugu", facebook_likebox); ?></option>
			<option value="th_TH" <?php if($fbl_language == "th_TH") echo "selected=yes"; ?> ><?php _e("Thai", facebook_likebox); ?></option>
			<option value="tl_PH" <?php if($fbl_language == "tl_PH") echo "selected=yes"; ?> ><?php _e("Filipino", facebook_likebox); ?></option>
			<option value="tr_TR" <?php if($fbl_language == "tr_TR") echo "selected=yes"; ?> ><?php _e("Turkish", facebook_likebox); ?></option>
			<option value="uk_UA" <?php if($fbl_language == "uk_UA") echo "selected=yes"; ?> ><?php _e("Ukrainian", facebook_likebox); ?></option>
			<option value="ur_PK" <?php if($fbl_language == "ur_PK") echo "selected=yes"; ?> ><?php _e("Urdu", facebook_likebox); ?></option>
			<option value="vi_VN" <?php if($fbl_language == "vi_VN") echo "selected=yes"; ?> ><?php _e("Vietnamese", facebook_likebox); ?></option>
			<option value="zh_CN" <?php if($fbl_language == "zh_CN") echo "selected=yes"; ?> ><?php _e("Simplified Chinese (China)", facebook_likebox); ?></option>
			<option value="zh_HK" <?php if($fbl_language == "zh_HK") echo "selected=yes"; ?> ><?php _e("Traditional Chinese (Hong Kong)", facebook_likebox); ?></option>
			<option value="zh_TW" <?php if($fbl_language == "zh_TW") echo "selected=yes"; ?> ><?php _e("Traditional Chinese (Taiwan)", facebook_likebox); ?></option>
		</select>
	</div>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("display_type"); ?>"><?php _e("Display Type :", facebook_likebox); ?></label>
	<div>
		<select name="<?php echo $this->get_field_name("display_type"); ?>" id="<?php echo $this->get_field_id("display_type"); ?>" >
			<option value="like box" <?php if($display_type == "like box") echo "selected=yes"; ?> ><?php _e("Like Box", facebook_likebox); ?></option>
			<option value="like button" <?php if($display_type == "like button") echo "selected=yes"; ?> ><?php _e("Like Button", facebook_likebox); ?></option>
			<option value="like box button" <?php if($display_type == "like box button") echo "selected=yes"; ?> ><?php _e("Like Box & Button", facebook_likebox); ?></option>
		</select>
	</div>
</div>

<hr/>
<div class="widget_heading">
	<b><?php _e("Like Box Settings", facebook_likebox); ?></b>
</div>
<div class="widget_heading">
	<i><?php _e("Fill Page ID Or Page URL below:", facebook_likebox); ?></i>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("facebook_page_id"); ?>"><?php _e("Facebook Page Id :", facebook_likebox); ?></label>
	<div>
		<input class="controls_style" id=" <?php echo $this->get_field_id("facebook_page_id"); ?> " name="<?php echo $this->get_field_name("facebook_page_id"); ?>" type="text" value="<?php echo esc_attr($facebook_page_id); ?>" />
	</div>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("facebook_page_url"); ?>"><?php _e("Facebook Page Url :", facebook_likebox); ?></label>
	<div>
		<input class="controls_style" id=" <?php echo $this->get_field_id("facebook_page_url"); ?> " name="<?php echo $this->get_field_name("facebook_page_url"); ?>" type="text" value="<?php echo esc_attr($facebook_page_url); ?>" />
	</div>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("connections"); ?>"><?php _e("Connections :", facebook_likebox); ?></label>
	<div>
		<input class="controls_style" id=" <?php echo $this->get_field_id("connections"); ?> " name="<?php echo $this->get_field_name("connections"); ?>" type="text" value="<?php echo esc_attr($connections); ?>" />
	</div>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("width"); ?>"><?php _e("Width :", facebook_likebox); ?></label>
	<div>
		<input class="controls_style" id=" <?php echo $this->get_field_id("width"); ?> " name="<?php echo $this->get_field_name("width"); ?>" type="text" value="<?php echo esc_attr($width); ?>" />
	</div>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("height"); ?>"><?php _e("Height :", facebook_likebox); ?></label>
	<div>
		<input class="controls_style" id=" <?php echo $this->get_field_id("height"); ?> " name="<?php echo $this->get_field_name("height"); ?>" type="text" value="<?php echo esc_attr($height); ?>" />
	</div>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("border_color"); ?>"><?php _e("Border Color :", facebook_likebox); ?></label>
	<div>
		<input class="controls_style" id=" <?php echo $this->get_field_id("border_color"); ?> " name="<?php echo $this->get_field_name("border_color"); ?>" type="text" value="<?php echo esc_attr($border_color); ?>" />
	</div>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("streams"); ?>"><?php _e("Streams :", facebook_likebox); ?></label>
	<div>
		<select name="<?php echo $this->get_field_name("streams"); ?>" id="<?php echo $this->get_field_id("streams"); ?>" >
			<option value="yes" <?php if($streams == "yes") echo "selected=yes"; ?> ><?php _e("Yes", facebook_likebox); ?></option>
			<option value="no" <?php if($streams == "no") echo "selected=yes"; ?> ><?php _e("No", facebook_likebox); ?></option>
		</select>
	</div>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("color_scheme"); ?>"><?php _e("Color Scheme :", facebook_likebox); ?></label>
	<div>
		<select name="<?php echo $this->get_field_name("color_scheme"); ?>" id="<?php echo $this->get_field_id("color_scheme"); ?>" >
			<option value="light" <?php if($color_scheme == "light") echo "selected=yes"; ?> ><?php _e("Light", facebook_likebox); ?></option>
			<option value="dark" <?php if($color_scheme == "dark") echo "selected=yes"; ?> ><?php _e("Dark", facebook_likebox); ?></option>
		</select>
	</div>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("show_faces_like_box"); ?>"><?php _e("Show Faces :", facebook_likebox); ?></label>
	<div>
		<select name="<?php echo $this->get_field_name("show_faces_like_box"); ?>" id="<?php echo $this->get_field_id("show_faces_like_box"); ?>" >
			<option value="yes" <?php if($show_faces_like_box == "yes") echo "selected=yes"; ?> ><?php _e("Yes", facebook_likebox); ?></option>
			<option value="no" <?php if($show_faces_like_box == "no") echo "selected=yes"; ?> ><?php _e("No", facebook_likebox); ?></option>
		</select>
	</div>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("header"); ?>"><?php _e("Header :", facebook_likebox); ?></label>
	<div>
		<select name="<?php echo $this->get_field_name("header"); ?>" id="<?php echo $this->get_field_id("header"); ?>" >
			<option value="yes" <?php if($header == "yes") echo "selected=yes"; ?> ><?php _e("Yes", facebook_likebox); ?></option>
			<option value="no" <?php if($header == "no") echo "selected=yes"; ?> ><?php _e("No", facebook_likebox); ?></option>
		</select>
	</div>
</div>

<hr/>
<div class="widget_heading">
	<b><?php _e("Like Button Setting", facebook_likebox); ?></b>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("button_style"); ?>"><?php _e("Button Style :", facebook_likebox); ?></label>
	<div>
		<select name="<?php echo $this->get_field_name("button_style"); ?>" id="<?php echo $this->get_field_id("button_style"); ?>" >
			<option value="standard" <?php if($button_style == "standard") echo "selected=yes"; ?> ><?php _e("Standard", facebook_likebox); ?></option>
			<option value="button_count" <?php if($button_style == "button_count") echo "selected=yes"; ?> ><?php _e("Button Count", facebook_likebox); ?></option>
			<option value="box_count" <?php if($button_style == "box_count") echo "selected=yes"; ?> ><?php _e("Box Count", facebook_likebox); ?></option>
		</select>
	</div>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("button_color_scheme"); ?>"><?php _e("Button Color Scheme :", facebook_likebox); ?></label>
	<div>
		<select name="<?php echo $this->get_field_name("button_color_scheme"); ?>" id="<?php echo $this->get_field_id("button_color_scheme"); ?>" >
			<option value="light" <?php if($button_color_scheme == "light") echo "selected=yes"; ?> ><?php _e("Light", facebook_likebox); ?></option>
			<option value="dark" <?php if($button_color_scheme == "dark") echo "selected=yes"; ?> ><?php _e("Dark", facebook_likebox); ?></option>
		</select>
	</div>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("show_faces_like_button"); ?>"><?php _e("Show Faces :", facebook_likebox); ?></label>
	<div>
		<select name="<?php echo $this->get_field_name("show_faces_like_button"); ?>" id="<?php echo $this->get_field_id("show_faces_like_button"); ?>" >
			<option value="yes" <?php if($show_faces_like_button == "yes") echo "selected=yes"; ?> ><?php _e("Yes", facebook_likebox); ?></option>
			<option value="no" <?php if($show_faces_like_button == "no") echo "selected=yes"; ?> ><?php _e("No", facebook_likebox); ?></option>
		</select>
	</div>
</div>
<div class="frontend-control-group">
	<label class="frontend-label" for="<?php echo $this->get_field_id("font"); ?>"><?php _e("Font :", facebook_likebox); ?></label>
	<div>
		<select name="<?php echo $this->get_field_name("font"); ?>" id="<?php echo $this->get_field_id("font"); ?>">
			<option value="arial" <?php if($font == "arial") echo "selected=yes"; ?> ><?php _e("Arial", facebook_likebox); ?></option>
			<option value="lucida grande" <?php if($font == "lucida grande") echo "selected=yes"; ?> ><?php _e("Lucida Grande", facebook_likebox); ?></option>
			<option value="segoe ui" <?php if($font == "segoe ui") echo "selected=yes"; ?> ><?php _e("Segoe ui", facebook_likebox); ?></option>
			<option value="tahoma" <?php if($font == "tahoma") echo "selected=yes"; ?> ><?php _e("Tahoma", facebook_likebox); ?></option>
			<option value="trebuchet ms" <?php if($font == "trebuchet ms") echo "selected=yes"; ?> ><?php _e("Trebuchet ms", facebook_likebox); ?></option>
			<option value="verdana" <?php if($font == "verdana") echo "selected=yes"; ?> ><?php _e("Verdana", facebook_likebox); ?></option>
		</select>
	</div>
</div>