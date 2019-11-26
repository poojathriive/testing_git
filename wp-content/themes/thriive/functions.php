<?php
/**
 * thriive functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package thriive
 */

/**
 * Include Framework Modules
 *
 * The $file_includes array determines the code libraries included in your theme.
 *
 * @since 0.0.1
 */

//define( 'WP_HOME', 'http://35.232.100.164' );
//define( 'WP_SITEURL', 'http://35.232.100.164' );
 
 //SMS gateway url
define("SMS_URL","http://ems-api.startenterprise.com:8080/bulksms/bulksms?"."username=THRIIVEOTP&password=SkaeXmPn&type=0&dlr=1&source=THRIIV&");


//pay u details
if($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == 'thriive.noesis.tech' || $_SERVER['SERVER_NAME'] == 'thriive-staging.noesis.tech')
{
    //For Dev & Staging
    define('MERCHANT_KEY','gtKFFx');
    define('SALT','eCwWELxi');
    define('PAYU_BASE_URL','https://test.payu.in/_payment');
    define('RECAPTCHA_SITE_KEY','6LfbdrQUAAAAAJ59S3WxMJ5k-KXs7IS1EUjM4mUA');
    define('RECAPTCHA_SITE_SECRET','6LfbdrQUAAAAAEvsoVLj6GP5DQO6BvieKio4WrLh');
}
else
{
    //For live 
    define('MERCHANT_KEY','fsZR5l');
    define('SALT','C0SiMqcB');
    define('PAYU_BASE_URL','https://secure.payu.in/_payment');
    define('RECAPTCHA_SITE_KEY','6LeSIbQUAAAAABKLl6Kma4t-lRG6gAZDD9fZwUaq');
    define('RECAPTCHA_SITE_SECRET','6LeSIbQUAAAAAGWX3VAYuPCJG0MLl0Bd_TroVuU2');
}

define('HASH_SEQUENCE','key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10');
define('PAYU_RETURN_URL', site_url() . '/thank-you/');
    
 
$file_includes = array(
    'framework/actions.php',
    'framework/assets.php',
    'framework/core-functions.php',
    'framework/init.php',
    'framework/filters.php',
    'framework/custom-endpoints.php',
    'framework/custom-endpoint-callbacks.php',
    'framework/ajax_actions.php'
);

// Include files from $file_includes array.
foreach ($file_includes as $file) {
    include_once get_stylesheet_directory() . '/' . $file;
}

/**
 * Required Files
 *
 * The $file_requires array determines the required files in your theme.
 *
 * @since 0.0.1
 */
$file_requires = array(
    'custom-header.php', // Implement the Custom Header feature.
    'template-tags.php', // Custom template tags for this theme.
    'template-functions.php', // Functions which enhance the theme by hooking into WordPress.
    'customizer.php' // Customizer additions.
);

// Include files from $file_requires array.
foreach ($file_requires as $file) {
    require get_template_directory() . '/inc/' . $file;
}

/**
 * Load Jetpack compatibility file.
 *
 * The loads Jetpack compatibility file.
 *
 * @since 0.0.1
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

add_filter('rewrite_rules_array', 'insert_custom_rules');

add_filter('query_vars', 'insert_custom_vars');


function insert_custom_vars($vars){        

    $vars[] = 'main_page';       

    return $vars;

}

function insert_custom_rules($rules) {

    $newrules = array();

    $newrules=array(
        'page-name/(.+)/?' => 'index.php?pagename=page-name&main_page=$matches[1]'
    );

    return $newrules + $rules;
}
add_action('admin_menu', 'chat_dashboard_admin_menu');
 
/**
* add external link to Tools area
*/
function chat_dashboard_admin_menu() {
    global $submenu;
    $url = '/admin-chat-dashboard';
    $submenu['index.php'][] = array('Chat Dashboard', 'manage_options', $url);
}
add_action( 'wp_enqueue_scripts', 'so_enqueue_scripts' );
function so_enqueue_scripts(){
  wp_register_script( 
    'ajaxHandle', 
   
    array(), 
    false, 
    true 
  );
  wp_enqueue_script( 'ajaxHandle' );
  wp_localize_script( 
    'ajaxHandle', 
    'ajax_object', 
    array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) 
  );
}


add_action( "wp_ajax_userchathistory", "fetch_user_chat_history" );
add_action( "wp_ajax_nopriv_userchathistory", "fetch_user_chat_history" );
function fetch_user_chat_history(){
	global $wpdb;
		$current_user = wp_get_current_user();
	$role =  $current_user->role; 
$flag = 0;
	$to_user_id = $_POST['to_user_id'];
	$from_user_id = $_POST['from_user_id'];
      $query = " SELECT * FROM chat_message_details  WHERE ((from_user_id = ".$from_user_id."  AND to_user_id = ".$to_user_id.") OR (from_user_id = ".$to_user_id." AND to_user_id = ".$from_user_id.")) and (delete_status = 0)  ORDER BY chat_message_id ASC ";
	$result = $wpdb->get_results($query);
	//print_r($result);
$therepist_data = get_userdata( $to_user_id);
	$t_name = get_user_name($to_user_id);
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
		  
	 $chat_message = $row->chat_message;
	  $location = $row->chat_message;
	 
	 $is_file = $row->is_file;
	 if($is_file == 'yes')
	 {
		  $location = $row->chat_message;
		  $extension = pathinfo($chat_message, PATHINFO_EXTENSION);
		 if($extension == 'docs' || $extension == 'doc')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/wp-content/uploads/imagesword.png" height="100" width="100" /></a>';
}
 elseif($extension == 'xls' || $extension == 'xlsx')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/wp-content/uploads/imagesexcel.jpg" height="100" width="100" /></a>';
}
 elseif($extension == 'pdf')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/wp-content/uploads/images.png" height="100" width="100" /></a>';
}
elseif($extension == 'txt')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/wp-content/uploads/imagesfile.jpg" height="100" width="100" /></a>';
}
else if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png')
 {
 	$chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank" class="anch_linking"><img src="'.site_url().'/'.$location.'" height="100" width="100" /></a>';
$flag = 1;
 }
		 
	 }
  $user_name = '';
if($flag == 1)
{
$image_holder = $chat_message.'<p></p>';
}
else
{
$image_holder = '<p>'.$chat_message.'</p>';
}
if($row->from_user_id == $from_user_id)
  {

   $user_name = '<b class="text-success">You</b>';
 $output .= ' <li class="user_stats_lhs"  style="border-bottom:1px dotted #ccc;align:right">';
$output .= '<input type="checkbox" name = "msgid" value="'.$row->chat_message_id.'" style="opacity:1;position:relative;margin-right: 6px;float:left" class="checkSingle">';
	 $output .= '<div class="chat_content">
		 <div class= "chat_text">
		 	'.$image_holder.'
			<div class="chat_time">
			'.format_date($row->chat_time).'
			</div>
		 </div>
		<div class="chat_details">			
			<h4>'.$user_name.'</h4>
		</div>
		
    </div>
	
   </li>
  ';
 
  }
  else
  {
   $user_name = '<b class="text-danger">'.$t_name.'</b>';
 $output .= ' <li class="user_stats_rhs"  style="border-bottom:1px dotted #ccc;align:left">';
 $output .= '<div class="chat_content">
		 <div class= "chat_text">
			'.$image_holder.'
		 <div class="chat_time">
		'.format_date($row->chat_time).'
		</div>
		 </div>
		<div class="chat_details">			
			<h4>'.$user_name.'</h4>
		</div>
		
	</div>
   </li>
  ';
  }
}
 $output .= '</ul>';
if($role == 'subscriber')
	{
		$query = " UPDATE chat_message_details  SET user_status = '1'  WHERE (from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')   AND user_status = '0' ";
 $result = $wpdb->query($query);
}
	else
	{
		 $query = " UPDATE chat_message_details  SET terepist_status = '1'  WHERE (from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')   AND terepist_status = '0' ";
 $result = $wpdb->query($query);	
}
echo $output;
   wp_die(); // ajax call must die to avoid trailing 0 in your response
}


