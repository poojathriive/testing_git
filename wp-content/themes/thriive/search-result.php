<?php /* Template Name: Search Result page */ ?>

<?php get_header(); ?>

<section class="search-top">
	<div class="container">
		<div class="row w-70 section">
			<div class="col-12">
				<?php //get_search_form(); ?>
				<form class="seachform-section form-element-section" role="search" method="get" >
					<div class="form-group d-flex">
						 <input type="search" placeholder="Search …" value="" name="s" class="form-control" id="event_title">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>


<div class="container search-result-wrapper">
	<section class="search-therapies w-70 related-therapies">
		<div class="row section">
			<h3 class="w-100 text-center">Therapies</h3>
			<?php get_template_part( 'template-parts/content-list-therapies'); ?>			
			<div class="text-center col-12">
				<a href="#" class="btn secondary-btn mt-3">VIEW ALL</a>
			</div>
		</div>
	</section>
	
	<div class="m-1 divider"></div>
	
	<section class="search-therapist  w-70">
		<div class="row section text-center">
			<h3 class="w-100 text-center">Therapist</h3>
			<?php get_template_part( 'template-parts/content-list-therapist'); ?>
			<div class="text-center col-12">
				<a href="#" class="btn secondary-btn mt-3">VIEW ALL</a>
			</div>
		</div>
	</section>
	
	<div class="m-1 divider"></div>
	
	<section class="search-events  w-70">
		<div class="row section text-center">
			<h3 class="w-100 text-center">Events</h3>
			<?php get_template_part( 'template-parts/search-events'); ?>
			<div class="text-center col-12">
				<a href="#" class="btn secondary-btn mt-3">VIEW ALL</a>
			</div>
		</div>	
	</section>
	
	<div class="m-1 divider"></div>
	
	<section class="search-articles w-70">
		<div class="row  section blog-list-section text-center">
			<h3 class="w-100 text-center">Articles</h3>
			<?php get_template_part( 'template-parts/search-articles'); ?>			
			<div class="text-center col-12">
				<a href="#" class="btn secondary-btn mt-3">VIEW ALL</a>
			</div>
		</div>
	</section>
	
	<div class="m-1 divider"></div>
	
</div>





<?php get_footer(); ?>