<?php

class multiArticle
{
   static $js_id=0;
    var $googleF;
    var $link;
  
    var $title="multiArticle Gadget";
    var $action="multiArticle";
    
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
    private function VerifyPassword($uid, $password){
        $result = mysql_query(" SELECT * FROM `member` WHERE `U_ID` = '$uid' AND `PASSWORD` = '$password'");
        $rows = mysql_num_rows($result);
        //echo "x".$rows;
        if($rows){
        	
           return true;	
        }else{
        
           return false;
        } 
    }
    private function VerifyRepeatPost($MA_ID, $U_ID){
        $result = mysql_query(" SELECT * FROM `score` WHERE `MA_ID` = '$MA_ID' AND `U_ID` = '$U_ID'");
        $rows = mysql_num_rows($result);
        //echo "x".$rows;
        if($rows){
           return true;	
        }else{
           return false;
        } 
    }
    public function pubTree($MA_ID){
        $result = mysql_query("SELECT CLICK_COUNT FROM `multiarticle` WHERE `ID` = '$MA_ID'");
        $row = mysql_fetch_row($result);  
        list($CLICK_COUNT) = $row;
        if($CLICK_COUNT<20){
        	return "http://sc.ec.nccu.edu.tw/theme/images/photo/tree_0.gif";}
         elseif($CLICK_COUNT>=20&&$CLICK_COUNT<40){
        	return "http://sc.ec.nccu.edu.tw/theme/images/photo/tree_1.gif";}
         elseif($CLICK_COUNT>=40&&$CLICK_COUNT<60){
        	return "http://sc.ec.nccu.edu.tw/theme/images/photo/tree_2.gif";}
         else{
        	return "http://sc.ec.nccu.edu.tw/theme/images/photo/tree_3.gif";}	
    }
    public function countComment($ID){
    	    $result = mysql_query("SELECT count(s.DESCRIPTION) FROM score AS s, member AS m WHERE s.MA_ID = '$ID' AND s.U_NAME = m.NAME"); 
	    $row = mysql_fetch_row($result);  
            list($number) = $row;
            return $number;   
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

    public function Article(){     	
        
        $return = array();
        $result = mysql_query("SELECT b.ID,b.M_ID,b.T_ID,b.DOC_LINK,b.CLICK_COUNT,b.TOPIC,b.TAG,b.ARTICLE,b.DATE,a.PERSONAL_SITE,a.NAME FROM member AS a ,multiarticle AS b WHERE a.U_ID=b.M_ID ORDER BY b.CLICK_COUNT DESC limit 0,20");
        $row = mysql_fetch_row($result);   
        while($row != null){
           list($ID,$M_ID,$T_ID,$DOC_LINK,$CLICK_COUNT,$TOPIC,$TAG,$ARTICLE,$DATE,$PERSONAL_SITE,$NAME) = $row;
           array_push($return , array("ID"=>$ID, "M_ID"=>$M_ID, "T_ID"=>$T_ID,"DOC_LINK"=>$DOC_LINK, "CLICK_COUNT"=>$CLICK_COUNT, "TOPIC"=>$TOPIC, "TAG"=>$TAG, "ARTICLE"=>$ARTICLE, "DATE"=>$DATE, "PERSONAL_SITE"=>$PERSONAL_SITE,"NAME"=>$NAME));
           $row = mysql_fetch_row($result);

        }
          
        return $return;
    }
    public function CourseGlobalIT(){     	
        
        $return = array();
        $result = mysql_query("SELECT b.ID, b.M_ID, b.T_ID, b.DOC_LINK, b.CLICK_COUNT, b.TOPIC, b.TAG, b.ARTICLE, b.DATE, a.PERSONAL_SITE, a.NAME FROM member AS a, multiarticle AS b, coursepicking AS c WHERE a.U_ID = b.M_ID AND C_ID='13' AND c.T_ID = b.T_ID AND c.M_ID = a.ID ORDER BY b.CLICK_COUNT DESC");
        $row = mysql_fetch_row($result);   
        while($row != null){
           list($ID,$M_ID,$T_ID,$DOC_LINK,$CLICK_COUNT,$TOPIC,$TAG,$ARTICLE,$DATE,$PERSONAL_SITE,$NAME) = $row;
           array_push($return , array("ID"=>$ID, "M_ID"=>$M_ID, "T_ID"=>$T_ID,"DOC_LINK"=>$DOC_LINK, "CLICK_COUNT"=>$CLICK_COUNT, "TOPIC"=>$TOPIC, "TAG"=>$TAG, "ARTICLE"=>$ARTICLE, "DATE"=>$DATE, "PERSONAL_SITE"=>$PERSONAL_SITE,"NAME"=>$NAME));
          
           $row = mysql_fetch_row($result);

        }
          
        return $return;
    }
    public function CourseBusinessNet(){     	
        
        $return = array();
        $result = mysql_query("SELECT b.ID, b.M_ID, b.T_ID, b.DOC_LINK, b.CLICK_COUNT, b.TOPIC, b.TAG, b.ARTICLE, b.DATE, a.PERSONAL_SITE, a.NAME FROM member AS a, multiarticle AS b, coursepicking AS c WHERE a.U_ID = b.M_ID AND C_ID='6' AND c.T_ID = b.T_ID AND c.M_ID = a.ID ORDER BY b.CLICK_COUNT DESC");
        $row = mysql_fetch_row($result);   
        while($row != null){
           list($ID,$M_ID,$T_ID,$DOC_LINK,$CLICK_COUNT,$TOPIC,$TAG,$ARTICLE,$DATE,$PERSONAL_SITE,$NAME) = $row;
           array_push($return , array("ID"=>$ID, "M_ID"=>$M_ID, "T_ID"=>$T_ID,"DOC_LINK"=>$DOC_LINK, "CLICK_COUNT"=>$CLICK_COUNT, "TOPIC"=>$TOPIC, "TAG"=>$TAG, "ARTICLE"=>$ARTICLE, "DATE"=>$DATE, "PERSONAL_SITE"=>$PERSONAL_SITE,"NAME"=>$NAME));
          
           $row = mysql_fetch_row($result);

        }
          
        return $return;
    }
    public function CourseGlobalInvest(){     	
        
        $return = array();
        $result = mysql_query("SELECT b.ID, b.M_ID, b.T_ID, b.DOC_LINK, b.CLICK_COUNT, b.TOPIC, b.TAG, b.ARTICLE, b.DATE, a.PERSONAL_SITE, a.NAME FROM member AS a, multiarticle AS b, coursepicking AS c WHERE a.U_ID = b.M_ID AND C_ID='9' AND c.T_ID = b.T_ID AND c.M_ID = a.ID ORDER BY b.CLICK_COUNT DESC");
        $row = mysql_fetch_row($result);   
        while($row != null){
           list($ID,$M_ID,$T_ID,$DOC_LINK,$CLICK_COUNT,$TOPIC,$TAG,$ARTICLE,$DATE,$PERSONAL_SITE,$NAME) = $row;
           array_push($return , array("ID"=>$ID, "M_ID"=>$M_ID, "T_ID"=>$T_ID,"DOC_LINK"=>$DOC_LINK, "CLICK_COUNT"=>$CLICK_COUNT, "TOPIC"=>$TOPIC, "TAG"=>$TAG, "ARTICLE"=>$ARTICLE, "DATE"=>$DATE, "PERSONAL_SITE"=>$PERSONAL_SITE,"NAME"=>$NAME));
            $row = mysql_fetch_row($result);
		}
         
        return $return;
    }
     public function CourseDiscuss(){     	
        
        $return = array();
        $result = mysql_query("SELECT b.M_ID, b.T_ID, b.DOC_LINK, b.CLICK_COUNT, b.TOPIC, b.TAG, b.ARTICLE, b.DATE, a.PERSONAL_SITE, a.NAME FROM member AS a, multiarticle AS b WHERE a.U_ID = b.M_ID AND b.T_ID = '53' ORDER BY b.CLICK_COUNT DESC");
        $row = mysql_fetch_row($result);   
        while($row != null){
           list($ID,$M_ID,$T_ID,$DOC_LINK,$CLICK_COUNT,$TOPIC,$TAG,$ARTICLE,$DATE,$PERSONAL_SITE,$NAME) = $row;
           array_push($return , array("ID"=>$ID, "M_ID"=>$M_ID, "T_ID"=>$T_ID,"DOC_LINK"=>$DOC_LINK, "CLICK_COUNT"=>$CLICK_COUNT, "TOPIC"=>$TOPIC, "TAG"=>$TAG, "ARTICLE"=>$ARTICLE, "DATE"=>$DATE, "PERSONAL_SITE"=>$PERSONAL_SITE,"NAME"=>$NAME));
          $row = mysql_fetch_row($result);
		}
          
        return $return;
    }
    public function LatestArticle(){     	
        
        $return = array();
        $result = mysql_query("SELECT DISTINCT b.ID, b.M_ID, b.T_ID, b.DOC_LINK, b.CLICK_COUNT, b.TOPIC, b.TAG, b.ARTICLE, b.DATE, a.PERSONAL_SITE, a.NAME FROM member AS a, multiarticle AS b WHERE a.U_ID = b.M_ID ORDER BY b.DATE DESC LIMIT 0,20");
        $row = mysql_fetch_row($result);   
        while($row != null){
           list($ID,$M_ID,$T_ID,$DOC_LINK,$CLICK_COUNT,$TOPIC,$TAG,$ARTICLE,$DATE,$PERSONAL_SITE,$NAME) = $row;
           array_push($return , array("ID"=>$ID, "M_ID"=>$M_ID, "T_ID"=>$T_ID,"DOC_LINK"=>$DOC_LINK, "CLICK_COUNT"=>$CLICK_COUNT, "TOPIC"=>$TOPIC, "TAG"=>$TAG, "ARTICLE"=>$ARTICLE, "DATE"=>$DATE, "PERSONAL_SITE"=>$PERSONAL_SITE,"NAME"=>$NAME,"TREE"=>$this->pubTree($ID)));
           $row = mysql_fetch_row($result);
        }
        
       return $return;
    }
    public function findTag($tag){     	
         $return = array();
        $result = mysql_query("SELECT b.ID, b.M_ID, b.T_ID, b.DOC_LINK, b.CLICK_COUNT, b.TOPIC, b.TAG, b.ARTICLE, b.DATE, a.PERSONAL_SITE, a.NAME FROM member AS a, multiarticle AS b WHERE a.U_ID = b.M_ID AND b.TAG='$tag' ORDER BY b.DATE DESC LIMIT 0,20");
        $row = mysql_fetch_row($result);   
        while($row != null){
           list($ID,$M_ID,$T_ID,$DOC_LINK,$CLICK_COUNT,$TOPIC,$TAG,$ARTICLE,$DATE,$PERSONAL_SITE,$NAME) = $row;
           array_push($return , array("ID"=>$ID, "M_ID"=>$M_ID, "T_ID"=>$T_ID,"DOC_LINK"=>$DOC_LINK, "CLICK_COUNT"=>$CLICK_COUNT, "TOPIC"=>$TOPIC, "TAG"=>$TAG, "ARTICLE"=>$ARTICLE, "DATE"=>$DATE, "PERSONAL_SITE"=>$PERSONAL_SITE,"NAME"=>$NAME));
           $row = mysql_fetch_row($result);
             }
          
        return $return;
    }
    public function getStdArticle($id){    
        $return = array();
        $result = mysql_query("SELECT b.ID, b.M_ID, b.T_ID, b.DOC_LINK, b.CLICK_COUNT, b.TOPIC, b.TAG, b.ARTICLE, b.DATE, a.PERSONAL_SITE, a.NAME FROM member AS a, multiarticle AS b WHERE a.U_ID = b.M_ID AND a.U_ID='$id' ORDER BY b.DATE DESC LIMIT 0,20");
        $row = mysql_fetch_row($result);   
        while($row != null){
           list($ID,$M_ID,$T_ID,$DOC_LINK,$CLICK_COUNT,$TOPIC,$TAG,$ARTICLE,$DATE,$PERSONAL_SITE,$NAME) = $row;
           array_push($return , array("ID"=>$ID, "M_ID"=>$M_ID, "T_ID"=>$T_ID,"DOC_LINK"=>$DOC_LINK, "CLICK_COUNT"=>$CLICK_COUNT, "TOPIC"=>$TOPIC, "TAG"=>$TAG, "ARTICLE"=>$ARTICLE, "DATE"=>$DATE, "PERSONAL_SITE"=>$PERSONAL_SITE,"NAME"=>$NAME));
           $row = mysql_fetch_row($result);
        }
        return $return;
    }
    
    public function getArticle($id){     	
        
        $returnArr = array();
        $result = mysql_query("SELECT DISTINCT b.ID, b.M_ID, b.T_ID, b.DOC_LINK, b.CLICK_COUNT, b.TOPIC, b.TAG, b.ARTICLE, b.DATE, a.PERSONAL_SITE, a.NAME, a.PUB_DOC, a.IMAGE FROM member AS a, multiarticle AS b, coursepicking AS c WHERE a.U_ID = b.M_ID AND c.T_ID = b.T_ID AND b.id = '$id' ORDER BY b.CLICK_COUNT DESC ");
        $row = mysql_fetch_row($result); 
        $innerArr = ARRAY();
        while($row != null){
           $CLICK_COUNT_ADD=0;
           list($ID,$M_ID,$T_ID,$DOC_LINK,$CLICK_COUNT,$TOPIC,$TAG,$ARTICLE,$DATE,$PERSONAL_SITE,$NAME,$PUB_DOC,$M_IMAGE) = $row;
            $e_PUB_DOC = str_replace("a/ec.nccu.edu.tw/", "", $PUB_DOC);
            $content = $this->googleF->getDocsEmbed("http://sc.ec.nccu.edu.tw/index.php?act=getShortDocs&link=".urlencode($e_PUB_DOC));
	    $result2 = mysql_query("SELECT s.SCORE, s.DESCRIPTION, s.U_ID, s.U_NAME, s.TIME, m.IMAGE FROM score AS s, member AS m WHERE s.MA_ID = '$ID' AND s.U_NAME = m.NAME"); 
	    $row2 = mysql_fetch_row($result2);  
	   while($row2 != null){
               list($SCORE,$DESCRIPTION,$U_ID,$U_NAME,$TIME,$IMAGE) = $row2;
               array_push($innerArr , array("SCORE"=>$SCORE, "DESCRIPTION"=>$DESCRIPTION,"U_ID"=>$U_ID,"U_NAME"=>$U_NAME,"TIME"=>$TIME,"IMAGE"=>$IMAGE));
              $row2 = mysql_fetch_row($result2);
  
            }	 
            if(strlen($DOC_LINK)>0)
            {
              $judge = strstr($DOC_LINK,Presentation); 
                if($judge != false){
            		$e_Ppt_DOC = str_replace("Presentation?docid=", "EmbedSlideshow?docid=", $DOC_LINK);
            		$e_Ppt_DOC = str_replace("PresentationEditor?id=", "EmbedSlideshow?docid=", $e_Ppt_DOC);
           		 array_push($returnArr , array("ID"=>$ID, "M_ID"=>$M_ID, "T_ID"=>$T_ID,"DOC_LINK"=>$e_Ppt_DOC, "CLICK_COUNT"=>$CLICK_COUNT, "TOPIC"=>$TOPIC, "TAG"=>$TAG, "ARTICLE"=>$ARTICLE, "DATE"=>$DATE, "PERSONAL_SITE"=>$PERSONAL_SITE,"NAME"=>$NAME,"M_IMAGE"=>$M_IMAGE,"PUB_DOC"=>$PUB_DOC,"CONTENT"=>$content,"SCORE"=>$SCORE,"DESCRIPTION"=>$DESCRIPTION,"U_NAME"=>$U_NAME,"TIME"=>$TIME,"CommentArr" => $innerArr,"COUNT_COMMENT" => $this->countComment($ID),"TREE"=>$this->pubTree($ID)));
		}
	   	else{
	                $e_docs_link = str_replace("View?docid", "Doc?docid", $DOC_LINK);
			array_push($returnArr , array("ID"=>$ID, "M_ID"=>$M_ID, "T_ID"=>$T_ID,"DOC_LINK"=>$e_docs_link, "CLICK_COUNT"=>$CLICK_COUNT, "TOPIC"=>$TOPIC, "TAG"=>$TAG, "ARTICLE"=>$ARTICLE, "DATE"=>$DATE, "PERSONAL_SITE"=>$PERSONAL_SITE,"NAME"=>$NAME,"M_IMAGE"=>$M_IMAGE,"PUB_DOC"=>$PUB_DOC,"CONTENT"=>$content,"SCORE"=>$SCORE,"DESCRIPTION"=>$DESCRIPTION,"U_NAME"=>$U_NAME,"TIME"=>$TIME,"CommentArr" => $innerArr,"COUNT_COMMENT" => $this->countComment($ID),"TREE"=>$this->pubTree($ID)));	   	    
		}
            }else{
	    	$NO_Ppt_link = "http://docs.google.com/Presentation?docid=d4475br_1477fqg6m42k";
	        $p_Ppt_DOC = str_replace("Presentation?docid=", "EmbedSlideshow?docid=", $NO_Ppt_link);
		array_push($returnArr , array("ID"=>$ID, "M_ID"=>$M_ID, "T_ID"=>$T_ID,"DOC_LINK"=>$e_Ppt_DOC, "CLICK_COUNT"=>$CLICK_COUNT, "TOPIC"=>$TOPIC, "TAG"=>$TAG, "ARTICLE"=>$ARTICLE, "DATE"=>$DATE, "PERSONAL_SITE"=>$PERSONAL_SITE,"NAME"=>$NAME,"M_IMAGE"=>$M_IMAGE,"PUB_DOC"=>$PUB_DOC,"CONTENT"=>$content,"SCORE"=>$SCORE,"DESCRIPTION"=>$DESCRIPTION,"U_NAME"=>$U_NAME,"TIME"=>$TIME,"CommentArr" => $innerArr,"COUNT_COMMENT" => $this->countComment($ID),"TREE"=>$this->pubTree($ID)));
	    }
	   $CLICK_COUNT_ADD=$CLICK_COUNT+1;
	   $return1 = array();
           $sql1 = " UPDATE multiarticle ";
           $sql2 = " SET CLICK_COUNT = '$CLICK_COUNT_ADD'";
           $sql3 = " WHERE ID = '$ID'";
           $sql = $sql1.$sql2.$sql3;          
           if(mysql_query($sql ,$this->link)){
           	 //echo "File successfully upload!";  
           }else{
                //echo "Failed! We encounter some technical issues. Sorry!!"; 
           }	
	    $row = mysql_fetch_row($result);
	 } 
         //echo mysql_num_rows($return);
       return $returnArr;
    }
   
    
    public function scoreArticle($p){     	
	$return = array();
	
	 if(!$this->VerifyPassword($p[U_ID],$p[password])){
    	 	   array_push($return, "");
    	 	   
    	 	  echo "<a href=http://sc.ec.nccu.edu.tw/index.php?act=Article>密碼錯誤,重新輸入!</a>";
    	 }else{
    	 	if(!$this->VerifyRepeatPost($p[MA_ID],$p[U_ID]))
    	 	{	
    	 		$result = mysql_query("SELECT NAME FROM member WHERE U_ID='$p[U_ID]'");
        		$row = mysql_fetch_row($result);   
        		list($NAME) = $row;
    	 		
    	 		$date=date("Y-n-d H:i:s");
    	    		$sql1 = " INSERT INTO `score` ";
       	   		$sql2 = " (`ID`,`MA_ID`,`SCORE`,`DESCRIPTION`,`U_ID`,`U_NAME`,`TIME`) VALUES";
           		$sql3 = " ('','$p[MA_ID]','$p[SCORE]','$p[DESCRIPTION]','$p[U_ID]','$NAME','$date')";
           		$sql = $sql1.$sql2.$sql3;
           		//echo $sql;
           	if(mysql_query($sql ,$this->link))
{
           		  array_push($return, "comment added successfully!");      
         	  }
         		else{
             	 	array_push($return, "Failed! We encounter some technical issues. Sorry!!");
          	 		}
                  return $return;  
		}
    	       echo "<a href=http://sc.ec.nccu.edu.tw/index.php?act=Article>重複發表,回上頁!</a>";
           }
           $_POST = null;
    	 } 
    	 public function postArticle($p){ 
    	 	$return = array();
    	 	//array_push($return, "<br><a href=\"http://sc.ec.nccu.edu.tw/index.php?act=ChangePasswordForm\">Previous Page</a><br><br>");
	 	if(!$this->VerifyPassword($p[M_ID],$p[password])){
	           
    	 	   echo "<a href=http://sc.ec.nccu.edu.tw/index.php?act=Article>密碼錯誤，重新輸入</a>";}
    	        else{	
//    	                $Google_Doc = str_replace("a/ec.nccu.edu.tw/", "", $p[Google_Doc]);
//    	                $content = $this->googleF->getShortDocs($Google_Doc,50);
    	                  	        
    	                $date=date("Y-n-d H:i:s");
    	    		echo $date;
    	    		$sql1 = " INSERT INTO `multiarticle` ";
       	   		$sql2 = " (`ID`,`M_ID`,`T_ID`,`DOC_LINK`,`TOPIC`,`TAG`,`ARTICLE`,`DATE`) VALUES";
           		$sql3 = " ('','$p[M_ID]','$p[subtype]','$p[Google_Doc]','$p[TOPIC]','$p[TAG]','$p[ARTICLE]','$date')";
           		$sql = $sql1.$sql2.$sql3;
           		//echo $sql;
           		if(mysql_query($sql ,$this->link)){     		         		  
           		  echo "<a href=http://sc.ec.nccu.edu.tw/index.php?act=Article>發表成功，回上頁</a>";}
         		else{echo "Failed! We encounter some technical issues. Sorry!!";}
         	  		         	
			}
		return $return;  
          	 }

    	         	
}
?>