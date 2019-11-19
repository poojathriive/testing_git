<?php /* Template Name: my event page  */ ?>
<?php 
	if (!is_user_logged_in()) { 
		wp_redirect('/login/');
		exit();
	} else {
		$current_user = wp_get_current_user();
		$address =json_decode($current_user->address);
		$userPost = get_post($current_user->post_id);
		$package = get_post($userPost->select_package[0]);
	}
?>
<?php get_header(); ?>


<section>
	<div class="container">
		<div class="row section text-center ">
			<div class="col-12 col-sm-7 d-flex mx-auto ">
				<a href="<?php echo get_site_url() ?>/therapist-account-dashboard" class="back-btn"> &#8826; BACK </a>
				<h3 class="w-100">My Events</h3>
			</div>	
			<?php
			if($package->post_title != 'Earth')
			{
				?>
			<div class="col-12 col-sm-7 d-flex mx-auto mt-3 p-0 text-left">
				<div class="col-5 col-sm-4">
					<h6>Thriive Events</h6>
				</div>
				<div class="col-5 col-sm-6 p-0 dashboard-therapies-details">
					<?php
						$createdThriiveEvent = explode(",",get_user_meta($current_user->ID,'my_events',true));
						$createdThriiveEvent = count(array_filter($createdThriiveEvent));
					?>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo calculateProgress($createdThriiveEvent,$package->number_of_events);?>"aria-valuemin="0" aria-valuemax="100" style="width:<?php echo calculateProgress($createdThriiveEvent,$package->number_of_events);?>%"></div>
					</div>
					
				</div>
				<div class="col-2">
					<div class="text-center text-highlight"><?php echo $createdThriiveEvent; ?> / <?php echo $package->number_of_events;?></div>
				</div>
				
			</div>
			<div class="col-12 text-left text-sm-center col-sm-7 mx-sm-auto">
				<p>These events will be promoted on all our Social Media platforms and are a part of your package. Please refer to the guidelines to ensure there is no delay. Once approved, all events will be visible on the main Thriive Events Calendar.</p>
			</div>
			<div class="col-12">
				<?php
					if($createdThriiveEvent < $package->number_of_events)
					{
						?>
							<a href="<?php echo get_permalink(367); ?>?action=request_for_event" class="text-highlight">REQUEST FOR EVENT</a>
						<?php
					}
				?>
			</div>
			<?php
				}
			?>			
		</div>		
	</div>
</section>

<section>
	<div class="conatiner p-0">
		<div class="row text-center section w-70 therapy-detail-event-section">
			<?php $events = getEventById($current_user->post_id,true);
				foreach($events as $event){
					
			?>
			
			<div class="col-6">
				<div class="event-circle">
					<div class="inner-event-circle">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/img-1.png" alt="">
					</div>
				</div>
				<div class="txt-wrap">
					<h6 class="mt-3"><?php echo $event->post_title; ?></h6>
					<p class="text-highlight">
						<?php 
							$withNames = array();
						foreach($event->healer as $healer_id){
							$HealerData = get_post($healer_id);
							if($healer_id!=$current_user->post_id){
								$withNames[]=$HealerData->post_title;
							}
						}
						if(sizeof($withNames)>0){
							echo 'With ';
							foreach ($withNames as $i => $value) {
							    echo $withNames[$i].', ';
							}
						}
						?></p>
					<p><?php the_field('start_date_',$event->ID); ?> | Saturday</p>
					<p><?php the_field('start_time',$event->ID); ?> - <?php the_field('end_time',$event->ID); ?></p>
					<p>Awaken centre, Mumbai</p>
				</div>
				
				<div class="mt-3 my-event-btn">
					<a href="/blog/event/<?php echo $event->post_name;?>" class="btn btn-primary">VIEW DETAILS</a>
					<!-- <a href="/create-event/" class="btn btn-primary">EDIT</a> -->
				</div>
				
				<div class="text-highlight mt-3">		
					 <i class="icon-new-share p-1"></i><span>SHARE EVENT</span>
				</div>
				
			</div>
			<?php 
				
				} 
				
			?>			
		</div>
	</div>
</section>

<?php
if($package->post_title != 'Earth')
{
	?>
		<div class="m-1 divider"></div>
	<?php
}
?>

<section class="my-event section <?php if($package->post_title == 'Earth'){ echo 'mt-0'; } ?>">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-7 mx-sm-auto">
				<?php if($package->post_title != 'Earth'){ echo '<h3>My Events</h3>'; } ?>
				<p>Here, you can list your own unlimited number of events. They will only be visible on your own profile page but not on the main Thriive Events Calendar. You may share the links.</p>
			</div>
			<?php 
				$my_event = getEventCountById($current_user->post_id);
				//if(($my_event)<($package->number_of_events)){
				?>
					<div class="col-12 text-center">
						<a href="<?php echo get_permalink(367); ?>" class="text-highlight text-center">ADD NEW EVENT</a>
					</div>
				<?php 	
				//}
			?>
			
			
		</div>
		
		<div class="row text-center section w-70 therapy-detail-event-section">
			
			<?php 
				$events = getEventById($current_user->post_id,false);
				foreach($events as $event){
			?>
			
			<div class="col-6">
				<div class="event-circle">
					<div class="inner-event-circle">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/img-1.png" alt="">
					</div>
				</div>
				<div class="txt-wrap">
					<h6 class="mt-3"><?php echo $event->post_title; ?></h6>
					<p class="text-highlight">
						<?php 
							$withNames = array();
							foreach($event->healer as $healer_id){
								$HealerData = get_post($healer_id);
								if($healer_id!=$current_user->post_id){
									$withNames[]=$HealerData->post_title;
								}
							}
							if(sizeof($withNames)>0){
								echo 'With ';
								foreach ($withNames as $i => $value) {
								    echo $withNames[$i].', ';
								}
							}
						?>
					</p>
					<p><?php the_field('start_date_',$event->ID); ?> | Saturday</p>
					<p><?php the_field('start_time',$event->ID); ?> - <?php the_field('end_time',$event->ID); ?></p>
					<p>Awaken centre, Mumbai</p>
				</div>
				
				<div class="mt-3 my-event-btn">
					<a href="/blog/event/<?php echo $event->post_name;?>" class="btn btn-primary">VIEW DETAILS</a>
					<!-- <a href="/create-event/" class="btn btn-primary">EDIT</a> -->
				</div>
				
				<div class="text-highlight mt-3">		
					 <i class="icon-new-share p-1"></i><span>SHARE EVENT</span>
				</div>
				
			</div>
			<?php 
				
				} 
				
			?>
			
			
			
		</div>
		
	</div>
</section>
<?php
	if(isset($event_msg) || !empty($event_msg))
	{
		?>
		<div class="modal fade" id="md_event_msg" data-backdrop="static" data-keyboard="false">
		    <div class="modal-dialog">
		      <div class="modal-content text-center">
		        <!-- Modal body -->
		        <div class="modal-body">
			    	<p><?php echo $event_msg; ?></p>    
			    	<a href="" class="btn d-inline btn-primary" data-dismiss="modal">Close</a>
		        </div>
		      </div>
		    </div>
		 </div>
		<script>
				$("#md_event_msg").modal("show");
		</script>
		<?php
	}
?>

<?php get_footer(); ?>