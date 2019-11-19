<?php /* Template Name: Healer regster page */ ?>

<?php 
	
	if (!is_user_logged_in()) {
		wp_redirect('/login/?error=user_exists');
		exit();
	} else {
		$current_user = wp_get_current_user();
		
		//if($current_user->roles[0] == 'subscriber')
		if(in_array("subscriber", $current_user->roles))
		{
			wp_redirect('/my-account-page/');
			exit();
		}
		
		$address = json_decode($current_user->address);
		$userPost = get_post($current_user->post_id);
		
		//isStageCompleted($current_user->ID);
		
		$countries = $wpdb->get_results("SELECT * FROM countries ORDER BY name ASC");
		//echo count($countries);	
		
		//Edit Therapist
		if(isset($_GET['edit-step']))
		{
			$edit_step = $_GET['edit-step'];
		}
	}
?>
<?php get_header(); ?>

<section class="regsiter-top-section">
	<div class="container">
		<div class="row text-center section w-70">
			<h1 class="w-100">
				<?php
					if(isset($_GET['edit-step']))
					{
						echo "Edit Profile";
					}
					else if(isset($_GET['package']))
					{
						echo "Renew Package";
					}
					else
					{
						echo "Therapist Registration";
					}
				?>
				
				
			</h1>
			<?php if(!isset($_GET['package'])){ ?>
			<div class="col-sm-12 col-12 mx-auto form-list-page">
				<ul class="d-inline-block step-list">
					<li>1</li>
					<li>2</li>
					<li>3</li>
					<li>4</li>
					<?php if(!isset($_GET['edit-step'])) { ?><li>5</li><?php } ?>
				</ul>
			</div>	
			<?php } ?>		
		</div>
	</div>
</section>
<?php
	if(isset($_POST['personal_details_submit']) && !isset($_GET['edit-step']))
	{
		?>
		<script>window.location = "<?php echo get_permalink(); ?>";</script>
		<?php
	}
	else if(isset($_POST['personal_details_submit']) && isset($_GET['edit-step']))
	{
		?>
		<script>window.location = "<?php echo get_permalink() . "?edit-step=2"; ?>";</script>
		<?php
	}
?>
<section class="regsiter-form-section" id="form-step-1">
	<div class="container">
		<div class="row text-center section w-70">
			<h2 class="w-100">Personal Details</h2>
			<p class="w-100 text-justify"> It is recommended you fill in all the fields in order to get a wider reach for your profile page. Your registration will only be confirmed once this form is verified.</p>
		</div>
		<div class="row section col-sm-6 col-12 mx-auto">
			<form data-parsley-validate  class="form-element-section" id="personal_details" name="personal_details" action="<?php if(isset($_GET['edit-step'])){ echo get_permalink(274) . "?edit-step=2"; } ?>" method="post">
			 <?php wp_nonce_field('personal_details'); ?>
			  <div class="form-group">
			    <label for="firstname">First Name*</label>
			    <input data-parsley-pattern="[A-Za-z\s]+" data-parsley-pattern-message="Firstname should contain only alphabets." data-parsley-required-message="First Name is required." type="text" class="form-control" id="firstname" placeholder="Add your first name" name="firstname" value="<?php echo $current_user->first_name; ?>" required>
			  </div>
			  <div class="form-group">
			    <label for="lastname">Last Name*</label>
			    <input data-parsley-pattern="[A-Za-z\s]+" data-parsley-pattern-message="Lastname should contain only alphabets." data-parsley-required-message="Last Name is required." type="text" class="form-control" id="lastname" name="lastname" placeholder="Add your last name"  value="<?php echo $current_user->last_name; ?>" required>
			  </div>
			  
			  <div class="form-group">
			    <label for="email">Email</label>
			    <input data-parsley-type="email" data-parsley-required-message="Email is required." placeholder="Add your email ID"  data-parsley-required="true" type="email" class="form-control" id="email" name="email" value="<?php echo $current_user->user_email; ?>" readonly>
			  </div>
			  
			  <?php if(isset($_GET['edit-step'])){ ?>
			  <div class="form-group">
			    <label for="email">Mobile Number</label>
			    <input type="text" class="form-control international-number" value="<?php echo $current_user->mobile; ?>" readonly>
			  </div>
			  <?php } ?>
			  
			  	<div class="form-group">
				   <label for="gender">Gender*</label>				  
					<div class=" custom-radio">
					  	<input type="radio" id="male" name="gender" value="Male" class="" <?php echo (strtolower($current_user->gender)=='male')?'checked':'unchecked' ?> data-parsley-required-message="Gender is required." data-parsley-errors-container="#gender_holder" required>
					  	<label class="" for="male">Male</label>
					</div>
					  
					<div class="custom-radio">
					 	<input type="radio" id="female" name="gender" value="Female" class="" <?php echo (strtolower($current_user->gender)=='female')?'checked':'unchecked' ?> data-parsley-required-message="Gender is required." required>
					 	<label class="" for="female">Female</label>
					</div>
					<div id="gender_holder"></div>
			  </div>
			  
			  <div class="form-group">
			    <label for="dob">Date Of Birth*</label>
			    <?php
					if(!empty($current_user->dob))
					{
					    $time = strtotime($current_user->dob);
						$dob = date('d/m/Y',$time);
					}
					else
					{
						$dob = "";
					}
			    ?>
			    <input type="text" class="form-control" id="dob" name="dob" placeholder="Select your date of birth"  value="<?php echo $dob; ?>" data-parsley-required-message="Date of Birth is required." required>
			  </div>
			  
			  <div class="form-group">
			    <label for="nationality">Nationality*</label>
			    <input type="text" class="form-control" id="nationality" placeholder="Select your nationality"  name="nationality" value="<?php echo $current_user->nationality;?>" data-parsley-required-message="Nationality is required." required>
			  </div>
			  
			  <div class="form-group">
			    <label for="address">Address*</label>
			    <input type="textarea" placeholder="Address" class="mb-2 form-control"  placeholder="Add your address" id="address" name="address" value="<?php echo get_field('address', $current_user->post_id); ?>" data-parsley-required-message="Address is required." required>
			  </div>
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
			  
			  <div class="form-group">
				  <label for="zipcode" class="d-block">Zipcode*</label>
				  <input type="number" placeholder="Zipcode" class="mb-2 form-control" placeholder="Add your zipcode"  id="zipcode" name="zipcode" value="<?php echo get_field('zipcode', $current_user->post_id); ?>" data-parsley-required-message="Zipcode is required." required>
			  </div>

			  <div class="step1_submit">
				<button type="submit" name="personal_details_submit" class="disable_on_load btn btn-primary" disabled="disabled">Next</button>  
			  </div>			  			  
			</form>
		</div>
	</div>

