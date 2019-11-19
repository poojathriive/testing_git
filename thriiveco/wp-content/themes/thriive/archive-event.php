<?php
get_header();

if (have_rows('banner_slider', 'option')):
    ?>
    <section class="banner mt-4">
        <div class="container">
            <div class="row w-70 text-center">
                <div class="swiper-container single-banner-top">
                    <div class="swiper-wrapper">
						<?php while (have_rows('banner_slider', 'option')): the_row(); 
							$event_banner = get_sub_field('banner_images');
	                    	if(is_mobile()) { 
								$evt_banner = wp_get_attachment_image_src($event_banner, 'home_banner_mobile');
							} else {
								$evt_banner = wp_get_attachment_image_src( $event_banner, 'home_banner' );
							}
						?>
	                        <div class="swiper-slide">
	                            <a href="<?php echo get_sub_field('url'); ?>"><img src="<?php echo $evt_banner[0]; ?>" alt="" ></a>
	                        </div>
						<?php endwhile; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>		
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (have_posts()) : ?>
    <section>
        <div class="conatiner">
            <div class="text-center section w-70 therapy-detail-event-section">
                <h3 class="w-100 mb-3">Trending Events</h3>	
				<p>Check out what's hot in the world of wellness events, workshops & tours.</p>
				<br>
                <div class="swiper-container trading-events-slider">
                    <div class="swiper-wrapper">
                        <?php	
                        while (have_posts()) : the_post();
                            if (get_field("trending_events", get_the_ID())):
                            //echo the_ID();
                                $start_date = get_field("start_date_");
                                $end_date = get_field("end__date");
                                $start_time = get_field("start_time");
                                $end_time = get_field("end_time");
                                $event_venue = get_field("venue");
                                $event_location = get_the_terms( $post->ID,  'location' );
                                $event_facilitator = get_field('facilitator');
                                
                                if (empty($event_facilitator)) {
							        $event_facilitator = get_field('healer');
							        $healers_count = count($event_facilitator);
							        $event_facilitator = $event_facilitator[0]->post_title . ' <span>(+' . $healers_count . ' more)</span>';
							    }
							    
							    //Ignoring past event
							    $get_current_date = date("Y-m-d");
							    $get_start_date = date_create_from_format("F j, Y",get_field("start_date_"));
								$get_start_date = date_format($get_start_date,"Y-m-d");
								$get_end_date = date_create_from_format("F j, Y",get_field("end__date"));
								$get_end_date = date_format($get_end_date,"Y-m-d");
											
			                    if(strtotime($get_start_date) >= strtotime($get_current_date) || strtotime($get_end_date) >= strtotime($get_current_date))
			                    {
				                    ?>
		                                <div class="swiper-slide">
			                                <?php get_template_part( 'template-parts/content-list-event'); ?>	
		                                </div>
	                                <?php
	                            }
                            endif;
                        endwhile;
                        ?>
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

            </div>
        </div>
    </section>
    <div class="mt-3 mb-3 divider"></div>
<?php endif; ?>

<?php
if (have_posts()) :
	$locations = thriive_get_post_filters('location','event');
	$event_locations = array();
	foreach($locations as $location){
		if($location->parent != 0){
			$children = get_terms( $location->taxonomy, array(
				'parent'    => $location->term_id,
				'hide_empty' => false
			) );
			if(empty($children)){
				$inner_arr = array();
				$sub_parent = get_term_by('id',$location->parent,'location');
				$main_parent = get_term_by('id',$sub_parent->parent,'location');
				$inner_arr['slug'] = $location->slug;
				$inner_arr['display'] = $location->name.' - '.$main_parent->name;
				$event_locations[] = $inner_arr;
			} 
		} else {
			$children = get_terms( $location->taxonomy, array(
				'parent'    => $location->term_id,
				'hide_empty' => false
			) );
			if(empty($children)){
				$inner_arr = array();
				$inner_arr['slug'] = $location->slug;
				$inner_arr['display'] = $location->name;
				$event_locations[] = $inner_arr;
			}
		}
	}
    $currentMonth = date('M Y');
    ?>

    <section class="single-calender-section">
        <div class="container">
            <h3 class="w-100 mb-3 text-center"> Calendar </h3>

            <div class="row section w-70">
                <div class="col-6 col-sm-4 mx-sm-auto text-center">
                    <div class="form-group">
                        <select class="form-control select-list-item" id="location-list" name="location_list" onchange="filter_event()">
                            <option value="all">All Location</option>
                            <?php foreach ($event_locations as $event_location) { ?>
                                <option value="<?php echo $event_location['slug']; ?>"><?php echo $event_location['display']; ?></option>
							<?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-6 col-sm-4 mx-sm-auto text-center">
                    <div class="form-group">
	                    <?php $event_start_date = getEventMonths(); ?>
                        <select class="form-control select-list-item" id="month-list" name="location_list" onchange="filter_event()">
	                        <option value="all">All Dates</option>
                            <?php
	                            foreach($event_start_date as $start_date)
	                            {
		                            ?>
		                            	<option value="<?php echo str_replace(" ","-",$start_date); ?>" <?php echo ($currentMonth == $start_date) ? 'selected' : ''; ?>><?php echo $start_date; ?></option>
		                            <?php
	                            }
	                        ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row section w-70" id="event-post"></div>
        </div>
    </section>
	<div class="mt-3 mb-3 divider"></div>
<?php endif; ?>


<section class="d-none">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="email-subscribe-bg">
					<h6>SUBRSCRIBE TO OUR NEWSLETTER</h6>
				</div>
				<div class="col-12 d-flex p-0 col-sm-5 mx-auto mt-4">
					<?php echo do_shortcode('[mc4wp_form id="1808"]'); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>