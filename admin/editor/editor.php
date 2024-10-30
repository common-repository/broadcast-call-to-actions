<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


//Check for permissions
add_action('wp_ajax_broadcast_lightbox', 'broadcast_ajax_tinymce' );
function broadcast_ajax_tinymce(){
	// check for rights
	if ( ! current_user_can('edit_pages') && ! current_user_can('edit_posts') )
		die( __("You are not allowed to be here", 'broadcast') );
	$window = dirname(__FILE__) . '/editor-build.php';
	include_once( $window );
	die();
}

// filter the tinyMCE buttons and adds our custom buttons
add_action('admin_head', 'broadcast_shortcode_button');
function broadcast_shortcode_button() {   
   $screen = get_current_screen();
	
	// Don't bother doing this stuff if the current user lacks permissions or is on the Broadcast page
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') || in_array( $screen->id, array( 'broadcast')) )
		return;	
		
	// Check options for hiding shortcode builder	
   $options = get_option( 'broadcast_settings' );   
   if(!isset($options['broadcast_hide_btn'])) // Check if 'broadcast_hide_btn isset
	   $options['broadcast_hide_btn'] = '0';
   
	if($options['broadcast_hide_btn'] != '1'){	
		if ( get_user_option('rich_editing') == 'true') {
			// filter the tinyMCE buttons and add our own
			add_filter("mce_external_plugins", "broadcast_tinymce_plugin");
			add_filter('mce_buttons', 'broadcast_friendly_buttons');
		}
	}
}

// registers the buttons for use
function broadcast_friendly_buttons($buttons) {
	array_push($buttons, 'broadcast_shortcode_button');
	return $buttons;
}

// add the button to the tinyMCE bar
function broadcast_tinymce_plugin($plugin_array) {	
	$plugin_array['broadcast_shortcode_button'] = plugins_url( '/js/editor-btn.js' , __FILE__ );
	return $plugin_array;
}