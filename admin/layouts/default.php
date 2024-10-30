<a href="<?php broadcast_url(); ?>" target="<?php broadcast_target(); ?>" class="default-cta">   
   <?php if ( has_post_thumbnail() ) {
      the_post_thumbnail('broadcast-cta');
   }?>   
   <h3><?php the_title(); ?></h3>
   <?php the_content(); ?>
   <p class="broadcast-button">
      <?php broadcast_label(); ?>
   </p>
</a>