<?php /* Template Name: Ailments listing Page */ ?>
<?php get_header(); ?>
<div class="banner-home">
	<div class="container ">
		<div class="justify-content-center flex-column text-center">
			<h1><?php the_title();?></h1>
<!--  			<p>Being witness to spontaneous healings, rejuvenated lives, renewed relationships made them realize that</p> -->
 			<p>Find Alternative Therapy solutions to emotional, physical & mental issues.</p>
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
				<?php if( $_GET && $_GET['filter_therapies'] != 'all' ){ ?>
					<a href="<?php echo site_url(); ?>/ailments-listing" class="clear-filter">Clear All</a>
				<?php } ?>
		    	<div class="filter-wrapper">
			    	<div class="tags-inner">						
						<form action="" method="get">
							<div class="d-flex align-items-start justify-content-between mb-3">
								<h4>Select Search filters to be applied</h4>
								<span class="filter-tag close-action ml-3 mt-3">X</span>
							</div>	
							<?php $therapies = thriive_get_ailments_therapy(); ?>
							<div class="form-group">
							<label for="sel1">Therapies:</label>
								<select class="form-control" id="sel3" name="filter_therapies">
									<option value="all">All</option>
									<?php foreach($therapies as $key => $val) { ?>
										<option value="<?php echo $val; ?>" <?php if($_GET['filter_therapies'] == $val){ echo 'selected'; } ?>><?php echo $val; ?></option>
									<?php } ?>
							  </select>
							</div>
							
							<div class="text-center"><input type="submit" class="btn btn-primary" value="Apply"></div>
						</form>
			    	</div>
		    	</div>
	    	</div>		
	</div>
							
			<?php 
				$taxonomy = 'ailment';
				// count the number of terms for correct pagination
				$term_args = array (
				    'taxonomy' => $taxonomy,
				    'fields'   => 'count',
				    'hide_empty' => false,
				);
				
				if($_GET && $_GET['filter_therapies'] != 'all')
				{
					$sterm  = get_term_by('name',$_GET['filter_therapies'],'therapy');
					$term_args['meta_query'] = array (
			  			array(
					        'key'           => 'therapies', // custom field
					        'compare'       => 'LIKE',
					        'value'         => $sterm->term_id
						)
					);
				}
				$term_count = get_terms( $term_args );
				
				// define the number of terms per page
				$terms_per_page = 4;
				
				// find out the number of pages to use in pagination
				$max_num_pages = ceil( $term_count / $terms_per_page );
				
				// get the page number from URL query
				$current_page = get_query_var( 'paged', 1 );
				
				// calculate the offset, if there is one.
				$offset = 0; // initial
				// or changed the if not the first (0)
				if( ! 0 == $current_page) {
				    $offset = ( $terms_per_page * $current_page ) - $terms_per_page;
				}
				
				$ailment_args = array(
				    'taxonomy' => $taxonomy, 
				    'hide_empty' => false,
					'number' => $terms_per_page,
					'offset'   => $offset,
				    'meta_query' => true,
				    'order'    => 'DEC',
					'orderby'  => 'featured_ailment',
        			'meta_key' => 'featured_ailment',
				);
				if($_GET && $_GET['filter_therapies'] != 'all') {
					$sterm  = get_term_by('name',$_GET['filter_therapies'],'therapy');
					$ailment_args['meta_query'] = array (
			  			array(
					        'key'           => 'therapies', // custom field
					        'compare'       => 'LIKE',
					        'value'         => $sterm->term_id
						)
					);
				}
				$ailment_terms = new WP_Term_Query($ailment_args);
				
				if($ailment_terms)
				{ ?>
						<div class="section-loop-wrapper">
							<div class="row therapies_list text-center" id="ailments_list">							
								<?php
									foreach($ailment_terms->get_terms() as $ailment_term)
									{
										set_query_var( 'ailment_term', $ailment_term );
										get_template_part( 'template-parts/content-list-ailment');														
									}
								?>
							</div>	
						</div>
						<div class="row text-center section w-70">
<!--
							<?php if($_GET && $_GET['filter_therapies'] != 'all') { ?>
								<a id="ailment_load_more" href=""  class="btn secondary-btn big" data-numposts="4" data-page="1" data-taxonomy="ailment" data-parent="ailment" data-spage="0" data-filter="<?php echo $_GET['filter_therapies']; ?>">LOAD MORE</a>
							<?php } else { ?>
								<a id="ailment_load_more" href=""  class="btn secondary-btn big" data-numposts="4" data-page="1" data-taxonomy="ailment" data-parent="ailment" data-spage="0">LOAD MORE</a>
							<?php } ?>
-->							<?php 
								($max_num_pages > 1) ? $next_page = 2 : $next_page = $max_num_pages+1;
								if($next_page < $max_num_pages){ ?>
							<a id="" href="<?php echo get_pagenum_link(2); ?>" data-page-title="AILMENTS" data-total-page="<?php echo $max_num_pages; ?>" data-next-page-view="<?php echo $next_page; ?>" data-current-page-view="1" class="btn secondary-btn big load-more-data">LOAD MORE AILMENTS</a>
							<?php } ?>
						</div>
								
						<?php						
				}
			?>						
		</div>
	</div>
</div>


<!--
<script id="ailment_list" type="text/html">
<div class="col-6 mt-4">
	<div class="connect-healer-circle">
		<div class="inner-healer-circle">
			<img src="{{image_url}}" alt="">
		</div>
	</div>
	<div class="txt-wrap mt-3">
		<h5><a href="{{url}}">{{name}}</a></h5>
		<a href="{{url}}" class="btn btn-primary">KNOW MORE</a>
	</div>
</div>
</script>
-->




<?php get_footer(); ?>