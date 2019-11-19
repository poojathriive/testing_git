<?php 
$thriive_event = get_field("thriive_event");
if($thriive_event) {
	$event_location = get_the_terms( $post->ID,  'location' ); 
	$start_time = get_field("start_time");
	$end_time = get_field("end_time");
	$event_holder_name = get_field( "facilitator" );
	if(empty($event_holder_name)) {
		$therapist_names = get_field('therapist');
		if( $therapist_names ) {
			foreach( $therapist_names as $therapist_name ) {
				$event_holder_arr[] = $therapist_name->post_title;
			}
			$event_holder_name = implode(', ', $event_holder_arr);
		}
	}
	
?>
<div class="col-12 col-sm-6 d-flex mb-4">
	<div class="col-4 p-0 text-center">
		<a href="<?php echo the_permalink();?>">
			<div class="circle-calender-date">
				<div><?php echo date('l',strtotime(get_field('start_date_'))); ?></div>
				<div><?php echo date('d M',strtotime(get_field('start_date_'))); ?></div>
			</div>
		</a>
	</div>
	
	<div class="col-8">
		<h5><a href="<?php echo the_permalink();?>" class="text-highlight"><?php echo the_title(); ?></a></h5>
		<div class="text-highlight"><?php echo 'With ' . $event_holder_name; ?></div>
		<div><?php echo (!empty($end_time) ? $start_time . ' - ' . $end_time : $start_time . ' Onwards' ); ?></div>
		<div><?php echo $event_location[0]->name; ?></div>
		<div class="mt-3 my-event-btn">
			<a href="<?php echo get_permalink(); ?>" class="btn btn-primary">KNOW MORE</a>
		</div>
	</div>
	
</div>
<?php } ?>