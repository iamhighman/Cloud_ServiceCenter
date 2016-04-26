<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="http://sc.ec.nccu.edu.tw/theme/style_pubMessage.css"/>
<title><?php echo APP_NAME; ?></title>
<?php
      // Parse gadget URL and emit <script src=...</script> statements into the HTML output.
      // The <script src=...</script> statements will load the libraries passed in via the URL.
      $libraries = split(",", $_GET["libs"]);
      foreach ($libraries as $script) {
        if (preg_match('@^[a-z0-9/._-]+$@i', $script)
          && !preg_match('@([.][.])|([.]/)|(//)@', $script)) {
            print "<script src='http://www.google.com/ig/f/$script'></script>";
        }
      }
      ?>

      <script type="text/javascript">
      // Get user preferences
      var prefs = new _IG_Prefs();
      //var uid = prefs.getString("uid");

      

function $(obj) 
{ 
    return document.getElementById(obj); 
} 

function close_open(id){
document.getElementById("tb1").style.display = "none";
document.getElementById("tb2").style.display = "none";
  if(document.getElementById("tb"+id).style.display == "none"){
    document.getElementById("tb"+id).style.display = "";
  }
  else{
    document.getElementById("tb"+id).style.display = "none";
  }
}
</script> 
</head>
<body>
<div id="wrap">
  <div id="head">
    <img src="http://sc.ec.nccu.edu.tw/theme/images/photo/writeownpost.jpg" width="200" height="100%">
   </div>
  <div id="menu">
    <ul>
      <li><a href="#" onclick="close_open(1)">留言板</a></li>
      <li><a href="#" onclick="close_open(2)">我要留言</a></li>
   </ul>
  </div>
   <div id="content">
      <div id="main">
      <table width="100%" border="0">
         <tr>
         <td align=left><?php echo "<a href=http://sc.ec.nccu.edu.tw/index.php?act=GetAllPubMessage>查看全部留言</a>";?></td>
        </tr>
      <tbody id="tb1" style="DISPLAY: block">
         <tr>
             <?php foreach ($this->DataForm as $id => $content): ?>
             
             <td align=left><img src=" <?php echo $content[IMAGE]; ?> " width="40" height="40"><a href="http://sc.ec.nccu.edu.tw/index.php?act=stdArticle&id=<?php echo $content["U_ID"]."\" target=\"new\">"; ?><?php echo $content["NAME"]; ?></td>
        </tr>
        <tr>
        <td align=left><?php echo $content["TIME"]; ?>
         </td>
        </tr>
        <tr>
             <td align=left><?php echo $content[COMMENT]; ?><br/><br/>
             </td>
        </tr>
        
	    <?php endforeach; ?>
        </tbody>
        
      </table>
      
      <table width="100%" border="0">
      <tbody id="tb2" style="DISPLAY: none">
      <tr><td>
        <form NAME="isay" method="post" action="http://sc.ec.nccu.edu.tw/index.php?act=SavePubMessage">
        學號:<input type="text" name="U_ID"><br/>
        密碼:<input type="password" name="password">
        <br />
        留言:<br />
        <textarea name="comment" rows="10" cols="30"></textarea><br>
        <INPUT TYPE=SUBMIT value="確認送出" name="B1">
      </form>
      </td></tr>
      </tbody>
      </table>
      </div>
  </div>
</body>
</html>






