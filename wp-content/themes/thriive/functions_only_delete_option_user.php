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
	$to_user_id = $_POST['to_user_id'];
	$from_user_id = $_POST['from_user_id'];
   $query = " SELECT * FROM chat_message_details  WHERE ((from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')) and (delete_status = 0)  ORDER BY chat_time ASC ";
	$result = $wpdb->get_results($query);
	//print_r($result);
$therepist_data = get_userdata( $to_user_id);
	$t_name = $therepist_data->display_name;
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
 else
 {
 	$chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.$location.'" height="100" width="100" /></a>';
 }
		 
	 }
  $user_name = '';
  if($row->from_user_id == $from_user_id)
  {
   $user_name = '<b class="text-success">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.$t_name.'</b>';
  }
  $output .= ' <li class="user_stats_rhs" style="border-bottom:1px dotted #ccc">';
	  if($row->from_user_id == $from_user_id && $role == 'subscriber')
  {
	 $output .= '<p><input type="checkbox" name = "msgid" value="'.$row->chat_message_id.'" style="opacity:1;position:relative;margin-right: 6px;float:left" class="checkSingle"></p>';
	  }
	 $output .= '<p>'.$user_name.' - '.$chat_message.'
    <div align="right">
     - <small><em>'.$row->chat_time.'</em></small>
    </div>
   </p>
  </li>
  ';
 }
 $output .= '</ul>';
$query = " UPDATE chat_message_details  SET user_status = '1',terepist_status = '1'   WHERE (from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."') ";
 $result = $wpdb->query($query);
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
	if($role == 'subscriber')
	{
   $query = " SELECT * FROM chat_message_details  WHERE ((from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')) and (user_status = 0) ORDER BY chat_time DESC limit 1 ";
	}
	else
	{
		 $query = " SELECT * FROM chat_message_details  WHERE ((from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')) and (terepist_status = 0) ORDER BY chat_time DESC limit 1 ";
		
	}

	$result = $wpdb->get_results($query);
	//print_r($result);
$output = '';
$therepist_data = get_userdata( $to_user_id);
	$t_name = $therepist_data->display_name;
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
		 if($extension == 'docs' || $extension == 'doc')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/wp-content/uploads/imagesword.png" height="100" width="100" /></a>';
}
 elseif($extension == 'xls' || $extension == 'xlsx')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/chat/wp-content/uploads/imagesexcel.jpg" height="100" width="100" /></a>';
}
 elseif($extension == 'pdf')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/chat/wp-content/uploads/images.png" height="100" width="100" /></a>';
}
elseif($extension == 'txt')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/chat/wp-content/uploads/imagesfile.jpg" height="100" width="100" /></a>';
}
 else
 {
 	$chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.$location.'" height="100" width="100" /></a>';
 }
		 
	 }
  $user_name = '';
  if($row->from_user_id == $from_user_id)
  {
   $user_name = '<b class="text-success">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.$t_name.'</b>';
  }
 $output .= ' <li class="user_stats_lhs"  style="border-bottom:1px dotted #ccc">';
	  if($row->from_user_id == $from_user_id && $role == 'subscriber')
  {
	 $output .= '<p><input type="checkbox" name = "msgid" value="'.$row->chat_message_id.'" style="opacity:1;position:relative;margin-right: 6px;float:left" class="checkSingle"></p>';
	  }
	 $output .= '<p>'.$user_name.' - '.$chat_message.'
    <div align="right">
     - <small><em>'.$row->chat_time.'</em></small>
    </div>
   </p>
  </li>
  ';
 }

 $output .= '</ul>';
echo $output;

	//if($role == 'subscriber' && $output != '')
