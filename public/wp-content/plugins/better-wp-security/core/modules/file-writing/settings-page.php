<?php

final class ITSEC_Core_Server_Config_Rules_Settings_Page extends ITSEC_Module_Settings_Page {
	public function __construct() {
		$this->id = 'server-config-rules';
		$this->title = __( 'Server Config Rules', 'better-wp-security' );
		$this->description = __( 'If you need to manually add the server config rules generated by iThemes Security to your server, you can find them here.', 'better-wp-security' );
		$this->type = 'advanced';
		$this->information_only = true;
		$this->can_save = false;
		$this->always_active = true;

		parent::__construct();
	}

	protected function render_description( $form ) {
		require_once( ITSEC_Core::get_core_dir() . '/lib/class-itsec-lib-config-file.php' );

		$config = ITSEC_Lib_Config_File::get_server_config();

		if ( empty( $config ) ) {
			_e( 'There are no rules that need to be written.', 'better-wp-security' );
		} else {
			echo '<p>' . __( "The following rules need to be written to your server's config file. Please make sure to keep the comments in place." ) . '</p>';
			echo '<div class="itsec_server_config_rules"><pre>' . esc_html( $config ) . '</pre></div>';
		}
	}
}
new ITSEC_Core_Server_Config_Rules_Settings_Page();


final class ITSEC_Core_WPConfig_File_Settings_Page extends ITSEC_Module_Settings_Page {
	public function __construct() {
		$this->id = 'wp-config-rules';
		$this->title = __( 'wp-config.php Rules', 'better-wp-security' );
		$this->description = __( 'If you need to manually add the <code>wp-config.php</code> rules generated by iThemes Security to your server, you can find them here.', 'better-wp-security' );
		$this->type = 'advanced';
		$this->information_only = true;
		$this->can_save = false;
		$this->always_active = true;

		parent::__construct();
	}

	protected function render_description( $form ) {
		require_once( ITSEC_Core::get_core_dir() . '/lib/class-itsec-lib-config-file.php' );

		$config = ITSEC_Lib_Config_File::get_wp_config();

		if ( empty( $config ) ) {
			_e( 'There is nothing that needs to be written to your <code>wp-config.php</code> file.', 'better-wp-security' );
		} else {
			echo '<p>' . __( "The following rules need to be written to your <code>wp-config.php</code> file. Please make sure to keep the comments in place." ) . '</p>';
			echo '<div class="itsec_rewrite_rules"><pre>' . esc_html( $config ) . '</pre></div>';
		}
	}
}
new ITSEC_Core_WPConfig_File_Settings_Page();
