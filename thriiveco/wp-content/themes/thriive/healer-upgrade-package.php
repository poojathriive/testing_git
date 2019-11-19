<?php /* Template Name: Healer Upgrade Package  */ ?>
<?php 
	if (!is_user_logged_in()) 
	{ 
		wp_redirect('/login/');
		exit();
	}
	else 
	{
		$current_user = wp_get_current_user();
	}

?>
<?php get_header(); ?>

<section>
	<div class="container">
		<div class="row section text-center ">
			
			<div class="col-12 col-sm-7 d-flex mx-auto ">
				<h3 class="w-100"> 
					<?php 
						if(isset($_GET['renew-package']))
						{
							echo "Renew package";
						}
						else if(isset($_GET['action']))
						{ 
							echo ucwords(str_replace("-"," ",$_GET['action']));
						} 
/*
						else
						{
							$link = get_permalink(406) . "?action=upgrade-package";
							wp_redirect($link);
							exit(); 
							//echo $link;
						}
*/
						?>
					</h3>
				<p></p>
			</div>						
		</div>
	</div>
</section>

<section>
	<div class="container">
		<?php
			//Checking whether it is an upgrade package link or not
			if(isset($_GET['upgrade-package']) && isset($_GET['token']) && isset($_GET['token_id']) && isset($_GET['token_for']))
			{
				$upgradePackageId = $_GET['upgrade-package'];
				$token = $_GET['token'];
				$token_id = $_GET['token_id'];
				$token_for = $_GET['token_for'];
				
				$packageCharges = get_field("package_charges",$upgradePackageId);
				?>
					<form data-parsley-validate  class="form-element-section"  action="<?php if($packageCharges > 0){ echo PAYU_BASE_URL; }else{ echo PAYU_RETURN_URL; } ?>" method="post">
						<?php
							if(is_user_logged_in())
							{
								$package_post = get_post($upgradePackageId);
								?>
								<div class="row section mb-3 col-sm-6 col-12 mx-auto p-0">
									<div class="form-group">
									   	<div class="form-group">
											<div class="d-flex package-wrapper">
												<div class="col-3 col-sm-2">
													<div class="package-wrapper">
														<img src="<?php echo get_the_post_thumbnail_url($upgradePackageId); ?>" alt="">
													</div>
												</div>
											<div class="col-9 col-sm-10">
												<h6><?php echo $package_post->post_title; ?> package </h6>
											<div class="package-price">
												<span class="package-discoun-price1"><?php if($packageCharges > 0){ echo "INR " . $packageCharges . "/-"; } ?> </span><span class="text-highlight"> <?php if($packageCharges <= 0){ echo "FREE"; } ?></span>
												</div>
													<p class="text-highlight mt-1"><?php the_field('short_description',$packageId); ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
								if($packageCharges > 0)
								{
									?>
									<div class="row section text-left col-sm-6 col-12 mx-auto">
										<h6 class="w-100">Payment Details:</h6>
										<div class="final-payment">INR <?php echo number_format(get_field('package_charges',$upgradePackageId)); ?>/-</div>
									</div>
									<?php 
								}
							}
						?>
						
						<div class="row section text-left col-sm-6 col-12 mx-auto">
						  	<div class="form-group">
							    <label for="firstname">User Details:</label> <br>
							    <?php echo($current_user->first_name.' '.$current_user->last_name.'<br>'.$current_user->user_email.'<br>'.$current_user->mobile);?> 			  						</div>
						</div>
						<div class="row section text-left col-sm-6 col-12 mx-auto">
							<div class="form-group">
							    <label for="address">Address</label><br>
							    <?php echo getTherapistLocation($current_user->post_id); ?>
							    <?php //echo($address->addressline1.', '.$address->addressline2.'<br>'.$address->street.', '.$address->city.' - '.$address->zipcode.', <br>'.$address->country.', '.$address->state);?>
							</div>
						</div>
						<div class="row section text-left col-sm-6 col-12 mx-auto">
							<div class="checkbox-wrapper col-12 mt-3">
								<input type="checkbox"  value="" id="agreement" data-parsley-required-message="Kindly accept the agreement to proceed further." data-parsley-required="true">
								<label for="agreement">I have accepted the 
									<a href="<?php echo get_template_directory_uri(); ?>/assets/pdf/agreement.pdf" target="_blank" style="text-decoration:underline;">agreement</a>.
								</label>
							</div>
						</div>	
						<?php
							$hash_string = '';
							$posted = array();
							$posted['key'] = MERCHANT_KEY;
							$posted['txnid'] = substr(hash('sha256', mt_rand() . microtime()), 0, 20); 
							$posted['amount'] = get_field('package_charges',$upgradePackageId);; 
							$posted['firstname'] = $current_user->first_name; 
							$posted['email'] = $current_user->user_email; 
							$posted['phone'] = $current_user->mobile; 
							$posted['productinfo'] = $package_post->post_title;
							if(isset($_GET['renew-package']))
							{
								$posted['udf1'] = "renew_package";
							}
							else
							{
								$posted['udf1'] = "upgrade_package";
							}
							
							$posted['udf2'] = $upgradePackageId; 
							$hash = '';
							$hashVarsSeq = explode('|', HASH_SEQUENCE);
							foreach($hashVarsSeq as $hash_var) {
						    	$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
								$hash_string .= '|';
							}
							$hash_string .= SALT;
							$hash = strtolower(hash('sha512', $hash_string));
						?> 
						<div class="row section text-left col-sm-6 col-12 mx-auto">
							<div class="form-group">
								 <input type="hidden" name="key" value="<?php echo MERCHANT_KEY ?>" />
								 <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
								 <input type="hidden" name="txnid" value="<?php echo (empty($posted['txnid'])) ? '' : $posted['txnid']  ?>" /> 
								 <input type="hidden" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" />
								 <input type="hidden" name="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" />
								 <input type="hidden" name="email"  value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" />
								 <input type="hidden" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" />
								 <input type="hidden" name="productinfo" value="<?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?>"/>
								 <input type="hidden" name="surl" value="<?php echo PAYU_RETURN_URL;?>" />   
								 <input type="hidden" name="furl" value="<?php echo PAYU_RETURN_URL;?>" />
								 <input type="hidden" name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" />
								 <input type="hidden" name="udf2" value="<?php echo $upgradePackageId; ?>" />
							</div>
						</div>	
						<button type="submit" class="btn btn-primary" name="submit_payment_url"><?php if($packageCharges > 0){ echo "Pay Now"; }else{ echo "Submit"; } ?></button>
						</form>
				<?php
			}
			else
			{
				?>
					<form data-parsley-validate  class="form-element-section" id="package_details">
						<div class="row section mx-auto">
							<div class="col-12 col-sm-7 mx-sm-auto p-0">
								<?php
									$get_package = get_field("select_package",$current_user->post_id);
								    $packageCharges = get_field("package_charges",$get_package[0]->ID);
								    $userPackageName = $get_package[0]->post_title;
								    $userPackageId = $get_package[0]->ID;
								    
									$args = array(
										'post_type' => 'packages',
										'post_status' => 'publish',
										'order' => 'ASC',
									);
									$packages = new WP_Query( $args );
									//echo "<pre>";print_r($packages);echo "</pre>";
									
									if($packages->have_posts())
									{
										while($packages->have_posts())
										{
											$packages->the_post();
											$package_charges = get_field("package_charges");
											$short_description = get_field("short_description");
											?>
											<div class="form-group">
												<div class="d-flex package-wrapper">
											 		<div class="col-3 col-sm-2">
											 			<div class="package-wrapper">
											 				<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
												 		</div>
												 	</div>
											 		<div class="col-6 col-sm-7">
											 			<h6><?php echo get_the_title(); ?></h6>
											 			<div class="package-price">
											 				<span class="">
											 				<?php
												 				if($package_charges > 0)
												 				{
													 				echo "INR " . number_format($package_charges) . "/-";
												 				}
												 				else
												 				{
													 				echo "FREE";
												 				}
											 				?>
											 				</span>
											 			</div>
											 			<p class=" mt-1"><?php echo $short_description; ?></p>
											 		</div>
											 		<div class="col-3">
												 		<?php
													 		if($userPackageId == get_the_id())
													 		{
														 		?>
														 			<span>EXISTING</span>
															 		<div class="checkbox-wrapper">
																 		<input type="checkbox" id="1"/ disabled="disable" checked>
																 		<label for="1">
																 		</label>
															 		</div>
														 		<?php
													 		}
												 		?>	
												 	</div>
											 	</div>
											 	<div class="col-12 text-center mt-3 mb-3">
												 	<?php
												 		$codeD = $current_user->user_email.$current_user->ID . time();  
												 		$code = sha1( $codeD );														
														if(isset($_GET['action']))
														{
															if($_GET['action'] == 'renew-package')
															{
															 	$renewal_url = get_permalink(406) . "/?upgrade-package=" . get_the_id() . "&token=" . $code . "&token_id=" . $current_user->ID . "&token_for=" . $current_user->user_email . "&renew-package=1";
														 		?>
														 			<a href="<?php echo $renewal_url; ?>" class="btn btn-primary">REQUEST TO RENEW</a>
														 		<?php
															}
															else if($_GET['action'] == 'upgrade-package')
															{
																if($userPackageId == get_the_id())
														 		{
															 		if($package_charges > 0)
															 		{
																 		//$renewal_url = get_permalink(274) . "/?package=renew&token=" . $code . "&token_id=" . $current_user->ID . "&token_for=" . $current_user->user_email;
																 		$renewal_url = get_permalink(406) . "/?upgrade-package=" . get_the_id() . "&token=" . $code . "&token_id=" . $current_user->ID . "&token_for=" . $current_user->user_email . "&renew-package=1";
																 		?>
																 			<a href="<?php echo $renewal_url; ?>" class="btn btn-primary">REQUEST TO RENEW</a>
																 		<?php
																 	}
														 		}
														 		else
														 		{
															 		if($packageCharges < $package_charges)
															 		{
																 		$upgrade_link = get_permalink(406) . "/?upgrade-package=" . get_the_id() . "&token=" . $code . "&token_id=" . $current_user->ID . "&token_for=" . $current_user->user_email;
															 		?>
															 			<a href="<?php echo $upgrade_link; ?>" class="btn btn-primary">REQUEST TO UPGRADE</a>
															 		<?php
																 	}
														 		}
															}
														}
											 		?>
												</div>
											</div>
											
											<?php
										}
										wp_reset_postdata();
									}
								?>
							</div>			  		
						</div>	
					</form>
				<?php
			}
		?>
			
	</div>
</section>
 
 <div class="modal fade" id="upgradePackage" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal body -->
        <div class="modal-body">
         <div class="form-element-section">
	         <div class="row section col-sm-12 col-12 mx-auto p-0">
		        <div class="form-group col-12 upgrade_text text-center">
				 	Hey! We at Thriive are excited about you upgrading your package of spreading healing light to the world.
				</div>
				<div class="form-group col-12 upgrade_text_msg text-center"></div>
			  	<button type="button" class="btn d-inline btn-primary" data-dismiss="modal" id="closeUpgradePackage">CANCEL</button>
	            <button type="button" class="btn d-inline btn-primary" id="btnUpgradePackage">Upgrade Now</button>
	         </div>
         </div>                  
        </div>
      </div>
    </div>
 </div>
 
<?php get_footer(); ?>