</section>

<section class="package-selection-section" id="form-step-2">
	<div class="container">
		<?php if(!isset($_GET['edit-step'])){  ?>
		<div class="row text-center section w-70">
			<h2 class="w-100">Package Selection</h2>
			<p class="text-justify">Choose the right package for you! Remember the more premium the package, the better the benefits!  </p>			
		</div>
		<?php }?>
			
			<form data-parsley-validate  class="form-element-section" id="package_details" name="package_details" action="<?php if(isset($_GET['edit-step'])){ echo get_permalink(274) . "?edit-step=3"; } ?>" method="post">
				<?php wp_nonce_field('package_details'); ?>
				
				<div class="row section mb-3 col-sm-6 col-12 mx-auto p-0 <?php if(isset($_GET['edit-step'])){ echo "d-none"; } ?>">
				
					<?php
						$packageArgs = array( 'post_type' => 'packages', 'posts_per_page' => 10, 'orderby'   => 'meta_value', 'order' => 'ASC' );
					    $packages = new WP_Query( $packageArgs );
					    while ( $packages->have_posts() ) : $packages->the_post(); 
					    ?>
						    <div class="form-group select_package" data-package_limit="<?php echo the_field('number_of_therapies'); ?>" data-package_name="<?php echo get_the_title();?>">
								<div class="d-flex package-wrapper">
							 		<div class="col-3 col-sm-2">
							 			<div class="package-wrapper">
							 				<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
								 		</div>
								 	</div>
							 		<div class="col-7 col-sm-8">
							 			<h6><?php the_title(); ?> package</h6>
							 			<div class="package-price">
							 				<span class="package-price">INR 
							 					<?php if(get_the_title() == 'Earth') { ?> 
							 						<del>4977/-</del> <ins>FREE</ins><?php } else {
								 					the_field('package_charges'); ?>/- <?php } ?>
							 				</span>
							 			</div>
							 			<p class="text-highlight mt-1"><?php the_field('short_description'); ?></p>
							 		</div>
							 		<div class="col-2">
									 	<input type="radio" value="<?php echo get_the_ID();?>" name="package" id="<?php echo get_the_ID();?>"
									 		<?php //echo (($userPost->select_package)[0]==get_the_ID()?'checked':'unchecked'); 
										 		
										 		if(empty($userPost->select_package))
										 		{
											 		//echo "checked";
											 		
											 		if(get_field('isdefault') == '1') {
												    	echo 'checked';
											    	}
/*					
											 		if($default_id == get_the_ID()) {
												 		echo "ok";
											 		}
*/
										 		}else
										 		{
											 		if(($userPost->select_package)[0]==get_the_ID())
											 		{
												 		echo "checked";
											 		}
											 		else
											 		{
												 		echo "unchecked";
											 		}
										 		}
										 		
									 		?>
										 />
									 	<label for="<?php echo get_the_ID(); ?>"></label>		
								 	</div>
							 	</div>
							</div>
					    <?php endwhile;?>
					    <?php
						    $totalpackageTherapist = get_field("number_of_therapies",get_post($userPost->select_package[0]));
					    ?>
					<input type="hidden" id="total_therapies" name="total_therapies" value="<?php 
						if(empty($userPost->therapy)) {
							$total_therapies = getDefaultPackageTherapyCount();
							echo $total_therapies;
						} else {
							echo $userPost->therapy;
						}
						?>">
					<a href="<?php echo get_site_url() ?>/package-details/" target="_blank" class=" mx-auto btn btn-primary">KNOW PACKAGE DETAILS</a>
					
				</div>	
				
				<?php if(!isset($_GET['edit-step'])){  ?>
				<div class="m-1 divider"></div>
				<?php } ?>
				<div class="row section col-sm-6 col-12 mx-auto therapy-list">
														
			<?php //echo '<pre>';print_r( $userPost->$varName );echo '</pre>';
				if(empty($userPost->therapy)) {
					getTherapyList();
				} else { ?>
					<p>If the therapy you practice is not listed here, please get in touch with us at <u>accountmanager1@thriive.in</u></p>
					<?php
						//print_r($userPost->therapy);
					$therapy_terms = get_terms(array(
							      'taxonomy' => 'therapy',
							      'hide_empty' => false,
							       ));
					for ($x = 0; $x < $userPost->therapy; $x++) { 
						$varExp = 'therapy_'.$x.'_experience';						
						$varCharge = 'therapy_'.$x.'_charges';
						$varName = 'therapy_'.$x.'_therapy_name'; 
					?>
							<div class="add_therapy_section ">
								<div class="form-group sel">
									<label for="therapy-1" class="d-block">Therapy <?php  echo $x+1;echo ($x == 0)?'*':'' ?></label>
									<select class="form-control select-list-item select-dropdown-list<?php echo ($x == 0)?'':' therapy-select'?>" id="therapy-list_<?php  echo $x+1; ?>" name="t_name_<?php  echo $x+1; ?>" data-parsley-required-message="Therapy is required." data-parsley-errors-container="#select-therapy-error_<?php echo $x+1; ?>" <?php echo ($x == 0)?'required':''?> <?php if(isset($_GET['edit-step']) && !empty(($userPost->$varName)[0])){ echo "disabled"; } ?>>
									<option value="">Select Therapy</option>
									<?php foreach($therapy_terms as $therapy) {
										//echo $therapy->parent;
										if($therapy->parent != 0){
									?>
										<option value="<?php echo $therapy->term_id .'-'. $therapy->name; ?>" <?php echo ((($userPost->$varName)[0]==($therapy->term_id))?'selected':'');?>><?php echo $therapy->name;?></option>
									<?php }
										} ?>
								</select>
								<?php
								    if(isset($_GET['edit-step']) && !empty(($userPost->$varName)[0]))
								    {
									    $rfa_term = get_term( ($userPost->$varName)[0] );
									    ?>
									    <input type="hidden" value="<?php echo $rfa_term->term_id .'-'. $rfa_term->name; ?>" name="t_name_<?php  echo $x+1; ?>" />
									    <?php
								    }
							    ?>
									<div id="select-therapy-error_<?php echo $x+1; ?>"></div>
								</div>
					 	  		<div class="form-group exp">
						 	  		<?php
							 	  		if(!empty($userPost->$varExp))
										{
											$userExp = formatTherapistExperienceDate($userPost->$varExp);
										}
										else
										{
											$userExp = "";
										}
						 	  		?>
									<label for="experience">Experience (Practice since)<?php echo ($x == 0)?'*':''?></label>
								    <input type="text" class="date_picker form-control<?php echo ($x == 0)?'':' therapy-exp'?>" placeholder="Add your experience" id="experience_<?php  echo $x+1; ?>" name="t_experience_<?php  echo $x+1; ?>" value="<?php echo $userExp;?>"  data-parsley-required-message="Experience is required." <?php echo ($x == 0)?'required':''?> <?php if(isset($_GET['edit-step']) && !empty($userExp)){ echo "disabled"; }else{ echo "readonly"; } ?>>
								    <?php
									    if(isset($_GET['edit-step']) && !empty($userExp))
									    {
										    ?>
										    <input type="hidden" value="<?php echo $userExp;?>" name="t_experience_<?php  echo $x+1; ?>" />
										    <?php
									    }
								    ?>
						  		</div>			  		
						  		<div class="form-group">
									<label for="charges">Charges</label>
								    <input type="number" class="form-control" id="charges_<?php  echo $x+1; ?>" placeholder="Add your charges" name="t_charges_<?php  echo $x+1; ?>" value="<?php echo $userPost->$varCharge;?>">
						  		</div>
							</div>
							<br>
			  <?php }
				} ?>
				
									
				</div> 
				<div class="row section col-sm-6 col-12 mx-auto">
					 					  		
			  		<div class="form-group">
			  			<div class="row">
					  		<label for="communication" class="col-12">Communication Mode*</label>
					  		<div class="checkbox-wrapper col-6">
						  		<input type="checkbox" name="communication[]" value="Centre" id="centre" data-parsley-multiple="communication" data-parsley-errors-container="#message-holder" required <?php if(in_array("Centre" , $userPost->communication_mode)){ echo "checked"; } ?>>
						  		<label for="centre">Centre</label>
					  		</div>
					  		
					  		<div class="checkbox-wrapper col-6">
						  		<input type="checkbox" name="communication[]" value="Via Skype" id="skype" data-parsley-multiple="communication" data-parsley-errors-container="#message-holder" required <?php if(in_array("Via Skype" , $userPost->communication_mode)){ echo "checked"; } ?>>
						  		<label for="skype">Via Skype</label>
					  		</div>
					  		
					  		<div class="checkbox-wrapper col-6">
						  		<input type="checkbox" value="Long Distance" name="communication[]" id="long-distance" data-parsley-multiple="communication" data-parsley-errors-container="#message-holder" required <?php if(in_array("Long Distance" , $userPost->communication_mode)){ echo "checked"; } ?>>
						  		<label for="long-distance">Long Distance</label>
					  		</div>
					  		
					  		<div class="checkbox-wrapper col-6">
						  		<input type="checkbox" value="Overphone" name="communication[]" id="overphone" data-parsley-multiple="communication" data-parsley-errors-container="#message-holder" required <?php if(in_array("Overphone" , $userPost->communication_mode)){ echo "checked"; } ?>>
						  		<label for="overphone">Overphone</label>
					  		</div>
					  		
					  		<div class="checkbox-wrapper col-6">
						  		<input type="checkbox" value="Home Visit" name="communication[]" id="at-home" data-parsley-multiple="communication" data-parsley-errors-container="#message-holder" required <?php if(in_array("Home Visit" , $userPost->communication_mode)){ echo "checked"; } ?>>
						  		<label for="at-home">Home Visit</label>
					  		</div>
					  		
					  		<div class="checkbox-wrapper col-6">
						  		<input type="checkbox" value="Online" name="communication[]" id="online" <?php if(in_array("Online" , $userPost->communication_mode)){ echo "checked"; } ?>>
						  		<label for="online">Online</label>
					  		</div>
					  		<div id="message-holder"></div>
			  			</div>
			  		</div>
				</div>
			  <button type="submit" class="disable_on_load btn btn-primary" name="submit_package_details" disabled="disabled">Next</button>
			</form>
		
	</div>

