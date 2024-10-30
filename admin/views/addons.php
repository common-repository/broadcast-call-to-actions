<div class="broadcast-wrapper">
   <div class="inner">
      <div class="broadcast-header">
         <h1>
            <span><?php echo BROADCAST_TITLE; ?></span>: <?php _e('Add-ons', 'broadcast'); ?>
            <em><?php _e('Add-ons are available to extend and enhance the core functionality of Broadcast.
', 'broadcast'); ?></em>
         </h1>
      </div>
      <div class="broadcast-content">
         <div class="two-third">
            <div class="postbox">
               <h3 class="title"><?php _e('Available Add-ons', 'broadcast'); ?></h3>               
               <div class="inside help">
   			  
                  <div class="broadcast-addon<?php if (has_action('alm_cache_installed')){echo ' --installed'; } ?>">
                     <?php $campaign_url = 'https://connekthq.com/plugins/ajax-load-more/add-ons/cache/?utm_source=WP%20Admin&utm_medium=ALM%20Add-ons&utm_campaign=Cache'; ?>
                     <a href="<?php echo $campaign_url; ?>">
                        <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=600%C3%97350&w=600&h=350" />
                        <div class="details">
                           <h2>Layout Templates</h2>
                           <p class="holla">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                           <p>Mattis consectetur purus sit amet fermentum. Cras mattis consectetur purus sit amet fermentum. Vivamus sagittis lacus vel augue laoreet rutrum faucibus.</p>
                        </div>
                     </a>
                     <?php unset($campaign_url); ?>
                  </div>
                  
                  <div class="broadcast-addon<?php if (has_action('alm_cache_installed')){echo ' --installed'; } ?>">
                     <?php $campaign_url = 'https://connekthq.com/plugins/ajax-load-more/add-ons/cache/?utm_source=WP%20Admin&utm_medium=ALM%20Add-ons&utm_campaign=Cache'; ?>
                     <a href="<?php echo $campaign_url; ?>">
                        <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=600%C3%97350&w=600&h=350" />
                        <div class="details">
                           <h2>Layout Templates</h2>
                           <p class="holla">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                           <p>Mattis consectetur purus sit amet fermentum. Cras mattis consectetur purus sit amet fermentum. Vivamus sagittis lacus vel augue laoreet rutrum faucibus.</p>
                        </div>
                     </a>
                     <?php unset($campaign_url); ?>
                  </div>
                     
               </div>                  
            </div>
         </div>	      
         
         <aside class="one-third sidebar">                        
            <?php include_once(BROADCAST_PATH .'admin/includes/cta/about.php'); ?>
            <?php include_once(BROADCAST_PATH .'admin/includes/cta/plugins.php'); ?>                                         
         </aside>
         
      </div>      
   </div>
</div>
