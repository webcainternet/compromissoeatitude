<?php
/** 
Plugin Name: e-goi Mail List Builder Contact Form 7 
Description: Mail list database populator 
Version: 1.0.2
Author: Indot 
Author URI: http://indot.pt 
Plugin URI: http://indot.pt/egoi-mail-list-builder-contact-form-7.zip 
License: GPLv2 or later 
**/
/**
	Copyright 2013  Indot  (email : info@indot.pt)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
**/
/**
 * Define some useful constants
**/
define('EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_VERSION', '1.0.2');
define('EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR', plugin_dir_path(__FILE__));
define('EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_URL', plugin_dir_url(__FILE__));
define('EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_PLUGIN_KEY', 'f385b3788f81d52d2db35a51b3096b6f'); 
define('EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_API_KEY', ''); 
define('EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_XMLRPC_URL', 'http://api.e-goi.com/v2/xmlrpc.php'); 
define('EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_AFFILIATE',' http://bo.e-goi.com/?action=registo&cID=232&aff=267d5afc22');  

/** 
 * Load files 
**/ 
function egoi_mail_list_builder_contact_form_7_activation() { 
	set_include_path(EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR.'library/'. PATH_SEPARATOR . get_include_path()); 
	require_once(EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR.'includes/class.xmlrpc.php'); 
	require_once(EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR.'library/Zend/XmlRpc/Client.php'); 
    if(is_admin()) { 
        require_once(EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR.'includes/admin.php'); 
	} 
	 
	require_once(EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR.'includes/class.egoi_mail_list_builder_contact_form_7.php'); 
	$EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object'); 
	if($EgoiMailListBuilderContactForm7) { 
		if($EgoiMailListBuilderContactForm7->isAuthed() && in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ))	{ 
			require_once(EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR.'egoi-widget.php'); 
		} 
	}  

} 
egoi_mail_list_builder_contact_form_7_activation();  

/** 
 * Activation, Deactivation and Uninstall Functions 
**/ 
register_activation_hook(__FILE__, 'egoi_mail_list_builder_contact_form_7_activation'); 
register_deactivation_hook(__FILE__, 'egoi_mail_list_builder_contact_form_7_deactivation');

/** 
 * Add Egoi Mail List Builder Settings link to plugin page 
**/ 
function egoi_mail_list_builder_contact_form_7_settings_plugin_link($links, $file)
{

	if($file == plugin_basename(EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR.'/egoi-mail-list-builder-contact-form-7.php')){
		$in = '<a href="admin.php?page=egoi-mail-list-builder-contact-form-7-info">Settings</a>';
		array_unshift($links, $in);
	}
	return $links; 
}
add_filter('plugin_action_links', 'egoi_mail_list_builder_contact_form_7_settings_plugin_link', 10, 2);

function egoi_mail_list_builder_contact_form_7_register_scripts() { 
    wp_enqueue_style( 'egoi-mail-list-builder-contactform7-admin-css', EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_URL . 'assets/css/admin.css' ); 
} 
add_action( 'admin_enqueue_scripts', 'egoi_mail_list_builder_contact_form_7_register_scripts' );   

/** 
 * Plugin deactivation code 
**/ 
function egoi_mail_list_builder_contact_form_7_deactivation() {   
	//delete_option('EgoiMailListBuilderObject'); 
}  

function egoi_mail_list_builder_contact_form_7_fields_logged_in($fields) { 
	$EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object'); 
	if($EgoiMailListBuilderContactForm7->subscribe_enable){ 
		global $current_user; 
		get_currentuserinfo(); 
		$status = $EgoiMailListBuilderContactForm7->checkSubscriber($EgoiMailListBuilderContactForm7->subscribe_list, $current_user->user_email); 
		if($status == -1){ 
    		$fields .= "<input type='checkbox' name='egoi_mail_list_builder_contact_form_7_subscribe' id='egoi_mail_list_builder_contact_form_7_subscribe' value='subscribe' checked/> ".$EgoiMailListBuilderContactForm7->subscribe_text; 
    	} 
	} 
    return $fields; 
} 
add_filter('comment_form_logged_in','egoi_mail_list_builder_contact_form_7_fields_logged_in');   


function egoi_mail_list_builder_contact_form_7_fields_logged_out($fields) { 
	$EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object'); 
	if($EgoiMailListBuilderContactForm7->subscribe_enable){ 
    	$fields["subscribe"] = "<input type='checkbox' name='egoi_mail_list_builder_contact_form_7_subscribe' id='egoi_mail_list_builder_contact_form_7_subscribe' value='subscribe' checked/> ".$EgoiMailListBuilderContactForm7->subscribe_text; 
	} 
    return $fields; 
} 
add_filter('comment_form_default_fields','egoi_mail_list_builder_contact_form_7_fields_logged_out');  

