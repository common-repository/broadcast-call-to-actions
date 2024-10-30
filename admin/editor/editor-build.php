<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Broadcast - Insert Call to Action</title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" src="<?php echo includes_url(); ?>js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></link>
<link rel="stylesheet" href="<?php echo BROADCAST_URL; ?>/admin/assets/css/admin.css" />
<link rel="stylesheet" href="<?php echo BROADCAST_URL; ?>/admin/assets/css/tooltipster/tooltipster.css" />
<link rel="stylesheet" href="<?php echo BROADCAST_URL; ?>/admin/assets/css/chosen.css" />
<script type="text/javascript" src="<?php echo includes_url('/js/tinymce/tiny_mce_popup.js'); ?>"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-2.2.4.min.js"></script>

<script type="text/javascript">  
// ****** Build Button Shortcode ****** // 
var CallToActionModal = {
	local_ed : 'ed',
	init : function(ed) {
		CallToActionModal.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertButton(ed) {	 		
		tinyMCEPopup.execCommand('mceRemoveNode', false, null); // Try and remove existing style	
		output = $('#shortcode-output').text(); // setup the output of our shortcode		
		tinyMCEPopup.execCommand('mceInsertContent', false, output); // Return	
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(CallToActionModal.init, CallToActionModal); 
</script>
<?php $is_modal = true; ?>
</head>
<body id="broadcast-shortcode-builder">
   <?php include_once(BROADCAST_PATH .'admin/includes/shortcode-builder.php'); ?>
   <script type="text/javascript" src="<?php echo BROADCAST_URL; ?>/admin/assets/js/libs/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="<?php echo BROADCAST_URL; ?>/admin/assets/js/libs/rangeslider.min.js"></script>
   <script type="text/javascript" src="<?php echo BROADCAST_URL; ?>/admin/assets/js/libs/jquery.tooltipster.min.js"></script>
   <script type="text/javascript" src="<?php echo BROADCAST_URL; ?>/admin/assets/js/admin.js"></script>
</body>
</html>