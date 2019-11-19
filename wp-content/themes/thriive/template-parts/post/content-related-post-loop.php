<div class="col log-wrapper text-center divider-bg pb-3">
<header class="entry-header text-center w-100">
	<?php
		$post_categories = get_post_primary_category($post->ID, 'category');
	?>
	
	<?php
	if (has_post_thumbnail()):
		?>
		<div class="blog-banner">
			<a href="<?php the_permalink();?>"><?php the_post_thumbnail('blog-header', array('alt' => get_the_title(), 'title' => get_the_title())); ?></a>
		</div>
	<?php
	endif;
	?>
	
<div class="category-name mt-3"><span class="cat-<?php echo $post_categories['primary_category']->slug;?> cat-icon-set blog-icon-set"> </span> <span class="text-highlight"><?php echo $post_categories['primary_category']->name;?></span></div>
	<?php
		the_title( '<h2 class="entry-title w-100 blog-title mt-3">', '</h2>' );
	?>
	<div class="entry-meta">
			<?php
			thriive_posted_by();
			?>
	</div><!-- .entry-meta -->
	<div class="col-12 col-sm-10 mx-auto p-0 d-flex blog-list-details">
		<div class="col-6 p-0"><span class="icon-new-calender_1 icon-event"></span> <span><?php echo get_the_date('j M, Y',get_the_ID());?></span> </div>
		<div class="col"><span class="icon-new-comment icon-event"></span><?php comments_number('0','%','%');?></div>
		<div class="col"><span class="icon-new-view-eye icon-event"></span><?php echo getPostViews(get_the_ID());?></div>
	</div>	
	
</header><!-- .entry-header -->
	<div class="col-12 mt-3 text-left">
		<?php the_excerpt(); ?>
	</div>	
	<a href="<?php the_permalink();?>" class="btn btn-primary"> READ </a>
</div>