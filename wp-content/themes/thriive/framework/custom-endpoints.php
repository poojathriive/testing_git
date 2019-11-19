<?php
	
// Endpoint for call connecting API
function call_connecting_endpoint() {
	register_rest_route( 'mo/v1', '/thriive-call-connection/', array(
		'methods' => 'POST',
		'callback' => 'my_operator_call_connection',
	) );
}
// Endpoint for call connecting API
function call_disconnecting_endpoint() {
	register_rest_route( 'mo/v1', '/thriive-call-disconnection/', array(
		'methods' => 'POST',
		'callback' => 'my_operator_call_disconnection',
	) );
}	

