<?php

function removephonenumberspecial($str, $donotadd = 1){
    $str = str_replace("-", "", $str);
    $str = str_replace("+", "", $str);
    $str = str_replace("(", "", $str);
    $str = str_replace(")", "", $str);
    $str = str_replace(" ", "", $str);
    if($donotadd){
        if(substr($str, 0, 1) != '1'){
            $str = '1' . $str;
        }	
    } 
    return $str;
} 



function telnyx_send($number, $text,$from,$apikey) {
    if (strpos($from, '+') !== false) {

    } else {
        $from = "+".$from;
    }

    if (strpos($number, '+') !== false) {

    } else {
        $number = "+".$number;
    }
    $status_inf = new stdClass();
    $post = array(
        'from' => $from,
        'to' => $number,
        'text' => $text
    );

    header('Content-Type: application/json'); // Specify the type of data
    $ch = curl_init('https://api.telnyx.com/v2/messages'); // Initialise cURL
    $post = json_encode($post); // Encode the data array into a JSON string
    $authorization = "Authorization: Bearer $apikey"; // Prepare the authorisation token
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization)); // Inject the token into the header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
    $result = curl_exec($ch); // Execute the cURL statement
    curl_close($ch); // Close the cURL connection
    $ss = json_decode($result); // Return the received data

   // print_r($result);

    foreach ($ss as $k => $v) {
        if ($k == "errors") {
            $status = $v;
            foreach ($status as $s => $m) {
                $code= $m->code;
                $title= $m->title;                    
                $status_inf -> status = "Failed"; 
                $status_inf -> reason = "Error Code:".$code."<br>".$title;
            }
        } else {                
            $status_inf -> status  = "Success";
            $status_inf -> reason = "";
        }
    }       
    return $status_inf;

    /*$status_inf = new stdClass();
    $post = array(
        'from' => $from,
        'to' => "+".$number,
        'text' => $text
    );

    header('Content-Type: application/json'); // Specify the type of data
    $ch = curl_init('https://api.telnyx.com/v2/messages'); // Initialise cURL
    $post = json_encode($post); // Encode the data array into a JSON string
    $authorization = "Authorization: Bearer $apikey"; // Prepare the authorisation token
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization)); // Inject the token into the header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
    $result = curl_exec($ch); // Execute the cURL statement
    curl_close($ch); // Close the cURL connection
    $ss = json_decode($result); // Return the received data

    // print_r($result);
    // exit();

    foreach ($ss as $k => $v) {
        if ($k == "errors") {
            $status = $v;
            foreach ($status as $s => $m) {
                $code= $m->code;
                $title= $m->title;
                
                $status_inf -> status = "Failed"; 
            $status_inf -> reason = "Error Code:".$code."<br>".$title;
           
            
            }
            
            
        } else {
            
            $status_inf -> status  = "Success";
            $status_inf -> reason = "";
        }
    }
   
    return $status_inf;*/
}
    
function sinch_sms($number, $text, $from, $apikey, $spid){
    if (strpos($from, '+') !== false) {

    } else {
        $from = "+".$from;
    }
    
    if (strpos($number, '+') !== false) {

    } else {
        $number = "+$number";
    }

    $status_inf = new stdClass(); 
    $number= ["$number"];
    $post = array(
        'from' => $from,
        'to' => $number,
        'body' => $text
    );
    //$apikey="997a2c77e5d34fd48c6a118aaea512aa";        
    header('Content-Type: application/json'); // Specify the type of data
    $ch = curl_init('https://us.sms.api.sinch.com/xms/v1/'.$spid.'/batches'); // Initialise cURL
    $post = json_encode($post); // Encode the data array into a JSON string
    $authorization = "Authorization: Bearer $apikey"; // Prepare the authorisation token
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization)); // Inject the token into the header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
    $result = curl_exec($ch); // Execute the cURL statement
    curl_close($ch); // Close the cURL connection
    $ss = json_decode($result); // Return the received data

    //print_r($result);
    if($result==NULL){
        $status_inf -> status="Failed";   
    } else {
        foreach ($ss as $k => $v) {
            if ($k == "id") {
                $status_inf -> id = $v;
                $status_inf -> status  = "Success";
            }
        }
    }
    return $status_inf;

    /*$status_inf = new stdClass();
    $number= ["+$number"];
    $post = array(
        'from' => $from,
        'to' => $number,
        'body' => $text
    );

    //$apikey="997a2c77e5d34fd48c6a118aaea512aa";    
    header('Content-Type: application/json'); // Specify the type of data
    $ch = curl_init('https://us.sms.api.sinch.com/xms/v1/'.$spid.'/batches'); // Initialise cURL
    $post = json_encode($post); // Encode the data array into a JSON string
    $authorization = "Authorization: Bearer $apikey"; // Prepare the authorisation token
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization)); // Inject the token into the header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
    $result = curl_exec($ch); // Execute the cURL statement
    curl_close($ch); // Close the cURL connection
    $ss = json_decode($result); // Return the received data

    //print_r($result);
    if($result==NULL){
        $status_inf -> status="Failed";   
    } else {
        foreach ($ss as $k => $v) {
            if ($k == "id") {
                $status_inf -> id = $v;
                $status_inf -> status  = "Success";
            }
        }
    }
    //print_r($status_inf);
    return $status_inf;*/
}

