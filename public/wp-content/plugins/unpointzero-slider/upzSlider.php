<?php

/*

Plugin Name: UnPointZero content Slider

Plugin URI: http://www.unpointzero.com/unpointzero-slider/

Description: A customizable slider for your featured content by UnPointZero WebAgency

Version: 3.4.4

Author: Jordan Matejicek - UnPointZero

Author URI: http://www.UnPointZero.com

*/

// Add thumb support
if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' ); 
}

// Installation
register_activation_hook( __FILE__, 'upzSlider_activate' );

function upzSlider_activate() {

	$default_options = array(
		"slider-type" => 1,
		"slider-nameorid" => 0,
		"slider-fetch" => 10,
		"slider-view-number" => 4,
		"slider-title-max-char" => 50,
		"slider-title-thumb-max-char" => 50,
		"slider-desc-max-char" => 150,
		"slider-bigthumb-x" => 419,
		"slider-bigthumb-y" => 248,
		"slider-smallthumb-x" => 85,
		"slider-smallthumb-y" => 50,
		"slider-display-thumb" => 1,
		"slider-display-title" => 1,
		"slider-display-desc" => 1,
		"slider-mouseover-action" => 0,
		"slider-nonlatin" => 0,
		"slider-transitioneffect" => "fade",
		"slider-transitiontimeout" => "13000",
		"slider-transitionspeed" => "6000",
		"slider-contentexrpt" => "0",
		"slider-auto-resize-active" => true,
		"slider-style-width" => 627,
		"slider-disable-links" => false,
		"slider-linksonthumb" => false,
		"slider-customthumb-metaname" => "",
		"slider-customthumb-mini-metaname" => "",
		"slider-customorderby" => "",
		"slider-parallax-enable" => false
	);

	add_option("upzslider_options", $default_options, '', 'yes');
	
}

// Add size for WP admin ( v 1.3 )
function add_upz_thumb() {
$options = get_option('upzslider_options');
$slider_bigthumb_x = $options['slider-bigthumb-x'];
$slider_bigthumb_y = $options['slider-bigthumb-y'];
$slider_smallthumb_x = $options['slider-smallthumb-x'];
$slider_smallthumb_y = $options['slider-smallthumb-y'];
		
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'upz-big', $slider_bigthumb_x, $slider_bigthumb_y,true );
	add_image_size( 'upz-small', $slider_smallthumb_x, $slider_smallthumb_y,true );
}
}


/* Ajout de la page d'options dans l'administration Wordpress */

function slider_options_page() {
	add_options_page('UnPointZero Content Slider Options', 'UnPointZero Slider', 'edit_plugins', 'unpointzero-slider/Options.php');
	wp_enqueue_script('tabsconfig', plugins_url() . '/unpointzero-slider/libs/admin/tabsconfig.js', array('jquery','jquery-ui-core','jquery-ui-tabs'));
	wp_enqueue_style('admin-upz-slider', plugins_url() . '/unpointzero-slider/libs/admin/style.css');
	
	//call register settings function
	add_action( 'admin_init', 'register_slidersettings' );
	
}

