<?php get_header(); ?>
<!-- <a href="" class="btn btn-primary mt-3" id="therapiest_list_load_more" data-post_id="<?php echo get_the_ID(); ?>">LOAD MORE</a> -->
<?php 

	$tharapist_detail = get_users(array('meta_key' => 'post_id','meta_value' => get_the_id()));
	//echo "<pre>";print_r($tharapist_detail[0]->ID);echo"</pre>";
	
	
	$rfa_therapy = get_the_terms(get_the_id(),'therapy');
	//print_r($rfa_therapy);
	$post_id =  get_the_id();
	$post_name = get_the_title();
	$post_slug = $post->post_name;
	if(have_posts()) :
		while ( have_posts() ) : the_post();

			$healer_image = get_the_post_thumbnail($id = null, 'thumbnail', array('alt' => get_the_title(), 'title'=>get_the_title()));

		$package = get_field("select_package",$post_id);	
		//print_r($package[0]->post_title);
		
		//Count page load		
		$currentPost = get_post_meta(get_the_id());
		$current_count = $currentPost['page_visit'][0];
		$current_count++;
		update_post_meta(get_the_id(), 'page_visit',  $current_count);
		//print_r(count(array_filter($currentPost->page_visit)));
		$postUser = get_users(array('meta_key' => 'post_id', 'meta_value' => $post_id));
?>
<!--
<?php 
	$showconnect = true;
	if (is_user_logged_in())
	{
		$loggedin_userid = get_current_user_id();
		if ($loggedin_userid == $postUser[0]->ID)
			$showconnect = false;
	}

$therapist_id =  $postUser[0]->ID;
	if ($showconnect == true):
?>
<a href="" class="float-fix-block connect_with_btn">CONNECT WITH THE THERAPIST</a>
<?php
	endif;
?>
-->
<header class="">
	<div class="banner-home healer-detail-wrapper">
		<div class="container ">
			
			
			<div class="d-flex col-12 col-sm-12 mt-20 wrapper-listing section-wrapper-listing p-0 flex-wrap therapiest-detail-header">
				<div class=" d-flex flex-wrap col-12 p-0">
				<div class="col-5 col-sm-6 col-lg-5 wrapper-listing-post ">
					<div class="healer-circle mt-3">
						<div class="inner-healer-circle">
							<a href="<?php echo get_permalink(); ?>">
							<?php 
								if(is_mobile()) {
									$healer_image = the_post_thumbnail('featured_post_mobile', array('alt' => get_the_title(), 'title'=>get_the_title())); // echo $healer_image;
								} else {
									$healer_image = the_post_thumbnail('thumbnail', array('alt' => get_the_title(), 'title'=>get_the_title()));
								}
								echo $healer_image;
							?>
							</a>
						</div>
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-mark.png" class="verify-img" alt="">
					</div>
				</div>
				<div class="col-7 col-sm-6 col-lg-7 txt-wrap ">
					<h1 class=""><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h1>
					<p class="m-0 localtion-wrapper"><?php echo get_field('therapist_title'); ?></p>
					<?php if(!empty(get_field('avg_rating'))) { ?>
						<a href="#7">
							<p class="m-0" style="color: #ffc107;">
				        		<?php for($i=1;$i<=get_field('avg_rating');$i++){ ?>
				        			<span class="fa fa-star"></span>
				        		<?php } ?>
				        		<?php $leftstar = 5 - (int)get_field('avg_rating'); ?>
				        		<?php for($i=1;$i<=$leftstar;$i++){ ?>
				        			<span class="fa fa-star-o"></span>
				        		<?php } ?>
			        		</p>
			        	</a>
		        	<?php } ?>
					<?php if(have_rows('therapy')) { ?>
						<p class="m-0">Therapies: 
							<span class="more_therapiest"> 
								<?php 
								$total_count = count(get_field("therapy"));
								$count = 1;
								while( have_rows('therapy') ): the_row();
									$therapy_names = get_sub_field('therapy_name');
									foreach($therapy_names as $therapy_name) {
										echo $therapy_name->name . ($total_count == $count ? '.' : ', ');
										$count++;
									}
								endwhile;
								?>
							</span>
						</p>
						<p class="m-0">Practicing Since:
							<?php
							$therapy_experiences = get_field('therapy');
							$experience_order = array();
							foreach($therapy_experiences as $i=>$therapy_experience) {
								$therapy_experience = new DateTime($therapy_experience['experience']);
								$experience_order [$i] = $therapy_experience->format('Y');
							}
							array_multisort( $experience_order, SORT_ASC, $therapy_experiences );
							$practicing_since = new DateTime($therapy_experiences['0']['experience']);
							echo $practicing_since->format('Y'); 
							?>
						</p>
					<?php } ?>
					<p class=" m-0">Location: <?php echo getTherapistCity(get_the_id()); ?></p>
					
					
					
			<!-- 		<a href="<?php echo get_permalink(); ?>" class="btn btn-primary">KNOW MORE</a> -->
				</div>


