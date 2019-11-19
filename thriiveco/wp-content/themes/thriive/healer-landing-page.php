<?php /* Template Name: Healer landing page */ ?>

<?php 
	if (is_user_logged_in()) { 
		$current_user = wp_get_current_user();
		echo $current_user->post_id;
		
		if(isset($_SERVER['HTTP_REFERER']))
		{
			$user_id = $current_user->ID;
			$str = $_SERVER['HTTP_REFERER'];
		    if (strpos($str, 'Facebook') !== false)
		    {
			    $register_page = $_SERVER['REQUEST_URI'];
			    if($register_page == '/therapist-landing-page')
				{
					if(!empty($_POST)) {
						$first_name = $_POST['firstname'];
						$last_name= $_POST['lastname'];
						$email= $_POST['email'];
					} else {
						$first_name = get_userdata($user_id)->first_name;
						$last_name = get_userdata($user_id)->last_name;	
						$email = get_userdata($user_id)->user_email;	
					}
					
					if(in_array("subscriber", $current_user->roles) && empty($current_user->mobile))
					{
						$post_id = wp_insert_post(array (
						  'post_type' => 'therapist',
						  'post_title' => $first_name.' '.$last_name,
						  'post_author' => $user_id,
						  'post_content' => ' ',
						  'post_status' => 'draft'
						));
						update_user_meta($user_id, 'post_id',  $post_id);
						update_user_meta($user_id, 'stage',  1);
						update_user_meta($user_id, 'completed_stages',  array('0','0','0','0'));
						$user = new WP_User($user_id); 
					    $user->remove_role('subscriber');
					    $user->add_role('therapist');
					    $user->add_role('author');
					    $rfa_data = array(
						    'firstname'	=> $first_name,
						    'lastname'	=> $last_name,
						    'email'		=> $email
					    );
					    send_email_to_admin_on_therapist_register($rfa_data);
					}
				}
		    }
		}
		
		wp_redirect('/therapist-registration/');
		exit();
 	} 
?>
<?php get_header(); ?>
<section class="banner-home">
	<div class="container">
		<div class="row text-center section w-70">
			<h1 class="w-100">Register As A Therapist</h1>
			<p>Holistic solutions to physical, mental & emotional issues is what the world needs from therapists like you. <br>Sign up now and widen your reach to a global user base!</p>
		</div>	
		<div class="row text-center section w-70">
			<h2 class="w-100">5 Amazing Benefits</h2>
			<p class="w-100">you get when you become a Thriive Verified Therapist</p>
		</div>
		<div class="row text-center section col-12 col-sm-6 mx-auto list-item-wrapper">
			<div class="col-3 col-sm-2">
				<div class="circle-blue-wrapper">
					<span class="icon-new-user-friendly icon-wrap"></span>
				</div>
			</div>
			<div class="col-9 col-sm-10 list-txt-wrapper"><p>A user-friendly, customizable profile page</p></div>
		</div>
		<div class="row text-center section col-12 col-sm-6 mx-auto list-item-wrapper">
			<div class="col-3 col-sm-2">
				<div class="circle-blue-wrapper">
					<span class="icon-new-zeero-comission icon-wrap"></span>
				</div>
			</div>
			<div class="col-9 col-sm-10 list-txt-wrapper"><p>Zero commissions</p></div>
		</div>
		<div class="row text-center section col-12 col-sm-6 mx-auto list-item-wrapper">
			<div class="col-3 col-sm-2">
				<div class="circle-blue-wrapper">
					<span class="icon-new-pramotion-event icon-wrap"></span>
				</div>
			</div>
			<div class="col-9 col-sm-10 list-txt-wrapper"><p>Promotion of your events on our large SM Platforms & database</p></div>
		</div>
		<div class="row text-center section col-12 col-sm-6 mx-auto list-item-wrapper">
			<div class="col-3 col-sm-2">
				<div class="circle-blue-wrapper">
					<span class="icon-new-visibility icon-wrap"></span>
				</div>
			</div>
			<div class="col-9 col-sm-10 list-txt-wrapper"><p>High visibility on search engines to seekers of alternative solutions</p></div>
		</div>
		<div class="row text-center section col-12 col-sm-6 mx-auto list-item-wrapper">
			<div class="col-3 col-sm-2">
				<div class="circle-blue-wrapper">
					<span class="icon-new-workshops-listing icon-wrap"></span>
				</div>
			</div>
			<div class="col-9 col-sm-10  list-txt-wrapper"><p>Listing of your workshops on hi-profile events platforms</p></div>
		</div>				
	</div>
</section>

<div class="m-1 divider"></div>

<section class="section form-element-wrapper">
	<div class="conatiner">
		<div class="text-center section col-sm-6 col-12 mx-sm-auto">
			<h2 class="w-100">Sign Up With</h2>
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
		<div class="m-1 divider"></div>
		<div class="row section col-sm-4 col-12 mx-auto">
			<form data-parsley-validate  class="form-element-section" action="/therapist-registration/" method="post" id="therapist_email_form">
				<?php wp_nonce_field('signup'); ?>
			  <div class="form-group">
			    <label for="firstname">First Name: *</label>
			    <input data-parsley-required="true" data-parsley-required-message="First Name is required." data-parsley-pattern="/^[a-zA-Z ]*$/" data-parsley-pattern-message="Valid characters: Alphabets and space." type="text" class="form-control" id="firstname" name="firstname">
			  </div>
			  <div class="form-group">
			    <label for="lastname">Last Name *</label>
			    <input data-parsley-required="true" data-parsley-required-message="Last Name is required." data-parsley-pattern="/^[a-zA-Z ]*$/" data-parsley-pattern-message="Valid characters: Alphabets and space." type="text" class="form-control" id="lastname" name="lastname">
			  </div>
			  
			  <div class="form-group">
			    <label for="email">Email *</label>
			    <input data-parsley-type="email" data-parsley-required-message="Email is required."  data-parsley-required="true" type="email" class="form-control" id="email" name="email">
			  </div>
			  
			  <div class="form-group">
			    <label for="pwd">Password *</label>
			    <div class="input-group">
			        <input data-parsley-required="true" type="password" data-parsley-errors-container="#pwd-holder" data-parsley-required-message="password is required."  data-parsley-pattern="/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/" data-parsley-pattern-message="<div>Password must contain at least:</div><ol><li>One character</li><li>One number</li><li>One special character</li><li>Six characters in length</li></ol>" class="form-control" id="pwd" name="password">
			        <span class="input-group-addon togglePassword" style="cursor: pointer;"><i class="fa fa-eye-slash"></i></span>
		      	</div>	
		      	<div id="pwd-holder"></div>		    
			  </div>
			  <div class="form-group">
                  <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITE_KEY ?>" data-callback="recaptchaCallback" >
              </div>
              <input id="reCaptchaField" data-parsley-errors-container="#errorContainer" data-parsley-required="true" value="" type="text" style="display:none;">
                  <span id='errorContainer'></span>
              <br/>
			  <button type="submit" class="btn btn-primary" name="signup_submit" id="signup_submit">Submit</button>
			  	<div class="error-msg">
					<?php echo $signUp_login; ?>
				</div>
			</form>
		</div>
	</div>
</section>
<script src='https://www.google.com/recaptcha/api.js' async defer /></script>
<?php get_footer(); ?>