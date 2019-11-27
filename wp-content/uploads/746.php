<?php

session_start();

/*

Template Name: Diabetes Specialists

*/



?>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">



	<!-- jQuery library -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



	<!-- Latest compiled JavaScript -->

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<?php get_header(); ?>



	<div id="innerbanner">

		<img class="banner" src="<?php bloginfo('template_url'); ?>/assets/images/finddocbanner.jpg" />

	</div>

	<div class="innercontainer">

		<div id="incontent" class="wrap">

			<div id="main-content" role="main">

				<!-- breadcrumbs -->

				<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">

					<?php if(function_exists('bcn_display'))

    {

        bcn_display();

    }?>

				</div>

				<br/>

				<br/>

				<!-- end breadcrumbs -->

				<?php  $id = get_the_ID();





$result = $wpdb->get_results("select tr.object_id,tr.term_taxonomy_id,t.name, pp.p2p_to,p.post_title from wp_term_relationships as tr join wp_terms as t on t.term_id = tr.term_taxonomy_id   join wp_term_taxonomy as tt on tt.term_taxonomy_id=tr.term_taxonomy_id 

join wp_p2p as pp on pp.p2p_from = tr.object_id

join wp_posts as p on p.ID = pp.p2p_to

where tr.object_id='".$id."' and tt.taxonomy = 'city'  GROUP BY (p.post_title) ");

//print_r($result);





 ?>

				<?php while( have_posts() ): the_post(); ?>

				<article <?php post_class( 'page-article'); ?>>

					<form action="<?php echo get_site_url(); ?>/book-success/" method="post" name="bookApp">

						<div class="diabetes-specialist">

							<div class="row">

								<div class="title-content  col-xs-12">

									<?php

        

		    if ( has_post_thumbnail() && ! post_password_required() ) : ?>

										<div class="thumbnail1 col-md-2 col-xs-4">

											<?php the_post_thumbnail( 'full' ); ?>

										</div>

										<?php endif; ?>

										<div class="title col-xs-8 col-md-10">

											<?php   echo '<h1>'. ucwords(get_the_title()).' '; ?> - <?php echo $designation_custom = get_post_meta( get_the_ID(), 'custom-designation', true ); ?></h1>

											<?php $designation = get_post_meta( get_the_ID(), 'designation', true ); ?>

											<?php if( ! empty( $designation ) ): ?>

											<div class="designation">

												<p>

													<?php echo $designation; ?>

												</p>

											</div>

											<?php endif;?>

											<?php $experience = get_post_meta( get_the_ID(), 'experience', true ); ?>

											<?php if( ! empty( $experience ) ): ?>

											<div class="experience">

												<?php _e( 'Experience', 'firstshow-tekzenit' ); ?>:

												<span>

													<?php echo $experience; ?>

												</span>

											</div>

											<?php endif;?>

											<?php if(get_the_ID()!='363'){ ?>

											<div class="bookapp">



												<a href="#" id="head1" style="margin-top: 5%;padding: 0.8%;" class="btn btn-default" data-toggle="modal" data-target="#myModal">Book An Appointment</a>

											</div>

											<?php }?>



											<div class="sharethis">

										

												<!-- <-?php echo sharethis_inline_buttons(); ?> -->

											</div>





										</div>

								</div>



							</div>

							<hr>

							<div class="row">



								<!--  hidden value for sidebar links      -->



								<input type="hidden" name="sidebar_value" id="sidebar_value" value="true">





								<div class="profile-content col-md-7 col-xs-12">

									<?php the_content(); ?>

								</div>

								<div class="docotor-information col-md-5 col-xs-12">





									<?php $qualification = get_post_meta( get_the_ID(), 'qualification', true ); ?>

									<?php if( ! empty( $qualification ) ): ?>

									<div class="qualification col-xs-12">

										<h4>

											<?php _e( 'Qualification', 'apollo' ); ?>

										</h4>

										<p>

											<?php echo $qualification; ?>

										</p>

									</div>

									<?php endif;?>



									<?php $certification = get_post_meta( get_the_ID(), 'certification_and_membership', true ); ?>

									<?php if( ! empty( $certification ) ): ?>

									<div class="qualification col-xs-12">

										<h4>

											<?php _e( 'Certification & membership', 'apollo' ); ?>

										</h4>

										<p>

											<?php echo $certification; ?>

										</p>

									</div>

									<?php endif;?>



									<?php $awards = get_post_meta( get_the_ID(), 'awards', true ); ?>

									<?php if( ! empty( $awards ) ): ?>

									<div class="qualification col-xs-12">

										<h4>

											<?php _e( 'Awards', 'apollo' ); ?>

										</h4>

										<p>

											<?php echo $awards; ?>

										</p>

									</div>

									<?php endif;?>





									<?php if( ! empty( $specialization ) ): ?>

									<div class="specialization col-xs-12">

										<h4>

											<?php _e( 'Specialization', 'apollo' ); ?>

										</h4>

										<p>

											<?php echo $specialization; ?>

										</p>

									</div>

									<?php endif;?>

									<table>

										<?php

                           // Find connected pages

                          $connected_locations = new WP_Query( array(

                            'connected_type' => 'doctors_to_locations',

                            'connected_items' => get_the_ID(),

                            'nopaging' => true,

                          ) );



                          // Display connected pages

                          if ( $connected_locations->have_posts() ) :

                          ?>

											<tr>

												<th>

													<?php _e( 'Consulting Locations', 'apollo' ); ?>

												</th>

												<th>

													<?php _e( 'Time', 'apollo' ); ?>

												</th>

											</tr>



											<?php $slot = p2p_get_meta( get_post()->p2p_id, 'slot', true ); echo do_shortcode( $slot );?>

											<?php while ( $connected_locations->have_posts() ) : $connected_locations->the_post();  ?>



											<tr>



												<th>

													<?php the_title(); ?>

												</th>

												<td>

													<?php $slot = p2p_get_meta( get_post()->p2p_id, 'slot', true ); echo do_shortcode( $slot );?>

												</td>

											</tr>



											<?php endwhile; ?>









											<?php

                          // Prevent weirdness

                          wp_reset_postdata();



                          endif;

                        ?>





									</table>

									<?php  $doctor_map = get_post_meta( get_the_ID(), 'doctor_map', true ); ?>

									<?php if( ! empty( $doctor_map ) ): ?>

									<iFrame src="<?php echo $doctor_map ?>" width="100%" height="260px" frameborder=”1” scrolling=“ yes” align=“ left”></iFrame>

									<?php endif;?>

								</div>

							</div>

							<?php  $id = get_the_ID(); ?>









							<?php if(get_the_ID()!='363'){ ?>

							<div id="slot1">

								<a href="javascript:void(0);" id="head1" class="btn btn-default" onclick="getSlot(<?php echo $id;?>)">Book An Appointment</a>

							</div>

							<br/>

							<br/>

							<?php } ?>

							<input id="doc_id" type="hidden" name="doctors" value="<?php echo $id;?>">

							<input type="hidden" id="doctors-city" name="city" value="<?php echo $result[0]->name ?>">

							<input type="hidden" id="location1" name="location">

							<input type="hidden" id="location_id" name="postid">

							<input class="form-control" type="hidden" name="pagetittle" value="<?php echo $title =  get_the_title() ? get_the_title() : '';?>">

							<input class="form-control" type="hidden" name="pageurl" value="<?php echo get_permalink();?>">





							<div id="bookform21" style="display:none;">

								<div class="row">

									<div class="col-md-12">

										<div id="head" class="dochead">Personal details</div>

									</div>

								</div>

								<div class="row" style="margin-bottom: 5%;">

									<div class="col-xs-12 col-md-4 fullfrmgrp">

										<div class="form-group">



											<input type="text" placeholder="Select appointment date" id="datepicker" name="bookingdate" required="required">

										</div>

									</div>

									<div class="col-xs-12 col-md-4 fullfrmgrp">

										<div class="form-group">



											<select name="location_bottom" id="doctor-location" class="form-control" required="required">

												<option value="">Select location</option>



												<?php foreach($result as $results){ ?>

												<option myTag="<?php echo $results->p2p_to;?>" value="<?php echo $results->post_title;?>">

													<?php echo $results->post_title;?>

												</option>

												<?php } ?>



											</select>

										</div>

									</div>



									<div class="col-xs-12 col-md-4 fullfrmgrp">

										<div class="form-group">



											<select name="booking_timeslot" id="start_time" class="form-control" required="required">



												<option value="">Select appointment Time</option>



												<?php $times = create_time_range('8:00', '19:30', '15 mins'); 

						for($i=0; $i<count($times); $i++){ ?>

												<option value="<?php echo $times[$i]; ?> ">

													<?php echo $times[$i]; ?> </option>

												<?php } ?>

											</select>

										</div>

									</div>

								</div>



								<div class="row ">



									<div class="col-md-3 col-xs-12 fullfrmgrp">

										<div class="form-group">



											<input type="text" class="form-control" placeholder="Name" id="name" name="uname" required="required">

										</div>

									</div>

									<div class="col-md-3 col-xs-12 fullfrmgrp">

										<div class="form-group">



											<input type="email" class="form-control" placeholder="Email" id="email" name="uemail" required="required">

										</div>

									</div>

									<div class="col-md-3 col-xs-12 fullfrmgrp">

										<div class="form-group">



											<input type="text" class="form-control" placeholder="Phone" id="phone" pattern="[0-9]{10}" maxlength="10" name="uphone" required="required">

										</div>

									</div>

									<div class="col-md-3 col-xs-12">

										<div class="form-group enqbt">

											<button type="submit" name="submit" id="booksubmit" class="button">Book An Appointment</button>

										</div>

									</div>

								</div>







							</div>

						</div>

					</form>

				</article>





				<hr>

				

				<?php

                           // Find connected pages

                          $connected_doctors = new WP_Query( array(

                            'connected_type' => 'testimonials_to_doctors',

                            'connected_items' => get_the_ID(),

                            'nopaging' => true,

                          ) );



                          // Display connected pages

						  if ( $connected_doctors->have_posts() ) :

							

							?>

							<?php

                           // Find connected pages

                          $connected_locations = new WP_Query( array(

                            'connected_type' => 'doctors_to_locations',

                            'connected_items' => get_the_ID(),

                            'nopaging' => true,

                          ) );



                          // Display connected pages

                          if ( $connected_locations->have_posts() ) :

						  ?>

						  <?php while ( $connected_locations->have_posts() ) : $connected_locations->the_post();  ?>

						  

							<h3 class="testihead">Success Story for <?php the_title(); ?> Diabetes Clinics Doctor 

							<?php endwhile; ?>

							<?php

                          // Prevent weirdness

                          wp_reset_postdata();



                          endif;

                        ?>

					<?php echo  get_the_title();?></h3>

						<?php while ( $connected_doctors->have_posts() ) : $connected_doctors->the_post();  ?>

						<div class="row">			

							<div class="col-xs-12 col-md-5">

							<div class="col-md-12  col-xs-12" style="padding-left: 0px;">

										<?php $testi_link = get_post_meta( get_the_ID(), 'testi_link', true ); ?>

										<?php $testi_image = get_post_meta( get_the_ID(), 'testi_image', true ); ?>

										<?php if($testi_link){?>

										<iframe width="700px" height="300px" src="https://www.youtube.com/embed/<?php echo $testi_link;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"

											allowfullscreen></iframe>

										<?php } ?>

										<?php echo $testi_image ?>

									</div>

							</div>

							<div class="col-xs-12 col-md-7">



									<div class="title">

										<b>

											<?php the_title(); ?>

										</b>

									</div>

									<div class="title">

										<?php the_content(); ?>

									</div>

							</div>

							</div>									

					

					<?php endwhile; ?>

				







				<?php

                          // Prevent weirdness

                          wp_reset_postdata();



                          endif;

                        ?>

			</div>

			<?php endwhile; ?>



		</div>



	</div>

	</div>





	<?php

 function create_time_range($start, $end, $interval = '30 mins', $format = '24') {

    $startTime = strtotime($start); 

    $endTime   = strtotime($end);

    $returnTimeFormat = ($format == '12')?'g:i':'G:i';



    $current   = time(); 

    $addTime   = strtotime('+'.$interval, $current); 

    $diff      = $addTime - $current;



    $times = array(); 

    while ($startTime < $endTime) { 

        $times[] = date($returnTimeFormat, $startTime); 

        $startTime += $diff; 

    } 

    $times[] = date($returnTimeFormat, $startTime); 

    return $times; 

}

?>

		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

		<link rel="stylesheet" href="/resources/demos/style.css">

		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>





		<script>

			$(document).ready(function () {



				var doctor_id = $("#doc_id").val();

				//alert(doctor_id);

				$.ajax({

					type: 'POST',

					url: ajax_object.ajaxurl,

					data: {

						doctorid: doctor_id,

						action: 'get_city_docid',

						useSlug: true

					},

					success: function (data) {

						//alert(143);

						var options = $.parseJSON(data);

						var b = JSON.parse(data);

						//alert(options);



						console.log(b.data);

						var data = b.data;

						var html = '';

						for (i = 0; i < data.length; i++) {

							$('#doctors-city').val(data[i].name);

							//	html += '<div id="doctors-city" >'+data[i].name+'</div>';

						}





					}

				});





				// } 

			});



			function getloc(city) {

				$('#city1').val(city);

				//alert(city);

			}

			/*bottom form */

			$('#doctor-location').change(function () {



				var location_name = $('#doctor-location').val();

				$('#location1').val(location_name);

				//alert(location_name);

				var myTag = $('option:selected', this).attr('myTag');



				//alert(myTag);	

				$('#location_id').val(myTag);



				// alert(location_id);





			});







			function getSlot(id) {

				$('#slot1').hide();

				$("#bookform21").show();

				$('#docid').val(id);

				$.ajax({

					type: 'POST',

					url: ajax_object.ajaxurl,



					data: {

						id: id,

						action: 'get_slot',

					},

					success: function (data) {

						//var options = $.parseJSON(data);

						var b = JSON.parse(data);

						//alert(options);

						console.log(b.status);

						console.log(b.data);

						var data = b.data;

						var html = '';



						var html = '';

						html +=

							'<label>Select appointment date</label> <select name="date" class="form-control" id="selected_date" onchange="filtertime()">';

						html += '<option value=""> select date</option>';

						for (i = 0; i < data.length; i++) {

							// alert(options);



							html += '<option value="' + data[i].start_date + '"> ' + data[i].start_date + '</option>';

							// docSelect.append('<option value="' + options[i].name + '"' + selected + '>' + options[i].name + '</option>');

						}

						html += '</select>';

						$('#slot').html(html);

						//$('#slot').html(html);  

					}









				});



			}



			function filtertime() {

				var value = $('#selected_date').val();

				$('#bookingdate').val(value);





				$.ajax({

					type: 'POST',

					url: ajax_object.ajaxurl,



					data: {

						sDate: value,

						action: 'get_time',

					},

					success: function (data) {

						//var options = $.parseJSON(data);

						var b = JSON.parse(data);

						//alert(options);

						console.log(b.status);

						console.log(b.data);

						var data = b.data;

						var html = '';



						html +=

							'<label>Select appointment time</label> <select name="date" class="form-control" id="selected_time" required="required" onchange="book()">';

						if (b.data != null) {

							$('#slotmesg').hide();

							$('#bookform').show();

							html += '<option value=""> select time</option>';



							for (i = 0; i < data.length; i++) {





								html += '<option value="' + data[i].slot + '" > ' + data[i].slot + '</option>';



							}

						} else {

							$('#bookform').hide();

							$('#slot').append('<span id="slotmesg">no time slots available</span>');



						}

						html += '</select>';

						$('#time').html(html);

					}

				});

			}



			function book() {

				//

				var slot_time = $('#selected_time').val();

				//alert(slot_time);

				$('#slot_id').val(slot_time);

				//

				//alert(slot_time)





			}

		</script>







		<!-- Modal -->

		<div id="myModal" class="modal fade" role="dialog">

			<form action="<?php echo get_site_url(); ?>/book-success/" method="post" name="bookApp1">

				<div class="modal-dialog">



					<!-- Modal content-->

					<div class="modal-content">

						<div class="modal-header">

							<button type="button" class="close" data-dismiss="modal">&times;</button>



						</div>

						<div class="modal-body">

							<div class="row">

								<div class="col-md-12">

									<div id="head" class="dochead">Personal details</div>

								</div>

							</div>

							<div class="row" style="margin-bottom: 5%;">

								<div class="col-xs-12 col-md-6">

									<div class="form-group">

										<label>Select appointment date</label>

										<input type="text" id="datePicker2" name="bookingdate" required="required" autocomplete="off">

									</div>

								</div>

								<div class="col-xs-12 col-md-6 ">

									<div class="form-group">

										<label>Select location</label>

										<select name="location1" id="doctor-location1" class="form-control" required="required">

											<option value="">Select location</option>



											<?php foreach($result as $results){ ?>

											<option myTag1="<?php echo $results->p2p_to;?>" value="<?php echo $results->post_title;?>">

												<?php echo $results->post_title;?>

											</option>

											<?php } ?>



										</select>

									</div>

								</div>

								<div class="col-xs-12 col-md-6">

									<div class="form-group">

										<label>Select appointment Time</label>

										<select name="booking_timeslot1" id="start_time" class="form-control" required="required">



											<option value="">Select appointment Time</option>





											<?php $times = create_time_range('8:00', '19:30', '15 mins'); 

								for($i=0; $i<count($times); $i++){ ?>

											<option value="<?php echo $times[$i]; ?> ">

												<?php echo $times[$i]; ?> </option>

											<?php } ?>

										</select>

									</div>

								</div>

							</div>



							<div class="row">



								<div class="col-md-3">

									<div class="form-group">



										<input type="text" class="form-control" placeholder="Name" id="name" name="uname" required="required" autocomplete="off">

									</div>

								</div>

								<div class="col-md-3">

									<div class="form-group">



										<input type="email" class="form-control" placeholder="Email" id="email" name="uemail" required="required" autocomplete="off">

									</div>

								</div>

								<div class="col-md-3">

									<div class="form-group">

										<input class="form-control" type="hidden" name="pagetittle" value="<?php echo $title =  get_the_title() ? get_the_title() : '';?>">

										<input class="form-control" type="hidden" name="pageurl" value="<?php echo get_permalink();?>">



										<input type="text" class="form-control" placeholder="Phone" pattern="[0-9]{10}" maxlength="10" id="phone" name="uphone" required="required"

										    autocomplete="off">

									</div>

								</div>

								<div class="col-md-3 nopad">

									<div class="form-group enqbt">

										<button type="submit" name="submit" id="booksubmit1" class="button">Book An Appointment</button>

									</div>

								</div>

							</div>

							<input id="doc_id" type="hidden" name="doctors" value="<?php echo $id;?>">

							<input type="hidden" id="doctors-city" name="city" value="<?php echo $result[0]->name ?>">

							<input type="hidden" id="location2" name="location">

							<input type="hidden" id="location_id1" name="postid">

							<input class="form-control" type="hidden" name="pagetittle" value="<?php echo $title =  get_the_title() ? get_the_title() : '';?>">

							<input class="form-control" type="hidden" name="pageurl" value="<?php echo get_permalink();?>">

						</div>



			</form>



			</div>



			</div>

		</div>

		<script>

			/*popup form */

			$('#doctor-location1').change(function () {



				var location_name1 = $('#doctor-location1').val();



				$('#location2').val(location_name1);



				var myTag1 = $('option:selected', this).attr('myTag1');



				//alert(myTag);	

				$('#location_id1').val(myTag1);



				// alert(location_id);





			});

			var d = new Date();

			var day = d.getDay();

			//alert(day);

			var nextDay = 2;

			// If day == 1 then it is MOnday

			if (day == 5 || day == 6) {

				nextDay = 3;

			} else {

				nextDay = 2;

			}



			function DisableSundays(date) {

				var day = date.getDay();

				// If day == 1 then it is MOnday

				if (day == 0) {

					return [false];

				} else {

					return [true];

				}

			}



			$('#datePicker,#datePicker2')

				.datepicker({

					format: 'dd/mm/yyyy',

					ignoreReadonly: true,

					allowInputToggle: true,

					minDate: '+0d',

					beforeShowDay: DisableSundays

				})



			$(document).ready(function () {

				var val = $('#sidebar_value').val();

				//alert(val);

				if (val == 'undefined' || val == '' || val == false) {

					$('.social_side_links_all').show();

					$('.social_side_links_doctor').hide();



				} else {



					$('.social_side_links_all').hide();

					$('.social_side_links_doctor').show();

				}



				//console.log( "ready!" );

			});

		</script>

		<script>

			$('#booksubmit').click(function () {



				var date = document.forms["bookApp"]["bookingdate"].value;

				if (date == "") {

					alert("Date must be filled out");

					return false;

				}



				var location2 = document.forms["bookApp"]["location_bottom"].value;

				if (location2 == "") {

					alert("location must be filled out");

					return false;

				}



				var time = document.forms["bookApp"]["booking_timeslot"].value;

				if (time == "") {

					alert("Time must be filled out");

					return false;

				}







				var uname = document.forms["bookApp"]["uname"].value;

				if (uname == "") {

					alert("Name must be filled out");

					return false;

				}

				var uemail = document.forms["bookApp"]["uemail"].value;

				//var uemail = document.getElementById('email');

				var filter =

					/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

				if (!filter.test(uemail)) {

					alert('Please provide a valid email address');

					email.focus;

					return false;

				}

				var uphone = document.forms["bookApp"]["uphone"].value;

				//var uphone = document.getElementById('phone');

				var filter1 = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;

				if (!filter1.test(uphone)) {

					alert('Please provide a valid mobile number');

					phone.focus;

					return false;

				}

				$('.parent_loader').show();

			//	$('#booksubmit').prop("disabled", true);

				

				document.getElementById("bookApp").submit();



			});

		</script>





		<script type='application/ld+json'>

			{

				"@context": "http://www.schema.org",

				"@type": "Service",

				"brand": "Diabetes Clinic",

				"name": "Apollo Sugar Clinic",

				"description": "Apollo Sugar - Empowered with 30 years of Apollo Trust",

				"aggregateRating": {

					"@type": "aggregateRating",

					"ratingValue": "5.0",

					"reviewCount": "300"

				}

			}

		</script>









<script type="application/ld+json">

{

  "@context": "https://schema.org",

  "@type": "Physician",

  "name": "	<?php the_title(); ?>",

  "image": "<?php the_post_thumbnail_url(); ?>",

  "@id": "<?php echo get_permalink();?>",

  "url": "https://apollosugar.com/",

  "telephone": "18001031010",

  "address": {

    "@type": "PostalAddress",

    "streetAddress": "<?php echo $result[0]->name ?>",

    "addressLocality": "<?php echo $result[0]->name ?>",

    "postalCode": "<?php echo $doctor_postalcode = get_post_meta( get_the_ID(), 'doctor_postalcode', true ); ?>",

    "addressCountry": "IN"

  } ,

   "openingHours":["Mo-Sa 8:30-18:30"]},

   "geo": {

    "@type": "GeoCoordinates",

    "latitude":"<?php echo $latitude = get_post_meta( get_the_ID(), 'doctor_latitude', true ); ?>" ,

    "longitude": "<?php echo $longitude = get_post_meta( get_the_ID(), 'doctor_longitude', true ); ?>"

  }

}

</script>

		<?php get_footer(); ?>

		<style>

			.loader {



				position: fixed;

				top: 50%;

				left: 50%;

				transform: translate(-50%, -50%);

				-webkit-transform: translate(-50%, -50%);

				-moz-transform: translate(-50%, -50%);

				-ms-transform: translate(-50%, -50%);

				-o-transform: translate(-50%, -50%);

			}

			.diabetes-specialist .thumbnail1 img {

				height:150px !important;

			}

			button[disabled], html input[disabled] {

  	  background: #bbb !important;

			cursor:not-allowed !important;

			}

			button[disabled], html input[disabled] :hover{

  	  background: #bbb !important;

			cursor:not-allowed !important;

			}

		</style>