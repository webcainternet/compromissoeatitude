<?php/** * Admin functions**/add_action('admin_menu', 'egoi_mail_list_builder_contact_form_7_auth',1);add_action('admin_menu', 'egoi_mail_list_builder_contact_form_7_login_logout',3);add_action('admin_menu', 'egoi_mail_list_builder_contact_form_7_admin_menu_setup',5);/** * Register menu items**/function egoi_mail_list_builder_contact_form_7_admin_menu_setup() {	$page_title = 'E-goi Mail List Builder Contact Form 7';	$menu_title = 'E-goi Mail List Builder Contact Form 7';	$capability = 'manage_options';	$menu_slug = 'egoi-mail-list-builder-contact-form-7-info';	$function = 'egoi_mail_list_builder_contact_form_7_info';	add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);		$EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object');	if($EgoiMailListBuilderContactForm7->isAuthed() && in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {		$page_title = 'Info';		$sub_menu_title = 'Info';		add_submenu_page($menu_slug, $page_title, $sub_menu_title, $capability, $menu_slug, $function);				$submenu_page_title = 'Lists';		$submenu_title = 'Lists';		$submenu_slug = 'egoi-mail-list-builder-contact-form-7-lists';		$submenu_function = 'egoi_mail_list_builder_contact_form_7_lists';		add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);		$submenu_page_title = 'Settings';		$submenu_title = 'Settings';		$submenu_slug = 'egoi-mail-list-builder-contact-form-7-settings';		$submenu_function = 'egoi_mail_list_builder_contact_form_7_settings';		add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);		$submenu_page_title = 'Widget Settings';		$submenu_title = 'Widget Settings';		$submenu_slug = 'egoi-mail-list-builder-contact-form-7-widget-settings';		$submenu_function = 'egoi_mail_list_builder_contact_form_7_widget_settings';		add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);		$submenu_page_title = 'Widget Style';		$submenu_title = 'Widget Style';		$submenu_slug = 'egoi-mail-list-builder-contact-form-7-widget-style';		$submenu_function = 'egoi_mail_list_builder_contact_form_7_widget_style';		add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);		$submenu_page_title = 'Import';		$submenu_title = 'Import';		$submenu_slug = 'egoi-mail-list-builder-contact-form-7-widget-import';		$submenu_function = 'egoi_mail_list_builder_contact_form_7_widget_import';		add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);	}} function egoi_mail_list_builder_contact_form_7_info() {    if (!current_user_can('manage_options')) {        wp_die('You do not have sufficient permissions to access this page.');    }	else {		require(EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR.'includes/info.php');	}}function egoi_mail_list_builder_contact_form_7_lists() {    if (!current_user_can('manage_options')) {        wp_die('You do not have sufficient permissions to access this page.');    }	else {		require(EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR.'includes/lists.php');	}}function egoi_mail_list_builder_contact_form_7_settings() {    if (!current_user_can('manage_options')) {        wp_die('You do not have sufficient permissions to access this page.');    }	else {		require(EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR.'includes/settings.php');	}}function egoi_mail_list_builder_contact_form_7_widget_settings() {    if (!current_user_can('manage_options')) {        wp_die('You do not have sufficient permissions to access this page.');    }	else {		require(EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR.'includes/widget_settings.php');	}}function egoi_mail_list_builder_contact_form_7_widget_style() {	if (!current_user_can('manage_options')) {		wp_die('You do not have sufficient permissions to access this page.');	}	else {		require(EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR.'includes/widget_style.php');	}}function egoi_mail_list_builder_contact_form_7_widget_import() {    if (!current_user_can('manage_options')) {        wp_die('You do not have sufficient permissions to access this page.');    }	else {		require(EGOI_MAIL_LIST_BUILDER_CONTACT_FORM_7_DIR.'includes/import.php');	}}/** * Add Egoi Mail List Builder Class to Options**/function egoi_mail_list_builder_contact_form_7_auth() {	if(!get_option('EgoiMailListBuilderContactForm7Object')) {		$EgoiMailListBuilderContactForm7 = new EgoiMailListBuilderContactForm7('');		add_option('EgoiMailListBuilderContactForm7Object',$EgoiMailListBuilderContactForm7);	}}/** * Check if user is logging in**/function egoi_mail_list_builder_contact_form_7_login_logout() {	if(isset($_POST['egoi_mail_list_builder_contact_form_7_logout']))	{		$EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object');		$EgoiMailListBuilderContactForm7 = new EgoiMailListBuilderContactForm7('',true);		update_option('EgoiMailListBuilderContactForm7Object',$EgoiMailListBuilderContactForm7);	}	else if(isset($_POST['egoi_mail_list_builder_contact_form_7_login']))	{		$EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object');		if(isset($_POST['egoi_mail_list_builder_contact_form_7_apikey_text'])) {			if(!empty($_POST['egoi_mail_list_builder_contact_form_7_apikey_text'])){				$EgoiMailListBuilderContactForm7 = new EgoiMailListBuilderContactForm7($_POST['egoi_mail_list_builder_contact_form_7_apikey_text']);				}			else{				$EgoiMailListBuilderContactForm7->exists = true;		    	$EgoiMailListBuilderContactForm7->description = "Please fill in an API key.";		    	$EgoiMailListBuilderContactForm7->error = "NOAPIKEY";			}		}		update_option('EgoiMailListBuilderContactForm7Object',$EgoiMailListBuilderContactForm7);	}}function egoi_mail_list_builder_contact_form_7_admin_notices() {	if(get_option('EgoiMailListBuilderContactForm7Object')) {		$EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object');	 	$screen_id = get_current_screen()->id;	 	if ((	 		$screen_id == 'toplevel_page_egoi-mail-list-builder-contact-form-7-info' || 	 		$screen_id == 'e-goi-mail-list-builder_page_egoi-mail-list-builder-contact-form-7-lists' ||	 		$screen_id == 'e-goi-mail-list-builder_page_egoi-mail-list-builder-contact-form-7-settings' ||			$screen_id == 'e-goi-mail-list-builder_page_egoi-mail-list-builder-contact-form-7-widget-style' ||	 		$screen_id == 'e-goi-mail-list-builder_page_egoi-mail-list-builder-contact-form-7-widget-settings' ||			$screen_id == 'e-goi-mail-list-builder_page_egoi-mail-list-builder-contact-form-7-import'	 		) 	 		&& $EgoiMailListBuilderContactForm7->exists) {	 		if($EgoiMailListBuilderContactForm7->error == "NO_USERNAME_AND_PASSWORD_AND_APIKEY"){	 			printf('<div class="updated"><p>'.$EgoiMailListBuilderContactForm7->description.'</p></div>');	 		}	 		else{	    		printf('<div class="error"><p>'.$EgoiMailListBuilderContactForm7->description.'</p></div>');	    	}	    	$EgoiMailListBuilderContactForm7->exists = false;	    	$EgoiMailListBuilderContactForm7->description = "";	    	$EgoiMailListBuilderContactForm7->error = "";	    	update_option('EgoiMailListBuilderContactForm7Object',$EgoiMailListBuilderContactForm7);	 	} 	}}add_action( 'admin_notices', 'egoi_mail_list_builder_contact_form_7_admin_notices' );?>