require("vendor/autoload.php"); 
use Twilio\Rest\Client;
function twilio_sms($to_mob, $text,$from,$sid,$token){ 
    $client = new Client($sid, $token); 
    $message = $client->messages->create( 
        $to_mob,
        [ 
            'from' => $from, 
            'body' => $text
        ]
    );
    return $message;
}

function clicksend_sms($from, $to, $text, $username, $apikey){
    $to                         =   removephonenumberspecial($to);

    if( $from != "")  
        $from                       =   removephonenumberspecial($from);
    
    $ch         =   curl_init();  
    curl_setopt_array($ch, array(
        CURLOPT_URL => 'https://rest.clicksend.com/v3/sms/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>   '{
            "messages": [
              {
                "body":"' . trim($text) . '",
                "to": "'. $to .'",
                "from": "'. $from  .'"
              }
            ]
          }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode("$username:$apikey")
            ),
        )); 
    $result = curl_exec($ch);
    
    if (curl_errno($ch)) {
        $message->status        = 100;
        $message->reason        = curl_error($ch);
        $message->status_code   = -1;
        return $message;
    } 
    curl_close($ch); 
    $json_result             =  json_decode($result, true);  
    if($json_result['http_code'] == 200){
        $message->status   =  "Success";
        $message->reason   =  "";
    }
    else{
        $message->status    =  "Failed";
        $message->reason    =  $json_result['response_msg']; 
    } 
    return $message;
}

function proovl_sms($from, $to, $text, $user_id, $token, $route = 1){ 
    $to         =   removephonenumberspecial($to);
    if( $from != "")  
        $from   =   removephonenumberspecial($from);
    
    $url = "https://www.proovl.com/api/send.php";

	$postfields = array(
		'user'  => "$user_id",
		'token' => "$token",
		'route' => "$route",
		'from'  => "$from",
		'to'    => "$to",
		'text'  => "$text"
	);

	if (!$curld = curl_init()) {
        $message->status        = 100;
        $message->reason        = "Internal Error";
        $message->status_code   = -1;
        return $message;
	} 
	curl_setopt($curld, CURLOPT_POST, true);
	curl_setopt($curld, CURLOPT_POSTFIELDS, $postfields);
	curl_setopt($curld, CURLOPT_URL, $url);
	curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);

	$output = curl_exec($curld);  
	curl_close ($curld); 
	$result = explode(';', $output); 
	if ($result[0] == "Error") {
        $message->status    =  "Failed";
        $message->reason    =  $result[1]; 
	} else {
        $message->status   =  "Success";
        $message->reason   =  ""; 
	}
    return $message;
} 

function smsto_sms($to, $text, $apikey){ 
    $to         =   removephonenumberspecial($to); 
    $ch         =   curl_init(); 
    $headers    =   [
                        "Content-Type: application/json",
                        "Accept: application/json",
                        "Authorization: Bearer " . $apikey
                    ]; 
    $params     =   [
                        'to'            => $to,
                        "bypass_optout" => true,
                        'message'       => $text, 
                        'sender_id'     => 'SMSto'
                    ];
    
    curl_setopt_array($ch, array(
        CURLOPT_URL => "https://api.sms.to/sms/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($params),  
        CURLOPT_HTTPHEADER => $headers,
    ));
    
    $result     = curl_exec($ch); 
    if (curl_errno($curl)) {
        $message->status        = 100;
        $message->reason        = curl_error($ch);
        $message->status_code   = -1;
        return $message;
    } 
    curl_close($ch); 
    $json_result             =  json_decode($result, true);   
    if($json_result['success']){
        $message->status   =  "Success";
        $message->reason   =  "";
    }
    else{
        $message->status    =  "Failed";
        $message->reason    =  $json_result['message']; 
    } 
    return $message;
}

