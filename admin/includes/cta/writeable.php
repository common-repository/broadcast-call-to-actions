<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="postbox">
	<h3>
   	<?php _e('Read/Write Access', 'broadcast'); ?>
      <a href="javascript:void(0)" class="fa fa-question-circle tooltip" title="<?php _e('Broadcast is required to write layout templates to the /uploads/broadcast directory on your server.','broadcast'); ?>"></a>
   </h3>
	<div class="inside">
   <?php
      // If directory does NOT exist, create it
      if(!is_dir(BROADCAST_UPLOAD_PATH)){
         mkdir(BROADCAST_UPLOAD_PATH);
      }
      // Does directory exist and is it writeable
      if (is_writable(BROADCAST_UPLOAD_PATH)) {
         echo '<p class="writeable-access"><i class="fa fa-check-circle"></i>';
         echo __('<strong>It\'s all good!</strong><br/>Read/Write access is enabled within the <code>uploads/broadcast</code> directory.', 'broadcast');
         echo '</p>';
      }
      else{      
         echo '<p class="writeable-access"><i class="fa fa-exclamation-circle"></i>';   	    
         echo __('<strong>Access Denied!</strong><br/>To save layout template data you must enable read and write access for the <code>uploads/broadcast</code> directory of your WordPress installation.<br/><br/>Please contact your hosting provider or site administrator for more information.', 'broadcast');
         echo '</p>';
      }
   ?>   
   </div>
</div>