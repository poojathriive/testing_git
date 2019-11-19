<?php
	$therapists = thriive_get_search_query('post','therapist',get_search_query(),2);
	if ($therapists->have_posts()):
	?>
	<div class="m-1 divider"></div>	
		<section class="search-therapist  w-70">
			<div class="row section text-center">
				<h3 class="w-100 text-center">Therapist</h3>
				<?php
					while ($therapists->have_posts()):$therapists->the_post();
						get_template_part( 'template-parts/content-list-therapist');
					endwhile;
				?>
				<div class="text-center col-12">
					<a href="<?php echo get_site_url(); ?>/therapist/" class="btn secondary-btn mt-3">VIEW ALL</a>
				</div>
			</div>
		</section>
<?php
	endif;
	wp_reset_query();
?>