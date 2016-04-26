<?php

class ServiceInterface
{

    var $googleF;
    var $datacenterF;
    
    var $title="Service Interface Gadget";
    var $action="ServiceInterface";


    // 建構函式
    public function __construct()
    {
        $this->googleF = new GoogleClass(); 
        $this->datacenterF = new DataCenter();        
    }
    
    public function getAction(){
    	 return $this->action;
    }

    public function getTitle(){
    	 return $this->title;
    }
    
    public function getPref(){
    	 $pref = array();
    	 array_push($pref, array("prefName"=> "uid" , "prefValue"=> ""));
    	 array_push($pref, array("prefName"=> "upa" , "prefValue"=> ""));
    	 return $pref;
    }

    public function ifLogin($uid, $upa){
        $result = mysql_query("select ID from SERVICECENTER.USER where NAME = '$uid' and PASSWORD = '$upa'");
        $row = mysql_fetch_row($result);
        list($id) = $row;
        
        return $id;
    }
    
    public function addLoginAccouting($uid){
    	  $this->datacenterF->insertAccounting("Login", $uid, 1);
    }
    
    public function getProfile($id){
    	  $return = array();
        $result = mysql_query("select * from SERVICECENTER.USER where id = $id");
        $row = mysql_fetch_row($result);
        list($T_ID,$T_NAME,$T_PASSWORD,$T_ADDRESS,$T_TEL,$T_PURCHASED,$T_NOTE) = $row;
        
        $loginNum = $this->datacenterF->getSumAccounting("Login", $T_ID);
        
        $orderService = split(',', $T_PURCHASED);
        $service = array();
        foreach($orderService as $o_id => $p_id){
        	 $result = mysql_query("select * from SERVICECENTER.MENU where ID = '$p_id'");
        	 $row = mysql_fetch_row($result);
        	 list($O_ID,$O_NAME,$O_BPEL,$O_DATASOURCE,$O_AP,$O_INTERFACE,$O_PRICE) = $row;
        	 $Frequency = $this->datacenterF->getSumAccounting($O_NAME, $T_ID);
        	 $secs = $this->datacenterF->getSumAccounting($O_NAME."Time", $T_ID);
        	 
        	 array_push($service , array("ServiceName"=>$O_NAME, "ServicePrice"=>$O_PRICE, "ServiceFrequency"=>$Frequency, "ServiceSecs"=>$secs ));
        }
        array_push($return , array("Service"=>$service,"loginNum"=>$loginNum,"T_ID"=>$T_ID, "T_NAME"=>$T_NAME, "T_ADDRESS"=>$T_ADDRESS, "T_TEL"=>$T_TEL, "T_PURCHASED"=>$T_PURCHASED, "T_NOTE"=>$T_NOTE));

        return $return;
    }

//This part is for specific bank functions
    public function getBankData($id){
        $result = mysql_query("SELECT * FROM SERVICECENTER.BANK WHERE ID = '$id'");
        $row = mysql_fetch_row($result);
        return $row;         	
    }

    public function getBankData_Cloud($serial){
    	  //Cloud DataCenter #1
        //TOKEN * INCOME * JOB *   
        //Cloud DataCenter #2
        //TOKEN * MARRIAGE * GENDER *     
        switch($serial){
           case 1:  
             $ViewLink = "http://spreadsheets.google.com/pub?key=rq6KPB4iCMan0BVaTp4Ad_w";        
           break;
           case 2:
             $ViewLink = "http://spreadsheets.google.com/pub?key=r0OEIVjry9RigCBajuRBE7A";  
           break;
           
           default: echo "Lack of serial!!";	
        }
//print_r($this->googleF->getGDB($ViewLink));
        return $this->googleF->getGDB($ViewLink); //Display DB       	
    }
    
    public function saveBankData_Cloud($serial, $var1, $var2, $var3, $var4, $var5){
        switch($serial){
           case 1:  
             $FormLink ="http://spreadsheets.google.com/formResponse?formkey=cnE2S1BCNGlDTWFuMEJWYVRwNEFkX3c6MA..";
             $Post = "entry.0.single=$var1&entry.2.single=$var2&entry.3.single=$var3";        
           break;           
           case 2:
             $FormLink = "http://spreadsheets.google.com/formResponse?formkey=cjBPRUlWanJ5OVJpZ0NCYWp1UkJFN0E6MA..";
             $Post = "entry.2.single=$var1&entry.0.single=$var2&entry.3.single=$var3&entry.4.single=$var4&entry.5.single=$var5";
           break;
           default: echo "Lack of serial!!";	
        }    

        $this->googleF->Save2GDB($FormLink, $Post); //Save to DB      	
    }
    
