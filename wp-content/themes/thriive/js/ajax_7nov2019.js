function make_chat_dialog_box(to_user_id, to_user_name, from_user_id = '', user_role = "", img = "") {
    var dailogbox_id = 'user_dialog_' + to_user_id;
    var modal_content = '<div id="user_dialog_' + to_user_id + '" class="user_dialog" title="You have chat with ' + to_user_name + '">';
    modal_content += '<div style="height:200px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '"><div class="chat_details"><img src="/wp-admin/uploads/user_pic1.png"/><h4>' + to_user_name + '</h4></div>';
    modal_content += fetch_user_chat_history(to_user_id, from_user_id);
    modal_content += '</div><input type= "hidden" id="file_' + to_user_id + '" value="">';
    modal_content += '<div class="form-group">';
    modal_content += '<textarea name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id + '" class="form-control chat_message"></textarea>';
    modal_content += '</div><div class="form-group" align="right">';
    if (user_role == 'subscriber') {
        modal_content += '<button type="button" id= "del" style="float:left">Delete</button></span>';
    } else {
        modal_content += '<button type="button" data-toid="' + to_user_id + '" id= "complete" style="float:left" onclick="closeModal(' + to_user_id + ',' + from_user_id + ')" >Complete</button>';
    }
    modal_content += '<a href="http://35.232.100.164/faq/faq.html" target="_blank"><button type="button" id= "faq" style="float:left">FAQ</button></a></span>';

    modal_content += '<span id="msg" style="color:red"></span><br/><input type="file" id="selectFile" data-id="' + to_user_id + '" style="float:left" />';
    modal_content += '<button type="button" name="send_chat"  class="btn btn-info send_chat"  onclick="insertData(' + to_user_id + ',' + from_user_id + ');">Send</button></div></div>';

    $('#user_model_details').html(modal_content);
}
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
        alert('This therapist is offline now, we will send you a notification as soon as the therapist is available.');
        insertNotification(to_user_id, from_user_id, msg, to_mobile, to_email, to_mobile, to_user_name);

        return false;
    }
    var from_role = $(this).attr('data-role');
    var to_user_name = $(this).data('tousername');
    var from_user_id = $(this).data('fromuserid');
    var img = $(this).data('data-img');
    make_chat_dialog_box(to_user_id, to_user_name, from_user_id, from_role, img);
    $("#user_dialog_" + to_user_id).dialog({
        width: 400
    });
    $('#user_dialog_' + to_user_id).dialog('open');
    $('#chat_message_' + to_user_id).emojioneArea({
        pickerPosition: "top",
        toneStyle: "bullet"
    });
    $('[aria-labelledby="ui-id-2"]').attr('style', 'right: 15% !important');
    $('[aria-labelledby="ui-id-3"]').attr('style', 'right: 30% !important');
    $('[aria-labelledby="ui-id-4"]').attr('style', 'right: 45% !important');
    $('[aria-labelledby="ui-id-5"]').attr('style', 'right: 60% !important');
    $('[aria-labelledby="ui-id-6"]').attr('style', 'right: 75% !important');

});

function make_chat_dialog_box1(to_user_id, to_user_name, from_user_id = '', user_role = "") {
    var dailogbox_id = 'user_dialog_' + to_user_id;
    var modal_content = '<div id="user_dialog_' + to_user_id + '" class="user_dialog" title="You have chat with ' + to_user_name + '">';
    modal_content += '<div style="height:200px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';
    modal_content += fetch_user_chat_history(to_user_id, from_user_id);
    modal_content += '</div><input type= "hidden" id="file_' + to_user_id + '" value="">';
    modal_content += '</div><input type= "hidden" id="file_' + to_user_id + '" value="">';
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
    // alert(to_user_id);
    // alert(to_user_name);
    // alert(from_user_id);
    // alert(from_role);

    make_chat_dialog_box1(to_user_id, to_user_name, from_user_id, from_role);
    $("#user_dialog_" + to_user_id).dialog({
        width: 400
    });
    $('#user_dialog_' + to_user_id).dialog('open');

});
$(document).ready(function() {
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
                console.log(data);
                var arr = data.split('-');
                var to_user_id = arr[0];
                var to_user_name = arr[1];
                var from_user_id = arr[2];
                var from_role = arr[3];

                if (!$("#user_dialog_" + to_user_id).is(":visible") && data != 'null') {

                    console.log(data);
                    make_chat_dialog_box(to_user_id, to_user_name, from_user_id, from_role);
                    $("#user_dialog_" + to_user_id).dialog({
                        width: 400
                    });
                    $('#user_dialog_' + to_user_id).dialog('open');
                    $('#chat_message_' + to_user_id).emojioneArea({
                        pickerPosition: "top",
                        toneStyle: "bullet"
                    });
                    update_chat_history_data();
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
        //jQuery("div.chat_message").offset().top;
        //$('.chat_message').scrollIntoView(true);
    }, 3000);
});

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
                $('#start_chat_button_' + to_user_id).html(data);
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
            $('#chat_history_' + to_user_id).append(data);
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
            $('#chat_history_' + to_user_id).html(data);
            //console.log( data );
        }
    })

}


function insertData(to_user_id, from_user_id, msg = '') {
    if (msg == '') {
        var chat_message = $('#chat_message_' + to_user_id).val();
        var file_name = $('#file_' + to_user_id).val();
        var is_file = '';
        if (file_name != '') {
            chat_message = file_name;
            is_file = 'yes';
        }
    } else {
        chat_message = msg;
    }
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
            var element = $('#chat_message_' + to_user_id).emojioneArea();
            element[0].emojioneArea.setText('');
            //$('#chat_history_'+to_user_id).html(data);
            update_chat_history_data_last();
            $('#msg').html('');
            $('#selectFile').val('');
            var dataId = $('#selectFile').attr("data-id");
            $('#file_' + dataId).val('');


            //console.log( data );
        }
    })

}


// delete message
$(document).on('click', '#del', function() {
    var checkValues = $('input[name=msgid]:checked').map(function() {
        return $(this).val();
    }).get();
    var x = confirm("This consultation will be deleted forever. Are you sure you want to delete this consultation?");
    if (x) {
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: 'POST',
            data: {
                action: 'delmsg', // this is the function in your functions.php that will be triggered
                ids: checkValues

            },
            success: function(data) {
                update_chat_history_data();

            }
        })
    } else {
        return false;
    }

});

// delete signle conversation

// delete message
$(document).on('click', '#del1', function() {
    var to_user = $("#del1").attr('data-to_user');
    var from_user = $("#del1").attr('data-from_user');
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

});



// complete message
function closeModal(modalId, from_user_id) {
    insertData(modalId, from_user_id, 'Your consultation is now complete.Please reach out to me in case you have any additional questions.');
    //	alert("user_dialog_"+modalId);
    $("#user_dialog_" + modalId).dialog('close')


}
// file upload

$(document).on('change', '#selectFile', function() {
    var property = document.getElementById('selectFile').files[0];


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
            console.log(data);
            var arr = data.split('&');
            $('#msg').html(arr[0]);
            var dataId = $('#selectFile').attr("data-id");

            //console.log(dataId);
            //console.log($(this).data("id"));
            //console.log($('#selectFile').attr("data-id"));

            $('#file_' + dataId).val(arr[1]);

        }
    });
});