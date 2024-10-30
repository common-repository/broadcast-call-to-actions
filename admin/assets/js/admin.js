var broadcast = {};

jQuery(document).ready(function($) {
   "use strict"; 	
   
   broadcast.is_working = false;
   broadcast.speed = 200;
   broadcast.loader = $('.broadcast-plugin-wrapper .inner .loading');
   broadcast.editing_layout = false;   
   
   
   /*
   *  Tooltipster
   *  http://iamceege.github.io/tooltipster/
   *
   *  @since 2.8.4
   */ 
   
	$('.tooltip').tooltipster({
		delay: 100,
		speed: 125,
		maxWidth: 260,
	});
   
   
   /* 
      Selectbox replacement
   */
   if($(".chosen-select").length){
      $(".chosen-select").chosen();
   } 
   
   
   
   /* 
      Rangeslider
   */ 
   $('input[type="range"]').rangeslider({
      polyfill : false,
      onInit : function() {
         this.output = $('#brocast_perc').text(  this.$element.val() );
      },
      onSlide : function( position, value ) {
         this.output.html( value );
      }
   });
   
   
   
   /* 
      Shortcode Builder
   */
   
   broadcast.buildShortcode = function(){
      var container = $('.broadcast-builder'),
          id = $('#broadcast-cta-selection', container).val(),
          layout = $('#broadcast-layout-selection', container).val(),
          align = $('#broadcast-cta-align', container).val(),
          width = $('#broadcast-cta-width', container).val(),
          classes = $('#broadcast-classes', container).val();   
      
      if(classes){
	      classes = ' classes="'+classes+'"';
      }  
          
      if(id !== '' && layout !== ''){
         $('a', container).removeClass('disabled');         
         $('.output-wrap', container).addClass('active');
      }else{
         $('a', container).addClass('disabled');
         $('.output-wrap', container).removeClass('active');
      }
      
      $('#shortcode-output', container).html('[broadcast cta="'+id+'" layout="'+layout+'" align="'+align+'" width="'+width+'"'+classes+']');
   };
   
   $(document).on('change', '.broadcast-builder select, .broadcast-builder input', function(){
      broadcast.buildShortcode();
   });
   $(document).on('keyup', '.broadcast-builder input[type=text]', function(){
      broadcast.buildShortcode();
   });
   broadcast.buildShortcode();   
   
   
	
	// Copy link on shortcode builder
	$('a.copy-shortcode').on('click', function(){
		var c = $('#shortcode-output').html();
		broadcast.copyToClipboard(c);
	});
   
   
   
   
   /* 
      Create Layout
   */
   
   $('.add-layout .broadcast-dropdown ul.the-layouts li a').on('click', function(){
      if(!broadcast.is_working){
         drops.closeDropDown();
         broadcast.loadingIn();
         var container = $('.layout-menu'),
             count = $('li:not(.empty, .first)', container).length,
             name = $(this).text(),
             path = $(this).data('path'),
             append = '<li class="fetching new-item" data-id="" class="new-item"></li>';
           
         $(append).insertAfter('li.first', container); // Add new item after li.first 
           
         $.ajax({
            type: "POST",
            url: broadcast_localize.ajax_admin_url,
   			data: {
   				action: 'broadcast_create_layout',
   				nonce: broadcast_localize.broadcast_nonce,
   				name: name,
   				path: path,
   			},
            error: function(jqXHR, textStatus, errorThrown){                                        
               console.error("The following error occured: " + textStatus, errorThrown);
               broadcast.loadingOut(); 
               $('li.new-item', container).remove();                                                      
            },
            success: function(data) {                                       
               console.log(data); 
               if(count === 0){
                  $('li.empty', container).fadeOut(broadcast.speed);
               }
               $('li.new-item', container).attr('data-id', data.id);
               $('li.new-item', container).html('<input type="checkbox" value="'+data.id+'" name="broadcast" id="broadcast-select-'+data.id+'"><h3 data-title="'+data.title+'"><a href="javascript:void(0);" class="item">'+data.title+'</a></h3><div class="actions"><span class="id"><i class="fa fa-tag"></i> '+data.id+'  <em>|</em>  </span><span class="edit"><a href="javascript:void(0);" class="edit">'+data.editText+'</a>  <em>|</em>  </span><span class="trash"><a href="javascript:void(0);" class="remove">'+data.deleteText+'</a></span></div><span class="published">'+data.pubText+'<br/><strong>'+data.time+'</strong></span>');
               broadcast.loadingOut();          
               $('li.new-item a', container).trigger('click');
               $('li.new-item', container).removeClass('fetching').removeClass('new-item');                                                  
            }                              
         });
      }
   });
   
   
   
   
   /* 
      Save/Update Layout
   */
   
   $('#broadcast-save').on('click', function(){
      if(!broadcast.is_working){
         broadcast.loadingIn();
         $('.layout-inputs').addClass('saving');
         $('.layout-inputs img.saving').addClass('active');
         var title = $('#broadcast-title').val(),
             id = $('#broadcast-id').val(),
             value = editor.getValue();
          
         $.ajax({
            type: "POST",
            url: broadcast_localize.ajax_admin_url,
   			data: {
   				action: 'broadcast_save_layout',
   				nonce: broadcast_localize.broadcast_nonce,
   				id: id,
   				title: title,
   				content: value,
   			},
            error: function(jqXHR, textStatus, errorThrown){                                        
               console.error("The following error occured: " + textStatus, errorThrown);
               broadcast.loadingOut();   
               $('.layout-inputs img.saving').removeClass('active');
               $('.layout-inputs').removeClass('saving');                                                     
            },
            success: function(data) {                                       
               console.log('Layout Updated');                 
               $('ul#broadcast-layout-menu li[data-id="'+data.id+'"] h3 a.item').text(data.title); // H3               
               $('ul#broadcast-layout-menu li[data-id="'+data.id+'"] h3').attr('data-title', data.title); // Data value          
               broadcast.loadingOut();   
               $('.layout-inputs img.saving').removeClass('active');
               $('.layout-inputs').removeClass('saving');                                                       
            }                              
         });
      }
   });
   
   
   
   
   /* 
      View Layout 
   */
   
   $(document).on('click', '#broadcast-layout-menu li a.item, #broadcast-layout-menu li a.edit', function(){
      
      if(!broadcast.is_working){
         broadcast.loadingIn();
         
         var el = $(this),
             parent = el.closest('li'),
             id = parent.attr('data-id'),
             editorWrap = $('#broadcast-layout-editor');
             
         if(id.length && !parent.hasClass('active')){  
            
            $('#broadcast-layout-menu li').removeClass('active'); // CLear other active states  
            parent.addClass('fetching'); // Add fetching state
            
            $.ajax({
               type: "POST",
               url: broadcast_localize.ajax_admin_url,
      			data: {
      				action: 'broadcast_view_layout',
      				id: id,
      				nonce: broadcast_localize.broadcast_nonce,
      			},
               success: function(data) {                     
                  var broadcast_cta_title = data.title;  
                  var broadcast_cta_id = data.id;  
                  var broadcast_cta_content = data.content;       
                  
                  setTimeout(function(){                       
                     //$('#broadcast-layout-selection').hide();  
                     editorWrap.insertAfter(parent).slideDown(350, 'broadcast_easeInOutQuad', function(){
                        $('html, body').animate({
                          scrollTop: parent.offset().top - 40
                      	}, 500, 'broadcast_easeInOutQuad');
                      	$('#broadcast-title').focus();
                     });                   
                     editor.setValue(broadcast_cta_content);
                     $('#broadcast-title').val(broadcast_cta_title);
                     $('#layout-title').text(broadcast_cta_title);
                     $('#broadcast-id').val(broadcast_cta_id);  
                     parent.removeClass('fetching').addClass('active'); // Add fetching state;                     
                     broadcast.loadingOut();
                  }, broadcast.speed);                                              
               },
               error: function(jqXHR, textStatus, errorThrown){                                        
                  console.error("The following error occured: " + textStatus, errorThrown);
                  parent.removeClass('fetching').removeClass('active');   
                  broadcast.loadingOut();                                                   
               }                              
            });
         }else{
            $('#broadcast-layout-editor a.cancel').trigger('click');
            broadcast.loadingOut();
         }
      }
   });
      
   
   
   /* 
      Cancel Layout Edit
      - Remove/Cancel on edit screen
   */   
   $(document).on('click', '#broadcast-layout-editor a.cancel, #broadcast-layout-editor a.close', function(){       
      
      setTimeout(function(){         
         // Replace H3 val on cancel.
         var old_h3_val = $('#broadcast-layout-editor').prev('li').find('h3').attr('data-title');
         $('#broadcast-layout-editor').prev('li').find('h3 a').text(old_h3_val);
                      
         $('#broadcast-layout-editor').slideUp(350, 'broadcast_easeInOutQuad', function(){
            editor.setValue('');
            $('#broadcast-title').val('');
            $('#layout-title').text('');
            $('#broadcast-id').val('');  
            $('#broadcast-layout-menu li').removeClass('active');   
                 
         });                    
      }, 50);       
   });
   
   
   
   /* 
      Update title on keyup
   */
   $(document).on('keyup', '#broadcast-title', function(){  
      var titleText = $(this).val();
      if(titleText === '') titleText = '...';
      
      $('#broadcast-layout-editor').prev('li').find('h3 a').text(titleText);     
   });   
   
   
   
   /* 
      Delete Selected Layout (multi-checkboxes)
   */
   
   $(".layout-menu input[type=checkbox]").prop('checked', false);
   
   $(document).on('click', 'button.broadcast-delete-selected', function(){
      
      var selection = $('#broadcast-bulk-selection').val(); // Get select value
      
      if(!broadcast.is_working && selection === 'trash'){ 
                
         // Create array of checked layouts
         var checked = [];
         $(".layout-menu input[type=checkbox]:not(.broadcast-select-all):checked").each(function(){
             checked.push($(this).val());
         });         
         
         // If checked, then proceed
         if(checked.length > 0){
            broadcast.loadingIn();
            var r = confirm(broadcast_localize.delete_all_msg);
            if (r === true){
               $('#broadcast-layout-wrap .loading').fadeIn(250);
               $.ajax({
                  type: "POST",
                  url: broadcast_localize.ajax_admin_url,
         			data: {
         				action: 'broadcast_delete_layout',
         				type: 'selected',
         				id: checked,
         				nonce: broadcast_localize.broadcast_nonce,
         			},
                  error: function(jqXHR, textStatus, errorThrown){                                        
                     console.error("The following error occured: " + textStatus, errorThrown); 
                     $('#broadcast-layout-wrap .loading').fadeOut(250);  
                     broadcast.loadingOut();                                                   
                  },
                  success: function(data) {   
                     location.reload();                                                                            
                  }                              
               });
            }            
         }
      }
   });
   
   
   
   
   /* 
      Delete Layout (Induvidual)
   */
   
   $(document).on('click', '#broadcast-layout-menu li a.remove', function(){
      if(!broadcast.is_working){
         var r = confirm(broadcast_localize.delete_msg);
         if (r === true){
            broadcast.loadingIn();
            var parent = $(this).closest('li'),
                container = $('.layout-menu'),
                count = $('li:not(.empty, .first)', container).length,
                id = parent.attr('data-id');
            if(id.length){   
               
               // If deleting layout is .active
               if(parent.hasClass('active')){
                  $('#broadcast-layout-editor a.cancel').trigger('click');
               }
               
               parent.addClass('fetching').addClass('deleting'); 
               $.ajax({
                  type: "POST",
                  url: broadcast_localize.ajax_admin_url,
         			data: {
         				action: 'broadcast_delete_layout',
         				type: 'single',
         				id: id,
         				nonce: broadcast_localize.broadcast_nonce,
         			},
                  error: function(jqXHR, textStatus, errorThrown){                                        
                     console.error("The following error occured: " + textStatus, errorThrown);      
                     parent.removeClass('fetching').removeClass('deleting');
                     broadcast.loadingOut();                                                  
                  },
                  success: function(data) {   
                     parent.fadeOut(300, function(){                     
                        parent.remove();  
                        if(count === 1){
                           location.reload();    
                        }
                        broadcast.loadingOut();
                     });                                                                            
                  }                              
               });
            }
         }else{
            broadcast.loadingOut();
         }
      }
   });
   
   
   // Check all
   $('ul.layout-menu li.first input.broadcast-select-all').on('click', function(){
      var el = $(this);
      if(el.is(':checked')){
         $('ul.layout-menu li input[type=checkbox]').prop('checked', true);
      }else{
         $('ul.layout-menu li input[type=checkbox]').prop('checked', false);
      }
   });   
   
   
   
   // Set Codemirror
   if($('#broadcast-textarea').length){
      var editor = CodeMirror.fromTextArea(document.getElementById("broadcast-textarea"), {
        mode:  "application/x-httpd-php",
        lineNumbers: true,
        lineWrapping: true,
        indentUnit: 0,
        matchBrackets: true,
        viewportMargin: Infinity,
        extraKeys: {"Ctrl-Space": "autocomplete"},
      });
   }
   
      
   
   // Save Settings
   $('#broadcast-settings-form').submit(function() { 
      $('.save-settings').addClass('saving'); 
   });
   
   
   
   // Loading flags
   broadcast.loadingIn = function(){
      broadcast.is_working = true; 
   }
   broadcast.loadingOut = function(){
      broadcast.is_working = false;  
   }
   
   
   
   // Get Querystring Value
	$.urlParam = function (name) {
		var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);		
		if(results){
			return results[1] || 0;
		}else{
			return '';
		}
	};
	
	
	
	// If layout is set in URL, trigger edit screen
	if($('#broadcast-layout-menu').length){
		var edit_layout = $.urlParam('layout');
		if(edit_layout !== ''){
			$('#broadcast-layout-menu li[data-id='+edit_layout+'] h3 a').trigger('click');
		}
	}
	
	
	
	// Copy to clipboard   	
	broadcast.copyToClipboard = function(text) {
		window.prompt ("Copy link to your clipboard: Press Ctrl + C then hit Enter to copy.", text);
	}
	   
   
   
   /*
   *  broadcast_easeInOutQuad
   *  easing
   *
   *  @since 1.0
   */  
   
	$.easing.broadcast_easeInOutQuad = function (x, t, b, c, d) {
      if ((t/=d/2) < 1) return c/2*t*t + b;
      return -c/2 * ((--t)*(t-2) - 1) + b;
   }	
	
	
});