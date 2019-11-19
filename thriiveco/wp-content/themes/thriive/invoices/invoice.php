<?php 
	//echo $post_users_id;
	$current_date = date("d-M-Y");
	$post_usersdata = get_userdata($post_users_id);	
	$endDate = date("d/m/Y", strtotime(get_field('end_date', $post_usersdata->transaction)));
	$startDate = date("d/m/Y", strtotime(get_field('start_date', $post_usersdata->transaction)));
	//echo '<pre>';print_r($post_usersdata);echo '</pre>';
	$post_id = get_user_meta($post_users_id, 'post_id', true);
	$address = get_field('address', $post_id);
	$zipcode = get_field('zipcode', $post_id);
	
	// Country, State, City Taxonomy
	$taxonomy_name = 'location';
	$data = get_the_terms($post_id, $taxonomy_name);
	foreach($data as $key => $value) {
		if($value->parent == 0) {
			$country = $value->name;
		} else {
			$children = get_terms( $taxonomy_name, array(
                'parent'    => $value->term_id,
                'hide_empty' => false
            ) );
            if(empty($children)) {
	            $city = $value->name;
            } else {
	            $state = $value->name;
            }
		}
	}
	
	// Package Details
	$get_package = get_field("select_package",$post_id);
	$transaction_id = get_user_meta($post_users_id, 'transaction', true);
	//echo '<pre>';print_r($get_package);echo '</pre>';
	
	// Invoice Number
	$format = get_field('invoice_number_format', 'option');
	$count = get_option('invoice_seq_no');
	$count = get_field('invoice_number', 'option');
/*
	// If count doesn't exists;
	if(!$count) {
		if($format == 'H/W/2018-19/') {
			$count = 8;
		}
	}
*/
		
	//$current_no = get_option('invoice_number_format', 'option');	
	$gst_no = get_field("gstin_number",$post_id);
	
	if(!empty($state)) {
		global $wpdb;	
		$stateCodeData = $wpdb->get_results('SELECT code FROM states WHERE name = \''.$state.'\'');
		$stateCode = $stateCodeData[0]->code;
	}	
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
</head>
<body>
	<table style="width: 100%" class="invoice">
		<tr>
			<td class="logo">
				<img src="<?php echo get_stylesheet_directory_uri().'/assets/images/logo.png'?>" class="image">
			</td>
			<td class="address-details">
				<p><h2>Thriive Art & Soul LLP</h2></p>
				<p class="paragraph">118, Floor - 11, Plot-226, Bajaj Bhavan, Barrister Rajni Patel Marg, Nariman Point, Mumbai - 4000021</p>
				<p><b>finance@thriive.in</b></p><br>
				<p><b>GSTIN - 27AALFT2214J1Z3</b></p>
			</td>
			<td class="invoice-details">
				<p><b>Invoice No.</b> : <?php 
					echo $format.$count; 
