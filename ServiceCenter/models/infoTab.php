<?php

class infoTab
{
    static $js_id=0;

    var $googleF;
    private $link;
    
    var $title="Information Gadget";
    var $action="infoTab";
    
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

    public function getContent(){
    	 $arr = array();

       array_push($arr, array($this->googleF->getDocs("http://docs.google.com/Doc?id=dfmx4kv3_32gqhdbqfc")));
       //array_push($arr, array($this->googleF->getDocs("http://docs.google.com/Doc?id=dfmx4kv3_33cjkq2pgc")));
       array_push($arr, array($this->googleF->getDocs("http://docs.google.com/View?docid=dfmx4kv3_35f8hr23g9")));
       //array_push($arr, array($this->googleF->getDocs("http://docs.google.com/View?docid=dfmx4kv3_34gwb9ctc6")));
       
       //$people  = $this->getBundle(, $this->googleF->getDocs("http://docs.google.com/Doc?id=dfmx4kv3_39fxsjdvcg"));
       //$people  = $people.$this->getBundle(,$this->googleF->getDocs("http://docs.google.com/Doc?id=dfmx4kv3_40dfknjqhf"));
       //$people  = $people.$this->getBundle(,$this->googleF->getDocs("http://docs.google.com/Doc?id=dfmx4kv3_40dfknjqhf"));
       array_push($arr, array($people));
       
       return $arr;
    }

    public function getProject(){     	
        $return = array();
        $result = mysql_query("select * from team", $this->link);
        $row = mysql_fetch_row($result);
        while($row != null){
           list($T_ID,$T_CID,$T_TOPIC,$T_SITE_LINK,$T_DOC_LINK,$T_PPT_LINK) = $row;
           array_push($return , array("T_TOPIC"=>$T_TOPIC, "T_SITE_LINK"=>$T_SITE_LINK,"T_DOC_LINK"=>$T_DOC_LINK,"T_PPT_LINK"=>$T_PPT_LINK));
                   
           $row = mysql_fetch_row($result);
        }
        return $return;
    }

    public function getMember(){     	
        $return = array();
        $result = mysql_query("select * from member", $this->link);
        $row = mysql_fetch_row($result);   
        while($row != null){
           list($V_ID,$V_UID,$V_PASSWORD,$V_NAME,$V_PERSONAL_SITE,$V_PERSONAL_DOC,$V_PUB_DOC,$V_CLASS,$V_IMAGE,$V_NOTE) = $row;
           array_push($return , array("NAME"=>$V_NAME, "PERSONAL_SITE"=>$V_PERSONAL_SITE,"PERSONAL_DOC"=>$V_PERSONAL_DOC,"IMAGE"=>$V_IMAGE));
                   
           $row = mysql_fetch_row($result);
        }
        return $return;
    }
    
    public function getCourse(){     	
        $return = array();
        $result = mysql_query("select * from course order by year desc", $this->link);
        $row = mysql_fetch_row($result);
        while($row != null){
           list($V_ID,$V_CLASS,$V_YEAR,$V_NAME,$V_DESC,$V_SITE_LINK) = $row;
           array_push($return , array("C_CLASS"=>$V_CLASS, "C_NAME"=>$V_NAME, "C_YEAR"=>$V_YEAR ,"C_README"=>$V_README,"C_DESC"=>$V_DESC,"C_SITE_LINK"=>$V_SITE_LINK));
           
           $TeamResult = mysql_query("select * from team where C_ID = '$V_ID'");
           $TeamRow = mysql_fetch_row($TeamResult);
           while($TeamRow != null){
              list($T_ID,$T_CID,$T_TOPIC,$T_SITE_LINK,$T_DOC_LINK,$T_PPT_LINK) = $TeamRow;
              $user = $this->getChargeMember($V_ID, $T_ID);              
              $TeamRow = mysql_fetch_row($TeamResult);
              //echo $T_DOC_LINK;
              //$showText = $this->googleF->getShortDocs($T_DOC_LINK, 2000);
              array_push($return , array("User"=>$user, "T_TOPIC"=>$T_TOPIC, "T_SITE_LINK"=>$T_SITE_LINK,"T_DOC_LINK"=>$T_DOC_LINK,"T_PPT_LINK"=>$T_PPT_LINK));
           }           
           $row = mysql_fetch_row($result);
        }
        //print_r($return);
        return $return;
    }
    
    private function getChargeMember($C_ID, $T_ID){
    	 $user = "";
    	 $result = mysql_query("SELECT m.name FROM `coursepicking` as c,member as m WHERE c.C_ID = '$C_ID'  and c.T_ID = '$T_ID' and m.id = c.M_ID", $this->link);
    	 $row = mysql_fetch_row($result);
       while($row != null){
       	 list($u) = $row;
       	 $user .= $u."/";
       	 $row = mysql_fetch_row($result);
       }
       
       return $user;
    }
    
    public function getBundle($title, $content){

     infoTab::$js_id++;
     $t =  "<TR onclick=\"close_open(".infoTab::$js_id.")\"><TD>->$title ClickMe!</Td></TR>";
     $t = $t."<tbody id=\"tb".infoTab::$js_id."\" style=\"DISPLAY: none\">";
     $t = $t."<tr><td>";
     $t = $t.$content;
     $t = $t."</td></tr>";
     $t = $t."</tbody>";  	
     return $t;
  	
    }

    public function __destruct()
    {
        $this->link = NULL;
    }

}