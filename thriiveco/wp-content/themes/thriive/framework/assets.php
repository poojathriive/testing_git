<?php

/**
 * Enqueue scripts and styles.
 */
 
function thriive_scripts() {
	wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', true);
	wp_enqueue_style('swiperslider-css', get_template_directory_uri() . '/assets/css/swiper.min.css', true);
	wp_enqueue_style('fontawosome-css', get_template_directory_uri() . '/assets/css/font-awesome.min.css', true);
	wp_enqueue_style('fontawosome-new-css', get_template_directory_uri() . '/assets/css/font-awesome-new.min.css', true);
	wp_enqueue_style('datepicker-css', get_template_directory_uri() . '/assets/css/jquery-ui.min.css', true);
	wp_enqueue_style('select-2-css', get_template_directory_uri() . '/assets/css/select2.min.css', true);
	wp_enqueue_style('thriive-timepicki', get_template_directory_uri() . '/assets/css/timepicki.css', true);
	wp_enqueue_style('thriive-international-number-css', get_template_directory_uri() . '/build/css/intlTelInput.css', true);
	wp_enqueue_style('common-css', get_template_directory_uri() . '/assets/css/common.css', array(), '20191115.3', false);

	wp_enqueue_style( 'thriive-style', get_stylesheet_uri(),array(), date('YmdHis') );
	wp_enqueue_script('thriive-jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), '20151215', false);

	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('thriive-jquery'), '20151215', false);
	wp_enqueue_script('thriive-typeahead', get_template_directory_uri().'/assets/js/typeahead.js', 'jquery', '', true);
	wp_enqueue_script('swiperslider-swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', array("thriive-jquery"), true);
	wp_enqueue_script('parsley-js', get_template_directory_uri() . '/assets/js/parsley.min.js',array("thriive-jquery"), true);
 	wp_enqueue_script('datepicker-js', get_template_directory_uri() . '/assets/js/jquery-ui.min.js', array("thriive-jquery"), true);
 	wp_enqueue_script('select-2-js', get_template_directory_uri() . '/assets/js/select2.min.js', array("thriive-jquery"), true);
 	wp_enqueue_script('html2canvas', get_template_directory_uri() . '/assets/js/html2canvas.js', array("thriive-jquery"), true);
 	wp_enqueue_script('thriive-international-number-js', get_template_directory_uri().'/build/js/intlTelInput.js', 'jquery', '', true);
 	wp_enqueue_script('slick-js', get_template_directory_uri().'/assets/js/slick.js', 'jquery', '', true);
 	
 	 if(is_home() || is_front_page()){
        wp_enqueue_style('home-css', get_template_directory_uri() . '/assets/css/home.css', true, date('YmdHis'));
    }

 	if(is_page('test') || is_page('therapies')){
	 	wp_enqueue_script('thriive-mustache', get_template_directory_uri().'/assets/js/mustache.min.js', 'jquery', '', true);	
		wp_enqueue_script('thriive-jquery-mustache', get_template_directory_uri().'/assets/js/jquery.mustache.js', 'thriive-mustache', '', true);
		wp_enqueue_script('thriive-therapies', get_template_directory_uri().'/assets/js/therapies.js', 'jquery', '', true);
 	}

 	if(is_page('therapist-registration'))
 	{
 		wp_enqueue_style('jquery-fileupload-css', get_template_directory_uri() . '/lib/file-upload/css/jquery.fileupload.css', true);
 	}
 	
 	if(is_page('therapist-registration'))
 	{
 		wp_enqueue_style('jquery-fileupload-css', get_template_directory_uri() . '/lib/file-upload/css/jquery.fileupload.css', true, date('YmdHis'));
 		// wp_enqueue_style('jquery-fileupload-ui-css', get_template_directory_uri() . '/lib/file-upload/css/jquery.fileupload-ui.css', true);

 		wp_enqueue_script('jquery-ui-widget-js', get_template_directory_uri().'/lib/file-upload/js/vendor/jquery.ui.widget.js', 'jquery', '', true);

 		// wp_enqueue_script('tmpl-js', get_template_directory_uri().'/lib/file-upload/js/tmpl.min.js', 'jquery', '', true);
 		// wp_enqueue_script('load-image-all-js', get_template_directory_uri().'/lib/file-upload/js/load-image.all.min.js', 'jquery', '', true);
 		// wp_enqueue_script('canvas-to-blob-js', get_template_directory_uri().'/lib/file-upload/js/canvas-to-blob.min.js', 'jquery', '', true);

 		wp_enqueue_script('jquery-iframe-transport-js', get_template_directory_uri().'/lib/file-upload/js/jquery.iframe-transport.js', 'jquery', '', true);
 		wp_enqueue_script('jquery-fileupload-js', get_template_directory_uri().'/lib/file-upload/js/jquery.fileupload.js', 'jquery', '', true);
 		// wp_enqueue_script('jquery-fileupload-process-js', get_template_directory_uri().'/lib/file-upload/js/jquery.fileupload-process.js', 'jquery', '', true);
 		// wp_enqueue_script('jquery-fileupload-image-js', get_template_directory_uri().'/lib/file-upload/js/jquery.fileupload-image.js', 'jquery', '', true);
 		// wp_enqueue_script('jquery-fileupload-audio-js', get_template_directory_uri().'/lib/file-upload/js/jquery.fileupload-audio.js', 'jquery', '', true);
 		// wp_enqueue_script('jquery-fileupload-video-js', get_template_directory_uri().'/lib/file-upload/js/jquery.fileupload-video.js', 'jquery', '', true);
 		// wp_enqueue_script('jquery-fileupload-validate-js', get_template_directory_uri().'/lib/file-upload/js/jquery.fileupload-validate.js', 'jquery', '', true);
 		// // wp_enqueue_script('jquery-fileupload-ui-js', get_template_directory_uri().'/lib/file-upload/js/jquery.fileupload-ui.js', 'jquery', '', true);
 		wp_enqueue_script('fileupload-common-js', get_template_directory_uri().'/lib/file-upload/js/common.js', 'jquery',date('YmdHis'), true);
 		// wp_enqueue_script('fileupload-main-js', get_template_directory_uri().'/lib/file-upload/js/main.js', 'jquery', date('YmdHis'), true);
 	}
 	
 	if(is_taxonomy('ailment')){
		wp_enqueue_script('thriive-ailment-therapy', get_template_directory_uri().'/assets/js/therapy-by-ailment-id.js', 'jquery', '', true);
 	}
 	if(is_taxonomy('therapy')){
		wp_enqueue_script('thriive-sub-therapy', get_template_directory_uri().'/assets/js/sub-therapy.js', 'jquery', '', true);
		wp_enqueue_script('thriive-therapy-detail-therapist', get_template_directory_uri().'/assets/js/therapy-detail-therapist.js', 'jquery', '', true);
		wp_enqueue_script('thriive-therapy-deatil-ailment', get_template_directory_uri().'/assets/js/therapy-deatil-ailment.js', 'jquery', '', true);
 	}
 	
 	if(is_archive('therapist')){
	 	 wp_enqueue_script('thriive-waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.js', array(), '20151215', true);
	 	 wp_enqueue_script('thriive-waypoints-sticky', get_template_directory_uri() . '/assets/js/sticky.min.js', array(), '20151215', true);
	 	wp_enqueue_script('thriive-mustache', get_template_directory_uri().'/assets/js/mustache.min.js', 'jquery', '', true);	
		wp_enqueue_script('thriive-jquery-mustache', get_template_directory_uri().'/assets/js/jquery.mustache.js', 'thriive-mustache', '', true);
		wp_enqueue_script('thriive-therapist', get_template_directory_uri().'/assets/js/therapist.js', 'jquery', '', true);
 	}
 	
 	wp_enqueue_script('thriive-timepicki', get_template_directory_uri() . '/assets/js/timepicki.js', array("thriive-jquery"), '2015121522', true);
	wp_enqueue_script('thriive-common', get_template_directory_uri() . '/assets/js/common.js', array("thriive-jquery"),  '20191107', true);
	
	wp_localize_script('thriive-common', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if(is_page('ailments-listing')){
	 	wp_enqueue_script('thriive-mustache', get_template_directory_uri().'/assets/js/mustache.min.js', 'jquery', '', true);	
		wp_enqueue_script('thriive-jquery-mustache', get_template_directory_uri().'/assets/js/jquery.mustache.js', 'thriive-mustache', '', true);
		wp_enqueue_script('thriive-events', get_template_directory_uri().'/assets/js/ailment.js', 'jquery', '', true);
		
 	}

 	if(is_page('therapist') || is_singular('therapist')){
	 	wp_enqueue_script('thriive-therapist', get_template_directory_uri().'/assets/js/therapist.js', 'jquery', '', true);
	}
 	
}
add_action( 'wp_enqueue_scripts', 'thriive_scripts' );
 ?>