<?php 

$therapist_details = get_users(array('meta_key' => 'post_id','meta_value' => get_the_id()));
		$therapist_id = $therapist_details[0]->ID;

$current_user = wp_get_current_user();
		 $seeker_id = $current_user->ID;
		     $seeker_email = $current_user->user_email;
	
		 $seeker_name = $current_user->display_name;
		if(count($current_user->roles) > 1)
		 $role1 =  $current_user->roles[1];
		else
			 $role1 =  $current_user->roles[0];
		
		
			$therapist_email = $therapist_details[0]->data->user_email;
			//echo site_url();
		$msg = $seeker_name ." was trying to contact,when you were offline" ;
		
		if($seeker_id != '')
			$from_status = 1;
		else
		$from_status = 0;	
		$therapist_id = $therapist_details[0]->ID;
	
		 if($role1== "subscriber")
		 {
		$arr = get_user_meta($therapist_id, 'first_name');
		$name = $arr[0];
		 }
	 else
	 {
		 $name = $therepist_data->display_name;
	 }
		
		$therapist_mobile = get_user_meta($therapist_id,'mobile');
			$therapist_countrycde = get_user_meta($therapist_id,'countryCode');
		?>
		<input type="hidden" name = "mobile_<?php echo $therapist_id ?>" id="mobile_<?php echo $therapist_id ?>" value="<?php echo $therapist_mobile[0]; ?>" />
		<input type="hidden" name = "countrycode_<?php echo $therapist_id ?>" id="countrycode_<?php echo $therapist_id ?>" value="<?php echo $therapist_countrycde[0]; ?>" />
		<input type="hidden" name = "msg<?php echo $therapist_id ?>" id="msg_<?php echo $therapist_id ?>" value="<?php echo $msg ?>" />
		<input type="hidden" name = "session_user" id="session_user" value="<?php echo $current_user->ID ?>" />
		

		<?php

		//echo "==".is_user_online($therapist_id);
		$output = '<div class="btn_groups">';
 if(is_user_online($therapist_id))
{
   $to_status = 1;
 }
 else
 {
	  $to_status = 0;
 }
	$url = get_the_post_thumbnail_url( get_the_id(), 'post-thumbnai' );		  
 $output .= '<div id="start_chat_button_'.$therapist_id.'">
<button type="button" class="btn btn-info btn-xs start_chat" data-img ="'.$url.'" data-fromuserid = "'.$seeker_id.'" data-touserid="'.$therapist_id.'" data-tousername="'.$name.'" data-from_status = "'.$from_status.'" data-to_status = "'.$to_status.'" data-mobile="'.$therapist_countrycde[0].$therapist_mobile[0].'" data-msg="'.$msg.'" data-email="'.$therapist_email.'"  data-role="'.$role1.'"><i class="fa fa-comments-o" aria-hidden="true"></i>Chat Now</button></div>';
$output .= '</div>';
		
		?> 
				<div class="chat_bottomBlk">
					<?php
					//if(wp_is_mobile()){
						 ?>
						<a href="" id="call_now_<?php echo get_the_id(); ?>" class="btn btn-primary btn-big call_now_link"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a>				
						<!-- <a href="" id="consult_online_<?php //echo get_the_id(); ?>" class="btn btn-primary btn-big btn-transparent consult_online_link"><i class="fa fa-envelope" aria-hidden="true"></i> Consult Online </a> -->
						<?php
					//}else{
						?>
							<?php 	   if($role1 == 'subscriber' || $role1 =="")
echo $output;

