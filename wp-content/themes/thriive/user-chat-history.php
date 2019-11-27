<?php /* Template Name: User chat History */ ?>
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
			<h3 class="w-100">My Online Consultation</h3>
		</div>
			<div class="row section col-sm-4 col-12 mx-auto" id= "chat_data">
	 <?php   echo user_chat_history(); 
	  echo user_chat_history_mobile(); 
	 
	 
	 ?>
	
	

<div class="fieldje field-3">
<p>
<span></span>
</p>
</div>

<?php

if(isset($_GET['to_user']))
{
  $to_user = $_GET['to_user'];

export_csv_single($to_user);
}

				?>


				 </div>
		</div>
	


</section>

<script>
  $('#form').parsley();
</script>
<?php get_footer(); ?>