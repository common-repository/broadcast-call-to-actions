<?php
   
/*
*  broadcast_is_admin_screen
*  Determine whether user is on an Broadcast admin screen
*
*  @return boolean
*  @since 1.0
*/
	
function broadcast_is_admin_screen(){
	$return = false;
	$screen = get_current_screen();
	if($screen->post_type === 'broadcast'){
		$return = true;
	}
	return $return;
}


/*
*  broadcast_column_head
*  Create admin column headers in Admin for CTAs
*
*  @return $columns
*  @since 1.0
*/
function broadcast_column_head($columns){
   
   unset($columns['date']);
   
   $columns['id'] = '<span class="dashicons dashicons-tag" style="font-size: 16px; opacity: 0.5; position: relative; top: 2px;"></span> '. __('ID', 'broadcast');
   $columns['url'] = '<span class="dashicons dashicons-admin-site" style="font-size: 16px; opacity: 0.5; position: relative; top: 2px;"></span>'. __('URL', 'broadcast');
   $columns['image'] = '<span class="dashicons dashicons-format-image" style="font-size: 16px; opacity: 0.5; position: relative; top: 2px;"></span>'. __('Image', 'broadcast');
   $columns['date'] = __('Date', 'broadcast');
   
   return $columns;
}
add_filter('manage_broadcast_posts_columns', 'broadcast_column_head'); // Column Header


/*
*  broadcast_custom_row_display
*  Display of column rows for CTAs
*
*  @return null
*  @since 1.0
*/
function broadcast_custom_row_display($column_name, $id){
   
   if($column_name === 'id'){
      echo '<div style="">'.$id.'</div>';  
   }
   
   if($column_name === 'url'){
      $url = get_post_meta( $id, 'broadcast_url', true);
      if( isset($url) && !empty($url)){
         echo ' <a href="'. $url .'" target="_blank">'. $url .'</a>';
      }
   }

   if($column_name === 'image'){
      if( has_post_thumbnail($id)){
         $img = get_the_post_thumbnail_url($id, 'thumbnail');
         echo '<img src="'. $img .'" alt="" style="max-width: 50px; border-radius: 2px;" />';
      }
   }
}
add_action('manage_broadcast_posts_custom_column', 'broadcast_custom_row_display', 10, 2); // rows