</section>

<section class="about-yourself" id="form-step-3">
	<div class="container">
		<div class="row text-center section w-70">
			<h2 class="w-100">About Yourself</h2>
			<p class="text-justify">Remember the more details you fill in, the higher your chances of popping up in SEO (Search Engine Optimization) searches. We want you to put your best foot forward.</p>
		</div>
		<div class="row section col-sm-6 col-12 mx-auto">
				<form data-parsley-validate  class="form-element-section" id="about_youself_form" name="about_youself_form" action="<?php if(isset($_GET['edit-step'])){ echo get_permalink(274) . "?edit-step=4"; } ?>" method="post">
					<?php wp_nonce_field('about_yourself'); ?>
					<div class="form-group">
<!-- 						<h2 class="text-center w-100">Describe Your Work*</h2> -->
<!-- 						<p class="text-center">This section will appear on your profile page. Make your first impression an impactful one. <br>Begin your profile with your qualifications, achievements & passions. <br>Keep it simple!</p> -->
						<label for="Website">About Yourself*</label>
						<p class="sub-text">This section will appear on your profile page. Make your first impression an impactful one. Begin your profile with your qualifications, achievements & passions. Keep it simple!</p>
						<textarea data-parsley-required="true" data-parsley-required-message="About yourself is required." placeholder="Describe about yourself" class="form-control" id="" rows="3" name="about_you" ><?php echo $userPost->post_content;?></textarea>
					</div>
					
					<div class="form-group">
			    		<label for="Website">Title*</label>
						<input  type="text" data-parsley-required="true" data-parsley-required-message="Title is required." placeholder="Add Title (eg. Yoga Master)" class="form-control" id="therapistTitle" name="therapistTitle" value="<?php echo $userPost->therapist_title;?>">
					</div>
			  
				  <div class="form-group">
				    <label for="language">Language</label>
				    <input type="text" class="form-control" id="language" placeholder="Specify your language such as English,Marathi,Hindi.." name="language" value="<?php echo getTherapistLanguage($current_user->post_id); ?>">
				  </div>
					
					<div class="form-group">
			    		<label for="Website">Website</label>
						<input  type="text"  class="form-control" id="Website" name="website" placeholder="Eg: https://www.thriive.in" value="<?php echo $userPost->website_url;?>">
					</div>
					
					<div class="form-group">
			    		<label for="facebook">Facebook</label>
						<input  type="text"  class="form-control" id="facebook" name="facebook" placeholder="Eg: https://www.example.com" value="<?php echo $userPost->facebook_url;?>">
					</div>
					
					<div class="form-group">
			    		<label for="twitter">Twitter</label>
						<input  type="text"  class="form-control" id="twitter" placeholder="Eg: https://www.example.com" name="twitter" value="<?php echo $userPost->twitter_url;?>">
					</div>
					
