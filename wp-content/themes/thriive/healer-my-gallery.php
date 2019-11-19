<?php /* Template Name: My Gallery  */ ?>
<?php 
	if (!is_user_logged_in()) { 
		wp_redirect('/login/');
		exit();
	} else {
		$current_user = wp_get_current_user();
		$userPost = get_post($current_user->post_id);
		$package = get_post($userPost->select_package[0]);
	}
?>
<?php get_header(); ?>

<section>
	<div class="container">
		<div class="row section text-center ">	
			<div class="col-12 col-sm-7 d-flex mx-auto">				
				<a href="<?php echo get_site_url() ?>/therapist-account-dashboard" class="back-btn"> &#8826; BACK </a>
			</div>	
			<div class="col-12 col-sm-7 d-flex mx-auto ">
				<h3 class="w-100">My Gallery</h3>
			</div>
			
			<form data-parsley-validate  class="form-element-section" id="add_gallery_image" name="add_gallery_image" action="" method="post" enctype="multipart/form-data">
				<?php wp_nonce_field('add_gallery_image'); ?>
				<div class="col-12 mt-3 my-event-btn">
					<?php 
						if(($userPost->gallery)<($package->number_of_images))
						{
							?>
							<div class="form-group row">							  	
							  	<div class="col-12 form-upload-wrapper">
									<a href="" class="btn btn-upload btn-primary">ADD NEW IMAGE</a>
									<input type="file" id="address-upload" name="gallery_picture" class="fileupload-input" data-parsley-required-message="Select image" required>
									<p class="mt-3">Ideal image size is 300px x 300px and less than 500kb</p>
									<span class="text-show d-block"></span>
							  	</div>	
							  	<div class="col-12 p-0">
									<div class="imagePreview d-inline-block mt-3" style="display: block;"></div>
									<div class="form-group row justify-content-md-center">
									  	<input type="text" name="gallery_title" placeholder="Enter image caption" class="form-control col-md-3" data-parsley-required-message="Enter caption"  data-parsley-errors-container="#galler_error" required>
								  	</div>		
								  	<div id="galler_error"></div>						
									<button type="submit" name="submit_add_image" class="btn btn-primary">Upload</button>
							  	</div>
						  	</div>
							<?php 	
						}
					?>
				</div>
			</form>						
		</div>
	</div>
</section>

<section class="section-image-gallery">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-7 d-flex mx-auto mt-3 p-0 text-left">
				<div class="col-5 col-sm-4">
					<h6>Gallery Images</h6>
				</div>
				<div class="col-5 col-sm-6 p-0 dashboard-therapies-details">
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo calculateProgress($userPost->gallery,$package->number_of_images);?>"aria-valuemin="0" aria-valuemax="100" style="width:<?php echo calculateProgress($userPost->gallery,$package->number_of_images);?>%"></div>
					</div>
					
				</div>
				<div class="col-2">
					<div class="text-center text-highlight"><?php echo (($userPost->gallery ) ? $userPost->gallery :0);?> / <?php echo $package->number_of_images;?></div>
				</div>
				
			</div>
			
		</div>
		<div class="row section gallery-img w-70">
			<?php 
				$imageCount =  (($userPost->gallery ) ? $userPost->gallery :0);
				for ($x = 0; $x < $imageCount; $x++) {
					$keyValue = 'gallery_'.$x.'_images';
					$image = $userPost->$keyValue;
					$keytitle = 'gallery_'.$x.'_gallery_title';
					$title = $userPost->$keytitle;
		  	?>
			<div class="col-6 pl-0 pr-2 mb-3 left-img text-center">
<!-- 				<span class="del-section">x</span> -->
				
				<?php echo wp_get_attachment_image($image);?>
				<h6 class="mt-1"><?php echo $title;?></h6>
				<form data-parsley-validate class="form-element-section" action="" method="post">
					<input type="hidden" value="<?php echo $x; ?>" name="row_index">
					<?php wp_nonce_field('delete_gallery_img'); ?>
					<button type="submit" class="btn d-inline btn-primary" name="btnDeleteGalleryImg">Delete</button>
				</form>
			</div>
			
			<?php 
				}
			?>
			
		</div>
	</div>