?> 

						<?php
					//}
					?>
				</div>
				<?php 
				$therapist_details = get_users(array('meta_key' => 'post_id','meta_value' => get_the_id()));
					$therapist_email = $therapist_details[0]->data->user_email;
					$current_user = wp_get_current_user();
				    $seeker_email = $current_user->user_email;
					?>
					<input type="hidden" id="therapist_<?php echo get_the_id(); ?>" value="<?php echo $therapist_email; ?>" />
						<input type="hidden" id="seeker_<?php echo get_the_id(); ?>" value="<?php echo $seeker_email; ?>" />
				<?php
				if(wp_is_mobile()){ ?>

					<a href="tel:01234567890" id="call_link_<?php echo get_the_id(); ?>" style="visibility: visible;pointer-events: none;color:white;">01234 567 890</a>

				<?php } ?>

				</div>
				
				
				
			</div>

			

			<div class="row">
				<div class="col-12 text-center">
					<a href="" class="btn share-cta share-event-wrapper mb-3"><i class="icon-new-share p-1"></i>SHARE</a>
					<div class="thriive-social-block social-block-list hide-block mb-3"> 
						
						<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
					</div>
				</div>
				<ul class="detail-menu-top">
					
					<?php if(get_the_content()) { ?>
						<li class="link1"><a href="#1">About</a></li>
					<?php } ?>
					
					<?php $therapies = get_field('therapy',$post_id);  if($therapies) { ?>
						<li class="link2"><a href="#2">Therapy</a></li>	
					<?php } ?>
						
					<?php 
					    $events = getTherapistTrendingEvents($post_id);
					    if($events->have_posts()){ ?>
							<li class="link3"><a href="#3">Events</a></li>
						<?php } 
					?>
					
					<?php
						$therapy_terms = get_the_terms(get_the_id(), 'therapy');
						$therapy_id = array();
						foreach($therapy_terms as $therapy_term)
						{
							$therapy_id[] = $therapy_term->term_id;
						}
						//print_r(explode(",", $therapy_id));
/*
						$args = array(
							'post_type' => 'post',
							'post_status' => 'publish',
							'tax_query' => array(
							    array(
							    	'taxonomy' => 'therapy',
								    'field' => 'term_id',
									'terms' => $therapy_id,
									'operator' 	=> 'IN',
								)
							)
						);
*/
						if(!empty($tharapist_detail))
						{
							$args = array(
						    	'author' => $tharapist_detail[0]->ID, 
						    	//'showposts' => '1', 
						    	'post_type'=> 'post', 
						    	'post_status' => 'publish'
						    );
							$loop = new WP_Query( $args );
							//echo "<pre>";print_r($loop->have_posts());echo"</pre>";
							if($loop->have_posts())
							{
								$therapist_bave_post = 1;
							}
						}
					    
						
						$my_blogs = get_field("my_blogs",$post_id);
						if($therapist_bave_post == 1 || $my_blogs){
					?>
						<li class="link4"><a href="#4">Blog</a></li>
					<?php } ?>
						
					<?php 
						$gallery_images = get_field('gallery',$post_id); 
						$gallery_videos = get_field('videos',$post_id);
						if($gallery_images || $gallery_videos) 
						{ 
							?>
								<li class="link5"><a href="#5">Gallery</a></li>
							<?php 
						} 
					?>
					
					<?php $certificates = get_field('certificates',$post_id);
					if($certificates) {
					?>
						<li class="link6"><a href="#6">Certificates</a></li>
						<?php 
					} ?>
					
					
					<?php if(get_field("first_reference_review", $post_id) != "" || get_field("second_reference_review", $post_id) != "" || get_field("third_reference_review", $post_id) != "") { ?>
						<li class="link7"><a href="#7">Review</a></li>
					<?php } ?>
					
				</ul>
				
			</div>
			
			<?php if(get_the_content()) { ?>
			<div class="row abt-section mt-3" id="1">
				<h2 class="w-100">About</h2>
				<div class="text-justify w-100">
						<div class="abt-more">
		                    <?php //if(is_mobile()){
			                    $count_char = strlen( wp_strip_all_tags(get_the_content()));
// 			                    echo $count_char;
			                    if($count_char > 250){

			                ?>
		                    <div class="excerpt-content-rm showmore-txt-wrapper">
		                    	<?php the_excerpt(); ?>
		                    	<a href="#" class="eclip-more-link">...Show more</a>
		                    </div>
		                    
		                    <div class="readmore-content-wrapper showmore-txt-wrapper">
		                    	<?php echo apply_filters( 'the_content', get_the_content() ); ?>
		                    	<a href="#" class="eclip-more-link">Show less</a>
		                    </div>
		                    <?php }else{ ?>
		                    		<?php echo apply_filters( 'the_content', get_the_content() ); ?>
		                    <?php } ?>	
					</div>
					
<!-- 				<p class="more"><?php echo get_the_content(); ?></p> -->
				</div>
			</div>
			<?php } ?>
			
			
