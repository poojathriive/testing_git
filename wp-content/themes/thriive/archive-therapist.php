<?php get_header(); ?>
<?php session_start(); //echo '<br/>'; //echo $GLOBALS['wp_query']->request; echo '<br/><br/>'; ?>
<?php
	$temp_query = '';
	$only_ailment_selected = $therapy_and_ailment_selected = '';
	if(empty($_GET['therapy']) && !empty($_GET['ailments'])) {
		$only_ailment_selected = 1;
	} else if(!empty($_GET['therapy']) && !empty($_GET['ailments'])) {
		$therapy_and_ailment_selected = 1;
	} 
	if(isset($_GET['area'])){
		$userSelectedArea = $_GET['area'];
		$area = str_replace(' ', '+', $userSelectedArea);
        $request = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$area.'&key=AIzaSyDBb6WcaBBL5-HYKVPtlbVJWuhubj7MxSg'; 
		$file_contents = file_get_contents($request);
		$json_decode = json_decode($file_contents);
		$area = extractFromAdress($json_decode->results[0]->address_components,'sublocality_level_1');
		$city = extractFromAdress($json_decode->results[0]->address_components,'locality');

		$_SESSION['user_latitude'] = $json_decode->results[0]->geometry->location->lat;
		$_SESSION['user_longitude'] = $json_decode->results[0]->geometry->location->lng;
		$_SESSION['user_area'] = $area.', '.$city;
	}
	?>
<?php 
//echo users_online_page();

?>

<header class="">
	<div class="banner-home">
		<div class="container">
			<div class="justify-content-center flex-column text-center">
				<h1>Therapists</h1>
<!--
				<p>Thriive prides itself on curating the best therapist from all corners of the world.<br> Here you can
					find the Healer/Therapist who is just right for you. Connect today!</p>
-->
<!--
				<?php
					if (!is_user_logged_in())
					{
						?>
						<a href="<?php echo get_permalink(272); ?>" class="btn btn-primary">SIGN UP NOW</a>

				<?php
					}
				?>
-->
			</div>
			
			<div class="section text-left">
