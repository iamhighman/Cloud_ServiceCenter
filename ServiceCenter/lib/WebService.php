<?php

// WebService類別
class WebService
{

    var $proxyhost='';
    var $proxyport='';
    var $proxyusername='';
    var $proxypassword='';
    var $wsdl_file='';
    var $parameter='';
    var $callFunction='';
    var $debug=false;
        
    // 建構函式
    public function __construct()
    {

    }

    function execute(){
       
       if($this->wsdl_file == '') die('No wsdl_file setting!');

       $client = new nusoap_client($this->wsdl_file , 'wsdl',
				$this->proxyhost, $this->proxyport, $this->proxyusername, $this->proxypassword);
       
       $client->soap_defencoding = 'utf8';
       $client->decode_utf8 = false;
       $client->xml_encoding = 'utf-8'; 

       //Process if error occur!
       $err = $client->getError();
      
       if ($err) {
       	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
       }
       
       //Create the feasible parameter here!
       $para = $this->parameter;
       
       $result = $client->call($this->callFunction, $this->parameter);
       
       // Check for a fault
       if ($client->fault) {
       	echo '<h2>Fault</h2><pre>';
       	print_r($result);
       	echo '</pre>';
       } else {
       	  // Check for errors
       	  $err = $client->getError();
       	  if ($err) {
       	  	// Display the error
       	  	echo '<h2>Error</h2><pre>' . $err . '</pre>';
       	  } else {
       	  	// Display the result
       	  	//echo '<h2>Result</h2><pre>';
       	  	//print_r($result);
       	  	//echo '</pre>';
       	  	//echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
      	  	
		        //echo htmlspecialchars($client->response, ENT_QUOTES);
      	  	//return  htmlspecialchars($client->response, ENT_QUOTES);
       	  }
       }
       
       //Output area!
       if($debug){
          echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
          echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
          echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';        	       	
       }
   	   return $result;
    	
    }
    
    function getResult(){
        $this->wsdl_file='http://www.bs-byg.dk/hashclass.wsdl';
        $this->parameter=Array("Str" => "highman" , "HashType" => "MD5");
        $this->callFunction='HashString';
        $this->debug=true;    	
      	$go =  $this->execute();
       	print_r($go);
       	return $go;
    }
    
    // 解構函式
    public function __destruct()
    {
        
    }

}
