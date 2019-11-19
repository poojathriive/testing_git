<?php
	$therapy_results = thriive_get_search_query('taxonomy','therapy',get_search_query(),2);
	//echo "<pre>";print_r($therapy_results);echo "</pre>";
	if ($therapy_results->get_terms()):
?>
<section class="search-therapies w-70 related-therapies">
	<div class="row section justify-content-center">
		<h3 class="w-100 text-center">Therapies</h3>
			<?php
				foreach ( $therapy_results->get_terms() as $therapy_term ):
					set_query_var( 'therapy_term', $therapy_term  );
					get_template_part( 'template-parts/content-list-therapies'); 
				endforeach;
			?>
		<div class="text-center col-12">
			<a href="<?php echo get_permalink( get_page_by_path( 'therapies' ) ); ?>" class="btn secondary-btn mt-3">VIEW ALL</a>
		</div>
	</div>
</section>
<?php
	endif;
?>