add_action( "wp_ajax_userchathistorylast", "fetch_user_chat_history_last" );
add_action( "wp_ajax_nopriv_userchathistorylast", "fetch_user_chat_history_last" );
function fetch_user_chat_history_last(){
	global $wpdb;
	$current_user = wp_get_current_user();
	 $role =  $current_user->role; 
	$to_user_id = $_POST['to_user_id'];
	$from_user_id = $_POST['from_user_id'];
$flag = 0;
	if($role == 'subscriber')
	{
     $query = " SELECT * FROM chat_message_details  WHERE ((from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')) and (user_status = 0) ORDER BY chat_time DESC limit 1 ";
$result = $wpdb->get_results($query);

	}
	else
	{
		 $query = " SELECT * FROM chat_message_details  WHERE ((from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')) and (terepist_status = 0) ORDER BY chat_time DESC limit 1 ";
		$result = $wpdb->get_results($query);
	}

	
	//print_r($result);
$output = '';
$therepist_data = get_userdata( $to_user_id);
$t_name = get_user_name($to_user_id);
	if(count($result) > 0)
	{
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
		  
	 $chat_message = $row->chat_message;
	  $location = $row->chat_message;
	 
	 $is_file = $row->is_file;
	 if($is_file == 'yes')
	 {
		  $location = $row->chat_message;
		  $extension = pathinfo($chat_message, PATHINFO_EXTENSION);
		if($extension == 'docs' || $extension == 'doc' || $extension == 'docx')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/wp-content/uploads/imagesword.png" height="100" width="100" /></a>';
}
 elseif($extension == 'xls' || $extension == 'xlsx')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/wp-content/uploads/imagesexcel.jpg" height="100" width="100" /></a>';
}
 elseif($extension == 'pdf')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/wp-content/uploads/images.png" height="100" width="100" /></a>';
}
elseif($extension == 'txt')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/wp-content/uploads/imagesfile.jpg" height="100" width="100" /></a>';
}
 else if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png')
 {
 	$chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank" class="anch_linking"><img src="'.site_url().'/'.$location.'" height="100" width="100" /></a>';
$flag = 1;
 }
		 
	 }
  $user_name = '';
if($flag == 1)
{
$image_holder = $chat_message.'<p></p>';
}
else
{
$image_holder = '<p>'.$chat_message.'</p>';
}
  if($row->from_user_id == $from_user_id)
  {

   $user_name = '<b class="text-success">You</b>';
 $output .= ' <li class="user_stats_lhs"  style="border-bottom:1px dotted #ccc;align:right">';
$output .= '<input type="checkbox" name = "msgid" value="'.$row->chat_message_id.'" style="opacity:1;position:relative;margin-right: 6px;float:left" class="checkSingle">';
	 $output .= '<div class="chat_content">
		 <div class= "chat_text">
'.$image_holder.'
		 <div class="chat_time">
		'.format_date($row->chat_time).'
		</div>
		 </div>
		<div class="chat_details">			
			<h4>'.$user_name.'</h4>
		</div>
		
	</div>
   </li>
  ';
 
  }
  else
  {
   $user_name = '<b class="text-danger">'.$t_name.'</b>';
 $output .= ' <li class="user_stats_rhs"  style="border-bottom:1px dotted #ccc;align:left">';
 $output .= '<div class="chat_content">
		 <div class= "chat_text">
		'.$image_holder.'
		 <div class="chat_time">
		'.format_date($row->chat_time).'
		</div>
		 </div>
		<div class="chat_details">			
			<h4>'.$user_name.'</h4>
		</div>
		
	</div>
   </li>
  ';
  }

 }

 $output .= '</ul>';
echo $output;

	//if($role == 'subscriber' && $output != '')
if($role == 'subscriber')
	{
		$query = " UPDATE chat_message_details  SET user_status = '1'  WHERE (from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')   AND user_status = '0' ";
 $result = $wpdb->query($query);
}
	else
	{
		$query = " UPDATE chat_message_details  SET terepist_status = '1'  WHERE (from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')   AND terepist_status = '0' ";
 $result = $wpdb->query($query);	
}


	}
   wp_die(); // ajax call must die to avoid trailing 0 in your response
}
add_action( "wp_ajax_checkboxopen", "check_box_open" );
add_action( "wp_ajax_nopriv_checkboxopen", "check_box_open" );
function check_box_open(){
	global $wpdb;
	$current_user = wp_get_current_user();
	//print_r($current_user);
	 $role =  $current_user->roles[1]; 
if($role == '')
$role =  $current_user->roles[0]; 

	$from_user_id = $current_user->ID;
	if($role == 'subscriber')
	{
 $query = "SELECT * FROM chat_message_details  WHERE to_user_id = '".$from_user_id."' and user_status = 0 ORDER BY chat_time DESC limit 1 ";
	}
	else
	{
		   $query = "SELECT * FROM chat_message_details  WHERE to_user_id = '".$from_user_id."' and terepist_status = 0 ORDER BY chat_time DESC limit 1 ";
	}

	$result = $wpdb->get_results($query);
	
	if(count($result) > 0)
	{
 foreach($result as $row)
 {
	 $to_user_id = $row->from_user_id;
	 $from_user_id = $row->to_user_id;
	 $therepist_data = get_userdata( $to_user_id);
	 if($role=="subscriber")
{
			$fname = get_user_meta($to_user_id, 'first_name');
$lname = get_user_meta($to_user_id, 'last_name');
			$t_name = $fname[0]." ".$lname[0];
}
	 else
{
			$t_name = $therepist_data->display_name;
}	
 }
  echo $to_user_id."-".$t_name."-". $from_user_id.'-'.$role;
	}
	else
	{
	echo "null";
	}
   wp_die(); // ajax call must die to avoid trailing 0 in your response
}