<!-- 				<p class="mt-3 w-100">To connect with our Therapists</p> -->
				<h4 class="w-100">Select Search filters to be applied</h4>
			</div>

			<div class="therapist-search-form">
				<form action="" class="row filter-therapist">
					<div class="form-group col-sm col-12">
						<div class="row" style="border: 1px solid #ced4da; border-radius: .25rem;">
							<div class="col-sm col-12">
								<input type="text" name="area" id="txtArea" autocomplete="off" class="form-control location" value="<?php if(!empty($userSelectedArea)){echo $userSelectedArea;} ?>" placeholder="Search Location" style="border: none;box-shadow:none">
								<button type="button" id="getlocation" style="float:right;"><i class="" aria-hidden="true"><img src="/wp-content/uploads/2019/icons/location_search.png"></i></button>
								<div id="resultdropdown"></div>
							</div>
						</div>
						<!-- <select class="form-control" id="sel2" name="location">
							<option value="">All Locations</option>

							<?php $locations = get_therapist_location(); 
								  foreach($locations as $location){ 
								  ?>
							<option value="<?php echo $location->slug; ?>"
							<?php if( $_GET['location'] == $location->slug ) { echo 'selected' ; } ?>>
								<?php echo $location->name; ?></option>
							<?php } ?>
						</select> -->
					</div>
					<div class="form-group col-sm col-12 all_therapies">
						<img src = "<?php echo get_stylesheet_directory_uri() ?>/assets/images/loader.gif" class="loader">
						<!-- 							<label for="sel1">Therapy:</label> -->
						<select class="form-control" id="sel1" name="therapy">
							<!-- 							  	<option value="">Therapy</option> -->
							<option value="">All Therapies</option>
							<?php $therapies = thriive_get_post_filters('therapy','therapist',true);
								foreach($therapies as $therapy) {
									$Therapy_name = $therapy->slug;
									//$Therapy_name = str_replace(' ', '-', $therapy->name);
								?>
							<option value="<?php echo $Therapy_name; ?>"
								<?php if( $_GET['therapy'] == $Therapy_name ) { echo 'selected'; } ?>>
								<?php echo $therapy->name; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group col-sm col-12 all_ailments">
					<img src = "<?php echo get_stylesheet_directory_uri() ?>/assets/images/loader.gif" class="loader">
						<select class="form-control" id="sel5" name="ailments">
							<option value="">All Symptoms</option>
							<?php
								$ailments = get_all_ailments();

								foreach($ailments as $a) { ?>
								<option value="<?php echo $a->slug; ?>"
									<?php if( $_GET['ailments'] == $a->slug ) { echo 'selected'; } ?>>
									<?php echo $a->name; ?></option>
								<?php } ?>
						</select>
					</div>
					<div class="text-center form-group col-sm-2 col-12 justify-content-center align-self-center">
						<input type="submit" class="btn btn-primary w-70" value="Search">
					</div>
				</form>
			</div>
			<?php if($_GET['therapy'] || $_GET['location'] || $_GET['ailments'] || $_GET['area']) { ?>
			<p>Search result
			<?php 
				if ($_GET['therapy']) { 
					$therapy_name = get_term_by_slug($_GET['therapy'], 'therapy');
					echo 'for ' . $therapy_name.' '; 
				} 
				if ($_GET['location']) { 
					$loc_name = get_term_by_slug($_GET['location'], 'location');
					echo 'for ' . $loc_name . ' location '; 				} 
				if ($_GET['ailments']) { 
					$ail_name = get_term_by_slug($_GET['ailments'], 'ailment');
					echo 'for ' . $ail_name.' '; 				
				} 
				if ($_GET['area']) { 
					echo 'at ' . $_GET['area']; 				
				} 				
			?>
			</p>
			<?php } ?>
			<!--
			<div class="row section w-70">
				<div class="col-12">
					<?php echo get_search_form(); ?>
				</div>
			</div>	
-->
			<?php
			
			// Custom Query
			// if($only_ailment_selected) {
			// 	search_query_ailment();
			// } else if($therapy_and_ailment_selected) {
			// 	search_query_therapy();
			// } 

			$posts_per_page = 4;
			$start = 0;
			$paged = get_query_var( 'paged') ? get_query_var( 'paged', 1 ) : 1; // Current page number
			$start = ($paged-1)*$posts_per_page;
			if(!empty($_GET['area']) && empty($_GET['therapy']) && empty($_GET['ailments'])) {
				//echo '11111a';
				$user_lat = $_SESSION['user_latitude'];
				$user_long = $_SESSION['user_longitude'];

				$getPost = $wpdb->get_results( 
					"SELECT SQL_CALC_FOUND_ROWS p.ID, (SELECT meta_value FROM wp_postmeta WHERE meta_key='latitude' AND wp_postmeta.post_id = p.ID) AS latitude, (SELECT meta_value FROM wp_postmeta WHERE meta_key='longitude' AND wp_postmeta.post_id = p.ID) AS longitude, (6371 * acos (cos ( radians('$user_lat') ) * cos( radians( (SELECT latitude) ) ) * cos( radians( (SELECT longitude) ) -radians('$user_long') ) + sin ( radians('$user_lat') ) * sin( radians( (SELECT latitude) ) ) ) ) AS distance FROM wp_posts AS p 
					INNER JOIN wp_postmeta AS pm ON p.ID = pm.post_id WHERE 1=1 AND ( pm.meta_key = 'featured_post' ) AND p.post_type = 'therapist' AND (p.post_status = 'publish' OR p.post_status = 'acf-disabled') GROUP BY p.ID HAVING distance < 500 ORDER BY distance LIMIT $start, $posts_per_page"
				);
			} else if((empty($_GET['area']) && !empty($_GET['therapy']) && empty($_GET['ailments'])) || (empty($_GET['area']) && !empty($_GET['therapy']) && !empty($_GET['ailments']))) {
				//echo '222222t_t+a';
				$term = get_term_by( 'slug', $_GET['therapy'], 'therapy');
				$getPost = $wpdb->get_results(
					"SELECT SQL_CALC_FOUND_ROWS wp_posts.ID FROM wp_posts INNER JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) WHERE 1=1 AND ( wp_term_relationships.term_taxonomy_id IN ($term->term_id) ) AND ( wp_postmeta.meta_key = 'featured_post' ) AND wp_posts.post_type = 'therapist' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'acf-disabled') GROUP BY wp_posts.ID ORDER BY wp_postmeta.meta_value DESC, wp_posts.post_title ASC LIMIT $start, $posts_per_page"
				);
			} else if(empty($_GET['area']) && empty($_GET['therapy']) && !empty($_GET['ailments'])) {
				//echo '33333a';
				$term = get_term_by( 'slug', $_GET['ailments'], 'ailment' );
				$term_meta = implode(',',get_term_meta( $term->term_id, 'therapies' )[0]);
				$getPost = $wpdb->get_results(
					"SELECT SQL_CALC_FOUND_ROWS wp_posts.ID FROM wp_posts INNER JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) WHERE 1=1 AND ( wp_term_relationships.term_taxonomy_id IN ($term_meta) ) AND ( wp_postmeta.meta_key = 'featured_post' ) AND wp_posts.post_type = 'therapist' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'acf-disabled') GROUP BY wp_posts.ID ORDER BY wp_postmeta.meta_value DESC, wp_posts.post_title ASC LIMIT $start, $posts_per_page"
				);
			} else if((!empty($_GET['area']) && !empty($_GET['therapy']) && !empty($_GET['ailments'])) OR (!empty($_GET['area']) && !empty($_GET['therapy']) && empty($_GET['ailments']))){
				//echo '444444a+t+a';
				$user_lat = $_SESSION['user_latitude'];
				$user_long = $_SESSION['user_longitude'];
				$term = get_term_by( 'slug', $_GET['therapy'], 'therapy');

				$getPost = $wpdb->get_results( 
					"SELECT SQL_CALC_FOUND_ROWS p.ID, (SELECT meta_value FROM wp_postmeta WHERE meta_key='latitude' AND wp_postmeta.post_id = p.ID) AS latitude, (SELECT meta_value FROM wp_postmeta WHERE meta_key='longitude' AND wp_postmeta.post_id = p.ID) AS longitude, (6371 * acos (cos ( radians('$user_lat') ) * cos( radians( (SELECT latitude) ) ) * cos( radians( (SELECT longitude) ) -radians('$user_long') ) + sin ( radians('$user_lat') ) * sin( radians( (SELECT latitude) ) ) ) ) AS distance FROM wp_posts AS p 
					INNER JOIN wp_postmeta AS pm ON p.ID = pm.post_id  LEFT JOIN wp_term_relationships ON (p.ID = wp_term_relationships.object_id) WHERE 1=1 AND ( wp_term_relationships.term_taxonomy_id IN ($term->term_id) ) AND ( pm.meta_key = 'featured_post' ) AND p.post_type = 'therapist' AND (p.post_status = 'publish' OR p.post_status = 'acf-disabled') GROUP BY p.ID HAVING distance < 500 ORDER BY distance LIMIT $start, $posts_per_page"
				);
			} else if(!empty($_GET['area']) && empty($_GET['therapy']) && !empty($_GET['ailments'])){
				//echo '55555a+a';
				$user_lat = $_SESSION['user_latitude'];
				$user_long = $_SESSION['user_longitude'];
				$term = get_term_by( 'slug', $_GET['ailments'], 'ailment' );
				$term_meta = implode(',',get_term_meta( $term->term_id, 'therapies' )[0]);

				$getPost = $wpdb->get_results( 
					"SELECT SQL_CALC_FOUND_ROWS p.ID, (SELECT meta_value FROM wp_postmeta WHERE meta_key='latitude' AND wp_postmeta.post_id = p.ID) AS latitude, (SELECT meta_value FROM wp_postmeta WHERE meta_key='longitude' AND wp_postmeta.post_id = p.ID) AS longitude, (6371 * acos (cos ( radians('$user_lat') ) * cos( radians( (SELECT latitude) ) ) * cos( radians( (SELECT longitude) ) -radians('$user_long') ) + sin ( radians('$user_lat') ) * sin( radians( (SELECT latitude) ) ) ) ) AS distance FROM wp_posts AS p 
					INNER JOIN wp_postmeta AS pm ON p.ID = pm.post_id  LEFT JOIN wp_term_relationships ON (p.ID = wp_term_relationships.object_id) WHERE 1=1 AND ( wp_term_relationships.term_taxonomy_id IN ($term_meta) ) AND ( pm.meta_key = 'featured_post' ) AND p.post_type = 'therapist' AND (p.post_status = 'publish' OR p.post_status = 'acf-disabled') GROUP BY p.ID HAVING distance < 500 ORDER BY distance LIMIT $start, $posts_per_page LIMIT $start, $posts_per_page"
				);
			} else {
				//echo '66666';
				$getPost = $wpdb->get_results( 
					"SELECT SQL_CALC_FOUND_ROWS wp_posts.ID FROM wp_posts INNER JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) WHERE 1=1 AND ( wp_postmeta.meta_key = 'featured_post' ) AND wp_posts.post_type = 'therapist' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'acf-disabled') GROUP BY wp_posts.ID ORDER BY wp_postmeta.meta_value DESC, wp_posts.post_title ASC LIMIT $start, $posts_per_page"
				);
			}	

			// Loop Start
			if($getPost) : ?>
				<div class="therapist-wrapper section-loop-wrapper row">
					<div class="section_therapies_list therapiest_list col-12 col-sm-8 p-sm-0">
						<?php foreach ( $getPost as $posts ) {
							$post = get_post($posts->ID);
							if($posts->distance){
								$post->distance = round($posts->distance,2).' Km';
							}
							setup_postdata( $post );
					        get_template_part( 'template-parts/content-detail-therapist-listing');
					        }
						wp_reset_postdata();
					?>			
					</div>
					<?php if( have_rows('therapist_content', 'option') ) { ?>
					<div class="col-12 col-sm-4 mt-5 therapist-listing-sidebar">
						<div class="therapist-listing-sidebar-content ">
							<?php 
							while( have_rows('therapist_content', 'option') ): the_row();	
								if(get_sub_field('questions')) {
							?>
									<h3><?php the_sub_field('questions'); ?></h3>
							<?php 
								}
									
								if(get_sub_field('answers')) { ?>
									<p><?php the_sub_field('answers'); ?></p>
							<?php 
								}
							endwhile; 
							?>
						</div>
					</div>
				<?php } ?>

				</div>
				<div class="row text-center section w-70 therapist-pagination">
					<?php 
						$big = 999999999; // need an unlikely integer
						if( ! $paged )
							$paged = get_query_var('paged');
						if( ! $max_page )
							$max_page = $wp_query->max_num_pages;
				
						echo paginate_links( array(
							'base'       => str_replace($big, '%#%', esc_url(get_pagenum_link( $big ))),
							'format'     => '?paged=%#%',
							'current'    => max( 1, $paged ),
							'total'      => $max_page,
							'mid_size'   => 1,
							'prev_text'  => __('«'),
							'next_text'  => __('»'),
							'type'       => 'list'
						) );
					?>
				</div>
<!--
				<div class="row text-center section w-70">
				<?php if( $wp_query->max_num_pages > 1) { ?>
				<a id="therapist_load_more" href="<?php echo get_pagenum_link(2); ?>" data-page-title="THERAPIST"
					data-total-page="<?php echo $wp_query->max_num_pages; ?>" data-next-page-view="2"
					data-current-page-view="1" class="btn secondary-btn big load-more-data">LOAD MORE THERAPIST</a>
				<?php } ?>
				</div>
-->
			<?php 

			// Reset Main Query Object
			if($only_ailment_selected) {
				reset_main_query_object();
			}

			// Loop End
			endif; 			
		?>
		</div>
	</div>
</header>

<!-- Modal -->
<!--<div class="modal fade" id="connect_with_healer" tabindex="-1" role="dialog" aria-labelledby="connect_with_healer" aria-hidden="true">
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
					  	<?php //wp_nonce_field('connect_with_healer'); ?>
					  	<input name="postId" type="hidden" value="<?php echo get_the_id(); ?>">
				  		<div class="form-group">
							<div class="row  w-70">
								<label for="communication" class="col-12">Communication Mode</label>
								<div class="col-12">
									<div class="row" id="communication_mode">

									</div>
								</div>
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
</div>-->

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
	 <span style="position: absolute;top: 50%;left: 48%;z-index: 100000000;font-weight:bold;color:#000000;">Loading..</span> 
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
	
	$healer_details = get_users(array('meta_key' => 'post_id','meta_value' => $connect_post_id));
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
<?php get_footer(); ?>