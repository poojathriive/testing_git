<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package thriive
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="search-top">
				<div class="container">
					<div class="row w-70 section">
						<div class="col-12">
							<?php get_search_form();?>
						</div>
					</div>
				</div>
			</section>

			<?php if ( have_posts() ) : ?>

			<header class="page-header container">
				<div class="row w-70 section">
					<div class="col-12 text-center">
						<h1 class="page-title">
							<?php
							/* translators: %s: search query. */
							printf( '<span>' . get_search_query() . '</span>' );
							?>
						</h1>
					</div>	
				</div>
			</header><!-- .page-header -->
			<div class="container search-result-wrapper">
				<?php 
				get_template_part('template-parts/search/search-result-therapies');
				get_template_part('template-parts/search/search-result-ailments');
				get_template_part('template-parts/search/search-result-events');
				get_template_part('template-parts/search/search-result-therapists');
				get_template_part('template-parts/search/search-result-posts');
				?>
			</div>
			<?php
			else :
			get_template_part( 'template-parts/content', 'none' );
			endif;
		?>
		</main><!-- #main -->
	</section><!-- #primary -->
<?php
//get_sidebar();
get_footer();
?>