    public function getBankDataForm($id){
    	  list($V_ID,$V_NAME,$V_NID) = $this->getBankData($id);  
    	  
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=updateBank\">");
    	  array_push($FormArr, "<input name=\"ID\" type=\"hidden\" size=\"50\" value=\"$V_ID\">");
    	  array_push($FormArr, "Bank User ID: $V_ID<br>");
    	  array_push($FormArr, "Name: <input name=\"NAME\" type=\"text\" size=\"50\" value=\"$V_NAME\"><br>");
    	  array_push($FormArr, "Security No: <input name=\"NID\" type=\"text\" size=\"50\" value=\"$V_NID\"><br>");
    	  array_push($FormArr, "Income: <input name=\"INCOME\" type=\"text\" size=\"50\" value=\"$V_PRICE\"><br>");
    	  array_push($FormArr, "Job: <input name=\"JOB\" type=\"text\" size=\"50\" value=\"$V_PRICE\"><br>");
    	  array_push($FormArr, "InvoiceAmount: <input name=\"InvoiceAmount\" type=\"text\" size=\"50\" value=\"$V_PRICE\"><br>");
    	  array_push($FormArr, "InvoiceType: <input name=\"InvoiceType\" type=\"text\" size=\"50\" value=\"$V_PRICE\"><br>");
    	  array_push($FormArr, "InvoiceAssign: <input name=\"InvoiceAssign\" type=\"text\" size=\"50\" value=\"$V_PRICE\"><br>");
    	  array_push($FormArr, "InvoiceDate: <input name=\"InvoiceDate\" type=\"text\" size=\"50\" value=\"$V_PRICE\"><br>");    	  
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;
    }

    public function getBankAddForm(){
    	  
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=addBank\">");
    	  array_push($FormArr, "<input name=\"ID\" type=\"hidden\" size=\"50\" value=\"$V_ID\">");
    	  array_push($FormArr, "Name: <input name=\"NAME\" type=\"text\" size=\"50\" value=\"$V_NAME\"><br>");
    	  array_push($FormArr, "Security No: <input name=\"NID\" type=\"text\" size=\"50\" value=\"$V_NID\"><br>");
    	  array_push($FormArr, "Income: <input name=\"INCOME\" type=\"text\" size=\"50\" value=\"$V_PRICE\"><br>");
    	  array_push($FormArr, "Job: <input name=\"JOB\" type=\"text\" size=\"50\" value=\"$V_PRICE\"><br>");
    	  array_push($FormArr, "InvoiceAmount: <input name=\"InvoiceAmount\" type=\"text\" size=\"50\" value=\"$V_PRICE\"><br>");
    	  array_push($FormArr, "InvoiceType: <input name=\"InvoiceType\" type=\"text\" size=\"50\" value=\"$V_PRICE\"><br>");
    	  array_push($FormArr, "InvoiceAssign: <input name=\"InvoiceAssign\" type=\"text\" size=\"50\" value=\"$V_PRICE\"><br>");
    	  array_push($FormArr, "InvoiceDate: <input name=\"InvoiceDate\" type=\"text\" size=\"50\" value=\"$V_PRICE\"><br>");   
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;	    	  
    }
    
    function addBankData($p){
  	   
       $sql1 = "INSERT INTO `SERVICECENTER`.`BANK` ";
       $sql2 = " (`ID`,`NAME`,`NID`) VALUES";
       $sql3 = " ('','$p[NAME]','$p[NID]')";
       $sql = $sql1.$sql2.$sql3;
       echo $sql;
       if(mysql_query($sql)){
          echo "Service Bank Added SuccessfuL!!";
          $token = $this->datacenterF->encode($p[NID]);
          $this->saveBankData_Cloud(1, $token, $p[INCOME], $p[JOB]);
          $this->saveBankData_Cloud(2, $token, $p[InvoiceAmount], $p[InvoiceType], $p[InvoiceAssign], $p[InvoiceDate]);
       }else{
          echo "Link Database failed, please try again later!!";
          die();
       }    
    }

    function delBankData($id){
    	 
       $sql1 = " DELETE FROM `SERVICECENTER`.`BANK` ";
       $sql2 = " WHERE ID = '$id'";
       $sql = $sql1.$sql2;
       echo $sql;
       if(mysql_query($sql)){
          echo "Service Bank Deleted SuccessfuL!!";
       }else{
          echo "Link Database failed, please try again later!!";
          die();
       }    
    }
    
    public function updateBankData($p){
       $sql1 = " UPDATE `SERVICECENTER`.`BANK` ";
       $sql2 = " SET NAME = '$p[NAME]', BPEL = '$p[BPEL]', DATASOURCE = '$p[DATASOURCE]',";
       $sql3 = " `PRICE` = '$p[PRICE]'";
       $sql4 = " WHERE ID = '$p[ID]' ";
       $sql = $sql1.$sql2.$sql3.$sql4;
       echo $sql;
       if(mysql_query($sql)){
           echo "Service Bank Updated SuccessfuL!!";   
       }else{
           echo "Link Database failed, please try again later!!";
           die();
       }
       
       $_POST = null;
    }
    
    public function getBankManager($uid){
    	  	   
  	   $this->datacenterF->insertAccounting("BankManager", $uid, 1);
  	   $this->datacenterF->insertAccounting("BankManagerTime", $uid, 1);
    	
       $result = mysql_query("SELECT * FROM SERVICECENTER.BANK order by id desc");
       $row = mysql_fetch_row($result);    	
    	 $FormArr = array();
    	 $dataset1 = $this->getBankData_Cloud(1); 
    	 $dataset2 = $this->getBankData_Cloud(2);
    	 
    	 array_push($FormArr, "<a href=\"javascript:history.back()\"><- Back</a> - ");
    	 array_push($FormArr, "<a href=\"./index.php?act=addBankData\">Add New Bank User</a><BR><BR><P>");
    	 array_push($FormArr, "<table  border=\"1\" WIDTH=\"100%\">");
    	 array_push($FormArr, "<tr BGCOLOR=\"#e8f8d0\"><td align=center>Del</td><td align=center>Name</td><td align=center>Security No</td><td align=center>Income</td><td align=center>Job</td><td align=center>InvoiceAmount</td><td align=center>InvoiceType</td><td align=center>InvoiceAssign</td><td align=center>InvoiceDate</td></tr>");
       while($row != null){
    	    list($V_ID,$V_NAME,$V_NID) = $row;
          array_push($FormArr, "<tr>");
          array_push($FormArr, "<td align=center><a href=\"./index.php?act=delBank&id=$V_ID\">X</a></td>");
          array_push($FormArr, "<td>$V_NAME</td>");
          array_push($FormArr, "<td>$V_NID</td>");
          $dataArr1 = $this->datacenterF->getData($dataset1, md5($V_NID));
          $dataArr2 = $this->datacenterF->getData($dataset2, md5($V_NID));
          if($dataArr1[2] == ""){
             array_push($FormArr, "<td>Updating...</td>");
             array_push($FormArr, "<td>Updating...</td>");           	  
          }else{
             array_push($FormArr, "<td>$dataArr1[2]</td>");
             array_push($FormArr, "<td>$dataArr1[3]</td>");          
          }
          if($dataArr2[2] == ""){
             array_push($FormArr, "<td>Updating...</td>");
             array_push($FormArr, "<td>Updating...</td>");    
             array_push($FormArr, "<td>Updating...</td>");
             array_push($FormArr, "<td>Updating...</td>");                     	  
          }else{
             array_push($FormArr, "<td>$dataArr2[2]</td>");
             array_push($FormArr, "<td>$dataArr2[3]</td>");
             array_push($FormArr, "<td>$dataArr2[4]</td>");  
             array_push($FormArr, "<td>$dataArr2[5]</td>");           
          }           

          array_push($FormArr, "</tr>");
          
          $row = mysql_fetch_row($result);
       }   
       array_push($FormArr, "</table>");	 
       return $FormArr; 
    }     
    
    public function CheckCredit($uid){
    	 
    	 mysql_query("TRUNCATE TABLE `SERVICECENTER`.`PROCESSTEMP`");
    	 mysql_query("TRUNCATE TABLE `SERVICECENTER`.`MONITOR`");
    	 
    	 $bankArr = array();
       $resultBank = mysql_query("SELECT * FROM SERVICECENTER.BANK order by id desc");
       $rowBank = mysql_fetch_row($resultBank); 
       while($rowBank != null){
       	  list($V_ID,$V_NAME,$V_NID) = $rowBank;     	  
       	  $sql1 = "INSERT INTO `SERVICECENTER`.`PROCESSTEMP` ";
          $sql2 = " (`ID`,`TOKEN`,`RESULT`) VALUES ('','".md5($V_NID)."','')";
          mysql_query($sql1.$sql2);
          $bankArr[md5($V_NID)] = $V_NAME."/".$V_NID;
       	  $rowBank = mysql_fetch_row($resultBank);
       }
       
       $this->datacenterF->insertAccounting("CheckCredit", $uid, 1);
    	 exec("php lib/ForkProcess.php", $arrExec);
    	 
    	 $dataset1 = $this->getBankData_Cloud(1);
    	 $dataset2 = $this->getBankData_Cloud(2);
    	 
    	 echo "<a href=\"javascript:history.back()\"><- Back</a> - ";
    	 
    	 echo "<Table border=1 >";
    	 echo "<TR BGCOLOR=\"#e8f8d0\"><TD>Name</TD><TD>Scurity No</TD><TD>Token</TD><TD>Income</TD><TD>Jobs</TD>";
    	 echo "<TD>InvoiceAmount</TD><TD>InvoiceType</TD><TD>InvoiceAssign</TD><TD>InvoiceDate</TD><TD>Credit</TD><TD>Default Prob.</TD></TR>";
    	 
    	 foreach($arrExec as $id => $result){
          $a1 = split('-', $result); //0-> Token, 1->Result
          $a2 = split('/', $a1[1]);  //0->Total, 1->Prob
          $a3 = split('/', $bankArr[$a1[0]]); //0->Name, 1->NID
          
          if($a1[1] == '' || $a2[0] == '' || $a3[0] == '') continue;
          $dataArr1 = $this->datacenterF->getData($dataset1, $a1[0]);
          $dataArr2 = $this->datacenterF->getData($dataset2, $a1[0]);
          
    	    echo "<TR><TD>$a3[0]</TD><TD>$a3[1]</TD><TD>$a1[0]</TD>";
    	    echo "<TD>$dataArr1[2]</TD><TD>$dataArr1[3]</TD>";
    	    echo "<TD>$dataArr2[2]</TD><TD>$dataArr2[3]</TD><TD>$dataArr2[4]</TD><TD>$dataArr2[5]</TD>";
    	    echo "<TD>$a2[0]</TD><TD>$a2[1]</TD></TR>";          
    	 }
 	      echo "</TABLE>";
 	      
        $result = mysql_query("SELECT SUM(SEC) FROM SERVICECENTER.MONITOR WHERE `AP`='1'");
        if(is_resource($result)) $row = mysql_fetch_row($result);    	
    	  list($ap1) = $row; 
        $result = mysql_query("SELECT SUM(SEC) FROM SERVICECENTER.MONITOR WHERE `AP`='2'");
        if(is_resource($result)) $row = mysql_fetch_row($result);    	
    	  list($ap2) = $row;
        $result = mysql_query("SELECT SUM(SEC) FROM SERVICECENTER.MONITOR WHERE `AP`='3'");
        if(is_resource($result)) $row = mysql_fetch_row($result);    	
    	  list($ap3) = $row;    	  	     
 	      
 	      echo "<br><br>Computing Resource:<br><TABLE border=1>";
 	      echo "<TR BGCOLOR=\"#e8f8d0\"><TD>Item</TD><TD>Value</TD></TR>";
 	      echo "<TR><TD>Task</TD><TD>".count($bankArr)."</TD></TR>";
 	      echo "<TR><TD>Ap1</TD><TD>$ap1 Sec</TD></TR>";
 	      echo "<TR><TD>Ap2</TD><TD>$ap2 Sec</TD></TR>";
 	      echo "<TR><TD>Ap3</TD><TD>$ap3 Sec</TD></TR>";
 	      echo "<TR><TD>Total</TD><TD>".($ap1+$ap2+$ap3)." Sec</TD></TR>"; 	      
 	      echo "<TR><TD>Average</TD><TD>".(($ap1+$ap2+$ap3)/(count($bankArr)))." Sec</TD></TR>";
 	      echo "</TABLE>";
        
        $this->datacenterF->insertAccounting("CheckCreditTime", $uid, ($ap1+$ap2+$ap3));
        
    	 //print_r($arrExec);
    }
    
    // 解構函式
    public function __destruct()
    {
        $this->link = NULL;
    }

}