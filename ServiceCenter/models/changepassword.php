<?php

class Manager
{

    var $title="Change PW Gadget";
    var $action="changepassword";
    var $link;

    function config(){
       $this->link = mysql_connect('localhost', 'root', 'misadmin') or
       die("mysql_connect() failed.");

       mysql_select_db("ELLA", $this->link) or
       die("mysql_select_db() failed.");
       
       mysql_query("SET CHARACTER SET 'utf8'", $this->link);
    }

    // 建構函式
    public function __construct()
    {
        $this->config();
    }

    public function getAction(){
    	 return $this->action;
    }

    public function getTitle(){
    	 return $this->title;
    }
    
    public function getPref(){
    	 return "";
    }
    
    public function getChangeForm(){
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=updateData\">");
    	  array_push($FormArr, "代號：<input name=\"UID\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "原密碼：<input name=\"PASSWORD\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "新密碼：<input name=\"NEWPASSWORD1\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "確認新密碼：<input name=\"NEWPASSWORD2\" type=\"text\" size=\"50\" value=\"\"><br>");     	     	  
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;	          	
    }
    
  
    
    // 解構函式
    public function __destruct()
    {
        $this->link = NULL;
    }

}