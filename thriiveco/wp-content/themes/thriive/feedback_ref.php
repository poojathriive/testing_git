<?php /* Template Name: Feedback page */ ?>
<?php get_header(); ?>	
<?php ?>
<section class="regsiter-form-section" id="form-step-1">
	<div class="container">
		<div class="row section col-sm-6 col-12 mx-auto">
			<form data-parsley-validate  class="form-element-section" id="personal_details" action="" method="post">
			 <?php wp_nonce_field('nonce_feedback'); ?>
			  
			 	<div class="form-group">
						<h2 class="text-center w-100">Feedback</h2>
<!-- 						<p class="text-center">Remember the more details you fill in, the higher your chances of popping up in SEO (Search Engine Optimization) searches. We want you to put your best foot forward.</p> -->
						<textarea class="form-control" id="feedback" rows="4" name="feedback" ></textarea>
				</div>
				<input type="hidden" id="user_id" name="user_id" value="<?php echo $_GET['user']?>">
				<input type="hidden" id="feed_ref" name="feed_ref" value="<?php echo $_GET['feed_ref']?>">
			  	<button type="submit" name="feedback_submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</section>


<!-- delete User popup -->
<div class="modal fade" id="reviewSubmit" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal body -->
        <div class="modal-body">
	         <!-- commented bcoz duplicate id issue so changed id -->
<!--          <form data-parsley-validate class="form-element-section"  id="formrequest_news_letter" name="request_news_letter" action="#" method="post"> -->
			  <form data-parsley-validate class="form-element-section"  id="formrequest_news_letter_reviewSubmit" name="request_news_letter" action="#" method="post">
	         <div class="row section col-sm-12 col-12 mx-auto p-0">
		        <div class="col-12">
				 	<div>
					 	<p>Time is precious, and so are you! Immense gratitude from us to you!</p>
					 	<p>Your review has been received by Thriive Art & Soul! Thank you so much for taking the time to write it!</p>
					 	<p>Discover the amazing world of Thriive with its enviable collection of articles, video talks, and guided meditations <a href="<?php echo site_url(); ?>">here</a></p>					 	
				 	</div>
				</div>
			  	<button type="button" class="btn d-inline btn-primary" data-dismiss="modal" onclick="location.href='<?php echo site_url(); ?>';">Close</button>            
	         </div>
         </form>                  
        </div>
      </div>
    </div>
 </div>
<?php
	if(isset($_POST['feedback']) && isset($_POST['user_id']) && isset($_POST['feed_ref']))
	{
		echo '<script>$("#reviewSubmit").modal();</script>';
	}
?>
<?php get_footer(); ?>
