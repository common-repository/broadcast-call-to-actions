<?php
/*
Plugin Name: Broadcast - WordPress Call to Actions
Plugin URI: https://connekthq.com/plugins/broadcast/
Description: A call to action management plugin for WordPress.
Author: Darren Cooney
Twitter: @connekthq
Author URI: https://connekthq.com
Version: 1.0
License: GPL
Copyright: Darren Cooney
*/	

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


define( 'BROADCAST_VERSION', '1.0' );
define( 'BROADCAST_RELEASE', 'April 7, 2017' );
define( 'BROADCAST_STORE_URL', 'https://connekthq.com' );


/*
*  broadcast_install
*  Activation hook
*
*  @since 1.0
*/

function broadcast_install($network_wide) {   
   // Create /broadcast directory inside /uploads to store layouts
   $upload_dir = wp_upload_dir();
   $dir = $upload_dir['basedir'].'/broadcast';
   if(!is_dir($dir)){
      mkdir($dir);
   }
}
register_activation_hook( __FILE__, 'broadcast_install' );



if(!class_exists('Broadcast')):

	class Broadcast {	
		
   	function __construct(){	   
   	
   		define('BROADCAST_PATH', plugin_dir_path(__FILE__));
   		define('BROADCAST_URL', plugins_url('', __FILE__));
   		define('BROADCAST_TITLE', 'Broadcast');	
   		define('BROADCAST_POST_TYPE', 'broadcast');	
   		define('BROADCAST_LAYOUT_POST_TYPE', 'broadcast_layout');	
   		$upload_dir = wp_upload_dir();
         define('BROADCAST_UPLOAD_PATH', $upload_dir['basedir'].'/broadcast/');
         define('BROADCAST_UPLOAD_URL', $upload_dir['baseurl'].'/broadcast/');
   			   
   		add_shortcode( 'broadcast', array(&$this, 'broadcast_shortcode') );		
   		add_filter( 'widget_text', 'do_shortcode' ); // Allow shortcodes in widget areas  	
   		add_action( 'add_meta_boxes', array(&$this, 'broadcast_custom_meta_box') ); // Add meta box   		
   		add_action( 'save_post', array(&$this, 'broadcast_save' ) ); // Save meta box
   		add_action( 'wp_enqueue_scripts', array(&$this, 'broadcast_enqueue_scripts') ); // Enqueue scripts
   		add_filter('plugin_action_links_' . plugin_basename(__FILE__), array(&$this, 'broadcast_action_links'));
   		add_action( 'after_setup_theme',  array(&$this, 'broadcast_image_sizes') ); // Add image sizes
         load_plugin_textdomain( 'broadcast', false, dirname(plugin_basename( __FILE__ )).'/lang/');
   		
   		$this->includes();	// includes
   		
   	}	
   	
   	
   	
   	/*
      *  includes
      *  Load all include files. Admin and Public
      *
      *  @since 1.0
      */
   	private function includes(){
   		if( is_admin()){
   			include_once('admin/admin.php');
   			include_once('admin/functions.php');
            include_once('admin/functions/menu.php'); // Menus, menu display controllers
            include_once('admin/functions/settings.php'); // All plugin settings
            include_once('admin/functions/scripts.php'); // Admin Scripts
            include_once('admin/editor/editor.php'); // TinyMCE popup
   		}		
      	include_once('core/classes/class.shortcode.php');
      	include_once('core/classes/class.enqueue.php');
   		include_once('functions/functions.php');
   	   include_once('functions/post_types.php');
      }
      
   	
   	
   	/*
      *  broadcast_custom_meta_box
      *  Add Meta Box to CPT
      *
      *  @since 1.0
      */
   	public function broadcast_custom_meta_box() {  
      	$options = get_option( 'broadcast_settings' ); 
      	if(!isset($options['broadcast_post_meta']) || $options['broadcast_post_meta'] == '0'){     	
            add_meta_box( 
               'broadcast-meta-wrap', 
               __('Broadcast - Link Options', 'broadcast'), 
               array( $this, 'broadcast_meta_box_content' ),
               BROADCAST_POST_TYPE, 
               'normal', 
               'high'          
            );  
         }     
      }
      
      
      
      /*
      *  broadcast_meta_box_content
      *  Render Meta Box
      *
      *  @since 1.0
      */
      public function broadcast_meta_box_content( $post ) {
         
         wp_nonce_field( 'broadcast_custom_box', 'broadcast_custom_box_nonce' );
         
         // Use get_post_meta to retrieve an existing value from the database.
         $broadcast_url = get_post_meta( $post->ID, 'broadcast_url', true );
         $broadcast_label = get_post_meta( $post->ID, 'broadcast_label', true );
         $broadcast_target = get_post_meta( $post->ID, 'broadcast_target', true );
         
         echo '<div class="item full">';
         _e('Attach a custom link button label, URL and target to this call to action', 'broadcast');
         echo '.</div>';
         
         echo '<div class="item-wrap">';
         
         // $broadcast_label
         echo '<div class="item">';
         echo '<label for="broadcast_label">';
         _e( 'Button Label', 'broadcast' );
         echo '</label> ';
         echo '<input type="text" id="broadcast_label" name="broadcast_label"';
         echo ' value="' . esc_attr( $broadcast_label ) . '" size="25" placeholder="'.__('Button Text', 'broadcast').'" />';
         echo '</div>';
         
         // $broadcast_url
         echo '<div class="item">';
         echo '<label for="broadcast_url">';
         _e( 'URL', 'broadcast' );
         echo '</label> ';
         echo '<input type="text" id="broadcast_url" name="broadcast_url"';
         echo ' value="' . esc_attr( $broadcast_url ) . '" size="25" placeholder="'.__('http://', 'broadcast').'" />';
         echo '</div>';
         
         // $broadcast_target
         echo '<div class="item">';
         echo '<label for="broadcast_target">';
         _e( 'URL Target', 'broadcast' );
         echo '</label> ';
         echo '<select id="broadcast_target" name="broadcast_target">';
         if($broadcast_target === '_self')
            echo '<option value="_self" selected="selected">Same Window</option>';
         else
            echo '<option value="_self">Same Window</option>';
            
         if($broadcast_target === '_blank') 
            echo '<option value="_blank" selected="selected">New Window</option>';
         else 
            echo '<option value="_blank">New Window</option>';
         
         echo '</select>';
         echo '</div>';
         
         echo '</div>';
         
         echo '<p style="margin: 0;" class="broadcast-meta-callout">';
         echo __('Visit the <a href="edit.php?post_type=broadcast&page=help">Help</a> section for more information on retreiving these values in your <a href="edit.php?post_type=broadcast&page=layouts">Layouts</a>.', 'broadcast');
         echo '</p>';
         
      }
      
      
      
      /*
      *  broadcast_save
      *  Save Meta Box
      *
      *  @since 1.0
      */      
      public function broadcast_save( $post_id ) {
   	
   		/*
   		 * We need to verify this came from the our screen and with proper authorization,
   		 * because save_post can be triggered at other times.
   		 */
   
   		// Check if our nonce is set.
   		if ( ! isset( $_POST['broadcast_custom_box_nonce'] ) )
   			return $post_id;
   
   		$nonce = $_POST['broadcast_custom_box_nonce'];
   
   		// Verify that the nonce is valid.
   		if ( ! wp_verify_nonce( $nonce, 'broadcast_custom_box' ) )
   			return $post_id;
   
   		// If this is an autosave, our form has not been submitted,
            //     so we don't want to do anything.
   		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
   			return $post_id;
   
   		// Check the user's permissions.
   		if ( 'page' == $_POST['post_type'] ) {   
   			if ( ! current_user_can( 'edit_page', $post_id ) )
   				return $post_id;   	
   		} else {   
   			if ( ! current_user_can( 'edit_post', $post_id ) )
   				return $post_id;
   		}
   
   		/* OK, its safe for us to save the data now. */
   
   		// Sanitize the user input.
   		$broadcast_url = sanitize_text_field( $_POST['broadcast_url'] );
   		$broadcast_label = sanitize_text_field( $_POST['broadcast_label'] );
   		$broadcast_target = sanitize_text_field( $_POST['broadcast_target'] );
   
   		// Update the meta field.
   		update_post_meta( $post_id, 'broadcast_url', $broadcast_url );
   		update_post_meta( $post_id, 'broadcast_label', $broadcast_label );
   		update_post_meta( $post_id, 'broadcast_target', $broadcast_target );
   		
   	}
   	
   	
   	
   	/*
		*  broadcast_image_sizes
		*  Add default image size
		*
		*  @since 1.0
		*/
		
		public function broadcast_image_sizes(){   
			add_image_size( 'broadcast-cta', 800, 450, true); // cta
		} 
   
      
      
      /*
      *  broadcast_shortcode
      *  The CTA shortcode
      *
      *  @since 1.0
      */  
   	public function broadcast_shortcode( $atts) {
      	return BROADCAST_SHORTCODE::broadcast_render_shortcode($atts);
      }
   	
   	
   	
   	/*
      *  broadcast_enqueue_scripts
      *  Enqueue Public Scripts
      *
      *  @since 1.0
      */
   	public function broadcast_enqueue_scripts(){
      	
      	$options = get_option( 'broadcast_settings' ); // Get Options
   		if(!isset($options['broadcast_css']) || $options['broadcast_css'] != '1'){
	   		$file = plugins_url('/core/css/broadcast.css', __FILE__ );
            BROADCAST_ENQUEUE::broadcast_enqueue_css('broadcast', $file);
   		}            
         
      }
		
		
		
		/*
   	*  broadcast_action_links
   	*  Add plugin action links to WP plugin screen
   	*
   	*  @since 1.0.0
   	*/   
      
      public function broadcast_action_links( $links ) {
         $new_links[] = '<a href="'. get_admin_url(null, 'edit.php?post_type=broadcast&page=dashboard') .'">'.__('Dashboard', 'post-explorer').'</a>';
         $new_links[] = '<a href="'. get_admin_url(null, 'edit.php?post_type=broadcast') .'">'.__('CTAs', 'post-explorer').'</a>';
         return array_merge($new_links, $links);
      }
   	
   	  	
   }
   
   
   /*
   *  Broadcast
   *  The main function responsible for returning the one true Broadcast instance
   *
   *  @since 1.0
   */
   
   function Broadcast(){
   	global $Broadcast;   
   	if(!isset($Broadcast)){
   		$Broadcast = new Broadcast();
   	}   
   	return $Broadcast;
   }   
   Broadcast(); // initialize

endif; // class_exists check
