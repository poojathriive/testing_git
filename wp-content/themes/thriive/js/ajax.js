function make_chat_dialog_box(to_user_id, to_user_name, from_user_id = '', user_role = "", img = "") {

    var dailogbox_id = 'user_dialog_' + to_user_id;
    var modal_content = '<div id="user_dialog_' + to_user_id + '_' + from_user_id + '" class="user_dialog" title="You have chat with ' + to_user_name + '">';
    modal_content += '<div style="height:200px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '_' + from_user_id + '"><div class="chat_details"><h4>' + to_user_name + '</h4></div>';
    var str = fetch_user_chat_history(to_user_id, from_user_id);

    if (typeof obj !== "undefined") {
        modal_content += str;
    }
    modal_content += '</div><input type= "hidden" id="file_' + to_user_id + '_' + from_user_id + '" value="">';
    modal_content += '<div class = "emoji_chat_box" ><div class="form-group emoji_textareaBox" id="emoji_' + to_user_id + '_' + from_user_id + '" onkeyup="runScript(event,' + to_user_id + ',' + from_user_id + ')">';
    modal_content += '<textarea name="chat_message_' + to_user_id + '_' + from_user_id + '" id="chat_message_' + to_user_id + '_' + from_user_id + '" class="form-control chat_message" ></textarea>';
    modal_content += '</div><div class="form-group send_ContBox" align="right">';
    if (user_role == 'subscriber') {
        modal_content += '</span>';
    } else {
        modal_content += '</span>';
        // modal_content += '<button type="button" id= "del" style="float:left" onclick = "delete_msg(this)">Delete</button></span>';
        modal_content += '<button type="button" data-toid="' + to_user_id + '" id= "complete" style="float:left" onclick="closeModal(' + to_user_id + ',' + from_user_id + ')" >Complete</button>';
    }

    // modal_content += '<a href="http://35.232.100.164/faq/faq.html" target="_blank" class="anch_linkz"><button type="button" id= "faq" style="float:left">FAQ</button></a></span>';

    modal_content += '<label for="file-1" class="file_txtlabel"><img src="http://35.232.100.164/wp-content/themes/thriive/assets/images/attachment_icon1.png" class="upload_iconn" alt="upload Icon"><input type="file" id="selectFile" class="inputFile_box" data-id="' + to_user_id + '_' + from_user_id + '" style="float:left" onchange= "upload(this)" /></label><span id="msg" style="color:red" class = "filetype_pic"></span>';
    modal_content += '<button type="button" name="send_chat"  class="btn btn-info send_chat"  onclick="insertData(' + to_user_id + ',' + from_user_id + ');">Send</button><span id= "text_msg" class = "filetype_text"></span></div></div></div>';

    $('#user_model_details').html(modal_content);

}

function runScript(e, to_id, from_id) {
    //See notes about 'which' and 'key'
    console.log("key pressed==" + e.keyCode);
    if (e.keyCode == 13) {
        var myString = $('#emoji_' + to_id + '_' + from_id + ' .emojionearea-editor').html();

        var str = myString.replace(/(<([^>]+)>)/ig, "");
        $('#chat_message_' + to_id + "_" + from_id).val(str);
        insertData(to_id, from_id, msg = '');
        //console.log('okkk11=='+msg+'id=='+$('#chat_message_' + to_id + "_" + from_id).val());
        //console.log(str);
    }
}



// $("body").click(function() {
// if ($(".chat_dropdown_modal").is(":visible")) {
// $('.chat_dropdown_modal').fadeOut(2000);
// }

// });

