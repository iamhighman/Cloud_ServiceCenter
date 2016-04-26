<?php

class Member
{


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
    
    public function getData($id){
        $result = mysql_query("SELECT * FROM member WHERE ID = '$id'");
        $row = mysql_fetch_row($result);
        return $row;         	
    }
    
    public function getDataForm($id){
    	  list($V_ID,$V_UID,$V_PASSWORD,$V_NAME,$V_PERSONAL_SITE,$V_PERSONAL_DOC,$V_PUB_DOC,$V_CLASS,$V_IMAGE,$V_NOTE) = $this->getData($id);  
    	  
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=updateUData\">");
    	  array_push($FormArr, "<input name=\"ID\" type=\"hidden\" size=\"50\" value=\"$V_ID\">");
    	  array_push($FormArr, "使用者編號：$V_ID<br>");
    	  array_push($FormArr, "使用者代號：$V_UID<br>");
    	  array_push($FormArr, "使用者密碼：<input name=\"PASSWORD\" type=\"text\" size=\"50\" value=\"$V_PASSWORD\"><br>");
    	  array_push($FormArr, "使用者名稱：<input name=\"NAME\" type=\"text\" size=\"50\" value=\"$V_NAME\"><br>");
    	  array_push($FormArr, "SiteLink：<input name=\"SITELINK\" type=\"text\" size=\"50\" value=\"$V_PERSONAL_SITE\"><br>");
    	  array_push($FormArr, "DocLink：<input name=\"DOCLINK\" type=\"text\" size=\"50\" value=\"$V_PERSONAL_DOC\"><br>");
    	  array_push($FormArr, "PubLink：<input name=\"PUBLINK\" type=\"text\" size=\"50\" value=\"$V_PUB_DOC\"><br>");
    	  array_push($FormArr, "類別：<input name=\"CLASS\" type=\"text\" size=\"50\" value=\"$V_CLASS\"><br>");
    	  array_push($FormArr, "照片：<input name=\"IMAGE\" type=\"text\" size=\"50\" value=\"$V_IMAGE\"><br>");
    	  array_push($FormArr, "備註：<input name=\"NOTE\" type=\"text\" size=\"50\" value=\"$V_NOTE\"><br>");    	      	  
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;
    }

    public function getAddForm(){
    	  
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=addUser\">");
    	  array_push($FormArr, "使用者代號：<input name=\"UID\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "使用者密碼：<input name=\"PASSWORD\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "使用者名稱：<input name=\"NAME\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "SiteLink：<input name=\"SITELINK\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "DocLink：<input name=\"DOCLINK\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "PubLink：<input name=\"PUBLINK\" type=\"text\" size=\"50\" value=\"\"><br>"); 
    	  array_push($FormArr, "類別：<input name=\"CLASS\" type=\"text\" size=\"50\" value=\"$V_CLASS\"><br>");
    	  array_push($FormArr, "照片：<input name=\"IMAGE\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "備註：<input name=\"NOTE\" type=\"text\" size=\"50\" value=\"\"><br>");     	     	  
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\">"); 
    	  
    	  return $FormArr;	    	  
    }

    public function getChangePasswordForm(){
    	  $FormArr = array();
    	  array_push($FormArr, "<form method=post action=\"./index.php?act=UpdatePassword\">");
    	  array_push($FormArr, "代號：<input name=\"UID\" type=\"text\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "原密碼：<input name=\"PASSWORD\" type=\"password\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "新密碼：<input name=\"NEWPASSWORD1\" type=\"password\" size=\"50\" value=\"\"><br>");
    	  array_push($FormArr, "確認新密碼：<input name=\"NEWPASSWORD2\" type=\"password\" size=\"50\" value=\"\"><br>");     	     	  
    	  array_push($FormArr, "<input type=\"submit\" name=\"s\" value=\"Submit\"></form>"); 
    	  
    	  return $FormArr;	          	
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
    
    public function UpdatePassword($p){
    	 $return = array();
       
       array_push($return, "<br><a href=\"http://sc.ec.nccu.edu.tw/index.php?act=ChangePasswordForm\">Previous Page</a><br><br>");
       
    	 if(!$this->VerifyPassword($p[UID],$p[PASSWORD])){
    	 	   array_push($return, "Verify Error!");
    	 	   return $return;
    	 }else{
    	     if($p[NEWPASSWORD1] != $p[NEWPASSWORD2]){
    	        	array_push($return, "New Password is inconsistent!");
    	        	return $return;
    	     }
           $sql1 = " UPDATE member ";
           $sql2 = " SET PASSWORD = '$p[NEWPASSWORD1]'";
           $sql3 = " WHERE U_ID = '$p[UID]' ";
           $sql = $sql1.$sql2.$sql3;
          //echo $sql;
           if(mysql_query($sql ,$this->link)){
           	  array_push($return, "Password change successfully!");      
           }else{
              array_push($return, "Failed! We encounter some technical issues. Sorry!!");
           }
           return $return;   	     
    	 }       
       $_POST = null;    	
    }
    
public function UpdatePhoto($id,$image){ 

	echo "ID: " . $_POST['id'] . "<br>";
	
	echo "Filename: " . $_FILES['userfile']['name'] . "<br><br>";
	echo "successfully upload!";
	$view->render('myTab.tpl.php');
	//echo "<br><a href=\"http://sites.google.com/a/ec.nccu.edu.tw/96356038/mytab">File successfully upload!</a><br><br>";
	//echo "Temporary Name: " . $_FILES['userfile']['tmp_name'] . "<br>";
	//echo "Size: ". $_FILES['userfile']['size'] . "<br>";
	//echo "Type: ". $_FILES['userfile']['type'] . "<br>";
	$abc_1 = explode(".",$_FILES['userfile']['name']);//將上傳的圖檔名稱以逗點拆開
	if(strtolower($abc_1[1]) != "jpg" && strtolower($abc_1[1]) != "gif"){
	  echo "上傳圖片限 jpg 或 gif 格式!!";
	  exit(0);
	}
		
	
	// copy file here
	if(@copy($_FILES['userfile']['tmp_name'], "theme/images/photo/" . $_POST['id'].".jpg")){
           $picpath_1 = "http://sc.ec.nccu.edu.tw/theme/images/photo/" . $_POST['id'].".jpg";
           
           $return = array();
           
           $sql1 = " UPDATE member ";
           $sql2 = " SET IMAGE = '".$picpath_1."'";
           $sql3 = " WHERE U_ID = '".$_POST['id']."'";
           $sql = $sql1.$sql2.$sql3;
            
            if(mysql_query($sql ,$this->link)){
           	  array_push($return, "File successfully upload!");  
           	  
           }else{
              array_push($return, "Failed! We encounter some technical issues. Sorry!!");
           }
            
	    
	}else{
 	   echo "<b>Error: failed to upload file</b>";
	}
	

    }
    
    function addData($p){
  	 
       $sql1 = "INSERT INTO `member` ";
       $sql2 = " (`ID`,`U_ID`,`PASSWORD`,`NAME`,`PERSONAL_SITE`,`PERSONAL_DOC`,`PUB_DOC`,`CLASS`,`IMAGE`,`NOTE`) VALUES";
       $sql3 = " ('','$p[UID]','$p[PASSWORD]','$p[NAME]','$p[SITELINK]','$p[DOCLINK]','$p[PUBLINK]','$p[CLASS]','$p[IMAGE]','$p[NOTE]')";
       $sql = $sql1.$sql2.$sql3;
       echo $sql;
       if(mysql_query($sql ,$this->link)){
          echo "新增完畢";
       }else{
          echo "連結資料庫失敗....請查明原因後再試一次....";die();
       }
    }

    function delData($id){
    	 
       $sql1 = " DELETE FROM `member` ";
       $sql2 = " WHERE ID = '$id'";
       $sql = $sql1.$sql2;
       echo $sql;
       if(mysql_query($sql ,$this->link)){
          echo "刪除完畢";
       }else{
          echo "連結資料庫失敗....請查明原因後再試一次....";
       }    
    }
    
    public function updateData($p){
       $sql1 = " UPDATE member ";
       $sql2 = " SET PASSWORD = '$p[PASSWORD]', NAME = '$p[NAME]', PERSONAL_SITE = '$p[SITELINK]', ";
       $sql3 = " PERSONAL_DOC = '$p[DOCLINK]', PUB_DOC = '$p[PUBLINK]', CLASS = '$p[CLASS]', IMAGE = '$p[IMAGE]', NOTE = '$p[NOTE]'";
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
    
    public function getManager(){
        $result = mysql_query("SELECT * FROM member ORDER BY 'U_ID' asc");
        $row = mysql_fetch_row($result);    	
    	  $FormArr = array();
    	  array_push($FormArr, "<a href=\"./index.php?act=AddUserForm\">新增</a> <a href=\"./index.php?act=Manager\">回管理頁面</a>");
    	  array_push($FormArr, "<table border=1>");
    	  array_push($FormArr, "<tr><td align=center>修改</td><td align=center>UID</td><td align=center>姓名</td><td align=center>刪除</td></tr>");
        while($row != null){
    	     list($V_ID,$V_UID,$V_PASSWORD,$V_NAME,$V_PERSONAL_SITE,$V_PERSONAL_DOC) = $row;  
           array_push($FormArr, "<tr>");
           array_push($FormArr, "<td align=center><a href=\"./index.php?act=UData&id=$V_ID\">►</a></td>");
           array_push($FormArr, "<td>$V_UID</td>");
           array_push($FormArr, "<td align=center>$V_NAME</td>");
           array_push($FormArr, "<td align=center><a href=\"./index.php?act=delUData&id=$V_ID\">X</a></td>");
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
