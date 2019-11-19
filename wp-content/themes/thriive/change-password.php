<?php /* Template Name: Change Password page */ ?>
<?php 
	if (!is_user_logged_in()) {
		wp_redirect('/login/');
		exit();
	} 
?>
<?php get_header(); ?> 
<section class="section form-element-wrapper">
	<div class="conatiner">
		<div class="col-sm-4 text-center col-12 mx-sm-auto">
			<a href="/therapist-account-dashboard" class="back-btn"> < BACK </a>
			<h3 class="w-100">Change Password</h3>
		</div>
<!-- 		<div class="m-1 divider"></div> -->
		<div class="row section col-sm-4 col-12 mx-auto">
			<form data-parsley-validate  class="form-element-section" action="" method="post">
			  <div class="form-group">
			    <label for="oldPassword">Old password</label>
			    <div class="input-group">
			        <input data-parsley-errors-container="#oldPwd-holder" data-parsley-required-message="Old password is required."  data-parsley-required="true" type="password" class="form-control" id="oldPassword" name="oldPassword" required>
			        <span class="input-group-addon togglePassword" style="cursor: pointer;"><i class="fa fa-eye-slash"></i></span>
		      	</div>	
		      	<div id="oldPwd-holder"></div>		    
			  </div>
			  <div class="form-group">
			    <label for="newPassword">New Password</label>
			    <div class="input-group">
			        <input data-parsley-errors-container="#newPwd-holder" data-parsley-required-message="New password is required." data-parsley-required="true" data-parsley-pattern="/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/" data-parsley-pattern-message="<div>Password must contain at least:</div><ol><li>One character</li><li>One number</li><li>One special character</li><li>Six characters in length</li></ol>" type="password" class="form-control" id="newPassword" name="newPassword" required>
			        <span class="input-group-addon togglePassword" style="cursor: pointer;"><i class="fa fa-eye-slash"></i></span>
		      	</div>
		      	<div id="newPwd-holder"></div>
			  </div>
			  <div class="form-group">
			    <label for="confNewPassword">Confirm new password</label>
			    <div class="input-group">
			        <input data-parsley-errors-container="#confNewPwd-holder" data-parsley-required-message="Confirm new password is required."  data-parsley-required="true" data-parsley-equalto="#newPassword" data-parsley-equalto-message="New password and confirm new password doesn't matched" type="password" class="form-control" id="confNewPassword" name="confNewPassword" required>
			        <span class="input-group-addon togglePassword" style="cursor: pointer;"><i class="fa fa-eye-slash"></i></span>
		      	</div>	
		      	<div id="confNewPwd-holder"></div>		    
			  </div>
			  <div class="error-msg">
				  <?php 
					  echo $change_pwd_msg;
				  ?>
			  </div>
			  <button type="submit" class="btn btn-primary" name="btnChangePassword" id="btnChangePassword">Submit</button>
			</form>
		</div>
	</div>
</section>

<script>
  $('#form').parsley();
</script>
<?php get_footer(); ?>