
$(document).on('click', "ul.todo-list li.un_read_message_list", function(e) {
    var _this = $(this);
    var msg_id = $(_this).attr("data-target");
    $("ul.todo-list li").removeClass("selected");
    $(this).addClass("selected");
    $.ajax({
        beforeSend: startLoader("#message_body_holder"),
        url: my_app_base_url + "index.php/ajax/markMessageAsRead",
        data: {msgId: msg_id},
        type: "post",
        success: function(data) {
            data = $.trim(data);
            $(".un_read_message_list").each(function(i, v) {
                if ($(this).data("target") == msg_id) {
                    $(this).removeClass("un_read_message_list");
                }
            });
            $(_this).addClass("read_message_list");
            
            $(".unreadMsgCount").html(data);
            if (data == "" || data == 0) {
                $(".unreadMsgCountNoti").remove();
            }
        }

    });
    e.stopPropagation();
});

$(document).on('click', "ul.todo-list li", function(e) {
    $("ul.todo-list li").removeClass("selected");
    $(this).addClass("selected");
    e.stopPropagation();
});

function showSelectedFileList() {
    var input = document.getElementById("filesToUpload");
    var ul = document.getElementById("fileList");
    while (ul.hasChildNodes()) {
        ul.removeChild(ul.firstChild);
    }
    for (var i = 0; i < input.files.length; i++) {
        var li = document.createElement("li");
        li.innerHTML = input.files[i].name;
        ul.appendChild(li);
    }
    if (!ul.hasChildNodes()) {
        var li = document.createElement("li");
        li.innerHTML = 'No Files Selected';
        ul.appendChild(li);
    }
}

function startLoader(targetElement) {
    return;
}

function endLoader(targetElement) {
    return;
}

function showMessage(msg_id) {
    $.ajax({
        beforeSend: startLoader("#message_body_holder"),
        url: my_app_base_url + "index.php/ajax/getMessageData",
        // url:"./ajax/getMessageData",
        data: {msgId: msg_id},
        type: "post",
        success: function(data) {
            endLoader("#message_body_holder");
            data = JSON.parse(data);
            console.log(data);
            if (data['message'] && data['message'][0]) {
                msgData = data['message'][0];
                $("#msg_view_title .titleHolder").html(msgData['title']);
                $("#msg_view_body .msgHolder").html(msgData['text']);
                $("#message_id_for_comment").val(msg_id);
                $("#comment_box_holder").show();
            } else {
                console.log("Manage the error");
                $("#message_id_for_comment").val("");
            }

        }

    });
}