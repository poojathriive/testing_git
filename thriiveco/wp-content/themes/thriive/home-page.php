<?php /* Template Name: New Home Page */ ?>
<?php get_header(); ?>

<?php $rows = get_field('banner_section'); ?>
<header>
	<div class="container">
		<div class="w-70 text-center">
			<?php if($rows) { ?>
				<div class="row">
					<div class="swiper-container single-banner-top home-page-banner">
						<div class="swiper-wrapper">
						    <?php
						    foreach ($rows as $row) {
						        $file_url = wp_get_attachment_url($row['banner_images']);
						        $filetype = wp_check_filetype($file_url);
						        if (wp_is_mobile() && $filetype['ext'] != 'gif') {
						            $banner_image = wp_get_attachment_image($row['banner_images'], 'home_banner_mobile','', array('alt'=>$row['banner_title'], 'title'=>$row['banner_title']));
						        } else {
						            $banner_image = wp_get_attachment_image($row['banner_images'], 'home_banner','', array('alt'=>$row['banner_title'], 'title'=>$row['banner_title']));
						        }
						        ?>
						        <div class="swiper-slide">
						            <?php if ($row['banner_link']) { ?>
						                <a href="<?php echo $row['banner_link']; ?>">
						                <!-- <img src="<?php echo $row['banner_images']; ?>" alt="" > -->
						                    <?php
						                }
						                echo $banner_image;
						                if ($row['banner_title']) {
						                    ?>
						                    <h5 class="pt-3 pb-3"><?php echo $row['banner_title']; ?></h5>
						                    <?php
						                }
						                if ($row['banner_link']) {
						                    ?>
						                </a>
						            <?php } ?>
						        </div>
						    <?php } ?>
						</div>
					<div class="swiper-pagination"></div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</header>

<div class="container search-result-wrapper">
	<?php $featuredTherapist = get_field('featured_therapists');
	if( $featuredTherapist ): ?>
		<section class="search-therapist  w-70">
			<div class="row section text-center">
				<h3 class="w-100 text-center">Featured Therapists</h3>
				<?php foreach($featuredTherapist as $post) {
					setup_postdata($post);
					get_template_part( 'template-parts/content-list-therapist'); 
				} ?>
				<div class="text-center col-12">
					<a href="<?php echo get_site_url(); ?>/therapist/" class="btn secondary-btn mt-4">VIEW ALL 250+ THERAPISTS</a>
				</div>
				<?php if(!is_user_logged_in()) { ?>
					<div class="col-12">
						<a href="<?php echo get_permalink( get_page_by_path( 'therapist-landing-page' ) ); ?>" class="btn btn btn-primary mt-4"> REGISTER AS A VERIFIED THERAPIST</a>
					</div>
				<?php } ?>
			</div>
		</section>
	<?php endif; 
	wp_reset_query();	 // Restore global post data stomped by the_post(). ?> 
	<div class="m-1 divider"></div>
	
	<?php $trendingEvents = get_field('trending_events');
	if( $trendingEvents ): ?>
		<section class="search-events  w-70">
			<div class="row section text-center">
				<h3 class="w-100 text-center">Trending Events</h3>
				<?php foreach($trendingEvents as $post) {
					setup_postdata($post);
					get_template_part( 'template-parts/content-list-event');
				} ?>
				<div class="text-center col-12">
					<a href="<?php echo get_site_url(); ?>/event/" class="btn secondary-btn mt-3">VIEW ALL EVENTS</a>
				</div>
			</div>	
		</section>
	<?php endif; 
	wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	<div class="m-1 divider"></div>
	
	<?php $featuredTherapy = get_field('featured_therapies');
	if( $featuredTherapy ): ?>
	  	<section class="search-therapies w-70 related-therapies">
			<div class="row section">
				<h3 class="w-100 text-center">Featured Therapies</h3>
				<?php foreach ( $featuredTherapy as $therapy_term ) {
					set_query_var( 'therapy_term', $therapy_term  );
					get_template_part( 'template-parts/content-list-therapies'); 
				} ?>		
				<div class="text-center col-12">
					<a href="<?php echo get_permalink( get_page_by_path( 'therapies' ) ); ?>" class="btn secondary-btn mt-3">VIEW ALL THERAPIES</a>
				</div>
			</div>
		</section>
	<?php endif; 
	wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	<div class="m-1 divider"></div>
	
	<?php $featuredAilments = get_field('featured_ailments'); 
	if($featuredAilments): ?>
		<section class="w-70 connect-healer-section text-center">
			<div class="row section">
				<h3 class="w-100 text-center">Are you facing any of these issues?</h3>
				<?php foreach ( $featuredAilments as $ailment_term ) {
					set_query_var( 'ailment_term', $ailment_term  );
					get_template_part( 'template-parts/content-list-ailment'); 
				} ?>			
				<div class="text-center col-12">
					<a href="<?php echo get_permalink( get_page_by_path( 'ailments-listing' ) ); ?>" class="btn secondary-btn mt-3">VIEW ALL AILMENTS</a>
				</div>	
				<div class="col-12">
					<a href="<?php echo get_site_url() ?>/therapist/" class="btn btn btn-primary mt-3">CONNECT WITH OUR THERAPISTS</a>
				</div>
			</div>
		</section>
	<?php endif; 
	wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	<div class="m-1 divider"></div>
	
	<?php $featuredBlog = get_field('featured_blogs');
	if( $featuredBlog ): ?>
		<section class="search-articles w-70">
			<div class="row  section blog-list-section text-center">
				<h3 class="w-100 text-center mb-4 mt-2">Blogs</h3>
				<?php foreach($featuredBlog as $post) {
					setup_postdata($post);
					get_template_part( 'template-parts/content-list-blog');
				} ?>		
				<div class="text-center col-12">
					<a href="<?php echo get_permalink( get_page_by_path( 'blog' ) ); ?>" class="btn secondary-btn mt-3">VIEW ALL BLOGS</a>
				</div>
			</div>
		</section>
	<?php endif; 
	wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	<div class="m-1 divider"></div>
</div>

<?php get_footer(); ?>