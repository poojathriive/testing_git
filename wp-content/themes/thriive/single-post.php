<?php get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();
			setPostViews(get_the_ID());
			get_template_part( 'template-parts/content', get_post_type() );
		
			//the_post_navigation();
		endwhile; // End of the loop.
		?>
	</main>	
	<?php get_template_part( 'template-parts/post/post-related-posts'); ?>	
	<?php get_template_part('template-parts/post/post-related-therapies');?>
	<?php get_template_part('template-parts/post/post-related-therapists');?>
</div>
<?php get_footer(); ?>