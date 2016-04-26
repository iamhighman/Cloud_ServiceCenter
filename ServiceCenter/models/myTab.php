<?php

class myTab
{
    static $js_id=0;

    var $googleF;
    var $link;
    
    var $title="My Gadget";
    var $action="myTab";
    
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
    	 array_push($pref, array("prefName"=> "uid" , "prefValue"=> ""));
    	 array_push($pref, array("prefName"=> "upa" , "prefValue"=> ""));
    	 return $pref;
    }

    public function ifLogin($uid, $upa){
        $result = mysql_query("select ID from member where U_ID = '$uid' and PASSWORD = '$upa'");
        $row = mysql_fetch_row($result);
        list($id) = $row;
        
        return $id;
    }

//    public function getMain($uid, $upa){
//    	 //加入myTab的主要表單～～
//        $result = mysql_query("select ID from member where U_ID = '$uid' and PASSWORD = '$upa'");
//        $row = mysql_fetch_row($result);
//        list($id) = $row;
//        $data = array();
//        if($id > 0){
//        	 array_push($FormArr, $this->getProfile($id));
//        }else{
//           echo "UserID or password is not correct!";
//        }
//    }

    public function getProfile($id){
    	  $return = array();
        $result = mysql_query("select * from member where id = $id");
        $row = mysql_fetch_row($result);
        list($T_ID,$T_UID,$T_PA,$T_NAME,$T_SITE_LINK,$T_DOC_LINK,$T_PUB_LINK) = $row;
        array_push($return , array("T_ID"=>$T_ID, "T_NAME"=>$T_NAME, "T_SITE_LINK"=>$T_SITE_LINK, "T_DOC_LINK"=>$T_DOC_LINK));

        return $return;
    }

    public function getCourse($id){ 
    	 $return = array(); 
       $result = mysql_query("select * from coursepicking where M_ID = $id"); 
       $row = mysql_fetch_row($result); 
       
       while($row != null){ 
          list($P_ID,$P_MID,$P_CID,$P_TID,$P_GRADE,$P_NOTE) = $row; 
          $resultA = mysql_query("select * from course where ID = $P_CID");
          $rowA = mysql_fetch_row($resultA); 
          list($C_ID,$C_CLASS,$C_YEAR,$C_NAME,$C_DESC,$C_SITE_LINK) = $rowA;
          $resultB = mysql_query("select * from team where ID = $P_TID");
          $rowB = mysql_fetch_row($resultB); 
          list($T_ID,$T_CID,$T_TOPIC,$T_SITELINK,$T_DOCLINK,$T_PPTLINK) = $rowB;          
          array_push($return , array("C_NAME"=>$C_NAME,"C_SITE_LINK"=>$C_SITE_LINK,"T_TOPIC"=>$T_TOPIC,"T_SITELINK"=>$T_SITELINK,"T_DOCLINK"=>$T_DOCLINK,"T_PPTLINK"=>$T_PPTLINK));
       
          $row = mysql_fetch_row($result);
       }               
       return $return;
    }
    public function getPhoto($id){ 
        $return = array();
        $result = mysql_query("select U_ID,IMAGE from member where id = $id");
        $row = mysql_fetch_row($result);
        list($M_ID,$M_PHOTO) = $row;
        array_push($return , array("M_ID"=>$M_ID,"M_PHOTO"=>$M_PHOTO));
 
        return $return;
        
    }


    // 解構函式
    public function __destruct()
    {
        $this->link = NULL;
    }

}