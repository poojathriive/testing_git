<?php /* Template Name: Forgot page */ ?>
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
			<h2 class="w-100">Forgot Password</h2>
		</div>
		<div class="m-1 divider"></div>
		<div class="row section col-sm-4 col-12 mx-auto">
			<form data-parsley-validate  class="form-element-section" action="" method="post">
				<?php //wp_nonce_field('forgot_password'); ?>
			  <div class="form-group">
			    <label for="email">Please enter your email</label>
			    <input data-parsley-type="email" data-parsley-required-message="Email is required."  data-parsley-required="true" type="email" class="form-control" id="email" name="email">
			  </div>
			  <button type="submit" class="btn btn-primary" name="btnForgotPassword" id="btnForgotPassword">Submit</button>
			</form>
		</div>
	</div>
	
	<div class="modal fade" id="reset_link_sent" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal body -->
        <div class="modal-body">
         <form data-parsley-validate class="form-element-section"  id="review_account">
	         <div class="row section col-sm-12 col-12 mx-auto p-0">
		        <div class="form-group col-12">
				 	<label ><?php echo $result; ?></label>
				</div><a href="" class="mx-auto btn btn-primary" data-dismiss="modal">OK</a>
	         </div>
         </form>                  
        </div>
      </div>
    </div>
  </div>
</section>
<?php
	if($_POST['email'])
	{
		echo '<script type="text/javascript">$(document).ready(function(){$("#reset_link_sent").modal();});</script>';
	}
?>
<?php get_footer(); ?>