<!--
			<?php $communication_modes = get_field('communication_mode',$post_id); 
				if($communication_modes){
			?>
			<div class="row mt-3 connect-block">
				<ul class="col-12 col-sm-4 mx-auto">	
					<?php foreach($communication_modes as $communication_mode) {?>
					<li class="communication-mode"><a href=""><?php echo $communication_mode ?></a></li>
					<?php } ?>
				</ul>			
			</div>
			<?php } ?>
-->
			
			
		</div>
	</div>
</header>

<div class="m-1 divider"></div>

<?php $therapies = get_field('therapy',$post_id); ?>
	<div><pre><?php //print_r($therapies);?></pre></div>	<?php
	if($therapies) {
	
?>
<section class="section">	
	<div class="container therapy-detail-section" id="2">
		<div class="text-left">
			<h2>Specialities</h2>
		</div>		
		<div class="row text-center section slider-home related-therapies">
			<div class="swiper-container swiper-home-blog w-100">
				<div class="swiper-wrapper">
			<?php 
				foreach($therapies as $key => $therapy)
				{ 
					if(!empty($therapy['therapy_name'])) {
						set_query_var( 'therapy_Exp', $therapy['experience']);
						set_query_var( 'therapy_charge', $therapy['charges']);
						set_query_var( 'therapy_term', $therapy['therapy_name'][0] );
						?><div class="swiper-slide"><?php get_template_part( 'template-parts/content-list-therapies-home');?></div><?php
					}
				}
			?>
				</div>
				
				
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div> 
				
			</div>
<!--
			<div class="row text-center section w-70">
				<a href="/therapies" class="btn secondary-btn big">VIEW ALL</a>				
			</div>
-->
		</div>
	</div>
</section>
<div class="m-1 divider"></div>
<?php }?>


<section class="section transperrent-section therapy-detail-event-section" id="3">
	<?php if($events->have_posts()) { ?>
		<div class="text-center"><h2>Events</h2></div>
		<div class="row text-center section w-70">
			<?php while ( $events->have_posts() ) : $events->the_post();
				get_template_part( 'template-parts/content-list-event');
			endwhile; ?>
		</div>
		<?php if(count($events->query) > 0) { ?>
			<div class="row text-center section w-70">
				<a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn secondary-btn big" id="event_load_more" data-post_type="event" data-post_id="<?php echo get_queried_object_id(); ?>">VIEW ALL</a>	
			</div>
			<div class="m-1 divider"></div>
		<?php } 
	} ?>
</section>




<?php 
if($therapist_bave_post == 1 || $my_blogs){
?>
<section class="section transperrent-section blog-list-section" id="4">
	<div class="container">
	<div class="text-left">
		<h2>Blog by <?php echo get_the_title(); ?></h2>
	</div>
	
	<div class="row text-center section slider-home">
		<div class="swiper-container swiper-home-blog w-100">
			<div class="swiper-wrapper">
		
		<?php
			if($therapist_bave_post == 1)
			{
				$count_num =0;
				if($loop->have_posts()) :
					?>
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<?php get_template_part( 'template-parts/content-list-blog'); ?>
					<?php endwhile; ?>
					<?php 
					wp_reset_query();
				endif;
			}
		?>
		
		</div>
										 
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div> 
										 
		</div>	
		
		<?php
			//$my_blogs = get_field("my_blogs",$post_id);
			if($my_blogs)
			{
				?>
				<div class="swiper-container swiper-home-blog w-100">
				<div class="swiper-wrapper">
				<?php 
				//print_r($postUser[0]->first_name);
				foreach($my_blogs as $my_blog)
				{
					//get_template_part( 'template-parts/content-list-blog');
					?>
					<div class="swiper-slide">
						<div class="col-12 pl-0 pr-2">
							<div class="blog-img-list left-img mb-1">
								<?php echo wp_get_attachment_image($my_blog['blog_image']['ID'],'full'); ?>
							</div>							
							<h5><a href="<?php echo $my_blog['blog_link']; ?>" target="_blank"><?php echo $my_blog['blog_title']; ?></a></h5>
							<?php if(wp_get_current_user()->post_id != $post_id){ ?>
							<p class="text-highlight"><?php echo ucwords($postUser[0]->first_name . ' ' . $postUser[0]->last_name); ?></p>	
							<?php } ?>	
						</div>
					</div>
					<?php				
				}
				?>
				</div>
										 
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div> 
										 
			</div>	
				<?php 
			}
		?>
	</div>
</div>
</section>
<div class="m-1 divider"></div>
<?php 
	} 