function update_slider_database() {
	echo "Copying current options ...";
	$oldoptions = array(
		"slider-category-id" => get_option("slider-category-id"),
		"slider-view-number" => get_option("slider-view-number"),
		"slider-title-max-char" => get_option("slider-title-max-char"),
		"slider-desc-max-char" => get_option("slider-desc-max-char"),
		"slider-bigthumb-x" => get_option("slider-bigthumb-x"),
		"slider-bigthumb-y" => get_option("slider-bigthumb-y"),
		"slider-smallthumb-x" => get_option("slider-smallthumb-x"),
		"slider-smallthumb-y" => get_option("slider-smallthumb-y"),
		"slider-type" => get_option("slider-type"),
		"slider-fetch" => get_option("slider-fetch"),
		"slider-nonlatin" => get_option("slider-nonlatin"),
		"slider-nameorid" => get_option("slider-nameorid"),
		"slider-display-title" => get_option("slider-display-title"),
		"slider-display-desc" => get_option("slider-display-desc"),
		"slider-display-thumb" => get_option("slider-display-thumb"),
		"slider-display-adv-options" => get_option("slider-display-adv-options"),
		"slider-mouseover-action" => get_option("slider-mouseover-action"),
		"slider-title-thumb-max-char" => get_option("slider-title-thumb-max-char"),
		"slider-transitioneffect" => get_option("slider-transitioneffect"),
		"slider-transitiontimeout" => get_option("slider-transitiontimeout"),
		"slider-transitionspeed" => get_option("slider-transitionspeed"),
		"slider-customslide-url-1" => get_option("slider-customslide-url-1"),
		"slider-customslide-image-1" => get_option("slider-customslide-image-1"),
		"slider-customslide-title-1" => get_option("slider-customslide-title-1"),
		"slider-customslide-desc-1" => get_option("slider-customslide-desc-1"),
		"slider-customslide-pos-1" => get_option("slider-customslide-pos-1"),
		"slider-style-width" => get_option("slider-style-width"),
		"slider-custompost-name" => get_option("slider-custompost-name"),
		"slider-custompost-taxonomyname" => get_option("slider-custompost-taxonomyname"),
		"slider-style-featured-thumbnails-margin" => get_option("slider-style-featured-thumbnails-margin"),
		"slider-style-text-thumbnails-margin" => get_option("slider-style-text-thumbnails-margin"),
		"slider-contentexrpt" => get_option("slider-contentexrpt"),
		"slider-auto-resize-active" => get_option("slider-auto-resize-active"),
		"slider-disable-links" => get_option("slider-disable-links"),
		"slider-linksonthumb" => get_option("slider-linksonthumb"),
		"slider-customthumb-metaname" => get_option("slider-customthumb-metaname"),
		"slider-customthumb-mini-metaname" => get_option("slider-customthumb-mini-metaname"),
		"slider-customorderby" => get_option("slider-customorderby")
	);
	add_option("upzslider_options", $oldoptions, '', 'yes');
	
	echo "<br />Deleting old options...";
	delete_option("slider-category-id");
	delete_option("slider-view-number");
	delete_option("slider-title-max-char");
	delete_option("slider-desc-max-char");
	delete_option("slider-bigthumb-x");
	delete_option("slider-bigthumb-y");
	delete_option("slider-smallthumb-x");
	delete_option("slider-smallthumb-y");
	delete_option("slider-type");
	delete_option("slider-fetch");
	delete_option("slider-nonlatin");
	delete_option("slider-nameorid");
	delete_option("slider-display-title");
	delete_option("slider-display-desc");
	delete_option("slider-display-thumb");
	delete_option("slider-display-adv-options");
	delete_option("slider-mouseover-action");
	delete_option("slider-title-thumb-max-char");
	delete_option("slider-transitioneffect");
	delete_option("slider-transitiontimeout");
	delete_option("slider-transitionspeed");
	delete_option("slider-customslide-url-1");
	delete_option("slider-customslide-image-1");
	delete_option("slider-customslide-title-1");
	delete_option("slider-customslide-desc-1");
	delete_option("slider-customslide-pos-1");
	delete_option("slider-style-width");
	delete_option("slider-custompost-name");
	delete_option("slider-custompost-taxonomyname");
	delete_option("slider-style-text-thumbnails-margin");
	delete_option("slider-style-featured-thumbnails-margin");
	delete_option("slider-contentexrpt");
	delete_option("slider-auto-resize-active");
	delete_option("slider-disable-links");
	delete_option("slider-linksonthumb");
	delete_option("slider-customthumb-metaname");
	delete_option("slider-customthumb-mini-metaname");
	delete_option("slider-customorderby");
	echo "Done.";
}


function register_slidersettings() {
	register_setting( 'upzslider_options', 'upzslider_options' );
}

/* Code necessaire au header du site pour bon fonctionnement du plugin */