if($role == 'subscriber')
	{
		$query = " UPDATE chat_message_details  SET user_status = '0'  WHERE (from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')   AND user_status = '0' ";
$query = " UPDATE chat_message_details  SET user_status = '1'  WHERE (from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')   AND user_status = '0' ";	}
	else
	{
		$query = " UPDATE chat_message_details  SET terepist_status = '1'  WHERE (from_user_id = '".$from_user_id."'  AND to_user_id = '".$to_user_id."')  OR (from_user_id = '".$to_user_id."'  AND to_user_id = '".$from_user_id."')   AND terepist_status = '0' ";
	}
 $result = $wpdb->query($query);

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
global $wpdb;
$wpdb->insert("chat_message_details", array(
   "to_user_id" => $to_user_id,
   "from_user_id" => $from_user_id,
   "chat_message" => $chat_message,
   "status" => '0',
 "is_file" => $is_file,
	'terepist_status'=>'0',
"user_status" => '0',
   "chat_time" => date('Y-m-d h:i:s'),
));
// Print last SQL query string
$wpdb->last_query;
// Print last SQL query result
$wpdb->last_result;
// Print last SQL query Error
$wpdb->last_error;
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
$wpdb->insert("notification_details", array(
   "to_user_id" => $touserid,
   "from_user_id" => $fromuserid,
   "message" => $msg,
   "mobile" => $mobile,
	 "send_status" => 1,
   "date_time" => date('Y-m-d h:i:s'),
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
	foreach($ids as $id)
	{
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
     $query = " SELECT * FROM chat_message_details  WHERE (from_user_id = '".$session_id."'  or to_user_id = '".$session_id."') ORDER BY chat_time ASC ";
	
	$result = $wpdb->get_results($query);
	
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
	 $to_user_id = $row->to_user_id;
	 $therepist_data = get_userdata( $to_user_id);
	
		 $t_name = $therepist_data->display_name;
	 $chat_message = $row->chat_message;
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
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/chat/wp-content/uploads/imagesexcel.jpg" height="100" width="100" /></a>';
}
 elseif($extension == 'pdf')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/chat/wp-content/uploads/images.png" height="100" width="100" /></a>';
}
elseif($extension == 'txt')
{
	 $chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.site_url().'/chat/wp-content/uploads/imagesfile.jpg" height="100" width="100" /></a>';
}
 else
 {
 	$chat_message = '<a href="'.site_url().'/'.$location.'" target="_blank"><img src="'.$location.'" height="100" width="100" /></a>';
 }
		 
	 }
  $user_name = '';
	
  if($row->from_user_id == $session_id)
  {
   $user_name = '<b class="text-success">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.$t_name.'</b>';
  }
  $output .= '
  <li class="user_stats_lhs" style="border-bottom:1px dotted #ccc">
 
   <p>'.$user_name.' - '.$chat_message.'<div align="right"> - <small><em>'.$row->chat_time.'</em></small></div></p>
  </li>
  ';
 }
 $output .= '</ul>';
	
	return($output);
}

add_action( 'init' , 'user_chat_history' );
function user_chat_history(){
	$current_user = wp_get_current_user();
	$session_id = $current_user->ID;
	global $wpdb;
     $query = " SELECT to_user_id FROM chat_message_details  WHERE (from_user_id = '".$session_id."' and delete_status = 0) group by to_user_id ORDER BY chat_time ASC ";

	$result = $wpdb->get_results($query);
	
	$output = '<table border = "2" ><tr> <td widht="30%">User Name</td><td width="30%">Action</td></tr>';
	 foreach($result as $row)
 {
	 $to_user_id = $row->to_user_id;
	 $therepist_data = get_userdata( $to_user_id);
	
		 $t_name = $therepist_data->display_name;
	 $chat_message = $row->chat_message;
		 	$arr = get_user_meta($to_user_id, 'first_name');
		$name = $arr[0];

 if(is_user_online($therapist_id))
{
   $to_status = 1;
 }
 else
 {
	  $to_status = 0;
 }
			  
 $output .= '<tr><td>'.$name.'</td><td id="start_chat_button_'.$to_user_id.'">
<button type="button" class="btn btn-info btn-xs view_chat btn btn-primary btn-big btn-transparent connect_with_btn_listing" data-fromuserid = "'.$session_id.'" data-touserid="'.$to_user_id.'" data-tousername="'.$name.'"  data-role="subscriber">View Chat</button></td></tr>';
	 }
$output .= '</table>';
	
	return($output);
}
add_action( 'init' , 'export_csv' );
function export_csv()
{
	if(isset($_GET['download_report']))
{	
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
$csv_output = "To,From,Message,Date & Time";
$csv_output .= "\n";
 $query = " SELECT * FROM chat_message_details  WHERE (from_user_id = '".$session_id."'  or to_user_id = '".$session_id."') and (delete_status = 0)  ORDER BY chat_time ASC";
	
	$result = $wpdb->get_results($query);
 foreach($result as $row)
 {
	 if($row->is_file == 'yes')
		 $message = 'Image';
	 else
$message = trim($row->chat_message);
		 
		 $csv_output .= $row->to_user_id.",".$row->from_user_id.",".$message.",".trim(date('M d Y h:i:s',strtotime($row->chat_time)));
	 $csv_output .= "\n";
	 
 }
	
echo $csv_output;


//echo $csv;
exit;
	}
}


?>