var closed_box = 0;
var opened_box = 0;
var series_num = 0;
$(document).off().on('click', '.start_chat', function() {
    var from_status = $(this).data('from_status');
    var to_status = $(this).data('to_status');
    var to_user_id = $(this).data('touserid');
    var from_role = $(this).attr('data-role');
    var to_user_name = $(this).data('tousername');
    var from_user_id = $(this).data('fromuserid');

    if (from_status == 0) {
        location.href = '/login';
        return false;
    }
    if (to_status == 0) {
        var to_mobile = $(this).attr('data-mobile');
        var msg = $(this).attr('data-msg');
        var to_email = $(this).attr('data-email');

        //alert(msg);
        //sendMSG("919873476520",msg);
        // sendMSG(to_mobile,msg);
        // alert('This therapist is offline now, we will send you a notification as soon as the therapist is available.');
        insertNotification(to_user_id, from_user_id, msg, to_mobile, to_email, to_mobile, to_user_name);


    }
    var from_role = $(this).attr('data-role');
    var to_user_name = $(this).data('tousername');
    var from_user_id = $(this).data('fromuserid');
    var img = $(this).data('data-img');
    if (!$('[aria-describedby="user_dialog_' + to_user_id + '_' + from_user_id + '"]').is(":visible")) {

        make_chat_dialog_box(to_user_id, to_user_name, from_user_id, from_role, img);

        $("#user_dialog_" + to_user_id + "_" + from_user_id).dialog({
            width: 400,
            autoOpen: false,
            modal: true,
            titleIsHtml: true,
            title: "<div class='widget-header widget-header-small' style='padding-left: 21px;'>" + to_user_name + "<button type='button' class='dots_iconz1' onclick='chat_dropDowns();'><span class='dotsA1'></span><span class='dotsA1'></span><span class='dotsA1'></span></button><div class='chat_dropdown_modal' style='display:none;'><ul class='chatdropdwn_lists'><li><button type='button' id= 'del' class = 'title_anch' data-to = '" + to_user_id + "' data-from = '" + from_user_id + "' onclick = 'delete_msg(this)'>Delete</button></li><li><a href='http://35.232.100.164/faq/faq.html' class = 'title_anch' target='_blank' >FAQ</a></li></ul></div><button type='button' class='max_chatBox' onclick='maxim_chatBox();'><i class='fa fa-expand' aria-hidden='true'></i></button></div>",
            close: function(event, ui) {
                var str = "user_dialog_" + to_user_id + "_" + from_user_id;

                var box_series = $('[aria-describedby="' + str + '"]').attr('aria-labelledby');
                var box_number = box_series.split("-");

                $("#user_dialog_" + to_user_id + "_" + from_user_id).dialog("close");
                $("#user_dialog_" + to_user_id + "_" + from_user_id).dialog("destroy");
                $("#user_dialog_" + to_user_id + "_" + from_user_id).hide();
                var j = box_number[2];
                closed_box++;

                for (i = j; i <= parseInt(series_num); i++) {

                    var right_value = (25 * parseInt(i)) - 25 * parseInt(closed_box);

                    var box_num = parseInt(i) + 1;
                    $('[aria-labelledby="ui-id-' + box_num + '"]').attr('style', 'right: ' + right_value + '% !important');

                    //alert('[aria-labelledby="ui-id-'+box_num+'"]');
                    //alert('right: '+right_value+'% !important');

                }
            }
        });
        $('#user_dialog_' + to_user_id + "_" + from_user_id).dialog('open');
        $('#chat_message_' + to_user_id + "_" + from_user_id).emojioneArea({
            pickerPosition: "top",
            toneStyle: "bullet"
        });
        var str = "user_dialog_" + to_user_id + "_" + from_user_id;
        right_value = (opened_box - closed_box) * 25;
        //alert(right_value);
        $('[aria-describedby="' + str + '"]').attr('style', 'right: ' + right_value + '% !important');
        var box_series1 = $('[aria-describedby="' + str + '"]').attr('aria-labelledby');
        var box_number1 = box_series1.split("-");
        series_num = box_number1[2];
        opened_box++;
        $('.ui-widget-overlay').attr('style', 'z-index: -1 !important');
    }
    // $('[aria-labelledby="ui-id-2"]').attr('style', 'right: 25% !important');
    // $('[aria-labelledby="ui-id-3"]').attr('style', 'right: 50% !important');
    // $('[aria-labelledby="ui-id-4"]').attr('style', 'right: 45% !important');
    // $('[aria-labelledby="ui-id-5"]').attr('style', 'right: 60% !important');
    // $('[aria-labelledby="ui-id-6"]').attr('style', 'right: 75% !important');

});
$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
    _title: function(title) {
        var $title = this.options.title || '&nbsp;'
        if (("titleIsHtml" in this.options) && this.options.titleIsHtml == true)
            title.html($title);
        else title.text($title);
    }
}));

