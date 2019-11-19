<?php get_header(); ?>	
<script> event_post_id = <?php echo $post->ID; ?></script>


<?php
	$post_id = $post->ID;
if (have_posts()) :
	the_post();
    $event_facilitator = get_field('facilitator');
    $start_date = date('l, d M, Y', strtotime(get_field('start_date_')));
    $start_time = get_field('start_time');
    $end_date = date('l, d M, Y', strtotime(get_field('end__date')));
    $end_time = get_field('end_time');
    $event_date = (!empty($end_time) ? $start_time . ' - ' . $end_time : $start_time . ' Onwards' );
    $event_venue = get_field('venue');
    $event_location = getTherapistLocation($post->ID);
    $event_venue = get_field('venue');
    $event_price = get_field('price');
    $about_facilitator = get_field('about_facilitator');
    $about_organisation = get_field('about_organisation');
    $contact_information = get_field('contact_information');
    $contact_email = get_field('contact_email');
    $contact_number = get_field('contact_number');
    $early_bird_discount = get_field('early_bird_discount');
    $pricing_and_offers = get_field('pricing_and_offers');
    

    if (empty($event_facilitator)) {
        $event_healers = get_field('healer');
        foreach ($event_healers as $event_healer) {
            $healer_arr[] = '<a class="text-highlight"  href= "' . get_permalink($event_healer->ID) . '" >' . $event_healer->post_title . '</a>';
        }
        $event_facilitator = implode(', ', $healer_arr);
    }
    ?>


    <!-- banner_image -->

    <section class="banner mt-3">
        <div class="container">
            <div class="row w-70 text-center">
                <?php
                if (have_rows('banner')):
                    while (have_rows('banner')): the_row();
                    	$event_banner = get_sub_field('banner_image');
                    	if(is_mobile()) { 
							$evt_banner = wp_get_attachment_image_src($event_banner, 'home_banner_mobile');
						} else {
							$evt_banner = wp_get_attachment_image_src( $event_banner, 'home_banner' );
						}
                        ?>
                        <div class="event-banner w-100">
                            <a href="<?php echo the_sub_field('image_url'); ?>"><img title="<?php echo the_title(); ?>" src="<?php echo $evt_banner[0]; ?>" alt="<?php echo the_title(); ?>" ></a>
                        </div>
                        <?php
                    endwhile;
                endif;
                ?>			
                <div class="col-12 p-0 mt-4 single-event-title">
                    <h1 class="m-0"><?php echo the_title(); ?></h1>
                    <?php if ($event_facilitator) {  echo '<span class="text-highlight">With</span> <h3>' . $event_facilitator . '</h3>'; } ?>
                </div>	
            </div>


            <div class="row w-70">

                <?php if (!empty($start_date) || !empty($event_date)) { ?>
                    <div class="col-12 p-0 mb-2">
                        <span class="icon-new-calender_1 icon-event"></span><span class=""><?php echo $start_date . ' - '. $end_date . ' | ' . $event_date; ?></span>
                    </div>
                    <?php
                }

                if ($event_venue) {
                    ?>
                    <div class="col-12 p-0 mb-2">
                        <span class="icon-new-location icon-event"></span> <span class="">
                        	<?php echo $event_venue['address']; ?>
                        </span>
                    </div>
                    <?php
                }

                if ($event_price) {
                    ?>
                    <div class="col-12 p-0 mb-2">
                        <span class="icon-new-rupees icon-event"></span> <span class=""><?php echo $event_price . '/-* Inclusion'; ?></span>
                    </div>
                <?php } 
                
                if ($early_bird_discount) {
                    ?>
                    <div class="col-12 p-0 mb-2">
                        <span class="icon-new-percent icon-event"></span> <span class=""><?php echo 'Early Bird Discounts - '.$early_bird_discount . '%'; ?></span>
                    </div>
                <?php } ?>
                
	                <div class="col-12 p-0 mb-2">
	                	<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
	                </div>
	                
	            <?php    
	                $book_now_link = get_field('book_now_link');
	                if($book_now_link) {
		        ?>
		        		<div class="col-12 p-0 text-center mb-4">
							<a href="<?php echo esc_url($book_now_link); ?>" class="book-now btn btn-primary event-book-now" data-link="<?php echo the_title(); ?>" target="_blank" >Book Now</a>
						</div>
		        <?php
	                }
                ?>
                
          <?php if(get_the_content()) { ?>
	                <div class="col-12">
	                    <h3 class="w-100 text-center">About The Event</h3>
	                    
	                    <div class="abt-more">
		                    <div class="excerpt-content-rm showmore-txt-wrapper">
		                    	<?php the_excerpt(); ?>
		                    	<a href="" class="eclip-more-link">...See More</a>
		                    </div>
		                    
		                    <div class="readmore-content-wrapper showmore-txt-wrapper">
		                    	<?php echo apply_filters( 'the_content', get_the_content() ); ?>
		                    	<a href="" class="eclip-more-link">See less</a>
		                    </div>


	                    </div>
<!-- 	                    <p class="more"><?php echo wp_strip_all_tags(get_the_content()); ?></p> -->
	                </div>
          <?php }?>

            </div>

        </div>
    </section>

    <div class="mt-3 mb-3 divider"></div>

    <?php if ($about_facilitator) { ?>
        <section class="about-facilitator">
            <div class="container">
                <div class="row w-70">
                    <div class="col-12 ">
                        <h3 class="w-100 text-center">About The Facilitator</h3>
                        <p class="more"><?php echo $about_facilitator; ?></p>
                    </div>
                </div>
            </div>
        </section>
        <div class="mt-3 mb-3 divider"></div>
    <?php } ?>

    <?php if ($about_organisation) { ?>
        <section>
            <div class="container">
                <div class="row w-70">
                    <div class="col-12 ">
                        <h3 class="w-100 text-center">About The Organisation</h3>
                        <p class="more"><?php echo $about_organisation; ?></p>
                    </div>

                </div>
            </div>
        </section>
        <div class="mt-3 mb-3 divider"></div>
    <?php } ?>
    
    <?php if ($contact_information || $contact_email || $contact_number) { ?>
        <section>
            <div class="container">
                <div class="row w-70">
                    <div class="col-12 ">
                        <h3 class="w-100 text-center">Contact Information</h3>
                        <p class="more"><?php echo $contact_information; ?></p>
                        <?php if($contact_email) { ?>
	                        <p><a href="mailto:<?php echo $contact_email; ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo $contact_email; ?></a></p>
                        <?php } 
	                        if($contact_number) { 
                        ?>
                        <p><a href="tel:<?php echo $contact_number; ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $contact_number; ?></a></p>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </section>
        <div class="mt-3 mb-3 divider"></div>
    <?php } ?>
    
    <?php if($pricing_and_offers) { ?>
		<section class="about-facilitator">
            <div class="container">
                <div class="row w-70">
                    <div class="col-12 ">
                        <h3 class="w-100 text-center">Pricing & Offers</h3>
                        <p class="more"><?php echo $pricing_and_offers; ?></p>
                    </div>
                </div>
            </div>
        </section>
        <div class="mt-3 mb-3 divider"></div>
	<?php } ?>
    
    <?php if (have_rows('event_gallery')):
        ?>

        <section class="section-image-gallery">
            <div class="container">
                <div class="section gallery-img w-70">
                    <h3 class="w-100 text-center mb-3">Image Gallery</h3>
                    <div class="swiper-container gallery-image-slider mb-3">
                        <div class="swiper-wrapper pb-3">
                            <?php
                            $count = 1;
                            while (have_rows('event_gallery')) : the_row();
                                ?>
                                <div class="swiper-slide mb-3" id="<?php echo $count; ?>">
                                    <img src="<?php the_sub_field('gallery_images'); ?>" alt="">
                                </div>
                                <?php
                                $count++;
                            endwhile;
                            ?>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- holder for the fullscreen slider -->
        <div id="fullscreen-swiper" class="fullscreen-slider"></div>
        <div id="fullscreen-swiper-backdrop"></div>
        <?php
    endif;


    if (have_rows('event_video')):
        ?>

        <section class="section-image-gallery">
            <div class="container">
                <div class="gallery-img w-70 mb-3">
                    <h3 class="w-100 text-center mb-3">Video Gallery</h3>

                    <div class="swiper-container gallery-video-slider mb-3">
                        <div class="swiper-wrapper pb-3">
                            <?php while (have_rows('event_video')) : the_row(); ?>
                                <div class="swiper-slide mb-3 left-img">
                                    <?php the_sub_field('gallery_videos'); ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
        <div class="mt-3 mb-3 divider"></div>
    <?php endif; ?>

	<?php
		//if(is_user_logged_in())
		//{
			?>
				<section>
					<div class="container">
						<div class="row">
							<div class="col-12 mx-sm-auto col-sm-6 text-sm-center d-flex">
								<div class="col-10">
									<h3>Frequently Asked Questions</h3>
								</div>
								<div class="col-2">
									<a href="" data-toggle="modal" data-target="#faq_popup">
										<i class="fa fa-plus fa-3 mt-2" aria-hidden="true"></i>										
									</a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 mt-3 mx-sm-auto col-sm-6">
								<div class="faq-wrapper-form-elm">
									<form data-parsley-validate  class="form-element-section d-flex" action="" method="POST">
										<?php wp_nonce_field('faqQuery'); ?>
										<input type="hidden" value="<?php echo get_the_id(); ?>" name="txtEventID">
										<div class="col-8">
											<div class="form-group">
												<input data-parsley-required="true" data-parsley-required-message="Please add your query." type="text" placeholder="Have any query? Drop your questions here !!" class="form-control" id="event_title" name="txtFAQQuery">
										  </div>
										</div>
										<div class="col-4 my-event-btn">
											<button type="submit" class="btn btn-primary" name="btnFAQSubmit">Submit</button>
										</div>
									</form>
								</div>
								<div class="mt-1 text-center">
									<?php 
										if(isset($_GET['event_query']))
										{
											echo "Your query has been submitted successfully.";
										}
										else
										{
											echo $result; 
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</section>
				<div class="mt-3 mb-3 divider"></div>
			<?php
		//}
	?>
	

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

<!--     <div class="mt-3 mb-3 divider"></div> -->

    <?php
    $location = get_field('venue');

    if (!empty($location)):
        ?>

        <section class="event-map">
            <div class="container">
                <div class="row w-70">
					<h3 class="w-100 text-center">Venue</h3>
                    <div class="event-location">
                        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
                    </div>
                </div>
            </div>
        </section>

        <div class="mt-3 mb-3 divider"></div>
        <?php
    endif;


    $event_terms = get_the_terms($post->ID, 'therapy');
    $event_term = $event_terms[0]->term_id;
    $event_args = array(
        'post_type' => 'event',
        'post__not_in' => array($post->ID),
        'posts_per_page' => '2',
        'tax_query' => array(
            array(
                'taxonomy' => 'therapy',
                'field' => 'term_id',
                'terms' => $event_term,
            )
        ),
    );
    $related_events = new WP_Query($event_args);

    if ($related_events->have_posts()):
        ?>

        <section>
            <div class="conatiner">
                <div class="row text-center section w-70 therapy-detail-event-section">
                    <h3 class="w-100 mb-3">Similar Events</h3>
                    <?php
                    while ($related_events->have_posts()) : $related_events->the_post();
                        $start_time = get_field('start_time');
                        $end_time = get_field('end_time');
                        $event_date = (!empty($end_time) ? $start_time . ' - ' . $end_time : $start_time . ' Onwards' );
                        get_template_part( 'template-parts/content-list-event'); 
                        ?>
<!--
                        <div class="col-6 mb-3">
                            <div class="event-circle">
                                <div class="inner-event-circle">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/img-1.png" alt="">
                                </div>
                            </div>
                            <div class="txt-wrap">
                                <h6 class="mt-3"><?php echo the_title(); ?></h6>
                                <p class="text-highlight"><?php echo 'with ' . get_field('facilitator'); ?></p>
                                <p><?php echo date(' dS M | l', strtotime(get_field('start_date_'))); ?></p>
                                <p><?php echo $event_date; ?></p>
                                <p><?php echo get_field('venue'); ?></p>
                            </div>

                            <div class="mt-3 my-event-btn">
                                <a href="<?php echo get_permalink($related_events->ID); ?>" class="btn btn-primary">KNOW MORE</a>
                            </div>
                        </div>
-->
                    <?php endwhile; ?>
                </div>
                <div class="row text-center section w-70">
                    <a href="" id="similar_events_view_all" class="btn secondary-btn big" data-numposts="2" data-page="1" data-taxonomy="therapy" data-parent="0" data-spage="0">VIEW ALL</a>				
                </div>
            </div>
        </section>

        <div class="mt-3 mb-3 divider"></div>

    <?php endif; ?>


    <script id="similar_events_list" type="text/html">
        <div class="col-6 mb-3">
            <div class="event-circle">
                <div class="inner-event-circle">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/img-1.png" alt="">
                </div>
            </div>
            <div class="txt-wrap">
                <h6 class="mt-3">{{event_title}}</h6>
                <p class="text-highlight">With {{event_facilitator}} </p>
                <p>{{start_date}}</p>
                <p>{{event_date}}</p>
                <p>{{event_venue}}</p>
            </div>
            <div class="mt-3 my-event-btn">
                <a href="{{post_link}}" class="btn btn-primary">KNOW MORE</a>
            </div>
        </div>
    </script>

<?php endif; ?>

<?php
	$faq1 = get_field("faqs",$post_id);
	$faq_type = $faq1['subtype'];
	$faq_url = $faq1['url'];
	
	if($faq_type != "")
    {
	    $object = "";
	    if($faq_type == "image")
	    {
		    $object = "<img src='$faq_url' />";
	    }
	    else if($faq_type == "pdf")
	    {
		    $object = "<object data='$faq_url' type='application/pdf' width='100%' height='450px'>";
            $object .= "If you are unable to view file, you can download from <a href='$faq_url'>here</a>";
            $object .= " or download <a target ='_blank' href ='http://get.adobe.com/reader/'>Adobe PDF Reader</a> to view the file.";
            $object .= "</object>";
	    }
	    else
	    {
		    $object = "If you are unable to view file, you can download from <u><a href='$faq_url'>here</a></u>";
	    }
    }
    else
    {
	    $object = "Coming soon.";
    }	 
?>

<!-- FAQ Modal -->
<div class="modal fade" id="faq_popup">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">    
        <!-- Modal body -->
        <div class="modal-body text-center">
	        <h3>FAQ</h3>
	        <hr/>
	        <div id="faq_pdf"><?php echo $object; ?></div>
        </div>
      </div>
    </div>
 </div>

<?php get_footer(); ?>

<!--
<script type="text/javascript">
	$(document).redy(function(){
		 $(".event-book-now").on("click",function(){
		 	ga('send','event','Event Detial Page', 'BookNow Button', 'Clicked'); 
    	});
	});
</script>
-->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPbylqDnXbqeDKemCI7BOn3wvljG71SE4&libraries=places"></script> -->

<?php
	if(site_url() == 'https://www.thriive.in'){ ?>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPbylqDnXbqeDKemCI7BOn3wvljG71SE4"></script>
<?php } else { ?>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDth79ayfk2Jo-3nzJh_6uirnb4PwQwmAc"></script>
<?php } ?>
