<?php 
	if(is_mobile()) {
		$event_image = get_the_post_thumbnail($id = null, 'thumbnail', array('alt' => get_the_title(), 'title'=>get_the_title()));
	} else {
		$event_image = get_the_post_thumbnail($id = null, 'thumbnail', array('alt' => get_the_title(), 'title'=>get_the_title()));
	}
	$start_date = get_field("start_date_");
    $end_date = get_field("end__date");
    $start_time = get_field("start_time");
    $end_time = get_field("end_time");
    $event_venue = get_field("venue");
    $event_location = get_the_terms( $post->ID,  'location' );
    //print_r($event_location);
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
<div class="col">
	<div class="event-circle">
		<a href="<?php echo the_permalink();?>">
			<div class="inner-event-circle">
				<?php echo $event_image; ?>
			</div>
		</a>
	</div>
	<div class="txt-wrap">
		<h5 class="mt-3"><a href="<?php echo the_permalink();?>" class="text-highlight"><?php the_title(); ?></a></h5>
		<p class="text-highlight"><?php echo 'With '.$facilitator; ?> </p>
		<p class="mb-1"><?php echo (!empty($end_date) ? $start_date . " - " . $end_date : $start_date ); ?></p>
        <p class="mb-1"><?php echo (!empty($end_time) ? $start_time . " - " . $end_time : $start_time . " Onwards" ); ?></p>
        <p class="mb-1"><?php echo getTherapistLocation($post->ID);  ?></p>
        <a href="<?php echo the_permalink();?>" class="btn btn-primary">KNOW MORE</a>
	</div>
</div>