<?php
/**
 * Main Themify class
 */
if ( ! class_exists( 'Themify' ) ) {
	class Themify {
		/** Default sidebar layout
		 * @var string */
		public $layout;
		/** Default posts layout
		 * @var string */
		public $post_layout;
		
		public $hide_title;
		public $hide_meta;
		public $hide_date;
		public $hide_image;
		
		public $unlink_title;
		public $unlink_image;
		
		public $display_content = '';
		public $auto_featured_image;
		
		public $width = '';
		public $height = '';
		
		public $avatar_size = 96;
		public $page_navigation;
		public $posts_per_page;
		
		public $image_align = '';
		public $image_setting = '';
		
		public $query_category = '';
		public $paged = '';
		
		/////////////////////////////////////////////
		// Set Default Image Sizes 					
		/////////////////////////////////////////////
		
		// Default Index Layout
		static $content_width = 978;
		static $sidebar1_content_width = 670;
		
		// Default Single Post Layout
		static $single_content_width = 978;
		static $single_sidebar1_content_width = 670;
		
		// Default Single Image Size
		static $single_image_width = 978;
		static $single_image_height = 400;
		
		// Grid4
		static $grid4_width = 222;
		static $grid4_height = 140;
		
		// Grid3
		static $grid3_width = 306;
		static $grid3_height = 180;
		
		// Grid2
		static $grid2_width = 474;
		static $grid2_height = 250;
		
		// List Large
		static $list_large_image_width = 680;
		static $list_large_image_height = 390;
		 
		// List Thumb
		static $list_thumb_image_width = 230;
		static $list_thumb_image_height = 200;
		
		// List Grid2 Thumb
		static $grid2_thumb_width = 120;
		static $grid2_thumb_height = 100;
		
		// List Post
		static $list_post_width = 978;
		static $list_post_height = 400;
		
		// Sorting Parameters
		public $order = 'DESC';
		public $orderby = 'date';

		function __construct() {
		}

		function template_redirect() {
		}
		
		/**
		 * Returns post category IDs concatenated in a string
		 * @param number Post ID
		 * @return string Category IDs
		 */
		public function get_categories_as_classes($post_id){
			$categories = wp_get_post_categories($post_id);
			$class = '';
			foreach($categories as $cat)
				$class .= ' cat-'.$cat;
			return $class;
		}
		 	 
		 /**
		  * Returns category description
		  * @return string
		  */
		 function get_category_description(){
		 	$category_description = category_description();
			if ( !empty( $category_description ) ){
				return '<div class="category-description">' . $category_description . '</div>';
			}
		 }
	}
}

/**
 * Initializes Themify class
 */
function themify_builder_global_options(){
	/**
	 * Themify initialization class
	 */
	global $themify;
	if ( class_exists( 'Themify' ) ) {
		$themify = new Themify();
	}
}
add_action( 'init','themify_builder_global_options' );

/* 	Enqueue Stylesheets and Scripts
/***************************************************************************/
add_action('wp_enqueue_scripts', 'themify_theme_enqueue_scripts');
function themify_theme_enqueue_scripts(){

	//Themify Gallery
	wp_enqueue_script( 'themify-gallery', THEMIFY_URI . '/js/themify.gallery.js', array('jquery'), false, true );
	
	//Inject variable values in gallery script
	wp_localize_script( 'themify-gallery', 'themifyScript', array(
			'lightbox' => themify_lightbox_vars_init(),
			'lightboxContext' => apply_filters('themify_lightbox_context', 'body'),
			'isTouch' => wp_is_mobile() ? 'true': 'false'
		)
	);
}

/**
 * Print inline javascript
 */
function themify_theme_inline_scripts() {
?>
	<script type="text/javascript">
		// js code goes here
		jQuery(window).load(function(){
			// Lightbox / Fullscreen initialization ///////////
			if(typeof ThemifyGallery !== 'undefined'){ ThemifyGallery.init({'context': jQuery(themifyScript.lightboxContext)}); }
		});
	</script>
<?php
}
add_action( 'wp_footer', 'themify_theme_inline_scripts' );

$themify_builder_data = array();
$themify_builder_cached = false;

if ( ! function_exists( 'themify_builder_get' ) ) {
	///////////////////////////////////////////
	// Version Getter
	///////////////////////////////////////////
	function themify_builder_get( $var ){
		global $post;
		$data = themify_builder_get_data();
		if(isset($data[$var]) && $data[$var] != ''){
			return $data[$var];
		} else if(is_object($post) && get_post_meta($post->ID, $var, true) != ''){
			return get_post_meta($post->ID, $var, true);
		}
	}
}

if ( ! function_exists( 'themify_builder_get_data' ) ) {
	/**
	 * Get Data
	 * @return String
	 * @since 1.0.0
	 * @package themify
	 */
	function themify_builder_get_data(){
		global $themify_builder_data, $themify_builder_cached;
		if ( ! $themify_builder_cached ) {
			$themify_builder_data = get_option( 'themify_builder_setting' );
			if( is_array( $themify_builder_data ) && count( $themify_builder_data ) >= 1 ) {
				foreach( $themify_builder_data as $name => $value ){
					$themify_builder_data[ $name ] = stripslashes( $value );	
				}
			} else {
				$themify_builder_data = array();
			}
			$themify_builder_cached = true;
		}
		return $themify_builder_data;
	}
}

if ( ! function_exists( 'themify_builder_plugin_data_filters' ) ) {
	add_filter( 'themify_get_data', 'themify_builder_plugin_data_filters' );
	function themify_builder_plugin_data_filters( $data ) {
		if ('' != themify_builder_get( 'image_setting-img_settings_use' ) ) {
			$data['setting-img_settings_use'] = true;
		}
		if ( '' != themify_builder_get('image_setting-global_feature_size') ) {
			$data['setting-global_feature_size'] = themify_builder_get('image_setting-global_feature_size');
		}
		return $data;
	}
}

?>