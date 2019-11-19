<?php 
	if(is_mobile()) {
		$event_image = get_the_post_thumbnail($id = null, 'thumbnail', array('alt' => get_the_title(), 'title'=>get_the_title()));
	} else {
		$event_image = get_the_post_thumbnail($id = null, 'thumbnail', array('alt' => get_the_title(), 'title'=>get_the_title()));
	}
	    $event_facilitator = get_field('facilitator');
	if (get_field('facilitator')){
		$facilitator = get_field('facilitator');
		
	}else{
		$event_healers = get_field('healer');
		foreach ($event_healers as $event_healer) {
	       $healer_arr[] = $event_healer->post_title;
	   	}
	   	$facilitator = implode(', ', $healer_arr);
	}
?>
<div class="col-12 p-0">
	<div class="event-circle">
		<a href="<?php echo the_permalink();?>">
			<div class="inner-event-circle">
				<?php echo $event_image; ?>
			</div>
		</a>
	</div>
	<div class="txt-wrap">
		<h5 class="mt-3"><a href="<?php echo the_permalink();?>" class="text-highlight"><?php the_title(); ?></a></h5>
		<!-- <p class=""><?php echo $facilitator; ?> </p> -->
		<?php
			if(!empty($sub_title))
			{
				?><p class="asd text-highlight mb-3"><?php echo $sub_title; ?></p><?php
			}
		?>
	</div>
</div>