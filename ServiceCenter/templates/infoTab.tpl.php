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
      Course Information Gadget
   </div>
   
   <div id="functions">
             <table width="100%" cellspacing="0" cellpadding="0" id=menu1 style="display:block" border="2">
               <tr> 
                 <td width="89" bgcolor="#6666FF"><DIV onclick="fmenux(0)" style="cursor:hand;" align=center ><font color="white" size="3"> Course </font></DIV></td>
                 <td width="89" bgcolor="#6666cc"><DIV onclick="fmenux(1)" style="cursor:hand;" align=center ><font color="white" size="3"> Project </font></DIV></td>
                 <td width="89" bgcolor="#333399"><DIV onclick="fmenux(2)" style="cursor:hand;" align=center ><font color="white" size="3"> People </font></DIV></td>
               </tr>
             </table>
   </div>

   <div id="content">

       <table width="100%" border="1" cellspacing="0" cellpadding="0" >
       <tr>
         <td alt="obj_05"> 
             <table width="100%" BORDER=1 cellspacing="0" cellpadding="0" id="submenu0" style="display:block" border="0">         
                 <tr><td>
                 <?php foreach ($this->Course as $id => $content): ?>
                     
                     <?php if($content[C_CLASS] != NULL){ ?>
                       <font color=#993300 size="3"><b>
                       <?php echo "<a href=\"".$content["C_SITE_LINK"]."\" target=\"new\">".$content["C_YEAR"]."-".$content["C_CLASS"]."-".$content["C_NAME"]."</a><br> ";?>
                     	  
                     	 </b></font>
                     	  <?php echo $content["C_DESC"]."<br><br>"; 
                           }else{ ?>
                              <?php echo $content["T_TOPIC"]; ?>
                              <br><font color=blue><?php echo $content["User"]; ?></font><br><br>                           
                        <?php } ?>
                       
                 <?php endforeach; ?>
                 </td><tr>
            </table>  
             <table width="100%" BORDER=1 cellspacing="0" cellpadding="0" id="submenu1" style="display:none" border="0">         
                 <tr><td>
                 
                  <select id="Select1" style="width: 207px; height: 26px">
                   <option selected="selected"></option>
                  </select>
                  <input id="Text1" type="text" />
                 <input id="Button1" type="button" value="search" /><br>
                 <?php foreach ($this->Project as $id => $content): ?>                    
                     <?php 
                          echo $content["T_TOPIC"]." - <a href=\"".$content["T_SITE_LINK"]."\" target=\"new\">參與討論 </a><br><br>";
                     ?>
                 <?php endforeach; ?>
                 </td><tr>
            </table>  
             <table width="100%" BORDER=1 cellspacing="0" cellpadding="0" id="submenu2" style="display:none" border="0">         
                 <tr><td>
                 
                 <input id="Text1" type="text" />
                 <input id="Button1" type="button" value="search" /><br>
                 <table style="width: 293px" border="2">
                       <tr>
                           <td style="height: 21px" align=center>
                               <strong>大頭照</strong></td>                       
                           <td style="height: 21px" align=center>
                               <strong>個人網站</strong></td>
                           
                           <td style="height: 21px" align=center>
                               <strong>簡介</strong></td>
                       </tr>
               
                      
                      <?php foreach ($this->Member as $id => $content): ?>  
                       
                       <tr>
                           
                           <td style="height: 21px" align=center>
                           
                           <img src=" <?php echo $content["IMAGE"];?> " width="50" height="50">
                           
                           </td>
                           
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
