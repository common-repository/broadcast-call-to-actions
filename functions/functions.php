<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly   
   
   
// Link URL
function broadcast_url(){
	global $post;
	echo get_post_meta( $post->ID, 'broadcast_url', TRUE );
}
function get_broadcast_url(){
	global $post;
   $return = '';
   if($post->ID){
      $return = get_post_meta( $post->ID, 'broadcast_url', TRUE );
   }
   return $return;
}



// Target
function broadcast_target(){
	global $post;
   if($post->ID){
      echo get_post_meta( $post->ID, 'broadcast_target', TRUE );
   }
}
function get_broadcast_target(){
	global $post;
   $return = '';
   if($post->ID){
      $return = get_post_meta( $post->ID, 'broadcast_target', TRUE );
   }
   return $return;
}



// Label
function broadcast_label(){
	global $post;
   if($post->ID){
      echo get_post_meta( $post->ID, 'broadcast_label', TRUE );
   }
}
function get_broadcast_label(){
	global $post;
   $return = '';
   if($post->ID){
      $return = get_post_meta( $post->ID, 'broadcast_label', TRUE );
   }
   return $return;
}



// Button
function broadcast_button(){
	global $post;
	$return = '';
   if($post->ID){
      $link = get_post_meta( $post->ID, 'broadcast_url', TRUE );
      $label = get_post_meta( $post->ID, 'broadcast_label', TRUE );
      $target = get_post_meta( $post->ID, 'broadcast_target', TRUE );      
      $target = isset($target) ? $target : '_self';
      
      if($link){
	      $return .= '<div class="broadcast-button button">';
	      $return .= '<a href="'. $link .'" target="'. $target .'">';
	      
	      if(isset($label) && !empty($label)) $return .= $label;
	      
	      $return .= '</a>';	      
	      $return .= '</div>';
      }
   }
   echo $return;
}



/*
 * Editting Options
 * Add edit CTA / Layout buttons + styling.
 */
function broadcast_get_edit_options($counter, $atts){
   $output = '';
   $output .= '<div class="broadcast-edit">';
   $output .= '<a href="'. get_admin_url() .'post.php?post='. $atts['cta'] .'&action=edit">'. __('Edit CTA', 'broadcast') .'</a>';
   
   $output .= '<a href="'. get_admin_url() .'edit.php?post_type=broadcast&page=layouts&layout='. $atts['layout'] .'">'. __('Edit Layout', 'broadcast') .'</a>';
   $output .= '</div>';
      
   if($counter == 1){
      $output .= '<style>/* 
                   * Edit CTA styles.
                   *
                   * Admin Only Styles
                   */
                  .broadcast-cta .broadcast-edit{
                  	position: relative;
                  	bottom: 0;
                  	right: 0;
                  	font-size: 12px;
                  	display: inline-block;
                  	width: 100%;
                  	visibility: hidden;
                  	opacity: 0;
                  	transition: all 0.15s ease;
                  	text-decoration: none;
                  	text-align: right;
                  	padding: 5px 0 0;
                  	width: 100%;
                     text-align: center;     
                  }
                  	.broadcast-cta:hover .broadcast-edit{
                  		visibility: visible;
                  		opacity: 1;	
                  	}
                  	.broadcast-cta .broadcast-edit a{
                        display: inline-block;
                        vertical-align: top;	
                        line-height: 24px;
                        height: 24px;
                        padding: 0;	
                        margin: 5px;
                        font-size: 12px;                
                        text-decoration: none;
                        border: none;
                        -webkit-box-shadow: none;
                        -moz-box-shadow: none;
                        box-shadow: none;
                  	}
                  	.broadcast-cta:hover .broadcast-edit a:hover{
                  		text-decoration: underline;
                  	}
                  </style>';
   } 
   return $output;
}
