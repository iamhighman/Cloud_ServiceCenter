<?php

class pubMessage
{
    static $js_id=0;

    var $googleF;
    var $link;
    
    var $title="Bulletin Gadget";
    var $action="pubTab";
    
    function config(){
       $this->link = mysql_connect('localhost', 'root', 'misadmin') or
       die("mysql_connect() failed.");

       mysql_select_db("ELLA", $this->link) or
       die("mysql_select_db() failed.");
       
       mysql_query("SET CHARACTER SET 'utf8'", $this->link);              
    }

    public function __construct()
    {
        $this->config();   
        $this->googleF = new GoogleClass(); 
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
    private function VerifyPassword($uid, $password){
        $result = mysql_query(" SELECT * FROM `member` WHERE `U_ID` = '$uid' AND `PASSWORD` = '$password'");
        $rows = mysql_num_rows($result);
        //echo "x".$rows;
        if($rows){
          return true;}
        else{
          return false;
        } 
    }
    
    
    
public function newIsay($p){
    	if(!$this->VerifyPassword($p[U_ID],$p[password])){ 	 	   
    	 	  echo "<a href=http://sc.ec.nccu.edu.tw/index.php?act=GetPubMessage>密碼錯誤,重新輸入!</a>";
    		 }else{
    	echo "<a href=http://sc.ec.nccu.edu.tw/index.php?act=GetPubMessage>已新增留言!回上頁</a>";
	$FormLink ="http://spreadsheets.google.com/formResponse?key=pS0m_OauUy_GUJ9Ew2Sxxbg";
	$Post = "entry.1.single=".urlencode($p[U_ID])."&entry.2.single=".urlencode($p[comment]); 
	echo $this->googleF->Save2GDB($FormLink, $Post);
	}
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=http://sc.ec.nccu.edu.tw/index.php?act=GetPubMessage\">";
}

    public function getIsay(){
    	
    	$return = array();
	$ViewLink = "http://spreadsheets.google.com/pub?key=pS0m_OauUy_GUJ9Ew2Sxxbg";
	$result = array_reverse($this->googleF->getGDB($ViewLink));
	
	foreach($result as $id => $msg){
  	 if($id>5)break;
   	//echo "In ".$msg[0].": ".$msg[1]." say: ".$msg[2]."<br>";
  	  $result = mysql_query("SELECT NAME,PERSONAL_SITE,PUB_DOC,CLASS,IMAGE,U_ID FROM member WHERE U_ID = '".$msg[1]."'");
          $row = mysql_fetch_row($result);   
          while($row != null){
           list($NAME,$PERSONAL_SITE,$PUB_DOC,$CLASS,$IMAGE,$U_ID) = $row;
           array_push($return , array("NAME"=>$NAME, "PERSONAL_SITE"=>$PERSONAL_SITE, "PUB_DOC"=>$PUB_DOC,"CLASS"=>$CLASS, "IMAGE"=>$IMAGE, "U_ID"=>$U_ID, "COMMENT"=>$msg[2], "TIME"=>$msg[0]));
            $row = mysql_fetch_row($result);
		}
       }
		return $return;
}
    public function getALLsay(){
    	
    	$return = array();
	$ViewLink = "http://spreadsheets.google.com/pub?key=pS0m_OauUy_GUJ9Ew2Sxxbg";
	$result = array_reverse($this->googleF->getGDB($ViewLink));
	
	foreach($result as $id => $msg){
  	  $result = mysql_query("SELECT NAME,PERSONAL_SITE,PUB_DOC,CLASS,IMAGE,U_ID FROM member WHERE U_ID = '".$msg[1]."'");
          $row = mysql_fetch_row($result);   
          while($row != null){
           list($NAME,$PERSONAL_SITE,$PUB_DOC,$CLASS,$IMAGE,$U_ID) = $row;
           array_push($return , array("NAME"=>$NAME, "PERSONAL_SITE"=>$PERSONAL_SITE, "PUB_DOC"=>$PUB_DOC,"CLASS"=>$CLASS, "IMAGE"=>$IMAGE, "U_ID"=>$U_ID, "COMMENT"=>$msg[2], "TIME"=>$msg[0]));
            $row = mysql_fetch_row($result);
		}
       }
		return $return;
}

    public function __destruct()
    {
        $this->link = NULL;
    }

}