?>
<?php 
	//wp_reset_query();
	//endif;
?>

<?php $gallery_images = get_field('gallery',$post_id); //$gallery_videos
if($gallery_images || $gallery_videos) {
?>
<section class="section transperrent-section gallery-section mb-5" id="5">
	<div class="container">
		<h2>Gallery by <?php echo $post_name; ?></h2>
		<?php if($gallery_images) { ?>
			<div class=" section row slider-home ">
				
				<div class="swiper-container swiper-home-blog w-100">
					<div class="swiper-wrapper">
						<?php foreach($gallery_images as $gallery_image){ ?>
					  		<div class="swiper-slide">
							      <?php echo wp_get_attachment_image($gallery_image['images'],"medium"); ?>
							      <h6><?php echo ucwords($gallery_image['gallery_title']); ?></h6>
						      </div>
						<?php }?>
					</div>
				    <!-- Add Arrows -->
				    <div class="swiper-button-next"></div>
				    <div class="swiper-button-prev"></div>
				</div>
			</div>
		<?php } ?>
	</div>
</section>
<div class="m-1 divider"></div>
<?php } ?>



<?php $gallery_videos = get_field('videos',$post_id); //$gallery_videos
if( $gallery_videos) {
?>
<section class="section transperrent-section gallery-section mb-5" id="5">
	<div class="container">
		<h2>Video by <?php echo $post_name; ?></h2>
		<?php if($gallery_videos) { ?>
			<div class=" section row slider-home ">
				
				<div class="swiper-container swiper-home-blog w-100">
					<div class="swiper-wrapper">
						<?php 
							foreach($gallery_videos as $gallery_video)
							{
								?>
									<div class="swiper-slide">
										<?php echo $gallery_video['video_link']; ?>
										<h6><?php echo ucwords($gallery_video['video_title']); ?></h6>
						      		</div>
							  	<?php
							}
						?>
					</div>
				    <!-- Add Arrows -->
				    <div class="swiper-button-next"></div>
				    <div class="swiper-button-prev"></div>
				</div>
			</div>
		<?php } ?>
	</div>
</section>
<div class="m-1 divider"></div>
<?php } ?>




<?php $certificates = get_field('certificates',$post_id);
if($certificates) {
?>
<section class="section transperrent-section slider-home mb-5" id="6">
	<div class="text-left container">
		<h2>Certificates by <?php echo $post_name; ?></h2>
	<div class="text-center row section">
		<div class="swiper-container swiper-home-blog w-100">
			<div class="swiper-wrapper">
		      <?php foreach($certificates as $certificate){
					if(get_post_mime_type($certificate['certificate']) == 'application/pdf')
					{
						?>
				  			<div class="swiper-slide">
							   		<object data="<?php echo wp_get_attachment_url($certificate['certificate']); ?>" type="application/pdf" width="325" height="280" rel="nofollow"></object>
<!-- 							   <a class="d-block" href="<?php echo wp_get_attachment_url($certificate['certificate']); ?>" target="_blank" style="text-decoration: underline">click here to open</a> -->
					      	</div>
						<?php
					}
					else
				  	{
			      		?>
				  			<div class="swiper-slide">
					      		<?php echo wp_get_attachment_image($certificate['certificate'],"medium", false, array("rel" => "nofollow")); ?>
					      	</div>
						<?php 
					}
				}?>
			</div>
		    <!-- Add Arrows -->
		    <div class="swiper-button-next"></div>
		    <div class="swiper-button-prev"></div>
		</div>
	</div>
	</div>
</section>
<div class="m-1 divider"></div>
<?php } ?>

