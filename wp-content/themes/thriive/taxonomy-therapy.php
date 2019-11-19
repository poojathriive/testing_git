<?php 
	get_header();
	$term = get_queried_object(); 
	$therapy_image = get_field('therapy_image','therapy_'.$term->term_id);
	if(is_mobile()) { 
		$therapy_img = wp_get_attachment_image_src($therapy_image, 'featured_post_mobile');
	} else {
		$therapy_img = wp_get_attachment_image_src( $therapy_image, 'thumbnail' );
	}
?>

<header class="">
	<input type="hidden" id="therapyId" name="therapyId" value="<?php echo $term->term_id?>">
	<div class="banner-home divider-bg">
		<div class="container ">
			<div class="justify-content-center abt-section flex-column text-center w-70 ">
				<div class="banner-logo">
					<img title="<?php echo $term->name; ?>" src="<?php echo $therapy_img[0];  ?>" alt="<?php echo $term->name; ?>" class="">
				</div>
				<h1><?php echo $term->name; ?></h1>
				<div class="text-justify w-100">
					<p><?php echo $term->description; ?></p>
				</div>
				
				<?php
					if (!is_user_logged_in())
					{
						?>
							<a href="<?php echo get_site_url() ?>/seeker-regsiter-landing-page/" class="btn btn-primary">SIGN UP NOW</a>
							<p class="text-center mt-3">To connect with our Therapists</p>
						<?php
					}
				?>				
			</div>
			<?php if($term->parent == 0){	
				$child_taxonomies = get_terms(array('taxonomy' => $term->taxonomy, 'parent' => $term->term_id, 'number' => 4, 'hide_empty' => false));
				
				
				$get_therapy_child_taxonomy = getChildTermByParentTerm($term->term_id,'therapy');
				if(!empty($get_therapy_child_taxonomy))
				{
			?>
				<div class="row text-center section w-70 th-details-banner-section sub_therapies_list">
					<?php //$child_count = count($child_taxonomies); 
					foreach($child_taxonomies as $child) { 
						//$child_taxonomy = get_term_by('id',$child,$term->taxonomy);	
						set_query_var( 'therapy_term', $child  );
						get_template_part( 'template-parts/content-list-therapies');	
					} 
					?>
				</div>
				<div class="row text-center section w-70">
							<a href="" class="btn secondary-btn big enable_on_load_complete" id="sub_therapies_list_loadmore" data-numposts="4" data-page="1" data-taxonomy="therapy" data-parent="<?php echo $term->term_id;?>" data-spage="0">LOAD MORE</a>				
						</div>
						<div class="m-1 divider"></div>
			<?php } } ?>
		</div>
	</div>

</header>
<?php 
	$therapist_args =  array(
		'post_type' => 'therapist',
		'posts_per_page' => 4,
		'tax_query' => array(
			array(
			'taxonomy' => 'therapy',
			'field'    => 'slug',
			'terms'    => $term->slug,
				),
			),
		);
	$therapists = get_posts($therapist_args);
	$count_num =0;
?>
<?php if(!empty($therapists)){ ?>
<section class="section therapists-section">
	<div class="container-fluid">
		<div class="text-center">
			<h2>Therapists</h2>
			<p>Specialised in <?php echo $term->name; ?></p>
		</div>
		<div class="row">
			<div class="row text-center w-70 justify-content-center therapists_list">
				<?php $wsp_count = count($wsp_post_types);
					set_query_var( 'term', $term  ); 
					foreach($therapists as $therapist)
					{
						$post_wsp_thumb_id = get_post_thumbnail_id( $therapist->ID ); 
						$post_wsp_image = wp_get_attachment_image_src( $post_wsp_thumb_id );
								
						set_query_var( 'image', $post_wsp_image[0]);
						set_query_var( 'title', $therapist->post_title);
						set_query_var( 'therapist_title', $therapist->therapist_title);
						set_query_var( 'link', get_permalink($therapist->ID));
						set_query_var( 'location', getTherapistLocation($therapist->ID));
						get_template_part( 'template-parts/content-list-therapist');
						
						if($key == 1){
							//break;	
						}		
					} 
				if($wsp_count > 4){ ?>
					<div class="row text-center section w-70">
						<a href="" class="btn secondary-btn big transperent">VIEW MORE</a>				
					</div>
				<?php } ?>
			</div>
			<div class="row text-center section w-70">
						<a href="" class="btn secondary-btn big enable_on_load_complete" id="therapy_detail_therapist_list_loadmore" data-numposts="4" data-page="1" data-taxonomy="therapist" data-parent="<?php echo $term->term_id;?>" data-spage="0">LOAD MORE</a>				
					</div>
		</div>
	</div>
</section>
<div class="m-1 divider"></div>
<?php } 

$all_ailments = getMapAilmentByTherapy($term->term_id);	
 
if(!empty($all_ailments)) 
{ ?>
<section class="section transperrent-section xcv">
	<div class="text-center">
		<h2>Ailments Cured</h2>
		<p>BY <?php echo $term->name; ?></p>
	</div>
	<div class="row text-center section w-70 justify-content-center ailment_list">
		<?php //$ailment_count = count($ailment_taxonomy); 
			$i=1;
			foreach($all_ailments as $ailment)
			{ 
				if($i <= 4)
				{
					set_query_var( 'ailment_term', $ailment);
					get_template_part( 'template-parts/content-list-ailment'); 
					$i++;
				}
			} 
		?>
		
	</div>
	<div class="row text-center section w-70">
		<a href="" class="btn secondary-btn big enable_on_load_complete" id="therapy_detail_ailment_list_loadmore" data-numposts="4" data-page="1" data-taxonomy="ailment" data-parent="<?php echo $term->term_id;?>" data-spage="0">LOAD MORE</a>				
	</div>	
</section>
<div class="m-1 divider"></div>
<?php } ?>