<!--
					<div class="form-group">
			    		<label for="experience-profile">Experience*</label>
						<input data-parsley-required="true"  data-parsley-required-message="Experience is required."  type="number"  class="form-control" id="experience-profile" name="experience_profile" value="<?php echo $userPost->experience_profile;?>">
					</div>
-->
					
					<div class="form-group">
			    		<label for="instagram">Instagram</label>
						<input  type="text"  class="form-control" id="instagram" placeholder="Eg: https://www.example.com" name="instagram" value="<?php echo $userPost->instagram_url;?>">
					</div>
					
					<div class="form-group">
			    		<label for="linkedIn">LinkedIn</label>
						<input  type="text"  class="form-control" id="linkedIn" placeholder="Eg: https://www.example.com" name="linkedIn" value="<?php echo $userPost->linkedin_url;?>">
					</div>
					
					<div class="form-group">
			    		<label for="skype-call">Skype Call</label>
						<input  type="text"  class="form-control" id="skype-call" placeholder="1234567890" name="skype_call" value="<?php echo $userPost->skype_call;?>">
					</div>
					
					<div class="form-group">
			    		<label for="youtube">Youtube</label>
						<input  type="text"  class="form-control" id="youtube" placeholder="Eg: https://www.youtube.com" name="youtube" value="<?php echo $userPost->youtube;?>">
					</div>
					<button type="submit" class="disable_on_load btn btn-primary" name="submit_about_yourself" disabled="disabled">Next</button>
				</form>				
			</div>
	</div>
	
</section>

<section class="verification_details" id="form-step-4">
	<div class="container">
		<div class="row text-center section w-70">
			<h2 class="w-100">Verification Details</h2>
			<p class="text-justify">Thriive is the only website in India that guarantees a listing of VERIFIED therapists. To ensure the validity of the process, referrals are essential. All names, and details of illnesses or issues can be kept completely confidential. Please assist us is creating a directory the world can rely upon.</p>
		</div>
		
		<div class="row section col-sm-6 col-12 mx-auto">
			<form data-parsley-validate  class="form-element-section" id="verification_details" name="verification_details" action="<?php if(isset($_GET['edit-step'])){ echo get_permalink(339); } ?>" method="post" enctype="multipart/form-data">
				<?php wp_nonce_field('verification_details'); ?>
				<div class="form-group">
			    	<label for="reference-name-1" class="<?php if(isset($_GET['edit-step'])){ echo "d-none"; } ?>">1st Reference Name</label>
					<input type="<?php if(isset($_GET['edit-step'])){ echo "hidden"; }else{ echo "text"; } ?>" placeholder="Add your 1st reference name" class="form-control" id="reference-name-1" name="reference_name_1" value="<?php echo $userPost->first_reference_name;?>">
				</div>
				
				<div class="form-group">
				 	<label for="ref-email-1" class="<?php if(isset($_GET['edit-step'])){ echo "d-none"; } ?>">Email*</label>
				 	<input data-parsley-type="email" data-parsley-required-message="Email is required."  data-parsley-required="true" type="<?php if(isset($_GET['edit-step'])){ echo "hidden"; }else{ echo "email"; } ?>" class="form-control" id="ref-email-1" name="ref_email_1" placeholder="Add your 1st reference email ID" value="<?php echo $userPost->first_reference_email;?>">
			  </div>
			  
			  <div class="form-group">
			    	<label for="reference-name-2" class="<?php if(isset($_GET['edit-step'])){ echo "d-none"; } ?>">2nd Reference Name</label>
					<input type="<?php if(isset($_GET['edit-step'])){ echo "hidden"; }else{ echo "text"; } ?>" placeholder="Add your 2nd reference name" class="form-control" id="reference-name-2" name="reference_name_2" value="<?php echo $userPost->second_reference_name;?>">
				</div>
				
				<div class="form-group">
				 	<label for="ref-email-2" class="<?php if(isset($_GET['edit-step'])){ echo "d-none"; } ?>">Email*</label>
				 	<input data-parsley-type="email" data-parsley-required-message="Email is required."  data-parsley-required="true" type="<?php if(isset($_GET['edit-step'])){ echo "hidden"; }else{ echo "email"; } ?>" class="form-control" id="ref-email-2" name="ref_email_2" placeholder="Add your 2nd reference email ID" value="<?php echo $userPost->second_reference_email;?>">
			  </div>
			  
			  <div class="form-group">
			    	<label for="reference-name-3" class="<?php if(isset($_GET['edit-step'])){ echo "d-none"; } ?>">3rd Reference Name</label>
					<input type="<?php if(isset($_GET['edit-step'])){ echo "hidden"; }else{ echo "text"; } ?>" placeholder="Add your 3rd reference name" class="form-control" id="reference-name-3" name="reference_name_3" value="<?php echo $userPost->third_reference_name;?>">
				</div>
				
				<div class="form-group">
				 	<label for="ref-email-3" class="<?php if(isset($_GET['edit-step'])){ echo "d-none"; } ?>">Email*</label>
				 	<input data-parsley-type="email" data-parsley-required-message="Email is required."  data-parsley-required="true" type="<?php if(isset($_GET['edit-step'])){ echo "hidden"; }else{ echo "email"; } ?>" class="form-control" id="ref-email-3" name="ref_email_3" placeholder="Add your 3rd reference email ID" value="<?php echo $userPost->third_reference_email;?>">
			  </div>
			  