<?php //$user_comments = get_comments (array('post_id'=>$post_id));

	if(get_field("first_reference_review", $post_id) != "" || get_field("second_reference_review", $post_id) != "" || get_field("third_reference_review", $post_id) != "" || have_rows('review_details', $post_id)) { ?>
		<section class="text-center container therapy-detail-review-section mb-5 mt-3" id="7">
		<div class="col-md-6 text-right"><h2>Testimonials</h2></div>
        <div class="col-md-6">
			<a href="<?php echo get_permalink( get_page_by_path( 'review-form' ) ) ?>/<?php echo '?t='.$post_slug;?>" id="add_review" class="btn btn-primary">Write a Review</a>
		</div>
		<div style="clear:both;"></div>
		<div class="text-center section row">
		<div class="swiper-container">
			<div class="swiper-wrapper">
		      <?php
			      if(get_field("first_reference_review", $post_id) != "")
			      {
				      ?>
				      	<div class="swiper-slide">
						    <p>"<?php echo get_field("first_reference_review", $post_id); ?>"</p>
						    <div class="text-highlight"><?php echo get_field("first_reference_name", $post_id); ?></div>
					    </div>
				      <?php
			      }
			      if(get_field("second_reference_review", $post_id) != "")
			      {
				      ?>
				      	<div class="swiper-slide">
						    <p>"<?php echo get_field("second_reference_review", $post_id); ?>"</p>
						    <div class="text-highlight"><?php echo get_field("second_reference_name", $post_id); ?></div>
					    </div>
				      <?php
			      }
			      if(get_field("third_reference_review", $post_id) != "")
			      {
				      ?>
				      	<div class="swiper-slide">
						    <p>"<?php echo get_field("third_reference_review", $post_id); ?>"</p>
						    <div class="text-highlight"><?php echo get_field("third_reference_name", $post_id); ?></div>
						     <!--<ul class="star-rating-list">
						     	<li class="icon-new-star-r fill-star"></li>
						     	<li class="icon-new-star-r fill-star"></li>
						     	<li class="icon-new-star-r fill-star"></li>
						     	<li class="icon-new-star-r"></li>
						     	<li class="icon-new-star-r"></li>
						     </ul>-->
					    </div>
				      <?php
			      }

			      	while ( have_rows('review_details', $post_id) ) : the_row(); ?>
			      		<div class="swiper-slide">
			        		<p>"<?php the_sub_field('review'); ?>"</p>
			        		<p>
			        		<?php for($i=1;$i<=get_sub_field('rating');$i++){ ?>
			        			<span class="fa fa-star"></span>
			        		<?php } ?>
			        		<?php $leftstar = 5 - (int)get_sub_field('rating'); ?>
			        		<?php for($i=1;$i<=$leftstar;$i++){ ?>
			        			<span class="fa fa-star-o"></span>
			        		<?php } ?>
			        		</p>
			        		<div class="text-highlight"><?php echo get_sub_field('by')->display_name; ?></div>
			        	</div>
					<?php endwhile;

			      
		      	/*if($user_comments){
			  		foreach($user_comments as $user_comment){ ?>
				    	<div class="swiper-slide">
					    	<p>"<?php echo $user_comment->comment_content; ?>"</p>
							<div class="text-highlight"><?php echo $user_comment->comment_author; ?></div>
				    	</div>
					<?php }
				}*/
		      ?>
			</div>
			<div class="swiper-pagination"></div>
		    <!-- Add Arrows -->
<!--
		    <div class="swiper-button-next"></div>
		    <div class="swiper-button-prev"></div>
-->

		</div>
		</div>
</section>
<div class="m-1 divider"></div>
<?php } else { ?>
	<section class="text-center container therapy-detail-review-section mb-5 mt-3" id="7">
		<div class="col-md-6 text-right"><h2>Testimonials</h2></div>
        <div class="col-md-6">
			<a href="<?php echo get_permalink( get_page_by_path( 'review-form' ) ) ?>/<?php echo '?t='.$post_slug;?>" id="add_review" class="btn btn-primary">Write a Review</a>
		</div>
	</section>
	<div class="m-1 divider"></div>
<?php } ?>

