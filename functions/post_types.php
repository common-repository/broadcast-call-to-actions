<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// Register Broadcast Post Type  
function broadcastCoreRegisterCPT(){	
   $labels = array(
      'name'                => _x( 'Call to Actions', 'broadcast' ),
   	'singular_name'       => _x( 'Broadcast', 'broadcast' ),
   	'menu_name'           => __( 'Broadcast', 'broadcast' ),
   	'name_admin_bar'      => __( 'Broadcast', 'broadcast' ),
   	'parent_item_colon'   => __( 'Parent Call to Action:', 'broadcast' ),
   	'all_items'           => __( 'Call to Actions', 'broadcast' ),
   	'add_new_item'        => __( 'Add New Call to Action', 'broadcast' ),
   	'add_new'             => __( 'Add New', 'broadcast' ),
   	'new_item'            => __( 'New Call to Action', 'broadcast' ),
   	'edit_item'           => __( 'Edit Call to Action', 'broadcast' ),
   	'update_item'         => __( 'Update Call to Action', 'broadcast' ),
   	'view_item'           => __( 'View Call to Action', 'broadcast' ),
   	'search_items'        => __( 'Search Call to Actions', 'broadcast' ),
   	'not_found'           => __( 'No Call to Actions found', 'broadcast' ),
   	'not_found_in_trash'  => __( 'Not found in Trash', 'broadcast' ),
   );
   $args = array(
      'labels' => $labels,
      'hierarchical' => false,
      'description' => '',
      'supports' => array( 'title', 'editor', 'thumbnail'),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'publicly_queryable' => false,
      'exclude_from_search' => true,
      'has_archive' => false,
      'query_var' => true,
      'can_export' => true,
      'rewrite' => false,
      'menu_icon' => 'dashicons-megaphone',
      'capability_type' => 'post',
      'menu_position' => 58,
   );
   register_post_type( BROADCAST_POST_TYPE, $args );         
}	
broadcastCoreRegisterCPT();


// Register Broadcast Layout Post Type  
function broadcastLayoutCPT(){	
   $labels = array(
      'name'                => _x( 'Layouts', 'broadcast' ),
   	'singular_name'       => _x( 'Layout', 'broadcast' ),
   	'menu_name'           => __( 'Layout', 'broadcast' ),
   	'name_admin_bar'      => __( 'Layouts', 'broadcast' ),
   	'parent_item_colon'   => __( 'Parent Layout:', 'broadcast' ),
   	'all_items'           => __( 'Layouts', 'broadcast' ),
   	'add_new_item'        => __( 'Add New Layout', 'broadcast' ),
   	'add_new'             => __( 'Add New', 'broadcast' ),
   	'new_item'            => __( 'New Layout', 'broadcast' ),
   	'edit_item'           => __( 'Edit Layout', 'broadcast' ),
   	'update_item'         => __( 'Update Layout', 'broadcast' ),
   	'view_item'           => __( 'View Layout', 'broadcast' ),
   	'search_items'        => __( 'Search Layouts', 'broadcast' ),
   	'not_found'           => __( 'No Layouts found', 'broadcast' ),
   	'not_found_in_trash'  => __( 'Not found in Trash', 'broadcast' ),
   );
   $args = array(
      'labels' => $labels,
      'hierarchical' => false,
      'description' => '',
      'supports' => array( 'title', 'editor'),
      'public' => false,
      'show_ui' => false,
      'show_in_menu' => false,
      'show_in_nav_menus' => false,
      'publicly_queryable' => false,
      'exclude_from_search' => true,
      'has_archive' => false,
      'query_var' => true,
      'can_export' => true,
      'rewrite' => false,
      'menu_icon' => '',
      'capability_type' => 'post'
   );
   register_post_type( BROADCAST_LAYOUT_POST_TYPE, $args );         
}	
broadcastLayoutCPT();
