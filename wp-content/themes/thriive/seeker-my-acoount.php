<?php /* Template Name: seeker my account page */ ?>
<?php
	if (!is_user_logged_in()) 
	{ 
		wp_redirect('/login/');
		exit();
	} else {
		$current_user = wp_get_current_user();
		//if user's is Therapist then redirect to therapist dashboard 
		if(in_array("therapist", $current_user->roles))
		{
			wp_redirect('/therapist-account-dashboard/');
			exit();
		}
		
			if (strpos($_SESSION['chat_page'], '/therapist') !== false) {
				$site_referer = $_SESSION['chat_page'];
				unset($_SESSION['chat_page']);
				wp_redirect($site_referer);
				exit();
   }
	}
?>
<?php get_header(); ?>
<section class="banner-home">
	<div class="container">
		<div class="row w-70">
			<div class="col-12 text-center section">
				<h1 class="w-100">My Account</h1>
				<p class="w-100 para_txt">
					<span class="text-highlight txt_headz1"><?php echo $current_user->first_name . ' ' . $current_user->last_name; ?> :</span>
					<span class="txt_subheadz1"> Joined On <?php echo date( "dS M, Y", strtotime($current_user->user_registered) ); ?> </span>
				</p>
				<div class="my-event-btn">
						<a class="btn secondary-btn btn_box1" href="<?php echo site_url().'/seeker-my-account-edit/'?>">
							<img src="<?php echo site_url(); ?>/wp-content/themes/thriive/assets/images/editprofile_icon.png" class="iconz1" alt="">
							<span class="icon_txt1">
								EDIT PROFILE
							</span>
							
						</a>
						<a class="btn secondary-btn btn_box1"  data-toggle="modal" data-target="#delete_user_popup" href="">
							<img src="<?php echo site_url(); ?>/wp-content/themes/thriive/assets/images/delete_icon.png" class="iconz1" alt="">
							<span class="icon_txt1">DELETE</span>
						</a>
						<a class="btn secondary-btn btn_box1" href="<?php echo site_url().'/user-chat-history/'?>">
							<img src="<?php echo site_url(); ?>/wp-content/themes/thriive/assets/images/chat_icon.png" class="iconz1" alt="">
							<span class="icon_txt1">VIEW CHAT</span>
						</a>
						<a class="btn secondary-btn btn_box1" href="<?php echo site_url().'/therapist/'?>">
							<img src="<?php echo site_url(); ?>/wp-content/themes/thriive/assets/images/newchat_icon.png" class="iconz1" alt="">
							<span class="icon_txt1">START NEW CHAT</span>
						</a>
						<a class="btn secondary-btn btn_box1" href="<?php echo site_url().'/seeker-my-account-edit/?download_report=yes'?>">
							<img src="<?php echo site_url(); ?>/wp-content/themes/thriive/assets/images/chat_icon.png" class="iconz1" alt="">
							<span class="icon_txt1">EXPORT CHAT</span>
						</a>
							<?php if(isset($_GET['download_report']))
							{
								export_csv();
							}
							?>
					</div>
			</div>	
		</div>				
	</div>
</section>

<div class="m-1 divider"></div>

<section>
	<div class="container">
		<div class="row section w-70 text-center">
			<div class="col-12">
				<?php $totalContactedTherapist = explode(",",get_user_meta($current_user->ID, 'contacted_therapist_id', true)); ?>
				<h3><?php echo count(array_filter($totalContactedTherapist)); ?></h3>
			</div>
			<div class="col-12">
				<p>Contacted Healers</p>
			</div>
			
		</div>
	</div>	
</section>

<div class="m-1 divider"></div>

