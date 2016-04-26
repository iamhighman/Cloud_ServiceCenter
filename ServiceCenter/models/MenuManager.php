<?php

class MenuManager
{

    var $title="ServiceMenuManager Gadget";
    var $action="MenuManager";
    var $link;
    
    // 建構函式
    public function __construct()
    {
        //$this->config();
    }

    public function getAction(){
    	 return $this->action;
    }

    public function getTitle(){
    	 return $this->title;
    }
    
    public function getPref(){
    	 $pref = array();
    	 array_push($pref, array("prefName" => ""));
    	 array_push($pref, array("prefValue" => ""));
    	 //return $pref;
    	 return "";
    }   
    
    public function getMenuData($id){
        $result = mysql_query("SELECT * FROM SERVICECENTER.MENU WHERE ID = '$id'");
        $row = mysql_fetch_row($result);
        return $row;
    }
    
    public function getMenuDataForm($id){
    	  list($V_ID,$V_NAME,$V_BPEL,$V_DATASOURCE,$V_AP,$V_INTERFACE,$V_PRICE) = $this->getMenuData($id);  
    	  
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=updateMenu\">");
    	  array_push($FormArr, "<input name=\"ID\" type=\"hidden\" size=\"50\" value=\"$V_ID\">");
    	  array_push($FormArr, "Service Menu ID: $V_ID<br>");
    	  array_push($FormArr, "Name: <input name=\"NAME\" type=\"text\" size=\"50\" value=\"$V_NAME\"><br>");
    	  array_push($FormArr, "DataSource: <input name=\"DATASOURCE\" type=\"text\" size=\"100\" value=\"$V_DATASOURCE\"><br>");
    	  array_push($FormArr, "AP: <input name=\"AP\" type=\"text\" size=\"100\" value=\"$V_AP\"><br>");
    	  array_push($FormArr, "Interface: <input name=\"INTERFACE\" type=\"text\" size=\"100\" value=\"$V_INTERFACE\"><br>");    	  
    	  array_push($FormArr, "Price: <input name=\"PRICE\" type=\"text\" size=\"50\" value=\"$V_PRICE\"><br>");
    	  array_push($FormArr, "BPEL: <textarea rows=\"8\" cols=\"40\" name=\"BPEL\">$V_BPEL</textarea><br>");
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;
    }

    public function getMenuAddForm(){
    	  
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=addMenu\">");
    	  array_push($FormArr, "<input name=\"ID\" type=\"hidden\" size=\"50\" value=\"$V_ID\">");
    	  array_push($FormArr, "Service Menu ID: $V_ID<br>");
    	  array_push($FormArr, "Name: <input name=\"NAME\" type=\"text\" size=\"50\" value=\"$V_NAME\"><br>");
    	  array_push($FormArr, "DataSource: <input name=\"DATASOURCE\" type=\"text\" size=\"100\" value=\"$V_DATASOURCE\"><br>");
    	  array_push($FormArr, "AP: <input name=\"AP\" type=\"text\" size=\"100\" value=\"$V_AP\"><br>");
    	  array_push($FormArr, "Interface: <input name=\"INTERFACE\" type=\"text\" size=\"100\" value=\"$V_INTERFACE\"><br>");    	  
    	  array_push($FormArr, "Price: <input name=\"PRICE\" type=\"text\" size=\"50\" value=\"$V_PRICE\"><br>");
     	  array_push($FormArr, "BPEL: <textarea rows=\"8\" cols=\"40\" name=\"BPEL\">$V_BPEL</textarea><br>");
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;	    	  
    }
    
    function addMenuData($p){
	 
       $sql1 = "INSERT INTO `SERVICECENTER`.`MENU` ";
       $sql2 = " (`ID`,`NAME`,`BPEL`,`DATASOURCE`,`AP`,`INTERFACE`,`PRICE`) VALUES";
       $sql3 = " ('','$p[NAME]','$p[BPEL]','$p[DATASOURCE]','$p[AP]','$p[INTERFACE]','$p[PRICE]')";
       $sql = $sql1.$sql2.$sql3;
       echo $sql;
       if(mysql_query($sql)){
          echo "Service Menu Added SuccessfuL!!";
       }else{
          echo "Link Database failed, please try again later!!";
          die();
       }    
    }

    function delMenuData($id){
    	 
       $sql1 = " DELETE FROM `SERVICECENTER`.`MENU` ";
       $sql2 = " WHERE ID = '$id'";
       $sql = $sql1.$sql2;
       echo $sql;
       if(mysql_query($sql)){
          echo "Service Menu Deleted SuccessfuL!!";
       }else{
          echo "Link Database failed, please try again later!!";
          die();
       }    
    }
    
    public function updateMenuData($p){
       $sql1 = " UPDATE `SERVICECENTER`.`MENU` ";
       $sql2 = " SET NAME = '$p[NAME]', BPEL = '$p[BPEL]', DATASOURCE = '$p[DATASOURCE]',";
       $sql3 = " AP = '$p[AP]', INTERFACE = '$p[INTERFACE]', `PRICE` = '$p[PRICE]'";
       $sql4 = " WHERE ID = '$p[ID]' ";
       $sql = $sql1.$sql2.$sql3.$sql4;
       echo $sql;
       if(mysql_query($sql)){
           echo "Service Menu Updated SuccessfuL!!";   
       }else{
           echo "Link Database failed, please try again later!!";
           die();
       }
       
       $_POST = null;    	
    	
    }
    
    public function getMenuManager(){
        $result = mysql_query("SELECT * FROM SERVICECENTER.MENU order by id desc");
        $row = mysql_fetch_row($result);    	
    	  $FormArr = array();
    	  array_push($FormArr, "<a href=\"./index.php?act=addMenuData\">Add New Service Menu</a><BR><BR><P>");
    	  array_push($FormArr, "<table border=\"1\" WIDTH=\"100%\">");
    	  array_push($FormArr, "<tr BGCOLOR=\"#e8f8d0\"><td align=center>Edit</td><td align=center>Del</td><td align=center>Name</td><td align=center>DataSource</td><td align=center>AP</td><td align=center>Interface</td><td align=center>Price</td><td align=center>Status</td></tr>");
        while($row != null){
    	     list($V_ID,$V_NAME,$V_BPEL,$V_DATASOURCE,$V_AP,$V_INTERFACE,$V_PRICE) = $row;
           array_push($FormArr, "<tr>");
           
           array_push($FormArr, "<td align=center><a href=\"./index.php?act=editMenuData&id=$V_ID\">►</a></td>");
           array_push($FormArr, "<td align=center><a href=\"./index.php?act=delMenu&id=$V_ID\">X</a></td>");
           array_push($FormArr, "<td>$V_NAME</td>");
           array_push($FormArr, "<td>$V_DATASOURCE</td>");
           array_push($FormArr, "<td>$V_AP</td>");
           array_push($FormArr, "<td>$V_INTERFACE</td>");                      
           array_push($FormArr, "<td>$V_PRICE</td>");
           if(strlen($V_BPEL) < 10){
           	  array_push($FormArr, "<td>Waiting...</td>");
           }else{
              array_push($FormArr, "<td>Available...</td>");
           }    
           array_push($FormArr, "</tr>");
           
           $row = mysql_fetch_row($result);
        }   
        array_push($FormArr, "</table>");	 
        return $FormArr; 
    }      
    
    // 解構函式
    public function __destruct()
    {
        $this->link = NULL;
    }

}