<?php /* Template Name: Career Page */ ?>

<?php get_header(); ?>

<section class="abt-top">
	<div class="container">
		<div class="w-70 text-center section">
			<div class="row">
				<div class="col-12">
					<h2>Want to work with us</h2>
					<p>Hey you! We’re always on the lookout for new people like you. You’re cool, you’re smart, and of course you know how to figure things out. Creativity is collaboration and we’re always eager to meet talented people who think outside the box.</p>
					
					<p>Take a look at the current openings below.</p>
					
					<p>Email your resume to <a href="mailto:hr@thriive.in">hr@thriive.in</a> and we shall get in touch once a vacancy opens up.</p>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="abt-form-section">
	<div class="container">
		<div class="row section col-sm-4 col-12 p-0 mx-auto">
			<!--<form data-parsley-validate  class="form-element-section" action="" method="POST" enctype="multipart/form-data">
				<div class="form-group">
			    	<label for="career_first_name">First Name</label>
					<input data-parsley-required="true"  data-parsley-required-message="First Name is required."  type="text"  class="form-control" id="career_first_name" name="txtFirstName">
				</div>
				
				<div class="form-group">
			    	<label for="career_last_name">Last Name</label>
					<input data-parsley-required="true"  data-parsley-required-message="Last Name is required."  type="text"  class="form-control" id="career_last_name" name="txtLastName">
				</div>
				
				<div class="form-group">
			    	<label for="career_email">Email</label>
					<input data-parsley-required="true"  data-parsley-required-message="Email is required."  type="email"  class="form-control" id="career_email" name="txtEmail">
				</div>
				
				<div class="form-group">
			    	<label for="career_email">Message</label>
					<textarea rows="4" cols="50" class="form-control" id="Message" data-parsley-required="true" data-parsley-required-message="Message is required" name="txtMessage"></textarea>
				</div>
				
				
				<div class="form-group d-flex">
				  <div class="col-8 p-0">
					  <label class="" for="resume-upload">Upload Resume</label>
					  <span class="text-show d-block"></span>
				  </div>
				  <div class="col-4 form-upload-wrapper text-center">
					  <a href="" class="btn btn-upload">UPLOAD</a>
					  <input type="file" id="resume-upload" data-parsley-required-message="Upload your resume." data-parsley-required="true" data-parsley-errors-container="#resume-holder" name="resume-upload" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf" class="fileupload-input" name="fileResume">					  
				  </div>	
			  	</div>
				<div id="resume-holder"></div>
				
				<button type="submit" class="btn btn-primary" name="btnCareerSubmit">Submit</button>
			</form>-->
			<?php echo do_shortcode('[gravityform id=1 title=false description=false ajax=true tabindex=49]'); ?>
		</div>
	</div>
</section>
<style>
	/* Gravity Form Customize */
	.gravity_form_wrapper
	{
		margin-top: 0 !important;
	}
	.gravity_form
	{
		margin: 0;
	}
	.gravity_form li
	{
		list-style: none;
	}
	.gravity_form textarea 
	{
	    max-height: 80px !important;
	    border: thin solid #4f0475;
	    border-radius: 5px;
	}
	.gravity_form label 
	{
	    font-size: 14px !important;
	    font-weight: 400 !important;
	    margin: 0;
	}
	.gravity_form input[type="text"], .gravity_form select 
	{
	    border: thin solid #4f0475;
	    border-radius: 5px;
	    height: 38px;
	    width: 100% !important;
	}
	.gravity_form input[type="file"]
	{
		border:none;
		width: 100% !important;
	}
	.gravity_form .ginput_container_fileupload span 
	{
	    font-size: 12px;
	    opacity: 0.7;
	}
	.gravity_form input[type="submit"]
	{
		color: #fff;
	    background: #4f0475;
	    border: 0px;
	    border-radius: 10px;
	    border: 1px solid #4f0475;
	    margin: 0 auto !important;
	    padding: 8px 29px;
	    display: block !important;
	    transition: .2 ease-in-out;
	}
	.gravity_form input[type="submit"]:hover
	{
		border:thin solid #4f0475;
		color: #4f0475;
		background: #fff;
	}
	.gravity_form li.gfield.gfield_error, .gravity_form .validation_error
	{
		border:none !important;
		margin: 0;
		padding: 0;
		background: transparent !important;
	}
	.gravity_form.validation_message, .gravity_form .validation_error
	{
	    font-weight: 400 !important;
	    padding: 0 !important;
	}
	/* Gravity Form */
</style>

<?php get_footer(); ?>