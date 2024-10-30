<?php
/**
 * Broadcast shortcode
 *
 * Returns the [broadcast] shortcode.
 *
 * @author   Darren Cooney
 * @since    1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( !class_exists('BROADCAST_SHORTCODE') ):
   
   class BROADCAST_SHORTCODE {
            
      static $counter = 0; 
      
      /**
	    * broadcast_render_shortcode
	    * 
   	 * Parse & Render Shortcode.
   	 *
   	 * @since 1.0
   	 * @return $broadcast
   	 */
   	 
      public static function broadcast_render_shortcode($atts){
         
         global $wpdb; 
   		$blog_id = $wpdb->blogid; // Current blog ID
   		
   		$options = get_option( 'broadcast_settings' );
   		  		
   		self::$counter++; 
   		
   		
   		/*
	   	 *	broadcast_enqueue_scripts
	   	 *
	   	 * Broadcast Core Action Hook
	   	 *
	   	 * @return null;
	   	 */
   		do_action('broadcast_enqueue_scripts');
   		
   		
   		// Get shortcode $atts
   		$atts = shortcode_atts( array(
      		'cta'       => '',
      		'layout'    => '',
      		'align'     => 'left',
      		'width'     => '50',
      		'classes'   => null
      	), $atts, 'broadcast' );
      	
      	$cta_id = $atts['cta'];
      	$layout = $atts['layout'];
      	$align = $atts['align'];
      	$width = $atts['width'];
      	$classes = $atts['classes'];
      	$output = '';
      	
      	// Get full path to layout.
      	$layout_path = BROADCAST_UPLOAD_PATH. ''. $blog_id .'/layout_'. $layout .'.php';
			
			
			// Ensure layout exists
			if(!file_exists($layout_path) || empty($cta_id))
			   return;
				
				
			// WP_Query $args
         $args = array(
           'post__in' => array($cta_id),
           'post_type' => BROADCAST_POST_TYPE,
         );                    
         $cta_query = new WP_Query( $args );
         
         if ($cta_query->have_posts()) :
         
            $output .= '<div class="broadcast-cta broadcast-align-'.$align.' '. $classes .'" data-cta-id="'.$cta_id.'" data-cta-layout="'.$layout.'" style="width: '. $width .'%">';
            
            while ($cta_query->have_posts()): $cta_query->the_post();
               
               global $post; 
               $id = $post->ID; // Current post ID     	
               
               ob_start();
               include $layout_path;
               $output .= ob_get_contents();
               ob_end_clean();
               
            endwhile; wp_reset_query();
            
            // Edit Layout/CTA links
            if((!isset($options['broadcast_edit_buttons']) || $options['broadcast_edit_buttons'] == '0' ) && current_user_can( 'edit_posts' )){
                $output .= broadcast_get_edit_options(self::$counter, $atts);
            }
             
            $output.= '</div>';
                     
         endif;
         	
   		return $output;
      
      }
      
   }
   
endif;