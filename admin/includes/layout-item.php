<li data-id="<?php the_ID(); ?>">
   <input type="checkbox" value="<?php the_ID(); ?>" name="broadcast" id="broadcast-select-<?php the_ID(); ?>">
   <h3 data-title="<?php the_title(); ?>"><a href="javascript:void(0);" class="item"><?php the_title(); ?></a></h3>
   <div class="actions">
      <span class="id" title="<?php _e('Layout ID', 'broadcast'); ?>: <?php the_ID(); ?>">
         <i class="fa fa-tag"></i> <?php the_ID(); ?> <em>|</em> 
      </span>
      <span class="edit">
         <a href="javascript:void(0);" class="edit">
	         <strong class="edit-layout"><?php _e('Edit', 'broadcast'); ?></strong>
	         <strong class="close-layout"><?php _e('Close', 'broadcast'); ?></strong> 
	         <?php _e('Layout', 'broadcast'); ?></a> <em>|</em> 
      </span>
      <span class="trash">
         <a href="javascript:void(0);" class="remove"><?php _e('Delete', 'broadcast'); ?></a>
      </span>
   </div>
   <span class="published">
      <?php _e('Published', 'broadcast'); ?><br/><strong title="<?php the_time('Y/m/d h:i:s a '); ?>"><?php the_time('F j, Y'); ?></strong>
   </span>
</li>