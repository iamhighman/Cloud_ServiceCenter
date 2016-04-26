<?php

class participant
{
    static $js_id=0;

    var $googleF;
    var $link;
    
    var $title="Partcipant Gadget";
    var $action="getParticipant";
    
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
    	 //array_push($pref, array("prefName" => ""));
    	 //array_push($pref, array("prefValue" => ""));
    	 //return $pref;
    	 return "";
    }

 public function getParticipant($C_ID){     	
        $return = array();
        $result = mysql_query("SELECT a.ID, b.TOPIC, c.NAME, c.IMAGE, c.PUB_DOC,c.PERSONAL_SITE,b.SITE_LINK,b.DOC_LINK,b.DOC_LINK2,b.PPT_LINK,d.DOC_LINK FROM coursepicking AS a, team AS b, member AS c, multiarticle AS d WHERE a.C_ID =$C_ID AND a.T_ID = b.ID AND a.M_ID = c.ID AND d.M_ID = c.U_ID AND d.T_ID = b.ID ORDER BY a.T_ID");
        $row = mysql_fetch_row($result);   
        while($row != null){
           list($a_ID,$b_TOPIC,$c_NAME,$c_IMAGE,$c_PUB_DOC,$c_PERSONAL_SITE,$c_TEAM_SITE,$b_DOC_LINK,$b_DOC_LINK2,$b_PPT_LINK,$d_DOC_LINK) = $row;

           $team_content = $this->googleF->getDocsEmbed($b_DOC_LINK);
           $team_content2 = $this->googleF->getDocsEmbed($b_DOC_LINK2);

           $report_DOC = str_replace("a/ec.nccu.edu.tw/", "", $d_DOC_LINK);
           $report_content = $this->googleF->getDocsEmbed("http://sc.ec.nccu.edu.tw/index.php?act=getShortDocs&link=".urlencode($report_DOC));

           array_push($return , array("TOPIC"=>$b_TOPIC, "NAME"=>$c_NAME, "IMAGE"=>$c_IMAGE,"PUB_DOC"=>$c_PUB_DOC, "PERSONAL_SITE"=>$c_PERSONAL_SITE, "TEAM_SITE"=>$c_TEAM_SITE, "CONTENT"=>$content, "T_CONTENT"=>$Tcontent, "T_PPT_LINK"=>$b_PPT_LINK,"T_DOC"=>$team_content,"T_DOC2"=>$team_content2,"T_DOCLINK"=>$b_DOC_LINK,"T_DOCLINK2"=>$b_DOC_LINK2,"report_content"=>$report_content,"report_DOC"=>$d_DOC_LINK));
           $row = mysql_fetch_row($result);
        }
        return $return;
    }
}
