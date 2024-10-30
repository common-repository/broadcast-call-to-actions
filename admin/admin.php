<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
   
   
add_action( 'wp_ajax_broadcast_create_layout', 'broadcast_create_layout' );
add_action( 'wp_ajax_broadcast_save_layout', 'broadcast_save_layout' );
add_action( 'wp_ajax_broadcast_delete_layout', 'broadcast_delete_layout' );
add_action( 'wp_ajax_broadcast_view_layout', 'broadcast_view_layout' );
add_action( 'admin_enqueue_scripts', 'broadcast_enqueue_admin_css' );	// Enqueue admin scripts
add_filter( 'admin_footer_text', 'broadcast_filter_admin_footer_text'); // Admin menu text




/*
 *  broadcast_enqueue_admin_scripts
 *  Enqueue Admin CSS
 *
 *  @since 1.0
 */
function broadcast_enqueue_admin_css(){	
   wp_enqueue_style( 'broadcast', BROADCAST_URL.'/core/css/broadcast.css');
   wp_enqueue_style( 'broadcast-admin-css', BROADCAST_URL. '/admin/assets/css/admin.css');  
   wp_enqueue_style( 'broadcast-chosen-css', BROADCAST_URL. '/admin/assets/css/chosen.css'); 
   wp_enqueue_style( 'broadcast-tooltipster', BROADCAST_URL. '/admin/assets/css/tooltipster/tooltipster.css'); 
}



/*
 *  broadcast_create_layout
 *  Create Layout
 *
 *  @since 1.0
 *  @return $response
 */
function broadcast_create_layout() {
	
   global $wpdb;
   $blog_id = $wpdb->blogid; // Get blog ID
    
   if(! current_user_can('edit_posts' )) // check permissions
      exit;
      
   $nonce = sanitize_key($_POST["nonce"]);
   $type = sanitize_text_field($_POST["type"]);
   $name = sanitize_text_field($_POST["name"]);
   $path = sanitize_text_field($_POST["path"]);  
      
	// Check our nonce, if they don't match then bounce!
	if (! wp_verify_nonce( $nonce, 'broadcast_nonce' ))
		die('Error - unable to verify nonce, please try again.');
	
	if(!isset($name) && empty($name))
	   $name = 'Broadcast Layout';
	
	// Content of CTA
	$content = '// ' . __('Enter your call to action markup here', 'broadcast') .'';	
	if(isset($path) && $path !== 'empty')
      $content = file_get_contents($path);      
   
   /*
	 * Insert Post
	 */
	 
	$prefix = $wpdb->prefix; // table prefix
	$post_tbl = $prefix .'posts'; // posts table
	$last_id = $wpdb->get_row("SHOW TABLE STATUS LIKE '$post_tbl'");
	$new_id = $last_id->Auto_increment;	
	$layout_title = $name . ' ['. $new_id .']';
	
   $new_layout = array(
      'post_title'      => $layout_title,
      'post_content'    => $content,
      'post_status'     => 'publish',
      'post_type'       => BROADCAST_LAYOUT_POST_TYPE
   );
   $pid = wp_insert_post($new_layout);
   
   
   
   /*
	 * Create the layout
	 */	 
	
   
   // Check that /broadcast is created in the /uploads directory		
   $upload_dir = wp_upload_dir();
   $parent_dir = $upload_dir['basedir'].'/broadcast';
   if(!is_dir($parent_dir)){
      mkdir($parent_dir);
   }			
   			
	$dir = BROADCAST_UPLOAD_PATH. ''. $blog_id;
   if( !is_dir($dir) ){
      mkdir($dir);
   }		   
   $file = BROADCAST_UPLOAD_PATH. ''. $blog_id .'/layout_'. $pid .'.php';
   
	try {
      $o = fopen($file, 'w'); //Open file
      if ( !$o ) {
        throw new Exception(__('[Broadcast] Unable to open layout - Please check your file path and ensure your server is configured to allow Broadcast to read and write files.', 'broadcast'));
      } 
      $w = fwrite($o, $content); //Save the file
      if ( !$w ) {
        throw new Exception(__('[Broadcast] Error saving layout - Please check your file path and ensure your server is configured to allow Broadcast to read and write files.', 'broadcast'));
      } 
      fclose($o); //now close it
      
   } catch ( Exception $e ) {
      // Display error message in console.
      echo '<script>console.log("' .$e->getMessage(). '");</script>';
   }
   
   // Post Meta
   if( $pid ) { 
      //add_post_meta( $pid, 'cpt_firstname', $firstname, true );                                       
   } 
   
   
   // send a response
   $response = array(
      'status'       => '200',
      'message'      => 'OK',
      'id'           => $pid,
      'title'        => $layout_title,
      'time'         => date('F j, Y'),
      'editText'     => __('Edit Layout', 'broadcast'),
      'deleteText'   => __('Delete', 'broadcast'),
      'pubText'      => __('Published', 'broadcast'),
   );
   
   header( 'Content-Type: application/json; charset=utf-8' );
   
   wp_send_json($response);

   die();
    
}



/*
 *  broadcast_save_layout
 *  Save/Update Layout
 *
 *  @since 1.0
 *  @return $response
 */
