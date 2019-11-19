<?php
	$posts_query = thriive_get_search_query('post','post',get_search_query(),2);
	if ($posts_query->have_posts()):
	?>
	<div class="m-1 divider"></div>
	<section class="search-articles w-70">
		<div class="row  section blog-list-section text-center">
			<h3 class="w-100 text-center">Blogs</h3>
			<?php 
				while ($posts_query->have_posts()):$posts_query->the_post();	
					get_template_part( 'template-parts/content-list-blog'); 
				endwhile;
			?>			
			<div class="text-center col-12">
				<a href="<?php echo get_site_url(); ?>/blog/" class="btn secondary-btn mt-3">VIEW ALL</a>
			</div>
		</div>
	</section>
<?php
	endif;
?>