<!--
			  <div class="form-group">
                    <label for="gstin_number" class="<?php if(isset($_GET['edit-step'])){ echo "d-none"; } ?>">GSTIN/UIN Number</label>
                    <input type="<?php if(isset($_GET['edit-step'])){ echo "hidden"; }else{ echo "text"; } ?>" placeholder="Enter GSTIN/UIN Number" class="form-control" id="gstin_number" name="gstin_number" value="<?php echo $userPost->gstin_number; ?>">
                </div>
-->
			  
			  <div class="form-group <?php if(isset($_GET['edit-step'])){ echo "d-none"; } ?>">
<!--
				  <label for="ref-email-3" class="<?php if(isset($_GET['edit-step'])){ echo "d-none"; } ?>">Upload Identity Card*</label>
				  <span class="d-block label_img_msg">(Identity card should be Pan Card, Adhaar Card, TIN, Passport)<br>(*only PDF/JPG/PNG files allowed ) </span>
-->
<!--
				 <?php
					 $communication = get_field("select_identity_proof",$current_user->post_id);
					 //print_r($communication);
				 ?>
				<div class="custom-radio">
				  	<input type="radio" data-parsley-required="true" data-parsley-required-message="Identity card is required." data-parsley-errors-container=".pwd-holder" id="pancard" name="identity_option" value="Pan_Card" class="" <?php if($communication == "Pan Card" || $communication == "Pan_Card"){ echo "checked"; } ?>>
				  	<label class="" for="pancard">Pan Card</label>
				</div>
				  
				<div class=" custom-radio">
				 	<input type="radio" data-parsley-required="true" data-parsley-required-message="Identity card is required." data-parsley-errors-container=".pwd-holder" id="adhaarcard" name="identity_option" value="Adhaar" class="" <?php if($communication == "Adhaar"){ echo "checked"; } ?>>
				 	<label class="" for="adhaarcard">Adhaar Card</label>
				</div>
				
				<div class=" custom-radio">
				 	<input type="radio" data-parsley-required="true" data-parsley-required-message="Identity card is required." data-parsley-errors-container=".pwd-holder" id="tin" name="identity_option" value="TIN" class="" <?php if($communication == "TIN"){ echo "checked"; } ?>>
				 	<label class="" for="tin">TIN</label>
				</div>
				
				<div class=" custom-radio">
				 	<input type="radio" data-parsley-required="true" data-parsley-required-message="Identity card is required." data-parsley-errors-container=".pwd-holder" id="passport" name="identity_option" value="Passport" class="" <?php if($communication == "Passport"){ echo "checked"; } ?>>
				 	<label class="" for="passport">Passport</label>
				</div> 				
		      	<div class="pwd-holder"></div>
-->
			  </div>
			  
			  <div class="form-group flex-wrap <?php if(isset($_GET['edit-step'])){ echo "d-none"; }else { echo "d-flex"; } ?>">
				 <div class="col-8 p-0">
				  <label for="ref-email-3" class="<?php if(isset($_GET['edit-step'])){ echo "d-none"; } ?>">Upload Identity Card*</label>
				  <span class="d-block label_img_msg">(Identity card should be Pan Card, Adhaar Card, TIN, Passport - *only PDF/JPG/PNG files allowed ) </span>
<!-- 					  <input type="text" class="form-control" id="pan-number" data-parsley-required-message="Number is required." data-parsley-type="alphanum" data-parsley-required="true" placeholder="Enter Number" name="identity_doc_number" value="<?php echo $userPost->identity_number;?>"> -->
					  <br><div class="imagePreview" style="<?php if(!empty($userPost->select_identity_image)){echo 'display: block;'; };?>">
						  <?php 
							  $identity_pic = wp_get_attachment_image( $userPost->select_identity_image, array(120,120), '', array( "class" => "" ) );
							  //echo $identity_pic;
							  $imgId = get_post_meta($current_user->post_id,'select_identity_image',true);

							  if(get_post_mime_type($imgId) == 'application/pdf')
							  {
								?>
									<img src="<?php echo get_template_directory_uri(); ?>/assets/images/pdf_thumbnail.png" class="pdf_certificate" style="max-width:200px;max-height:200px;" alt="">
								<?php
							  }
							  else
							  {
							  	?>
								  	<?php
									echo wp_get_attachment_image( $userPost->select_identity_image, array(120,120), '', array( "class" => "" ));
									?>
								<?php
							  }
						  ?>
					  </div>
				  </div>
				  <div class="col-12 pl-0" id="identity_image_verify"></div>			  				  				

				  <!-- <div class="col-12 p-0 mt-2 single_upload fileupload">
				        <div class="row fileupload-buttonbar">
				            <div class="col-lg-7">
				                <span class="fileinput-button">
				                    <i class="glyphicon glyphicon-plus"></i>
				                    <span class="btn btn-upload">Select File</span>
				                    <input type="file" id="pancard-upload" data-url="<?php echo get_template_directory_uri(); ?>/lib/file-upload/server/php/" data-name="select_identity_image" name="files" accept="image/x-png,image/jpeg" <?php if(!$identity_pic){ echo 'data-parsley-required-message="Identity Image is required." data-parsley-errors-container="#identity_image_verify" required'; } ?>>
				                </span>
				                <span class="fileupload-process"></span>
				            </div>
				            <div class="col-lg-5 fileupload-progress fade">
				                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
				                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
				                </div>
				                <div class="progress-extended">&nbsp;</div>
				            </div>
				        </div>
				        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
				    </div> -->
				    <div class="col-12 p-0 mt-2">
						<!-- The fileinput-button span is used to style the file input field as button -->
					    <span class="fileinput-button">
					        <i class="glyphicon glyphicon-plus"></i>
					        <span class="btn btn-upload">Select Files</span>
					        <!-- The file input field used as target for the file upload widget -->
					        <input type="file" id="pancard-upload" data-url="<?php echo get_template_directory_uri(); ?>/lib/file-upload/server/php/" data-name="select_identity_image" name="files" accept="image/x-png,image/jpeg,application/pdf" <?php if(!$identity_pic){ echo 'data-parsley-required-message="Identity Image is required." data-parsley-errors-container="#identity_image_verify" required'; } ?>>
					    </span>
					    <!-- The global progress bar -->
					    <div id="progress" class="progress" style='display:none;'>
					        <div class="progress-bar progress-bar-success"></div>
					    </div>
					</div>
			  </div>
			  
			  <div class="form-group d-flex flex-wrap">
				  <div class="col-8 p-0">
					  <label class="" for="profile-picture">Profile Picture*</label>
					  <span class="d-block label_img_msg">(*only JPG/PNG files allowed ) </span>
					  <div class="imagePreview" style="<?php if(!empty($userPost->profile_picture)){echo 'display: block;'; };?>">
						  	<?php 
								$prof_pic = wp_get_attachment_image( $userPost->profile_picture, array(120,120), '', array( "class" => "") );
								echo $prof_pic;					 
							?>
					  </div>
					  <div id="single_auto_files" class="files_preview"></div>
				  </div>
				  <div class="col-12 pl-0" id="profile_pic_verify"></div>	
				  
				  <!-- <div class="col-12 p-0 mt-2 single_upload fileupload">
				        <div class="row fileupload-buttonbar">
				            <div class="col-lg-7">
				                <span class="fileinput-button">
				                    <i class="glyphicon glyphicon-plus"></i>
				                    <span class="btn btn-upload">Select File</span>
				                    <input type="file" data-url="<?php echo get_template_directory_uri(); ?>/lib/file-upload/server/php/" data-name="profile_picture" name="files" <?php if(!$prof_pic){ echo 'data-parsley-required-message="Profile Picture is required" data-parsley-errors-container="#profile_pic_verify" required'; } ?> accept="image/x-png,image/jpeg">
				                </span>
				                <span class="fileupload-process"></span>
				            </div>
				            <div class="col-lg-5 fileupload-progress fade">
				                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
				                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
				                </div>
				                <div class="progress-extended">&nbsp;</div>
				            </div>
				        </div>
				        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
				    </div> -->

				    <div class="col-12 p-0 mt-2">
						<!-- The fileinput-button span is used to style the file input field as button -->
					    <span class="fileinput-button">
					        <i class="glyphicon glyphicon-plus"></i>
					        <span class="btn btn-upload">Select Files</span>
					        <!-- The file input field used as target for the file upload widget -->
					        <input id="profile_pic" type="file" name="files" data-name="profile_picture" data-url="<?php echo get_template_directory_uri(); ?>/lib/file-upload/server/php/" <?php if(!$prof_pic){ echo 'data-parsley-required-message="Profile Picture is required" data-parsley-errors-container="#profile_pic_verify" required'; } ?> accept="image/x-png,image/jpeg">
					    </span>
					    <!-- The global progress bar -->
					    <div id="progress" class="progress" style='display:none;'>
					        <div class="progress-bar progress-bar-success"></div>
					    </div>
					</div>

			  </div>
			  
			  
