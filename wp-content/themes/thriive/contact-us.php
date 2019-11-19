<?php /* Template Name:contact-us */ ?>
<?php get_header(); ?>
<section class="banner contact-us">
	<div class="container">	
			<div class="m-4 divider"></div>
			
			<form data-parsley-validate  class="form-element-section" id="package_details" method="POST">
				<div class="row section mx-auto">
					<div class="col-12 col-sm-7 mx-sm-auto p-0">
						<?php echo $form_msg; ?>
						<div class="form-group">
							<label for="therapy-1">First Name *</label>
						    <input data-parsley-required="true" type="text" data-parsley-required-message="First Name is required." class="form-control" id="txtFirstName" name="txtFirstName">
			  			</div>
				  		<div class="form-group">
							<label for="experience">Last Name *</label>
						    <input data-parsley-required="true" type="text" data-parsley-required-message="Last Name is required." class="form-control" id="txtLastName" name="txtLastName">
				  		</div>
				  		<div class="form-group">
							<label for="charges">Email *</label>
						    <input  data-parsley-required="true" type="text" data-parsley-required-message="Email is required." data-parsley-type="email" data-parsley-type-message="Invalid email id" class="form-control" id="txtEmail" name="txtEmail">
				  		</div>
				  		<div class="form-group">
							<label for="therapy-2">Mobile *</label>
						    <input data-parsley-required="true" type="text" data-parsley-required-message="Mobile is required." class="form-control" id="txtMobile" name="txtMobile">
				  		</div>
				  		<div class="form-group">
							<label for="experience-2">Message *</label>
						    <textarea data-parsley-required="true" type="text" data-parsley-required-message="Message is required." class="form-control" id="txtMessage" name="txtMessage"></textarea>
				  		</div>
				  		<div class="my-event-btn text-center">
							<button type="submit"class="btn btn-primary d-inline" name="btnContactUs">SUBMIT</button>
						</div>
						<p class="mandatory_msg">All fields mandatory!</p>
			  		
					</div>			  		
				</div>	
		</form>
			
	</div>
	<div class="container">
			<h3 class="header-text">We’d Love To Hear From You!</h3>
			<div class="d-flex wrapper">
				<div class="col-12 col-md-6">
					<div class="d-flex mx-auto  user-details">
						<div class="col-5">
							<div class="user-circle-image">
								<img title="Sonia Rao" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/sonia_rao.png" alt="Sonia Rao" />
							</div>
						</div>
						<div class="col-7 user-details-div">
							<h5 class="user_name">Sonia Rao</h5>
							<p class="user_designation">Editor-in-Chief</p>
							<p class="user_email">contenteditor@thriive.in</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="user-details d-flex mx-auto">
						<div class="col-5">
							<div class="user-circle-image">
								<img title="Kaivan Bhavsar" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/kaivan_bhavsar.png" alt="Kaivan Bhavsar"/>
							</div>
						</div>
						<div class="col-7 user-details-div">
							<h5 class="user_name">Kaivan Bhavsar</h5>
							<p class="user_designation">Business Manager</p>
							<p class="user_email">promotions@thriive.in</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="user-details  d-flex mx-auto">
						<div class="col-5">
							<div class="user-circle-image">
								<img title="Manish Jadhav" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/manish_jadhav.png" alt="Manish Jadhav"/>
							</div>
						</div>
						<div class="col-7 col user-details-div">
							<h5 class="user_name">Manish Jadhav</h5>
							<p class="user_info">Product Manager</p>
							<p class="user_email">productmanager@thriive.in</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="user-details col d-flex mx-auto">
						<div class="col-5">
							<div class="user-circle-image">
								<img title="Balaji Golekar" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/balaji_golekar.png" alt="Balaji Golekar"/>
							</div>
						</div>
						<div class="col-7 user-details-div">
							<h5 class="user_name">Balaji Golekar</h5>
							<p class="user_info">Head, Events</p>
							<p class="user_email">events@thriive.in</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="user-details col d-flex mx-auto">
						<div class="col-5">
							<div class="user-circle-image">
								<img title="Mishika Munot" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/mishika_munot.png" alt="Mishika Munot"/>
							</div>
						</div>
						<div class="col-7 user-details-div">
							<h5 class="user_name">Mishika Munot</h5>
							<p class="user_role">Relationship Manager,</p>
							<p class="user_info">Alternative Therapists</p>
							<p class="user_email">accountmanager1@thriive.in</p>
						</div>
					</div>
				</div>
<!--
				<div class="col-12 col-md-6">
				<div class="user-details col d-flex mx-auto">
						<div class="col-5">
							<div class="user-circle-image">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/ProfileImage-THR2144352-150x150.jpg"/>
							</div>
						</div>
						<div class="col-7 user-details-div">
							<h5 class="user_name">Komal Raturi</h5>
							<p class="user_role">Astt. Relationsship Manager,</p>
							<p class="user_info">Alternative Therapists</p>
							<p class="user_email">accountmanager2@thriive.in</p>
						</div>
					</div>
				</div>
-->
<!--
				<div class="col-12 col-md-6">
				<div class="user-details col d-flex mx-auto">
						<div class="col-5">
							<div class="user-circle-image">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/ProfileImage-THR2144352-150x150.jpg"/>
							</div>
						</div>
						<div class="col-7 user-details-div">
							<h5 class="user_name">Kaivan Bhavsar</h5>
							<p class="user_info">Head, Promotions</p>
							<p class="user_email">promotions@thriive.in</p>
						</div>
					</div>
				</div>
-->
				<div class="col-12 col-md-6">
				<div class="user-details col d-flex mx-auto">
						<div class="col-5">
							<div class="user-circle-image">
								<img title="Avanti Jadhav" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/avanti _dharmesh.png" alt="Avanti Jadhav"/>
							</div>
						</div>
						<div class="col-7 user-details-div">
							<h5 class="user_name">Avanti Jadhav</h5>
							<p class="user_info">Account-in-Charge</p>
							<p class="user_email">avanti@thriive.in</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
				<div class="user-details col d-flex mx-auto">
						<div class="col-5">
							<div class="user-circle-image">
								<img title="Pramod Sahu" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/pramod_sahu.png" alt="Pramod Sahu"/>
							</div>
						</div>
						<div class="col-7 user-details-div">
							<h5 class="user_name">Pramod Sahu</h5>
							<p class="user_info">Astt. Accounts-in-Charge</p>
							<p class="user_email">promotions@thriive.in</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
				<div class="user-details col d-flex mx-auto">
						<div class="col-5">
							<div class="user-circle-image">
								<img title="Urvi Dedhia" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/urvi_dedhia.png" alt="Urvi Dedhia"/>
							</div>
						</div>
						<div class="col-7 user-details-div">
							<h5 class="user_name">Urvi Dedhia</h5>
							<p class="user_info">Administrator</p>
							<p class="user_email">admin@thriive.in</p>
						</div>
					</div>
				</div>
			</div>
			<div class="m-4 divider"></div>
	</div>
	<div class="container gmap-continer">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3892.2507947127115!2d77.49234995104601!3d12.697047224233025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae4335e07a77a9%3A0x5eaabb7ba3bc75d3!2sPyramid+Valley+International!5e0!3m2!1sen!2sin!4v1542777135336" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>	
	
	
	
</section>
<?php get_footer(); ?>