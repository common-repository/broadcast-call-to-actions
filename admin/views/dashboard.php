<div class="broadcast-wrapper">
   <div class="inner">
      <div class="broadcast-header">
         <h1>
            <span><?php echo BROADCAST_TITLE; ?></span>: <?php _e('Dashboard', 'broadcast') ;?>
            <em><?php _e('A call to action management plugin for WordPress.', 'broadcast') ;?></em>
         </h1>
      <?php if( isset($_GET['settings-updated']) ) { ?>
          <div id="message" class="updated inline">
              <p><strong><?php _e('Broadcast settings have been saved.') ?></strong></p>
          </div>
      <?php } ?>
      </div>
      <div class="broadcast-content">
         <div class="two-third">            
            <div class="postbox">
               <form action="options.php" method="post" id="broadcast-settings-form">
                  <h3 class="title"><?php _e('General Settings', 'broadcast'); ?></h3>               
                  <div class="inside">                     
            			<?php 
         				settings_fields( 'broadcast-setting-group' );
         				do_settings_sections( 'broadcast' );	
         				//get the older values, wont work the first time
         				$options = get_option( 'broadcast_settings' ); ?>	 
                  </div>
                  <div id="major-publishing-actions">
                     <button style="margin-left: 4px;" type="submit" class="button button-primary"><?php _e('Save Settings', 'broadcast'); ?></button>
                     <div class="save-settings"></div>
                  </div>
               </form>
            </div>
            <div class="postbox" id="broadcast-builder">	
               <h3 class="title"><?php _e('Shortcode Builder', 'broadcast'); ?></h3>
               <div class="inside">
                  <?php include_once(BROADCAST_PATH .'admin/includes/shortcode-builder.php'); ?>
               </div>
            </div>	
         </div>
         
         <aside class="one-third sidebar">                        
            <?php include_once(BROADCAST_PATH .'admin/includes/cta/about.php'); ?>
            <?php include_once( BROADCAST_PATH . 'admin/includes/cta/writeable.php'); ?> 
            <?php include_once(BROADCAST_PATH .'admin/includes/cta/plugins.php'); ?>                                        
         </aside>
         
      </div>      
      <div class="loading"></div>
   </div>
</div>