function txtsync_sms($to, $text, $client_key, $client_secret){
    $to         =   removephonenumberspecial($to); 
    $ch         =   curl_init(); 
    $headers    =   [
                        "Content-Type: application/json",
                        "Accept: application/json",
                        "x-api-key: 7yKeQ3Wecx1e671r88tq814FYEdPkYT89sdl9SRD",
                        "Authorization: Basic " . base64_encode("$client_key:$client_secret") 
                    ]; 
    $params     =   [
                        'To'            => $to, 
                        'Message'       => $text
                    ];
    
    curl_setopt_array($ch, array(
        CURLOPT_URL => "http://api.txtsync.com/sms/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($params),  
        CURLOPT_HTTPHEADER => $headers,
    ));
    
    $result     = curl_exec($ch);  
    if (curl_errno($curl)) {
        $message->status        = 100;
        $message->reason        = curl_error($ch);
        $message->status_code   = -1;
        return $message;
    }  
    $json_result     =  json_decode($result, true); 
    $httpcode        =  curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    curl_close($ch);   
    if($httpcode == 200){
        $message->status   =  "Success";
        $message->reason   =  "";
    }
    else{
        $message->status    =  "Failed";
        $message->reason    =  $json_result['Message']; 
    } 
    return $message; 
}
/*
function clickatell_sms($from, $to, $text, $apikey){
    $to                         =   removephonenumberspecial($to);
    //https://stackoverflow.com/questions/53388627/clickatell-get-balance
    //https://www.clickatell.com/developers/api-documentation/rest-api-send-message/
    //https://stackoverflow.com/questions/35166212/using-clickatells-rest-api-in-php
    if( $from != "")  
        $from                       =   removephonenumberspecial($from); 
    $ch         =   curl_init();  
    curl_setopt_array($ch, array(
        CURLOPT_URL => 'https://rest.clicksend.com/v3/sms/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>   '{
            "messages": [
              {
                "body":"' . trim($text) . '",
                "to": "'. $to .'",
                "from": "'. $from  .'"
              }
            ]
          }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode("$username:$apikey")
            ),
        )); 
    $result = curl_exec($ch);
    
    if (curl_errno($ch)) {
        $message->status        = 100;
        $message->reason        = curl_error($ch);
        $message->status_code   = -1;
        return $message;
    } 
    curl_close($ch); 
    $json_result             =  json_decode($result, true);  
    if($json_result['http_code'] == 200){
        $message->status   =  "Success";
        $message->reason   =  "";
    }
    else{
        $message->status    =  "Failed";
        $message->reason    =  $json_result['response_msg']; 
    } 
    return $message;
}
*/

function nexmo_sms( $from, $to, $text, $apikey, $api_secret){ 
    $from       = removephonenumberspecial($from);
    $to         = removephonenumberspecial($to);
    $message    = new stdClass();
    
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, 'https://rest.nexmo.com/sms/json');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, "from=$from&text=$text&to=$to&api_key=$apikey&api_secret=$api_secret");
    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        $message->status        = 100;
        $message->reason        = curl_error($ch);
        $message->status_code   = -1;
        return $message;
    }
    curl_close($ch);
    
    $json_result             =  json_decode($result, true);
    $message->status_code    =  $json_result['messages'][0]["status"] ;

    if($json_result['messages'][0]["status"]  == "0"){
        $message->status   =  "Success";
        $message->reason   =  "";
    }
    else{
        $message->status    =  "Failed";
        $message->reason    =  $json_result['messages'][0]['error-text'];
    } 
    return $message;
}


function message_media_sms($to_mob, $text, $from, $username, $password){
    /*$msg = enc($text);
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // More headers
    $headers .= 'From: <niamat.crid@gmail.com>' . "\r\n";
    mail('mdniamatullah.khan@gmail.com','encryption check',$msg,$headers);*/

    require("library/message-media/sms.php");
    $si = new SmsInterface (false, false);
    $si->addMessage ("+".$to_mob, $text);
    $text = "";
    if(!$si->connect ($username, $password, true, false)){
    	$text = $text . "Could not contact server<br>";
    	return $text;
    }elseif (!$si->sendMessages ()){
    	$text = "Could not send message to server.";
    	if($si->getResponseMessage () !== NULL){
    		$text .= "<br>Reason: " . $si->getResponseMessage();
    		return $text;
    	}
    }else{
    	$text = "OK";
    	return $si;
        $si->status;
    }
}

function tm4b_sms($number, $text,$from,$apikey) {
    if (strpos($number, '+') !== false) {

    } else {
        $number = "+$number";
    }

    $status_inf = new stdClass();
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.tm4b.com/v1/sms',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "sandbox": false,
        "messages": [
                {
                    "content": "'.$text.'",
                    "destination_address":"'.$number.'",
                    "source_address":"x"
                }
            ]
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$apikey
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $ss = json_decode($response); // Return the received data
    $rslt = $ss->errors ? $ss->errors : $ss->messages;
    //print_r($ss->errors);
    //print_r($ss);
    //exit();

    foreach ($rslt as $k => $v) {
        if ($v->object_type == "error") {
            $code = $v->code;
            $title= $v->description;
            $status_inf->status = "Failed"; 
            $status_inf->reason = "Error Code:".$code."<br>".$title;
        } else {            
            $status_inf->status  = "Success";
            $status_inf->reason = "";
        }
    }   
    return $status_inf;
}