<?php 
	/* $website_url = get_field('website_url',$post_id);
	$facebook_link = get_field('facebook_url',$post_id);
	$tw_link = get_field('twitter_url',$post_id);
	$instagram_link = get_field('instagram_url',$post_id);
    // $whatsapp_link = get_field('blogspot');
	$linkedin_link = get_field('linkedin_url',$post_id);
	$skype_link = get_field('skype_call',$post_id);
	$youtube = get_field('youtube',$post_id);
	 
if($instagram_link != "" || $facebook_link != "" || $tw_link != "" || $youtube != "" || $linkedin_link != "" || $skype_link != "" ||  $website_url != "" || !empty($postUser[0]->user_email) ) { ?>
<section class="text-center mb-3 mt-5">
	<div class="container">
		<h2>Follow Our Therapist</h2>
		<div class="row">
			<ul class="social-icons-blocks col-12 col-sm-3  mx-auto">	
				<?php if($instagram_link){ ?>
					<li class="social-icon-link insta-link"><a href="<?php echo $instagram_link; ?>" target="_blank"></a></li>
				<?php } ?>			
				<?php if($facebook_link){?>
	                <li class="social-icon-link faceboo-link"><a href="<?php echo $facebook_link; ?>" target="_blank"></a></li>
	            <?php } ?>				
				<?php if($tw_link){ ?>
					<li class="social-icon-link twitter-link"><a href="<?php echo $tw_link; ?>" target="_blank"></a></li>
				<?php } ?>
				<?php if($youtube){ ?>
					<li class="social-icon-link youtube-link"><a href="<?php echo $youtube; ?>" target="_blank"></a></li>
				<?php } ?>	
				<?php if($linkedin_link){ ?>
					<li class="social-icon-link linkedin-link"><a href="<?php echo $linkedin_link; ?>" target="_blank"></a></li>
				<?php } ?>
				<?php if($skype_link){ ?>
					<li class="social-icon-link skype-link"><a href="<?php echo $skype_link;?>" target="_blank"></a></li>
				<?php } ?>
				<?php if($website_url){?>
	                <li class="social-icon-link website-link"><a href="<?php echo generateValidUrl($website_url); ?>" target="_blank"></a></li>
	            <?php } ?>
				<?php if($postUser[0]->user_email){ ?>
					<li class="social-icon-link email-link"><a href="mailto:<?php echo $postUser[0]->user_email; ?>"></a></li>
				<?php } ?>	
							
			</ul>
		</div>
	</div>
</section>
<?php } */?>


<!-- Modal -->
<div class="modal fade" id="connect_with_healer" tabindex="-1" role="dialog" aria-labelledby="connect_with_healer" aria-hidden="true">
  <div class="modal-dialog <?php if (!is_user_logged_in()){ echo "modal-lg"; } ?>" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
	  	
	  	<?php
		  	if (!is_user_logged_in())
		  	{
			  	set_query_var( 'column', 'col-sm-8 col-12');
			  	set_query_var( 'text_left', 'text-left');
			  	set_query_var( 'call_consult' , '1');
			  	get_template_part( 'template-parts/seeker-login-form-modal');
		  	}
		  	else
		  	{
			  	?>
			  		<form data-parsley-validate  class="form-element-section" action="" method="POST">	
					  	<?php wp_nonce_field('connect_with_healer'); ?>
					  	<input name="postId" type="hidden" value="<?php echo get_the_id(); ?>">
				  		<div class="form-group">
							<div class="row  w-70">
								<label for="communication" class="col-12">Communication Mode</label>
									<?php $communication_modes = get_field('communication_mode',$post_id); ?> 
									
									
									<?php foreach($communication_modes as $communication_mode) {?>
									
										<div class="checkbox-wrapper col-6">
										<input type="checkbox" name="communication[]" value="<?php echo $communication_mode ?>" id="<?php echo $communication_mode ?>" data-parsley-multiple="communication" data-parsley-errors-container="#message-holder" required>
										<label for="<?php echo $communication_mode ?>"><?php echo $communication_mode ?></label>
									</div>
									
								<?php } ?>			
									
									<div id="message-holder"></div>
						  	</div>
						</div>	
			        
			         <button type="submit" class="btn btn-primary" name="btnConnectWithHealer" data-dismiss="modal1">SUBMIT</button>
			         
				  	</form>
			  	<?php
		  	}
	  	?>
      </div>

    </div>
  </div>
</div>
<?php
	endwhile;
	endif; 
?>

<?php if (!is_user_logged_in()){ ?>
<div class="modal fade" id="connect_with_healer_login" tabindex="-1" role="dialog" aria-labelledby="connect_with_healer_login" aria-hidden="true">
  <div class="modal-dialog <?php if (!is_user_logged_in()){ echo "modal-lg"; } ?>" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
	  	<?php
		  	set_query_var( 'column', 'col-sm-8 col-12');
		  	set_query_var( 'text_left', 'text-left');
		  	set_query_var( 'call_consult' , '1');
		  	get_template_part( 'template-parts/seeker-login-form-modal');
	  	?>
      </div>
	</div>
  </div>
</div>
<?php } ?>

