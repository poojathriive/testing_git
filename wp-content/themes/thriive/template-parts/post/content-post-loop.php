<div class="col log-wrapper text-center divider-bg pb-3">
	<?php get_template_part('template-parts/post/content-post-header');?>
	<div class="col-12 mt-3 text-left">
		<?php the_excerpt(); ?>
	</div>	
	<a href="<?php the_permalink();?>" class="btn btn-primary"> READ </a>
</div>