<?php

class GoogleClass{
  
  var $sso;
  
    public function __construct()
    { 
        //$this->sso = new GoogleSSO(); //so far, just for testing!
    }  
  
  function getDocs($link){
  	$c = @file_get_contents($link);
  	
  	$c = str_replace("\"File?id", "\"http://docs.google.com/File?id", $c);
  	$c = str_replace("\"/a/ec.nccu.edu.tw/View?docid=", "\"http://docs.google.com/a/ec.nccu.edu.tw/View?docid=", $c);
  	$c = str_replace("\"View?docid=", "\"http://docs.google.com/View?docid=", $c);
  	$c = str_replace("\"Presentation?id", "\"http://docs.google.com/Presentation?id", $c);
  	//$start = 0; //TEST
  	$start = strrpos($c, "doc-contents")-10;
  	$last = strrpos($c, "google-view-footer")-10;
  	//echo "start->".$start." end->".$last;
  	
  	return substr($c, $start, ($last-$start));
  }

  function getShortDocs($link, $len){
  	$c = @file_get_contents($link);
  	
  	$c = str_replace("\"File?id", "\"http://docs.google.com/File?id", $c);
  	$c = str_replace("\"/a/ec.nccu.edu.tw/View?docid=", "\"http://docs.google.com/a/ec.nccu.edu.tw/View?docid=", $c);
  	$c = str_replace("\"View?docid=", "\"http://docs.google.com/View?docid=", $c);
  	$c = str_replace("\"Presentation?id", "\"http://docs.google.com/Presentation?id", $c);
  	//$start = 0; //TEST
  	$start = strrpos($c, "doc-contents")-10;
  	$last = strrpos($c, "google-view-footer")-10;
  	//echo "start->".$start." end->".$last;
  	
  	$pre = substr($c, $start, ($last-$start));
  	//echo $pre;
  	$pre = strip_tags($pre);
  	$pre = str_replace("&nbsp","",$pre);
  	$pre = str_replace(";","",$pre);
  	
  	
  	return mb_substr($pre, 0, $len, "UTF-8");
  }

  function getDocsEmbed($link){
    $html = "<iframe src=\"$link\" frameborder=\"1\" width=\"100%\" height=70 scrolling=\"yes\"></iframe>";
    return $html;
  }

  function getGDB($url){
    
    $content = $this->getRawDB($url);
    $content = str_replace("<td  class='s0'>", "<td  class='s1'>", $content);
    $content = str_replace("<td  class='s2'>", "<td  class='s1'>", $content);
    $content = str_replace("<td  class='s3'>", "<td  class='s1'>", $content);
    $content = str_replace("<td  class='s4'>", "<td  class='s1'>", $content);

//    This Would help me to find out how many fields!!
//    
//    $itemArr = array();
//    $item = str_replace("<", " <", $list[2]);
//    $itemList = split(" ", strip_tags($item));
//    $flag = false;
//    foreach($itemList as $id => $i){
//    	 if($i == "Timestamp") {
//    	 	  $flag = true;
//    	 	  array_push($itemArr, $i);	
//    	 }
//    	 if($flag){
//    	    if(strlen($i)==0) break;
//    	    array_push($itemArr, $i);	
//    	 }
//    }

    //$table =  "<table".$list[4];
    $content = split("<div id=\"footer\">", $content);
    $table = $content[0];
    $line = split("<tr>", $table);
    $result = array();
    foreach($line as $id => $c){
    	$temp = array();
    	$a = split("<td  class='s1'>", $c);
    	foreach($a as $id2 => $c2){
    		 array_push($temp, strip_tags($c2));
    	}
    	array_shift($temp);
    	if(count($temp)>1) array_push($result, $temp);
    }
    
    //array_shift($result);
    //array_shift($result);
    
    return $result;

  }

  function getRawDB($url){
  	$ch = curl_init($url);
  	curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1); 
  	curl_setopt($ch, CURLOPT_HEADER      ,0);  // DO NOT RETURN HTTP HEADERS 
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
  	$Rec_Data = curl_exec($ch);
  	return $Rec_Data;
  }

  function Save2GDB($POSTURL, $POSTVARS ){
    // INITIALIZE ALL VARS
    $ch='';
    $Rec_Data='';
    
    $ch = curl_init($POSTURL);
    curl_setopt($ch, CURLOPT_POST      ,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS    ,$POSTVARS);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1); 
    curl_setopt($ch, CURLOPT_HEADER      ,0);  // DO NOT RETURN HTTP HEADERS 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
    $Rec_Data = curl_exec($ch);
 
    return $Rec_Data;
   }  



}

?>
