var IDs;
var loading;
var current_quote;
var target_id = false;
var loading_display_after = 200; //ms
var last_quote = "Кончились Т_Т. Топи F5."
var share_image_url = document.location.origin + "/images/vk_repost.jpg";


// On load
$(function() {
    target_id = id_from_url();
    if (target_id) {
        $.get("ids.php", get_ids_display);
    } else {
        $.get("ids.php", get_ids_init); // На всякий...
        console.log("Почему-то PHP не обновил URL, странно...");
    }
    
    $(window).on('popstate', function() { //Browser back
        update_quote(id_from_url());
    });
    
    $("#share_vk").click(share_vk);
    $("#share_fb").click(share_fb);
    $("#share_tw").click(share_tw);
    $("#share_gp").click(share_gp);
    $("#share_ok").click(share_ok);
});

