<?php /* Template Name: seeker my account edit page */ ?>
<?php 
	if (!is_user_logged_in()) 
	{ 
		wp_redirect('/seeker-regsiter-landing-page/');
		exit();
	} 
	else 
	{
		$current_user = '';		//reset the variable
		$current_user = wp_get_current_user();	
		
		//if($current_user->roles[0] == 'therapist')
		if(in_array("therapist", $current_user->roles))
		{
			wp_redirect('/therapist-account-dashboard/');
			exit();
		}
		$address = json_decode($current_user->address);
		$countries = $wpdb->get_results("SELECT * FROM countries ORDER BY name ASC");
	}
	//print_r($_SERVER);
?>
<?php get_header(); ?>

<section>
	<div class="container">
		<div class="row section col-sm-4 col-12 mx-auto">
			<div class="col-12 col-sm-7 d-flex mb-4 ">
				<a href="/my-account-page" class="back-btn"> ≺ BACK </a>
			</div>
			<form data-parsley-validate  class="form-element-section" action="" method="post">
				<?php wp_nonce_field('update_seeker'); ?>
			  <div class="form-group">
			    <label for="firstname">First Name*</label>
			    <input data-parsley-required="true" data-parsley-required-message="First Name is required." type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $current_user->first_name;?>">
			  </div>
			  <!-- <div class="form-group">
			    <label for="lastname">Last Name</label>
			    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $current_user->last_name;?>">
			  </div> -->
			  
			  <div class="form-group">
			    <label for="email">Email*</label>
			    <input data-parsley-type="email" data-parsley-required-message="Email is required."  data-parsley-required="true" type="email" class="form-control" id="email" name="email" value="<?php echo $current_user->user_email;?>" disabled>
			  </div>	  
			  
			  <div class="form-group">
			    <label for="mobile">Mobile*</label>
			    <input data-parsley-required="true" type="tel" data-parsley-required-message="Mobile is required." class="form-control international-number" id="mobile" name="mobile" value="<?php echo $current_user->mobile;?>" readonly>
			  </div>
			  
			  <!-- <div class="regsiter-form-section">
			  <div class="form-group">
			    <label for="country" class="d-block">Country*</label>
			    <select class="mb-2 form-control select-list-item select-dropdown-list" id="country" name="country" data-parsley-errors-container="#country_select_error" data-parsley-required-message="Country is required." required>
					<?php if($address->country == '') { ?> <option value="">No country selected</option> <?php } ?> 
					<?php foreach($countries as $key => $value) { ?>
						<option country_id="<?php print_r( $value->id );?>" value="<?php print_r( $value->name );?>" <?php echo ($address->country != '' && $value->name == $address->country)?'selected':''?>><?php print_r( $value->name );?></option>
					<?php } ?>
				</select>
				<div id="country_select_error"></div>
			  </div>
			  <div class="form-group">
				
				<label for="state" class="d-block">State*</label>
				<select class="mb-2 form-control select-list-item select-dropdown-list" id="state" name="state" data-parsley-errors-container="#state_select_error" data-parsley-required-message="State is required." required <?php echo ($address->state == '')?'disabled':'';?>>
					<?php if($address->state != '') { CountryStateChange(); } else { ?>
				    	<option value="">Select country first *</option>
				    <?php } ?>
				</select>
				<div id="state_select_error"></div>
			  </div>
			  <div class="form-group">
				
				<label for="city" class="d-block">City*</label>
				<select class="mb-2 form-control select-list-item select-dropdown-list" id="city" name="city" data-parsley-errors-container="#city_select_error" data-parsley-required-message="City is required." required <?php echo ($address->city == '')?'disabled':'';?>>
					<?php if($address->city != '') { StateCityChange(); } else { ?>
				    	<option value="">Select state first *</option>
				    <?php } ?>
				</select>
				<div id="city_select_error"></div>
			  </div>

			  </div> -->
			
			  <button type="submit" class="btn btn-primary" name="update_seeker_submit" id="signup_submit">Update</button>
			</form>
		</div>
	</div>
</section>



<?php get_footer(); ?>