function textbelt_sms($number, $text,$key) {
    $status_inf = new stdClass();
    $ch = curl_init('https://textbelt.com/text');
    $data = [
        'phone' => $number,
        'message' => $text,
        'key' => ($key ? $key : 'textbelt'),
    ];
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $rslt = curl_exec($ch);
    curl_close($ch);
    $rslt = json_decode($rslt);
    if($rslt->success == false){
        $status_inf->status = "Failed"; 
        $status_inf->reason = $rslt->error;
    } else {
        $status_inf->status  = "Success";
        $status_inf->reason = "";
    }  
    return $status_inf;
}

function enc($data){
    $simple_string=$data;
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '985786NP12546327'; 
    $encryption_key = "SkWGetLostHacker";
    $encryption = openssl_encrypt($simple_string, $ciphering,
    $encryption_key, $options, $encryption_iv);
    return $encryption;
}

function dec($data){
    $encryption=$data;
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $decryption_iv = '985786NP12546327';
    $decryption_key = "SkWGetLostHacker";
    $decryption=openssl_decrypt ($encryption, $ciphering, 
    $decryption_key, $options, $decryption_iv);
    return $decryption;
}

function global_sms_send($number,$text,$apiKey,$apiSecret){ 
    $status_inf = new stdClass();   
    $url = "https://api.onbuka.com/v3/sendSms";
    $timeStamp = time();
    $sign = md5($apiKey.$apiSecret.$timeStamp);
    $headers = array('Content-Type:application/json;charset=UTF-8',"Sign:$sign","Timestamp:$timeStamp","Api-Key:$apiKey");
    $data = "{\"appId\":\"cs_8f4a0l\",\"numbers\":\"$number\",\"content\":\"$text\",\"senderId\":\"\"}";
    $ch = curl_init();
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 600);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS , $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    $ss= json_decode($result);    
    foreach ($ss as $k => $v) {
        if ($k == "status") {
            $status_inf -> code = $v;
        }
        if ($k == "reason") {
            $status_inf -> result = $v;
        }
    }

    if($status_inf -> code == "0"){
        $status_inf -> status = "Success";
    } else {
        $status_inf -> status = "Failed";
        $status_inf -> reason = $status_inf -> code ;      
    }
    return $status_inf; 
}

function message_bird($number,$text,$apikey,$org){
    $status_inf = new stdClass();
    $rec=$number;            
    //Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://rest.messagebird.com/messages');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "recipients=$rec&originator=$org&body=$text");
    $headers = array();
    $headers[] = 'Authorization: AccessKey '.$apikey;
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        //echo 'Error:' . curl_error($ch);
        $status_inf->reason = curl_error($ch);
    }
    curl_close($ch);
    //print_r($result);
    $res=json_decode($result);    
    if(isset($res->id)){
        $status_inf -> status = "Success";
    }
    if(isset($res->errors)){
        $status_inf -> status = "Failed";
    }
    return $status_inf;
}

function bulkgate_sms($to_mob,$text,$app_id,$app_token) {
    $status_inf = new stdClass();
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://portal.bulkgate.com/api/1.0/simple/transactional',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "application_id": "'.$app_id.'", 
        "application_token": "'.$app_token.'", 
        "number": "'.$to_mob.'", 
        "text": "'.$text.'"
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'        
      ),
    ));

    $rslt = curl_exec($curl);
    curl_close($curl);
    $rslt = json_decode($rslt);
    if($rslt->code == 401){
        $status_inf->status = "Failed"; 
        $status_inf->reason = $rslt->error;
    } else {
        $status_inf->status  = "Success";
        $status_inf->reason = "";
    }  
    return $status_inf;
}

function cm_sms($prod_token, $text, $to_mob) {
    $status_inf = new stdClass();
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://gw.cmtelecom.com/v1.0/message',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "messages": {
            "authentication": {
                "productToken": "'.$prod_token.'"
            },
            "msg": [{
                "body": {
                    "type": "auto",
                    "content": "'.$text.'"
                },
                "to": [{
                    "number": "'.$to_mob.'"
                }],
                "from": "TestSender",
                "allowedChannels": ["Viber"]
            }]
        }
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));

    $rslt = curl_exec($curl);
    curl_close($curl);
    $rslt = json_decode($rslt);
    if($rslt->errorCode == 103){
        $status_inf->status = "Failed"; 
        $status_inf->reason = $rslt->details;
    } else if($rslt->errorCode == 201){
        $rslt2 = json_decode($rslt->messages);
        echo $rslt2;
        $status_inf->status = $rslt2->status; 
        $status_inf->reason = $rslt2->messageDetails;
    } else {
        $status_inf->status  = "Success";
        $status_inf->reason = "";
    }  
    return $status_inf;
}
?>