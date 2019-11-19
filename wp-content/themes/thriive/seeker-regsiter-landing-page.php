<?php /* Template Name: seeker regsiter landing page */ ?>
<?php 
	//echo "Page: " . is_page('seeker-regsiter-landing-page');
	if (is_user_logged_in()) { 
		$current_user = wp_get_current_user();
		if($current_user->roles[0] == 'therapist')
		{
			wp_redirect('/therapist-account-dashboard/');
			exit();
		}
		if(($current_user->is_mobile_verify)==1)
		{
			wp_redirect(site_url());
			//exit();
		}
	} 
?>

<?php get_header(); ?>
<section class="banner-home">
	<div class="container">
		<div class="row w-70">
		<div class="row text-center section w-70">
			<h1 class="w-100">Register As A User</h1>
			<p>Holistic solutions to physical, mental & emotional issues is what the world needs from Therapist like you. Sign up now and widen your reach to a global seeker base!</p>
		</div>	
		<div class="row text-center section w-70">
			<h2 class="w-100">5 Amazing Benefits</h2>
			<p class="w-100">you get on becoming a user</p>
		</div>
		<div class="d-flex text-center section col-12 col-sm-8 mx-auto list-item-wrapper">
			<div class="col-3 col-sm-2">
				<div class="circle-blue-wrapper">
					<span class="icon-new-connect icon-wrap"></span>
				</div>
			</div>
			<div class="col-9 col-sm-10 list-txt-wrapper"><p>Connect with the right Therapist</p></div>
		</div>
		<div class="d-flex text-center section col-12 col-sm-8 mx-auto list-item-wrapper">
			<div class="col-3 col-sm-2">
				<div class="circle-blue-wrapper">
					<span class="icon-new-update_calender icon-wrap"></span>
				</div>
			</div>
			<div class="col-9 col-sm-10 list-txt-wrapper"><p>Updates on global wellness events</p></div>
		</div>
		<div class="d-flex text-center section col-12 col-sm-8 mx-auto list-item-wrapper">
			<div class="col-3 col-sm-2">
				<div class="circle-blue-wrapper">
					<span class="icon-new-medicine icon-wrap"></span>
				</div>
			</div>
			<div class="col-9 col-sm-10 list-txt-wrapper"><p>Holistic solutions for your physical, mental & emotional issues</p></div>
		</div>
		<div class="d-flex text-center section col-12 col-sm-8 mx-auto list-item-wrapper">
			<div class="col-3 col-sm-2">
				<div class="circle-blue-wrapper">
					<span class="icon-new-visibility icon-wrap"></span>
				</div>
			</div>
			<div class="col-9 col-sm-10 list-txt-wrapper"><p>Access to well-researched, original wellness content & Thriive newsletter</p></div>
		</div>
		<div class="d-flex text-center section col-12 col-sm-8 mx-auto list-item-wrapper">
			<div class="col-3 col-sm-2">
				<div class="circle-blue-wrapper">
					<span class="icon-new-workshops-listing icon-wrap"></span>
				</div>
			</div>
			<div class="col-9 col-sm-10  list-txt-wrapper"><p>Access to exclusive guided meditations & Masters’ talks.</p></div>
		</div>
		</div>				
	</div>
</section>

<div class="m-1 divider"></div>

<section class="section form-element-wrapper">
	<div class="container">
		<?php
			echo $seeker_msg;
		  	set_query_var( 'column', 'col-sm-4 col-12');
		  	set_query_var( 'text_left', '');
		  	get_template_part('template-parts/seeker-login-form');
		?>
	</div>
</section>

<div class="modal fade" id="mobile_verfication_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal body -->
        <div class="modal-body">
	        <div class="error-msg form-error" id="mobileExist"></div>
         <form data-parsley-validate class="form-element-section"  id="form_send_otp">
	         <div class="row section col-sm-12 col-12 mx-auto p-0">
		        <div class="form-group col-12">
				 	<label for="mobile-number">Enter Mobile Number</label>
				 	<?php /* $codelen = strlen($current_user->countryCode); */ ?>
<!-- 				 	<input data-parsley-required="true" type="tel" data-parsley-required-message="Mobile is required." class="form-control international-number" id="mobile-number" pattern="[1-9]{1}[0-9]{9}" value="<?php if($current_user->mobile){ echo '+' . $current_user->countryCode . substr($current_user->mobile, $codelen); } ?>"> -->
						<input data-parsley-required="true" type="tel" data-parsley-required-message="Mobile is required." class="form-control international-number" id="mobile-number" value="<?php if($current_user->mobile){ echo '+' . $current_user->countryCode . $current_user->mobile; } ?>">
			  	</div>
			  	
			  	<button type="submit" class="btn d-inline btn-primary" id="send_otp1">SEND OTP</button>
	         </div>
         </form>                  
         <form data-parsley-validate  class="form-element-section" id="mobile_verification">
	         <div class="row section col-sm-12 col-12 mx-auto p-0 d-none" id="div_verify_otp">
			  	
			  	<div class="form-group col-12 ">
				 	<label for="mobile-otp">Enter OTP</label>
				 	<input data-parsley-required="true" type="text" data-parsley-required-message="OTP is required." data-parsley-maxwords="4" class="form-control" id="mobile-otp" id="mobile-otp">
			  	</div>
			  	<button type="button" class="btn d-inline btn-primary" id="re_send_otp">RESEND OTP</button>
	            <button type="submit" class="btn d-inline btn-primary" id="verify_otp" data-redirect="<?php echo get_permalink(548); ?>">NEXT</button>
	         </div>
         </form>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="account_in_review_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal body -->
        <div class="modal-body">
         <form data-parsley-validate class="form-element-section"  id="review_account">
	         <div class="row section col-sm-12 col-12 mx-auto p-0">
		        <div class="form-group col-12">
				 	<label >Your account has been created successfully. <br>You will be informed via email/Sms once the account has been verified by Thriive Account Manager.</label>
					</div><a href="<?php echo wp_logout_url( '/login/' ); ?>" class=" mx-auto btn btn-primary">  &nbsp;&nbsp;&nbsp; OK  &nbsp;&nbsp;&nbsp;  </a>
	         </div>
	          
         </form>                  
        </div>
      </div>
    </div>
  </div>
<?php 
	if(is_user_logged_in())
	{
		if(($current_user->is_mobile_verify)==0)
		{
			?>
			<script type="text/javascript">
				//$('.iti__country[data-dial-code="91"]').addClass('');
				$("#mobile_verfication_modal").modal();
			</script>
			<?php
		}	
	}
?> 
<?php get_footer(); ?>