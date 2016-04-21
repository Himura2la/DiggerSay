// Array Remove - By John Resig (MIT Licensed)
Array.prototype.remove = function(from, to) {
  var rest = this.slice((to || from) + 1 || this.length);
  this.length = from < 0 ? this.length + from : from;
  return this.push.apply(this, rest);
};

// https://habrahabr.ru/post/156185/
function share(event, url) {
    event.preventDefault();
    window.open(url,'','toolbar=0,status=0,width=626,height=436');
};
function share_vk(event) {
    url  = 'http://vkontakte.ru/share.php?';
    url += 'url='          + encodeURIComponent(document.location.href);
    url += '&title='       + encodeURIComponent(current_quote);
    url += '&description=' + encodeURIComponent(document.title);
    url += '&image='       + encodeURIComponent(share_image_url);
    url += '&noparse=true';
    share(event, url);
};
function share_ok(event) {
    url  = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';
    url += '&st.comments=' + encodeURIComponent(current_quote);
    url += '&st._surl='    + encodeURIComponent(document.location.href);
    share(event, url);
};
function share_fb(event) {
    url  = 'http://www.facebook.com/sharer.php?s=100';
    url += '&p[title]='     + encodeURIComponent("Диггерская цитата");
    url += '&p[summary]='   + encodeURIComponent(current_quote);
    url += '&p[url]='       + encodeURIComponent(document.location.href);
    url += '&p[images][0]=' + encodeURIComponent(share_image_url);
    share(event, url);
};
function share_tw(event) {
    url  = 'http://twitter.com/share?';
    url += 'text='      + encodeURIComponent(current_quote + " //");
    url += '&url='      + encodeURIComponent(document.location.href);
    url += '&counturl=' + encodeURIComponent(document.location.href);
    share(event, url);
};
function share_gp(event) {
    url = 'https://plus.google.com/share?';
    url += 'url='       + encodeURIComponent(document.location.href);
    share(event, url);
};


function id_from_url(){
    var parts = document.location.href.split("/");
    var id = parseInt(parts[parts.length - 1]);
    if (typeof(id) == "number"){
        return id;
    } else {
        return false;
    }
}

function rewrite_url(id) {
    history.pushState({ 'id': id }, document.title, id);
}

function find_new_quote(event){
    if (event != null){
        event.preventDefault();
    }
    if (loading != null) return;
    
    if (IDs.length == 0){
        //$(".quote-text").html(last_quote);
        $.get("ids.php", get_ids_init);
        return;
    }

    var i = Math.floor(Math.random()*IDs.length);
    var id = IDs[i];
    IDs.remove(i);
    
    rewrite_url(id);
    update_quote(id);
}

function make_loading(){
    $(".quote-text").html("...");
    console.log("start displaying loading");
}

function update_quote(ID){
    loading = setTimeout(make_loading, loading_display_after);
    $.get("quote.php?id=" + ID, function(data){
        // Stop loading
        clearTimeout(loading);
        if (loading >= loading_display_after) console.log("end loading");
        loading = null;
        
        // Update text
        $(".quote-text").html(data); 
        current_quote = data
    });
}

//Enter to one of then

function get_ids_init(data){
    IDs = JSON.parse(data);
    find_new_quote();
    $("#next-quote").click(find_new_quote);
}

function get_ids(data){
    IDs = JSON.parse(data);
    $("#next-quote").click(find_new_quote);
}
