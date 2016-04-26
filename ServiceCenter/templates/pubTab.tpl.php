<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
      <h1>Bulletin Gadget</h1>
   </div>
   
   <div id="functions">
   <!--
             <table width="100%" cellspacing="0" cellpadding="0" id=menu1 style="display:block" border="2">
               <tr> 
                 <td width="89" bgcolor="#6666FF"><DIV onclick="fmenux(0)" style="cursor:hand;" align=center ><font color="white" size="3"> Course </font></DIV></td>
                 <td width="89" bgcolor="#6666cc"><DIV onclick="fmenux(1)" style="cursor:hand;" align=center ><font color="white" size="3"> Project </font></DIV></td>
                 <td width="89" bgcolor="#333399"><DIV onclick="fmenux(2)" style="cursor:hand;" align=center ><font color="white" size="3"> People </font></DIV></td>
               </tr>
             </table>
   -->
   </div>

   <div id="content">

       <table width="100%" border="1" cellspacing="0" cellpadding="0" >
       <tr>
         <td alt="obj_05"> 
             <table width="100%" BORDER=1 cellspacing="0" cellpadding="0" id="submenu0" style="display:block" border="0">         
                 <tr><td>
                 <?php foreach ($this->Content as $id => $content): ?>
                     
                     <br> 來自 <font color=green> <?php echo $content["T_CLASS"]; ?> </font> 的  <font color=blue> <?php echo $content["T_NAME"]; ?>  </font> 說：<br>
                     <?php echo $content["T_CONTENT"]; ?> <br>
                     
                 <?php endforeach; ?>
                 </td><tr>
            </table>                          
         </td>
       </tr>
       <tr>
         <td alt="obj_05" align=right> 
              <a href="">More comments...</a>                   
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
