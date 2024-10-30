var drops = drops || {};
jQuery(document).ready(function($) {
    "use strict";
    
    drops.broadcastDropdown = function(e) {
        var el = e.parent();
        var dropdown = $('.broadcast-dropdown', el);
        var text = $('input[type="text"]', el);
        
        if($(el).hasClass('active')){//If is currently active, hide it
            el.removeClass('active');
            $('.broadcast-dropdown', el).removeClass('active');
            return false;
        }
        else if($('.broadcast-dropdown').hasClass('active')){
            $('.broadcast-dropdown').each(function(i){
                $(this).removeClass('active');
                $(this).parent().removeClass('active');
            });
        }    
        
        $('.broadcast-dropdown').removeClass('active');//remove active states from currently open dropdowns
        el.addClass('active');
        $('.broadcast-dropdown', el).addClass('active');
        text.focus(); //Focus on input boxes
        
        $('body').unbind('click').bind('click', drops.closeDropDown); // Bind click event to site container   
        dropdown.click(function(e){
            e.stopPropagation();
        }); 
    };
    drops.closeDropDown = function() {
        $('.broadcast-dropdown').each(function(i) {
            $(this).removeClass('active');
            $(this).parent().removeClass('active');
        });
    };    
    
    //Dropdown links
    $('.broadcast-dropdown').each(function(i){
        var el = $(this).parent('.btn');
        $('> a', el).click(function(e){
            var e = $(this);
            drops.broadcastDropdown(e);
            return false;
        });
    });
});