<div class="ajax-loader">
	 <span style="position: absolute;top: 50%;left: 50%;z-index: 100000000;font-weight:bold;color:#000000;">Loading..</span> 
</div>
	
<div class="modal fade" id="mobile_verfication_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal body -->
        <div class="modal-body">
	        <div class="error-msg form-error" id="mobileExist"></div>
         <form data-parsley-validate class="form-element-section"  id="form_send_otp">
	         <div class="row section col-sm-12 col-12 mx-auto p-0">
<!-- 		        <a href="<?php echo wp_logout_url( '/login/' ); ?>">&times;</a> -->
<!-- 		        <a href="" class="otp-form-close close" data-dismiss="modal">&times;</a> -->
		        <div class="form-group col-12">
				 	<label for="mobile-number">Please enter your mobile number for verification so we can connect you with the Therapist of your choice.</label>
<!-- 				 	<p class="sub-text"></p> -->
				 	<input data-parsley-required="true" type="tel" data-parsley-required-message="Mobile is required." class="form-control international-number" id="mobile-number" value="<?php if($current_user->mobile) { '+' . $current_user->countryCode . $current_user->mobile; } ?>">
			  	</div>
			  	
			  	<button type="submit" class="btn d-inline btn-primary" id="send_otp">SEND OTP</button>
	         </div>
         </form>                  
         <form data-parsley-validate  class="form-element-section" id="mobile_verification">
	         <div class="row section col-sm-12 col-12 mx-auto p-0 d-none" id="div_verify_otp">
			  	
			  	<div class="form-group col-12 ">
				 	<label for="mobile-otp">Enter OTP</label>
				 	<input data-parsley-required="true" type="text" data-parsley-required-message="OTP is required." data-parsley-maxwords="4" class="form-control" id="mobile-otp" id="mobile-otp">
				 	<div class="loading-msg">Loading...</div>
				 	<div class="otp-error"></div>
			  	</div>
			  	<button type="button" class="btn d-inline btn-primary" id="re_send_otp">RESEND OTP</button>
	            <button type="submit" class="btn d-inline btn-primary" id="verify_otp">NEXT</button>
	         </div>
         </form>
        </div>
      </div>
    </div>
  </div>
<?php 
	if(is_user_logged_in())
	{
		$current_user = wp_get_current_user();
		if(($current_user->is_mobile_verify) == 0)
		{
			//echo '<script type="text/javascript">$("#mobile_verfication_modal").modal();</script>';
			//echo $current_user->is_mobile_verify;
		}	
	}
	
	//$healer_details = get_users(array('meta_key' => 'post_id','meta_value' => $input['postId']));
	$healer_details = get_user_meta('post_id',3140);
	
	$healer_details = get_users(array('meta_key' => 'post_id','meta_value' => get_the_id()));
	$healer_data = get_userdata($healer_details[0]->ID);
	
	if(isset($connect_msg) || !empty($connect_msg))
	{
		//$healer_data = get_userdata($healer_id);
		//$healer_username = ucwords(get_user_meta($healer_id, 'first_name', true)) . " " . ucwords(get_user_meta($healer_id, 'last_name', true));
		?>
		<div class="modal fade" id="md_connect_msg" data-backdrop="static" data-keyboard="false">
		    <div class="modal-dialog">
		      <div class="modal-content text-center">
		        <!-- Modal body -->
		        <div class="modal-body w-70">
			    	<p>Thank you for your interest in connecting with our Thriive-verified Therapist <?php echo $healer_data->first_name . ' ' . $healer_data->last_name; ?>. We have sent you an SMS and an email with their details.</p>    
			    	<a href="" class="btn d-inline btn-primary" data-dismiss="modal">Close</a>
		        </div>
		      </div>
		    </div>
		 </div>
		<script>
				$("#md_connect_msg").modal("show");
		</script>
		<?php
	}
?> 
<?php if(isset($rr_msg) || !empty($rr_msg)) { ?>
<div class="modal fade" id="review_msg" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content text-center">
        <!-- Modal body -->
        <div class="modal-body w-70">
	    	<p><?php echo $rr_msg; ?></p>    
	    	<a href="" class="btn d-inline btn-primary" data-dismiss="modal">Close</a>
        </div>
      </div>
    </div>
 </div>
 <script>
		$("#review_msg").modal("show");
</script>
<?php } ?>

<?php get_footer();  ?>