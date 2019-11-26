<?php /* Template Name: Therapist chat History */ ?>
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
			<h3 class="w-100">Therapist Chat History</h3>
		</div>
			<div class="row section col-sm-4 col-12 mx-auto">
				 <?php   echo therapist_chat_history(); ?>
				 <?php   echo therapist_chat_history_mobile(); ?>
				 </div>
		</div>
	
</section>






<script>
  $('#form').parsley();
</script>
<?php get_footer(); ?>