<?php /* Template Name: Reset Password page */ ?>
<?php 
	if (is_user_logged_in()) 
	{ 
		wp_redirect(get_permalink(548));
	} 
?>
<?php get_header(); ?> 
<section class="section form-element-wrapper">
	<div class="conatiner">
		<div class="row text-center section col-sm-6 col-12 mx-sm-auto">
			<h2 class="w-100">Reset Password</h2>
		</div>
		<div class="m-1 divider"></div>
		<div class="row section col-sm-4 col-12 mx-auto">
			<form data-parsley-validate  class="form-element-section" action="" method="post">
				<?php wp_nonce_field('reset_password'); ?>
				<input type="hidden" value="<?php echo $_GET['token']; ?>" name="token">
				<input type="hidden" value="<?php echo $_GET['token_id']; ?>" name="token_id">
				<input type="hidden" value="<?php echo $_GET['token_for']; ?>" name="token_for">
			  <div class="form-group">
			    <label for="email">Password</label>
			    <div class="input-group">
			        <input data-parsley-errors-container="#pwd-holder" data-parsley-required-message="Password is required."  data-parsley-required="true" data-parsley-pattern="/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/" data-parsley-pattern-message="<div>Password must contain at least:</div><ol><li>One character</li><li>One number</li><li>One special character</li><li>Six characters in length</li></ol>" data-parsley-equalto="#confPassword" data-parsley-equalto-message="Password and confirm password doesn't matched" type="password" class="form-control" id="password" name="password" required>
			        <span class="input-group-addon togglePassword" style="cursor: pointer;"><i class="fa fa-eye-slash"></i></span>
		      	</div>
		      	<div id="pwd-holder"></div>
			  </div>
			  <div class="form-group">
			    <label for="email">Confirm password</label>
			    <div class="input-group">
			        <input data-parsley-errors-container="#confPwd-holder" data-parsley-required-message="Confirm password is required."  data-parsley-required="true" data-parsley-equalto="#password" data-parsley-equalto-message="Password and confirm password doesn't matched" type="password" class="form-control" id="confPassword" name="confPassword" required>
			        <span class="input-group-addon togglePassword" style="cursor: pointer;"><i class="fa fa-eye-slash"></i></span>
		      	</div>	
		      	<div id="confPwd-holder"></div>		    
			  </div>
			  <div class="error-msg">
				  <?php 
					  echo $reset_pwd_msg;
				  ?>
			  </div>
			  <button type="submit" class="btn btn-primary" name="btnResetPassword" id="btnResetPassword">Submit</button>
			</form>
		</div>
	</div>
</section>

<script>
  $('#form').parsley();
</script>
<?php get_footer(); ?>