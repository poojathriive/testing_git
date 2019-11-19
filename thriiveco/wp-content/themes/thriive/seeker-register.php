<?php /* Template Name: Seeker register page */ ?>

<?php 
	if (!is_user_logged_in()) { 
		wp_redirect('/login/');
		exit();
	} else {
		$current_user = wp_get_current_user();
		$address =json_decode($current_user->address);
		//$userPost = get_post($current_user->post_id);
		//isStageCompleted($current_user->ID);

/*
		echo 'Current staatus : '.get_post_status( $current_user->post_id );
		echo '<br> post id : '.$current_user->post_id .'<br>Stage before  :   '.$current_user->stage;
		echo '<br>Stage after :  '.$current_user->stage;
		echo '<br>return stage checking : '.$data;
*/

	}
?>
<?php get_header(); ?>

<div class="modal fade" id="mobile_verfication_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal body -->
        <div class="modal-body">
         <form data-parsley-validate class="form-element-section"  id="form_send_otp">
	         <div class="row section col-sm-12 col-12 mx-auto p-0">
		        <div class="form-group col-12">
				 	<label for="mobile-number">Enter Mobile Number</label>
				 	<input data-parsley-required="true" type="number" 
 data-parsley-required-message="Mobile is required." class="form-control" placeholder="eg.+91 9876543210" id="mobile-number" value="<?php echo $current_user->mobile;?>">
			  	</div>
			  	
			  	<button type="submit" class="btn d-inline btn-primary" id="send_otp">SEND OTP</button>
	         </div>
         </form>                  
         <form data-parsley-validate  class="form-element-section" id="mobile_verification">
	         <div class="row section col-sm-12 col-12 mx-auto p-0 d-none" id="div_verify_otp">
			  	
			  	<div class="form-group col-12 ">
				 	<label for="mobile-otp">Enter OTP</label>
				 	<input data-parsley-required="true" type="text" data-parsley-required-message="OTP is required." data-parsley-maxwords="4" class="form-control" id="mobile-otp" id="mobile-otp">
			  	</div>
			  	<button type="submit" class="btn d-inline btn-primary" id="re_send_otp">RESEND OTP</button>
	            <button type="submit" class="btn d-inline btn-primary" id="verify_otp">NEXT</button>
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
	if(is_user_logged_in()){
		if(($current_user->is_mobile_verify)==0){
			echo '<script type="text/javascript">$("#mobile_verfication_modal").modal();</script>';
		}	
	}
?>  
<?php get_footer(); ?>