<?php /* Template Name: Search page */ ?>

<?php get_header(); ?>

<section class="search-top">
	<div class="container">
		<div class="w-70">
		<div class="row section">
			<div class="col-12 p-0">
				<?php echo get_search_form(); ?>
			</div>
		</div>
		</div>
	</div>
</section>


<section class="search-page-wrapper  pb-5">
	<div class="container">
		<div class="w-70">
			<div class="row">
				<div class="col-12">
					<?php $popularSearch = get_field('popular_search');
					if($popularSearch): ?>
						<h5>Popular Results</h5>
						<ul class="popular-search-list">
							<?php foreach($popularSearch as $search) { ?>
								<li><a href="<?php echo get_search_link($search['search_keyword']);?>"><?php echo $search['search_keyword']; ?></a></li>
							<?php } ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
			
			<div class="row section ">
				<div class="col-12">
					<?php $popularAilments = get_field('popular_ailments');
					if($popularAilments): ?>
						<h5>Popular Ailments</h5>
						<ul class="popular-search-list">
						<?php foreach($popularAilments as $popularAilment) { ?>
							<li><a href="<?php echo get_term_link($popularAilment->term_id); ?>"><?php echo $popularAilment->name; ?></a></li>
						<?php } ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
			
			<div class="row section ">
				<div class="col-12">
					<?php $popularTherapies = get_field('popular_therapies');
					if($popularTherapies): ?>
						<h5>Popular Therapies</h5>
						<ul class="popular-search-list"> 
						<?php foreach($popularTherapies as $popularTherapy) { ?>
							<li><a href="<?php echo get_term_link($popularTherapy->term_id); ?>"><?php echo $popularTherapy->name; ?></a></li>
						<?php } ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
			
			<div class="row section ">
				<div class="col-12">
					<?php $popularTherapists = get_field('popular_therapists');
					if( $popularTherapists): ?>
						<h5>Popular Therapist</h5>
						<ul class="popular-search-list">
							<?php foreach($popularTherapists as $popularTherapist) { ?>
								<li><a href="<?php echo get_the_permalink($popularTherapist->ID); ?>"><?php echo get_the_title($popularTherapist->ID); ?></a></li>
							<?php } ?>
						</ul>
					<?php endif; ?> 
				</div>
			</div>
			
			<div class="row section ">
				<div class="col-12">
					<?php $popularEvents = get_field('popular_events');
					if( $popularEvents ): ?>
						<h5>Popular Events</h5>
						<ul class="popular-search-list">
							<?php foreach($popularEvents as $popularEvent) { ?>
								<li><a href="<?php echo get_the_permalink($popularEvent->ID); ?>"><?php echo get_the_title($popularEvent->ID); ?></a></li>
							<?php } ?>
						</ul>
					<?php endif; ?>	
				</div>
			</div>
			
			<div class="row section ">
				<div class="col-12">
					<?php $popularBlogs = get_field('popular_blogs');
					if( $popularBlogs ): ?>
						<h5>Popular Blogs</h5>
						<ul class="popular-search-list">
							<?php foreach($popularBlogs as $popularBlog) { ?>
								<li><a href="<?php echo get_the_permalink($popularBlog->ID); ?>"><?php echo get_the_title($popularBlog->ID); ?></a></li>
							<?php } ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>	
		</div>
	</div>
</section>

<?php get_footer(); ?>