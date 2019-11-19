<?php 
	if(is_mobile()) {
		$blog_image = get_the_post_thumbnail($id = null, 'featured_blog_mobile', array('alt' => get_the_title(), 'title'=>get_the_title())); 
	} else {
		$blog_image = get_the_post_thumbnail($id = null, 'featured_blog', array('alt' => get_the_title(), 'title'=>get_the_title()));
	}
?>
<div class="col-12 blog-wrapper-dp-list p-0">
	<div class="blog-img-list left-img mb-1">
		<a href="<?php the_permalink(); ?>" target="_blank"><?php echo $blog_image; ?></a>
	</div>
	
	<h5><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h5>
	<!-- <p class="">by <?php echo ucwords(get_the_author());?></p>		 -->
	<?php
		if(!empty($sub_title))
		{
			?><p class="asd text-highlight mb-3"><?php echo $sub_title; ?></p><?php
		}
	?>
</div>