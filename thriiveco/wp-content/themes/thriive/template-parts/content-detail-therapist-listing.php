<div class="d-flex col-12 col-sm-12 mt-20 wrapper-listing section-wrapper-listing p-0 flex-wrap" itemscope itemtype="http://schema.org/Physician" itemprop="Physician">
	<div class="therapiest-listing-wrapper d-flex flex-wrap col-12 p-0">
	<div class="col-5 col-sm-6 col-lg-4 wrapper-listing-post therapiest-card-img ">
		<div class="healer-circle mt-3">
			<div class="inner-healer-circle">
				<a href="<?php echo get_permalink(); ?>">
				<?php 
					if(is_mobile()) {
						//$healer_image = the_post_thumbnail('featured_post_mobile', array('alt' => get_the_title(), 'title'=>get_the_title())); // echo $healer_image;
						$healer_image = get_the_post_thumbnail_url($post->ID,'featured_post_mobile');
					} else {
						//$healer_image = the_post_thumbnail('thumbnail', array('alt' => get_the_title(), 'title'=>get_the_title()));
						$healer_image = get_the_post_thumbnail_url($post->ID,'thumbnail');
					} ?>
					<img src="<?php echo $healer_image;?>" alt="<?php echo get_the_title();?>" title="<?php echo get_the_title();?>" itemprop="image" />			
				</a>
			</div>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-mark.png" class="verify-img" alt="">
		</div>
	</div>	
	<div class="col-7 col-sm-6 col-lg-8 txt-wrap ">
		<h2 itemprop="name"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
		<p class="m-0 localtion-wrapper"><?php echo get_field('therapist_title'); ?></p>
		<?php if(!empty(get_field('avg_rating'))) { ?>
			<p class="m-0" style="color: #ffc107;">
	    		<?php for($i=1;$i<=get_field('avg_rating');$i++){ ?>
	    			<span class="fa fa-star"></span>
	    		<?php } ?>
	    		<?php $leftstar = 5 - (int)get_field('avg_rating'); ?>
	    		<?php for($i=1;$i<=$leftstar;$i++){ ?>
	    			<span class="fa fa-star-o"></span>
	    		<?php } ?>
			</p>
		<?php } ?>
		<?php
			if(have_rows('therapy')) {
				?>
				<p class="m-0">
					Therapies: 
					<span class="more_therapiest" itemprop="medicalSpecialty">
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

		<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			<?php $area = get_field('area');
			$splitarea = explode(",",$area);
			if($area) { ?>
				<p class=' m-0'>Location: 
					<span itemprop="addressLocality"><?php echo $splitarea[0]; ?></span>, 
					<span itemprop="addressRegion"><?php echo $splitarea[1]; ?></span></p>
			<?php } ?>
		</div>
		<?php if($post->distance) { echo "<p class='m-0'>Distance: $post->distance</p>"; } ?>
		<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates" style="display:none;">
			<span itemprop="latitude"><?php echo get_field('latitude'); ?></span>
			<span itemprop="longitude"><?php echo get_field('longitude'); ?></span>
		</div>
		
		
		
<!-- 		<a href="<?php echo get_permalink(); ?>" class="btn btn-primary">KNOW MORE</a> -->
	</div>
	<div class="col-12 mt-3 text-center p-0">
		
<?php
			if(wp_is_mobile()){
				 ?>
				<a href="" id="call_now_<?php echo get_the_id(); ?>" class="btn btn-primary btn-big call_now_link"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a>
				<a href="" id="consult_online_<?php echo get_the_id(); ?>" class="btn btn-primary btn-big btn-transparent consult_online_link"><i class="fa fa-envelope" aria-hidden="true"></i> Consult Online </a>
				<?php
			}else{
				?>
					<a href="" id="consult_online_<?php echo get_the_id(); ?>" data-type="1" class="btn btn-primary btn-big consult_online_link"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a>
					<a href="" id="consult_online_desktop<?php echo get_the_id(); ?>" class="btn btn-primary btn-big btn-transparent connect_with_btn_listing" data-id="<?php echo get_the_id(); ?>"><i class="fa fa-envelope" aria-hidden="true"></i> Consult Online </a>

				<?php
			}
		?>

	</div>
	<?php $therapist_details = get_users(array('meta_key' => 'post_id','meta_value' => get_the_id()));
			$therapist_email = $therapist_details[0]->data->user_email;
			$current_user = wp_get_current_user();
		    $seeker_email = $current_user->user_email;
			?>
			<input type="hidden" id="therapist_<?php echo get_the_id(); ?>" value="<?php echo $therapist_email; ?>" />
			<input type="hidden" id="seeker_<?php echo get_the_id(); ?>" value="<?php echo $seeker_email; ?>" />
			
	<?php
		if(wp_is_mobile()){ ?>

			<a href="tel:01234567890" id="call_link_<?php echo get_the_id(); ?>" style="pointer-events: none;color:white;">01234 567 890</a>
				
		<?php } ?>
		
	</div>
	<div class="m-1 divider col-12"></div>
</div>
