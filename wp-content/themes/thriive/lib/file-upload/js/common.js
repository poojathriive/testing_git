$(".fileinput-button input").on("change", function()
    {
        if($(this).length > 0)
        {
            $('button[name="submit_verification_details"]').attr('disabled','disabled');
        }
    });
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    //var url = window.location.hostname === 'blueimp.github.io' ? '//jquery-file-upload.appspot.com/' : 'server/php/';
    var field_name = $('#pancard-upload').attr('data-name');
    var url = $('#pancard-upload').attr('data-url');
    $('#pancard-upload').fileupload({
        url: url,
        formData : {field_name: field_name},
        dataType: 'json',
        done: function (e, data) 
        {
            //console.log(data);
            // $.each(data.result.files, function (index, file) {
            //     $('<p/>').text(file.name).appendTo('#files');
            // });
            $(this).closest(".form-group").find('#progress').hide();
            $(this).closest(".form-group").find('#progress .progress-bar').css('width','0');
            var getPreview = $(this).closest(".form-group").find(".imagePreview").html();
            if(data.result.files[0].type == 'application/pdf')
            {
                var hostname = (window.location.hostname == 'localhost') ? 'http://localhost/thriive-dev' : window.location.origin;
                var getImg= '<img src="' + hostname + '/wp-content/themes/thriive/assets/images/pdf_thumbnail.png" />';
            }
            else
            {
                var getImg= '<img src="' + data.result.files[0].image_url[0] + '" />';
            }
            getPreview = getImg;

            $(this).closest(".form-group").find(".imagePreview").html(getPreview).show();
            $('#btn_verification_submit').removeAttr('disabled');
        },
        fail: function (e, data) 
        {
            //console.log(data);
            $(this).closest(".form-group").find('#progress').hide();
            $(this).closest(".form-group").find('#progress .progress-bar').css('width','0');
            $('#btn_verification_submit').removeAttr('disabled');
        },
        progressall: function (e, data) 
        {
            //console.log(data);
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $(this).closest(".form-group").find('#progress').show();
            $(this).closest(".form-group").find('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
            $('button[name="submit_verification_details"]').attr('disabled','disabled');
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    //var url = window.location.hostname === 'blueimp.github.io' ? '//jquery-file-upload.appspot.com/' : 'server/php/';
    var field_name = $('#profile_pic').attr('data-name');
    var url = $('#profile_pic').attr('data-url');
    $('#profile_pic').fileupload({
        url: url,
        formData : {field_name: field_name},
        dataType: 'json',
        done: function (e, data) 
        {
            //console.log(data);
            // $.each(data.result.files, function (index, file) {
            //     $('<p/>').text(file.name).appendTo('#files');
            // });
            $(this).closest(".form-group").find('#progress').hide();
            $(this).closest(".form-group").find('#progress .progress-bar').css('width','0');
            $(this).closest(".form-group").find(".imagePreview").html('<img src="' + data.result.files[0].image_url[0] + '" />').show();
            $('#btn_verification_submit').removeAttr('disabled');
        },
        fail: function (e, data) 
        {
            //console.log(data);
            $(this).closest(".form-group").find('#progress').hide();
            $(this).closest(".form-group").find('#progress .progress-bar').css('width','0');
            $('#btn_verification_submit').removeAttr('disabled');
        },
        progressall: function (e, data) 
        {
            //console.log(data);
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $(this).closest(".form-group").find('#progress').show();
            $(this).closest(".form-group").find('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
            $('button[name="submit_verification_details"]').attr('disabled','disabled');
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});



$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    //var url = window.location.hostname === 'blueimp.github.io' ? '//jquery-file-upload.appspot.com/' : 'server/php/';
    var field_name = $('#certificate').attr('data-name');
    var url = $('#certificate').attr('data-url');
    $('#certificate').fileupload({
        url: url,
        formData : {field_name: field_name},
        dataType: 'json',
        done: function (e, data) 
        {
            //console.log(data);
            // $.each(data.result.files, function (index, file) {
            //     $('<p/>').text(file.name).appendTo('#files');
            // });
            $(this).closest(".form-group").find('#progress').hide();
            $(this).closest(".form-group").find('#progress .progress-bar').css('width','0');
            //$(this).closest(".form-group").find(".imagePreview").html('<img src="' + data.result.files[0].image_url[0] + '" />').show();

            var getPreview = $(this).closest(".form-group").find(".imagePreview").html();
            if(data.result.files[0].type == 'application/pdf')
            {
                var hostname = (window.location.hostname == 'localhost') ? 'http://localhost/thriive-dev' : window.location.origin;
                var getImg= '<div class="preview_wrap"><span class="close" data-id="'+data.result.files[0].attach_id+'" data-row_id="'+data.result.files[0].row_id+'">x</span><img src="' + hostname + '/wp-content/themes/thriive/assets/images/pdf_thumbnail.png" /></div>';
            }
            else
            {
                var getImg= '<div class="preview_wrap"><span class="close" data-id="'+data.result.files[0].attach_id+'" data-row_id="'+data.result.files[0].row_id+'">x</span><img src="' + data.result.files[0].image_url[0] + '" /></div>';
            }
            getPreview += getImg;
            // $(this).closest(".form-group").find(".imagePreview").append('<img src="' + data.result.files[0].image_url + '" />'); 
            $(this).closest(".form-group").find(".imagePreview").html(getPreview).show();
            $('#btn_verification_submit').removeAttr('disabled');
        },
        fail: function (e, data) 
        {
            //console.log(data);
            $(this).closest(".form-group").find('#progress').hide();
            $(this).closest(".form-group").find('#progress .progress-bar').css('width','0');
            $('#btn_verification_submit').removeAttr('disabled');
        },
        progressall: function (e, data) 
        {
            //console.log(data);
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $(this).closest(".form-group").find('#progress').show();
            $(this).closest(".form-group").find('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
            $('button[name="submit_verification_details"]').attr('disabled','disabled');
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});