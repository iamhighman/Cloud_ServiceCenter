<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="theme/main.css" />
<title><?php echo APP_NAME; ?></title>
      <?php
      $libs = "";
      // Parse gadget URL and emit <script src=...</script> statements into the HTML output.
      // The <script src=...</script> statements will load the libraries passed in via the URL.
      $libraries = split(",", $_GET["libs"]);
      foreach ($libraries as $script) {
        if (preg_match('@^[a-z0-9/._-]+$@i', $script)
          && !preg_match('@([.][.])|([.]/)|(//)@', $script)) {
            $libs .= $script.",";
            print "<script src='http://www.google.com/ig/f/$script'></script>";
        }
      }
      ?>

      <script type="text/javascript">
      // Get user preferences
      var prefs = new _IG_Prefs();
      //var uid = prefs.getString("uid");

      function init(){
         var prefs = new _IG_Prefs();
         var uid = prefs.getString("uid");
         var upa = prefs.getString("upa");
         if(uid == ""){
           document.write("Enter your uid: ");
           document.write("<br><input type=\"text\" value=\"\" size=\"8\" name=\"uid\" id=\"uid\"/>");
           document.write("<br><input type=\"password\" value=\"\" size=\"8\" name=\"upa\" id=\"upa\"/>");
           document.write("<input type=button value=\"Submit\" name=\"submit\" onClick=\"setUid()\">");
         }else{
           document.write(uid + ", Welcome... <br>");
           window.location="http://sc.ec.nccu.edu.tw/index.php?act=myTab&uid=" + uid + "&upa=" + upa + "&libs=" + "<?php echo $libs;?>";
           //window.location="http://sc.ec.nccu.edu.tw/index.php?act=myTab&uid=" + uid + "&upa=" + upa;
         }
      }
      
      function ClearUid(){
         prefs.set("upa", "");
         prefs.set("uid", "");
         window.location="http://sc.ec.nccu.edu.tw/index.php?act=myTab";
      }

      function setUid(){
         prefs.set("upa", document.getElementById("upa").value);
         prefs.set("uid", document.getElementById("uid").value);
         var uid = prefs.getString("uid");
         var upa = prefs.getString("upa");
         alert("Set uid to " + prefs.getString("uid") );
         init();
         //window.location="http://lab.ec.nccu.edu.tw/gadget/myTab/index.php";
      }

function $(obj) 
{ 
    return document.getElementById(obj); 
} 

function fmenux(id){
document.getElementById("submenu0").style.display = "none";
document.getElementById("submenu1").style.display = "none";
document.getElementById("submenu2").style.display = "none";
document.getElementById("submenu" + id).style.display = "block";
}

function close_open(id){

  if(document.getElementById("tb"+id).style.display == "none"){
    document.getElementById("tb"+id).style.display = "";
  }
  else{
    document.getElementById("tb"+id).style.display = "none";
  }
}

      //_IG_RegisterOnloadHandler(init);
      init();
      </script>
</head>

<body>
<div id="container">
   <div id="header">
      <h1>My Gadget</h1>
   </div>
   
   <div id="functions">
             <table width="100%" cellspacing="0" cellpadding="0" id=menu1 style="display:block" border="2">
               <tr> 
                 <td bgcolor="#6666FF"><DIV onclick="fmenux(0)" style="cursor:hand;" align=center ><font color="white" size="3"> MyProfile </font></DIV></td>
                 <td bgcolor="#6666cc"><DIV onclick="fmenux(1)" style="cursor:hand;" align=center ><font color="white" size="3"> MyCourse </font></DIV></td>
                 <td bgcolor="#333399"><DIV onclick="fmenux(2)" style="cursor:hand;" align=center ><font color="white" size="3"> MyPhoto </font></DIV></td>
               </tr>
             </table>
   </div>

   <div id="content">
            <table width="100%" id="submenu0" style="display:block" border="1">         
                 <?php foreach ($this->Profile as $id => $content): ?>
                     <tr><td>                     
                           <font color=#993300 size="3">          
                         	  Hello, <?php echo $content["T_NAME"];?></font><br>                     	  
                     </td></tr>
                     <tr><td>                                            
                         	  <a href="<?php echo $content["T_DOC_LINK"];?>" target=target="new">編輯我的檔案</a>                 	  
                     </td></tr>                 
                     <TR onclick="close_open(1)"><TD>檢視我的檔案</TD></TR>
	                   <tbody id="tb1" style="DISPLAY: none">
                     <tr><td width=100%>
                        <iframe scrolling="yes" width="100%" height=600 src="<?php echo $content["T_DOC_LINK"] ?>"></iframe>
                     </td></tr>
                     </tbody>
                 <?php endforeach; ?>
            </table>  
             <table width="100%" id="submenu1" style="display:none" border="1">  
                 <tr><td>                     
                       <font color=#993300 size="3">          
                     	  以下是我參與的課程：</font><br>                     	  
                 </td></tr>                    
                 <?php foreach ($this->Course as $id => $content): ?>
                    <tr><td>                                             
                        	  <a href="<?php echo $content["C_SITE_LINK"];?>" target=target="new"><?php echo $content["C_NAME"];?></a>                 	  
                    </td></tr>      
                    <tr><td>                                             
                        	  <a href="<?php echo $content["T_SITELINK"];?>" target=target="new">進入分組Site</a>  <br>
                        	  <a href="<?php echo $content["T_DOCLINK"];?>" target=target="new">編輯DOC</a> <br>
                        	  <a href="<?php echo $content["T_PPTLINK"];?>" target=target="new">編輯PPT</a>                	  
                    </td></tr>                             
                    <TR onclick="close_open(2)"><TD>檢視DOC</TD></TR>
	                  <tbody id="tb2" style="DISPLAY: none">
                    <tr><td>
                       <iframe scrolling="no" width="100%" height=600 src="<?php echo $content["T_DOCLINK"] ?>"></iframe>
                    </td></tr>
                    </tbody>
                    <TR onclick="close_open(3)"><TD>檢視PPT</TD></TR>
	                  <tbody id="tb3" style="DISPLAY: none">
                    <tr><td>
                       <iframe scrolling="no" width="100%" height=600 src="<?php echo $content["T_PPTLINK"] ?>"></iframe>
                    </td></tr>
                    </tbody>                               
                 <?php endforeach; ?>
            </table>  
                         
     <table width="100%" id="submenu2" style="display:none" border="1">         
                 <?php foreach ($this->Photo as $id => $content): ?>
                     <tr><td>                     
                           <font color=#993300 size="3">          
                         	  Hello,This is your photo <br></font><br> 
                         	                    	  
                     </td>
                     </tr>
		     <tr>
                		
                   		<td rowspan="2" width="75" height="100" align=center><img src=" <?php echo $content["M_PHOTO"];?> " width="100%" height="100%">
                                 <form name="form_upload" method="post" action="./index.php?act=UpdatePhoto" enctype="multipart/form-data">
				更換照片<br>
				<input name="id" type="hidden" value="<?php echo $content["M_ID"];?>">
				<input type="file" name="userfile" size="36"><br>
				<input type="submit" value="確認送出" name="B1">
				

				</form>
				
                    </td>
                    </tr>
                    <?php endforeach; ?>
              </table>

</body>


            
                
   </div>
   
<div id="footer">
   <p><?php echo APP_TAIL; ?></p>
</div>

</div>
</body>
</html>
