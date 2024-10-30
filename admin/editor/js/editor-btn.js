(function () {
  tinymce.create('tinymce.plugins.broadcast', {
    init: function (editor, url) {
	    
      var h = document.body.clientHeight / 1.5,
      	 w = document.body.clientWidth / 1.5;
      	
      if(h > 600){
	      h = 550;
	   } else {
		   h = 420;
	   }	
      	 
      if(w > 768){
	      w = 700;
	   } else {
		   w = 550;
	   }
          
      editor.addCommand('broadcast_mcebutton', function () {
        editor.windowManager.open({
          title: "Broadcast - Insert Call to Action",
          file: ajaxurl + '?action=broadcast_lightbox', // file that contains HTML for our modal window
          width: w, // size of our window
          height: h , // size of our window
          inline: 1
        }, 
        {
          plugin_url: url
        });
      });
      // Register Shortcode Button
      editor.addButton('broadcast_shortcode_button', {
        title: 'Insert Call to Action',
        cmd: 'broadcast_mcebutton',
        classes: 'widget btn broadcast_btn',
        image: url + '/../../assets/img/add.png'
      });
    }
  });

  // Register plugin
  tinymce.PluginManager.add('broadcast_shortcode_button', tinymce.plugins.broadcast);

})();