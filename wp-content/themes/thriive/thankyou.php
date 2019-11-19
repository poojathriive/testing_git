<?php /* Template Name: Thank you page */ ?>
<?php 
	if (!is_user_logged_in()) { 
		wp_redirect('/login/');
		exit();
	} else {
		$current_user = wp_get_current_user();
		$address = json_decode($current_user->address);
		$username = $current_user->first_name . ' ' . $current_user->last_name;
		$admin_email = 'accountmanager1@thriive.in';	
		$finance_email = 'finance@thriive.in';	
	}
?>
<?php get_header(); ?>
<?php
	//Validating the reverse hash
	$hash = getHash($_POST);
	
	
/*
	echo "<pre>";print_r($_POST);echo "</pre>";
	echo "<pre>";print_r($hash);echo "</pre>";
*/
	
	?>
	<section class="package-selection-section" id="form-step-2">
		<?php
		if ($hash != $_POST["hash"]) 
		{	
			if($_POST['amount'] <= 0)
			{
				updateFreeUserDetails($_POST);				
				if($_POST["udf1"] == 'upgrade_package')
				{
					//Upgrade package
					?>
						<div class="container">
							<div class="row text-center section">
								<h2 class="w-100">Upgrade successful</h2>
							</div>
							<div class="form-group text-center col-12">
								<p>Congratulations! You have successfully upgrade your package. Keep Thriiving!</p>
							</div>
							<div class="form-group text-center col-12">
								<a href="/therapist-account-dashboard/" class=" mx-auto btn btn-primary"> My Account </a>
							</div>
						</div>
					<?php
					sendSMS($current_user->mobile, "Dear $username, Thriive welcomes you to our Tribe! It's time to show the world your light. Log in to thriive.in to customize your profile page. If you need any further help, call 7045933385 / send email to accountmanager1@thriive.in");
				}			
				else if($_POST["udf1"] == 'renew_package')
				{
					//Upgrade package
					?>
						<div class="container">
							<div class="row text-center section">
								<h2 class="w-100">Renew successful</h2>
							</div>
							<div class="form-group text-center col-12">
								<p>Congratulations! You have successfully renew your package. Keep Thriiving!</p>
							</div>
							<div class="form-group text-center col-12">
								<a href="/therapist-account-dashboard/" class=" mx-auto btn btn-primary"> My Account </a>
							</div>
						</div>
					<?php
					sendSMS($current_user->mobile, "Dear $username, Thriive welcomes you to our Tribe! It's time to show the world your light. Log in to thriive.in to customize your profile page. If you need any further help, call 7045933385 / send email to accountmanager1@thriive.in");
				}	
				else if($_POST["udf1"] == 'purchase_package')
				{
					//Purchase package	
					//echo "purchase package" . $_POST['amount'] ." <br>";	
					?>
						<div class="container">
							<div class="row text-center section">
									<h2 class="w-100">Profile created successful</h2>
							</div>
							<div class="form-group text-center col-12">
								   <p>Thank You, <?php echo $_POST["firstname"];?> , Your profile has been created successfully</p>
							</div>
							<div class="form-group text-center col-12">
								<a href="/therapist-account-dashboard/" class="mx-auto btn btn-primary"> My Account </a>
							</div>
						</div>				
					<?php
					sendSMS($current_user->mobile, "Dear $username, Thriive welcomes you to our Tribe! It's time to show the world your light. Log in to thriive.in to customize your profile page. If you need any further help, call 7045933385 / send email to accountmanager1@thriive.in");
				}
			}
			else
			{
				?>
					<div class="container">
						<div class="row text-center section w-70">
							<h2 class="w-100">Payment failed</h2>
						</div>
					</div>	
				<?php
			}	
		} 
		else 
		{
			//updateUserDetails($_POST["txnid"], $_POST["udf1"]);	
			$invoice_number = get_field('invoice_number', 'option');
			$invoice_number++;
			//$invoice_number_updated;
			
			updateUserDetails($_POST);	
			$amount = $_POST['amount'];	
			$package = $_POST['productinfo'];
			if($_POST["udf1"] == 'renew_package')
			{
				//Renew package
				?>
					<div class="container">
						<div class="row text-center section">
							<h2 class="w-100">Payment successful</h2>
						</div>
						<div class="form-group text-center col-12">
							<p>Congratulations! You have successfully renewed your package. The next year promises to be even bigger and shinier than the previous one. Keep Thriiving!</p>
							<p>Your order status is <?php echo $_POST["status"];?></p>
							<p>Your Transaction ID for this transaction is  <?php echo $_POST["txnid"];?></p>
						</div>
						<div class="form-group text-center col-12">
							   <a href="/therapist-account-dashboard/" class=" mx-auto btn btn-primary"> My Account </a>
						</div>
					</div>
				<?php
				delete_user_meta($current_user->ID, 'isRenew', 1); 
				// Customer Email
				$endDate = date("d/m/Y", strtotime(get_field('end_date', $current_user->transaction)));
				$subject = "Your $package package has been activated successfully.";
			    $msg = "Dear $username,<br><br>
			    Congratulations on renewing your package.<br>
				We have received Rs. $amount and you are now renewed $package package which is valid till $endDate.<br>
				Check out the amazing benefits you are now entitled to: ".site_url()."/package-details.<br><br>
				Let’s heal the world together.<br>
				Love & light,<br>
				Team Thriive<br><br>
				<em style='color: #615c5c;'>
					Note:This is an automatically generated email, please do not reply. Any questions, feel free to contact us at <a href='mailto:accountmanager1@thriive.in'>accountmanager1@thriive.in</a> for help.
				<em>";					
				sendEmailWithInvoice($current_user->user_email, $subject, $msg, get_current_user_id(), 'renew');
				update_field('invoice_number', $invoice_number, 'option');
				
				// Admin Email
				$post_id = get_user_meta(get_current_user_id(), 'post_id', true);
				$old_package = get_post_meta($post_id, 'old_package', true);
				$subject = "$username has renewed $package package."; 
				$msg = "Dear Account Manager,<br><br>
					$username has paid Rs. $amount and renewed their $package package.
					Love & light,
					Team Thriive";
				sendEmail($admin_email, $subject, $msg);
				
				// Finance Email
				$subject = "$username has upgraded to $package package.";
				$msg = "Dear Finance Team,<br><br>
					$username has paid Rs. $amount and renewed their $package package.
					Please send them the invoice.
					Love & light,
					Team Thriive";
				sendEmailWithInvoice($finance_email, $subject, $msg, get_current_user_id(), 'renew');
			}
			else if($_POST["udf1"] == 'upgrade_package')
			{
				//Upgrade package
				?>
					<div class="container">
						<div class="row text-center section">
							<h2 class="w-100">Payment successful</h2>
						</div>
						<div class="form-group text-center col-12">
							<p>Congratulations! You have successfully upgraded your package. Keep Thriiving!</p>
							<p>Your order status is <?php echo $_POST["status"];?></p>
							<p>Your Transaction ID for this transaction is  <?php echo $_POST["txnid"];?></p>
						</div>
						<div class="form-group text-center col-12">
							<a href="/therapist-account-dashboard/" class=" mx-auto btn btn-primary"> My Account </a>
						</div>
					</div>
				<?php
						// Customer Email
						$endDate = date("d/m/Y", strtotime(get_field('end_date', $current_user->transaction)));
						$subject = "Your $package package has been activated successfully.";
					    $msg = "Dear $username,<br><br>
					    Congratulations on stepping up a level in your package.<br>
						We have received Rs. $amount and you are now upgraded to the $package package which is valid till $endDate.<br>
						Check out the amazing benefits you are now entitled to: ".site_url()."/package-details.<br><br>
						Let’s heal the world together.<br>
						Love & light,<br>
						Team Thriive<br><br>
						<em style='color: #615c5c;'>
							Note:This is an automatically generated email, please do not reply. Any questions, feel free to contact us at <a href='mailto:accountmanager1@thriive.in'>accountmanager1@thriive.in</a> for help.
						<em>";					
						sendEmailWithInvoice($current_user->user_email, $subject, $msg, get_current_user_id(), 'upgrade');
						update_field('invoice_number', $invoice_number, 'option');
						
						// Admin Email
						$post_id = get_user_meta(get_current_user_id(), 'post_id', true);
						$old_package = get_post_meta($post_id, 'old_package', true);
						$subject = "$username has upgraded to $package package."; 
						$msg = "Dear Account Manager,<br><br>
							$username has paid Rs. $amount and upgraded their package from $old_package package to $package package.
							Love & light,
							Team Thriive";
						sendEmail($admin_email, $subject, $msg);
						
						// Finance Email
						$subject = "$username has upgraded to $package package.";
						$msg = "Dear Finance Team,<br><br>
							$username has paid Rs. $amount and upgraded their package from $old_package package to $package package.
							Please send them the invoice.
							Love & light,
							Team Thriive";
						sendEmailWithInvoice($finance_email, $subject, $msg, get_current_user_id(), 'upgrade');	
			}
			else
			{
				//Purchase package
				?>
					<div class="container">
						<div class="row text-center section">
							<h2 class="w-100">Payment successful</h2>
						</div>
						<div class="form-group text-center col-12">
							   <p>Thank You, <?php echo $_POST["firstname"];?> , Your order status is <?php echo $_POST["status"];?></p>
							   <p>Your Transaction ID for this transaction is  <?php echo $_POST["txnid"];?></p>
						</div>
						<div class="form-group text-center col-12">
							   <a href="/therapist-account-dashboard/" class=" mx-auto btn btn-primary"> My Account </a>
						</div>
					</div>
				<?php
				update_field('invoice_number', $invoice_number, 'option');
			}
			sendSMS($current_user->mobile, "Dear $username, your payment of Rs. $amount for $package package has been received with gratitude. Log in to thriive.in to customize your profile page. If you need any further help, call 7045933385 / send email to accountmanager1@thriive.in");
		}         
        
		?>	
	</section>
<?php get_footer(); ?>
