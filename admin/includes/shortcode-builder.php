
<p><?php _e('Create a custom Broadcast shortcode by selecting a call to action and layout', 'broadcast'); ?>:</p>

<div class="broadcast-builder">
   <?php 
   $cta_args = array(
     'post_type'        => BROADCAST_POST_TYPE, 
     'post_status'      => 'publish',
     'order'            => 'ASC',
     'orderby'          => 'menu_order', 
     'posts_per_page'   => -1, 
   );    
   $cta_query = new WP_Query( $cta_args );
   ?>  
   
   <div class="item"> 
      <div class="item-inner">      
         <label for="broadcast-cta-selection"><?php _e('Call to Action', 'broadcast'); ?> <a href="javascript:void(0)" class="fa fa-question-circle tooltip" title="<?php _e('Select a Call to Action from the list','broadcast'); ?>."></a></label>
         <div class="action-wrap">
            <select id="broadcast-cta-selection" class="chosen-select">
               <option selected="selected" value="">-- <?php _e('Select CTA', 'broadcast'); ?> --</option>
               <?php while ($cta_query->have_posts()): $cta_query->the_post(); ?>
               <option value="<?php echo $cta_query->post->ID; ?>"><?php the_title(); ?> <em>[<?php echo $cta_query->post->ID; ?>]</em></option>
               <?php endwhile; wp_reset_query();?>
            </select>  
            <?php if(!$cta_query){ ?>            
            <p class="broadcast-meta-callout" style="margin: 20px 0 0; font-size: 12px;"><?php _e('You need to <a href="post-new.php?post_type=broadcast" target="_parent">create a CTA</a> before you can build a shortcode.', 'broadcast'); ?></p>
            <?php } ?>  
         </div>
      </div>
   </div> 
   
   <?php 
   $layout_args = array(
     'post_type'        => BROADCAST_LAYOUT_POST_TYPE, 
     'post_status'      => 'publish', 
     'order'            => 'DESC',
     'orderby'          => 'menu_order', 
     'posts_per_page'   => -1, 
   );    
   $layout_query = new WP_Query( $layout_args ); ?> 
    
   <div class="item">       
      <div class="item-inner">
         <label for="broadcast-layout-selection"><?php _e('Layout', 'broadcast'); ?> <a href="javascript:void(0)" class="fa fa-question-circle tooltip" title="<?php _e('Select a Layout from the list','broadcast'); ?>."></a></label>
         <div class="action-wrap">
            <select id="broadcast-layout-selection" class="chosen-select">
               <option selected="selected" value="">-- <?php _e('Select Layout', 'broadcast'); ?>--</option>
               <?php while ($layout_query->have_posts()): $layout_query->the_post(); ?>
               <option value="<?php echo $layout_query->post->ID; ?>"><?php the_title(); ?></option>
               <?php endwhile; wp_reset_query();?>
            </select> 
            <?php if(!$layout_query){ ?>            
            <p class="broadcast-meta-callout" style="margin: 20px 0 0; font-size: 12px;"><?php _e('You need to <a href="edit.php?post_type=broadcast&page=layouts" target="_parent">create a Layout</a> before you can build a shortcode.', 'broadcast'); ?></p>
            <?php } ?>    
         </div>
      </div>
   </div> 
   
   <div class="item small">   
      <div class="item-inner">    
         <label for="broadcast-cta-align"><?php _e('Align', 'broadcast'); ?> <a href="javascript:void(0)" class="fa fa-question-circle tooltip" title="<?php _e('Select an alignment for the call to action. (default = left)','broadcast'); ?>"></a></label>
         <div class="action-wrap">
            <select id="broadcast-cta-align" class="chosen-select">
               <option selected="selected" value="left"><?php _e('Left', 'broadcast'); ?></option>
               <option value="center"><?php _e('Center', 'broadcast'); ?></option>
               <option value="right"><?php _e('Right', 'broadcast'); ?></option>
            </select> 
         </div> 
      </div>  
   </div> 
   
   <div class="item small">   
      <div class="item-inner">    
         <label for="broadcast-cta-width"><?php _e('Width', 'broadcast'); ?> => <em style="opacity: 0.7; font-weight: 400;"><span id="brocast_perc"></span>(%)</em> <a href="javascript:void(0)" class="fa fa-question-circle tooltip" title="<?php _e('Enter the desired width of the call to action container. (default = 50%)','broadcast'); ?>"></a></label>
         <div class="action-wrap">
         	<input id="broadcast-cta-width" type="range" min="1" max="100" step="1" value="50">
         </div>
      </div>
   </div>      
   
   <div class="item small">   
      <div class="item-inner">    
         <label for="broadcast-classes"><?php _e('Classes', 'broadcast'); ?> <a href="javascript:void(0)" class="fa fa-question-circle tooltip" title="<?php _e('Add custom classes to the Broadcast container element','broadcast'); ?>."></a></label>
         <div class="action-wrap">
         	<input id="broadcast-classes" type="text" placeholder="my_class">
         </div>
      </div>
   </div>  
   
   <div class="output-wrap">
      <div class="output-wrap-inner">
         <div id="shortcode-output"></div>
         <a class="copy-shortcode" href="javascript:void(0);">
            <i class="fa fa-plus-circle"></i> <?php _e('Copy', 'broadcast'); ?>
         </a>
         <a class="insert-shortcode" href="javascript:void(0);" onclick="javascript:CallToActionModal.insert(CallToActionModal.local_ed)">
            <i class="fa fa-plus-circle"></i> <?php _e('Insert CTA', 'broadcast'); ?>
         </a>
      </div>
   </div>
</div>