<section>
	<div class="container">
		<div class="row w-70 w-70-tab">
			
			<?php
				if(count(array_filter($totalContactedTherapist)) > 0)
				{
					foreach($totalContactedTherapist as $contactedTherapistId)
					{
						$healer_data = get_userdata($contactedTherapistId);
						$profile_picture_id = get_field( "profile_picture", $healer_data->post_id );
						$all_therapist = get_the_terms($healer_data->post_id, 'therapy');
						//print_r($all_therapist);
						$i = 1;
						$get_therapist = '';
						foreach ($all_therapist as $therapist)
						{
							if($i == 1)
							{
								$get_therapist = $therapist->name;
							}
							else
							{
								$get_therapist .= ', ' . $therapist->name;
							}
							$i++;
						}
						
						$comments = get_comments(array('post_id' => $healer_data->post_id ));					
						?>
							<div class="d-block col-12 col-sm-6 mt-20 wrapper-listing">
								<div class="row">
									<div class="col-sm-6 col-6 col-lg-5 wrapper-listing-post ">
										<div class="healer-circle mt-3">
											<div class="inner-healer-circle"><img src="<?php echo wp_get_attachment_url($profile_picture_id); ?>" alt=""></div>
											<img src="<?php echo site_url(); ?>/wp-content/themes/thriive/assets/images/icon-mark.png" class="verify-img" alt="">
										</div>
									</div>
									<div class="col-sm-6 col-6 col-lg-7 txt-wrap ">
										<h3 class=""><?php echo $healer_data->first_name . ' ' . $healer_data->last_name; ?></h3>									
										<p class="text-highlight m-0"><?php echo $get_therapist; ?></p>
										<p class=""><?php echo date( "dS M, Y", strtotime($healer_data->user_registered) ); ?></p>
										<p class="text-highlight">Reviews (<?php echo count($comments); ?>)</p>
									</div>
									<div class="col-12 col-sm-10 text-center mt-3">
										<a href="<?php echo get_permalink(595) . '/' . $contactedTherapistId; ?>" class="btn btn-primary">ADD REVIEW</a>
										<a href="" class="btn btn-primary" data-toggle="modal" data-target="#connect_with_healer_<?php echo $contactedTherapistId; ?>">CONNECT AGAIN</a>
									</div>
								</div>
							</div>
						<?php
					}
				}
			?>
			
<!--
			<div class="col-12 text-center mt-4 mb-4">
				<a href="" class="btn btn-primary">VIEW NEWSLETTER</a>
			</div>
-->
			
		</div>
	</div>
</section>

<?php
	//for($i=0; $i<count($totalContactedTherapist); $i++)
	foreach($totalContactedTherapist as $contactedTherapistId)
	{
		$healer_data = get_userdata($contactedTherapistId);
		?>
			<!-- Modal -->
			<div class="modal fade" id="connect_with_healer_<?php echo $contactedTherapistId; ?>" tabindex="-1" role="dialog" aria-labelledby="connect_with_healer" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-body text-center">
				  	<form data-parsley-validate  class="form-element-section" action="" method="POST">	
					  	<?php wp_nonce_field('connect_with_healer'); ?>
					  	<input name="postId" type="hidden" value="<?php echo $healer_data->post_id; ?>">
				  		<div class="form-group">
							<div class="row  w-70">
								<label for="communication" class="col-12">Communication Mode</label>
									<?php $communication_modes = get_field('communication_mode', $healer_data->post_id); ?> 																		
									<?php foreach($communication_modes as $communication_mode) {?>									
										<div class="checkbox-wrapper col-6">
										<input type="checkbox" name="communication[]" value="<?php echo $communication_mode ?>" id="<?php echo $communication_mode ?>" data-parsley-multiple="communication" data-parsley-errors-container="#message-holder" required>
										<label for="<?php echo $communication_mode ?>"><?php echo $communication_mode ?></label>
									</div>									
								<?php } ?>												
									<div id="message-holder"></div>
						  	</div>
						</div>				        
			         <button type="submit" class="btn btn-primary" name="btnConnectWithHealer" data-dismiss="modal1">SUBMIT</button>			         
				  	</form>
			      </div>			
			    </div>
			  </div>
			</div>
		<?php
	}
?>

<?php get_footer(); ?>