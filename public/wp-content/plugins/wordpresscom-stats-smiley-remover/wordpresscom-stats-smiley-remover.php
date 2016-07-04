<?php
/*
Plugin Name: WordPress.com Stats Smiley Remover
Plugin URI: http://thisismyurl.com/downloads/wordpress-com-stats-smiley-remover/
Description: The WordPress.com Stats Smiley Remover quickly removes the smiley face placed in the footer of your site by the WordPress.com Stats plugin.
Author: Christopher Ross
Author URI: http://thisismyurl.com/
Version: 15.01
*/

/**
 *
 * WordPress.com Stats Smiley Remover core file
 *
 * This file contains all the logic required for the plugin
 *
 * @link		http://wordpress.org/extend/plugins/wordpresscom-stats-smiley-remover/
 *
 * @package 	WordPress.com Stats Smiley Remover
 * @copyright	Copyright (c) 2008, Chrsitopher Ross
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		WordPress.com Stats Smiley Remover 1.0
 *
 *
 */

/* if the plugin is called directly, die */
if ( ! defined( 'WPINC' ) )
	die;
	
	
define( 'THISISMYURL_WPSF_NAME', 'WordPress.com Stats Smiley Remover' );
define( 'THISISMYURL_WPSF_SHORTNAME', 'WP Smiley' );

define( 'THISISMYURL_WPSF_FILENAME', plugin_basename( __FILE__ ) );
define( 'THISISMYURL_WPSF_FILEPATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'THISISMYURL_WPSF_FILEPATHURL', plugin_dir_url( __FILE__ ) );

define( 'THISISMYURL_WPSF_NAMESPACE', basename( THISISMYURL_WPSF_FILENAME, '.php' ) );
define( 'THISISMYURL_WPSF_TEXTDOMAIN', str_replace( '-', '_', THISISMYURL_WPSF_NAMESPACE ) );

define( 'THISISMYURL_WPSF_VERSION', '15.01' );

include_once( 'thisismyurl-common.php' );



/**
 * Creates the class required for WordPress.com Stats Smiley Remover
 *
 * @author     Christopher Ross <info@thisismyurl.com>
 * @version    Release: @15.01@
 * @see        wp_enqueue_scripts()
 * @since      Class available since Release 14.11
 *
 */
if( ! class_exists( 'thissimyurl_WPSmileyRemover' ) ) {
class thissimyurl_WPSmileyRemover extends thisismyurl_Common_WPSF {

}
}

$thissimyurl_WPSmileyRemover = new thissimyurl_WPSmileyRemover;