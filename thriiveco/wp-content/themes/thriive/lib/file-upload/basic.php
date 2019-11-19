<!DOCTYPE HTML>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>(MY) jQuery File Upload Demo - Basic version</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.fileupload.css">

</head>
<body>

<div class="container">
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <div id="files" class="files"></div>
</div>

<!-- JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/vendor/jquery.ui.widget.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>
<script>
$(function () 
{
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ? '//jquery-file-upload.appspot.com/' : 'server/php/';
    $('#fileupload').fileupload(
    {
        url: url,
        dataType: 'json',
        done: function (e, data) 
        {
            $.each(data.result.files, function (index, file) 
            {
                $('<p/>').text(file.name).appendTo('#files');
            });
        },
        progressall: function (e, data) 
        {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
</body>
</html>