add_action( "wp_ajax_chatinsert", "insert_chat" );
add_action( "wp_ajax_nopriv_chatinsert", "insert_chat" );
function insert_chat(){
	$to_user_id = $_POST['to_user_id'];
	$from_user_id = $_POST['from_user_id'];
	$chat_message = $_POST['chat_message'];
	$is_file = $_POST['is_file'];
	$status = 0;
date_default_timezone_set('Asia/Kolkata');
global $wpdb;
$wpdb->insert("chat_message_details", array(
   "to_user_id" => $to_user_id,
   "from_user_id" => $from_user_id,
   "chat_message" => $chat_message,
   "status" => '0',
 "is_file" => $is_file,
	'terepist_status'=>'0',
"user_status" => '0',
   "chat_time" => date('Y-m-d H:i:s'),
));
$current_user = wp_get_current_user();
	$role =  $current_user->roles[1]; 
if($role == '')
$role =  $current_user->roles[0]; 
$therapist_id = $_POST['to_user_id'];
$seeker_id = $_POST['from_user_id'];
	if($role == 'subscriber')
	{
$sql_str = "SELECT * FROM chat_message_details  WHERE from_user_id = '".$from_user_id."' or to_user_id = '".$to_user_id."' ORDER BY chat_time DESC limit 1";
$result3 = $wpdb->get_results($sql_str);
if(count($result3) > 0)
	{
$chat_time = date('Y-m-d H:i:s',strtotime($results3[0]->chat_time));
$curr_time = date('Y-m-d H:i:s');
$diff = $curr_time - $chat_time;
$hours = $diff / ( 60 * 60 );
if($hours <= 2)
{
$s_data = get_userdata($seeker_id);
 $s_email = $s_data->data->user_email;
$s_name = $s_data->data->user_nicename;
$username = get_user_name($seeker_id);
$therepistname = get_user_name($therapist_id);
$t_data = get_userdata($therapist_id);
$t_email = $t_data->data->user_email;
$t_name = $t_data->data->user_nicename;
$therapist_mobile = get_user_meta($therapist_id,'mobile');
$therapist_countrycde = get_user_meta($therapist_id,'countryCode');
 $t_mobile = '91'.$therapist_countrycde[0].$therapist_mobile[0];
$therapist_mobile = get_user_meta($seeker_id,'mobile');
	$therapist_countrycde = get_user_meta($seeker_id,'countryCode');
 $s_mobile = '91'.$therapist_countrycde[0].$therapist_mobile[0];

//$message = "Hi ".$s_name." , you have started a online chat with ".$t_name." on thriive.in view your online chat chat link.";
$t_message = "We have connected you with ".$t_name." who is a Verified Therapist . This conversation is completely private and confidential";
//$t_message= "Hi ".$t_name." , Online chat is initiated with you by ".$s_name." View Your Online chat (give a chat link here)";
$message = "Hi ".$t_name.", ".$s_name." sent a message. view and reply from chat link thanks.";
// sending therapist email
$to = $t_email;
$to = 'productmanager@thriive.in';
$body = body_from_user_to_therapist_reply($s_name,$t_name);
//$body = 'check mail';
$subject = "Thriive email";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: admin@thriive.in' . "\r\n";
if(mail($to,$subject,$body,$headers))
echo "sent";
else
echo "not sent";
sendMSG($t_mobile,$message);

//sendMSG($s_mobile,$message);
}
}
else 
{
$s_data = get_userdata($seeker_id);
 $s_email = $s_data->data->user_email;
$s_name = $s_data->data->user_nicename;
$username = get_user_name($seeker_id);
$therepistname = get_user_name($therapist_id);
$t_data = get_userdata($therapist_id);
$t_email = $t_data->data->user_email;
$t_name = $t_data->data->user_nicename;
$therapist_mobile = get_user_meta($therapist_id,'mobile');
$therapist_countrycde = get_user_meta($therapist_id,'countryCode');
 $t_mobile = '91'.$therapist_countrycde[0].$therapist_mobile[0];
$therapist_mobile = get_user_meta($seeker_id,'mobile');
	$therapist_countrycde = get_user_meta($seeker_id,'countryCode');
 $s_mobile = '91'.$therapist_countrycde[0].$therapist_mobile[0];
$message = "We have connected you with ".$t_name." who is a Verified Therapist . This conversation is completely private and confidential";
//$message = "Hi ".$s_name." , you have started a online chat with ".$t_name." on thriive.in view your online chat chat link.";
$t_message= "Hi ".$t_name." , Online chat is initiated with you by ".$s_name." View Your Online chat (give a chat link here)";
$to = $t_name;
$to = 'productmanager@thriive.in';
$body = body_from_user_to_therapist();
//$body = 'check mail';
$subject = "Thriive email";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <admin@thriive.in>' . "\r\n";
if(mail($to,$subject,$body,$headers))
echo "sent";
else
echo "not sent";
//sendMSG($t_mobile,$t_message);
sendMSG($s_mobile,$message);
}
}
else
{
$seeker_id = $_POST['to_user_id'];
$therapist_id = $_POST['from_user_id'];
$sql_str = "SELECT * FROM chat_message_details  WHERE from_user_id = '".$from_user_id."' or to_user_id = '".$to_user_id."' ORDER BY chat_time DESC limit 1";
$result3 = $wpdb->get_results($sql_str);
if(count($result3) > 0)
	{
$chat_time = date('Y-m-d H:i:s',strtotime($results3[0]->chat_time));
$curr_time = date('Y-m-d H:i:s');
$diff = $curr_time - $chat_time;
$hours = $diff / ( 60 * 60 );
if($hours <= 2)
{
$s_data = get_userdata($seeker_id);
 $s_email = $s_data->data->user_email;
$s_name = $s_data->data->user_nicename;
$username = get_user_name($seeker_id);
$therepistname = get_user_name($therapist_id);
$t_data = get_userdata($therapist_id);
$t_email = $t_data->data->user_email;
$t_name = $t_data->data->user_nicename;
$therapist_mobile = get_user_meta($therapist_id,'mobile');
$therapist_countrycde = get_user_meta($therapist_id,'countryCode');
 $t_mobile = '91'.$therapist_countrycde[0].$therapist_mobile[0];
$therapist_mobile = get_user_meta($seeker_id,'mobile');
	$therapist_countrycde = get_user_meta($seeker_id,'countryCode');
 $s_mobile = '91'.$therapist_countrycde[0].$therapist_mobile[0];
$message = "Hi ".$s_name.", ".$t_name." sent a message. view and reply from chat link thanks.";
//$t_message= "Hi ".$t_name." , Online chat is initiated with you by ".$s_name." View Your Online chat (give a chat link here)";
$to = $t_name;
$to = 'productmanager@thriive.in';
$body = body_from_therapist_to_user();
//$body = 'check mail';
$subject = "Thriive email";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <admin@thriive.in>' . "\r\n";
if(mail($to,$subject,$body,$headers))
echo "sent";
else
echo "not sent";
sendMSG($s_mobile,$message);
//sendMSG($s_mobile,$message);
}
}
}


	$therapist_mobile = get_user_meta($therapist_id,'mobile');
			$therapist_countrycde = get_user_meta($therapist_id,'countryCode');
	$name = get_user_meta($seeker_id,'name');
$current_user = wp_get_current_user();
	   $seeker_id = $current_user->ID;
   $query_str = "select * from notification_details where reply_status = 2 and from_user_id = '".$seeker_id."'";
	$result1 = $wpdb->get_results($query_str);
	if(count($result1) > 0)
	{
		$mobile = $therapist_countrycde[0].$therapist_mobile[0];
		$message = $name[0] ." is online now";
	sendMSG($mobile,$message); 
		$query = "UPDATE notification_details SET reply_status = 3 WHERE from_user_id = '".$seeker_id."'";
 $result = $wpdb->query($query);
 }
	$query = "UPDATE notification_details SET send_status = send_status+1,reply_status = 1 WHERE from_user_id = '".$seeker_id."'";
 $result = $wpdb->query($query);
//echo $output;
  wp_die(); // ajax call must die to avoid trailing 0 in your response
}

add_action( "wp_ajax_updateactivity", "update_last_actiity" );
add_action( "wp_ajax_nopriv_updateactivity", "update_last_actiity" );
function update_last_actiity(){
	$current_user = wp_get_current_user();
	   $seeker_id = $current_user->ID;
	global $wpdb;
$query = "UPDATE login_details SET last_activity = now() WHERE login_details_id = '".$seeker_id."'";
 $result = $wpdb->query($query);
  wp_die(); // ajax call must die to avoid trailing 0 in your response
}

add_action( "wp_ajax_insertnotification", "insert_notification" );
add_action( "wp_ajax_nopriv_insertnotification", "insert_notification" );
function insert_notification(){
	global $wpdb;
	$touserid = $_POST['touserid'];
	$fromuserid = $_POST['fromuserid'];
	$msg = $_POST['msg'];
	$mobile = $_POST['mobile'];
		$emailid = $_POST['emailid'];
		$whatsappmobile = $_POST['whatsappmobile'];
	$toname = $_POST['toname'];
date_default_timezone_set('Asia/Kolkata');
$wpdb->insert("notification_details", array(
   "to_user_id" => $touserid,
   "from_user_id" => $fromuserid,
   "message" => $msg,
   "mobile" => $mobile,
	 "send_status" => 1,
   "date_time" => date('Y-m-d H:i:s'),
	"email_id" => $emailid,
	"whatsapp_mobile" => $$whatsappmobile,
	"to_name" =>$toname
));
  wp_die(); // ajax call must die to avoid trailing 0 in your response
}

add_action( "wp_ajax_updateistype", "update_is_type_status" );
add_action( "wp_ajax_nopriv_updateistype", "update_is_type_status" );
function update_is_type_status(){
	$current_user = wp_get_current_user();
	   $seeker_id = $current_user->ID;
	global $wpdb;
$query = "UPDATE login_details SET last_activity = now() WHERE login_details_id = '".$seeker_id."'";
 $result = $wpdb->query($query);
  wp_die(); // ajax call must die to avoid trailing 0 in your response
}

add_action( "wp_ajax_delmsg", "delete_message" );
add_action( "wp_ajax_nopriv_delmsg", "delete_message" );
function delete_message(){
		global $wpdb;
	$ids = $_POST['ids'];
$to_user_id = $_POST['to_user_id'];
$from_user_id = $_POST['from_user_id'];

	foreach($ids as $id)
	{
	 $query = "UPDATE chat_message_details  SET delete_status = '1'  WHERE chat_message_id = '".$id."'";
 $result = $wpdb->query($query);	
$wpdb->insert("check_delete_status", array(
   "to_user_id" => $to_user_id,
   "from_user_id" => $from_user_id,
   "chat_id" => $id
));
	}
 wp_die(); // ajax call must die to avoid trailing 0 in your response
}


add_action( "wp_ajax_checkdelstatus", "check_del_status" );
add_action( "wp_ajax_nopriv_checkdelstatus", "check_del_status" );
function check_del_status(){
		global $wpdb;
	$current_user = wp_get_current_user();
	   $to_user_id = $current_user->ID;

	 $query = " SELECT count(*)  as cnt FROM check_delete_status  WHERE to_user_id = '".$to_user_id."'";	
$result = $wpdb->get_results($query); 
$count = $result[0]->cnt;
if($count > 0 )
{
$sql = "delete from check_delete_status where to_user_id = ".$to_user_id;
 $result = $wpdb->query($sql);
echo "refresh_needed";

}
else
{
echo "refresh_not_needed";
}
 wp_die(); // ajax call must die to avoid trailing 0 in your response
}

add_action( "wp_ajax_delmsggrp", "delete_message_group" );
add_action( "wp_ajax_nopriv_delmsggrp", "delete_message_group" );
function delete_message_group(){
		global $wpdb;
	$ids = $_POST['ids'];
$from_user = $_POST['from_user'];
$to_user = $_POST['to_user'];
  $query = " SELECT chat_message_id FROM chat_message_details  WHERE ((from_user_id = '".$from_user."'  AND to_user_id = '".$to_user."')  OR (from_user_id = '".$to_user."'  AND to_user_id = '".$from_user."')) and (delete_status = 0)  ORDER BY chat_message_id ASC ";	

$result = $wpdb->get_results($query); 
foreach($result as $row)
 {
$id = $row->chat_message_id;
	  $query = "UPDATE chat_message_details  SET delete_status = '1'  WHERE chat_message_id = '".$id."'";
$result = $wpdb->query($query);	
	}
  wp_die(); // ajax call must die to avoid trailing 0 in your response
}

	add_action( "wp_ajax_updateactivity", "update_activity" );