function broadcast_save_layout() {
    
   if ( ! current_user_can( 'edit_posts' ) ) // check permissions
      exit;
      
   $nonce = sanitize_key($_POST["nonce"]); 
   $id = sanitize_text_field($_POST['id']); 
   $title = sanitize_text_field($_POST['title']); 
   $content = Trim(stripslashes($_POST['content'])); 
       
	// Check our nonce, if they don't match then bounce!
	if (! wp_verify_nonce( $nonce, 'broadcast_nonce' ))
		die('Error - unable to verify nonce, please try again.');
   
   $my_post = array(
      'ID'           => $id,
      'post_title'   => $title,
      'post_content' => $content,
   );  
   wp_update_post( $my_post ); // Update the post into the database
   
   
   // Create the layout
   global $wpdb;
	$blog_id = $wpdb->blogid; // Get blog ID
   			
	$dir = BROADCAST_UPLOAD_PATH. ''. $blog_id;
   if( !is_dir($dir) ){
      mkdir($dir);
   }		   
   $file = BROADCAST_UPLOAD_PATH. ''. $blog_id .'/layout_'. $id .'.php';
   try {
      $o = fopen($file, 'w'); //Open file
      if ( !$o ) {
        throw new Exception(__('[Broadcast] Unable to open layout - Please check your file path and ensure your server is configured to allow Broadcast to read and write files.', 'broadcast'));
      } 
      $w = fwrite($o, $content); //Save the file
      if ( !$w ) {
        throw new Exception(__('[Broadcast] Error saving layout - Please check your file path and ensure your server is configured to allow Broadcast to read and write files.', 'broadcast'));
      } 
      fclose($o); //now close it
      
   } catch ( Exception $e ) {
      // Display error message in console.
      echo '<script>console.log("' .$e->getMessage(). '");</script>';
   }
   
      
   // send a response
   $response = array(
      'status' => '200',
      'message' => 'OK',
      'id' => $id,
      'title' => $title,
      'content' => $content,
   );
   
   header( 'Content-Type: application/json; charset=utf-8' );
   wp_send_json($response);   
   
   die();
}


/*
 *  broadcast_delete_layout
 *  Delete Layout
 *
 *  @since 1.0
 *  @return null
 */
function broadcast_delete_layout() {
   
   if ( ! current_user_can( 'edit_posts' ) ) // check permissions
      exit;
      
   $nonce = sanitize_key($_POST["nonce"]); 
   $type = sanitize_text_field($_POST['type']);
   
   if($type === 'selected'){
      $id = array_map('sanitize_text_field', $_POST['id']); // Convert IDs to array
   }else{
      $id = sanitize_text_field($_POST['id']);
   }
     
	// Check our nonce, if they don't match then bounce!
	if (! wp_verify_nonce( $nonce, 'broadcast_nonce' ))
		die('Error - unable to verify nonce, please try again.');
	
   global $wpdb;
	$blog_id = $wpdb->blogid; // Current blog ID
	
	if($type === 'single'){ // Single record
   	broadcast_delete_record($blog_id, $id);
	}
	if($type === 'selected'){ // Multiple records
   	foreach($id as $postid) { 
         broadcast_delete_record($blog_id, $postid);	
      }
	}	   

   die();
    
}



/*
 *  broadcast_delete_record
 *  Delete multiple layouts in a batch
 *
 *  @since 1.0
 */
function broadcast_delete_record($blog_id, $id){
   
   if ( ! current_user_can( 'edit_posts' ) ) // check permissions
      exit;
   
   // Delete post
   wp_delete_post($id); 
   
   // File to delete            
   $file = BROADCAST_UPLOAD_PATH. ''. $blog_id .'/layout_'. $id .'.php';
   
   if (file_exists($file)) {
       unlink($file); // Delete now
   }
    
   // See if it exists again to be sure it was removed
   if (file_exists($file)) {
       echo __('Layout could not be deleted.', 'broadcast');
   } else {
       echo __('Layout deleted successfully.', 'broadcast');
   }
   
}



/*
 *  broadcast_view_layout
 *  View layout in admin
 *
 *  @since 1.0
 */
function broadcast_view_layout() {
    
   if ( ! current_user_can( 'edit_posts' ) ) // check permissions
      exit;
   
   $nonce = sanitize_key($_POST["nonce"]);  
   $id = sanitize_key($_POST["id"]);   
   
   // Check our nonce, if they don't match then bounce!
   if (! wp_verify_nonce( $nonce, 'broadcast_nonce' ))
   	die('Error - unable to verify nonce, please try again.');
   	
   $post = get_post($id);
   $content = $post->post_content;   
   
   // send a response
   $response = array(
      'status' => '200',
      'message' => 'OK',
      'id' => $id,
      'title' => get_the_title($id),
      'content' => $content,
   );
   
      
   header( 'Content-Type: application/json; charset=utf-8' );
   echo json_encode( $response );
   
   die();
}



/*
*  broadcast_filter_admin_footer_text
*  Filter the WP Admin footer text only on Broadcast pages
*
*  @since 1.0
*/

function broadcast_filter_admin_footer_text( $text ) {	
	$screen = broadcast_is_admin_screen();	
	if(!$screen){
		return;
	}
	
	echo '<strong>Broadcast</strong> is made with <span style="color: #e25555;">♥</span> by <a href="https://connekthq.com" target="_blank" style="font-weight: 500;">Connekt</a> | <a href="https://wordpress.org/support/plugin/broadcast-call-to-actions/reviews/" target="_blank" style="font-weight: 500;">Leave a Review</a>';
}