function egoi_mail_list_builder_contact_form_7_comment_process($commentdata) { 
    if(isset($_POST['egoi_mail_list_builder_contact_form_7_subscribe'])){ 
    	if($_POST['egoi_mail_list_builder_contact_form_7_subscribe'] == "subscribe"){ 
    		//die(); 
    		$EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object'); 
			$result = $EgoiMailListBuilderContactForm7->addSubscriber( 
				$EgoiMailListBuilderContactForm7->subscribe_list, 
				$commentdata['comment_author'], 
				'', 
				$commentdata['comment_author_email'] 
			); 
    	} 
    } 
    return $commentdata; 
} 
add_filter( 'preprocess_comment', 'egoi_mail_list_builder_comment_process' );  

function egoi_mail_list_builder_contact_form_7_register_user_scripts($hook) { 
	wp_enqueue_script( 'jquery'); 
	wp_enqueue_script( 'jquery-ui-datepicker'); 
	wp_enqueue_style( 'indot-jquery-ui-css', EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_URL . 'assets/css/jquery-ui.min.css'); 
	wp_enqueue_script( 'canvas-loader', EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_URL . 'assets/js/heartcode-canvasloader-min.js'); 
} 
add_action( 'wp_enqueue_scripts', 'egoi_mail_list_builder_contact_form_7_register_user_scripts' ); 
function egoi_mail_list_builder_contact_form_7_html($content ){

	$EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object');

	if($EgoiMailListBuilderContactForm7->subscribe_enable_checkbox){

		$EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object');

		if($EgoiMailListBuilderContactForm7->hide_subscribe == false){

		 	$content .= "<input type='checkbox' name='egoi_mail_list_builder_contact_form_7_subscribe_field' id='egoi_mail_list_builder_contact_form_7_subscribe_field' value='subscribe' /> ".$EgoiMailListBuilderContactForm7->subscribe_text;

    	}

	}

	return $content;

}

add_filter('wpcf7_form_elements','egoi_mail_list_builder_contact_form_7_html');


function egoi_mail_list_builder_contact_form_7_html_post (&$wpcf7_data) {
   $EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object');
   if ($_POST['egoi_mail_list_builder_contact_form_7_subscribe_field'] || ($EgoiMailListBuilderContactForm7->subscribe_enable_checkbox && $EgoiMailListBuilderContactForm7->hide_subscribe)){

    	$result = $EgoiMailListBuilderContactForm7->addSubscriber(

			$EgoiMailListBuilderContactForm7->subscribe_list,

			$_POST['your-name'],

			'',

			$_POST['your-email']

		);
    }
}
add_action("wpcf7_before_send_mail", "egoi_mail_list_builder_contact_form_7_html_post");   function egoi_mail_list_builder_contact_form_7_registration(){ 
	$EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object'); 


		global $current_user; 
		get_currentuserinfo(); 
		$status = $EgoiMailListBuilderContactForm7->checkSubscriber($EgoiMailListBuilderContactForm7->subscribe_list, $current_user->user_email); 
		if($status == -1){ 
    		//echo "<input type='checkbox' name='egoi_mail_list_builder_contact_form_7_subscribe' id='egoi_mail_list_builder_contact_form_7_subscribe' value='subscribe' checked/> ".$EgoiMailListBuilderContactForm7->subscribe_text; 
			echo "<input type='checkbox' name='egoi_mail_list_builder_contact_form_7_subscribe' id='egoi_mail_list_builder_contact_form_7_subscribe' value='subscribe'/> ".$EgoiMailListBuilderContactForm7->subscribe_text; 
    	} 


} 
add_action('register_form','egoi_mail_list_builder_contact_form_7_registration');  

function egoi_mail_list_builder_contact_form_7_registration_validation($user_id) { 
    if (isset($_POST['egoi_mail_list_builder_contact_form_7_subscribe'])){ 
		$EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object'); 
		$result = $EgoiMailListBuilderContactForm7->addSubscriber( 
			$EgoiMailListBuilderContactForm7->subscribe_list, 
			$_POST['user_login'], 
			'', 
			$_POST['user_email'] 
		); 
	} 
} 
add_action('user_register', 'egoi_mail_list_builder_contact_form_7_registration_validation');

function egoi_mail_list_builder_contact_form_7_shortcode_widget_area() {
	register_sidebar( array(
		'name' => __( 'Egoi Widget Shortcode Area', 'egoi_mail_list_builder_contact_form_7_shortcode_widget_area' ),
		'id' => 'header-sidebar',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'egoi_mail_list_builder_contact_form_7_shortcode_widget_area' );

function egoi_mail_list_builder_contact_form_7_shortcode($atts){
	extract(shortcode_atts(array(
		'widget_index' => FALSE
	), $atts));

	$widget_index = wp_specialchars($widget_index);

	ob_start();
	$widgets = dynamic_sidebar("Egoi Widget Shortcode Area");
	if($widgets){
		$html = ob_get_contents();
		$widgets_array = explode("<div>",$html);
		$final_html = "<div>".$widgets_array[$widget_index];
	}
	else{
		$final_html = "";
	}
	ob_end_clean();
	return $final_html;
}
add_shortcode( 'egoi_subscribe', 'egoi_mail_list_builder_contact_form_7_shortcode' );
?>