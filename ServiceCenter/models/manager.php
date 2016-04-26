<?php

class Manager
{

    var $title="Manager Gadget";
    var $action="Manager";
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
    	 $pref = array();
    	 array_push($pref, array("prefName" => ""));
    	 array_push($pref, array("prefValue" => ""));
    	 //return $pref;
    	 return "";
    }
    
    public function getCourseData($id){
        $result = mysql_query("SELECT * FROM course WHERE ID = '$id'");
        $row = mysql_fetch_row($result);
        return $row;         	
    }
    
    public function getCourseDataForm($id){

    	  list($V_ID,$V_CLASS,$V_YEAR,$V_NAME,$V_DESC,$V_SITE_LINK) = $this->getCourseData($id);  
    	  
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=updateCourseData\">");
    	  array_push($FormArr, "<input name=\"ID\" type=\"hidden\" size=\"50\" value=\"$V_ID\">");
    	  array_push($FormArr, "課程編號：$V_ID<br>");
    	  array_push($FormArr, "分類：<input name=\"CLASS\" type=\"text\" size=\"50\" value=\"$V_CLASS\"><br>");
    	  array_push($FormArr, "年度：<input name=\"YEAR\" type=\"text\" size=\"50\" value=\"$V_YEAR\"><br>");
    	  array_push($FormArr, "名稱：<input name=\"NAME\" type=\"text\" size=\"50\" value=\"$V_NAME\"><br>");
    	  array_push($FormArr, "簡介：<textarea rows=\"8\" cols=\"40\" name=\"DESC\">$V_DESC</textarea><br>");
    	  array_push($FormArr, "SiteLink：<input name=\"SITELINK\" type=\"text\" size=\"50\" value=\"$V_SITE_LINK\"><br>");
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;
    }

    public function getCourseAddForm(){
    	  
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=AddCourse\">");
    	  array_push($FormArr, "<input name=\"ID\" type=\"hidden\" size=\"50\" value=\"$V_ID\">");
    	  array_push($FormArr, "分類：<input name=\"CLASS\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "年度：<input name=\"YEAR\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "名稱：<input name=\"NAME\" type=\"text\" size=\"50\" value=\"$V_NAME\"><br>");    	  
    	  array_push($FormArr, "簡介：<textarea rows=\"8\" cols=\"40\" name=\"DESC\"></textarea><br>");
    	  array_push($FormArr, "SiteLink：<input name=\"SITELINK\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;	    	  
    }
    
    function addCourseData($p){
  	 
       $sql1 = " INSERT INTO `course` ";
       $sql2 = " (`ID`,`CLASS`,`YEAR`,`NAME`,`DESC`,`SITE_LINK`) VALUES";
       $sql3 = " ('','$p[CLASS]','$p[YEAR]','$p[NAME]','$p[DESC]','$p[SITELINK]')";
       $sql = $sql1.$sql2.$sql3;
       echo $sql;
       if(mysql_query($sql ,$this->link)){
          echo "新增完畢";
       }else{
          echo "連結資料庫失敗....請查明原因後再試一次....";
       }    
    }

    function delCourseData($id){
    	 
       $sql1 = " DELETE FROM `course` ";
       $sql2 = " WHERE ID = '$id'";
       $sql = $sql1.$sql2;
       echo $sql;
       if(mysql_query($sql ,$this->link)){
          echo "刪除完畢";
       }else{
          echo "連結資料庫失敗....請查明原因後再試一次....";
       }    
    }
    
    public function updateCourseData($p){
       $sql1 = " UPDATE course ";
       $sql2 = " SET CLASS = '$p[CLASS]', YEAR = '$p[YEAR]', NAME = '$p[NAME]',";
       $sql3 = " `DESC` = '$p[DESC]', SITE_LINK = '$p[SITELINK]'";
       $sql4 = " WHERE ID = '$p[ID]' ";
       $sql = $sql1.$sql2.$sql3.$sql4;
       echo $sql;
       if(mysql_query($sql ,$this->link)){
           echo "更新完畢";          
       }else{
           echo "連結資料庫失敗....請查明原因後再試一次....";
       }
       
       $_POST = null;    	
    	
    }
    
    public function getCourseManager(){
        $result = mysql_query("SELECT * FROM course order by name desc");
        $row = mysql_fetch_row($result);    	
    	  $FormArr = array();
    	  array_push($FormArr, "<a href=\"./index.php?act=AddCourseForm\">新增</a> <a href=\"./index.php?act=Manager\">回管理頁面</a>");
    	  array_push($FormArr, "<table border=1>");
    	  array_push($FormArr, "<tr ><td align=center>修改課程</td><td align=center>修課名單</td><td align=center>分組內容</td><td align=center>類別</td><td align=center>年度</td><td align=center>課程名稱</td><td align=center>簡介</td><td align=center>刪除課程</td></tr>");
        while($row != null){
    	     list($V_ID,$V_CLASS,$V_YEAR,$V_NAME,$V_DESC,$V_SITE_LINK) = $row;  
           array_push($FormArr, "<tr>");
           
           array_push($FormArr, "<td align=center><a href=\"./index.php?act=CourseData&id=$V_ID\">►</a></td>");
           array_push($FormArr, "<td align=center><a href=\"./index.php?act=getPickManager&id=$V_ID\">list</a></td>");
           array_push($FormArr, "<td align=center><a href=\"./index.php?act=getTeamManager&id=$V_ID\">content</a></td>");
           array_push($FormArr, "<td>$V_CLASS</td>");
           array_push($FormArr, "<td>$V_YEAR</td>");
           array_push($FormArr, "<td>$V_NAME</td>");
           array_push($FormArr, "<td>".mb_substr($V_DESC,0,20, "UTF-8")."</td>");
           //array_push($FormArr, "<td>".$V_DESC."</td>");
           array_push($FormArr, "<td align=center><a href=\"./index.php?act=delCourseData&id=$V_ID\">X</a></td>");
           array_push($FormArr, "</tr>");
           
           $row = mysql_fetch_row($result);
        }   
        array_push($FormArr, "</table>");	 
        return $FormArr; 
    }

    public function getPickManager($cid){
        $sql = "SELECT a.id,a.m_id,a.c_id,a.t_id,a.grade,a.note,b.u_id,b.name,c.name,d.topic FROM ";
        $sql .= "coursepicking as a,member as b,course as c, team as d ";
        $sql .= "where a.m_id = b.id and a.c_id = '$cid' and a.c_id = c.id and a.t_id = d.id";
        
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);    	
    	  $FormArr = array();
    	  array_push($FormArr, "<a href=\"./index.php?act=AddPickForm&cid=$cid\">新選課</a> <a href=\"./index.php?act=Manager\">回管理頁面</a>");
    	  array_push($FormArr, "<table border=1>");
    	  array_push($FormArr, "<tr><td align=center>修改</td><td align=center>學號</td><td align=center>姓名</td><td align=center>分組</td><td align=center>分數</td><td align=center>評語</td><td align=center>刪除</td></tr>");
        while($row != null){
    	     list($V_ID,$V_MID,$V_CID,$V_TID,$V_GRADE,$V_NOTE,$V_UID,$V_UNAME,$V_CNAME,$V_TOPIC) = $row;  
           array_push($FormArr, "<tr>");
           
           array_push($FormArr, "<td align=center><a href=\"./index.php?act=PickData&id=$V_ID&cid=$cid\">►</a></td>");
           array_push($FormArr, "<td>$V_UID</td>");
           array_push($FormArr, "<td>$V_UNAME</td>");
           array_push($FormArr, "<td>$V_TOPIC</td>");
           array_push($FormArr, "<td align=center>$V_GRADE</td>");
           array_push($FormArr, "<td>$V_NOTE</td>");       
           array_push($FormArr, "<td align=center><a href=\"./index.php?act=delPickData&id=$V_ID\">X</a></td>");               
           array_push($FormArr, "</tr>");
           $row = mysql_fetch_row($result);
        }   
        array_push($FormArr, "</table>");	 
        return $FormArr; 
    }

    public function getPickDataForm($id, $cid){

        $sql = "SELECT a.id,a.m_id,a.c_id,a.t_id,a.grade,a.note,b.u_id,b.name,c.name,d.topic FROM ";
        $sql .= "coursepicking as a,member as b,course as c, team as d ";
        $sql .= "where a.id = '$id' and a.m_id = b.id and a.c_id = '$cid' and a.c_id = c.id and a.t_id = d.id";
        
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);    	
    	  $FormArr = array();
        
        list($V_ID,$V_MID,$V_CID,$V_TID,$V_GRADE,$V_NOTE,$V_UID,$V_UNAME,$V_CNAME,$V_TOPIC) = $row;  
    	  
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=updatePickData\">");
    	  array_push($FormArr, "<input name=\"ID\" type=\"hidden\" size=\"50\" value=\"$V_ID\">");
    	  array_push($FormArr, "課程：$V_CNAME<br>");
    	  array_push($FormArr, "姓名：$V_UNAME\"><br>");
    	  array_push($FormArr, "分組：$V_TOPIC\"><br>");
    	  array_push($FormArr, "分數：<input name=\"GRADE\" type=\"text\" size=\"50\" value=\"$V_GRADE\"><br>");
    	  array_push($FormArr, "評語：<input name=\"NOTE\" type=\"text\" size=\"50\" value=\"$V_NOTE\"><br>");
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;
    }

    private function getMemberSelectForm(){
    	  $r = "<select name=M_ID size=1>";
    	
        $result = mysql_query("SELECT id,name FROM member");
        $row = mysql_fetch_row($result);    	
        while($row != null){
    	     list($V_ID,$V_NAME) = $row;  
           $r .= "<option value=\"$V_ID\" >$V_NAME</option>";
           $row = mysql_fetch_row($result);
        }   	 
        return $r;
    }

    private function getTeamSelectForm($cid){
    	  $r = "<select name=T_ID size=1>";
    	
        $result = mysql_query("SELECT id,topic FROM team where C_ID = '$cid'");
        $row = mysql_fetch_row($result);    	
        while($row != null){
    	     list($V_ID,$V_TOPIC) = $row;  
           $r .= "<option value=\"$V_ID\" >$V_TOPIC</option>";
           $row = mysql_fetch_row($result);
        }   	 
        return $r;    	
    }

    public function getPickAddForm($cid){
    	  
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=AddPick\">");
    	  array_push($FormArr, "<input name=\"C_ID\" type=\"hidden\" size=\"50\" value=\"$cid\">");
    	  array_push($FormArr, "學員：".$this->getMemberSelectForm()."<br>");
    	  array_push($FormArr, "分組：".$this->getTeamSelectForm($cid)."<br>");
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;	    	  
    }
    
    function addPickData($p){
  	 
       $sql1 = " INSERT INTO `coursepicking` ";
       $sql2 = " (`ID`,`M_ID`,`C_ID`,`T_ID`,`GRADE`,`NOTE`) VALUES";
       $sql3 = " ('','$p[M_ID]','$p[C_ID]','$p[T_ID]','$p[GRADE]','$p[NOTE]')";
       $sql = $sql1.$sql2.$sql3;
       echo $sql;
       if(mysql_query($sql ,$this->link)){
          echo "新增完畢";
       }else{
          echo "連結資料庫失敗....請查明原因後再試一次....";
       }    
    }

    public function updatePickData($p){
       $sql1 = " UPDATE coursepicking ";
       $sql2 = " SET GRADE = '$p[GRADE]', NOTE = '$p[NOTE]'";
       $sql3 = " WHERE ID = '$p[ID]' ";
       $sql = $sql1.$sql2.$sql3.$sql4;
       echo $sql;
       if(mysql_query($sql ,$this->link)){
           echo "更新完畢";          
       }else{
           echo "連結資料庫失敗....請查明原因後再試一次....";
       }       
       $_POST = null;    	    	
    }

    function delPickData($id){
    	 
       $sql1 = " DELETE FROM `coursepicking` ";
       $sql2 = " WHERE ID = '$id'";
       $sql = $sql1.$sql2;
       echo $sql;
       if(mysql_query($sql ,$this->link)){
          echo "刪除完畢";
       }else{
          echo "連結資料庫失敗....請查明原因後再試一次....";
       }    
    }

    public function getTeamData($id){
        $result = mysql_query("SELECT * FROM team WHERE ID = '$id'");
        $row = mysql_fetch_row($result);
        return $row;         	
    }
  
    public function getTeamDataForm($id){
    	  list($V_ID,$V_CID,$V_TOPIC,$V_SITE_LINK,$V_DOC_LINK,$V_PPT_LINK) = $this->getTeamData($id);  
    	  
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=updateTeamData\">");
    	  array_push($FormArr, "<input name=\"ID\" type=\"hidden\" size=\"50\" value=\"$id\">");
    	  array_push($FormArr, "<input name=\"CID\" type=\"hidden\" size=\"50\" value=\"$V_CID\">");
    	  array_push($FormArr, "主題ID：$V_ID<br>");
    	  array_push($FormArr, "課程：$V_CID<br>");
    	  array_push($FormArr, "主題：<input name=\"TOPIC\" type=\"text\" size=\"50\" value=\"$V_TOPIC\"><br>");
    	  array_push($FormArr, "SiteLink：<input name=\"SITELINK\" type=\"text\" size=\"50\" value=\"$V_SITE_LINK\"><br>");
    	  array_push($FormArr, "DocLink：<input name=\"DOCLINK\" type=\"text\" size=\"50\" value=\"$V_DOC_LINK\"><br>");
    	  array_push($FormArr, "PPTLink：<input name=\"PPTLINK\" type=\"text\" size=\"50\" value=\"$V_PPT_LINK\"><br>");
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;
    }

    public function getTeamAddForm($cid){
    	  
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=AddTeam\">");
    	  array_push($FormArr, "<input name=\"CID\" type=\"hidden\" size=\"50\" value=\"$cid\">");
    	  array_push($FormArr, "主題：<input name=\"TOPIC\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "SiteLink：<input name=\"SITELINK\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "DocLink：<input name=\"DOCLINK\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "PPTLink：<input name=\"PPTLINK\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;	    	  
    }
    
    function addTeamData($p){
  	 
       $sql1 = " INSERT INTO `team` ";
       $sql2 = " (`ID`,`C_ID`,`TOPIC`,`SITE_LINK`,`DOC_LINK`,`PPT_LINK`) VALUES";
       $sql3 = " ('','$p[CID]','$p[TOPIC]','$p[SITELINK]','$p[DOCLINK]','$p[PPTLINK]')";
       $sql = $sql1.$sql2.$sql3;
       echo $sql;
       if(mysql_query($sql ,$this->link)){
          echo "新增完畢";
       }else{
          echo "連結資料庫失敗....請查明原因後再試一次....";
       }
    }

    function delTeamData($id){
    	 
       $sql1 = " DELETE FROM `team` ";
       $sql2 = " WHERE ID = '$id'";
       $sql = $sql1.$sql2;
       echo $sql;
       if(mysql_query($sql ,$this->link)){
          echo "刪除完畢";
       }else{
          echo "連結資料庫失敗....請查明原因後再試一次....";
       }    
    }
    
    public function updateTeamData($p){
       $sql1 = " UPDATE team ";
       $sql2 = " SET C_ID = '$p[CID]', TOPIC = '$p[TOPIC]',";
       $sql3 = " SITE_LINK = '$p[SITELINK]', DOC_LINK = '$p[DOCLINK]', PPT_LINK = '$p[PPTLINK]' ";
       $sql4 = " WHERE ID = '$p[ID]' ";
       $sql = $sql1.$sql2.$sql3.$sql4;
       echo $sql;
       if(mysql_query($sql ,$this->link)){
           echo "更新完畢";          
       }else{
           echo "連結資料庫失敗....請查明原因後再試一次....";
       }
       
       $_POST = null;    	
    	
    }
    
    public function getTeamManager($cid){
        $result = mysql_query("SELECT * FROM team where C_ID = '$cid'");
        $row = mysql_fetch_row($result);    	
    	  $FormArr = array();
    	  array_push($FormArr, "<a href=\"./index.php?act=AddTeamForm&cid=$cid\">新增主題</a> <a href=\"./index.php?act=getCourseManager\">回管理頁面</a>");
    	  array_push($FormArr, "<table border=1>");
    	  array_push($FormArr, "<tr><td align=center>修改</td><td align=center>主題</td><td align=center>連結</td><td align=center>刪除</td></tr>");
        while($row != null){
    	     list($V_ID,$V_CID,$V_TOPIC,$V_SITE_LINK,$V_DOC_LINK,$V_PPT_LINK) = $row;  
           array_push($FormArr, "<tr>");
           
           array_push($FormArr, "<td align=center><a href=\"./index.php?act=TeamData&id=$V_ID\">►</a></td>");
           array_push($FormArr, "<td>$V_TOPIC</td>");
           array_push($FormArr, "<td><a href=\"$V_SITE_LINK\" target=\"new\">Site</a> ");
           array_push($FormArr, "<a href=\"$V_DOC_LINK\" target=\"new\">Doc</a> ");
           array_push($FormArr, "<a href=\"$V_PPT_LINK\" target=\"new\">PPT</a> ");
           array_push($FormArr, "<td align=center><a href=\"./index.php?act=delTeamData&id=$V_ID\">X</a></td>");
           array_push($FormArr, "</td></tr>");
           $row = mysql_fetch_row($result);
        }   
        array_push($FormArr, "</table>");	 
        return $FormArr; 
    }    

    public function getManager(){
  	
    	  $FormArr = array();
    	  array_push($FormArr, "<table border=1>");
        array_push($FormArr, "<tr>");
        array_push($FormArr, "<td><a href=\"./index.php?act=ManagerData\">學員資料</a></td>");
        array_push($FormArr, "<td><a href=\"./index.php?act=ManagerCourse\">課程資料</a></td>");
        array_push($FormArr, "</tr>"); 
        array_push($FormArr, "</table>");	 
        return $FormArr; 
    }        
    
    // 解構函式
    public function __destruct()
    {
        $this->link = NULL;
    }

}