<!--
			  <div class="form-group flex-wrap <?php if(isset($_GET['edit-step'])){ echo "d-none"; } else { echo "d-flex"; } ?>">
				  <div class="col-8 p-0">
					  <label class="" for="profile-picture">Address Proof*</label>
					  <span class="d-block label_img_msg">(*only PDF/JPG/PNG files allowed ) </span>
					  <div class="imagePreview" style="<?php if(!empty($userPost->address_proof)){echo 'display: block;'; };?>">
						  	<?php 
							  	$addr_proof = wp_get_attachment_image( $userPost->address_proof, array(120,120), '', array( "class" => "" ) );
							  	echo $addr_proof;						 
							?>
					  </div>
				  </div>
				  <div class="col-4 form-upload-wrapper text-center">
					  <a href="" class="btn btn-upload">UPLOAD</a>
					  <input type="file" id="address-upload" name="address_picture" class="fileupload-input" <?php if(!$addr_proof){ echo 'data-parsley-required-message="Address Proof is required." data-parsley-errors-container="#address_verify" required'; } ?> accept="image/x-png,image/jpeg,application/pdf">
					  <span class="text-show d-block"></span>
				  </div>
				  <div class="col-12 pl-0" id="address_verify"></div>	
			  </div>
-->
			
			  
		  
			  <div class="form-group d-flex flex-wrap">
				  	<div class="col-12 form-upload-wrapper text-center">
					  <div class="row">
						  <div class="col-8 text-left">
							  <label class="" for="profile-picture">Certificates</label>
							  <span class="d-block label_img_msg">( *Multiple certificates can be added ) </span>
						  </div>
						  <div class="col-12 pl-0" id="certificate_verify"></div>
					  </div>
				  	</div>
				  	<div class="col-12 p-0">
					  <div class="imagePreview" style="<?php if(!empty($userPost->certificates)){echo 'display: inline-block;'; };?>">
					  	   <i class="fa fa-spinner"></i>
						   <?php 
							   //echo "<pre>";print_r($userPost->certificates);echo"</pre>";
							   for ($x = 0; $x < $userPost->certificates; $x++) { 
									$imageIdKey = 'certificates_'.$x.'_certificate';
									$imgId = get_post_meta($current_user->post_id,$imageIdKey,true);
								    
									if(get_post_mime_type($imgId) == 'application/pdf')
									{
										?>
										<div class="preview_wrap">
											<span class="close" data-id="<?php echo $imgId; ?>" data-row_id="<?php echo $x+1; ?>">x</span>
											<img src="<?php echo get_template_directory_uri(); ?>/assets/images/pdf_thumbnail.png" class="pdf_certificate" style="max-width:200px;max-height:200px;" alt="">
										</div>
										<?php
									}
									else
									{
										?>
										<div class="preview_wrap">
											<span class="close" data-id="<?php echo $imgId; ?>" data-row_id="<?php echo $x+1; ?>">x</span>
											<?php
											echo wp_get_attachment_image( $userPost->$imageIdKey, array(120,120), '', array( "class" => "") );
											?>
										</div>
										<?php
									}
							   }
							?>
					  </div>
					  <div id="multiple_auto_files" class="files"></div>
				  	</div>
				  	
					<!-- <div class="col-12 p-0 mt-2 fileupload">
				        <div class="row fileupload-buttonbar">
				            <div class="col-lg-7">
				                <span class="fileinput-button">
				                    <i class="glyphicon glyphicon-plus"></i>
				                    <span class="btn btn-upload">Add Files</span>
				                    <input type="file" data-url="<?php echo get_template_directory_uri(); ?>/lib/file-upload/server/php/" data-name="certificate" name="files" accept="image/x-png,image/jpeg,application/pdf" multiple>
				                </span>
				                <span class="fileupload-process"></span>
				            </div>
				            <div class="col-lg-5 fileupload-progress fade">
				                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
				                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
				                </div>
				                <div class="progress-extended">&nbsp;</div>
				            </div>
				        </div>
				        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
				    </div> -->
				
					<div class="col-12 p-0 mt-2">
						<!-- The fileinput-button span is used to style the file input field as button -->
					    <span class="fileinput-button">
					        <i class="glyphicon glyphicon-plus"></i>
					        <span class="btn btn-upload">Select Files</span>
					        <!-- The file input field used as target for the file upload widget -->
					        <input id="certificate" type="file" data-url="<?php echo get_template_directory_uri(); ?>/lib/file-upload/server/php/" data-name="certificate" name="files" accept="image/x-png,image/jpeg,application/pdf" multiple>
					    </span>
					    <!-- The global progress bar -->
					    <div id="progress" class="progress" style='display:none;'>
					        <div class="progress-bar progress-bar-success"></div>
					    </div>
					</div>




			  </div>
			  <?php if(!isset($_GET['edit-step'])){ ?>
			  <p class="bold">Please make sure all your data has been filled in correctly. Once submitted, data cannot be changed until Thriive Admin verifies your account.</p>
			  <?php } ?>
			  <button id="btn_verification_submit" type="submit" class="disable_on_load btn btn-primary" name="submit_verification_details" disabled="disabled"><?php echo (!isset($_GET['edit-step'])) ? 'Submit' : 'Save'; ?></button>
			</form>
		</div>		
	</div>
