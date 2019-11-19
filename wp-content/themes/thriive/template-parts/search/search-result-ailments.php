<?php
	$ailment_results = thriive_get_search_query('taxonomy','ailment',get_search_query(),2);
// 	echo "<pre>";print_r($ailment_results);echo "</pre>";
	if ($ailment_results->get_terms()):
?>
<section class="search-therapies w-70 related-therapies">
	<div class="row section justify-content-center text-center">
		<h3 class="w-100 text-center">Ailments</h3>
			<?php
				foreach ( $ailment_results->get_terms() as $ailment_term ):
					set_query_var( 'ailment_term', $ailment_term  );
					get_template_part( 'template-parts/content-list-ailment'); 
				endforeach;
			?>
		<div class="text-center col-12">
			<a href="<?php echo get_permalink(604); ?>" class="btn secondary-btn mt-3">VIEW ALL</a>
		</div>
	</div>
</section>
<?php
	endif;
?>