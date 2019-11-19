<?php
	$related_therapists = thriive_get_related_content(get_the_ID(),2,'therapist','therapy');
	if ($related_therapists->have_posts()):
	?>
	<div class="m-1 divider"></div>	
	<section class="related-therapist pb-5">
		<div class="container">
			<div class="row w-70 section text-center justify-content-center">
				<h3 class="w-100 text-center">Related Therapist</h3>
				<?php 
					while ($related_therapists->have_posts()):$related_therapists->the_post();
					get_template_part( 'template-parts/content-list-therapist');
					endwhile;
				?>
			</div>
		</div>
	</section>
<?php
	endif;
	wp_reset_query();
?>