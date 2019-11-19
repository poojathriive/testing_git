<?php /* Template Name: my blog page  */ ?>
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
				<h3 class="w-100">My Blogs</h3>
			</div>	
			<div class="col-12 text-left text-sm-center col-sm-7 mx-sm-auto">
				<p>If you have posted blogs on any site outside of Thriive, you can add them here. These blogs will be showcased on your profile page.</p>
			</div>
			<div class="col-12">
				<a href="<?php echo get_permalink(617); ?>" class="text-highlight">ADD NEW BLOG</a>
			</div>			
		</div>		
	</div>
</section>


<section class="section transperrent-section blog-list-section">	
	<div class="text-center">
		<?php
			$my_blogs = get_field('my_blogs', $current_user->post_id);
			//echo "<pre>"; print_r($my_blogs);echo "</pre>";
		?>
		<div class="row text-center section w-70">
		<?php
			//$my_blogs = get_field('my_blogs', $current_user->post_id);
			//echo "<pre>"; print_r($my_blogs);echo "</pre>";
			if($my_blogs)
			{
				$i=1;
				foreach($my_blogs as $blog)
				{
					?>
					<div class="col-6 pl-0 pr-2 mb-5">
						<div class="blog-img-list left-img mb-1">
							<img width="1024" height="369" src="<?php echo $blog['blog_image']['url']; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">	
						</div>
						
						<h5><a href="https://thriive.noesis.tech/2018/12/is-your-relationship-giving-you-that-kind-of-love-you-crave.html" target="_blank"><?php echo $blog['blog_title']; ?></a></h5>
						<div class="mt-3 my-event-btn">
							<a href="<?php echo $blog['blog_link']; ?>" target="_blank" class="btn secondary-btn">VIEW</a>
							<a href="<?php echo get_permalink(617) . "/?my_blog=" . $i; ?>" class="btn btn-primary">EDIT</a>
						</div>		
					</div>
					<?php
					$i++;
				}
			}
		?>
	</div>
	</div>
</section>


<?php get_footer(); ?>