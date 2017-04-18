var IDs;
var loading;
var current_quote;
var target_id = false;
var loading_display_after = 500; //ms
var share_image_url = document.location.origin + "/images/vk_repost.jpg";


// On load
$(function() {
    target_id = id_from_url();
    if (target_id) {
        current_quote = $(".quote-text").html();
        $.get("ids.php", get_ids); //Начинаем грузить айдишки, а юзер уже читает цитату. Профит.
    } else {
        console.log("Почему-то PHP не обновил URL, странно... Попробуем поручить это JS...");
        $.get("ids.php", get_ids_init);
    }
    
    $(window).on('popstate', function() { //Browser back
        update_quote(id_from_url());
    });
    
    $("#share_vk").click(share_vk);
    $("#share_fb").click(share_fb);
    $("#share_tw").click(share_tw);
    $("#share_gp").click(share_gp);
    $("#share_ok").click(share_ok);
    
    
    $(".nav-arrow").rotate({ 
        bind: { 
            mouseover : function() { 
                $(this).rotate({animateTo:45})
            },
            mouseout : function() { 
                $(this).rotate({animateTo:0})
            }
        }
    });
});