function script_load() {
	$options = get_option('upzslider_options');
	
	if($options['slider-display-thumb']==true) {
	wp_enqueue_script('jquery-cycle', plugins_url() . '/unpointzero-slider/libs/jquery.cycle.all.min.js', array('jquery'));
	wp_enqueue_script('cycle-nav', plugins_url() . '/unpointzero-slider/libs/slidercfg.js', array('jquery'));	
		if(($options['slider-mouseover-action']==true) && ($options['slider-display-thumb']==true)) {
			wp_enqueue_script('upz-slider-mouseoveraction', plugins_url() . '/unpointzero-slider/libs/slider-mouseover.js', array('jquery'));
		}
	}
	else {
	wp_enqueue_script('jquery-cycle', plugins_url() . '/unpointzero-slider/libs/jquery.cycle.all.min.js', array('jquery'));
		if($options['slider-display-adv-options']==1 || $options['slider-display-adv-options']==2) {
		wp_enqueue_script('cycle-nav', plugins_url() . '/unpointzero-slider/libs/cycle-nav.js', array('jquery'));
		}
		elseif(get_option('slider-display-adv-options')==0) {
		wp_enqueue_script('cycle', plugins_url() . '/unpointzero-slider/libs/cycle.js', array('jquery'));
		}
		else {
		wp_enqueue_script('cycle', plugins_url() . '/unpointzero-slider/libs/cycle.js', array('jquery'));
		}
	}
}

function slider_styles() {
	$options = get_option('upzslider_options');
	
	if($options['slider-display-thumb']==true) {
	
		if (file_exists( get_template_directory() . '/upzslider-style.css')){
		wp_register_style("upz-slider-thumbs", get_template_directory_uri().'/upzslider-style.css');
		}else{
			wp_register_style("upz-slider-thumbs", plugins_url( 'css/slider.css', __FILE__ ));
		}
		wp_enqueue_style("upz-slider-thumbs");
	
	}
	else {
		
		if (file_exists( get_template_directory() . '/upzslider-style.css')){
		wp_register_style("upz-slider-nothumbs", get_template_directory_uri().'/upzslider-style.css');
		}else{
			wp_register_style("upz-slider-nothumbs", plugins_url( 'css/slider-cycle.css', __FILE__ ));
		}
		wp_enqueue_style("upz-slider-nothumbs");
	
	}
	
	$fx = $options['slider-transitioneffect'];
	$timeout = $options['slider-transitiontimeout'];
	$transitionspeed = $options['slider-transitionspeed'];
	
	echo "<script type=\"text/javascript\">
		fx = \"$fx\";
		timeout = \"$timeout\";
		transitionspeed = \"$transitionspeed\";
		</script>";

	// AUTO RESIZING CSS STYLES
	if($options['slider-auto-resize-active']==true) {
		if($options['slider-display-thumb']==true) {
		$featured_width = $options['slider-style-width']."px";
		$featured_height = $options['slider-bigthumb-y']."px";
		$info_width = $options['slider-bigthumb-x']."px";
		$nav_width = $options['slider-style-width']-$options['slider-bigthumb-x']."px";
		$nav_txt_width = ($options['slider-style-width']-$options['slider-bigthumb-x']-$options['slider-smallthumb-x']-$options['slider-style-text-thumbnails-margin']-$options['slider-style-featured-thumbnails-margin'])."px";
		$thumb_left_margin = $options['slider-style-featured-thumbnails-margin']."px";
		$thumb_right_margin = $options['slider-style-text-thumbnails-margin']."px";
		$navigationitem_height = floor(($options['slider-bigthumb-y'])/($options['slider-view-number']))."px";
		$thumb_top_margin = floor(($navigationitem_height-$options['slider-smallthumb-y'])/2)."px";

		echo "
		<style type=\"text/css\">
		#featured.upzslider { width: $featured_width !important; height:$featured_height !important; }
		#featured.upzslider ul#upz-slideshow-navigation { width:$nav_width !important; }
		#featured.upzslider ul#upz-slideshow-navigation li { height:$navigationitem_height !important; }
		#featured.upzslider ul#upz-slideshow-navigation li span { width:$nav_txt_width !important; }
		#featured.upzslider .info { width:$info_width !important; }
		#featured.upzslider ul#upz-slideshow-navigation li img.attachment-upz-small { margin:$thumb_top_margin $thumb_right_margin 0 $thumb_left_margin !important; }
		</style>";
		}
		else {
		$featured_width = $options['slider-bigthumb-x']."px";
		$featured_height = $options['slider-bigthumb-y']."px";
		$arrow_nav_bottom_position = (($featured_height/2)-25)."px";
		echo "<style type=\"text/css\">
		#featured.upzslider { width: $featured_width !important; height:$featured_height !important; }
		#featured-navi.upzslider a span#previousslide,#featured-navi a span#nextslide { bottom:$arrow_nav_bottom_position !important; }";
		echo ".upzslider>div.fragment-slide { height:$featured_height !important; width:$featured_width !important; }";
		echo "</style>";
		}
	}
	
	if($options['slider-parallax-enable']==true) {
	?>
		<style type="text/css">
			#featured_parallax.upzslider { width: <?php echo $featured_width; ?> !important; height:<?php echo $featured_height; ?> !important; }
		</style>
		<script type="text/javascript">
			jQuery(function ($) {
				$(document).ready(function(){
				$('#featured_parallax.upzslider') 
				.cycle({
						fx: 'custom',
						cssBefore: {
						top: <?php echo $options['slider-parallax-initialpositiony'] ?>,
						left: <?php echo $options['slider-parallax-initialpositionx']; ?>,
						width: <?php echo $options['slider-parallax-containerwidth']; ?>,
						opacity: 0,
						display: 'block'
						},
						animIn: {
						top: <?php echo $options['slider-parallax-stoppositiony']; ?>,
						left: <?php echo $options['slider-parallax-stoppositionx']; ?>,
						opacity: 1
						},
						animOut: {
						opacity: 0,
						top: <?php echo $options['slider-parallax-endpositiony']; ?>,
						left: <?php echo $options['slider-parallax-endpositionx']; ?>
						},
						cssAfter: {
						zIndex: 0
						},
						speed: <?php echo $transitionspeed; ?>,
						timeout: <?php echo $timeout; ?>,
						sync: false
				});
                                jQuery(function ($) {
                                    $('#nav-featured.upzslider a').click(function(){
                                        var thumbIndex = $(this).closest('#nav-featured.upzslider').find('a').index(jQuery(this));            
                                        $('#featured_parallax.upzslider').cycle(thumbIndex);
                                    });
                                });
                                
				$('.featured_parallax_container').css("top", "<?php echo $options['slider-parallax-stoppositiony']; ?>px");
				$('.featured_parallax_container').css("left", "<?php echo $options['slider-parallax-stoppositionx']; ?>px");
				});
			});
		</script>
	<?php
	}
	
}