add_action( "wp_ajax_nopriv_updateactivity", "update_activity" );
function update_activity(){
		global $wpdb;
	$from_user_id = $_POST['from_user_id'];
	$query = "UPDATE login_details SET last_activity = now() WHERE login_details_id = '".$from_user_id."'";
 $result = $wpdb->query($query);	
  wp_die(); // ajax call must die to avoid trailing 0 in your response
}
add_action( "wp_ajax_fetchuser", "fetch_user" );
add_action( "wp_ajax_nopriv_fetchuser", "fetch_user" );
function fetch_user(){
	$from_user_id =$_POST['from_user_id'];
	$to_user_id =$_POST['to_user_id'];
	$user_name =$_POST['user_name'];
	$from_status =$_POST['from_status'];
	$to_status =$_POST['to_status'];
	$from_role  =$_POST['from_role'];
	$to_mobile =$_POST['to_mobile'];
	$msg =$_POST['msg'];
	$to_email =$_POST['to_email'];
$img = $_POST['img'];
	if(is_user_online($to_user_id))
	{
	echo '<button type="button" class="btn btn-info btn-xs start_chat btn btn-primary btn-big btn-transparent connect_with_btn_listing" data-img = "'.$img.'" data-fromuserid = "'.$from_user_id.'" data-touserid="'.$to_user_id.'" data-tousername="'.$user_name.'" data-from_status = "'.$from_status.'" data-to_status = "1" data-role ="'.$from_role.'" data-mobile="'.$to_mobile.'" data-msg="'.$msg.'" data-email="'.$to_email.'" ><i class="fa fa-envelope" aria-hidden="true"></i>Start Chat</button>';
	}
	else
	{
	echo '<button type="button" class="btn btn-info btn-xs start_chat btn btn-primary btn-big btn-transparent connect_with_btn_listing" data-img = "'.$img.'" data-fromuserid = "'.$from_user_id.'" data-touserid="'.$to_user_id.'" data-tousername="'.$user_name.'" data-from_status = "'.$from_status.'" data-to_status = "0" data-role ="'.$from_role.'" data-mobile="'.$to_mobile.'" data-msg="'.$msg.'" data-email="'.$to_email.'" ><i class="fa fa-envelope" aria-hidden="true"></i>Start Chat</button>';
	}
  wp_die(); // ajax call must die to avoid trailing 0 in your response
}

add_action( 'init' , 'fetch_user_subscriber' );
function fetch_user_subscriber(){
	$current_user = wp_get_current_user();
	$session_id = $current_user->ID;
	global $wpdb;
    $query = " SELECT * FROM chat_message_details  WHERE to_user_id = '".$session_id."' group by from_user_id  ORDER BY chat_time ASC ";
	
	$result = $wpdb->get_results($query);
	
	return($result);
}


function count_unseen_message($from_user_id, $to_user_id)
{
	global $wpdb;
 $query = "SELECT * FROM chat_message_details WHERE from_user_id = '$from_user_id'  AND to_user_id = '$to_user_id'  AND user_status = '1' ";
 	$result = $wpdb->get_results($query);
	$count = count($result);
 if($count > 0)
 {
  $output = '<span class="label label-success">'.$count.'</span>';
 }
 return $output;
}

add_action( 'init' , 'therapist_chat_history' );
function therapist_chat_history(){
	$current_user = wp_get_current_user();
	$session_id = $current_user->ID;
	global $wpdb;
     $query = " SELECT from_user_id FROM chat_message_details  WHERE (to_user_id   = '".$session_id."' and delete_status = 0) group by from_user_id ";

	$result = $wpdb->get_results($query);
	
	$output = '<table class="table table-bordered table_blk1 desk_tablevw"><tr> <td widht="30%">Customer</td><td widht="30%">Last Conversation (Date&Time)</td><td width="40%">Action</td></tr>';
	 foreach($result as $row)
 {
	 $from_user_id = $row->from_user_id;
	 $therepist_data = get_userdata( $from_user_id);
	
		 $t_name = $therepist_data->display_name;
	 $chat_message = $row->chat_message;
		 	$arr = get_user_meta($from_user_id, 'first_name');
		$name = $arr[0];
if($name == '')
{
$arr = get_user_meta($from_user_id, 'nickname');
$name = $arr[0];
}
 if(is_user_online($from_user_id))
{
   $to_status = 1;
 }
 else
 {
	  $to_status = 0;
 }
	$user_id = $from_user_id;  // Get current user Id

$anchor = site_url()."/therapist-chat-history/?to_user=".$user_id;
$last_coversation = last_login($user_id);
 $output .= '<tr><td>'.$name.'</td><td>'.$last_coversation.'</td><td class="btns_group" id="start_chat_button_'.$to_user_id.'">
<button type="button" class="btn btn-info btn_link1 view_chat btn btn-primary btn-big btn-transparent connect_with_btn_listing" data-fromuserid = "'.$session_id.'" data-touserid="'.$from_user_id.'" data-tousername="'.$name.'"  data-role="subscriber">View Chat</button>
<a href = "'.$anchor.'" target = "_blank" class="anch_link1" javascript= "void()">Export</a>

</td></tr>';
	 }
$output .= '</table>';
	
	return($output);
}

add_action( 'init' , 'therapist_chat_history_mobile' );
function therapist_chat_history_mobile(){
	$current_user = wp_get_current_user();
	$session_id = $current_user->ID;
	global $wpdb;
     $query = " SELECT from_user_id FROM chat_message_details  WHERE (to_user_id   = '".$session_id."' and delete_status = 0) group by from_user_id ";

	$result = $wpdb->get_results($query);
	
	$output = '<section class="mobi_tableview">
	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<table class="table">';
	 foreach($result as $row)
 {
	 $from_user_id = $row->from_user_id;
	 $therepist_data = get_userdata( $from_user_id);
	
		 $t_name = $therepist_data->display_name;
	 $chat_message = $row->chat_message;
		 	$arr = get_user_meta($from_user_id, 'first_name');
		$name = $arr[0];
if($name == '')
{
$arr = get_user_meta($from_user_id, 'nickname');
$name = $arr[0];
}
 if(is_user_online($from_user_id))
{
   $to_status = 1;
 }
 else
 {
	  $to_status = 0;
 }
	$user_id = $from_user_id;  // Get current user Id

$anchor = site_url()."/therapist-chat-history/?to_user=".$user_id;
$last_coversation = last_login($user_id);
 $output .= '<thead class="thead-light">
 <tr>
	 <th colspan="2">'.$name.'</th>
 </tr>
</thead>
<tbody>
						<tr>
							<td>Last Conversation (Date&Time)</td>
							<td>'.$last_coversation.'</td>
						</tr>
						<tr>
							<td>Action</td>
							<td class="btns_group" id="start_chat_button_">
							<button type="button" class="btn btn-info btn_link1 view_chat btn btn-primary btn-big btn-transparent connect_with_btn_listing" data-fromuserid = "'.$session_id.'" data-touserid="'.$from_user_id.'" data-tousername="'.$name.'"  data-role="subscriber">View Chat</button>
							<a href = "'.$anchor.'" target = "_blank" class="anch_link1" javascript= "void()">Export</a></td>
						</tr>
					</tbody>';
	 }
$output .= '</table>				
</div>
</div>
</div>
</section>';
	
	return($output);
}

