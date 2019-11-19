<?php /* Template Name: Therapy List Template */ ?>
<?php get_header(); ?>

	<div class="banner-home">
		<?php while(have_posts()):the_post();?>
		<div class="container ">
			<div class="justify-content-center flex-column text-center">
				<h1><?php the_title();?></h1>
				<?php the_content();?>
			</div>
			
			
			<div class="row section w-70">
				<div class="col-12">
					<?php echo get_search_form(); ?>
				</div>
			</div>
			
			<div class="row text-center w-70">
				<div class="col-sm-7 text-center blog-filter-txt float-none d-block mx-auto">
		    	<span class="fliter-link">
					<a href="#" style=""><i class="filter-icon" aria-hidden="true"></i></a>
					<span>Refine these results</span>
				</span>
				<?php if( $_GET && $_GET['filter_ailment'] != 'all' ){ ?>
					<a href="<?php echo site_url(); ?>/therapies" class="clear-filter">Clear All</a>
				<?php } ?>
<!--
	    	<div class="tag-list-wrapper d-none">
		    	<div class="filter-tag category-name" value="Lifestyle">
					<span class="cat_name">Energy Healing</span> <span class="remove-tab">X</span>
		    	</div>
		    													
				<div class="filter-tag category-name" value="Fashion">
					<span class="cat_name">Energy Healing</span> <span class="remove-tab">X</span>
    			</div>
	    	</div>
-->
	    	<div class="filter-wrapper">
		    	<div class="tags-inner">						
					<form action="" method="get">
						<div class="d-flex align-items-start justify-content-between mb-3">
							<h4>Select Search filters to be applied</h4>
							<span class="filter-tag close-action ml-3 mt-3">X</span>
						</div>	
						<?php $ailments = thriive_get_therapy_ailments(); ?>
						<div class="form-group">
						<label for="sel1">Ailment:</label>
							<select class="form-control" id="sel3" name="filter_ailment">
								<option value="all">All</option>
								<?php foreach($ailments as $key => $val) { ?>
									<option value="<?php echo $val; ?>" <?php if($_GET['filter_ailment'] == $val){ echo 'selected'; } ?>><?php echo $val; ?></option>
								<?php } ?>
						  </select>
						</div>
						
						<div class="text-center"><input type="submit" class="btn btn-primary" value="Apply"></div>
					</form>
		    	</div>
	    	</div>
	    </div>
				
			</div>
			
			<div class="row section_therapies_list therapies_list">
			
			
			<?php
				$therapy_args = array(
				    'taxonomy' => 'therapy',
				    //'parent' => 0,  
				    'hide_empty' => false,
					//'number' => 4,
				    'meta_query' => true,
				    'order'    => 'DEC',
					'orderby'  => 'featured_therapy',
        			'meta_key' => 'featured_therapy',
				);
				
				if($_GET && $_GET['filter_ailment'] != 'all') {
					$sterm  = get_term_by('name',$_GET['filter_ailment'],'ailment');
					$therapy_args['meta_query'] = array (
			  			array(
					        'key'           => 'ailment', // custom field
					        'compare'       => 'LIKE',
					        'value'         => $sterm->term_id
						)
					);
				} 
				$therapy_terms = new WP_Term_Query( $therapy_args );
				//echo '<pre>';print_r($therapy_terms);echo'</pre>';
			?>			
			<div class="row">
		<?php foreach($therapy_terms->get_terms() as $therapy_term){ 
				$taxonomyArray1 = array('taxonomy' => 'therapy', 'parent' => $therapy_term->term_id, 'hide_empty' => false);
				$sub_therapy = get_terms($taxonomyArray1);
				$therapy_image = get_field('therapy_image','therapy_'.$therapy_term->term_id);
				if(is_mobile()) { 
					$therapy_img = wp_get_attachment_image_src($therapy_image, 'featured_post_mobile');
				} else {
					$therapy_img = wp_get_attachment_image_src( $therapy_image, 'thumbnail' );
				}
				
				$therapist_args =  array(
					'post_type' => 'therapist',
					'posts_per_page' => -1,
					'tax_query' => array(
						array(
							'taxonomy' => 'therapy',
							'field'    => 'slug',
							'terms'    => $therapy_term->slug,
						),
					),
				);
				$therapists = get_posts($therapist_args);
				
				// Child Terms for ailment Count
/*
				$termchildren = get_term_children( $therapy_term->term_id, 'therapy');
				//echo '<pre>';print_r($termchildren);echo'</pre>';	
				foreach($termchildren as $x) {
					//$ailment_count_child = 0;
					$term_data = get_term_by('id', $x, 'therapy');
					//echo '<pre>';print_r($k);echo '</pre>';
					$ailments = get_field('ailment',$term_data);
					$ailment_count_child += empty($ailments)?0:count($ailments);
				}			

				$ailments = get_field('ailment',$therapy_term);
				$ailment_count_parent += empty($ailments)?0:count($ailments);
*/
				$all_ailments = getMapAilmentByTherapy($therapy_term->term_id);
				//echo '<pre>';print_r(count($all_ailments));echo '</pre>';
				//$ailment_count_parent += empty($all_ailments)?0:count($all_ailments);
				?>
				 
				<div class="col-12 col-sm-6 mt-2 mb-5 text-center th-listing-wrapper divider-bg">
					<div class="m-3 dblock-img col-6 col-sm-3 mx-auto">
						<a href="<?php echo get_term_link( $therapy_term->slug, 'therapy' );?>"><img title="<?php echo $therapy_term->name?>" src="<?php echo $therapy_img[0]; ?>" alt="<?php echo $therapy_term->name?>"></a>
					</div>
					<h3 class="w-100"><a href="<?php echo get_term_link( $therapy_term->slug, 'therapy' );?>"><?php echo $therapy_term->name?></a></h3>
					<div class="d-flex col-lg-10 mx-auto">
					<div class="col p-0">
						<h6>Therapists</h6>
						<div class="highlight-bold"><?php echo count($therapists); ?></div>
					</div>
					<div class="col p-0">
						<h6>Ailments</h6>
<!-- 						<div class="highlight-bold"><?php echo $ailment_count_parent+$ailment_count_child; ?></div> -->
						<div class="highlight-bold"><?php echo count($all_ailments); ?></div>
					</div>
					<div class="col p-0">
						<h6>Sub-Therapy</h6>
						<div class="highlight-bold"><?php echo count($sub_therapy); ?></div>
					</div>
					</div>
					<a href="<?php echo get_term_link( $therapy_term->slug, 'therapy' );?>" class="btn btn-primary mt-3">KNOW MORE</a>
				</div>
				
				
				<?php } ?>			
			</div>
		</div>
		<?php endwhile;?>
	</div>
