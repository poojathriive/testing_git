
<div class="d-flex col-12 col-sm-12 mt-20 wrapper-listing section-wrapper-listing p-0 flex-wrap">
	<div class="therapiest-listing-wrapper d-flex flex-wrap col-12 p-0">
	<div class="col-5 col-sm-6 col-lg-4 wrapper-listing-post therapiest-card-img ">
		<div class="healer-circle mt-3">
			<div class="inner-healer-circle">
				<a href="<?php echo get_permalink(); ?>">
				<?php
					if(is_mobile()) {
						$healer_image = the_post_thumbnail('featured_post_mobile', array('alt' => get_the_title(), 'title'=>get_the_title())); // echo $healer_image;
					} else {
						$healer_image = the_post_thumbnail('thumbnail', array('alt' => get_the_title(), 'title'=>get_the_title()));
					}
					echo $healer_image;
				?>
				</a>
			</div>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-mark.png" class="verify-img" alt="">
		</div>
	</div>	
	<div class="col-7 col-sm-6 col-lg-8 txt-wrap ">
		<h2 class=""><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
		<?php 

		$therapist_details = get_users(array('meta_key' => 'post_id','meta_value' => get_the_id()));
		$therapist_id = $therapist_details[0]->ID;
//echo "<pre>";
//print_r($therapist_details);
		//echo "Therapist ID==".$therapist_id."online_status==".is_user_online($therapist_id)."post id==".get_the_id();
		 if(is_user_online($therapist_id) && $therapist_id != '')
{
   echo '<h2 class="online_headTxt" style="float:right;color:green"><span class="onlinestat_circle">&nbsp;</span> Online</h2>';
 }
 else
 {
   echo '<h2 class="offline_headTxt" style="float:right;color:#999"><span class="offlinestat_circle">&nbsp;</span> Offline</h2>';
 }
		
		?>
		<p class="m-0 localtion-wrapper"><?php echo get_field('therapist_title'); ?></p>
		<?php if(!empty(get_field('avg_rating'))) { ?>
			<a href="<?php echo get_permalink(); ?>/#7">
				<p class="m-0" style="color: #ffc107;">
					<?php for($i=1;$i<=get_field('avg_rating');$i++){ ?>
		    			<span class="fa fa-star"></span>
		    		<?php } ?>
		    		<?php $leftstar = 5 - (int)get_field('avg_rating'); ?>
		    		<?php for($i=1;$i<=$leftstar;$i++){ ?>
		    			<span class="fa fa-star-o"></span>
		    		<?php } ?>
	    		</p>
			</a>
		<?php } ?>
		<?php
			if(have_rows('therapy')) {
				?>
				<p class="m-0">
					Therapies: 
					<span class="more_therapiest">
						<?php
						$total_count = count(get_field("therapy"));
						$count = 1;
						while( have_rows('therapy') ): the_row();
							$therapy_names = get_sub_field('therapy_name');
							foreach($therapy_names as $therapy_name) {
								echo $therapy_name->name . ($total_count == $count ? '.' : ', ');
								$count++;
							}
						endwhile;
						?>
					</span>
				</p>
				<p class="m-0">Practicing Since:
					<?php
						$therapy_experiences = get_field('therapy');
						$experience_order = array();
						foreach($therapy_experiences as $i=>$therapy_experience) {
							$therapy_experience = new DateTime($therapy_experience['experience']);
							$experience_order [$i] = $therapy_experience->format('Y');
						}
						array_multisort( $experience_order, SORT_ASC, $therapy_experiences );
						$practicing_since = new DateTime($therapy_experiences['0']['experience']);
						echo $practicing_since->format('Y');
					?>
				</p>
				<?php
			}
		?>

		<?php $area = get_field('area');
		if(get_field('area')) { echo "<p class=' m-0'>Location: $area</p>"; } ?>
		<?php if($post->distance) { echo "<p class='m-0'>Distance: $post->distance</p>"; } ?>
		
		
		
