<?php
	$current_user = wp_get_current_user();
	$address = json_decode($current_user->address);
	$countries = $wpdb->get_results("SELECT * FROM countries ORDER BY name ASC");
?>
<div class="">
			<div class="text-center section col-sm-7 col-12 mx-sm-auto p-0">
			<div class="col-12 mt-3 text-center">
<!-- 			<a href="" class="btn btn-primary m-3">SIGN UP NOW</a> -->
				<?php 
				if(get_query_var("call_consult")){
					$login_url = add_query_arg('flg', '1', get_permalink(419));
				}else{
					$login_url = get_permalink(419);
				}
				?>
				<h3 class="w-100 signup-text-top">Already Registered? <a href="<?php echo $login_url; ?>" class="">Click here</a> to LOGIN</h3>
				
			</div>	
			
			<h5 class="w-100">Sign Up With</h5>
				
			<div class="col-12 mt-3">
				<?php echo do_shortcode('[TheChamp-Login]') ?>
				<a href="" class="facebook-link-wrapper social-btn-wrapper">
					<i class="fa fa-facebook"></i>
					<span>FACEBOOK</span>
				</a>
				<a href="" class="google-link-wrapper social-btn-wrapper">
					<i class="fa fa-google-plus"></i>
					<span>GOOGLE</span>
				</a>
			</div>
			<div class="col-12 mt-3">Or</div>
		
			</div>
		</div>
		<div class="m-1 divider"></div>
		<div id="error_msg_div" class="error-msg form-error error_msg_div"></div>
		<div class="row section <?php echo $column . ' ' . $text_left; ?> mx-auto">
			<form data-parsley-validate id="seeker_reg_form_modal"  class="form-element-section" action="" method="post">
				<?php
					if(isset($_GET['event_id']) && isset($_GET['query']))
					{
						?>
						<input type="hidden" name="txtEventId" value="<?php echo $_GET['event_id']; ?>">
						<input type="hidden" name="txtQuery" value="<?php echo $_GET['query']; ?>">
						<?php
					}
				?>
			  <div class="form-group">
			    <label for="firstname">First Name here*</label>
			    <input data-parsley-required="true" data-parsley-required-message="First Name is required." data-parsley-pattern="/^[a-zA-Z ]*$/" data-parsley-pattern-message="Valid characters: Alphabets and space." type="text" class="form-control" id="firstname" name="firstname">
			  </div>
			  <!-- <div class="form-group">
			    <label for="lastname">Last Name</label>
			    <input type="text" data-parsley-pattern="/^[a-zA-Z ]*$/" data-parsley-pattern-message="Valid characters: Alphabets and space." class="form-control" id="lastname" name="lastname">
			  </div> -->
			  
			  <div class="form-group">
			    <label for="email">Email *</label>
			    <input data-parsley-type="email" data-parsley-required-message="Email is required."  data-parsley-required="true" type="email" class="form-control" id="email" name="email">
			  </div>
			  
			  <div class="form-group">
			    <label for="pwd">Password *</label>
			    <div class="input-group">
			        <input data-parsley-required="true" type="password" data-parsley-errors-container="#pwd-holder" data-parsley-required-message="Password is required."  data-parsley-pattern="/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/" data-parsley-pattern-message="<div>Password must contain at least:</div><ol><li>One character</li><li>One number</li><li>One special character</li><li>Six characters in length</li></ol>" class="form-control" id="pwd" name="password">
			        <span class="input-group-addon togglePassword" style="cursor: pointer;"><i class="fa fa-eye-slash"></i></span>
		      	</div>		
		      	<div id="pwd-holder"></div>	    
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
				    	<option value="">Select country first *</option>
				</select>
				<div id="state_select_error"></div>
			  </div>
			  <div class="form-group">
				
				<label for="city" class="d-block">City*</label>
				<select class="mb-2 form-control select-list-item select-dropdown-list" id="city" name="city" data-parsley-errors-container="#city_select_error" data-parsley-required-message="City is required." required <?php echo ($address->city == '')?'disabled':'';?>>
				    	<option value="">Select state first *</option>
				</select>
				<div id="city_select_error"></div>
			  </div>
			  </div> -->
			  
<!--
			<div class="form-group">
				<label for="city">City*</label>
			   <select class="mb-2 form-control select-list-item select-dropdown-list" id="city" name="city">
				    <option hidden disabled selected>Select city</option>	    
					<option value="Mumbai 1">Mumbai 1</option>
					<option value="Mumbai 2">Mumbai 2</option>
					<option value="Mumbai 3">Mumbai 3</option>
				</select>
			</div>
-->
			
			  <button type="submit" class="btn btn-primary signup_submit_modal" name="signup_seeker_submit" id="signup_submit_modal">Submit</button>
			</form>
		</div>