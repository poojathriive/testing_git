<?php /* Template Name: Healer Edit Therapies  */ ?>
<?php 
	if (!is_user_logged_in()) { 
		wp_redirect('/login/');
		exit();
	} else {
		$current_user = wp_get_current_user();
		$userPost = get_post($current_user->post_id);
	}
?>
<?php get_header(); ?>

<section>
	<div class="container">
		<div class="row section text-center ">
			
			<div class="col-12 col-sm-7 d-flex mx-auto ">
				<a href="/therapist-account-dashboard" class="back-btn"> < BACK </a>
				<h3 class="w-100">Edit Therapies</h3>
			</div>						
		</div>
	</div>
</section>
<?php if(isset($_GET['updated'])) { ?> <p class="update_therapy_message text-center mt-5">Therapies Updated Successfully</p> <?php } ?>

<section>
	<div class="container">
		<form data-parsley-validate  class="form-element-section" id="edit_therapies" name="edit_therapies" action="" method="post">
			<?php wp_nonce_field('edit_therapies'); ?>
				<div class="row section mx-auto">
					<div class="col-12 col-sm-7 mx-sm-auto p-0">
					<div class="save_therapy">	
					<?php 
						//print_r(get_post_meta($current_user->post_id, 'therapy' ,true));
						$package = get_post($userPost->select_package[0]);
						
						$therapy_terms = get_terms(array(
									      'taxonomy' => 'therapy',
									      'hide_empty' => false ));	 
						for ($x = 0; $x < $userPost->therapy; $x++) { 
							$varExp = 'therapy_'.$x.'_experience';
							$varCharge = 'therapy_'.$x.'_charges';
							$varName = 'therapy_'.$x.'_therapy_name';	
							?>
				<div class="form-group">
					<label for="therapy-1">Therapy <?php  echo $x+1; ?></label>
						<select class="form-control select-list-item select-dropdown-list" id="therapy-list_<?php  echo $x+1; ?>" name="t_name_<?php  echo $x+1; ?>" disabled>
							<option value="">Select Therapy</option>
						<?php foreach($therapy_terms as $therapy) { 
										if($therapy->parent != 0){
						?>
<!-- 							<option value="<?php echo $therapy->term_id .'-'. $therapy->name; ?>" <?php echo ((($userPost->$varName)[0]==($therapy->term_id))?'selected':'');?>><?php echo $therapy->name;?></option> -->
								<option value="<?php echo $therapy->term_id .'-'. $therapy->name; ?>" 
								<?php
									if(!empty($userPost->$varName)) { echo (($userPost->$varName)[0]==($therapy->term_id))?'selected':''; }
								?>								
								><?php echo $therapy->name;?></option>
						<?php }} ?>
						
						</select>
				</div>
		 	  		<div class="form-group">
			 	  		<?php
				 	  		if(!empty($userPost->$varExp))
							{
								$userExp = formatTherapistExperienceDate($userPost->$varExp);
							}
							else
							{
								$userExp = "";
							}
			 	  		?>
						<label for="experience">Experience(Practice since)</label>
					    <input type="text" class="date_picker form-control" id="experience_<?php  echo $x+1; ?>" name="t_experience_<?php  echo $x+1; ?>" value="<?php echo $userExp;?>" disabled>
			  		</div>
			  		
			  		<div class="form-group">
						<label for="charges">Charges</label>
					    <input type="number" class="form-control" id="charges_<?php  echo $x+1; ?>" name="t_charges_<?php  echo $x+1; ?>" value="<?php echo $userPost->$varCharge;?>" <?php echo ($userPost->$varExp)?'':'disabled';?>>
			  		</div><br>
<?php } ?>
					</div>
					<div id="add_more_therapy"></div>
					<div id="limit_reached"></div>	
				<input type="hidden" id="total_therapies" name="total_therapies" value="<?php echo (($userPost->therapy) ? $userPost->therapy :0);?>">	
			  		
			  		
				<div class="mt-3 my-event-btn text-center">
					
					
					<a href = "<?php 
						$page = get_page_by_path('therapist-account-dashboard');
						echo get_permalink($page->ID); 
							?>"><button type="button" class="btn secondary-btn d-inline">CANCEL</button></a>
					<button type="submit" name="submit_edit_therapies" class="btn btn-primary d-inline">SAVE</button>
				</div>

			</div>			  		
			  		
			  		
			  		
			</div>	
		<div class="m-4 divider"></div>
		
		<div class="row section pb-5">
			<div class="col-12 col-sm-7 mx-auto text-center">
				<p>To Add/Edit therapies please contact Account Manager</p>
				 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#request_popup">CONTACT ACCOUNT MANAGER</button>
			</div>
		</div>
		</form>	
	</div>
</section>


<?php get_footer(); ?>