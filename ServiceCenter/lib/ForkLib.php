<?php

class ForkLib{

    function config(){
       $this->link = mysql_pconnect('localhost', 'root', 'misadmin') or
       die("mysql_connect() failed.");

       mysql_select_db("SERVICECENTER", $this->link) or
       die("mysql_select_db() failed.");
       
       mysql_query("SET CHARACTER SET 'utf8'", $this->link);
    }

    // «غc¨禡
    public function __construct()
    {
        $this->config();
    }
    
//    public function importJob($Token){
//       $sql1 = "INSERT INTO `SERVICECENTER`.`PROCESSTEMP` ";
//       $sql2 = " (`ID`,`TOKEN`) VALUES";
//       $sql3 = " ('','$Token')";
//       $sql = $sql1.$sql2.$sql3;
//       echo $sql;
//       if(mysql_query($sql)){
//          echo "Added SuccessfuL!!";
//       }else{
//          echo "Link Database failed, please try again later!!";
//       }  
//    }
//
//    public function updateJob($Token, $Result){
//       $sql1 = " UPDATE `SERVICECENTER`.`PROCESSTEMP` ";
//       $sql2 = " SET RESULT = '$Result'";
//       $sql3 = " WHERE TOKEN = '$Token' ";
//       $sql = $sql1.$sql2.$sql3;
//       echo $sql;
//       if(mysql_query($sql)){
//           echo "Updated SuccessfuL!!";   
//       }else{
//           echo "Link Database failed, please try again later!!";
//           echo "error:".mysql_error();
//           //die();
//       }
//       $_POST = null;    	
//    }
    
    public function getJobsList(){
    	  $return = array();
        $result = mysql_query("select * from SERVICECENTER.PROCESSTEMP");
        $row = mysql_fetch_row($result);
        $list = array();
        while($row != null){
        	 list($T_ID,$T_TOKEN) = $row;
        	 array_push($list, $T_TOKEN);
        	 $row = mysql_fetch_row($result);
        }
        return $list;    	
    }
    
    public function JobsDispatch(){
        $result = mysql_query("SELECT COUNT(ID) FROM SERVICECENTER.MONITOR WHERE `AP`='1' AND `ACTIVE`='1'");
        if(is_resource($result)) $row = mysql_fetch_row($result);    	
    	  list($ap1) = $row; 
        $result = mysql_query("SELECT COUNT(ID) FROM SERVICECENTER.MONITOR WHERE `AP`='2' AND `ACTIVE`='1'");
        if(is_resource($result)) $row = mysql_fetch_row($result);    	
    	  list($ap2) = $row;
        $result = mysql_query("SELECT COUNT(ID) FROM SERVICECENTER.MONITOR WHERE `AP`='3' AND `ACTIVE`='1'");
        if(is_resource($result)) $row = mysql_fetch_row($result);    	
    	  list($ap3) = $row;    	      	  

    	  $min = min($ap1,$ap2,$ap3);
    	  
    	  switch($min){
    	     case $ap1: return 1;	 break;
    	     case $ap2: return 2;	 break;
    	     case $ap3: return 3;  break;
    	     default: return 1;	
    	  }  	  
    }
    
    public function Execute($Serial, $Token){
    	  $Result = @file_get_contents("http://sc.ec.nccu.edu.tw/index.php?act=CheckCredit_$Serial&token=$Token");
        return $Result;
    }
}

?>
