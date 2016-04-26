<?php

class pubTab
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

    public function getRandom5(){
    	 $return = array();
       $sql = "select * from member order by rand() limit 5";  	
       $result = mysql_query($sql);
       $row = mysql_fetch_row($result);
       while($row != null){
          list($V_ID,$V_UID,$V_PASSWORD,$V_NAME,$V_PERSONAL_SITE,$V_PERSONAL_DOC,$V_PUB_DOC,$V_CLASS) = $row;
          $content="";
          if($V_PUB_DOC == ""){
          	 $content = "Hoops.....this comment is empty...";
          }else{
             $content = $this->googleF->getDocs($V_PUB_DOC);
             
          }
          
          array_push($return , array("T_CLASS"=>$V_CLASS, "T_NAME"=>$V_NAME,"T_CONTENT"=>$content));
          $row = mysql_fetch_row($result);
       }  
       
       //print_r($return);
       return $return; 	 
    }

    public function __destruct()
    {
        $this->link = NULL;
    }

}