$('.ui-dialog-titlebar-close').click(function() {

    $("#dialog2").dialog("close");

});

function chat_dropDowns() {
    // alert("hi....");    
    // $('.chat_dropdown_modal').html(modal_content);
    $('.chat_dropdown_modal').fadeToggle();
    $('.chatdropdwn_lists').mouseleave(function() {
        $('.chat_dropdown_modal').fadeOut();
    });
}

function maxim_chatBox() {
    // alert("hi....");
    // $('.ui-widget.ui-widget-content').removeAttr("style");
    // $('.ui-widget.ui-widget-content').css({
    //     'width': '',
    //     'top': '',
    //     'right': '',
    //     'bottom': '',
    //     'left': ''
    // });
    // $('.ui-widget.ui-widget-content').each(function() {
    //     this.style.setProperty('width', '', 'important');
    // });
    $('.ui-widget.ui-widget-content').toggleClass("expndChat");
    // if ($('.ui-widget.ui-widget-content').hasClass("expndChat")) {
    //     $('.ui-widget.ui-widget-content').style.setProperty('width', '80%', 'important');
    // }
    // $('.ui-widget.ui-widget-content').hasClass("expndChat").each(function() {
    //     this.style.setProperty('width', '80%', 'important');
    // });
    // $('.ui-widget.ui-widget-content').each(function() {
    //     this.style.setProperty('width', '80%', 'important');
    // });


}

function make_chat_dialog_box1(to_user_id, to_user_name, from_user_id = '', user_role = "") {

    var dailogbox_id = 'user_dialog_' + to_user_id;
    var modal_content = '<div id="user_dialog_' + to_user_id + "_" + from_user_id + '" class="user_dialog" title="You have chat with ' + to_user_name + '">';
    modal_content += '<div style="height:200px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + "_" + from_user_id + '">';
    var str = fetch_user_chat_history(to_user_id, from_user_id);

    if (typeof obj !== "undefined") {
        modal_content += str;
    }
    modal_content += '</div><input type= "hidden" id="file_' + to_user_id + "_" + from_user_id + '" value="">';

    modal_content += '</div>';

    $('#user_model_details').html(modal_content);
}
$(document).on('click', '.view_chat', function() {
    var from_status = $(this).data('from_status');
    var to_status = $(this).data('to_status');
    var to_user_id = $(this).data('touserid');
    var from_role = $(this).attr('data-role');
    var to_user_name = $(this).data('tousername');
    var from_user_id = $(this).data('fromuserid');

    var from_role = $(this).attr('data-role');
    var to_user_name = $(this).data('tousername');
    var from_user_id = $(this).data('fromuserid');

    if (!$('[aria-describedby="user_dialog_' + to_user_id + '_' + from_user_id + '"]').is(":visible")) {
        make_chat_dialog_box1(to_user_id, to_user_name, from_user_id, from_role);
        $("#user_dialog_" + to_user_id + "_" + from_user_id).dialog({
            width: 400,
            close: function(event, ui) {
                $("#user_dialog_" + to_user_id + "_" + from_user_id).dialog("close");
                $("#user_dialog_" + to_user_id + "_" + from_user_id).dialog("destroy");
                $("#user_dialog_" + to_user_id + "_" + from_user_id).hide();
            }

        });

        $('#user_dialog_' + to_user_id + "_" + from_user_id).dialog('open');
    }
});