add_action( 'init' , 'user_chat_history' );
function user_chat_history(){
	$current_user = wp_get_current_user();
	$session_id = $current_user->ID;
	global $wpdb;
     $query = " SELECT to_user_id FROM chat_message_details  WHERE (from_user_id = '".$session_id."' and delete_status = 0) group by to_user_id ORDER BY chat_time ASC ";

	$result = $wpdb->get_results($query);
	
	$output = '<table class="table table-bordered table_blk1"><tr> <td widht="20%">Therapist</td><td widht="20%">Cure</td><td widht="20%">Specaility</td><td widht="20%">Last Conversation (Date&Time)</td><td width="20%">Action</td></tr>';
	 foreach($result as $row)
 {
	 $to_user_id = $row->to_user_id;
	 $therepist_data = get_userdata( $to_user_id);
	
		 $t_name = $therepist_data->display_name;
	 $chat_message = $row->chat_message;
		 	$arr = get_user_meta($to_user_id, 'first_name');
		$name = $arr[0];

 if(is_user_online($to_user_id))
{
   $to_status = 1;
 }
 else
 {
	  $to_status = 0;
 }
	$user_id = $to_user_id;  // Get current user Id
$args = array(
	'author'        =>  $user_id,
	'orderby'       =>  'post_date',
	'order'         =>  'ASC',
	'post_type'	=> 'therapist',
	'posts_per_page' => 1
);

$posts = get_posts($args);

foreach($posts as $post)
{
$postId =  $post->ID;
}
 $terms = get_the_terms( $postId, 'therapy' );
$termname =array();
foreach($terms as $term)
{
$termname[] =  $term->name;
}
$anchor = site_url()."/user-chat-history/?to_user=".$user_id;
$last_coversation = last_login($user_id,$session_id);
 $output .= '<tr><td>'.$name.'</td><td>'.$termname[1].'</td><td>'.$termname[0].'</td><td>'.$last_coversation.'</td><td class="btns_group" id="start_chat_button_'.$to_user_id.'">
<button type="button" class="btn btn-info btn_link1 view_chat btn btn-primary btn-big btn-transparent connect_with_btn_listing" data-fromuserid = "'.$session_id.'" data-touserid="'.$to_user_id.'" data-tousername="'.$name.'"  data-role="subscriber">View Chat</button>
<a href = "'.$anchor.'" target = "_blank" class="anch_link1" javascript= "void()">Export</a>
<button type="button" id = "del1" class="btn btn-info btn_link1 connect_with_btn_listing" data-to_user = "'.$user_id.'" data-from_user = "'.$session_id.'" onclick="delete_msggrp(this)">Delete</button>
</td></tr>';
	 }
$output .= '</table>';
	
	return($output);
}


add_action( 'init' , 'last_login' );
function last_login($userId)
{
		global $wpdb;
$query = "SELECT * FROM chat_message_details  WHERE (from_user_id = '".$userId."'  OR to_user_id = '".$userId."')  ORDER BY chat_time DESC limit 1 ";
 	$result = $wpdb->get_results($query);
return(format_date($result[0]->chat_time));
}
add_action( 'init' , 'last_login_chat' );
function last_login_chat($userId,$from_user)
{
		global $wpdb;
$query = "SELECT * FROM chat_message_details  WHERE (from_user_id = '".$userId."'  AND to_user_id = '".$from_user."') or (from_user_id = '".$from_user."'  AND to_user_id = '".$userId."')  ORDER BY chat_time DESC limit 1 ";
 	$result = $wpdb->get_results($query);
return(format_date($result[0]->chat_time));
}
add_action( 'init' , 'get_user_name' );
function get_user_name($userId)
{
		$user_name1 = ''; 
$arr = get_user_meta($userId, 'first_name');
$user_name1 = $arr[0];
if($user_name1 == '')
{
$arr = get_user_meta($userId, 'nickname');
$user_name1 = $arr[0];
}
return($user_name1);
}

add_action( 'init' , 'date_format' );
function format_date($date)
{
$format_date_time = date('d M, Y h:i:s A', strtotime($date));
return($format_date_time);
}

add_action( "wp_ajax_fetchuserchat", "fetch_user_chat_history_user" );
add_action( "wp_ajax_nopriv_fetchuserchat", "fetch_user_chat_history_user" );

function fetch_user_chat_history_user(){
	global $wpdb;
		
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
if($_POST['therapist'] != '' && $_POST['user'] != '' )
{
$from_user_id = $_POST['user'];
$to_user_id = $_POST['therapist'];
if($from_date == '' && $to_date == '')
$query = " SELECT * FROM chat_message_details  WHERE ((from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')) ORDER BY chat_time DESC";
else
  $query = " SELECT * FROM chat_message_details  WHERE ((from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')) and (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."') ORDER BY chat_time DESC";

}
else if($_POST['therapist'] != '')
{
$from_user_id = $_POST['therapist'];
if($from_date == '' && $to_date == '')
$query = " SELECT * FROM chat_message_details  WHERE (from_user_id = '".$from_user_id."'  OR to_user_id = '".$from_user_id."') ORDER BY chat_time DESC ";
else
$query = " SELECT * FROM chat_message_details  WHERE (from_user_id = '".$from_user_id."'  OR to_user_id = '".$from_user_id."') and (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."')  ORDER BY chat_time DESC ";
}
else if($_POST['user'] != '')
{
$from_user_id = $_POST['user'];
if($from_date == '' && $to_date == '')
$query = " SELECT * FROM chat_message_details  WHERE (from_user_id = '".$from_user_id."'  OR to_user_id = '".$from_user_id."')  ORDER BY chat_time DESC ";
else
$query = " SELECT * FROM chat_message_details  WHERE (from_user_id = '".$from_user_id."'  OR to_user_id = '".$from_user_id."') and (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."')  ORDER BY chat_time DESC ";

}
else 
{
if($from_date == '' && $to_date == '')
$query = " SELECT * FROM chat_message_details ORDER BY chat_time DESC ";
else
$query = " SELECT * FROM chat_message_details  WHERE (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."')  ORDER BY chat_time DESC ";

}

   
	$result = $wpdb->get_results($query);
	//print_r($result);
 $output = '<table class="table table-bordered"><thead><tr><th>Message From</th><th>Message To</th><th>Message</th><th>Date Time</th></tr></thead>
					<tbody>';
 foreach($result as $row)
 {
		
	$user_name = ''; 
$arr = get_user_meta($row->to_user_id, 'first_name');
$user_name = $arr[0];
if($user_name == '')
{
$arr = get_user_meta($row->to_user_id, 'nickname');
$user_name = $arr[0];
}

	$user_name_from = ''; 
$arr = get_user_meta($row->from_user_id, 'first_name');
$user_name_from = $arr[0];
if($user_name_from == '')
{
$arr = get_user_meta($row->from_user_id, 'nickname');
$user_name_from = $arr[0];
}

	 $chat_message = $row->chat_message;
	  $location = $row->chat_message;
	 
	 $is_file = $row->is_file;
	 if($is_file == 'yes')
	 {
		  $location = $row->chat_message;
		  $extension = pathinfo($chat_message, PATHINFO_EXTENSION);
		 if($extension == 'docs' || $extension == 'doc')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/wp-content/uploads/imagesword.png" height="100" width="100" /></a>';
}
 elseif($extension == 'xls' || $extension == 'xlsx')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/wp-content/uploads/imagesexcel.jpg" height="100" width="100" /></a>';
}
 elseif($extension == 'pdf')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/wp-content/uploads/images.png" height="100" width="100" /></a>';
}
elseif($extension == 'txt')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/wp-content/uploads/imagesfile.jpg" height="100" width="100" /></a>';
}
 else
 {
 	$chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.$location.'" height="100" width="100" /></a>';
 }
 }
  
$output .= '<tr><td>'.$user_name.'</td><td>'.$user_name_from.'</td><td>'.$chat_message.'</td><td>'.format_date($row->chat_time).'</td></tr>';
}
 $output .= '</tbody></table>';
echo $output;
wp_die(); // ajax call must die to avoid trailing 0 in your response
 }




add_action( "wp_ajax_viewlogstherapist", "view_logs_therapist" );
add_action( "wp_ajax_nopriv_viewlogstherapist", "view_logs_therapist" );

function view_logs_therapist()
{
global $wpdb;
$therapist = 0;
$seekers = 0;
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$arr1 = array();
$arr2 = array();
$arr = array();
$html = '<div class="container">
		<div class="row"><div class="col-lg-12 col-md 12 col-sm-12 col-12"><h4>Total Therapists</h4><table class="table table-bordered"><thead><tr><th>Name</th><th>Last Login</th><th>Chat with Customers</th><th>Customer Count</th></tr></thead><tbody>';
if($from_date == '' && $to_date == '')
$query = "SELECT to_user_id FROM chat_message_details group by to_user_id ";
else
$query = "SELECT to_user_id FROM chat_message_details  where (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."') group by to_user_id ";
 	$result = $wpdb->get_results($query);
foreach($result as $row)
{
$arr1 = array();
$roles_to = get_user_meta($row->to_user_id,'role');
if(!(in_array("subscriber",$roles_to ) ))
{
if($from_date == '' && $to_date == '')
 $query1 = "SELECT from_user_id FROM chat_message_details where to_user_id = ".$row->to_user_id." group by from_user_id";
else
$query1 = "SELECT from_user_id FROM chat_message_details  where (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."') and to_user_id = ".$row->to_user_id." group by from_user_id";
 	$result1 = $wpdb->get_results($query1);
$last_login = last_login($row->to_user_id);
foreach($result1 as $row1)
{
$name = get_user_name($row->to_user_id);
$name1 = get_user_name($row1->from_user_id);
$arr1[]= '<a href="#" data-to = "'.$row->to_user_id .'" data-from = "'.$row1->from_user_id.'" onclick="show_chat_therepist_user(this)">'.$name1.'</a>';

}
$str_from = implode(',',$arr1);
$html .= '<tr><td>'.$name.'</td><td>'.$last_login.'</td><td>'.$str_from.'</td><td>'.count($arr1).'</td></tr>';
}

}
$html .= '</tbody></table></div></div></div>';

echo $html;
wp_die();
 
}