<!-- 		<a href="<?php echo get_permalink(); ?>" class="btn btn-primary">KNOW MORE</a> -->
	</div>
	<div class="col-12 mt-3 text-center p-0 consult_btnGrp">
		<?php $current_user = wp_get_current_user();
		 $seeker_id = $current_user->ID;
		     $seeker_email = $current_user->user_email;
	
		 $seeker_name = $current_user->display_name;
		if(count($current_user->roles) > 1)
		 $role1 =  $current_user->roles[1];
		else
			 $role1 =  $current_user->roles[0];
		
		
			$therapist_email = $therapist_details[0]->data->user_email;
			//echo site_url();
		$msg = $seeker_name ." was trying to contact,when you were offline" ;
		
		if($seeker_id != '')
			$from_status = 1;
		else
		$from_status = 0;	
		$therapist_id = $therapist_details[0]->ID;
	
		 if($role1== "subscriber")
		 {
		$arr = get_user_meta($therapist_id, 'first_name');
		$name = $arr[0];
		 }
	 else
	 {
		 $name = $therepist_data->display_name;
	 }
		
		$therapist_mobile = get_user_meta($therapist_id,'mobile');
			$therapist_countrycde = get_user_meta($therapist_id,'countryCode');
		?>
		<input type="hidden" name = "mobile_<?php echo $therapist_id ?>" id="mobile_<?php echo $therapist_id ?>" value="<?php echo $therapist_mobile[0]; ?>" />
		<input type="hidden" name = "countrycode_<?php echo $therapist_id ?>" id="countrycode_<?php echo $therapist_id ?>" value="<?php echo $therapist_countrycde[0]; ?>" />
		<input type="hidden" name = "msg<?php echo $therapist_id ?>" id="msg_<?php echo $therapist_id ?>" value="<?php echo $msg ?>" />
		<input type="hidden" name = "session_user" id="session_user" value="<?php echo $current_user->ID ?>" />
		

		<?php
		//echo "==".is_user_online($therapist_id);
		$output = '<div class="btn_groups">';
 if(is_user_online($therapist_id) && $therapist_id != '')
{
   $to_status = 1;
 }
 else
 {
	  $to_status = 0;
 }
	$url = get_the_post_thumbnail_url( get_the_id(), 'post-thumbnai' );		  
 $output .= '<div id="start_chat_button_'.$therapist_id.'">
<button type="button" class="btn btn-info btn-xs start_chat btn btn-primary btn-big btn-transparent connect_with_btn_listing chat_whtbg" data-img ="'.$url.'" data-fromuserid = "'.$seeker_id.'" data-touserid="'.$therapist_id.'" data-tousername="'.$name.'" data-from_status = "'.$from_status.'" data-to_status = "'.$to_status.'" data-mobile="'.$therapist_countrycde[0].$therapist_mobile[0].'" data-msg="'.$msg.'" data-email="'.$therapist_email.'"  data-role="'.$role1.'"><i class="fa fa-comments-o" aria-hidden="true"></i> Start Chat</button></div>';
$output .= '</div>';
		
		?> 
		
<?php
			if(wp_is_mobile()){
				 ?>
				<a href="" id="call_now_<?php echo get_the_id(); ?>" class="btn btn-primary btn-big call_now_link anch_therlink1"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a>
				<!--<a href="" id="consult_online_<?php echo get_the_id(); ?>" class="btn btn-primary btn-big btn-transparent consult_online_link"><i class="fa fa-envelope" aria-hidden="true"></i> Consult Online </a>  -->
		<?php 	   if($role1 == 'subscriber' || $role1 =="")
echo $output;

?>
				<?php
			}else{
				?>
					<a href="" id="consult_online_<?php echo get_the_id(); ?>" data-type="1" class="btn btn-primary btn-big consult_online_link"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a>
					<!-- <a href="" id="consult_online_desktop<?php //echo get_the_id(); ?>" class="btn btn-primary btn-big btn-transparent connect_with_btn_listing" data-id="<?php echo get_the_id(); ?>"><i class="fa fa-envelope" aria-hidden="true"></i> Consult Online </a> -->
<?php 	   if($role1 == 'subscriber' || $role1 =="")
echo $output;

?>
				<?php
			}
		
		?>
		

	</div>
	
			<input type="hidden" id="therapist_<?php echo get_the_id(); ?>" value="<?php echo $therapist_email; ?>" />
			<input type="hidden" id="seeker_<?php echo get_the_id(); ?>" value="<?php echo $seeker_email; ?>" />
			
	<?php
		if(wp_is_mobile()){ ?>

			<a href="tel:01234567890" id="call_link_<?php echo get_the_id(); ?>" style="pointer-events: none;color:white;">01234 567 890</a>
				
		<?php } ?>
		
	</div>
	<div class="m-1 divider col-12"></div>
	 <div class="table-responsive">
   
  
    <div id="user_details"></div>
    <div id="user_model_details"></div>
   </div>
</div>