/*
					$count++;
					update_option('invoice_seq_no', $count);
					update_field('invoice_number', $count + 1, 'option');
*/
				?></p><br>
				<p><b>Invoice Date</b> : <?php echo $current_date; ?></p><br>
				<p><b>Reference No.</b> : </p><br>
				<p><b>Payment Terms</b>: Immediate</p><br>
				<p><b>Billing Period</b>: <?php echo $startDate.' to '.$endDate; ?>
			</td>
		</tr>	
	</table><br>
	<h2 class="title">TAX INVOICE</h2>
	<table class="customer-details">
		<tr>
			<td class="head">Customer Name:</td>
			<td class="body"><?php echo $post_usersdata->first_name . ' ' . $post_usersdata->last_name; ?></td>
			<td class="head">Discount:</td>
			<td class="body">0</td>
		</tr>
		<tr>
			<td class="head" rowspan="3">Customer Address:</td>
			<td class="body paragraph" rowspan="3"><?php echo $address.', '.$city.', '.$state.', '.$country.', '.$zipcode.', Email: '.$post_usersdata->user_email.', Mobile: '.$post_usersdata->mobile; ?></td>
			<td class="head">Place Of Supply:</td>
			<td class="body"><?php echo $city.', '.$state; ?></td>
		</tr>
		<tr>
			<td class="head">State Name:</td>
			<td class="body"><?php echo $state; ?></td>
		</tr>
		<?php if(!empty($stateCode)) { ?>
		<tr>
			<td class="head">State Code:</td>
			<td class="body"><?php echo $stateCode; ?></td>
		</tr>
		<?php }
		 if(!empty($gst_no)) { ?>
		<tr>
			<td class="head">GSTIN/ UIN:</td>
			<td class="body"><?php echo $gst_no; ?></td>
		</tr>
		<?php } ?>
	</table>
	<table class="product-details">
		<tr>
			<th class="description">DESCRIPTION</th>
			<th class="product-title">SAC</th>
			<th class="product-title">GST RATE</th>
			<th class="product-title">AMOUNT</th>
		</tr>
		<tr>
			<td class="content">
				Therapist Registration - <?php echo $get_package[0]->post_title;?> Package<br><br>
				&nbsp;&nbsp;&nbsp;
				<?php 
					if($status == 'subscribe') {
						echo 'Subscription to '.$get_package[0]->post_title.' Package';
					}
					if($status == 'renew') {
						echo 'Renewal of '.$get_package[0]->post_title.' Package';
					}
					if($status == 'upgrade') {
						$old_package = get_post_meta($post_id, 'old_package', true);
						echo 'Upgrade from '.$old_package.' to '.$get_package[0]->post_title;
					}
				?><br>
				&nbsp;&nbsp;&nbsp;&nbsp;From <?php echo $startDate.' to '.$endDate; ?>
			</td>
			<?php 
				$amountWithTax = get_field("total_amount", $transaction_id);
				// Formula obtained from Thriive
				$amountWithoutTax = number_format(($amountWithTax / 118)*100, 2, '.', '');
								
				if($state == 'Maharashtra') {
					$tax = (9 / 100) * $amountWithoutTax;
					$tax = number_format($tax, 2, '.', '');
				} else {
					$tax = (18 / 100) * $amountWithoutTax; 
					$tax = number_format($tax, 2, '.', '');
				}	?>
			<td class="content">9983</td>
			<td class="content text-right"></td>
			<td class="content text-right"><?php echo $amountWithoutTax; ?></td>
		</tr>
		<?php 
		if($state == 'Maharashtra') {
			$calculatedAmount = $amountWithoutTax+($tax*2);						
		} else {
			$calculatedAmount = $amountWithoutTax+$tax;
		}
		
		$calculated_amount = number_format($calculatedAmount, 2, '.', '');
		
		if($calculated_amount != $amountWithoutTax) { ?>
			<tr>
				<td class="text-right tax round">Round off</td>
				<td class="tax"></td>
				<td class="tax"></td>
				<td class="text-right tax">
					<?php 							
						if($calculatedAmount > $amountWithTax) {
							$roundOff = $calculatedAmount - $amountWithTax;							
							echo '(-)&nbsp;'.number_format($roundOff, 2, '.', '');
						} else {
							$roundOff = $amountWithTax - $calculatedAmount;
							echo '(+)&nbsp;'.number_format($roundOff, 2, '.', '');
						}										
					?>					
				</td>
			</tr>
			
		<?php }?>
				
		<?php 
		if($state != 'Maharashtra') { ?>		
			<tr>
				<td class="text-right">Output IGST 18 %</td>
				<td class=""></td>
				<td class="text-right">18 %</td>
				<td class="text-right"><?php echo $tax; ?></td>
			</tr>		
		<?php	
		} else { ?>
			<tr>
				<td class="text-right tax">Output CGST 9 %</td>
				<td class="tax"></td>
				<td class="text-right tax">9 %</td>
				<td class="text-right tax"><?php echo $tax; ?></td>
			</tr>	
			<tr>
				<td class="text-right">Output SGST 9 %</td>
				<td class=""></td>
				<td class="text-right">9 %</td>
				<td class="text-right"><?php echo $tax; ?></td>
			</tr>
	<?php } ?>
		
		<tr>						
			<td><center><b>TOTAL</b></td>
			<td></td>				
			<td></td>				
			<td class="text-right"><b><?php echo $amountWithTax; ?></b></td>
		</tr>
		<tr>						
			<td colspan="4" style="padding: 10px 5px; font-size: 12px;"><b>Total Amount (in words): </b> <?php echo currencyToWords($amountWithTax).' only.'; ?></td>
		</tr>
		<tr>						
			<td colspan="4" style="padding: 10px 5px; font-size: 12px;"><b>Tax Amount (in words): </b> 
				<?php //echo currencyToWords($amountWithTax).' only.'; 
					if($state == 'Maharashtra') {
						echo currencyToWords($tax*2).' only.';
					} else {
						echo currencyToWords($tax).' only.';
					}
				?>
			</td>
		</tr>
		<tr class="footer">
			<td style="font-size: 11px;">Terms and Conditions:</td>
			<td class="text-right" colspan="3"><b>For Thriive Art & Soul LLP</b></td>
		</tr>	
		<tr class="footer">
			<td class="text-right" colspan="4" style="padding-top: 30px;">
				<img src="<?php echo get_stylesheet_directory_uri().'/assets/images/sign.jpg'?>" class="image"><br><br>
				<span style="font-size: 11px;"><b>Authorized Signature</b></span>
			</td>
		</tr>
	</table>
	<p class="title" style="padding-top: 10px;"><b>This is a Computer Generated Invoice</b></p>
</body>
</html>

