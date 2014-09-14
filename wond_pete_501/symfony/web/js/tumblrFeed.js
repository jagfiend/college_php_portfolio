// tumblrFeed.js script file manages the data called from the tumblr api...
// function to get feed data from tumblr...
function getFeed(limit,offset,page){
    $.ajax({
        url: 'http://api.tumblr.com/v2/blog/kateellisillustration.tumblr.com/posts?api_key=Mn579FtnXg9HbcD57eTN60kxVg8WSYr8P5JRkatBzfwl48Skbt',
        type: 'GET',
        dataType: 'JSON',
        data: {
            limit: limit,
            offset: offset
        },
         success: function(data){
            // if successful, buildFeed function called...
            buildFeed(data,limit,page);               
        },
        error: function(){
            // if there is an error, buildError function called...
            buildError();
        }
    });  
};
// function to convert the feed into the structure and style of the site...
function buildFeed(data,limit,page){
    var totalPosts = data.response['total_posts'];
    var pages = Math.ceil(totalPosts / limit);
    var page = page;
    // clear default offline message and any previous build...
    $("#feed").html("");
    // loop over array to print selected page of posts...
    for(var i = 0; i < data.response['posts'].length; i++){
        // write start of html block...
        $('#feed').append('<article class="row tumblr" id="'+data.response['posts'][i]['id']+'">');
        // determine post type and write appropriate html to match...
        switch(data.response['posts'][i]['type']){
            case 'text':
                $('#'+data.response['posts'][i]['id']+'').append(
                    '<div class="span6" id="postContent'+data.response['posts'][i]['id']+'">'+data.response['posts'][i]['title']+data.response['posts'][i]['body']+'</div>');                      
            break;
            case 'photo':
                $('#'+data.response['posts'][i]['id']+'').append(
                    '<div class="span6" id="postContent'+data.response['posts'][i]['id']+'">\
                        <img src="'+data.response['posts'][i]['photos']['0']['original_size']['url']+'" >'+data.response['posts'][i]['caption']+'</div>');
            break;
            case 'quote':
                $('#'+data.response['posts'][i]['id']+'').append(
                    '<div class="span6" id="postContent'+data.response['posts'][i]['id']+'">\
                        <blockquote>'+data.response['posts'][i]['text']+'</blockquote><p>'+data.response['posts'][i]['source']+'</p></div>');
            break;                    
            case 'link':
                $('#'+data.response['posts'][i]['id']+'').append(
                    '<div class="span6" id="postContent'+data.response['posts'][i]['id']+'">\
                        <p>'+data.response['posts'][i]['title']+'</p>'+data.response['posts'][i]['description']+'</div>');
            break;
            case 'chat':
                $('#'+data.response['posts'][i]['id']+'').append(
                    '<div class="span6" id="postContent'+data.response['posts'][i]['id']+'">\
                        <p>'+data.response['posts'][i]['title']+'</p><p>'+data.response['posts'][i]['body']+'</p></div>');
            break;
            case 'audio':
                $('#'+data.response['posts'][i]['id']+'').append(
                    '<div class="span6" id="postContent'+data.response['posts'][i]['id']+'">'+data.response['posts'][i]['embed']+data.response['posts'][i]['caption']+'</div>');
            break;
            case 'video':
                $('#'+data.response['posts'][i]['id']+'').append(
                    '<div class="span6" id="postContent'+data.response['posts'][i]['id']+'">'+data.response['posts'][i]['player']['2']['embed_code']+data.response['posts'][i]['caption']+'</div>');
            break;
        };
        // complete html block with blog post time and controls...
        $('#'+data.response['posts'][i]['id']+'').append(
                '<div class="span6">\
                    <div class="span4 offset1"><i class="icon-time"></i> '+data.response['posts'][i]['date']+'</div>\
                    <div class="span4 offset1 tumblrControl">\
                        <i class="icon-retweet"></i>\
                        <a href="http://www.tumblr.com/reblog/'+data.response['posts'][i]['id']+'/'+data.response['posts'][i]['reblog-key']+'" target="blank">Reblog this post</a>\
                    </div>\
                    <div class="span4 offset1 tumblrControl">\
                        <i class="icon-comment"></i>\
                        <a href="http://'+data.response['blog']['name']+'.tumblr.com/post/'+data.response['posts'][i]['id']+'#notes" target="blank">Post notes: '+data.response['posts'][i]['note_count']+'</a>\
                    </div>\
                </div>\
            </article>');
    }; // end of for loop... 
    // pagination code, though heavily edited, is from botmonster.com/jquery-bootpag...
    // pagination controls...
    $('#feed').append('<div id="page-selection" class="text-center"></div>\
        <script>$("#page-selection").bootpag({total:'+pages+', page:'+page+'}).on("page",function(event,num){\
            var offset = '+limit+' * (num - 1);\
            getFeed('+limit+',offset,num);\
        });</scr'+'ipt>');
    // note split of script tag to work around javascript bug...  
}
// function to notify user if there is an error with the Tumblr feed...
function buildError(){
    $('#feed').append('<div>Oops! Theres a problem with the Tumblr feed...</div>');
}