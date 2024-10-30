<div class="broadcast-wrapper">
   <div class="inner">
      <div class="broadcast-header">
         <h1>
            <span><?php echo BROADCAST_TITLE; ?></span>: <?php _e('Layouts', 'broadcast');?> 
            <em><?php _e('Create and manage your call to action layouts.', 'broadcast');?></em>
         </h1>       
      </div>      
      
      <div class="broadcast-content">
         <div class="two-third">
            <div class="postbox">
               <h3 class="title"><?php _e('Your Layouts', 'broadcast'); ?></h3>
               <div id="broadcast-layout-wrap">
                  <div class="inside">                     
                     <!-- Selection -->
                     <div id="broadcast-layout-selection">
                        
                        <div class="layout-intro">
                           <p><?php _e('Layouts are used to display <a href="edit.php?post_type=broadcast">call to action</a> content on the front-end of your website. They typically contain a mixture of HTML, PHP and core WordPress functions such as <em>the_title()</em>, <em>the_content()</em>, <em>the_post_thumbnail()</em> etc.', 'broadcast'); ?></p>
                           
                           <?php include BROADCAST_PATH . '/admin/includes/layout-list.php'; ?>
                                                
                        </div>                     
                        
                        <ul class="layout-menu" id="broadcast-layout-menu">
                           <!-- Table Header -->
                           <li class="first">
                              <input type="checkbox" value="all" class="broadcast-select-all" id="all">
                              <h3><?php _e('Title', 'broadcast'); ?></h3>
                              <span><?php _e('Date', 'broadcast'); ?></span>
                           </li>
                           <!-- End Table Header -->
                           <?php 
                           $args = array(
                             'post_type'        => BROADCAST_LAYOUT_POST_TYPE, 
                             'post_status'      => 'publish', 
                             'order'            => 'DESC',
                             //'orderby'          => 'menu_order', 
                             'posts_per_page'   => -1, 
                           );    
                           $wp_query = new WP_Query( $args );
                           if ($wp_query->have_posts()) : ?>                         
                              <?php 
                              while ($wp_query->have_posts()): $wp_query->the_post();
                                 include BROADCAST_PATH . '/admin/includes/layout-item.php';
                              endwhile; wp_reset_query();?>               
                           </ul>
                           
                           <?php else : ?>
                           <li class="empty">
                              <h3><?php _e('You have not created any layouts!', 'broadcast'); ?></h3>
                              <div class="actions">
                                 <span><?php _e('No worries, click the \'<strong>Add New Layout</strong>\' button above to create your very first Broadcast layout', 'broadcast'); ?>.</span>
                              </div>
                           </li>
                           <?php endif; ?>
                        </ul>
                        
                     </div>
                     <!-- End Selection --> 
                     
                     <!-- Edit Template -->
                     <div id="broadcast-layout-editor">
                        <div class="inner">
                           <a class="close" href="javascript:void(0);" title="<?php _e('Close Layout Editor', 'broadcast'); ?>">&times;</a>
                           <div class="layout-inputs">
                              <div class="layout-form-wrap">
                                 <input type="text" value="" id="broadcast-id" class="id disabled" hidden="hidden">
                                 <label for="broadcast-title"><i class="fa fa-pencil"></i> <?php _e('Title', 'broadcast');?></label>
                                 <input type="text" value="" id="broadcast-title" class="title" placeholder="<?php _e('Layout Title', 'broadcast');?>">
                              </div>
                              
                              <div class="clear"></div>
                              
                              <div class="layout-form-wrap markup">
                                 <label for="broadcast-textarea"><i class="fa fa-file-code-o"></i> <?php _e('Template', 'broadcast');?></label>
                                 <div class="textarea-wrap">
                                    <textarea rows="10" id="broadcast-textarea"></textarea>
                                 </div>
                              </div>
                              
                              <button type="button" class="button button-primary" id="broadcast-save"><?php _e('Save Layout', 'broadcast'); ?></button>        
                              <img class="saving" src="<?php echo BROADCAST_URL; ?>/admin/assets/img/spinner-2x.gif" width="20" height="20" />
                              <a class="cancel" href="javascript:void(0);"><?php _e('Cancel', 'broadcast');?></a>   
                               
                           </div>
                        </div>
                     </div>
                     <!-- End Edit Template -->                                             
                  </div>       
                  <div class="loading"></div>            
               </div> 
                        
            </div>
            
            <!-- Bulk Actions -->
            <div class="broadcast-bulk-actions">
	            <select id="broadcast-bulk-selection" name="broadcast-bulk">
	               <option value="-1"><?php _e('Bulk Actions', 'broadcast'); ?></option>
	               <option value="trash"><?php _e('Delete Layouts', 'broadcast'); ?></option>
	            </select>
	            <button type="submit" class="button action broadcast-delete-selected"><?php _e('Apply', 'broadcast'); ?></button>
            </div>
            <!-- End Bulk Actions -->
         </div>
         
         <!-- Sidebar -->
         <aside class="one-third sidebar">            
            
            <?php include_once( BROADCAST_PATH . 'admin/includes/cta/cta-listing.php'); ?>
            <?php //include_once( BROADCAST_PATH . 'admin/includes/cta/functions.php'); ?>
               
         </aside>
         
      </div>
      
   </div>

</div>