<?php /* Template Name: Login page */ ?>
<?php 
	if (is_user_logged_in()) 
	{ 
		$current_user = wp_get_current_user();
		//if user's is Therapist then redirect to therapist dashboard 
		if($current_user->roles[0] == 'therapist')
		{
			wp_redirect('/therapist-account-dashboard/');
		}
		else
		{
			wp_redirect('/my-account-page/');
		}
		exit();
	}
?>
<?php get_header(); ?> 
<section class="section form-element-wrapper">
	<div class="conatiner">
		
		<?php 
			if($_REQUEST['error']=='user_exists')
			{
				echo "<div class='error-msg form-error'>It seems you already have an account, please login to continue</div>";
			}
		?>
		<div class="text-center section col-12 mx-sm-auto">
			<h2 class="w-100">Login With</h2>
			<div class="col-12 mt-3">
				<?php echo do_shortcode('[TheChamp-Login]') ?>
				<a href="" class="facebook-link-wrapper social-btn-wrapper mb-2">
					<i class="fa fa-facebook"></i>
					<span>FACEBOOK</span>
				</a>
				<a href="" class="google-link-wrapper social-btn-wrapper mb-2">
					<i class="fa fa-google-plus"></i>
					<span>GOOGLE</span>
				</a>
			</div>
			<div class="col-12 mt-4">Or</div>
		</div>
		<div class="text-center section col-12 mx-sm-auto">
			<h2 class="w-100">Login with E-Mail</h2>
		</div>
		<div class="m-1 divider"></div>
		<div class="row section col-12 mx-auto">
			<form data-parsley-validate  class="form-element-section" action="" method="post">
				<?php //wp_nonce_field('user_login'); ?>
			  <div class="form-group">
			    <label for="email">Email</label>
			    <input data-parsley-type="email" data-parsley-required-message="Email is required."  data-parsley-required="true" type="email" class="form-control" id="email" name="email">
			  </div>
			  
			  <div class="form-group">
			    <label for="pwd">Password</label><div class="input-group">
			    <input data-parsley-required="true" type="password" data-parsley-required-message="password is required." data-parsley-errors-container="#pwd-holder" class="form-control" id="pwd" name="password">
			        <span class="input-group-addon togglePassword" style="cursor: pointer;"><i class="fa fa-eye-slash"></i></span>
		      	</div>
		      	<div id="pwd-holder"></div>
			    
			  </div>
			  <div class="error-msg form-error text-left"><?php echo $error_login; ?></div>
			  <div class="form-group">
			  	<a href="/forgot-password/" class="text-highlight">Lost your password?</a>
			  </div>
			  
			  <button type="submit" class="btn btn-primary" name="login_submit" id="login_submit">Login</button>
			</form>

		</div>

			<div class="align-items-center flex-column text-center">
				<div class="mt-2">
					<a href="<?php echo get_site_url() ?>/therapist-landing-page/" class="btn btn-secondary mb-4">REGISTER AS A THERAPIST</a>
					<a href="<?php echo get_site_url() ?>/seeker-regsiter-landing-page/" class="btn btn-secondary mb-4">CREATE YOUR USER ACCOUNT</a>
				</div>
			</div>

	</div>
</section>
<?php get_footer(); ?>
