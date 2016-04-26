?<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="theme/main.css" />
<title><?php echo APP_NAME; ?></title>
<SCRIPT language="JavaScript">

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
</SCRIPT> 
</head>

<body>
<div id="container">
   <div id="header">
      Partcipant Information Gadget
   </div>


   <div id="content">

             <table width="100%" BORDER=1 cellspacing="0" cellpadding="0" id="submenu2" style="display:none" border="0">         
                 <tr><td>
                 
                 <input id="Text1" type="text" />
                 <input id="Button1" type="button" value="search" /><br>
                 <table style="width: 293px" border="2">
                       <tr>
                           <td style="height: 21px" align=center>
                               <strong>組別</strong></td>                       
                           <td style="height: 21px" align=center>
                               <strong>圖片</strong></td>
                           <td style="height: 21px" align=center>
                               <strong>姓名</strong></td>
                           <td style="height: 21px" align=center>
                               <strong>公開資訊</strong></td>
                       </tr>
                </table>
               
                <table style="width: 293px" border="2">       
                      <?php foreach ($this->Member as $id => $content): ?>  
                       
                       <tr>
                           
                           <td style="height: 21px" align=center>
                           
                           <img src=" <?php echo $content["IMAGE"];?> " width="50" height="50">
                           
                           </td>
                           <td style="height: 21px" align=center><?php echo $content["NAME"];?></td>
                           <td style="height: 21px" align=center><?php echo "<a href=\"".$content["PERSONAL_SITE"]."\" target=\"new\">".$content["NAME"]."</a> ";?></td>                                                      
                           <td style="height: 21px" align=center><?php echo "<a href=\"".$content["PERSONAL_DOC"]."\" target=\"new\">Doc</a><br>";?></td>
                                                       
                       </tr>
                        <?php endforeach; ?>
                 </table>

                

                 </td><tr>
            </table>                          
         </td>
       </tr>
     </table>
     
   </div>
   
<div id="footer">
   <p><?php echo APP_TAIL; ?></p>
</div>

</div>
</body>
</html>