</section>
<section class="section-image-gallery">
	<div class="container">
		<div class="row section text-center ">		
			<div class="col-12 mt-3 my-event-btn">
					<?php 
					$allowedVideo =	(($userPost->gallery ) ? $userPost->gallery :0);
					if($allowedVideo < $package->number_of_videos){
					?>
						<button type="button" class="btn btn-primary <?php echo $allowedVideo; ?>" id="btn_add_video">ADD NEW VIDEO</button>
					<?php 	
					}
					?>
			</div>
									
		</div>

		<div class="row ">
			<div class="col-12 col-sm-7 d-flex mx-auto mt-3 p-0 text-left">
				<div class="col-5 col-sm-4">
					<h6>Gallery Videos</h6>
				</div>
				<div class="col-5 col-sm-6 p-0 dashboard-therapies-details">
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo calculateProgress($userPost->videos,$package->number_of_videos);?>"aria-valuemin="0" aria-valuemax="100" style="width:<?php echo calculateProgress($userPost->videos,$package->number_of_videos);?>%"></div>
					</div>
					
				</div>
				<div class="col-2">
					<div class="text-center text-highlight"><?php echo (($userPost->videos ) ? $userPost->videos :0);?> / <?php echo $package->number_of_videos;?></div>
				</div>
				
			</div>
			
		</div>
	
		<div class="row section gallery-img w-70">
			<?php 
				 $videoCount =  (($userPost->videos ) ? $userPost->videos :0);
				for ($x = 0; $x < $videoCount; $x++) {
					$keyValue = 'videos_'.$x.'_video_link';
					$video = $userPost->$keyValue;
					$keytitle = 'videos_'.$x.'_video_title';
					$title = $userPost->$keytitle;
		  	?>
			<div class="col-6 pl-0 pr-2 mb-3 left-img text-center">
				<!-- <span class="del-section">x</span> -->
				
				 <?php echo do_shortcode('[video src='.$video.']') ?>
				<h6 class="mt-1"><?php echo $title; ?></h6>
				<form data-parsley-validate class="form-element-section" action="" method="post">
					<input type="hidden" value="<?php echo $x; ?>" name="row_index">
					<?php wp_nonce_field('delete_video_link'); ?>
					<button type="submit" class="btn d-inline btn-primary" name="delete_video">Delete</button>
				</form>
			</div>
			
			<?php 
				}
			?>
			
		</div>
	</div>
</section>

<div class="modal fade" id="add_video_model">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal body -->
        <div class="modal-body">
         <form data-parsley-validate class="form-element-section"  id="add_video_link" name="add_video_link" action="" method="post">
	         <?php wp_nonce_field('add_video_link'); ?>
	         <div class="row section col-sm-12 col-12 mx-auto p-0">
		        <div class="form-group col-12">
				 	<label for="mobile-number">Enter video link</label>
				 	<input data-parsley-required="true" type="text" 
 data-parsley-required-message="Video link is required." class="form-control" placeholder="Youtube video link" name="video_link" id="video_link" value="">
 					<label for="mobile-number" class="video-title">Enter video Title</label>
				 	<input data-parsley-required="true" type="text" 
 data-parsley-required-message="Video title is required." class="form-control" placeholder="Youtube video title" name="video_title" id="video_title" value="">
			  	</div>
			  	
			  	<button type="button" class="btn d-inline btn-primary" id="btn_cancel">CANCEL</button>
	            <button type="submit" class="btn d-inline btn-primary" id="submit_add_video" name="submit_add_video">SAVE</button>
	         </div>
         </form>                  
        </div>
      </div>
    </div>
  </div>



<?php get_footer(); ?>