function check_box_open() {

    session_user = $('#session_user').val();
    $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        data: {
            action: 'checkboxopen', // this is the function in your functions.php that will be triggered
        },
        success: function(data) {
            //Do something with the result from server
            // $('#start_chat_button_'+to_user_id).html(data);
            // console.log(data);
            if (data.trim() != 'null') {
                var arr = data.split('-');
                var to_user_id = arr[0].trim();
                var to_user_name = arr[1].trim();
                var from_user_id = arr[2].trim();
                var from_role = arr[3].trim();
            }
            console.log(data);
            if (!$('[aria-describedby="user_dialog_' + to_user_id + '_' + from_user_id + '"]').is(":visible") && data.trim() != 'null') {

                console.log(data);
                make_chat_dialog_box(to_user_id, to_user_name, from_user_id, from_role);
                $("#user_dialog_" + to_user_id + "_" + from_user_id).dialog({
                    width: 400,
                    autoOpen: false,
                    modal: true,
                    titleIsHtml: true,
                    title: "<div class='widget-header widget-header-small' style='padding-left: 21px;'>" + to_user_name + "<button type='button' class='dots_iconz1' onclick='chat_dropDowns();'><span class='dotsA1'></span><span class='dotsA1'></span><span class='dotsA1'></span></button><div class='chat_dropdown_modal' style='display:none;'><ul class='chatdropdwn_lists'><li><button type='button' id= 'del' class = 'title_anch' data-to = '" + to_user_id + "' data-from = '" + from_user_id + "' onclick = 'delete_msg(this)'>Delete</button></li><li><a href='http://35.232.100.164/faq/faq.html' class = 'title_anch' target='_blank' >FAQ</a></li></ul></div></div>",
                    close: function(event, ui) {
                        var str = "user_dialog_" + to_user_id + "_" + from_user_id;

                        var box_series = $('[aria-describedby="' + str + '"]').attr('aria-labelledby');
                        var box_number = box_series.split("-");

                        $("#user_dialog_" + to_user_id + "_" + from_user_id).dialog("close");
                        $("#user_dialog_" + to_user_id + "_" + from_user_id).dialog("destroy");
                        $("#user_dialog_" + to_user_id + "_" + from_user_id).hide();
                        var j = box_number[2];
                        closed_box++;

                        for (i = j; i <= parseInt(series_num); i++) {

                            var right_value = (25 * parseInt(i)) - 25 * parseInt(closed_box);

                            var box_num = parseInt(i) + 1;
                            $('[aria-labelledby="ui-id-' + box_num + '"]').attr('style', 'right: ' + right_value + '% !important');

                            //alert('[aria-labelledby="ui-id-'+box_num+'"]');
                            //alert('right: '+right_value+'% !important');

                        }
                    }
                });

                //alert('#user_dialog_' + to_user_id + "_" + from_user_id);

                $("#user_dialog_" + to_user_id + "_" + from_user_id).dialog('open');
                $('#chat_message_' + to_user_id + "_" + from_user_id).emojioneArea({
                    pickerPosition: "top",
                    toneStyle: "bullet"
                });
                var str = "user_dialog_" + to_user_id + "_" + from_user_id;
                right_value = (opened_box - closed_box) * 25;
                //alert(right_value);
                $('[aria-describedby="' + str + '"]').attr('style', 'right: ' + right_value + '% !important');
                var box_series1 = $('[aria-describedby="' + str + '"]').attr('aria-labelledby');
                var box_number1 = box_series1.split("-");
                series_num = box_number1[2];
                opened_box++;
                $('.ui-widget-overlay').attr('style', 'z-index: -1 !important');
                // $('#chat_history_' + to_user_id + "_" + from_user_id).html('okkk');
                //console.log("before=="+$('#chat_history_' + to_user_id + "_" + from_user_id).get(0).scrollHeight);
                update_chat_history_data();
                //console.log("after=="+$('#chat_history_' + to_user_id + "_" + from_user_id).get(0).scrollHeight);
                $(".chat_history").stop().animate({ scrollTop: $('#chat_history_' + to_user_id + "_" + from_user_id).get(0).scrollHeight }, 1000);


            }

        }
    })
}
setInterval(function() {
    update_last_activity();
    fetch_user();
    //update_chat_history_data();
    update_chat_history_data_last();
    //alert('okkk')
    check_box_open();
    check_del_status();
    //jQuery("div.chat_message").offset().top;
    //$('.chat_message').scrollIntoView(true);
}, 3000);


