<?php
    
// Callback for my operator assign masked number Endpoint
function my_operator_call_connection( WP_REST_Request $request ) {  
    global $wpdb;
    $parameters = $request->get_params();
    $node_id = $parameters['node_id'];
    $timestamp = $parameters['timestamp'];
    $clid = $parameters['clid'];
    $receiver_mobile = "";
    $caller = get_users( array(
                "meta_key" => "mobile",
                "meta_value" => $clid,
                "fields" => "ID",
                "meta_compare" => "LIKE"
            ) );
    $receiver_details = $wpdb->get_row("SELECT mon.receiver_id as receiver_id,moc.anon_uuid as anon_uuid FROM my_operator_number_allocation mon JOIN my_operator_call_masking_details moc ON mon.cmd_id = moc.id WHERE mon.caller_id IN (".implode(',',$caller).") AND mon.is_deleted = 0 AND moc.node_id = '".$node_id."' LIMIT 1");
    
    $receiver = get_user_by("id",$receiver_details->receiver_id);
    $user_meta=get_userdata($caller[0]);
    $user_roles=$user_meta->roles; //array of roles the user is part of.
    $is_seeker = 0;
    if(in_array('subscriber',$user_roles)){
        $is_seeker = 1;
    }

    if(isset($receiver->countryCode)){
        $cc = $receiver->countryCode;
        if($cc == "0"){
            $cc = "91";
        }
        $receiver_mobile = $cc."-".$receiver->mobile;
    }else{
        preg_match("/\d*(\d{10})/", $receiver->mobile, $match);
        $receiver_mobile = "91-".$match[1];  
    }
    $anon_uuid = $receiver_details->anon_uuid;
    $resp = array("action"=>"tts",
                  "value"=>"Welcome to Thrive Art and Soul, This call may be recorded for training and quality purpose",
                  "operation"=>"dial-numbers",
                  "operation_data"=>array("data"=>[$receiver_mobile],"dial_method"=>"serial","anon_uuid"=>$anon_uuid));
    
    //save call details in my_operator_call_history table
    $data = array('node_id' => $node_id,
                  'caller_id' => $caller[0],
                  'receiver_id' => $receiver_details->receiver_id,
                  'is_call'=>1,
                  'is_seeker'=>$is_seeker);
    $format = array('%s','%d','%d','%d','%d');
    $wpdb->insert('my_operator_call_history',$data,$format);
    
    return new WP_REST_Response( $resp, 200 );
}


