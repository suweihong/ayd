
/**
 * 左边栏选中
 * @param  string url 传入选中的路径
 * @return void
 */
function nav(url){
    var $a = $(".menu").find("ul a[href='"+url+"']")
    $a.parents(".parent").addClass("active")
    $a.parents("ul").addClass("in")
    $a.addClass("hover")
}

/**
 * 全局提示
 * @param  string message 消息
 * @param  string status true/false
 * @return void
 */
function jsAlert(message, status){
    message = message || "";
    status = typeof(status)=="undefined"? true: status;
    $(".js-alert-"+ status.toString()).removeClass("hidden")
    .find("span").html(message);
}

// 上传插件
$.fn.uploader = function(options){

    // add uploader form
    var html = '<form id="uploader" action="#" method="post" enctype="multipart/form-data" style="display: none">'
            html += '<input type="file" name="wangEditorH5File">'
        html += '</form>'
    if($("#uploader").length < 1) $("body").append(html)

    // each bind
    for (var i = 0; i < $(this).length; i++) {
        // binds
        $(this).eq(i).click(function(){
            var $clickEle = $(this)
            // trigger click
            $("#uploader input").trigger("click")
            // linster submit
            $("#uploader input").off().change(function(){
                $("#uploader").submit()
            })
            // uploader
            $("#uploader").off().ajaxForm({
                url: "/wangEditor/upload.php",
                method: "post",
                dataType: "json",
                success: function(resp){
                    $("#uploader input").val("")
                    options.apply($clickEle, [resp])
                }
            })
        })
    }
}

// 添加附件
$.fn.attachments = function(options){
    // bind
    var $click = $(this)
    var $attachments = $(options)

    // attachment
    function htmlAttachment(obj){
        // ext png
        switch(obj.extension){
            case 'doc': var ext = 'doc';break;
            case 'docx': var ext = 'doc';break;
            case 'xls': var ext = 'xls';break;
            case 'xlsx': var ext = 'xls';break;
            case 'ppt': var ext = 'ppt';break;
            case 'pptx': var ext = 'ppt';break;
            case 'pdf': var ext = 'pdf';break;
            case 'zip': var ext = 'zip';break;
            case 'rar': var ext = 'rar';break;
            case 'txt': var ext = 'txt';break;
            default: var ext = 'default';
        }
        // html
        var html = ''
            html += '<div class="attachment">'
                html += '<img src="/lumino/ext/ico_ext_'+ ext+ '.png">'
                html += '<input type="hidden" name="path" value="'+ obj.path+ '">'
                html += '<input type="hidden" name="extension" value="'+ obj.extension+ '">'
                html += '<input type="text" name="file_name" class="form-control" placeholder="附件名称" value="'
                html += obj.file_name+ '">'
                html += '<span>X</span>'
            html += '</div>'
        return html;
    }

    // att-uploader
    $click.uploader(function(file){
        var html = htmlAttachment(file)
        $attachments.append(html)
    })

    // delete attachment
    $attachments.on("click", ".attachment span", function(){
        $(this).parents(".attachment").remove()
    })

    // init attachments
    $thisInput = $attachments.children("input")
    try {
        var arr = JSON.parse($thisInput.val())
        for (var i = 0; i < arr.length; i++) {
            var html = htmlAttachment(arr[i])
            $attachments.append(html)
        }
    } catch (e) {
        // return
    }
    
    // each attachment
    setInterval(function(){
        var arr = []
        $attachments.find(".attachment").each(function(){
            var path = $(this).find("input[name='path']").val()
            var file_name = $(this).find("input[name='file_name']").val()
            var extension = $(this).find("input[name='extension']").val()
            arr[arr.length] = {
                file_name: file_name,
                path: path,
                extension: extension
            }
        })
        $thisInput.val(JSON.stringify(arr))
    }, 999)
}