<?php 
	$event_args =  array(
	'post_type' => 'event',
	'posts_per_page' => 4,
		'tax_query' => array(
			array(
			'taxonomy' => 'therapy',
			'field'    => 'slug',
			'terms'    => $term->slug,
			),
		),
	);
	$events = new WP_Query($event_args);	
?>
<?php if($events->have_posts()){ ?>
<section class="section ">
	<div class="container-fluid">
		<div class="text-center">
			<h2>Events</h2>
			<p>Related to  <?php echo $term->name; ?> </p>
		</div>
		<div class="text-center section w-70 row justify-content-center">
			<?php $event_count = count($events); 
				while($events->have_posts()){
					$events->the_post();
					get_template_part( 'template-parts/content-list-event');
				}	
			?>
		</div>
</section>

<div class="m-1 divider"></div>
<?php } ?>

<?php 

$args = array(
'post_type' => 'post',
'posts_per_page' => 4,
'orderby' => 'date',
'order' => 'ASC',
'post_status' => 'publish',
'tax_query' => array(
   array(
   'taxonomy' => 'therapy',
   'field' => 'term_id',
   'terms' => $term->term_id
   )
 )
);
//$query = new WP_Query( $args );	
	
//$args = array( 'post_type' => 'post', 'posts_per_page' => 2, 'orderby' => 'date','order' => 'ASC', 'post_status' => 'publish');
$loop = new WP_Query( $args );
$count_num =0;
if($loop->have_posts()) :	
?>
<section class="section transperrent-section blog-list-section" id="4">
	<div class="text-center">
		<h2>Blog</h2>
	</div>
	<div class="row text-center section w-70 justify-content-center">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<?php get_template_part( 'template-parts/content-list-blog'); ?>
		<?php endwhile; ?>
	</div>
	
	<div class="row text-center section w-70">
		<a href="<?php echo get_site_url() ?>/blog/" class="btn secondary-btn big">VIEW MORE</a>				
	</div>
</section>

<?php 
	wp_reset_query();
endif;
?>

<?php $galleries = get_field('gallery', $term); ?>
<?php if($galleries){ ?>
<section class="section transperrent-section">
	<div class="text-center">
		<h2>GALLERY RELATED TO <?php echo $term->name; ?></h2>
	</div>
	<div class="row text-center section w-70">
		<?php $gallery_count = count($galleries); 
		foreach($galleries as $key => $gallery){ ?>
			<div class="col-6">
				<div class="icon-circle-bg icon-circle">
					<div class="img-wrap">
						<img src="<?php echo $gallery['gallery_image']; ?>" alt="" >
					</div>
				</div>
				<div class="txt-wrap">
					<h3><?php echo $gallery['gallery_name']; ?></h3>
					<div><i><?php echo $gallery['gallery_by']; ?></i></div>
					<div class="guide-section"><span class="icon-guide-medition"></span>GUIDED MEDITATION</div>
					<p><?php echo $gallery['gallery_description']; ?></p>
					<a href="" class="btn btn-primary">VIEW NOW</a>
				</div>
			</div>
			<?php if($key == 1){
				break;	
			}		
		} 
		if($gallery_count > 2){ ?>
			<div class="row text-center section w-70">
				<a href="" class="btn secondary-btn big">VIEW MORE</a>				
			</div>
		<?php } ?>
	</div>
</section>
<?php } ?>
<!-- <a href="" class="btn btn-primary mt-3" id="sub_therapies_list_load_more" data-taxonomy="therapy" data-parent="<?php echo $term->term_id; ?>" data-page="0">LOAD MORE</a> -->

<?php get_footer(); ?>


<script id="sub_therapies_list" type="text/html">	
	<div class="col-6 text-center">
		<div class="banner-logo">
			<a href="/therapy/{{slug}}"> <img title="{{name}}" src="{{img}}" alt="{{name}}"> </a>
		</div>
		<h5><a href="/therapy/{{slug}}">{{name}}</a></h5>
		<a href="/therapy/{{slug}}" class="btn btn-primary">KNOW MORE</a>
	</div>
</script>


<script id="therapists_list" type="text/html">
	<div class="col-6 mt-4">	
		<div class="healer-circle">
			<div class="inner-healer-circle">
				<a href="{{link}}">
					<img title="{{therapist_name}}" src="{{image_url}}" alt="{{therapist_name}}" >
				</a>
			</div>
		</div>
		<div class="txt-wrap mt-3">
			<h5><a href="{{link}}">{{therapist_name}}</a></h5>
			<p class="localtion-wrapper m-0">{{location}}</p>
			<p class="text-highlight mb-3">{{therapist_title}}</p>
			<a href="{{link}}" class="btn btn-primary">KNOW MORE</a>
		</div>
	</div>
</script>


<script id="ailment_list" type="text/html">	
	<div class="col-6 mt-4 section-wrapper-listing">
	<div class="connect-healer-circle">
		<div class="inner-healer-circle">
			<a href="{{link}}">
				<img title="{{ailment_name}}" src="{{image_url}}" alt="{{ailment_name}}">
			</a>
		</div>
	</div>
	<div class="txt-wrap mt-3">
		<h5><a href="{{link}}">{{ailment_name}}</a></h5>
		<a href="{{link}}" class="btn btn-primary">KNOW MORE</a>

	</div>
</div>
</script>