add_action( "wp_ajax_viewlogsuser", "view_logs_user" );
add_action( "wp_ajax_nopriv_viewlogsuser", "view_logs_user" );

function view_logs_user()
{
global $wpdb;
$therapist = 0;
$seekers = 0;
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];

$arr1 = array();
$arr2 = array();
$arr = array();
$html = '<div class="container">
		<div class="row"><div class="col-lg-12 col-md 12 col-sm-12 col-12"><h4>Total Customer</h4><table class="table table-bordered"><thead><tr><th>Name</th><th>Last Login</th><th>Chat with Therapist</th><th>Therapist Count</th></tr></thead><tbody>';
if($from_date == '' && $to_date == '')
$query = "SELECT from_user_id FROM chat_message_details  group by from_user_id ";
else
$query = "SELECT from_user_id FROM chat_message_details  where (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."') group by from_user_id ";
 	$result = $wpdb->get_results($query);
foreach($result as $row)
{
$arr1 = array();
$roles_to = get_user_meta($row->from_user_id,'role');
$last_login = last_login($row->from_user_id);
if((in_array("subscriber",$roles_to ) ))
{
if($from_date == '' && $to_date == '')
$query1 = "SELECT to_user_id FROM chat_message_details  where from_user_id = ".$row->from_user_id." group by to_user_id";
else
$query1 = "SELECT to_user_id FROM chat_message_details  where (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."') and from_user_id = ".$row->from_user_id." group by to_user_id";
 	$result1 = $wpdb->get_results($query1);
foreach($result1 as $row1)
{
$name = get_user_name($row->from_user_id);
$name1 = get_user_name($row1->to_user_id);
$arr1[]= '<a href="#" data-to = "'.$row->from_user_id.'" data-from = "'.$row1->to_user_id.'" onclick="show_chat_therepist_user(this)">'.$name1.'</a>';

}
$str_from = implode(',',$arr1);
$html .= '<tr><td>'.$name.'</td><td>'.$last_login.'</td><td>'.$str_from.'</td><td>'.count($arr1).'</td></tr>';
}

}
$html .= '</tbody></table></div></div></div>';

echo $html;
wp_die();
 
}


add_action( 'init' , 'fetch_user_chat_history_user_export' );

function fetch_user_chat_history_user_export(){
	global $wpdb;
$str = $_SERVER['REQUEST_URI'];
if (strpos($str, 'admin-chat-dashboard') !== false) 
{

if(isset($_POST['action']) && $_POST['action'] == 'export')
{
	header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"report.csv\";" );
header("Content-Transfer-Encoding: binary");
	$csv_output = '';
	
$from_date = $_POST['bday3'];
$to_date = $_POST['bday4'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
if($_POST['therapist'] != '' && $_POST['user'] != '' )
{
$from_user_id = $_POST['user'];
$to_user_id = $_POST['therapist'];
if($from_date == '' && $to_date == '')
$query = " SELECT * FROM chat_message_details  WHERE ((from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')) ORDER BY chat_time DESC";
else
  $query = " SELECT * FROM chat_message_details  WHERE ((from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')) and (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."') ORDER BY chat_time DESC";

}
else if($_POST['therapist'] != '')
{
$from_user_id = $_POST['therapist'];
if($from_date == '' && $to_date == '')
$query = " SELECT * FROM chat_message_details  WHERE (from_user_id = '".$from_user_id."'  OR to_user_id = '".$from_user_id."') ORDER BY chat_time DESC ";
else
$query = " SELECT * FROM chat_message_details  WHERE (from_user_id = '".$from_user_id."'  OR to_user_id = '".$from_user_id."') and (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."')  ORDER BY chat_time DESC ";
}
else if($_POST['user'] != '')
{
$from_user_id = $_POST['user'];
if($from_date == '' && $to_date == '')
$query = " SELECT * FROM chat_message_details  WHERE (from_user_id = '".$from_user_id."'  OR to_user_id = '".$from_user_id."')  ORDER BY chat_time DESC ";
else
$query = " SELECT * FROM chat_message_details  WHERE (from_user_id = '".$from_user_id."'  OR to_user_id = '".$from_user_id."') and (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."')  ORDER BY chat_time DESC ";

}
else 
{
if($from_date == '' && $to_date == '')
$query = " SELECT * FROM chat_message_details ORDER BY chat_time DESC ";
else
$query = " SELECT * FROM chat_message_details  WHERE (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."')  ORDER BY chat_time DESC ";

}

   
	$result = $wpdb->get_results($query);
	//print_r($result);
if(count($result) > 0)
{
$csv_output = "Message From,Message To,Message,Date & Time";
$csv_output .= "\n";
 foreach($result as $row)
 {
		
	$user_name = ''; 
$arr = get_user_meta($row->to_user_id, 'first_name');
$user_name = $arr[0];
if($user_name == '')
{
$arr = get_user_meta($row->to_user_id, 'nickname');
$user_name = $arr[0];
}

	$user_name_from = ''; 
$arr = get_user_meta($row->from_user_id, 'first_name');
$user_name_from = $arr[0];
if($user_name_from == '')
{
$arr = get_user_meta($row->from_user_id, 'nickname');
$user_name_from = $arr[0];
}
 $chat_message = $row->chat_message;
	  $location = $row->chat_message;
	 $is_file = $row->is_file;
	 if($is_file == 'yes')
	 {
		  $location = $row->chat_message;
		$chat_message = "File";
 }
  $csv_output .= $user_name.",".$user_name_from.",".$chat_message.",".trim(format_date($row->chat_time));
	 $csv_output .= "\n";
}
echo $csv_output;
 }

exit();
}
}
 }
add_action( 'init' , 'chat_filters' );
function chat_filters()
{

$str = $_SERVER['REQUEST_URI'];
if (strpos($str, 'admin-chat-dashboard') !== false) {
global $wpdb;
$therapist = 0;
$seekers = 0;
$from_date = $_POST['bday'];
$to_date = $_POST['bday2'];
if($from_date == '' && $to_date == '')
 $query = "SELECT * FROM chat_message_details ";
else
$query = "SELECT * FROM chat_message_details  WHERE (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."') ";
 	$result = $wpdb->get_results($query);
$count = count($result);
$arr1 = array();
$arr2 = array();
$arr = array();
if($from_date == '' && $to_date == '')
$query = "SELECT to_user_id FROM chat_message_details  group by to_user_id ";
else
$query = "SELECT to_user_id FROM chat_message_details  where (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."') group by to_user_id ";
 	$result = $wpdb->get_results($query);
foreach($result as $row)
{
$roles_to = get_user_meta($row->to_user_id,'role');
if(!(in_array("subscriber",$roles_to ) ) )
{
$therapist++;
}
}
if($from_date == '' && $to_date == '')
$query = "SELECT from_user_id FROM chat_message_details group by from_user_id ";
else
$query = "SELECT from_user_id FROM chat_message_details  where (chat_time >= '".$from_date."'  AND chat_time <= '".$to_date."') group by from_user_id ";
 	$result = $wpdb->get_results($query);
foreach($result as $row)
{

$roles_from = get_user_meta($row->from_user_id,'role');
if((in_array("subscriber",$roles_from ) ) )
{
$seekers++;
}
}
$html = '<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md 12 col-sm-12 col-12">
				<h4><a href="/admin-chat-dashboard">Chat Summary</a></h4>
				<div class="admindbdate_details">
					<!-- <h5>Date Range</h5> -->
					<div class="datepicker_hold">
						<ul class="list-inline list-unstyled datepick_lists">
							<li>
								<label for="" class="datelabel_txt">From</label>
								<input type="date" name="bday" id="bday" max="3000-12-31" min="1000-01-01" class="form-control datepick_input" value= '.$from_date.'>
							</li>
							<li>
								<label for="" class="datelabel_txt">To</label>
								<input type="date" name="bday2" id="bday2" max="3000-12-31" min="1000-01-01" class="form-control datepick_input" value= '.$to_date.'>
							</li>
							<li>
								<label for="" class="datelabel_txt"></label>
								<input type="submit" name="search" value = "search" class="form-control datepick_input searchInput exprt_btn">
							</li>
						</ul>
					</div>
				</div>

				<div class="cards_list cards_listing1">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Total Chats</h4>
						</div>
<div class="card-footer">
							'.$count.'
						</div>
<div class="card-footer">
							<a href="#" onclick = "viewlogschat()">view logs</a>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Total Therapists</h4>
						</div>
<div class="card-footer">
							'.$therapist.'
						</div>
						<div class="card-footer">
							<a href="#" onclick = "viewlogstherapist()">view logs</a>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Total Users</h4>
						</div>
<div class="card-footer">
							'.$seekers.'
						</div>
						<div class="card-footer">
							<a href="#" onclick = "viewlogsuser()">view logs</a>
						</div>
					</div>
					</div>
				
<span id= "logs_therapist"></span>
<span id= "chat_message_therapist_span"></span>
<span id= "logs_user"></span>
				
			</div>
		</div>
	</div>';
}
return($html);


}
add_action( 'init' , 'active_conversation' );
function active_conversation()
{
$str = $_SERVER['REQUEST_URI'];
if (strpos($str, 'admin-chat-dashboard') !== false ) {
global $wpdb;
$therapist = 0;
$seekers = 0;
$arr1 = array();
$arr2 = array();
$arr = array();

$query = "SELECT distinct(user_id) FROM `wp_usermeta`";
 	$result = $wpdb->get_results($query);
foreach($result as $row)
{
$arr = get_user_meta($row->user_id, 'first_name');
$name = $arr[0];
if($name == '')
{
$arr = get_user_meta($row->user_id, 'nickname');
$name = $arr[0];
}
$roles_to = get_user_meta($row->user_id,'role');
if($roles_to[0] == "subscriber" && $name != 'admin' && $name != '')
{
$user_str .= '<option value="'.$row->user_id.'">'.$name.'</option>';
}
else if($name != 'admin' && $name != '')
{
$therapist_str .= '<option value="'.$row->user_id.'">'.$name.'</option>';
}

}


$html = '<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md 12 col-sm-12 col-12">
				<h4>Active Conversations</h4>
				<div class="active_conversCont">
					<div class="form-group select_input">
						<label for="" class="datelabel_txt2">Select User</label>
					  <select class="form-control" name="user" id="user">
						<option value="">Select User</option>
						'.$user_str.'
					  </select>
					</div>
					<div class="form-group select_input">
						<label for="" class="datelabel_txt2">Select Therapist</label>
					  <select class="form-control" name="therapist" id="therapist">
						<option value="">Select Therapist</option>
						'.$therapist_str.'	
					  </select>
					</div>
					<div class="form-group date_input">
						<label for="" class="datelabel_txt2">From</label>
						<input type="date" name="bday3" id="bday3"  max="3000-12-31" min="1000-01-01" class="form-control datepick_input2">
					</div>
					<div class="form-group date_input">
						<label for="" class="datelabel_txt2">To</label>
						<input type="date" name="bday4" id="bday4" max="3000-12-31" min="1000-01-01" class="form-control datepick_input2">
					</div>
					<div class="buttonsz_group">
<input type = "hidden" name="action" value="export">
						<button  type= "button" onclick="fetchuserchat()" class="exprt_btn">Show Chat</button>
						<button type= "submit" class="exprt_btn" >Export As CSV</button>
					</div>
				</div>
				
				<span id= "chat_message_span"></span>
			</div>
		</div>
	</div>';
}
return($html);


}


