<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$layouts = array(
   array(
      'title' => __('Default', 'broadcast'),
      'file'  => BROADCAST_PATH .'admin/layouts/default.php'
   ),
   array(
      'title' => __('Blank', 'broadcast'),
      'file'  => BROADCAST_PATH .'admin/layouts/blank.php'
   ),
);
?>
<div class="add-layout" data-path="<?php echo BROADCAST_URL; ?>">
   <div class="btn">
       <a href="javascript:void(0);" class="button button-primary button-large">
          <?php _e('Add New Layout', 'broadcast'); ?> &nbsp; <i class="fa fa-caret-down"></i><i class="fa fa-close"></i>
       </a>
       <div class="broadcast-dropdown">         
         <ul class="the-layouts">
            <?php foreach($layouts as $layout){
               $tmpl = BROADCAST_PATH. 'admin/includes/layout-list-template.php';
               include $tmpl;
            } ?>
            <?php
               if(has_action('broadcast_templates')){ 
                  do_action('broadcast_templates');  
               }
            ?>
         </ul> 
         <?php
            /*
            if(!has_action('broadcast_templates')){ 
               echo '<ul class="get_more">';
               echo '<li><a href="https://connekthq.com/plugins/broadcast/add-ons/templates/" target="_blank"><i class="fa fa-plus-circle" aria-hidden="true"></i>'. __('Get More Templates', 'broadcast'). '</a></li>';
               echo '</ul>';
            } 
            */
            echo '<ul class="get_more temp">';
            echo '<li><i class="fa fa-fire" aria-hidden="true"></i>'. __('More Coming Soon', 'broadcast'). '</li>';
            echo '</ul>';
         ?> 
                    
      </div>
   </div>                    
</div>