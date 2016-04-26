<?php

class ComponentManager
{

    var $title="ComponentManager Gadget";
    var $action="ComponentManager";
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
    
    public function getComponentData($id){
        $result = mysql_query("SELECT * FROM SERVICECENTER.COMPONENT WHERE ID = '$id'");
        $row = mysql_fetch_row($result);
        return $row;         	
    }
    
    public function getComponentDataForm($id){

    	  list($V_ID,$V_NAME,$V_TYPE,$V_FUNCTION,$V_INPUT,$V_OUTPUT,$V_NOTE) = $this->getComponentData($id);  
    	  
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=updateConponent\">");
    	  array_push($FormArr, "<input name=\"ID\" type=\"hidden\" size=\"50\" value=\"$V_ID\">");
    	  array_push($FormArr, "Component ID: $V_ID<br>");
    	  array_push($FormArr, "Name: <input name=\"NAME\" type=\"text\" size=\"50\" value=\"$V_NAME\"><br>");
    	  array_push($FormArr, "Type: <input name=\"TYPE\" type=\"text\" size=\"50\" value=\"$V_TYPE\"><br>");
    	  array_push($FormArr, "Function detail: <input name=\"FUNCTION\" type=\"text\" size=\"50\" value=\"$V_FUNCTION\"><br>");
    	  array_push($FormArr, "Input: <input name=\"INPUT\" type=\"text\" size=\"50\" value=\"$V_INPUT\"><br>");
    	  array_push($FormArr, "Output: <input name=\"OUTPUT\" type=\"text\" size=\"50\" value=\"$V_OUTPUT\"><br>");
    	  array_push($FormArr, "Note: <textarea rows=\"8\" cols=\"40\" name=\"NOTE\">$V_NOTE</textarea><br>");
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;
    }

    public function getComponentAddForm(){
    	  
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=addComponent\">");
    	  array_push($FormArr, "<input name=\"ID\" type=\"hidden\" size=\"50\" value=\"$V_ID\">");
    	  array_push($FormArr, "Component ID: $V_ID<br>");
    	  array_push($FormArr, "Name: <input name=\"NAME\" type=\"text\" size=\"50\" value=\"$V_NAME\"><br>");
    	  array_push($FormArr, "Type: <input name=\"TYPE\" type=\"text\" size=\"50\" value=\"$V_TYPE\"><br>");
    	  array_push($FormArr, "Function detail: <input name=\"FUNCTION\" type=\"text\" size=\"50\" value=\"$V_FUNCTION\"><br>");
    	  array_push($FormArr, "Input: <input name=\"INPUT\" type=\"text\" size=\"50\" value=\"$V_INPUT\"><br>");
    	  array_push($FormArr, "Output: <input name=\"OUTPUT\" type=\"text\" size=\"50\" value=\"$V_OUTPUT\"><br>");
    	  array_push($FormArr, "Note: <textarea rows=\"8\" cols=\"40\" name=\"NOTE\">$V_NOTE</textarea><br>");
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;	    	  
    }
    
    function addComponentData($p){
  	 
       $sql1 = "INSERT INTO `SERVICECENTER`.`COMPONENT`  ";
       $sql2 = " (`ID`,`NAME`,`TYPE`,`FUNCTION`,`INPUT`,`OUTPUT`,`NOTE`) VALUES";
       $sql3 = " ('','$p[NAME]','$p[TYPE]','$p[FUNCTION]','$p[INPUT]','$p[OUTPUT]','$p[NOTE]')";
       $sql = $sql1.$sql2.$sql3;
       echo $sql;
       if(mysql_query($sql)){
          echo "Component Added SuccessfuL!!";
       }else{
          echo "Link Database failed, please try again later!!";
          die();
       }    
    }

    function delComponentData($id){
    	 
       $sql1 = " DELETE FROM `SERVICECENTER`.`COMPONENT` ";
       $sql2 = " WHERE ID = '$id'";
       $sql = $sql1.$sql2;
       echo $sql;
       if(mysql_query($sql)){
          echo "Component Deleted SuccessfuL!!";
       }else{
          echo "Link Database failed, please try again later!!";
          die();
       }    
    }
    
    public function updateComponentData($p){
       $sql1 = " UPDATE `SERVICECENTER`.`COMPONENT` ";
       $sql2 = " SET NAME = '$p[NAME]', TYPE = '$p[TYPE]', FUNCTION = '$p[FUNCTION]',";
       $sql3 = " `INPUT` = '$p[INPUT]', OUTPUT = '$p[OUTPUT]', NOTE = '$p[NOTE]'";
       $sql4 = " WHERE ID = '$p[ID]' ";
       $sql = $sql1.$sql2.$sql3.$sql4;
       echo $sql;
       if(mysql_query($sql)){
           echo "Component Updated SuccessfuL!!";   
       }else{
           echo "Link Database failed, please try again later!!";
           die();
       }
       
       $_POST = null;    	
    	
    }
    
    public function getComponentManager(){
        $result = mysql_query("SELECT * FROM SERVICECENTER.COMPONENT order by TYPE, NAME desc");
        $row = mysql_fetch_row($result);    	
    	  $FormArr = array();
    	  array_push($FormArr, "<a href=\"./index.php?act=addConponentData\">Add New Component</a><BR><BR><P>");
    	  array_push($FormArr, "<table border=\"1\" WIDTH=\"100%\">");
    	  array_push($FormArr, "<tr BGCOLOR=\"#e8f8d0\"><td align=center>Edit</td><td align=center>Del</td><td align=center>Name</td><td align=center>Type</td><td align=center>Function</td><td align=center>Input</td><td align=center>Output</td><td align=center>Note</td></tr>");
        while($row != null){
    	     list($V_ID,$V_NAME,$V_TYPE,$V_FUNCTION,$V_INPUT,$V_OUTPUT,$V_NOTE) = $row;  
           array_push($FormArr, "<tr>");
           
           array_push($FormArr, "<td align=center><a href=\"./index.php?act=editComponentData&id=$V_ID\">►</a></td>");
           array_push($FormArr, "<td align=center><a href=\"./index.php?act=delComponent&id=$V_ID\">X</a></td>");
           array_push($FormArr, "<td>$V_NAME</td>");
           array_push($FormArr, "<td>$V_TYPE</td>");
           array_push($FormArr, "<td>$V_FUNCTION</td>");
           array_push($FormArr, "<td>$V_INPUT</td>");
           array_push($FormArr, "<td>$V_OUTPUT</td>");
           array_push($FormArr, "<td>$V_NOTE</td>");           
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