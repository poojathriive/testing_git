<?php
	$events = thriive_get_search_query('post','event',get_search_query(),2);
	if ($events->have_posts()):
	?>
	<div class="m-1 divider"></div>
	
	<section class="search-events  w-70">
		<div class="row section text-center">
			<h3 class="w-100 text-center">Events</h3>
			<?php 
				while ($events->have_posts()):$events->the_post();
					get_template_part( 'template-parts/content-list-event');
				endwhile;
			 ?>
			<div class="text-center col-12">
				<a href="<?php echo get_site_url(); ?>/event/" class="btn secondary-btn mt-3">VIEW ALL</a>
			</div>
		</div>	
	</section>
<?php
	endif;
	wp_reset_query();
?>