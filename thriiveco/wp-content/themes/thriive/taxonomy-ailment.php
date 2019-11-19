<?php get_header(); ?>
<?php
	$term = get_queried_object();
	//printdata($term);
	$ailment_image = get_field("ailment_image","ailment_" . $term->term_id); 

		$ailment_img = wp_get_attachment_image_src( $ailment_image, 'thumbnail' );

?>
<header class="">
	<div class="banner-home">
		<div class="container ">
			<div class="banner-logo-healing justify-content-center flex-column text-center connect-healer-circle">
				<div class="inner-healer-circle">
					<img title="<?php echo $term->name; ?>" src="<?php echo $ailment_img[0]; ?>" alt="<?php echo $term->name; ?>" >
				</div>
			</div>
			<div class="text-justify abt-section">
				<h1 class="w-100 text-center"><?php echo $term->name; ?></h1>
				<?php if($term->description){ ?>
				<div class="abt-more ">

		                    <div class="excerpt-content-rm showmore-txt-wrapper">
		                    	<?php echo wp_trim_words($term->description,50);?>
		                    	<a href="#" class="eclip-more-link">...Show more</a>
		                    </div>
		                    
		                    <div class="readmore-content-wrapper showmore-txt-wrapper">
		                    	<?php echo $term->description;?>
		                    	<a href="#" class="eclip-more-link">Show less</a>
		                    </div>

					</div>
					<?php } ?>
				

				<?php
					if (!is_user_logged_in()) 
					{ 
						?>
						<div class="text-center mt-4">
							<a href="<?php echo get_permalink(536); ?>" class="btn btn-primary">SIGN UP NOW</a>
						</div>
						<?php
					} 
				?>	
			</div>
		</div>
	</div>
</header>

<?php $therapies = get_field("therapies", $term->taxonomy . '_' . $term->term_id); 
	//printdata($therapies);
	if(count($therapies) > 0) {	?>
<section class="container section transperrent-section related-therapies">
	<div class="text-center">
		<h2>Therapies</h2>
	</div>
	<div class="text-center section w-70">
		<div class="row th-details-banner-section ailmentTherapies_list">
			<?php	
				$topTwoTherapies = array_slice($therapies, 0, 4);			
				foreach($topTwoTherapies as $therapy)		
				{	
					set_query_var( 'therapy_term', $therapy);
					get_template_part( 'template-parts/content-list-therapies');						
				}
			?>
		</div>
		<input id="sub_ailment_therapy" type="hidden" value="<?php echo $term->term_id;?>">
		<?php
			if(count($therapies) > 4)
			{
				?>
					<div class="row text-center section w-70">
						<a href="" class="btn secondary-btn big" id="therapyByAilment_list_loadmore" data-numposts="4" data-page="1" data-taxonomy="therapy" data-parent="<?php echo $term->term_id;?>" data-spage="0">LOAD MORE</a>				
					</div>
				<?php
			}
		?>
	</div>
</section>
<div class="m-1 divider"></div>
<?php } ?>

<?php 
	$today = date('Ymd');
	//if(strtotime($date1) < strtotime($date2))
	
	$args = array(
		'post_type' => 'event',
		'post_status' => 'publish',
		'posts_per_page' => '-1',
        'tax_query' => array(
            array(
                'taxonomy' => 'ailment',
                'field' => 'slug',
                'terms' => $term->slug,
            ),
        ),
		'meta_query' => array(
		     array(
		        'key'		=> 'start_date_',
		        'compare'	=> '>=',
		        'value'		=> $today,
		    )
		),
    );
    $results = new WP_Query($args);
    
	if($results->post_count > 0){ ?>
<section class="section transperrent-section">
	<div class="container-fluid">
		<div class="text-center">
			<h2>Events</h2>
		</div>
		<div class="row text-center section w-70">
			<?php
			    if($results->have_posts()) 
			    {
				    while($results->have_posts())
				    {
					    $results->the_post();
						get_template_part( 'template-parts/content-list-event');
				    }
				    wp_reset_postdata();
			    }     
			?>			
		</div>
    	<div class="row text-center section w-70">
			<a href="/blog/event/" class="btn secondary-btn big">VIEW MORE EVENTS</a>				
		</div>			
	</div>
</section>
<div class="m-1 divider"></div>
<?php } ?>

<?php
	$blogs_args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => '-1',
        'tax_query' => array(
            array(
                'taxonomy' => 'ailment',
                'field' => 'slug',
                'terms' => $term->slug,
            ),
        ),
    );
    $blogs = new WP_Query($blogs_args);
    if($blogs->post_count > 0){
?>
<section class="container search-articles w-70">
	<div class="row  section blog-list-section text-center">
		<h3 class="w-100 text-center">Blog</h3>		
		<?php
		    if($blogs->have_posts()) 
		    {
			    while($blogs->have_posts())
			    {
				    $blogs->the_post();
				    $image_url = get_the_post_thumbnail_url();		
					get_template_part( 'template-parts/content-list-blog');
			    }
			    wp_reset_postdata();
			    ?>
<!--
			    	<div class="row text-center section w-70">
						<a href="/blog/event/" class="btn secondary-btn big">VIEW ALL</a>				
					</div>
-->
			    <?php
		    }     
		?>						
	</div>
</section>
<div class="m-1 divider"></div>
<?php } ?>


<script id="ailmentTherapies_list" type="text/html">	
	<div class="col-6 text-center">
		<div class="banner-logo">
			<a href="/therapy/{{slug}}"><img src="{{img}}" alt=""></a>
		</div>
		<h5><a href="/therapy/{{slug}}">{{name}}</a></h5>
		<a href="/therapy/{{slug}}" class="btn btn-primary">KNOW MORE</a>
	</div>
</script>
<?php get_footer(); ?>