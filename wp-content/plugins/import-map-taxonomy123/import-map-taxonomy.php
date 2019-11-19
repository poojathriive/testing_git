<?php
/*
	Plugin Name: Import Map Taxonomy
	Plugin URI: http://www.noesis.tech
	Description: Import map taxonomy
	Author: Noesis Knowledge Solution
	Version: 1.0
	Author URI: http://www.noesis.tech
*/
?>
<?php
define('NKS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('NKS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('NKS_PLUGIN_PATH', plugins_url('assets/',__FILE__));

//Adding menu in wp-admin
function nks_admin_menu() 
{
	add_menu_page('Import Map Taxonomy', 'Import Map Taxonomy', 'administrator','import-map-taxonomy', 'nks_importMapTaxonomy');
	
	
/*
    add_submenu_page(
        'import-map-taxonomy',
        'Map users & therapists', //page title
        'Map users & therapists', //menu title
        'administrator', //capability,
        'map-users-and-therapists',//menu slug	
        nks_userTherapist()
    );
*/
	
	//Loading CSS
	//wp_enqueue_style('bootstrap-css', NKS_PLUGIN_PATH . 'css/bootstrap.css');
	wp_enqueue_style('custom-css', NKS_PLUGIN_PATH . 'css/custom.css');
	
	//Loading JS
	//wp_enqueue_script('jquery-js', NKS_PLUGIN_PATH . 'js/jquery.min.js');
	//wp_enqueue_script('bootstrap-js', NKS_PLUGIN_PATH . 'js/bootstrap.min.js');
}
add_action('admin_menu', 'nks_admin_menu');

function nks_importMapTaxonomy()
{
	if (is_admin())
	{
		// load admin files only in admin
        require_once (NKS_PLUGIN_DIR . 'includes/admin/import.php');
    }
}
	
//Function to trigger on activation 
function nks_pluginActivation(){}
register_activation_hook(__FILE__, 'nks_pluginActivation');

//Function to trigger on deactivation 
function nks_pluginDeactivation(){}
register_deactivation_hook(__FILE__, 'nks_pluginDeactivation');

//Function to trigger on delete/uninstallation 
function nks_pluginUninstall(){}
register_uninstall_hook(__FILE__, 'nks_pluginUninstall');


//saving ailment and therapy
function nks_save_taxonomy_ailment($file,$post_data)
{
	$rows = nks_excelToArray($file); 
	//echo "<pre>";print_r($rows);echo "</pre>";exit;
	
	//print_r($post_data);
	//Storing form values in variable
	$main_taxonomy = $post_data['main_taxonomy'];		//Ailment taxonomy
	$map_taxonomy = $post_data['map_taxonomy'];			//Therapy taxonomy
	$main_taxonomy_field = $post_data['main_taxonomy_field'];	//Therapies ACF
	$map_taxonomy_field = $post_data['map_taxonomy_field'];		//Ailment ACF
	$therapies_separated_by = $post_data['therapies_separated_by'];		//Ex: '|' ',' 
	//echo "<pre>";print_r($post_data);echo "</pre>";exit;

	//$i=1;
	//Loop through each row of $rowData i.e., $rows
	foreach($rows as $row)
	{
		$ailment = $row[0];
		$therapies = explode($therapies_separated_by,$row[1]);
		$therapies = array_filter($therapies);
		
		//check ailment is exist or not, if not then create it and take its ID. Otherwise take its ID
		$isAilmentExist = term_exists($ailment,$main_taxonomy);
		if($isAilmentExist !== 0 && $isAilmentExist !== null)
		{
			$ailment_term_id = $isAilmentExist['term_id'];			
		}
		else
		{
			$result = wp_insert_term($ailment,$main_taxonomy);
			$ailment_term_id = $result['term_id'];
		}
		
		$ailmentIds = array();
		$excelTherapiesIds = array();
		
		//Loop through each therapy and check therapy is exist or not, if not then create it and take its ID. Otherwise take its ID
		foreach($therapies as $st)
		{
			$isTherapyExist = term_exists($st,$map_taxonomy);
			if($isTherapyExist !== 0 && $isTherapyExist !== null)
			{
				$therapy_term_id = $isTherapyExist['term_id'];			
			}
			else
			{
				$result = wp_insert_term($st,$map_taxonomy);
				if(is_wp_error($result))
				{
					echo "Unable to add Taxonomy term <br>" . $result->get_error_message();
					exit;
				}
				$therapy_term_id = $result['term_id'];
			}
			
			//update_term_meta($therapy_term_id, 'ailment', array($ailment_term_id) );
			$excelTherapiesIds[] = $therapy_term_id;	
			
			$is_has_parent = get_term_by( 'id', $therapy_term_id, 'therapy');
			if($is_has_parent->parent > 0)
			{
				$excelTherapiesIds[] = $is_has_parent->parent;
			}		
		}
		
		//$i++;
		//Updating therapies field of ailment's term
		$excelTherapiesIds = array_unique($excelTherapiesIds);
		$query = update_term_meta($ailment_term_id, $main_taxonomy_field, $excelTherapiesIds);
		
		//Mapping.... 		
		$selected_therapies = get_field($main_taxonomy_field, $map_taxonomy_field . '_'.$ailment_term_id);
		foreach($selected_therapies as $s_therapy_id)
		{
			$saved_ailment = get_term_meta($s_therapy_id->term_id, $map_taxonomy_field,true);
			
			if(empty($saved_ailment)) 
		    {
			    $saved_ailment = array($ailment_term_id);
		    }
			else
		    {
			    if(!in_array($ailment_term_id, $saved_ailment))
			    {
				    array_push($saved_ailment,$ailment_term_id);
				}
			}
		    $query = update_term_meta($s_therapy_id->term_id, $map_taxonomy_field, $saved_ailment);
		}		
	}
	return $query;
}

function nks_userTherapistMapping()
{
	$therapist_args =  array(
		'post_type' => 'therapist',
		'posts_per_page' => -1
	);
	$therapists = new WP_Query($therapist_args);
	
	if($therapists->have_posts())
	{
		while ($therapists->have_posts())
		{
			$therapists->the_post();
			
			$therapist_id = get_the_id();
			$post = get_post($therapist_id);
			$user_id = $post->post_author;
			
			$isPostMapped = get_user_meta($user_id, 'post_id', true);
			//echo $isPostMapped;
			if(empty($isPostMapped))
			{
				update_user_meta($user_id, 'post_id',  $therapist_id);
			}
		}
		wp_reset_postdata();
	}
}

//Converting xlxs rows into PHP array
function nks_excelToArray($files)
{
	//Path of PHPExcel library
	require_once (NKS_PLUGIN_DIR . 'library/Classes/PHPExcel/IOFactory.php');
	$inputFileName = $files['tmp_name'];
	try 
	{
		//If no issue while uploading files
    	$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
    	$objPHPExcel = $objReader->load($inputFileName);
	} 
	catch(Exception $e) 
	{
		//If there is any error while uploading the file
	    die($e->getMessage());
	}
	
	//  Get worksheet dimensions
	$sheet = $objPHPExcel->getSheet(0); 
	$highestRow = $sheet->getHighestRow(); 
	$highestColumn = $sheet->getHighestColumn();
	
	$rowData = array();
	//$row = 2 means skipping row 1 which is our column Header
	for ($row = 2; $row <= $highestRow; $row++)
	{
		$result = array();
		//65 is the ASCII code of Character 'A'
		for($i = 65; $i <= ord($highestColumn); $i++)
		{
			$result_1 = $sheet->rangeToArray(chr($i) . $row ,NULL,TRUE,FALSE)[0];
			//if(count(array_filter($result_1)) > 0)
			//{	
				//asign only if it is not empty
				$result = array_merge($result, $result_1); 
			//}
		}
		if(count(array_filter($result)) > 0)
		{	
			//asign only if it is not empty
			$rowData[] = $result;
		}
	}
	return $rowData;
}

function nks_sendEmailToTherapist($therapists)
{
	//echo "<pre>";print_r($therapists);echo "</pre>";
	
	foreach($therapists as $therapist)
	{
		$id = $therapist[0];
		$name = $therapist[1];
		$link = $therapist[2];
		$email = $therapist[3];
		$mobile = $therapist[4];
		$password = $therapist[5];
		$msgEmail = "
			Dear <strong>$name, </strong><br><br>
			
			We're excited to announce that Thriive Art & Soul has a new home!  No, the address has not changed (<a href='https://www.thriive.in/'>https://www.thriive.in/</a>) but the site is revamped with great user-friendly benefits!<br><br>
			
			Two years ago, Thriive Art & Soul began a wellness quest to create a platform to curate verified alternative therapists from all over the world. Thrilled to say that we have grown, and many of our registered therapists have reaped those benefits! And we are grateful to each and every one of you who has been part of this incredible journey!<br><br>
			
			This stupendous growth has been keeping us on our toes. As you know,we are always invested in making sure both our therapists and users are easily accessible to each other. We have been upgrading our digital platform regularly but now we decided to make the BIG LEAP.<br><br>
			
			We have moved up to a bigger and better platform. The Thriive experience promises to be even more memorable and user-friendly with newer features added:<br><br>
			
			<ul>
				<li>You can now list your own events and showcase your articles on your profile page. Jazz it up nicely enough and we might feature you as one of the top 10 therapists on our website.</li>
				<li>How many people have viewed your profile page? How many have connected with you? The digital counter on your profile page is all set to spill out that data for you! Share your page as much as you can, to family and their friends, so that counter goes UP, UP & UP!</li>
				<li>We know you’re going to love this one: When a person clicks on the ‘Connect with Therapist’ button on your profile page, both you and they will receive each other’s telephone number. Say Yayyy to the process becoming easier and less time-consuming!</li>
			</ul>
			
			Check it out for yourself: <a href='https://www.thriive.in/'>https://www.thriive.in/<a><br><br>
			
			Log in to your dashboard and get going: <br><br>
			
			User Name:$name<br>
			Email: $email<br>
			Password (change it once you have logged in): $password <br><br>
			
			All other benefits that you've used and loved continue to be part of your profile page. Do not hesitate to call 7045933385 if you need any help.<br><br>
			
			Here's to the next step of an exciting journey.<br><br>
			
			Love & light,<br>
			Team Thriive<br><br>
			<em style='color: #615c5c;'>
				Note:This is an automatically generated email, please do not reply. Any questions, feel free to contact us at <a href='mailto:accountmanager1@thriive.in'>accountmanager1@thriive.in</a> for help.
			<em>
		";
		$subject = "$name, we are going places!";
		nks_sendEmail($email, $subject, $msgEmail);
		
		$msgSMS = "Thriive (www.thriive.in) has a new home! We've already sent you an email with all the details about the fabulous new features. This promises to make your Thriive experience even more user-friendly. But if you just can't wait to visit your new home, here are your login credentials: Username: $name, Email: $email, Password: $password. Need help? Email us at accountmanager1@thriive.in";
		if(!empty($mobile))
		{
			nks_sendSMS($mobile,$msgSMS);
		}
	}
	return true;
}


function nks_sendEmail($to, $subject, $msg)
{
	$headers = array('Content-Type: text/html; charset=UTF-8');
	wp_mail( $to, $subject, $msg, $headers);
}

function nks_sendSMS($mobileNo, $msg)
{
	$url = SMS_URL."destination=".$mobileNo."&message=".urlencode($msg);
	$result = file_get_contents($url);
	return $result;
}

?>