function insertNotification(touserid, fromuserid, msg, mobile, email_id, whatsappmobile, toname) {

    $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        data: {
            action: 'insertnotification', // this is the function in your functions.php that will be triggered
            touserid: touserid,
            fromuserid: fromuserid,
            msg: msg,
            mobile: mobile,
            emailid: email_id,
            whatsappmobile: whatsappmobile,
            toname: toname
        },
        success: function(data) {
            //Do something with the result from server
            // $('#start_chat_button_'+to_user_id).html(data);
            //console.log( data );
            update_chat_history_data();
        }
    })

}


function update_last_activity() {
    var session_user = $('#session_user').val();
    $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        data: {
            action: 'updateactivity', // this is the function in your functions.php that will be triggered
            from_user_id: session_user,
        },
        success: function(data) {
            //Do something with the result from server
            // $('#start_chat_button_'+to_user_id).html(data);
            //console.log( data );
        }
    })
}

function fetch_user() {
    $(".start_chat").each(function() {
        var from_user_id = $(this).attr('data-fromuserid');
        var to_user_id = $(this).attr('data-touserid');
        var user_name = $(this).attr('data-tousername');
        var from_status = $(this).attr('data-from_status');
        var to_status = $(this).attr('data-to_status');
        var from_role = $(this).attr('data-role');
        var img = $(this).attr('data-img');

        var to_mobile = $(this).attr('data-mobile');
        var msg = $(this).attr('data-msg');
        var to_email = $(this).attr('data-email');
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: 'POST',
            data: {
                action: 'fetchuser', // this is the function in your functions.php that will be triggered
                from_user_id: from_user_id,
                to_user_id: to_user_id,
                user_name: user_name,
                from_status: from_status,
                to_status: to_status,
                from_role: from_role,
                to_mobile: to_mobile,
                msg: msg,
                to_email: to_email,
                img: img,
            },
            success: function(data) {
                //Do something with the result from server
                $('#start_chat_button_' + to_user_id + "_" + from_user_id).html(data);
                //console.log( data );
            }
        })
    });
}

function update_chat_history_data() {
    $('.chat_history').each(function() {
        var to_user_id = $(this).data('touserid');
        var session_user = $('#session_user').val();
        fetch_user_chat_history(to_user_id, session_user);
    });
}

function update_chat_history_data_last() {
    $('.chat_history').each(function() {
        var to_user_id = $(this).data('touserid');
        var session_user = $('#session_user').val();
        fetch_user_chat_history_last(to_user_id, session_user);
    });
}

var scrollheight = 0;

function fetch_user_chat_history_last(to_user_id, from_user_id) {

    $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        data: {
            action: 'userchathistorylast', // this is the function in your functions.php that will be triggered
            from_user_id: from_user_id,
            to_user_id: to_user_id
        },
        success: function(data) {
            //Do something with the result from server

            scrollheight += $(".chat_history")[0].scrollHeight;
            if (data.trim() != '') {
                $('#chat_history_' + to_user_id + "_" + from_user_id).append(data);
                //console.log("last="+data+"height=="+scrollheight+"==="+data.localeCompare("empty"));
                $(".chat_history").stop().animate({ scrollTop: $(".chat_history")[0].scrollHeight }, 1000);
            }

            //console.log( data );
        }
    })

}

function check_del_status() {
    $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        data: {
            action: 'checkdelstatus', // this is the function in your functions.php that will be triggered
        },
        success: function(data) {
            if (data.trim() == 'refresh_needed') {
                update_chat_history_data();
            }
            //console.log( data );
        }
    })
}

