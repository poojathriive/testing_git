<?php /* Template Name: Therapist chat History */ ?>
<?php 
	if (!is_user_logged_in()) {
		wp_redirect('/login/');
		exit();
	} 
?>
<?php get_header(); ?> 
<section class="section form-element-wrapper">
	<div class="conatiner">
		<div class="col-sm-4 text-center col-12 mx-sm-auto">
			<a href="/therapist-account-dashboard" class="back-btn"> < BACK </a>
			<h3 class="w-100">Therapist Chat History</h3>
		</div>
			<div class="row section col-sm-4 col-12 mx-auto">
     			<?php   echo therapist_chat_history(); ?>
				 </div>
		</div>
	
</section>

<!-- mobile card layout starts here -->
<section class="mobi_tableview">
	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<table class="table table-bordered">
					<thead class="thead-light">
						<tr>
							<th colspan="2">ABHILASH</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Last Conversation (Date&Time)</td>
							<td>15 Nov, 2019 09:07:42 PM</td>
						</tr>
						<tr>
							<td>Action</td>
							<td class="btns_group" id="start_chat_button_">
								<button type="button" class="btn btn-info btn_link1 view_chat btn btn-primary btn-big btn-transparent connect_with_btn_listing" data-fromuserid="562" data-touserid="1091" data-tousername="ABHILASH" data-role="subscriber">View Chat</button>
								<a href="http://35.232.100.164/therapist-chat-history/?to_user=1091" target="_blank" class="anch_link1" javascript="void()">Export</a>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered">
					<thead class="thead-light">
						<tr>
							<th colspan="2">02rakesh.mishra@gmail.com</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Last Conversation (Date&Time)</td>
							<td>18 Nov, 2019 11:39:27 AM</td>
						</tr>
						<tr>
							<td>Action</td>
							<td class="btns_group" id="start_chat_button_">
								<button type="button" class="btn btn-info btn_link1 view_chat btn btn-primary btn-big btn-transparent connect_with_btn_listing" data-fromuserid="562" data-touserid="1091" data-tousername="ABHILASH" data-role="subscriber">View Chat</button>
								<a href="http://35.232.100.164/therapist-chat-history/?to_user=1091" target="_blank" class="anch_link1" javascript="void()">Export</a>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered">
					<thead class="thead-light">
						<tr>
							<th colspan="2">Ramakant</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Last Conversation (Date&Time)</td>
							<td>20 Nov, 2019 04:03:04 PM</td>
						</tr>
						<tr>
							<td>Action</td>
							<td class="btns_group" id="start_chat_button_">
								<button type="button" class="btn btn-info btn_link1 view_chat btn btn-primary btn-big btn-transparent connect_with_btn_listing" data-fromuserid="562" data-touserid="1091" data-tousername="ABHILASH" data-role="subscriber">View Chat</button>
								<a href="http://35.232.100.164/therapist-chat-history/?to_user=1091" target="_blank" class="anch_link1" javascript="void()">Export</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	





<script>
  $('#form').parsley();
</script>
<?php get_footer(); ?>