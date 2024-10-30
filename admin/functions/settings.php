<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'admin_init', 'broadcast_settings');

function broadcast_settings(){

	register_setting( 
		'broadcast-setting-group', 
		'broadcast_settings', 
		'broadcast_sanitize_settings' 
	);
	
	add_settings_section( 
		'broadcast_general_settings',  
		'', 
		'broadcast_general_settings_callback', 
		'broadcast' 
	);	
	
	add_settings_field( // CSS
	    'broadcast_css',
	    __('Disable CSS', 'broadcast' ),
	    'broadcast_css_callback',
	    'broadcast',
	    'broadcast_general_settings'
	);
	
	add_settings_field( // Edit Buttons
	    'broadcast_edit_buttons',
	    __('Edit CTA/Layout Buttons', 'broadcast' ),
	    'broadcast_edit_buttons_callback',
	    'broadcast',
	    'broadcast_general_settings'
	);
	
	add_settings_field( // Post Meta Fields
	    'broadcast_post_meta',
	    __('Link Fields', 'broadcast' ),
	    'broadcast_post_meta_callback',
	    'broadcast',
	    'broadcast_general_settings'
	);	
	
	add_settings_field(  // Hide btn
		'broadcast_hide_btn', 
		__('WYSIWYG Button', 'ajax-load-more' ), 
		'broadcast_hide_btn_callback', 
		'broadcast', 
		'broadcast_general_settings' 
	);

}


/*
*  broadcast_sanitize_settings
*  Sanitize our form fields
*
*  @since 1.0
*/

function broadcast_sanitize_settings( $input ) {
    return $input;
}

/*
*  broadcast_general_settings_callback
*  Some general settings text
*
*  @since 1.0
*/

function broadcast_general_settings_callback() {
    echo '<p>' . __('Customize your Broadcast installation by adjusting the following settings', 'broadcast') . ':</p>';
}



/*
*  broadcast_css_callback
*  Disable Broadcast CSS.
*
*  @since 1.0
*/

function broadcast_css_callback(){
	$options = get_option( 'broadcast_settings' );
	if(!isset($options['broadcast_css'])) 
	   $options['broadcast_css'] = '0';
	
	$html = '<label class="checkbox" for="broadcast_disable_css_input">'.__('I want to use my own CSS styles.', 'broadcast').'<br/><span style="display:block;"><i class="fa fa-file-text-o"></i> &nbsp;<a href="'.BROADCAST_URL.'/core/css/broadcast.css" target="blank">'.__('View Broadcast CSS', 'broadcast').'</a></span>';
   
	$html .= '<input type="hidden" name="broadcast_settings[broadcast_css]" value="0" />';
   $html .= '<input type="checkbox" id="broadcast_disable_css_input" name="broadcast_settings[broadcast_css]" value="1"'. (($options['broadcast_css']) ? ' checked="checked"' : '') .' />';

	$html .= '</label>';
	echo $html;
}


/*
*  broadcast_post_meta_callback
*  Display post meta on call to action screens.
*
*  @since 1.0
*/

function broadcast_post_meta_callback(){
	$options = get_option( 'broadcast_settings' );
	if(!isset($options['broadcast_post_meta'])) 
	   $options['broadcast_post_meta'] = '0';
	
	$html = '<label class="checkbox" for="broadcast_post_meta_input">';
	
	$html .= __('Hide Broadcast custom fields (<em>url, label and target</em>) when creating call to actions.', 'broadcast');   
	$html .= '<span style="display:block;">'. __('This is useful when using another plugin to manage custom field data.', 'broadcast') .'<br/>e.g. Advanced Custom Fields.</span>';
   $html .= '<input type="hidden" name="broadcast_settings[broadcast_post_meta]" value="0" />';
	$html .= '<input type="checkbox" id="broadcast_post_meta_input" name="broadcast_settings[broadcast_post_meta]" value="1"'. (($options['broadcast_post_meta']) ? ' checked="checked"' : '') .' />';

	$html .= '</label>';
	
	echo $html;
}



/*
*  broadcast_hide_btn_callback
*  Disable the Broadcast shortcode button in the WordPress content editor
*
*  @since 1.0
*/

function broadcast_hide_btn_callback(){
	$options = get_option( 'broadcast_settings' );
	if(!isset($options['broadcast_hide_btn'])) 
	   $options['broadcast_hide_btn'] = '0';
	
	$html = '<label class="checkbox" for="broadcast_hide_btn">';
	
	$html .= __('Hide the Broadcast shortcode builder button in WordPress content editor.', 'broadcast');	
	$html .= '<span style="display: block;">'.__('You can still <a href="#broadcast-builder">build shortcodes</a> from the Broadcast admin.', 'broadcast') .'</span>';	
	$html .= '<input type="hidden" name="broadcast_settings[broadcast_hide_btn]" value="0" /><input type="checkbox" id="broadcast_hide_btn" name="broadcast_settings[broadcast_hide_btn]" value="1"'. (($options['broadcast_hide_btn']) ? ' checked="checked"' : '') .' />';
	
	$html .= '</label>';	
	
	echo $html;
}



/*
*  broadcast_edit_buttons_callback
*  Hide the CTA/Layout edit button on the frontend
*
*  @since 1.0
*/

function broadcast_edit_buttons_callback(){
	$options = get_option( 'broadcast_settings' );
	if(!isset($options['broadcast_edit_buttons'])) 
	   $options['broadcast_edit_buttons'] = '0';
	
	$html = '<label class="checkbox" for="broadcast_edit_buttons">';
	
	$html .= __('Hide the [Edit CTA] and [Edit Layout] buttons for editors on the front-end of the website.', 'broadcast');	
	$html .= '<span style="display: block;">'.__('If unchecked, editors will be able to click links to directly edit CTA data.', 'broadcast') .'</span>';	
	$html .= '<input type="hidden" name="broadcast_settings[broadcast_edit_buttons]" value="0" /><input type="checkbox" id="broadcast_edit_buttons" name="broadcast_settings[broadcast_edit_buttons]" value="1"'. (($options['broadcast_edit_buttons']) ? ' checked="checked"' : '') .' />';
	
	$html .= '</label>';	
	
	echo $html;
}



