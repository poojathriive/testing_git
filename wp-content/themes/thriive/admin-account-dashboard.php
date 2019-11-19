 
<?php /* Template Name: Admin account dashboard */ ?>
<?php
	if (!is_user_logged_in()) 
	{ 
		wp_redirect('/login/');
		exit();
	} 
	else 
	{
		$current_user = wp_get_current_user();
		
		if(get_post_status($current_user->post_id)=='pending-payments' || get_post_status($current_user->post_id) != 'publish') 
		{
			wp_redirect(get_permalink(274));
		}		
		$address =json_decode($current_user->address);
		$userPost = get_post($current_user->post_id);
		//if user's role is subscriber then redirect to seeker dashboard 
		if($current_user->roles[0] == 'subscriber')
		{
			wp_redirect('my-account-page/');
			exit();
		}
	}
/*
	
	echo "<pre>";
	print_r($userPost);
	echo "</pre>";
*/
	
?>
<?php get_header(); ?>


<!-- new sections starts here -->
<form class="form-inline form_boxes" method="post">

<section class="sec01">
	<?php echo chat_filters();?>
</section>
</form>
<form class="form-inline form_boxes" method="post">
<section class="sec02">
	<?php echo active_conversation();?>
</section>
</form>



<!-- new sections ends here -->







<!--
<div class="badge_wrapper">
	<p><?php echo $current_user->first_name.' '.$current_user->last_name;?></p>
</div>
<div class="badge_wrapper_download"></div>
-->


 <div class="modal fade" id="show_badge" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal body -->
        <div class="modal-body">
        	 <button type="button" class="close" data-dismiss="modal">&times;</button>
        	<div class="badge_view_wrapper">
				<p><?php echo $current_user->first_name.' '.$current_user->last_name;?></p>
			</div>
			<div class="text-center">
				<a href="" download="badge_image.png" class="badge-btn" download> <i class="fa fa-download" aria-hidden="true"></i> DOWNLOAD BADGE</a>
			</div>
        	               
        </div>
      </div>
    </div>
 </div>

<?php get_footer(); ?>


  
   
  