function fetch_user_chat_history(to_user_id, from_user_id) {

    $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        data: {
            action: 'userchathistory', // this is the function in your functions.php that will be triggered
            from_user_id: from_user_id,
            to_user_id: to_user_id
        },
        success: function(data) {
            //Do something with the result from server
            $('#chat_history_' + to_user_id + "_" + from_user_id).append(data);
            $(".chat_history").stop().animate({ scrollTop: $(".chat_history")[0].scrollHeight + 400 }, 1000);
            //console.log( data );
        }
    })

}

var inapropiateWord = ['Fuck', 'Fuck you', 'Shit', 'Piss off', 'Dick head', 'Crikey', 'Rubbish', 'Shag', 'Wanker', 'Fuck off', 'Bugger off', 'jerk', 'Asshole', 'Son of a bitch', 'Bastard', 'Bitch', 'Damn', 'Taking the piss', 'Twat', 'Root', 'Get Stuffed', 'Scoundrel', 'Piece of shit', 'Piece of crap', 'Bullshit', 'Cunt', 'Bollocks', 'Bugger', 'Bloody Hell', 'Choad', 'Bugger me', 'Prick', 'Ass', 'Arse', 'Balls', 'Crap', 'Shit face', 'Motherfucker'];

function insertData(to_user_id, from_user_id, msg = '') {

    if (msg == '') {
        var chat_message = $('#chat_message_' + to_user_id + "_" + from_user_id).val();
        var file_name = $('#file_' + to_user_id + "_" + from_user_id).val();

        var is_file = '';
        if (file_name != '') {
            chat_message = file_name;
            is_file = 'yes';
        }
    } else {
        chat_message = msg;
    }
    //console.log('okkk=='+chat_message);
    if (chat_message == '')
        return (false);

    chat_message = chat_message.replace(/(<([^>]+)>)/ig, "");
    var lwrMyValue = chat_message.toLowerCase();
    var lwrMyArr = inapropiateWord.map(function(ele) { return ele.toLowerCase(); });
    console.log("msg=" + lwrMyValue + 'inapp==' + lwrMyArr);
    if ($.inArray(lwrMyValue, lwrMyArr) !== -1) {
        alert('Use of abusive language is not permissible');
        return (false);
    }

    var element = $('#chat_message_' + to_user_id + "_" + from_user_id).emojioneArea();
    element[0].emojioneArea.setText('');
    $('#msg').html('');
    $('#selectFile').val('');
    var dataId = $('#selectFile').attr("data-id");
    $('#file_' + dataId).val('');

    $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        data: {
            'action': 'chatinsert',
            'chat_message': chat_message,
            'from_user_id': from_user_id,
            'is_file': is_file,
            'to_user_id': to_user_id
        },

        success: function(data) {
            // var element = $('#chat_message_' + to_user_id + "_" + from_user_id).emojioneArea();
            // element[0].emojioneArea.setText('');
            //$('#chat_history_'+to_user_id).html(data);
            update_chat_history_data_last();
            //   $('#msg').html('');
            //   $('#selectFile').val('');
            //   var dataId = $('#selectFile').attr("data-id");
            //   $('#file_' + dataId).val('');


            console.log(data);
        }
    })

}


// delete message
function delete_msg(f) {
    var checkValues = $('input[name=msgid]:checked').map(function() {
        return $(this).val();
    }).get();
    var to_user_id = $(f).attr('data-to');
    var from_user_id = $(f).attr('data-from');
    $('.chat_dropdown_modal').fadeOut();
    if (checkValues.length == 0) {
        alert("Please select at least one message");
        return false;
    }

    var x = confirm("This consultation will be deleted forever. Are you sure you want to delete this consultation?");
    if (x) {
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: 'POST',
            data: {
                action: 'delmsg', // this is the function in your functions.php that will be triggered
                to_user_id: to_user_id,
                from_user_id: from_user_id,
                ids: checkValues

            },
            success: function(data) {
                update_chat_history_data();

            }
        })
    } else {
        return false;
    }

}

