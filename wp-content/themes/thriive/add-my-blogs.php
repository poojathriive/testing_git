<?php /* Template Name: add my blog page  */ ?>
<?php
	if (!is_user_logged_in()) 
	{ 
		wp_redirect('/login/');
		exit();
	} 
	else 
	{
		$current_user = wp_get_current_user();
	}
?>
<?php get_header(); ?>

<section>
	<div class="container">
		<div class="row section text-center ">
			<div class="col-12 col-sm-7 d-flex mx-auto ">
				<a href="<?php echo get_site_url() ?>/therapist-account-dashboard" class="back-btn"> &#8826; BACK </a>
				<h3 class="w-100">New Blogs</h3>
			</div>	
<!--
			<div class="col-12 text-left text-sm-center col-sm-7 mx-sm-auto">
				<p>Lorem Ipsum dolor sit. Lorem Ipsum dolor sit. Lorem Ipsum dolor sit. Lorem Ipsum dolor sit. Lorem Ipsum dolor sit.Ipsum dolor sit.</p>
			</div>	
-->		
		</div>		
	</div>
</section>

<?php
	if($_GET["my_blog"])
	{
		//Repeater index staring from 0 
		$index = $_GET["my_blog"] - 1;
		$userPost = get_post($current_user->post_id);
		
		$title_index = "my_blogs_" . $index . "_blog_title";
		$link_index = "my_blogs_" . $index . "_blog_link";
		$img_index = "my_blogs_" . $index . "_blog_image";
		
		$title = $userPost->$title_index;
		$link = $userPost->$link_index;
		$img = $userPost->$img_index;
	}
?>
<section class="section transperrent-section blog-list-section">	
	<div class="container">
		<div class="row text-center section pb-4">
			<div class="col-sm-4 col-12 d-flex mx-auto">			
				<form data-parsley-validate  class="form-element-section" method="POST" enctype="multipart/form-data">
					<?php wp_nonce_field('my_blog'); ?>
					<?php if($_GET["my_blog"]) { ?><input type="hidden" value="<?php echo $index; ?>" name="row_index" /><?php } ?>
					<div class="form-group d-flex">
					  <div class="col-8 p-0 text-left">
					  	 <label for="event_banner_img mb-0">Blog Banner Image</label>
					  	 <span class="d-block label_img_msg">(*Ideal size: 700x300 and < 500KB ) </span>
					  	 <div class="imagePreview" style="<?php if(!empty($img)){echo 'display: block;'; };?>">
						  	 <?php echo wp_get_attachment_image($img, array(120,120), '', array( "class" => "") );?>
					  	 </div>
					  </div>
					  <div class="col-4 text-right p-0 form-upload-wrapper">
						<a href="" class="btn btn-upload">UPLOAD</a>
						
						<input type="file" id="event_banner_img" name="event_banner_img" class="fileupload-input">
						<span class="text-show d-block"></span>
					  </div>				  				  
				  </div>				
				
				  <div class="form-group">
				    <label for="blog_title">Blog Title*</label>
				    <input data-parsley-required="true"  data-parsley-required-message="Blog Title is required."  type="text"  class="form-control" name="txtTitle" id="blog_title" value="<?php echo $title; ?>">
				  </div>
				  
				  
				  <div class="form-group">
				    <label for="blog_url">Blog URL*</label>
				    <input data-parsley-required="true"  data-parsley-required-message="Blog URL is required."  type="text"  class="form-control" name="txtLink" id="blog_url" value="<?php echo $link; ?>">
				  </div>
			  
			  
				<div class="mt-3 my-event-btn">		 
					<button type="submit" class="btn d-inline btn-primary" name="btnMyBlog"><?php echo $_GET["my_blog"]?'Save':'Submit';?></button>
					<?php 
						if($_GET["my_blog"])
						{
							 ?>
							 <button type="button" id="deleteMyBlog" data-redirect="<?php echo get_permalink(1873);?>" data-index="<?php echo $index+1; ?>" class="btn d-inline secondary-btn">Delete</button>
							 <?php
						}
					?>
				</div>
			</form>
				
			</div>
		</div>
	</div>
</section>


<?php get_footer(); ?>