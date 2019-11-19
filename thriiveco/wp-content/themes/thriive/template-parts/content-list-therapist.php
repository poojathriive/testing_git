<?php 
	if(is_mobile()) {
		$therapist_image = get_the_post_thumbnail($id = null, 'featured_post_mobile', array('alt' => get_the_title(), 'title'=>get_the_title()));
	} else {
		$therapist_image = get_the_post_thumbnail($id = null, 'thumbnail', array('alt' => get_the_title(), 'title'=>get_the_title())); 
	}
?>
<div class="col-6 mt-4">
	<div class="healer-circle">
		<div class="inner-healer-circle">
		<?php //echo $therapist_image; ?>
		<?php if(is_tax('therapy'))
			{ 
				?>
				<a href="<?php echo $link; ?>">
					<img title="<?php echo $title; ?>" src="<?php echo $image; ?>" alt="<?php echo $title; ?>" >
				</a>
				<?php
			}
			else
			{ ?>
				<a href="<?php echo get_the_permalink(); ?>">
					<?php echo $therapist_image; ?>
				</a>
				<?php
			}
		?>
		</div>
	</div>
	<div class="txt-wrap mt-3">
<!-- 			<h5><?php echo (is_tax('therapy')) ? $title : get_the_title(); ?></h5> -->
			<h5>
				<?php if(is_tax('therapy')) { ?>
					<a href="<?php echo $link; ?>"><?php echo $title; ?></a>
				<?php } else {
					?>
					<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
					<?php
				} 
				?>
			</h5>
			<p class="localtion-wrapper m-0"><?php echo (is_tax('therapy')) ? $location : getTherapistLocation(get_the_id()); ?></p>
			<p class="text-highlight mb-3"><?php echo (is_tax('therapy')) ? $therapist_title : get_field('therapist_title'); ?></p>
			<a href="<?php echo (is_tax('therapy')) ? $link : get_the_permalink(); ?>" class="btn btn-primary">KNOW MORE</a>
	</div>
</div>

