<?php /* Template Name: seeker my account review page */ ?>
<?php
	if (!is_user_logged_in()) 
	{ 
		wp_redirect('/seeker-regsiter-landing-page/');
		exit();
	} 
	else
	{
		$current_user = wp_get_current_user();
	}
	
	$healer_id = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	if(!is_numeric($healer_id))
	{
		wp_redirect(get_permalink(548));	//send seeker to my account page
		exit();
	}
	
	$healer_data = get_userdata($healer_id);
	//print_r($healer_data->post_id);exit;
	//print_r($_SERVER['REQUEST_URI']);
?>
<?php get_header(); ?>
<section class="banner-home">
	<div class="container">
		<div class="row w-70">
		<div class="col-12 text-center section">
			<h1 class="w-100">Add Review</h1>
			<p class="w-100">
				<span class="text-highlight"><?php echo $current_user->first_name . ' ' . $current_user->last_name; ?> :</span><span>Joined On <?php echo date( "dS M, Y", strtotime($current_user->user_registered) ); ?> </span>
			</p>
			<div class="col-12 my-event-btn">
				<a class="btn secondary-btn" href="/seeker-my-account-edit/">EDIT PROFILE</a>
				<a class="btn secondary-btn" data-toggle="modal" data-target="#delete_user_popup" href="">DELETE</a>
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
				<h3><?php echo count($totalContactedTherapist); ?></h3>
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
			<div class="d-block col-12 col-sm-6 mx-auto mt-20 wrapper-listing">
				<div class="row">
					<?php
						if(count($totalContactedTherapist) > 0)
						{
							?>
								<div class="col-sm-6 col-6 col-lg-5 wrapper-listing-post ">
									<div class="healer-circle mt-3">
										<?php $profile_picture_id = get_field( "profile_picture", $healer_data->post_id ); ?>
										<div class="inner-healer-circle"><img src="<?php echo wp_get_attachment_url($profile_picture_id); ?>" alt=""></div>
										<img src="https://thriive.noesis.tech/wp-content/themes/thriive/assets/images/icon-mark.png" class="verify-img" alt="">
									</div>
								</div>
								<div class="col-sm-6 col-6 col-lg-7 txt-wrap ">
									<h3 class=""><?php echo $healer_data->first_name . ' ' . $healer_data->last_name; ?></h3>
									<?php
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
									?>
									<p class="text-highlight m-0"><?php echo $get_therapist; ?></p>
									<p class=""><?php echo date( "dS M, Y", strtotime($healer_data->user_registered) ); ?></p>
									<!--<div class="all_comments">
										<?php
											$comments = get_comments(array('post_id' => $healer_data->post_id ));
											if($comments)
											{
												echo "<ul>";
												foreach($comments as $comment)
												{
													echo "<li>" . $comment->comment_content . "</li>";
												}
												echo "</ul>";
											}
										?>
									</div>-->
								</div>
								<?php
						}
					?>
				</div>
			</div>
		</div>
		
		<div class="row w-70">
			<div class="col-sm-6 col-12 mx-auto mb-3">
			<form data-parsley-validate  class="form-element-section" action="" method="post">
				<?php wp_nonce_field('add_review'); ?>
				<input type="hidden" name="txtPostId" value="<?php echo $healer_data->post_id; ?>">
				<div class="form-group">
					<textarea class="form-control" id="" rows="3" placeholder="Write a review." name="txtReview"></textarea>
				</div>
				<button type="submit" class="btn btn-primary" name="submit_review" id="submit_review">SUBMIT REVIEW</button>

			</form>
			</div>
		</div>
		
		
	</div>
</section>





<?php get_footer(); ?>