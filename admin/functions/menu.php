<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
   	

function broadcast_admin_menu() {  
   
   $before = '<span style="display:block; border-top: 1px solid #555; padding-top: 10px;">';
   $after = '</span>';
   // Layouts
   $broadcast_layouts_page = add_submenu_page( 
      'edit.php?post_type=broadcast', 
      'Layouts', 
      $before.'Layouts'.$after, 
      'edit_posts', 
      'layouts', 
      'broadcast_layouts_page'
   ); 
   
   //Settings
   $broadcast_settings_page = add_submenu_page( 
      'edit.php?post_type=broadcast', 
      'Dashboard', 
      $before.'Dashboard'.$after, 
      'edit_posts', 
      'dashboard', 
      'broadcast_settings_page'
   ); 
   
   // Help
   $broadcast_help_page = add_submenu_page( 
      'edit.php?post_type=broadcast', 
      'Help', 
      'Help', 
      'edit_posts', 
      'help', 
      'broadcast_help_page'
   ); 
   
   // Add-ons
   /*
   $broadcast_addons_page = add_submenu_page( 
      'edit.php?post_type=broadcast', 
      'Add-ons', 
      'Add-ons', 
      'edit_posts', 
      'addons', 
      'broadcast_addons_page'
   );
   */ 
   
   //Add admin scripts
   add_action( 'load-' . $broadcast_settings_page, 'broadcast_load_admin_js' );
   add_action( 'load-' . $broadcast_layouts_page, 'broadcast_load_admin_js' );
   add_action( 'load-' . $broadcast_help_page, 'broadcast_load_admin_js' );
   //add_action( 'load-' . $broadcast_addons_page, 'broadcast_load_admin_js' );
  
}
add_action( 'admin_menu', 'broadcast_admin_menu' );


/*
 *  Plugin pages
 */

function broadcast_settings_page(){ 
   include_once( BROADCAST_PATH . 'admin/views/dashboard.php');
}
function broadcast_layouts_page(){ 
   include_once( BROADCAST_PATH . 'admin/views/layouts.php');
}
function broadcast_addons_page(){ 
   include_once( BROADCAST_PATH . 'admin/views/addons.php');
}
function broadcast_help_page(){ 
   include_once( BROADCAST_PATH . 'admin/views/help.php');
}


// remove post type actions
function broadcast_remove_row_actions($actions){
   if( get_post_type() === BROADCAST_POST_TYPE ) { 
      unset( $actions['view'] ); 
   }
   return $actions;
}
add_filter( 'post_row_actions', 'broadcast_remove_row_actions', 10, 1 );  


// Hide view CTA and Permalink in Broadcast edit mode
function broadcact_admin_hide_css() {
   global $post_type;
   if($post_type == BROADCAST_POST_TYPE) {
      echo '<style type="text/css">#edit-slug-box,#view-post-btn,
   #post-preview,.updated p a{display: none;}.view{display:none;}</style>';
   }
}
add_action('admin_head', 'broadcact_admin_hide_css'); 


