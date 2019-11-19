<?php
	if(isset($_POST["btnMapTaxonomy"])) 
	{
		//If user upload xlsx file
		$results = nks_save_taxonomy_ailment($_FILES['fileMapTaxonomy'],$_POST);
		if(is_wp_error($results))
		{
			$msg = $results->get_error_message();;
		}
		else
		{
			$msg = "Successfully uploaded";
		}
	} 
	else if(isset($_POST["btnMapUserTherapist"]))
	{
		//nks_userTherapistMapping();
	}
	else if(isset($_POST["btnSendUsersCrdential"]))
	{
		if($_FILES['userCSV']['name'] != "")
		{
			$results = nks_excelToArray($_FILES['userCSV']);
			$isSent = nks_sendEmailToTherapist($results);
			if($isSent)
			{
				$msg = "Email has been sent successfully";
			}
			else
			{
				$msg = "Unable to send email. Please try again later.";
			}
			//echo "<pre>";print_r($results);echo "</pre>";
		}
		else
		{
			$msg = "Please upload the file";
		}
	}
	
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<section class="rfa_map_taxonomy">
	<?php 
		if(isset($msg))
		{
			echo "<br><h3>$msg</h3>";
		}
	?>	
	<div class="row">
		<div class="col-md-8 col-sm-12">
			<div class="form_block">
				<h5>Import Map Taxonomy</h5>
				<form action="" method="POST" enctype="multipart/form-data">
					<?php
						echo "<pre>";print_r(acf_get_fields(513));echo "</pre>";
						//acf_get_fields(513);
						$args = array('public' => true,'_builtin' => false);
						$all_taxonomy = get_taxonomies($args);
					?>
					<div class="form-group">
						<label>Select main taxonomy</label>
						<select class="form-control" name="main_taxonomy" required>
							<option value="" selected disabled>Select main taxonomy</option>
							<?php
								foreach($all_taxonomy as $taxonomy)
								{
									?><option value="<?php echo $taxonomy; ?>"><?php echo ucwords($taxonomy); ?></option><?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Please enter field name</label>
						<input type="input" class="form-control" name="main_taxonomy_field" placeholder="Ex: therapies" required>
					</div>
					<div class="form-group">
						<label>Select map taxonomy</label>
						<select class="form-control" name="map_taxonomy" required>
							<option value="" selected disabled>Select map taxonomy</option>
							<?php
								foreach($all_taxonomy as $taxonomy)
								{
									?><option value="<?php echo $taxonomy; ?>"><?php echo ucwords($taxonomy); ?></option><?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Please enter field name</label>
						<input type="input" class="form-control" name="map_taxonomy_field" placeholder="Ex: ailment" required>
					</div>
					<div class="form-group">
						<label>Map taxonomy is separated by</label>
						<input type="input" class="form-control" name="therapies_separated_by" placeholder="Ex: | , " required>
					</div>
					<div class="form-group">
						<label>Please upload file:</label>
						<input type="file" class="form-control" id="fileMapTaxonomy" name="fileMapTaxonomy" required>
					</div>
					<input type="submit" class="btn btn-primary" name="btnMapTaxonomy" value="Import">								
				</form>
			</div>
		</div>
		<div class="col-md-3 col-sm-12">
			<div class="row">
				<div class="col-md-12 col-sm-6">
					<div class="form_block">
						<h5>Map User and Therapist</h5>
						<label>Click below button to map therapist and their post(profile)</label>
						<br>
						<form action="" method="POST">
							<input type="submit" class="btn btn-primary" name="btnMapUserTherapist" value="Map user and Therapist">
						</form>
					</div>
				</div>
				<div class="col-md-12 col-sm-6">
					<div class="form_block">
						<h5>Send Therapist Their Credential</h5>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>Upload CSV file</label>
								<input type="file" class="form-control" name="userCSV" required>
							</div>
							<input type="submit" class="btn btn-primary" name="btnSendUsersCrdential" value="Upload">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
