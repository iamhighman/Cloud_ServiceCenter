<?php

// 留言版類別
class Login
{

    function config(){
       $this->link = mysql_connect('localhost', 'root', 'misadmin') or
       die("mysql_connect() failed.");

       mysql_select_db("COUGLE", $this->link) or
       die("mysql_select_db() failed.");
       
       mysql_query("SET CHARACTER SET 'utf8'", $this->link);
    }

    // 建構函式
    public function __construct()
    {
        $this->config();
    }
    
    // 取得所有Coupon
    public function login($uid, $pass){
        $result = mysql_query("SELECT UID FROM MEMBER WHERE UID = '$uid' AND PASSWORD = '$pass'");
        $row = mysql_fetch_row($result);
        while($row != null){
           //if exist return true;
           //$this->vaild();
        }
        
        return false;
    }

    private function vaild(){
  	   // do something.
    }
    
    public function logout(){
  	
    }
    // 解構函式
    public function __destruct()
    {
        $this->link = NULL;
    }

}