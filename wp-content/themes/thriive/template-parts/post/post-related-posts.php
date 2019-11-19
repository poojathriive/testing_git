<?php
$related_posts = thriive_get_related_content(get_the_ID(),4,'post','category');
if ($related_posts->have_posts()):
?>
	<div class="m-1 divider"></div>
	<section class="related-blogs">
		<div class="container">		
			<div class="row w-70 section justify-content-center">
				<h3 class="w-100 text-center">Recommended for you</h3>
					<div class="">
						<?php 
						while ($related_posts->have_posts()): $related_posts->the_post();
						get_template_part( 'template-parts/post/content-related-post-loop'); 
						endwhile;
						?>
					</div>
			</div>
		</div>
	</section>
<?php
endif;
wp_reset_query();
?>