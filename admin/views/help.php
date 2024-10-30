<div class="broadcast-wrapper">
   <div class="inner">
      <div class="broadcast-header">
         <h1>
            <span><?php echo BROADCAST_TITLE; ?></span>: <?php _e('Help', 'broadcast'); ?>
            <em><?php _e('A quick start guide to getting started with Broadcast', 'broadcast'); ?>.</em>
         </h1>
      </div>
      <div class="broadcast-content">
         <div class="two-third">
            <form action="options.php" method="post" id="broadcast-settings-form">
               <div class="postbox">
                  <h3 class="title"><?php _e('Quick Start Guide', 'broadcast'); ?></h3>               
                  <div class="inside help">
                     <p><?php _e('With Broadcast, there is essentially 3 steps to getting your call to action displayed', 'broadcast'); ?>.</p>
                     
                     <ol class="steps-intro">
	                     <li><a href="#step-1"><?php _e('Create Call to Action', 'broadcast'); ?></a></li>
	                     <li><a href="#step-2"><?php _e('Create Layout', 'broadcast'); ?></a></li>
	                     <li><a href="#step-3"><?php _e('Add Broadcast Shortcode to Page', 'broadcast'); ?></a></li>
                     </ol>
                     
							<div class="spacer-offset" id="step-1"></div>
                     <div class="steps one">
                        <h3><strong>1</strong> Create Call to Action</h3>
                        <img src="<?php echo BROADCAST_URL .'/admin/assets/img/help/broadcast-help-1.png'; ?>" />
                        
                        <div class="steps-wrap">
	                        <p>Visit the <a href="edit.php?post_type=broadcast">Call to Actions</a> dashboard and create a new CTA like you would any other WordPress post or page.</p>
	                        <p class="small">You can enter a title, add some content and select a featured image - don't forget to attach some link data in the Broadcast custom fields located below the content editor.</p>
                        </div>
                        
	                     <p class="broadcast-meta-callout">You can disable Broadcast custom fields on the <a href="edit.php?post_type=broadcast&page=dashboard">Dashboard</a>.</p>
                     </div>
                     
                     <div class="spacer-offset" id="step-2"></div>
                     <div class="steps two">
                        <h3><strong>2</strong> Create Layout</h3>
                        <img src="<?php echo BROADCAST_URL .'/admin/assets/img/help/broadcast-help-2.png'; ?>" />
                        
                        <div class="steps-wrap">
	                        <p>Visit the <a href="edit.php?post_type=broadcast&page=layouts">Layouts</a> dashboard and create a new layout for displaying the call to action you created in Step 1.</p>
	                        <p class="small">A layout is used to display CTA data and will contain a mixture of HTML, PHP and core WordPress functions such as <em>the_title()</em>, <em>the_content()</em>, <em>the_post_thumbnail()</em> etc.</p>
                        </div>
                        
	                     <p class="broadcast-meta-callout">Layouts allow you to create multiple views for the same call the action.</p>
                     </div>
                     
                     <div class="spacer-offset" id="step-3"></div>
                     <div class="steps three">
                        <h3><strong>3</strong> Add Broadcast Shortcode to Page</h3>
                        <img src="<?php echo BROADCAST_URL .'/admin/assets/img/help/broadcast-help-3.png'; ?>" />
                        
                        <div class="steps-wrap">
	                        <p>Build a <em>[broadcast]</em> shortcode and add the shortcode to a content editor or directly to a template file using the <em><a href="https://developer.wordpress.org/reference/functions/do_shortcode/" target="_blank">do_shortcode()</a></em> method.</p>
	                        <p class="small">Don't worry, building a custom Broadcast shortcode is really easy with the   <a href="edit.php?post_type=broadcast&page=dashboard#broadcast-builder">shortcode builder</a> located on the <a href="edit.php?post_type=broadcast&page=dashboard">dashboard</a> and on post/page edit screens.</p>	                        
                        </div>
                        
	                     <p class="broadcast-meta-callout">Defining a <em>cta</em> and <em>layout</em> parameter for each shortcode is required or the call to action will not be displayed.</p>
	                     
                     </div>
                     
                  </div>
               </div>
            </form>		
         </div>         
         
         <aside class="one-third sidebar">                        
            <?php include_once( BROADCAST_PATH . 'admin/includes/cta/functions.php'); ?>
            <?php include_once( BROADCAST_PATH . 'admin/includes/cta/dyk-css.php'); ?>
            <?php include_once( BROADCAST_PATH . 'admin/includes/cta/writeable.php'); ?>                                          
         </aside>         
         
      </div>      
   </div>
</div>
