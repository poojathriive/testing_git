<?php /* Template Name: Request for create event page  */ ?>
<?php 
	if (!is_user_logged_in()) { 
		wp_redirect('/login/');
		exit();
	} else {
		$current_user = wp_get_current_user();
		$countries = $wpdb->get_results("SELECT * FROM countries ORDER BY name ASC");
	}
?>
<?php get_header(); ?>

<section class="head-title">
	<div class="container">
		<div class="row text-center">
			<div class="col-12">
				<h1>Request for Event</h1>
				<p>View Thriive Event Guidelines</p>
			</div>
		</div>
		
		<div class="row section col-sm-4 col-12 p-0 mx-auto">
			<form data-parsley-validate  class="form-element-section" id="create_event" name="create_event" action="" method="post" enctype="multipart/form-data">
				<?php wp_nonce_field('nonce_create_event'); ?>
				  <!--<div class="form-group">
			  		<div class="row">
				  		<div class="checkbox-wrapper col-6">
					  		<input type="checkbox" checked="" disabled="">
					  		<label for="centre">Thriive event</label>
				  		</div>
		  			</div>
			     </div>-->		
			    <input type="hidden" name="thriive-event" value="Thriive event">
				<div class="form-group d-flex">
				  <div class="col-8 p-0">
				  	 <label for="event_banner_img">Event Banner Image</label>
				  	 <div class="imagePreview"></div>
				  </div>
				  <div class="col-4 text-right p-0 form-upload-wrapper">
					<a href="" class="btn btn-upload">UPLOAD</a>
					<input type="file" id="event_banner_img" name="event_banner_img" class="fileupload-input">
					<span class="text-show d-block"></span>
				  </div>				  				  
			  </div>
			  
			  <div class="form-group">
			    <label for="event_title">Event Banner Image Url</label>
			    <input type="text"  class="form-control" id="event_banner_img_url" name="event_banner_img_url">
			  </div>				
				
			  <div class="form-group">
			    <label for="event_title">Event Title*</label>
			    <input data-parsley-required="true"  data-parsley-required-message="Event Title is required."  type="text"  class="form-control" id="event_title" name="event_title">
			  </div>
			  
			  <div class="form-group">
			    <label for="facilitator_name">Facilitator’s Name*</label>
			    <input data-parsley-required="true"  data-parsley-required-message="Facilitator’s Name is required."  type="text"  class="form-control" id="facilitator_name" name="facilitator_name">
			  </div>			  
			  
			  <div class="form-group">
			    <label for="start_date">Start Date*</label>
			    <input data-parsley-required="true"  data-parsley-required-message="Start Date is required."  type="text"  class="form-control" id="start_date" name="start_date">
			  </div>
			  
			   <div class="form-group">
			    <label for="end_date">End Date*</label>
			    <input data-parsley-required="true"  data-parsley-required-message="End Date is required."  type="text"  class="form-control" id="end_date" name="end_date">
			  </div>
			  
			  
			   <div class="form-group">
			    <label for="start_time">Start Time*</label>
			    <input data-parsley-required="true"  data-parsley-required-message="Start Time is required."  type="text"  class="form-control timepicker" id="start_time" name="start_time">
			  </div>
			  
			  
			  <div class="form-group">
			    <label for="end_time">End Time*</label>
			    <input data-parsley-required="true"  data-parsley-required-message="End Time is required."  type="text"  class="form-control timepicker" id="end_time" name="end_time">
			  </div>
			  
			  <!--<div class="form-group">
			    <label for="venue_address">Venue Address*</label>
			    <input data-parsley-required="true"  data-parsley-required-message="Venue Address is required."  type="text"  class="form-control" id="venue_address" name="venue_address">
			  </div>-->
			  
				<div class="form-group">
					<label for="country" class="d-block">Country*</label>
					<select class="mb-2 form-control select-list-item select-dropdown-list" id="country" name="country" data-parsley-errors-container="#country_select_error" data-parsley-required-message="Country is required." required>
						<option value="">Select Country</option>
				
				<?php foreach($countries as $key => $value) { ?>
					<option country_id="<?php print_r( $value->id );?>" value="<?php print_r( $value->name );?>"><?php print_r( $value->name );?></option>
				<?php } ?>
					</select>
					<div id="country_select_error"></div>					
				</div>
				
				<div class="form-group">				
					<label for="state" class="d-block">State*</label>
					<select class="mb-2 form-control select-list-item select-dropdown-list" id="state" name="state" data-parsley-errors-container="#state_select_error" data-parsley-required-message="State is required." required>
						<option value="">Select country first</option>
					</select>
					<div id="state_select_error"></div>					
				</div>
				
				<div class="form-group">				
					<label for="city" class="d-block">City*</label>
					<select class="mb-2 form-control select-list-item select-dropdown-list" id="city" name="city" data-parsley-errors-container="#city_select_error" data-parsley-required-message="City is required." required>
						<option value="">Select state first</option>
				</select>
					<div id="city_select_error"></div>
				</div>			  			  			  
			  
			  <div class="form-group">
			    <label for="price">Price</label>
			    <input type="text" class="form-control" id="price" name="price">
			  </div>
			  
			  
			   <div class="form-group">
			    <label for="facebook_url">Facebook URL</label>
			    <input type="text" class="form-control" id="facebook_url" name="facebook_url">
			  </div>
			  
			  <div class="form-group">
			    <label for="instagram_url">Instagram URL</label>
			    <input type="text" class="form-control" id="instagram_url" name="instagram_url">
			  </div>
			  
			  <div class="form-group">
			    <label for="website_url">Website URL</label>
			    <input type="text" class="form-control" id="website_url" name="website_url">
			  </div>
			  
			  
			  <!--<div class="form-group">
			    <label for="therapy">Therapy</label>
			    <input type="text" class="form-control" id="therapy1" name="therapy1">
			  </div>-->
			  
			  <div class="form-group">
				  <label for="therapy">Therapy</label>
			  <?php
				  $therapy_args = array(
					'show_option_all'    => 'Select Therapy',
					'show_option_none'   => '',
					'option_none_value'  => '-1',
					'orderby'            => 'ID',
					'order'              => 'ASC',
					'show_count'         => 0,
					'hide_empty'         => 1,
					'child_of'           => 0,
					'exclude'            => '',
					'include'            => '',
					'echo'               => 1,
					'selected'           => 0,
					'hierarchical'       => 1,
					'name'               => 'therapy',
					'id'                 => 'therapy',
					'class'              => 'mb-2 form-control select-list-item select-dropdown-list',
					'depth'              => 0,
					'tab_index'          => 0,
					'taxonomy'           => 'therapy',
					'hide_if_empty'      => false,
					'value_field'	     => 'term_id',
				);
				wp_dropdown_categories($therapy_args);
			  ?>
			  </div>
			  
			  <div class="form-group">
			    <label for="therapy">Event Description*</label>
			    <textarea rows="4" cols="50" class="form-control" id="therapy" data-parsley-required="true"  data-parsley-required-message="Event Description is required." name="event_description">
			    </textarea>
			  </div>
			  
			  
			  <div class="form-group">
			    <label for="book_now_link">Book Now Link</label>
			    <input type="text" class="form-control" id="book_now_link" name="book_now_link">
			  </div>
			  
			  <div class="form-group">
			    <label for="about_the_facilitator">About The Facilitator</label>
			    <textarea rows="4" cols="50" id="about_the_facilitator" class="form-control" name="about_the_facilitator">
			    </textarea>
			  </div>
			  
			  <div class="form-group">
			    <label for="about_the_organisation">About The Organisation</label>
			    <textarea rows="4" cols="50" id="about_the_organisation" class="form-control" name="about_the_organisation">
			    </textarea>
			  </div>
			  
			  <div class="form-group">
			    <label for="contact_information">Contact Information</label>
			    <textarea rows="4" cols="50" id="contact_information" class="form-control" name="contact_information">
			    </textarea>
			  </div>
			  
			  <div class="mt-4 mb-4 divider"></div>
			  <h3 class="w-100 text-center mb-4">Gallery</h3>
			  
			  <div class="form-group d-flex">
				  <div class="col-8 p-0">
				  	 <label for="gallery_img">Image</label>
				  	 <div class="imagePreview"></div>
				  </div>
				  <div class="col-4 text-right p-0 form-upload-wrapper">
					<a href="" class="btn btn-upload">UPLOAD</a>
					<input type="file" id="gallery_img" name="gallery_img[]" class="fileupload-input" multiple>
					<span class="text-show d-block"></span>
				  </div>				  				  
			  </div>
			  
			  <!--<div class="form-group d-flex">
				  <div class="col-8 p-0">
				  	 <label for="gallery_video">Video</label>
				  	 <div class="imagePreview"></div>
				  </div>
				  <div class="col-4 text-right p-0 form-upload-wrapper">
					<a href="" class="btn btn-upload">UPLOAD</a>
					<input type="file" id="gallery_video" name="gallery_video" class="fileupload-input" >
					<span class="text-show d-block"></span>
				  </div>				  				  
			  </div>-->
			  
			  <div class="form-group">
			    <label for="book_now_link">Video Url</label>
			    <input type="text" class="form-control" id="gallery_video" name="gallery_video">
			  </div>
			  
			  
			  <div class="form-group">
			    <label for="google_map_url">Google Map URL*</label>
			    <input data-parsley-required="true"  data-parsley-required-message="Google Map URL is required." type="text" class="form-control" id="google_map_url" name="google_map_url">
			  </div>
			  
			  <div class="form-group d-flex">
				  <div class="col-8 p-0">
				  	 <label for="FAQs_img">FAQs</label>
				  	 <div class="imagePreview"></div>
				  </div>
				  <div class="col-4 text-right p-0 form-upload-wrapper">
					<a href="" class="btn btn-upload">UPLOAD</a>
					<input type="file" id="FAQs_img" name="FAQs_img" class="fileupload-input">
					<span class="text-show d-block"></span>
				  </div>				  				  
			  </div>
			  
			  <div class="form-group d-flex">
				  <div class="col-8 p-0">
				  	 <label for="terms_conditions">Terms & Conditions</label>
				  	 <div class="imagePreview"></div>
				  </div>
				  <div class="col-4 text-right p-0 form-upload-wrapper">
					<a href="" class="btn btn-upload">UPLOAD</a>
					<input type="file" id="terms_conditions" name="terms_conditions" class="fileupload-input">
					<span class="text-show d-block"></span>
				  </div>				  				  
			  </div>
			  
			  <button type="submit" class="btn btn-primary" name="submit_create_event">Submit</button>
			</form>
		</div>	

		
	</div>
</section>


<?php get_footer(); ?>