function tronc_str($str,$limit) {
$pattern = '(?<=^|>)[^><]+?(?=<|$)';
if (((strlen($str) > $limit) || ($limit==NULL)) && (is_numeric($limit))) { 
				$content = preg_replace("#\[.*?\]#", "", $str);
				$content = strip_tags($content,'<p>');

				if(get_option('slider-nonlatin')==0 || get_option('slider-nonlatin')==NULL) {
				$content = substr($content, 0, $limit);
				$position_espace = strrpos($content, " "); 
				$content = substr($content, 0, $position_espace); 
				}
				else
				{
				$content = mb_substr($content, 0, $limit); 		
				}
				$content = $content."...";
				}
				
				else {
				$content = $str;
				$content = strip_tags($content,'<p>');
				}
				
return $content;
}


function slider_getinfo_by_cat($category,$number,$fetch,$slider_title_max_char,$slider_title_thumb_max_char,$slider_desc_max_char) {
	global $post;
	global $intername;
	global $taxonamesc;
	global $usingshort;
	$options = get_option('upzslider_options');
	$c_name = null;
	$custopost_name =null;
	if($intername!=null && $intername!="") {
		$c_name = $category;
	}
	else {
		if($options['slider-nameorid']=="1") {
			$c_name = $category;
		}
		else {
			$c_name_array = preg_split('/,/', $category);
			for($i=0;$i<sizeof($c_name_array);$i++) {
			$c_name.= get_cat_ID($c_name_array[$i]).",";
			}
		}	
	}
	
	if($intername!=null && $intername!="") {
	$slidetype = 3;
	}
	elseif($usingshort==1) {
	$slidetype = 1;
	}
	else {
	$slidetype = $options['slider-type'];
	}
	
	if($slidetype==1) {
		if($category!="" || $category!=0) {	
		$category = "&category=".$c_name;
		}

		else {
		$category = "";
		}
	}
	else {
		if($category!="" || $category!=0) {	
			if($intername!=null && $intername!="") {
			$taxoname = $taxonamesc;
			}
			else {
			$taxoname = $options['slider-custompost-taxonomyname'];
			}
		$category = "&".$taxoname."=\"".$c_name."\"";
		}

		else {
		$category = "";
		}
	}
	
	if($slidetype==3) {
		if($intername!=null && $intername!="") {
		$custopost_name = "&post_type=\"".$intername."\"";
		}
		else {
		$custopost_name = "&post_type=\"".$options['slider-custompost-name']."\"";
		}
	}
	
	if(($options['slider-customorderby']!=null) && $options['slider-customorderby']!="") {
		$orderby = "&meta_key=";
		$orderby .= $options['slider-customorderby'];
		$orderby .= "&orderby=meta_value&order=ASC";
	} else { $orderby = ""; }
	if($options['slider-wpml']==1) {
		$wpml = "&suppress_filters=0";
	}
	else { $wpml = ""; }
	
	$myposts = get_posts("post_status=\"publish\"&numberposts=$fetch&meta_key=_thumbnail_id$category$custopost_name$orderby$wpml");
	$postok_number = 0;
	
	$postnb = 0;
	foreach($myposts as $post) :
	$custom_meta = get_post_custom($post->ID);
		if(($options['slider-enableslider']==true)) {
			$array_url = array($options['slider-customslide-url-1'],$options['slider-customslide-url-2'],$options['slider-customslide-url-3'],$options['slider-customslide-url-4'],$options['slider-customslide-url-5']);
			$array_image = array($options['slider-customslide-image-1'],$options['slider-customslide-image-2'],$options['slider-customslide-image-3'],$options['slider-customslide-image-4'],$options['slider-customslide-image-5']);
			$array_title = array($options['slider-customslide-title-1'],$options['slider-customslide-title-2'],$options['slider-customslide-title-3'],$options['slider-customslide-title-4'],$options['slider-customslide-title-5']);
			$array_desc = array($options['slider-customslide-desc-1'],$options['slider-customslide-desc-2'],$options['slider-customslide-desc-3'],$options['slider-customslide-desc-4'],$options['slider-customslide-desc-5']);
			$array_pos = array($options['slider-customslide-pos-1'],$options['slider-customslide-pos-2'],$options['slider-customslide-pos-3'],$options['slider-customslide-pos-4'],$options['slider-customslide-pos-5']);
			for($t=0;$t<4;$t++) {
			echo $array_pos[$t];
				if($array_pos[$t]==$postnb) {
					if($array_url[$t]!="" && $array_url[$t]!=null) {
						$page_perma[] = $array_url[$t];
					}
					else {
						$page_perma[] = "#";
					}
					$page_title[] = tronc_str(__($array_title[$t]),$slider_title_max_char);
					$post_thumb_title[] = tronc_str(__($array_title[$t]),$slider_title_thumb_max_char);
					$page_content[] = tronc_str(__($array_desc[$t]),$slider_desc_max_char);
					$thumb[] = wp_get_attachment_image($array_image[$t],'upz-big');
					$thumb_mini[] = wp_get_attachment_image($array_image[$t],'upz-small');
				}
			}
		}
		
		
		$customthumbmetaname = $options['slider-customthumb-metaname'];
		
		if(($customthumbmetaname!="")&&($customthumbmetaname!=null)) {
			$meta_customthumbname = $custom_meta[$customthumbmetaname][0];
			$customthumbmetamininame = $options['slider-customthumb-mini-metaname'];
			$meta_customthumbmininame = $custom_meta[$customthumbmetamininame][0];
		}
		else {
			$meta_customthumbname = null;
		}
		if(has_post_thumbnail($post->ID) || (($meta_customthumbname!=null) && ($meta_customthumbname!=""))) {
		if($options['slider-disable-links']!=true) {
		$post_perma[] = get_permalink($post->ID);
		}
		else {
		$post_perma[] = "#";
		}
		// R�cuperation des options
		$title = "";
		
		$customtitle_meta = $options['slider-customtitle-metaname'];
		$customtitle_content = tronc_str(__($custom_meta[$customtitle_meta][0]),$slider_title_max_char);
		
		if($customtitle_content!=null && $customtitle_content!="") {
			$title = $customtitle_content;
		} else {
			$title = tronc_str(__($post->post_title),$slider_title_max_char);
		}
		$post_title[] = $title;
		
		$thumb_title = "";
		$thumb_title = tronc_str(__($post->post_title),$slider_title_thumb_max_char);
		$post_thumb_title[] = $thumb_title;

		$content = "";
		
		$customcontent_meta = $options['slider-customdescription-metaname'];
		$customcontent_content = tronc_str(__($custom_meta[$customcontent_meta][0]),$slider_desc_max_char);
		
		if($customcontent_content==null && $customcontent_content=="") {
			$post_excerpt = $options['slider-contentexrpt'];
			if($post_excerpt==1) {
			$content = tronc_str(__($post->post_excerpt),$slider_desc_max_char);
			}
			else {
			$content = tronc_str(__($post->post_content),$slider_desc_max_char);
			}
		} else {
			$content = $customcontent_content;
		}
		$post_content[] = strip_shortcodes($content);

		if(($meta_customthumbname!=null)&&($meta_customthumbname!="")) {
			$thumb[] =  $meta_customthumbname;
			$thumb_mini[] =  $meta_customthumbmininame;
		} else {
			$thumb[] =  get_the_post_thumbnail( $post->ID,'upz-big');
			$thumb_mini[] =  get_the_post_thumbnail( $post->ID,'upz-small');			
		}
		
			if(sizeof($post_title)==$number) {
			wp_reset_query();
			return array($post_perma,$post_title,$post_thumb_title,$post_content,$thumb,$thumb_mini);
			}		
			
		}
	$meta_customthumbname = null;
	$postnb = $postnb+1;
	endforeach;
	wp_reset_query();
	return array($post_perma,$post_title,$post_thumb_title,$post_content,$thumb,$thumb_mini);
}



