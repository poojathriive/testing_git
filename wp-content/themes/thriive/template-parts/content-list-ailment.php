<?php $ailment_image = get_field('ailment_image', $ailment_term); 
		$ailment_img = wp_get_attachment_image_src( $ailment_image, 'thumbnail' );
?>
<div class="col-6 mt-4 section-wrapper-listing">
	<div class="connect-healer-circle">
		<div class="inner-healer-circle">
			<a href="<?php echo get_term_link( $ailment_term->slug, 'ailment' );?>">
				<img title="<?php echo $ailment_term->name; ?>" src="<?php echo $ailment_img[0]; ?>" alt="<?php echo $ailment_term->name; ?>">
			</a>
		</div>
	</div>
	<div class="txt-wrap mt-3">
		<h5><a href="<?php echo get_term_link( $ailment_term->slug, 'ailment' );?>"><?php echo $ailment_term->name; ?></a></h5>
		<a href="<?php echo get_term_link( $ailment_term->slug, 'ailment' );?>" class="btn btn-primary">KNOW MORE</a>

	</div>
</div>