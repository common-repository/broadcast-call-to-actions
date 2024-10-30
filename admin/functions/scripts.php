<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * broadcast_enqueue_admin_scripts
 * Enqueue Admin JS
 *
 * @since 1.0
 */
 
function broadcast_enqueue_admin_scripts(){
   wp_enqueue_script( 'broadcast-drops-js', BROADCAST_URL. '/admin/assets/js/libs/drops.js' );
   wp_enqueue_script( 'broadcast-rangeslider-js', BROADCAST_URL. '/admin/assets/js/libs/rangeslider.min.js' );
   wp_enqueue_script( 'broadcast-chosen-js', BROADCAST_URL. '/admin/assets/js/libs/chosen.jquery.min.js' );
   wp_enqueue_script( 'broadcast-tooltipster-js', BROADCAST_URL. '/admin/assets/js/libs/jquery.tooltipster.min.js' );
   wp_enqueue_script( 'broadcast-admin-js', BROADCAST_URL. '/admin/assets/js/admin.js' );
   
   //Load CodeMirror Syntax Highlighting if on Layout page 
   $screen = get_current_screen();
   if ( in_array( $screen->id, array( 'broadcast_page_layouts') ) ){  
      
      //CodeMirror CSS
      wp_enqueue_style( 'broadcast-cm-css', BROADCAST_URL. '/admin/assets/codemirror/lib/codemirror.css' );            
      
      //CodeMirror JS
      wp_enqueue_script( 'broadcast-cm', BROADCAST_URL. '/admin/assets/codemirror/lib/codemirror.js');    
      wp_enqueue_script( 'broadcast-cm-matchbrackets', BROADCAST_URL. '/admin/assets/codemirror/addon/edit/matchbrackets.js' );
      wp_enqueue_script( 'broadcast-cm-htmlmixed', BROADCAST_URL. '/admin/assets/codemirror/mode/htmlmixed/htmlmixed.js' );
      wp_enqueue_script( 'broadcast-cm-xml', BROADCAST_URL. '/admin/assets/codemirror/mode/xml/xml.js' );
      wp_enqueue_script( 'broadcast-cm-javascript', BROADCAST_URL. '/admin/assets/codemirror/mode/javascript/javascript.js' );
      wp_enqueue_script( 'broadcast-cm-mode-css', BROADCAST_URL. '/admin/assets/codemirror/mode/css/css.js' );
      wp_enqueue_script( 'broadcast-cm-clike', BROADCAST_URL. '/admin/assets/codemirror/mode/clike/clike.js' );
      wp_enqueue_script( 'broadcast-cm-php', BROADCAST_URL. '/admin/assets/codemirror/mode/php/php.js' );
      
      ?>
      <script type='text/javascript'>
      /* <![CDATA[ */
      var broadcast_localize = <?php echo json_encode( array( 
         'ajax_admin_url' => admin_url( 'admin-ajax.php' ),
         'broadcast_nonce' => wp_create_nonce( 'broadcast_nonce' ),
         'delete_msg' => __('Are you sure you want to delete this layout?', 'broadcast' ),
         'delete_all_msg' => __('Are you sure you want to delete the selected layouts?', 'broadcast' ),
         'editing_msg' => __('Are you sure you want to discard your layout changes?', 'broadcast' )
      )); ?>
      /* ]]> */
      </script>
      <?php
   }
   
}



/*
 * broadcast_load_admin_js
 * Enqueue scripts. Called from menu.php using add_action()
 *
 * @since 1.0
 */
 
function broadcast_load_admin_js(){
   add_action( 'admin_enqueue_scripts', 'broadcast_enqueue_admin_scripts' );
}
