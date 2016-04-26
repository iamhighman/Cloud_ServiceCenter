<?php

//include("./GoogleSSO.php");

class DataCenter{
  
   public function __construct(){ 
    	
   }  
  
   function encode($text){
      return md5($text);  	  
   }
   
   function getData($dataset, $token){
   	//print_r($dataset);
   	  foreach($dataset as $id => $innerArr){
   	  	 if($innerArr[1] == $token) return $innerArr;
   	  }
      return Null;
   }
   
   function insertAccounting($TYPE, $U_ID, $C_ID){
   	   $DATE = date("Ymd");
       $sql1 = "INSERT INTO `SERVICECENTER`.`ACCOUNTING` ";
       $sql2 = " (`ID`,`TYPE`,`U_ID`,`C_ID`,`DATE`) VALUES";
       $sql3 = " ('','$TYPE','$U_ID','$C_ID','$DATE')";
       $sql = $sql1.$sql2.$sql3;
       if(mysql_query($sql)){
          //echo "Accounting Added SuccessfuL!!";
       }else{
          echo "Link Database failed, please try again later!!";
          die();
       }          
   }

   function getSumAccounting($TYPE, $U_ID){
       $result = mysql_query("SELECT * FROM SERVICECENTER.ACCOUNTING WHERE TYPE = '$TYPE' AND U_ID = '$U_ID'");
       $row = mysql_fetch_row($result);
       $return = 0;
       while($row != null){
       	 list($V_ID, $V_TYPE, $V_UID, $V_CID, $V_DATE) = $row;
       	 $return += $V_CID;
       	 $row = mysql_fetch_row($result);
       }   	   
       return $return;
   }

   function getAccounting($TYPE, $U_ID){
       $result = mysql_query("SELECT * FROM SERVICECENTER.ACCOUNTING WHERE TYPE = '$TYPE' AND U_ID = '$U_ID'");
       return $result;
   }

}

?>
