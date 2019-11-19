<?php /* Template Name: New Home Page bk */ ?>
<?php get_header(); ?>

<?php $rows = get_field('banner_section'); ?>
<div class="container mr_3_per">
<!--
<header>
	<div class="container-fluid">
		<div class="text-center">
			<?php if($rows) { ?>
				<div class="row">
					<div class="swiper-container single-banner-top home-page-banner">
						<div class="swiper-wrapper">
						    <?php
						    foreach ($rows as $row) {
						        $file_url = wp_get_attachment_url($row['banner_images']);
						        $filetype = wp_check_filetype($file_url);
						        if (wp_is_mobile() && $filetype['ext'] != 'gif') {
						            $banner_image = wp_get_attachment_image($row['banner_images'], 'ful','', array('alt'=>$row['banner_title'], 'title'=>$row['banner_title']));
						        } else {
						            $banner_image = wp_get_attachment_image($row['banner_images'], 'full','', array('alt'=>$row['banner_title'], 'title'=>$row['banner_title']));
						        }
						        ?>
						        <div class="swiper-slide">
						            <?php if ($row['banner_link']) { ?>
						                <a href="<?php echo $row['banner_link']; ?>">
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
-->
<?php echo the_content(); ?>
</div>

<div class="container mb_10_per hidden-lg hidden-md hidden-xl">
    <div class="row">
        <div class="col-xs-6">
            <div class="menu_s">
                <a href="https://www.thriive.in/therapist" target="_blank">
                    <img style="width:100%" alt="Connect With Therapist" title="Connect With Therapist" class="img-responsive" src="<?php echo get_template_directory_uri();?>/assets/images/THRIIVE_MOBILE-WEB-DESIGN-5_03.png" />
                </a>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="menu_s">
                <a href="https://www.thriive.in/therapies" target="_blank">
                    <img alt="Search Therapy" title="Search Therapy" style="width:100%" class="img-responsive" src="<?php echo get_template_directory_uri();?>/assets/images/THRIIVE_MOBILE-WEB-DESIGN-5_07.png" />
                </a>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="menu_s">
                <a href="https://www.thriive.in/ailments-listing" target="_blank">
                    <img alt="Find Cure" title="Find Cure" style="width:100%" class="img-responsive" src="<?php echo get_template_directory_uri();?>/assets/images/THRIIVE_MOBILE-WEB-DESIGN-5_13.png" />
                </a>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="menu_s">
                <a href="https://www.thriive.in/blog" target="_blank">
                    <img alt="Wellness Blog" title="Wellness Blog" style="width:100%" class="img-responsive" src="<?php echo get_template_directory_uri();?>/assets/images/THRIIVE_MOBILE-WEB-DESIGN-5_11.png" />
                </a>
            </div>
        </div>
        
    </div>
</div>

<div class="container search-result-wrapper">
		<?php
			$flexible_content = get_field("flexible_content");
			if($flexible_content)
			{
				foreach($flexible_content as $section)
				{
					if($section['acf_fc_layout'] == 'therapist_widget')
					{
						if(!empty($section['therapist_widget_item']))
						{
							?>
								<section class="search-therapist slider-home">
									<div class="row text-center">
										<h3 class="w-100 text-left"><?php echo $section['therapist_widget_title']; ?></h3>
										<div class="swiper-container swiper-home-blog w-100">
											<div class="swiper-wrapper">
												<?php 
													$i=1;
													foreach($section['therapist_widget_item'] as $post) 
													{
														$sub_title = $post['therapist_subtitle'];
														$post = $post['therapist'][0];
														if($i<=12)
														{
															//setup_postdata($post);
															set_query_var( 'sub_title', $sub_title  );
															?><div class=" swiper-slide swiper-slide-width-170">  <?php get_template_part( 'template-parts/content-list-therapist-home'); ?></div><?php 
															$i++;
														}
													}
												?>
											</div>
										 
											<div class="swiper-button-next hidden-xs"></div>
											<div class="swiper-button-prev hidden-xs"></div> 
										 
										</div>
									</div>
								</section>
								<div class="m-1 divider mt_2_per"></div>
							<?php
							wp_reset_query();
						}
					}
					else if($section['acf_fc_layout'] == 'therapies_widget')
					{
						if(!empty($section['therapies_widget_item']))
						{
							?>
								<section class="search-therapies related-therapies slider-home">
									<div class="row section_therapies">
										<h3 class="w-100 text-left"><?php echo $section['therapies_widget_title']; ?></h3>
										<div class="swiper-container swiper-home-blog w-100">
											<div class="swiper-wrapper">
												<?php 
													$i=1;
													foreach ($section['therapies_widget_item'] as $therapy_term ) 
													{
														$sub_title = $therapy_term['therapy_subtitle'];
														$therapy_term = $therapy_term['therapy'];
														if($i<=12)
														{
															set_query_var( 'sub_title', $sub_title  );
															set_query_var( 'therapy_term', $therapy_term  );
															?><div class="swiper-slide swiper-slide-width-170"> <?php get_template_part( 'template-parts/content-list-therapies-home'); ?></div><?php 
															$i++;
														}
													} 
												?>
											</div>
										 
											<div class="swiper-button-next hidden-xs"></div>
											<div class="swiper-button-prev hidden-xs"></div> 
										 
										</div>	
									</div>
								</section>
								<div class="m-1 divider"></div>
							<?php
							wp_reset_query();
						}
					}
					else if($section['acf_fc_layout'] == 'ailments_widget')
					{
						if(!empty($section['ailments_widget_item']))
						{
							?>
								<section class="connect-healer-section slider-home text-center">
									<div class="row">
										<h3 class="w-100 text-left"><?php echo $section['ailments_widget_title']; ?></h3>
										<div class="swiper-container swiper-home-blog w-100">
											<div class="swiper-wrapper">
											
												<?php 
													$i=1;
													foreach ( $section['ailments_widget_item'] as $ailment_term ) 
													{
														$sub_title = $ailment_term['ailment_subtitle'];
														$ailment_term = $ailment_term['ailment'];
														if($i<=12)
														{
															set_query_var( 'sub_title', $sub_title  );
															set_query_var( 'ailment_term', $ailment_term  );
															?><div class="swiper-slide swiper-slide-width-170"> <?php get_template_part( 'template-parts/content-list-ailment-home'); ?></div><?php 
															$i++;
														}
													} 
												?>			
											</div>
										 
										<div class="swiper-button-next hidden-xs"></div>
										<div class="swiper-button-prev hidden-xs"></div> 
										 
										</div>	
								</section>
								<div class="m-1 divider"></div>
							<?php
							wp_reset_query();
						}
					}
					else if($section['acf_fc_layout'] == 'events_widget')
					{
						if(!empty($section['events']))
						{
							?>
								<section class="search-events">
									<div class="row text-center slider-home">
										<h3 class="w-100 text-left"><?php echo $section['event_widget_title']; ?></h3>
										<div class="swiper-container swiper-home-blog w-100">
											 <div class="swiper-wrapper">
												<?php 
													$i=1;
													foreach($section['events'] as $post) 
													{
														$sub_title = $post['event_subtitle'];
														$post = $post['event'][0];
														if($i<=12)
														{
															set_query_var( 'sub_title', $sub_title  );
															?><div class="swiper-slide swiper-slide-width-170"> <?php get_template_part( 'template-parts/content-list-event-home');?></div><?php	
															$i++;
														}
													} 
												?>	
											</div>
											<div class="swiper-button-next hidden-xs"></div>
											<div class="swiper-button-prev hidden-xs"></div> 
										</div>	
									</div>
								</section>
								<div class="m-1 divider"></div>
							<?php
							wp_reset_query();
						}
					}
					else
					{
						if(!empty($section['custom_widget_item']))
						{
							?>
								<section class="search-therapist slider-home">
									<div class="row text-center">
										<?php
											if(!empty($section['custom_widget_url']))
											{
												?>
												<a href="<?php echo $section['custom_widget_url']; ?>">
													<h3 class="w-100 mt-md-3 text-left"><?php echo $section['custom_widget_title']; ?></h3>
												</a>
												<?php
											}
											else
											{
												?>
													<h3 class="w-100 mt-20 text-left"><?php echo $section['custom_widget_title']; ?> dsgfshytdgjdg </h3>
												<?php
											}
										?>
										<div class="swiper-container swiper-home-blog w-100 modalities_m_content">
											<div class="swiper-wrapper">
												<?php 
													$i=1;
													foreach ($section['custom_widget_item'] as $data ) 
													{
														if($i<=12)
														{
															set_query_var( 'img_id', $data['image'] );
															set_query_var( 'title', $data['title'] );
															set_query_var( 'link', $data['url'] );
															?><div class="swiper-slide swiper-slide-width-170">  <?php get_template_part( 'template-parts/content-list-home-modalities'); ?></div><?php 
															$i++;
															//print_r($data);
														}
													} 
												?>		
											</div>
											<div class="swiper-button-next hidden-xs"></div>
											<div class="swiper-button-prev hidden-xs"></div> 
										</div>
									</div>
								</section>
								<div class="m-1 divider"></div>
							<?php 
						}
						wp_reset_query();
					}
				}
			}
		?>
          
       <?php
			$flexible_content = get_field("flexible_content");
// 			echo "<pre style='display:none;'>";print_r($flexible_content);echo"</pre>";
			if($flexible_content)
			{
                foreach($flexible_content as $section)
				{
					if($section['acf_fc_layout'] == 'blogs_widget')
					{
						if(!empty($section['blogs_widget_item']))
						{?>
                        <section class="all_slider_issues">
                            <h2 class="title-w3 section_title"><?php  echo $section['blog_widget_title'];?></h2>
                            <section class="blogs slider">
                        <?php
                            foreach($section['blogs_widget_item'] as $post) {
                                if($post['blog'][0]){
                                    foreach($post['blog']as $p){?>
                                        <?php if (has_post_thumbnail( $p->ID ) ): ?>
                                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'single-post-thumbnail' ); ?>
                                        <div class="slide news_feed blogs_section">
                                            <img class="blog_img" src="<?php echo $image[0]; ?>">
                                            <a href="<?php echo get_permalink($p->ID); ?>">
                                                <h6 class="text-center blog_title mt-3"><?php echo $p->post_title; ?></h6></a>
                                        </div>
                                        <?php endif; ?>
                                   <?php }
                                }
                            }?>
                                </section>
                            <div class="mb-3 divider divider_bloge" style="margin-top:2%"></div>
                        </section>
                        <div class="clear"></div>
                        <?php
                        }
                    }
                }
            } ?>
                                    
        <section class="all_slider_Therapists news_feed_contect">
            <h2 class="title-w3  section_title mt-3">Media On Us</h2>
            <section class="blogs slider">
                <?php while ( have_rows('news_feed') ) : the_row();?>
                    <div class="slide news_feed">
                        <a href="<?php the_sub_field('news_feed_url'); ?>" target="_blank">
                            <img class="blog_img" src="<?php the_sub_field('news_feed_image'); ?>">
                            <h6 class="text-center blog_title mt-3"><?php the_sub_field('news_feed_title');?></h6>
                        </a>
                    </div>
                <?php endwhile; ?>
            </section>
        </section>
        <div class="mb-3 divider" style="margin-top:2%"></div>
    <div class="clear"></div>
                                    
    <div class="carousel-inner">
        <div class="item carousel-item active">
            <div class="col-12">
				<h3 class="w-100 text-left mb-4 mt-2">Testimonials</h3>
            </div>
            <div class="testmonual_fetch slider">
                <?php while ( have_rows('testimonial') ) : the_row();?>
                    <div class="slide">
                    <div class="testimonial"><?php the_sub_field('description')?>
                        <div class="media">
                        <div class="media-body">
                            <div class="overview">
                                <div class="name"><h6><?php the_sub_field('name')?></h6></div>
                            </div>
                        </div>
                    </div>    
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <div class="clear"></div> 
</div>
    
<script src="http://localhost/thriive_stagging/wp-content/themes/thriive/assets/js/slick.js"></script>
    
<script>
    $(document).ready(function() {
        $('.blogs').slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: false,
            autoplaySpeed: 1500,
            arrows: true,
            dots: false,
            pauseOnHover: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 4
                }
            }, {
                breakpoint: 520,
                settings: {
                    infinite: false,
                    slidesToShow: 2.2,
                    slidesToScroll: 2,
                }
            }]
        });
    });

</script>
    
<script>
    $(document).ready(function() {
        $('.testmonual_fetch').slick({
            slidesToShow: 2,
            slidesToScroll: 2,
            autoplay: false,
            autoplaySpeed: 2500,
            arrows: false,
            dots: false,
            pauseOnHover: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 4
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }]
        });
    });

</script>

<?php get_footer(); ?>