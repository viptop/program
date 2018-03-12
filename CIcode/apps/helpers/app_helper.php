<?php 
/*
    function curls($url,$method='GET',$data=null,$timeout=10){
    	$header =array("Content-type:application/json;charset='utf-8'","Accept:application/json");
    	$ch = curl_init();
	　　curl_setopt($ch, CURLOPT_URL, $url);
      	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
      	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
	　　curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
		curl_setopt($ch, CURLOPT_TIMEOUT,$timeout);
	　　curl_setopt($ch, CURLOPT_HEADER, 0);

			switch ($method) {
				case 'POST':
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					break;				
				case 'PUT':
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"PUT");
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					break;
				case 'DELETE':
					curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
					curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
					break;
				case 'PATCH' :
					curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
					curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
					break;
			}

		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
    }

*/

function http_post($url, $data)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //对认证证书来源的检查
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function http_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function post_json($url,$data){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    'Content-Type: application/json',
	    'Content-Length: ' . strlen($data)
	));
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}