//do_action('export_csv');
add_action( 'init' , 'export_csv' );
function export_csv()
{
  $str = $_SERVER['REQUEST_URI'];

if (strpos($str, 'seeker-my-account-edit/?download_report=yes') !== false) {
	global $wpdb;
$current_user = wp_get_current_user();
		 $session_id = $current_user->ID;
		
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"report.csv\";" );
header("Content-Transfer-Encoding: binary");
	$csv_output = '';

 $query = " SELECT * FROM chat_message_details  WHERE (from_user_id = '".$session_id."'  or to_user_id = '".$session_id."') and (delete_status = 0)  ORDER BY chat_time ASC";
	
	$result = $wpdb->get_results($query);
if(count($result) > 0)
{
$csv_output = "To,From,Message,Date & Time";
$csv_output .= "\n";
 foreach($result as $row)
 {
	 if($row->is_file == 'yes')
		 $message = 'Image';
	 else
$message = trim($row->chat_message);
		$arr = get_user_meta($row->from_user_id, 'first_name');
$arr3 = get_user_meta($row->from_user_id, 'last_name');
 		$name = $arr[0]." ".$arr3[0];
	 if($name == '')
{
$arr1 = get_user_meta($row->from_user_id, 'nickname'); 
$name = $arr[0];
}

$arr1 = get_user_meta($row->to_user_id, 'first_name');
$arr2 = get_user_meta($row->to_user_id, 'last_name');
 		$tname = $arr1[0]." ".$arr2[0];
	 if($tname == '')
{
$arr1 = get_user_meta($row->to_user_id, 'nickname'); 
$tname = $arr1[0];
}
		 $csv_output .= $tname.",".$name.",".$message.",".trim(format_date($row->chat_time));
	 $csv_output .= "\n";
	 
 }
	
echo $csv_output;
}

//echo $csv;
exit;
	}
}
//do_action('export_csv_single');
add_action( 'init' , 'export_csv_single' ,1);
function export_csv_single($to_user)
{

$str = $_SERVER['REQUEST_URI'];


if (strpos($str, 'user-chat-history/?to_user') !== false || strpos($str, 'therapist-chat-history/?to_user') !== false) {
 $starr = explode('?',$str);
$starr1 = explode('=',$starr[1]);
$to_user = $starr1[1];
	global $wpdb;
$current_user = wp_get_current_user();
		 $session_id = $current_user->ID;
		
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"report.csv\";" );
header("Content-Transfer-Encoding: binary");
	$csv_output = '';


   $query = " SELECT * FROM chat_message_details  WHERE ((from_user_id = '".$session_id."'  AND to_user_id = '".$to_user."')  OR (from_user_id = '".$to_user."'  AND to_user_id = '".$session_id."')) and (delete_status = 0)  ORDER BY chat_message_id ASC ";

	$result = $wpdb->get_results($query);
if(count($result) > 0)
{
$csv_output = "To,From,Message,Date & Time";
$csv_output .= "\n";
 foreach($result as $row)
 {
	 if($row->is_file == 'yes')
		 $message = 'Image';
	 else
$message = trim($row->chat_message);
	$arr = get_user_meta($row->from_user_id, 'first_name');
$arr3 = get_user_meta($row->from_user_id, 'last_name');
 		$name = $arr[0]." ".$arr3[0];
	 if($name == '')
{
$arr1 = get_user_meta($row->from_user_id, 'nickname'); 
$name = $arr[0];
}

$arr1 = get_user_meta($row->to_user_id, 'first_name');
$arr2 = get_user_meta($row->to_user_id, 'last_name');
 		$tname = $arr1[0]." ".$arr2[0];
	 if($tname == '')
{
$arr1 = get_user_meta($row->to_user_id, 'nickname'); 
$tname = $arr1[0];
}
		 $csv_output .= $tname.",".$name.",".$message.",".trim(format_date($row->chat_time));
	 $csv_output .= "\n";
	 
 }
	
echo $csv_output;
}

//echo $csv;
exit;
}	
}

add_action( 'init' , 'body_from_user_to_user');
function body_from_user_to_user($s_user,$t_name)
{
$body = '<!DOCTYPE html><html lang="en"><head>  <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Thriive | Emailer</title><link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet"></head><body style="width: 100%; background-color: #fff;color:#000;font-family:"Open Sans", sans-serif !important;font-size: 14px;  line-height: 20px; margin: 0;padding: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; ">
    <table border="0" cellpadding="0" cellspacing="0" class="tab-holder" style="background-color: #fff;width: 600px; height: 100%;font-family:"Open Sans", sans-serif !important;margin:0px auto;padding:0;border:1px solid #e4e4e4;"><tr><td align="center" class="header_section" style="width: 100%;height: 100%;margin:0px auto;padding: 20px 30px;background: #fff;">
                <a href="http://35.232.100.164" target="_blank"><img src="images/thriive_logo.png" style="width: 30%;" alt="">             </a></td></tr><tr><td class="content_03" style="width: 100%;height:auto;padding: 30px 40px;background: #fff;vertical-align: top;"><p style="float: left;margin: 0 0 5px 0;font-size: 12px;line-height: 18px;"><strong style="text-transform: capitalize;">Subject Line :</strong> Online chat initiated on <a href="http://35.232.100.164" arget="_blank">thriive.in</a> <br><br>Hi <strong style="text-transform: capitalize;">'.$s_name.',</strong><br><br>You have started a Online chat with <strong style="text-transform: capitalize;">"'.$t_name.'"</strong> <br><br>'.$t_name.' will review and respond to your query within 6 hours.<br>(expect a little delay in responses for messages sent between 9:00 pm to 9:00 am) <br><br>View Your Online Chat <a href="http://35.232.100.164" target="_blank">(Give a Chat link here)</a><br><br> Kindly call us at + if you have any query.<br><br><br><br><strong style="text-transform: capitalize;">Keep Thriiving :)</strong><br>         <strong style="text-transform: capitalize;">Team Thriive Art and Soul</strong></p></td> </tr><tr>
                <img src="images/footer-bg-top.png" style="width: 100%;vertical-align: bottom;" alt=""></td> </tr>
        <tr> <td class="footer_section" style=" width: 100%;height: 100%;margin:0px auto;padding: 10px 40px;background: #4f0475;">
                <h4 style="font-family: "Barlow", sans-serif;font-size: 24px;line-height:30px;margin: 0;color: #ffb813;	text-transform: uppercase; text-align: center;">thriive social</h4><p style="color: #fff; text-align: center;">&copy; 1997 - 2019 THRIIVE ART &amp; SOUL LLP. All Rights Reserved.</p></td></tr></table></body></html>';
