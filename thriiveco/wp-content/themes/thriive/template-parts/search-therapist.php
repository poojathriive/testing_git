<?php $therapist_image = get_the_post_thumbnail(); ?>
<div class="col-6 mt-4">
	<div class="healer-circle">
		<div class="inner-healer-circle">
			<?php echo $therapist_image; ?>
		</div>
	</div>
	<div class="txt-wrap mt-3">
		<?php if(is_tax('therapy')) { ?>
			<h5><?php the_title(); ?></h5>
			<p class="text-highlight"><?php echo $term->name; ?></p>
			<a href="<?php the_permalink(); ?>" class="btn btn-primary">KNOW MORE</a>
		<?php } else { ?>
			<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			<p class="text-highlight mb-0">PLR Therapist</p>
		<?php } ?>
	</div>
</div>