// single user chat messsage
function fetchuserchat() {

    var user = $("#user option:selected").val();
    var therapist = $("#therapist option:selected").val();
    var from_date = $("#bday3").val();
    var to_date = $("#bday4").val();
    $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        data: {
            action: 'fetchuserchat', // this is the function in your functions.php that will be triggered
            user: user,
            therapist: therapist,
            from_date: from_date,
            to_date: to_date
        },
        success: function(data) {


            $('#chat_message_therapist_span').html(data);
        }
    })


}

function show_chat_therepist_user(f) {
    var user = $(f).attr('data-from');
    var therapist = $(f).attr('data-to');

    var from_date = $("#bday").val();
    var to_date = $("#bday2").val();
    $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        data: {
            action: 'fetchuserchat', // this is the function in your functions.php that will be triggered
            user: user,
            therapist: therapist,
            from_date: from_date,
            to_date: to_date
        },
        success: function(data) {
            //$('#chat_message_therapist_span').html('');
            $('#logs_therapist').html(data);
            // $('#chat_message_therapist_span').html(data);
        }
    })
}

//fetch all users chat

function viewlogschat() {
    var from_date = $("#bday").val();
    var to_date = $("#bday2").val();
    $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        data: {
            action: 'fetchuserchat', // this is the function in your functions.php that will be triggered
            from_date: from_date,
            to_date: to_date
        },
        success: function(data) {
            $('#chat_message_therapist_span').html('');
            $('#logs_therapist').html(data);
        }
    })
}

// single user chat messsage
function viewlogstherapist() {


    var from_date = $("#bday").val();
    var to_date = $("#bday2").val();
    $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        data: {
            action: 'viewlogstherapist', // this is the function in your functions.php that will be triggered
            from_date: from_date,
            to_date: to_date
        },
        success: function(data) {
            //console.log(data) 
            $('#logs_therapist').html('');
            $('#chat_message_therapist_span').html(data);
        }
    })


}

function viewlogsuser() {


    var from_date = $("#bday").val();
    var to_date = $("#bday2").val();
    $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        data: {
            action: 'viewlogsuser', // this is the function in your functions.php that will be triggered
            from_date: from_date,
            to_date: to_date
        },
        success: function(data) {
            //console.log(data) 
            $('#logs_therapist').html('');
            $('#chat_message_therapist_span').html(data);
        }
    })


}

// delete message
function delete_msggrp(e) {
    var to_user = $(e).attr('data-to_user');
    var from_user = $(e).attr('data-from_user');
    var x = confirm("This consultation will be deleted forever. Are you sure you want to delete this consultation?");
    if (x) {
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: 'POST',
            data: {
                action: 'delmsggrp', // this is the function in your functions.php that will be triggered
                to_user: to_user,
                from_user: from_user,

            },
            success: function(data) {
                console.log(data);
                location.reload(true);


            }
        })
    } else {
        return false;
    }

}



// complete message
function closeModal(modalId, from_user_id) {
    insertData(modalId, from_user_id, 'Your consultation is now complete.Please reach out to me in case you have any additional questions.');
    //	alert("user_dialog_"+modalId);
    // $("#user_dialog_" + modalId+"_"+from_user_id).dialog('close')


}
// file upload

function upload(f) {
    var property = f.files[0];
    var form_data = new FormData();
    form_data.append("file", property);
    $.ajax({
        url: '/upload.php',
        method: 'POST',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#msg').html('Loading......');
        },
        success: function(data) {
            //console.log(data);
            var arr = data.split('&');
            if (arr[1].trim() != 'text') {
                $('#msg').html(arr[0]);
                $('#text_msg').html('');
                $('#file_' + $(f).attr("data-id")).val(arr[1]);
            } else {
                $('#msg').html('');
                $('#text_msg').html(arr[0]);
            }

        }
    });
}


// // new event
// $(document).ready(function() {
//     $(".dots_iconz1").click(function() {
//         alert("hi...");
//         // $("#faq").show();
//         // $("#del").hide();
//     });
// });