$(function() {
    jQuery("#nav-arrow").rotate({ 
    bind: 
    { 
        mouseover : function() { 
            $(this).rotate({animateTo:60})
        },
        mouseout : function() { 
            $(this).rotate({animateTo:0})
        }
    } 
   
    });
});