<!--
	<div class="text-center">
		<?php if($_GET && $_GET['filter_ailment'] != 'all') { ?>
			<a href="" class="btn secondary-btn  mt-3 enable_on_load_complete" id="therapies_list_load_more" data-numposts="4" data-page="1" data-taxonomy="therapy" data-parent="0" data-spage="0" data-filter="<?php echo $_GET['filter_ailment']; ?>">LOAD MORE</a>
		<?php } else { ?>
			<a href="" class="btn secondary-btn  mt-3 enable_on_load_complete" id="therapies_list_load_more" data-numposts="4" data-page="1" data-taxonomy="therapy" data-parent="0" data-spage="0">LOAD MORE</a>
		<?php } ?>
 	</div>
-->
</div>
<!--
<script id="therapies_list" type="text/html">
	<div class="col-12 col-sm-6 mt-20 mb-5 text-center th-listing-wrapper divider-bg transition_fade_out">
		<div class="m-3 dblock-img col-6 col-sm-3 mx-auto">
			<a href="/therapy/{{slug}}"><img title="{{name}}" src="{{therapy_image}}" alt="{{name}}"></a>
		</div>
		<h3 class="w-100"><a href="/therapy/{{slug}}">{{name}}</a></h3>
		<div class="d-flex">
		<div class="col">
			<h6>Therapists</h6>
			<div class="highlight-bold">{{therapist_count}}</div>
		</div>
		<div class="col">
			<h6>Ailments</h6>
			<div class="highlight-bold">{{ailment_count}}</div>
		</div>
		<div class="col">
			<h6>Sub-Therapy</h6>
			<div class="highlight-bold">{{sub_cats_count}}</div>
		</div>
		</div>
		<a href="/therapy/{{slug}}" class="btn btn-primary mt-3">KNOW MORE</a>
	</div>	
</script>
-->

<?php get_footer(); ?>