/* R�cuperation des pages */
function slider_getpages($pages_id,$number,$slider_title_max_char,$slider_title_thumb_max_char,$slider_desc_max_char) {
	$options = get_option('upzslider_options');
	$p_name = preg_split('/,/', $pages_id);
	for($i=0;$i<$number;$i++) {
	
		if($options['slider-nameorid']=="1" && is_numeric($p_name[$i])) {
		$page = get_page($p_name[$i]);
		}
		else {
		$page = get_page_by_title($p_name[$i]);	
		}
		
		$custom_meta = get_post_custom($page->ID);
		$customthumbmetaname = $options['slider-customthumb-metaname'];
		if(($customthumbmetaname!="")&&($customthumbmetaname!=null)) {

			$meta_customthumbname = $custom_meta[$customthumbmetaname][0];
			$customthumbmetamininame = $options['slider-customthumb-mini-metaname'];
			$meta_customthumbmininame = $custom_meta[$customthumbmetamininame][0];
		}
		else {
			$meta_customthumbname = null;
		}
		
		if(($options['slider-enableslider']==true)) {
			$array_url = array($options['slider-customslide-url-1'],$options['slider-customslide-url-2'],$options['slider-customslide-url-3'],$options['slider-customslide-url-4'],$options['slider-customslide-url-5']);
			$array_image = array($options['slider-customslide-image-1'],$options['slider-customslide-image-2'],$options['slider-customslide-image-3'],$options['slider-customslide-image-4'],$options['slider-customslide-image-5']);
			$array_title = array($options['slider-customslide-title-1'],$options['slider-customslide-title-2'],$options['slider-customslide-title-3'],$options['slider-customslide-title-4'],$options['slider-customslide-title-5']);
			$array_desc = array($options['slider-customslide-desc-1'],$options['slider-customslide-desc-2'],$options['slider-customslide-desc-3'],$options['slider-customslide-desc-4'],$options['slider-customslide-desc-5']);
			$array_pos = array($options['slider-customslide-pos-1'],$options['slider-customslide-pos-2'],$options['slider-customslide-pos-3'],$options['slider-customslide-pos-4'],$options['slider-customslide-pos-5']);
			
			for($t=0;$t<4;$t++) {
				if(($array_pos[$t]==$i)&&($array_pos[$t]!=null)) {
					if($array_url[$t]!="" && $array_url[$t]!=null) {
						$page_perma[] = $array_url[$t];
					}
					else {
						$page_perma[] = "#";
					}
					$page_title[] = tronc_str(__($array_title[$t]),$slider_title_max_char);
					$post_thumb_title[] = tronc_str(__($array_title[$t]),$slider_title_thumb_max_char);
					$page_content[] = tronc_str(__($array_desc[$t]),$slider_desc_max_char);
					$thumb[] = wp_get_attachment_image($array_image[$t],'upz-big');
					$thumb_mini[] = wp_get_attachment_image($array_image[$t],'upz-small');
				}
			}
		}
		
		if(has_post_thumbnail($page->ID) || (($meta_customthumbname!=null) && ($meta_customthumbname!="")) && $page->post_status=="publish") {
			if($options['slider-disable-links']!=true) {
			$page_perma[] = get_permalink($page->ID);
			}
			else {
			$page_perma[] = "#";
			}

			$customtitle_meta = $options['slider-customtitle-metaname'];
			$customtitle_content = tronc_str(__($custom_meta[$customtitle_meta][0]),$slider_title_max_char);
			
			if($customtitle_content!=null && $customtitle_content!="") {
				$title = $customtitle_content;
			} else {
				$title = tronc_str(__($post->post_title),$slider_title_max_char);
			}
			

			$page_title[] = $title;
			
			$thumb_title = "";
			$thumb_title = tronc_str(__($page->post_title),$slider_title_thumb_max_char);
			$post_thumb_title[] = $thumb_title;
			
			$content = "";
			
			$customcontent_meta = $options['slider-customdescription-metaname'];
			$customcontent_content = tronc_str(__($custom_meta[$customcontent_meta][0]),$slider_desc_max_char);
			
			if($customcontent_content==null && $customcontent_content=="") {
				$post_excerpt = $options['slider-contentexrpt'];
				if($post_excerpt==1) {
					$content = tronc_str(__($page->post_excerpt),$slider_desc_max_char);
				}
				else {
					$content = tronc_str(__($page->post_content),$slider_desc_max_char);
				}
			} else {
				$content = $customcontent_content;
			}
			$page_content[] = strip_shortcodes($content);
			
		if(($meta_customthumbname!=null)&&($meta_customthumbname!="")) {
			$thumb[] =  $meta_customthumbname;
			$thumb_mini[] =  $meta_customthumbmininame;
		} else {
			$thumb[] =  get_the_post_thumbnail( $page->ID,'upz-big');
			$thumb_mini[] =  get_the_post_thumbnail( $page->ID,'upz-small');			
		}	
			
		}
	}
	wp_reset_query();
	
	return array($page_perma,$page_title,$post_thumb_title,$page_content,$thumb,$thumb_mini);
}

function upzslidershortcode_func($atts) {
	global $intername;
	global $taxonamesc;
	global $usingshort;
	$usingshort = 1;
	extract( shortcode_atts( array(
		'interid' => '',
		'intertype' => '',
		'taxoname' => '',
		'usingphp' => ''
	), $atts ) );
	
	if(strtolower($intertype)=="post") {
		$intertype = 1;
	}
	elseif(strtolower($intertype)=="page") {
		$intertype = 2;
	}
	elseif($intertype!=NULL && $intertype!="") {
		$intername = $intertype;
		$intertype = 3;
		$taxonamesc = $taxoname;
	}
	else {$intertype=null; $usingshort=0;}
	ob_start();
	include(WP_CONTENT_DIR .'/plugins/unpointzero-slider/Slider.php');
	$output_string = ob_get_contents();
	ob_end_clean();
	if($usingphp==true) {
	echo $output_string;
	}
	else {
	return $output_string;
	}
}


/* On ajoute les actions ... */

add_action('wp_head', 'slider_styles');
add_action('wp_footer', 'script_load');
add_action('admin_init', 'add_upz_thumb');
add_action('admin_menu', 'slider_options_page');
add_shortcode( 'upzslider', 'upzslidershortcode_func');


?>