<?php
	$therapies = wp_get_post_terms(get_the_ID(), 'therapy');
	if (!empty($therapies)):
	?>
	<div class="m-1 divider"></div>
	<section class="related-therapies ">
		<div class="container">
			<div class="row w-70 section justify-content-center">
				<h3 class="w-100 text-center">Related Therapies</h3>
					<?php 
						foreach ($therapies as $therapy_term):
						set_query_var( 'therapy_term', $therapy_term  );
						get_template_part( 'template-parts/content-list-therapies');
						endforeach;
					?>
			</div>
		</div>
	</section>
<?php
	endif;
?>