</section>

<section class="package-payment-section pb-5" id="form-step-5">
		
		<div class="row text-center section w-70">
			<?php if(!isset($_GET['package'])){ ?><h2 class="w-100">Package & Payment</h2><?php } ?>
			<?php
				//$current_user = wp_get_current_user();
				$get_package = get_field("select_package",$current_user->post_id);
				$packageCharges = get_field("package_charges",$get_package[0]->ID);
			?>
			<?php if(!isset($_GET['package'])){ ?>
			<p class="text-justify">Congratulations! Your forms have been verified & accepted. Please <?php if($packageCharges > 0){ echo "make the payment immediately to"; } ?> activate your profile page and get the benefits of your package. </p>
			<?php } ?>
		</div>
		
		<form data-parsley-validate  class="form-element-section"  action="<?php if($packageCharges > 0){ echo PAYU_BASE_URL; }else{ echo PAYU_RETURN_URL; } ?>" method="post">
		<div class="row section mb-3 col-sm-6 col-12 mx-auto p-0">
			<div class="form-group">
			<?php
				$packageId;
				if(is_user_logged_in()){	
					$packageId = get_post_meta(wp_get_current_user()->post_id,'select_package')[0][0];
					$package_post = get_post($packageId);
						?>
					   	<div class="form-group">
							<div class="d-flex package-wrapper">
								<div class="col-3 col-sm-2">
									<div class="package-wrapper">
										<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
									</div>
								</div>
							<div class="col-9 col-sm-10">
								<h6><?php echo $package_post->post_title; ?> package </h6>
							<div class="package-price">
								<span class="package-discoun-price1"><?php if($packageCharges > 0){ echo "INR " . $packageCharges . "/-"; } ?> </span><span class="text-highlight"> <?php if($packageCharges <= 0){ echo "FREE"; } ?></span>
								</div>
									<p class="text-highlight mt-1"><?php the_field('short_description',$packageId); ?></p>
								</div>
							</div>
						</div>
			</div>
		</div>

		<div class="row section mb-3 col-sm-6 col-12 mx-auto p-0">
				<a href="/package-details/" target="_blank" class=" mx-auto btn btn-primary">KNOW MORE</a>
		</div>
			<?php
				if($packageCharges > 0)
				{
					?>
					<div class="row section text-left col-sm-6 col-12 mx-auto">
						<h6 class="w-100">Payment Details:</h6>
						<div class="final-payment">INR <?php the_field('package_charges',$packageId); ?>/-</div>
					</div>
					<?php 
				}
			}
		?>
		
		<div class="row section text-left col-sm-6 col-12 mx-auto">
		  	<div class="form-group">
			    <label for="firstname">User Details:
			     </label> 
			     <br><?php echo($current_user->first_name.' '.$current_user->last_name.'<br>'.$current_user->user_email.'<br>'.$current_user->mobile);?> 			  </div>
		</div>
		<div class="row section text-left col-sm-6 col-12 mx-auto">
			  	<div class="form-group">
			    <label for="address">Address</label><br>
			    <?php echo getTherapistLocation($current_user->post_id); ?>
			    <?php //echo($address->addressline1.', '.$address->addressline2.'<br>'.$address->street.', '.$address->city.' - '.$address->zipcode.', <br>'.$address->country.', '.$address->state);?>
			  </div>
		</div>
		<div class="row section text-left col-sm-6 col-12 mx-auto">
			<div class="checkbox-wrapper col-12 mt-3">
				<input type="checkbox"  value="" id="agreement" data-parsley-required-message="Kindly accept the agreement to proceed further." data-parsley-required="true">
				<label for="agreement">I have accepted the  
									<a href="<?php echo get_template_directory_uri(); ?>/assets/pdf/agreement.pdf" target="_blank" style="text-decoration:underline;">agreement</a>.
								</label>
			</div>
		</div>	
		<?php
			$hash_string = '';
			$posted = array();
			$posted['key'] = MERCHANT_KEY;
			$posted['txnid'] = substr(hash('sha256', mt_rand() . microtime()), 0, 20); 
			$posted['amount'] = get_field('package_charges',$packageId);
			$posted['firstname'] = $current_user->first_name; 
			$posted['email'] = $current_user->user_email; 
			$posted['phone'] = $current_user->mobile; 
			$posted['productinfo'] = $package_post->post_title;
			if(get_post_status( $current_user->post_id)=='publish' && $_GET['package'] == "renew")
			{
				$posted['udf1'] = "renew_package";
			}
			else
			{
				$posted['udf1'] = "purchase_package";
			}
			$posted['udf2'] = $packageId;
			$hash = '';
			$hashVarsSeq = explode('|', HASH_SEQUENCE);
			foreach($hashVarsSeq as $hash_var) {
		    	$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
				$hash_string .= '|';
			}
			$hash_string .= SALT;
			$hash = strtolower(hash('sha512', $hash_string));
		?> 
		<div class="row section text-left col-sm-6 col-12 mx-auto">
			<div class="form-group">
				 <input type="hidden" name="key" value="<?php echo MERCHANT_KEY ?>" />
				 <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
				 <input type="hidden" name="txnid" value="<?php echo (empty($posted['txnid'])) ? '' : $posted['txnid']  ?>" /> 
				 <input type="hidden" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" />
				 <input type="hidden" name="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" />
				 <input type="hidden" name="email"  value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" />
				 <input type="hidden" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" />
				 <input type="hidden" name="productinfo" value="<?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?>"/>
				 <input type="hidden" name="surl" value="<?php echo PAYU_RETURN_URL;?>" />   
				 <input type="hidden" name="furl" value="<?php echo PAYU_RETURN_URL;?>" />
				 <?php
					if(get_post_status( $current_user->post_id)=='publish' && $_GET['package'] == "renew")
					{
						?> <input type="hidden" name="udf1" value="renew_package" /> <?php
					}
					else
					{
						?> <input type="hidden" name="udf1" value="purchase_package" /> <?php
					}
				 ?>
				<input type="hidden" name="udf2" value="<?php echo $packageId; ?>" />
			</div>
		</div>	
		<button type="submit" class="disable_on_load btn btn-primary" name="submit_payment_url" disabled="disabled"><?php if($packageCharges > 0){ echo "Pay Now"; }else{ echo "Submit"; } ?></button>

		</form>
