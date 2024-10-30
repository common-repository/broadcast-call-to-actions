<div class="postbox">
   <h3><?php _e('Your Call to Actions', 'broadcast'); ?></h3>
   <div class="inside">
   <?php 
   $hasCtas = false;   
   $cta_args = array(
     'post_type'        => BROADCAST_POST_TYPE, 
     'post_status'      => 'publish',
     'order'            => 'DESC',
     'orderby'          => 'date', 
     'posts_per_page'   => -1, 
   );    
   $cta_query = new WP_Query( $cta_args );
   if ($cta_query->have_posts()) : 
   $hasCtas = true;
   ?>  
   <ul class="cta-list">
      <?php while ($cta_query->have_posts()): $cta_query->the_post(); ?>
      <li>
         <?php the_title(); ?>
         <span>
            <i class="fa fa-calendar"></i> <?php the_time(get_option( 'date_format' ) ); ?>
            <a class="edit" href="post.php?post=<?php echo $cta_query->post->ID; ?>&action=edit">[<?php _e('edit', 'broadcast'); ?>]</a>
         </span>
      <?php endwhile; wp_reset_query();?>
   </ul>                   
   <?php else : ?>
   <p class="broadcast-alert"><strong><?php _e('It appears that you haven\'t created any call to actions yet', 'broadcast'); ?>!</strong>
   <button type="button" class="button button-large" onclick="window.location='post-new.php?post_type=broadcast'; return false;"><i class="fa fa-arrow-circle-right"></i> <?php _e('Create One Now!', 'broadcast'); ?></button>
   </p>                  
   <?php endif; ?>                  
   </div>
   <?php if($hasCtas){ ?>
   <div id="major-publishing-actions">
      <button style="margin-left: 4px;" type="button" class="button button-secondary" onclick="window.location='post-new.php?post_type=broadcast'; return false;"><?php _e('Create Call to Action', 'broadcast'); ?></button>
   </div>
   <?php } ?>
</div>