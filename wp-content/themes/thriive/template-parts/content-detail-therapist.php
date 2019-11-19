<div class="d-flex col-12 col-sm-6 mt-20 wrapper-listing section-wrapper-listing divider-bg">
	<div class="col-sm-6 col-lg-4 wrapper-listing-post ">
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
	<div class="col-sm-6 col-lg-8 txt-wrap ">
		<h3 class=""><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
		<p class="localtion-wrapper m-0"><?php echo getTherapistLocation(get_the_id()); ?></p>
		<p class="wrap-text"><?php echo get_field('therapist_title'); ?></p>
		<a href="<?php echo get_permalink(); ?>" class="btn btn-primary">KNOW MORE</a>
	</div>
</div>