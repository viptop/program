<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
	public function __construct()
    {
      //parent::__construct();
    }


    public function curls($url,$method='GET',$data=null,$timeout=10){

    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, $url);  
    curl_setopt($ch, CURLOPT_HEADER, 0);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

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

    $result=curl_exec($ch);  
    curl_close($ch);return $result;

    }

}
