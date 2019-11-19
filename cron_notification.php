<?php 

$to="tarun.agarwal@rabbitdigital.in";  
  $subject = "Taruuma landing page-  form details";
$message = "hello";      
$from_mail="tarun.agarwal@rabbitdigital.in";
$header = "From: ".$from_mail." \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";   
 $sent = mail($to,$subject,$message,$header);  
if($sent)
echo "sent";
else
echo "not sent";
// date_default_timezone_set('Asia/Kolkata'); 
 // require_once("/var/www/html/chat/wp-load.php");
 // $link = mysqli_connect('localhost', 'rabbit', 'Rabbit@123');
// if (!$link) {
    // die('Not connected : ' . mysqli_error());
// }

// $db_selected = mysqli_select_db($link,'live_chat');
// if (!$db_selected) {
    // die ('Can\'t use foo : ' . mysqli_error());
// }

   // $str_chat = "select * from  `notification_details` as a where send_status < 2 and reply_status = 0";
// $query_chat = $link->query($str_chat);
// while ($row_chat = $query_chat->fetch_assoc())
// {
	 // $message_sent = $row_chat['date_time'];
	
	// $mobile = '91'.$row_chat['mobile'];
	// $message = $row_chat['message'];
	 // $cur_time=date("Y-m-d H:i");
// $duration=10;
	// $new_time = date('Y-m-d H:i', strtotime('+'.$duration.' minutes', strtotime($message_sent)));

	// if(strtotime($cur_time) == strtotime($new_time))
	// {
	// sendMSG($mobile,$message);
		// $query = "update notification_details set send_status = send_status +1 where id=".$row['id'];
	// $query_chat1 = $link->query($query);
	// }
	// $duration=20;
	// $new_time = date('Y-m-d H:i', strtotime('+'.$duration.' minutes', strtotime($message_sent)));
	// if(strtotime($cur_time) == strtotime($new_time) && $row_chat['reply_status'] == 0)
	// {
	// $wpdb->insert("chat_message_details", array(
   // $to_user_id = $row['to_user_id'];
  // $from_user_id = $row['to_user_id'];
    // $chat_message = 'Therapist is busy or not available right now, please leave a message or try other therapist with same modalities with link.';
  // $status = 0;
	 // $is_file = 'no';
	// $terepist_status = 0;
   // $chat_time = date('Y-m-d h:i:s'),
// ));
		// $query1 = "insert into chat_message_details (to_user_id,from_user_id,status,is_file,terepist_status,chat_time) values ('".$to_user_id."','".$from_user_id."','".$chat_message."','".$status."','".$is_file."','".$terepist_status."','".$chat_time."')";
		// $query_chat1 = $link->query($query1);
	// $query = "update notification_details set send_status = send_status +1,reply_status = 2 where id=".$row['id'];
	// $query_chat1 = $link->query($query);	
	// }
	
// }
?>