return($body);
}
add_action( 'init' , 'body_from_user_to_therapist');
function body_from_user_to_therapist($s_user,$t_name)
{
$body = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Thriive | Emailer</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">


</head>

<body class="" style="width: 100%;
  background-color: #fff;
  color:#000;
  font-family:"Open Sans", sans-serif !important;
  font-size: 14px;
  line-height: 20px;
  margin: 0;
  padding: 0;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%; ">
    <table border="0" cellpadding="0" cellspacing="0" class="tab-holder" style="background-color: #fff;
	width: 600px; 
	height: 100%;
	font-family:"Open Sans", sans-serif !important;
	margin:0px auto;
	padding:0;
	border:1px solid #e4e4e4;">
        <tr>
            <td align="center" class="header_section" style="width: 100%; 
			height: 100%;
			margin:0px auto;
			padding: 20px 30px;
			background: #fff;">
                <a href="http://35.232.100.164" target="_blank">
                    <img src="images/thriive_logo.png" style="width: 30%;" alt="">
                </a>
            </td>
        </tr>
        <tr>
            <td class="content_03" style="width: 100%;
			height:auto;
			padding: 30px 40px;
			background: #fff;
			vertical-align: top;">
                <p style="float: left;
				margin: 0 0 5px 0;
				font-size: 12px;
				line-height: 18px;">
                    <strong style="text-transform: capitalize;">Subject Line :</strong> Online chat initiated on <a href="http://35.232.100.164" target="_blank">thriive.in</a> <br><br>Hi <strong style="text-transform: capitalize;">Therapist name,</strong>                    <br><br>Online chat is initiated with you by <strong style="text-transform: capitalize;">"User name"</strong>
                    <br><br>View Your Online Chat <a href="http://35.232.100.164" target="_blank">(Give a Chat link here)</a><br><br><br><br><strong style="text-transform: capitalize;">Keep Thriiving :)</strong><br>
                    <strong style="text-transform: capitalize;">Team Thriive Art and Soul</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <img src="images/footer-bg-top.png" style="width: 100%;vertical-align: bottom;" alt="">
            </td>
        </tr>
        <tr>
            <td class="footer_section" style=" width: 100%;	height: 100%;margin:0px auto;padding: 10px 40px;background: #4f0475;">
                <h4 style="font-family: "Barlow", sans-serif;font-size: 24px;line-height:30px;margin: 0;color: #ffb813;	text-transform: uppercase; text-align: center;">thriive social</h4>
                <p style="color: #fff; text-align: center;">&copy; 1997 - 2019 THRIIVE ART &amp; SOUL LLP. All Rights Reserved.</p>
            </td>
        </tr>
    </table>
</body>

</html>'; 



return($body);
}
add_action( 'init' , 'body_from_therapist_to_user');
function body_from_user_to_therapist_reply($s_user,$t_name)
{
$body = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Thriive | Emailer</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
</head>
<body class="" style="width: 100%;
  background-color: #fff;
  color:#000;
  font-family:"Open Sans", sans-serif !important;
  font-size: 14px;
  line-height: 20px;
  margin: 0;
  padding: 0;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%; ">
    <table border="0" cellpadding="0" cellspacing="0" class="tab-holder" style="background-color: #fff;
	width: 600px; 
	height: 100%;
	font-family:"Open Sans", sans-serif !important;
	margin:0px auto;
	padding:0;
	border:1px solid #e4e4e4;">
        <tr>
            <td align="center" class="header_section" style="width: 100%; 
			height: 100%;
			margin:0px auto;
			padding: 20px 30px;
			background: #fff;">
                <a href="http://35.232.100.164" target="_blank">
                    <img src="images/thriive_logo.png" style="width: 30%;" alt="">
                </a>
            </td>
        </tr>
        <tr>
            <td class="content_03" style="width: 100%;
			height:auto;
			padding: 30px 40px;
			background: #fff;
			vertical-align: top;">
                <p style="float: left;
				margin: 0 0 5px 0;
				font-size: 12px;
				line-height: 18px;">
                    <strong style="text-transform: capitalize;">Subject Line :</strong> <strong style="text-transform: capitalize;">"'.$s_name.'"</strong> answered your question<br><br>Hi <strong style="text-transform: capitalize;">'.$t_name.',</strong><br><br>Great
                    news! Your question has been answered by <strong style="text-transform: capitalize;">"'.$s_name.'"</strong>
                    <br><br>View Your Online Chat <a href="http://35.232.100.164" target="_blank">(Give a Chat link here)</a><br><br><br><br><strong style="text-transform: capitalize;">Keep Thriiving :)</strong><br> <strong style="text-transform: capitalize;">Team Thriive Art and Soul</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <img src="images/footer-bg-top.png" style="width: 100%;vertical-align: bottom;" alt="">
            </td>
        </tr>
        <tr>
            <td class="footer_section" style=" width: 100%;	height: 100%;margin:0px auto;padding: 10px 40px;background: #4f0475;">
                <h4 style="font-family:"Barlow", sans-serif;font-size: 24px;line-height:30px;margin: 0;color: #ffb813;	text-transform: uppercase; text-align: center;">thriive social</h4>
                <p style="color: #fff; text-align: center;">&copy; 1997 - 2019 THRIIVE ART &amp; SOUL LLP. All Rights Reserved.</p>
            </td>
        </tr>
    </table>
</body>

</html>';
return($body);
}
add_action( 'init' , 'body_from_therapist_to_therapist');
function body_from_therapist_to_user_reply($s_user,$t_name)
{
$body = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Thriive | Emailer</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
</head>
<body class="" style="width: 100%;
  background-color: #fff;
  color:#000;
  font-family:"Open Sans", sans-serif !important;
  font-size: 14px;
  line-height: 20px;
  margin: 0;
  padding: 0;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%; ">
    <table border="0" cellpadding="0" cellspacing="0" class="tab-holder" style="background-color: #fff;
	width: 600px; 
	height: 100%;
	font-family:"Open Sans", sans-serif !important;
	margin:0px auto;
	padding:0;
	border:1px solid #e4e4e4;">
        <tr>
            <td align="center" class="header_section" style="width: 100%; 
			height: 100%;
			margin:0px auto;
			padding: 20px 30px;
			background: #fff;">
                <a href="http://35.232.100.164" target="_blank">
                    <img src="images/thriive_logo.png" style="width: 30%;" alt="">
                </a>
            </td>
        </tr>
        <tr>
            <td class="content_03" style="width: 100%;
			height:auto;
			padding: 30px 40px;
			background: #fff;
			vertical-align: top;">
                <p style="float: left;
				margin: 0 0 5px 0;
				font-size: 12px;
				line-height: 18px;">
                    <strong style="text-transform: capitalize;">Subject Line :</strong> <strong style="text-transform: capitalize;">"Therapist name"</strong> answered your question <br><br>Hi <strong style="text-transform: capitalize;">User name,</strong>                    <br><br>Great news! Your question has been answered by <strong style="text-transform: capitalize;">"Therapist name"</strong> <br><br>View Your Online Chat <a href="http://35.232.100.164" target="_blank">(Give a Chat link here)</a><br><br><br><br>
                    <strong style="text-transform: capitalize;">Keep Thriiving :)</strong><br>
                    <strong style="text-transform: capitalize;">Team Thriive Art and Soul</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <img src="images/footer-bg-top.png" style="width: 100%;vertical-align: bottom;" alt="">
            </td>
        </tr>
        <tr>
            <td class="footer_section" style=" width: 100%;	height: 100%;margin:0px auto;padding: 10px 40px;background: #4f0475;">
                <h4 style="font-family:"Barlow", sans-serif;font-size: 24px;line-height:30px;margin: 0;color: #ffb813;	text-transform: uppercase; text-align: center;">thriive social</h4>
                <p style="color: #fff; text-align: center;">&copy; 1997 - 2019 THRIIVE ART &amp; SOUL LLP. All Rights Reserved.</p>
            </td>
        </tr>
    </table>
</body>

</html>'; 
return($body);
}

?>

