/*
 * jQuery File Upload Plugin JS Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';

    //Single file upload
    $(".single_upload.fileupload input").change(function()
    {
        $(this).closest(".single_upload.fileupload").find(".files").html("");
    });


    // Initialize the jQuery File Upload widget:
    var field_name = "";
    var url = "";
    
    $('.fileupload input').click(function()
    {
        var $this = $(this);
        field_name = $(this).attr('data-name');
        url = $(this).attr('data-url');
        var getPreview = $(this).closest(".form-group").find(".imagePreview").html();
        $('button[name="submit_verification_details"]').attr('disabled','disabled');
        //$('#btn_verification_submit').hide();
        //var asd = $(".template-upload").length;
//      console.log(asd);
        $('#btn_verification_submit').attr('disabled','disabled');

        $('.fileupload').fileupload({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: url,
            formData : {field_name: field_name},
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png|pdf)$/i,
            maxFileSize: 20971520,
            imageMaxWidth: 800,
            imageMaxHeight: 800,
            imageCrop: false // Force cropped images
        }).on('fileuploaddone', function (e, data) {
            //Removing <tr> on uploaded.
            $(data.context[0]).remove();
            //console.log(getPreview);
            if($(this).hasClass('single_upload'))
            {
                $(this).closest(".form-group").find(".imagePreview").html('<img src="' + data.result.files[0].image_url[0] + '" />').show(); 
            }
            else
            {
                if(data.result.files[0].type == 'application/pdf')
                {
                    var hostname = (window.location.hostname == 'localhost') ? 'http://localhost/thriive-dev' : window.location.origin;
                    var getImg= '<img src="' + hostname + '/wp-content/themes/thriive/assets/images/pdf_thumbnail.png" />';
                }
                else
                {
                    var getImg= '<img src="' + data.result.files[0].image_url[0] + '" />';
                }
                
                getPreview += getImg;
                // $(this).closest(".form-group").find(".imagePreview").append('<img src="' + data.result.files[0].image_url + '" />'); 
                $(this).closest(".form-group").find(".imagePreview").html(getPreview).show(); 
            }
            var template_upload = $(".template-upload").length;
            if(template_upload <= 0)
            {
                $('#btn_verification_submit').removeAttr('disabled');
            }
            return;     
        });

        // Enable iframe cross-domain access via redirect option:
        // $('.fileupload').fileupload(
        //     'option',
        //     'redirect',
        //     window.location.href.replace(
        //         /\/[^\/]*$/,
        //         '/cors/result.html?%s'
        //     )
        // );

        return;
    });


});
