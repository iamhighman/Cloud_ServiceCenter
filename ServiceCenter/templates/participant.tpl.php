<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="theme/style.css" />
<title><?php echo APP_NAME; ?></title>
<SCRIPT language="JavaScript">

function $(obj) 
{ 
    return document.getElementById(obj); 
} 

function fmenux(id){
document.getElementById("submenu0").style.display = "none";
document.getElementById("submenu1").style.display = "none";
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

</SCRIPT> 
</head>

<body>
<div id="container">
   <div id="header">
      Participant Gadget
   </div>
   
   <div id="functions">
            
   </div>




   <div id="content">
    <?php $pre_topic=""; ?>
    <?php foreach ($this->DataForm as $id => $content): ?>
    <?php if($pre_topic == $content["TOPIC"]) continue; $pre_topic = $content["TOPIC"]; ?>
    <table border="1" width="100%">
            <tr>
                <td colspan="4" style="vertical-align: middle; color: black; height: 20px;text-align: center">
                 <?php echo "<a href=\"".$content["TEAM_SITE"]."\" target=\"new\">".$content["TOPIC"]."</a> ";?>
                </td>
            </tr>
            <tr onclick="close_open('<?php echo $id."a"; ?>')"><TD colspan=4>點選檢視分組報告1+</TD><td><?php echo "<a href=\"".$content["T_DOCLINK"]."\" target=\"new\">>>編輯/瀏覽</a> ";?></td></tr>
            <tr onclick="close_open('<?php echo $id."b"; ?>')"><TD colspan=4>點選檢視分組報告2+</TD><td><?php echo "<a href=\"".$content["T_DOCLINK2"]."\" target=\"new\">>>編輯/瀏覽</a> ";?></td></tr>
     </table>  
     <table id="submenu0" style="display:block" border="0" width="100%">     
              <tbody id="tb<?php echo $id."a"; ?>" style="DISPLAY: none" width="100%">  
              <tr>
              	<td style="height: 21px" align=center ><?php echo $content["T_DOC"]; ?>
              	</td>
              </tr>
 
     </table>
      <table id="submenu1" style="display:block" border="0" width="100%">     
              <tbody id="tb<?php echo $id."b"; ?>" style="DISPLAY: none" width="100%">  
              <tr width="100%">
              	<td style="height: 21px" align=center ><?php echo $content["T_DOC2"]; ?>
              	</td>
              </tr>

     </table>
     
            
<!--
            <tr>
                <td colspan="4">
                </td>
            </tr>
-->
	<table border="1" width="100%"> 
            <?php foreach ($this->DataForm as $id1 => $content1): ?>
            <?php if($content1["TOPIC"] != $content["TOPIC"]) continue; ?>
            <tr>
                <td rowspan="2" width="75" height="100" align=center><img src=" <?php echo $content1["IMAGE"];?> " width="100%" height="100%"></td>
               
                <td align=left><?php echo "<a href=\"".$content1["PERSONAL_SITE"]."\" target=\"new\">".$content1["NAME"]."</a> ";?></td>
            </tr>
            
            <tr>
                <td height="10" align=right><?php echo $content1["report_content"];?>
                           <?php echo "<a href=\"".$content1["report_DOC"]."\" target=\"new\">>>編輯/瀏覽</a> ";?></td>
            </tr>
           
            <?php endforeach; ?>    
    </table>    
    <?php endforeach; ?>
  
<div id="footer">
   <p><?php echo APP_TAIL; ?></p>
</div>

</div>
</body>
</html>