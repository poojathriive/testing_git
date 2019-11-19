<?php
include '../connection.php';
$waf_id = $_GET['acf'];
echo $wafID_decode = base64_decode($waf_id);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html {
            background-image: linear-gradient(to right, #68009c, rgb(136, 48, 232));
        }

        input[type=text],
        input[type=password],
        input[type=number],
        input[type=email],
        input[type=date],
        textarea {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #8227da;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
            position: relative;
        }

        img.user {
            width: 20%;
            border-radius: 50%;
            top: -10px;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto 15% auto;
            border: 1px solid #888;
            width: 30%;
            box-shadow: 2px 10px 20px #000;
            border-radius: 5px;
        }

        /* The Close Button (x) */
        .close {
            position: absolute;
            right: 25px;
            top: 0;
            color: #000;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: red;
            cursor: pointer;
        }

        .col-md-6 {
            max-width: 49% !important;
        }

        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes animatezoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }

        @media screen and (max-width: 900px) {
            .modal-content {
                width: 90% !important;
                margin: 30% auto 15% auto !important;
            }
        }

        .custom-radio {
            padding: 15px !important;
            cursor: pointer;
            color: #8329dc;
            font-weight: 600;
        }
        .rating{
            text-align: center;
            letter-spacing: 10px;
            font-size: 24px;
            color: #0000008c;
        }
        .red{
            color: red;
        }
    </style>
</head>
    
<body>
    <div>
        <form class="modal-content" action="" method="POST">
            <div class="imgcontainer">
                <img src="../assets/static/images/Screenshot_1.png" alt="Thriive" class="user">
            </div>
            <div class="container">
                <input type="hidden" value="<?php echo $waf_id?>" name="fid" readonly><br>
            <div class="container rating">
                <span id="check"  onclick="checkFunction()" class="fa fa-star fa-md"></span>
                <span id="check2" onclick="checkFunction2()" class="fa fa-star fa-md"></span>
                <span id="check3" onclick="checkFunction3()" class="fa fa-star fa-md"></span>
                <span id="check4" onclick="checkFunction4()" class="fa fa-star fa-md"></span>
                <span id="check5" onclick="checkFunction5()" class="fa fa-star fa-md"></span>
            </div><br>
                <label><b> Write Your Feedback *</b></label>
                <textarea name="message" required></textarea>
                <input type="hidden" value="" name="rate" id="myrate">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
    <script>
            function checkFunction(){
            var test12 = document.getElementById("check").classList.add('red');
            document.getElementById("myrate").value = "1";
            }
            function checkFunction2(){
            document.getElementById("check2").classList.add('red');
            document.getElementById("check").classList.add('red');
            document.getElementById("myrate").value = "2";   
            }
            function checkFunction3(){
            document.getElementById("check3").classList.add('red');
            document.getElementById("check2").classList.add('red');
            document.getElementById("check").classList.add('red');
            document.getElementById("myrate").value = "3";
            }
            function checkFunction4(){
            document.getElementById("check4").classList.add('red');
            document.getElementById("check3").classList.add('red');
            document.getElementById("check2").classList.add('red');
            document.getElementById("check").classList.add('red');
            document.getElementById("myrate").value = "4";
            }
            function checkFunction5(){
            document.getElementById("check5").classList.add('red');
            document.getElementById("check4").classList.add('red');
            document.getElementById("check3").classList.add('red');
            document.getElementById("check2").classList.add('red');
            document.getElementById("check").classList.add('red');
            document.getElementById("myrate").value = "5";
            }
    </script>
</body>
</html>
<?php
    if(isset($_POST['submit'])){
        $feedback_id = $_POST['fid'];
        $feedback = $_POST['rate'];
        $comments = $_POST['message'];
        
        $insert_query = "UPDATE webhook_after_call SET feedback = '$feedback',comments = '$comments', date_time = '$submit_date' WHERE uid = '$wafID_decode'";
        $insert_query_run = mysqli_query($connection,$insert_query);
        if($insert_query_run){echo '<script>window.location="https://www.thriive.in/"</script>';}
    }
?>