</section>

<div class="modal fade" id="mobile_verfication_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal body -->
        <div class="modal-body">
	        <div class="error-msg form-error" id="mobileExist"></div>
         <form data-parsley-validate class="form-element-section"  id="form_send_otp">
	         <div class="row section col-sm-12 col-12 mx-auto p-0">
<!-- 		        <a href="<?php echo wp_logout_url( '/login/' ); ?>">&times;</a> -->
<!-- 		        <a href="" class="otp-form-close close" data-dismiss="modal">&times;</a> -->
		        <div class="form-group col-12">
					<label for="mobile-number">Enter Mobile Number</label>
					<input data-parsley-required="true" type="tel" data-parsley-required-message="Mobile is required." class="form-control international-number" id="mobile-number" value="<?php if($current_user->mobile) { '+' . $current_user->countryCode . $current_user->mobile; } ?>">
			  	</div>
			  	
			  	<button type="submit" class="btn d-inline btn-primary" id="send_otp">SEND OTP</button>
	         </div>
         </form>                  
         <form data-parsley-validate  class="form-element-section" id="mobile_verification">
	         <div class="row section col-sm-12 col-12 mx-auto p-0 d-none" id="div_verify_otp">
			  	
			  	<div class="form-group col-12 ">
				 	<label for="mobile-otp">Enter OTP</label>
				 	<input data-parsley-required="true" type="text" data-parsley-required-message="OTP is required." data-parsley-maxwords="4" class="form-control" id="mobile-otp" id="mobile-otp">
				 	<div class="loading-msg">Loading...</div>
				 	<div class="otp-error"></div>
			  	</div>
			  	<button type="button" class="btn d-inline btn-primary" id="re_send_otp">RESEND OTP</button>
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
		        <div class="form-group col-12 text-center">
			       <label> THANK YOU</label>
				   <p>Your details have been submitted successfully.</p>

				   <p>Once your forms have been verified & accepted, you will receive the Payment/Agreement link on your register email ID and mobile number</p>
			        
<!-- 				 	<label >Your account has been created successfully. <br>You will be informed via email/SMS once the account has been verified by Thriive Account Manager.</label> -->
					</div><a href="<?php echo  wp_logout_url('/'); ?>" class=" mx-auto btn btn-primary">  &nbsp;&nbsp;&nbsp; OK  &nbsp;&nbsp;&nbsp;  </a>
	         </div>	          
         </form>                  
        </div>
      </div>
    </div>
  </div>

<!-- The template to display files available for upload -->
<!-- <script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade show">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            {% if (window.innerWidth > 480 || !o.options.loadImageFileTypes.test(file.type)) { %}
                <p class="name">{%=file.name%}</p>
            {% } %}
            <div class="progress">
	            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="width:0%;"></div>
	        </div>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start mb-1" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Upload</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn_upload_cancel btn secondary-btn cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script> -->
<!-- The template to display files available for download -->
<!-- <script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade show">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            {% if (window.innerWidth > 480 || !file.thumbnailUrl) { %}
                <p class="name">
                    {% if (file.url) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                    {% } else { %}
                        <span>{%=file.name%}</span>
                    {% } %}
                </p>
            {% } %}
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn_upload_cancel btn secondary-btn cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Close</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script> -->
<?php 
	if(is_user_logged_in()){
		if(($current_user->is_mobile_verify)==0){
			echo '<script type="text/javascript">$("#mobile_verfication_modal").modal();</script>';
		}	
	}
?>  
<?php get_footer(); ?>
<?php 
	if(get_post_status( $current_user->post_id )=='draft'){
		echo '<script type="text/javascript">window.onload = function(e){setCurrentStage('.$current_user->stage.');}</script>';		
	} else if(get_post_status( $current_user->post_id )=='pending'){
		echo '<script type="text/javascript">window.onload = function(e){setCurrentStage('.$current_user->stage.');}</script>';
		echo '<script type="text/javascript">$("#account_in_review_modal").modal();</script>';
	} else if(get_post_status( $current_user->post_id )=='pending-payments') {
		echo '<script type="text/javascript">window.onload = function(e){setCurrentStage('.$current_user->stage.');}</script>';
	}else if(get_post_status( $current_user->post_id )=='publish' && $_GET['package'] == "renew") {
		if($current_user->stage > 4)
		{
			$stage = 5;
		}
		else
		{
			$stage = $current_user->stage;
		}
		echo '<script type="text/javascript">window.onload = function(e){setCurrentStage('.$stage.');}</script>';
	}else if(get_post_status( $current_user->post_id )=='publish' && $edit_step != "") {
		echo '<script type="text/javascript">window.onload = function(e){setCurrentStage('.$edit_step.');}</script>';
	}else if(get_post_status( $current_user->post_id )=='publish') {
		echo '<script type="text/javascript">window.onload = function(e){setCurrentStage(5);}</script>';
	}
?>