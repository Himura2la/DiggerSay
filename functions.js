// Array Remove - By John Resig (MIT Licensed)
function array_remove(array, from, to) {
  var rest = array.slice((to || from) + 1 || array.length);
  array.length = from < 0 ? array.length + from : from;
  return array.push.apply(array, rest);
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
        $.get("ids.php", get_ids_init); //In circle
        display_loading();
        return;
    }

    var i = Math.floor(Math.random()*IDs.length);
    var id = IDs[i];
    array_remove(IDs, i);
    
    rewrite_url(id);
    update_quote(id);
}

function display_loading(){
    $(".quote-text").html("...");
}

function start_loading(){
    loading = setTimeout(display_loading, loading_display_after);
}
function stop_loading(){
    clearTimeout(loading);
    loading = null;
}


function update_quote(ID){
    start_loading();
    $.get("quote.php?full&id=" + ID, function(data){
        stop_loading();
        data = JSON.parse(data);
        $(".quote-text").html(data['Text']);
        if(data['Author']!="")
        $(".author-text").html('&copy;&nbsp;'+data['Author']);
        else $(".author-text").html("");
        current_quote = data['Text']
    });
}

//Entering to one of then (get_ids if all OK)

function get_ids(data){
    IDs = JSON.parse(data);
    array_remove(IDs, IDs.indexOf(id_from_url()))
    $("#next-quote").click(find_new_quote);
}

function get_ids_init(data){
    IDs = JSON.parse(data);
    array_remove(IDs, IDs.indexOf(id_from_url()))
    find_new_quote();
    $("#next-quote").click(find_new_quote);
}
