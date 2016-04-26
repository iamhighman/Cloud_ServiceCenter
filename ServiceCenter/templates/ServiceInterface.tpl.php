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
      
<?php if($this->ifLogin == "no"){ ?>
     
      // Get user preferences
      var prefs = new _IG_Prefs();
      //var uid = prefs.getString("uid");

      function init(){
         //var prefs = new _IG_Prefs();
         var uid = prefs.getString("uid");
         var upa = prefs.getString("upa");
         if(uid == ""){
           document.write("Welcome to Cloud Service Platform, please enter your id & password: <br>");
           document.write("<br>UserID: <input type=\"text\" value=\"\" size=\"20\" name=\"uid\" id=\"uid\"/>");
           document.write("<br>UserPass: <input type=\"password\" value=\"\" size=\"20\" name=\"upa\" id=\"upa\"/>");
           document.write("<br><input type=button value=\"Submit\" name=\"submit\" onClick=\"setUid()\">");
         }else{
           document.write(uid + ", Welcome... <br>");
           window.location="http://sc.ec.nccu.edu.tw/index.php?act=ServiceInterface&uid=" + uid + "&upa=" + upa + "&libs=" + "<?php echo $libs;?>";
           //window.location="http://sc.ec.nccu.edu.tw/index.php?act=myTab&uid=" + uid + "&upa=" + upa;
         }
      }
      
      function ClearUid(){
         prefs.set("upa", "");
         prefs.set("uid", "");
         window.location="http://sc.ec.nccu.edu.tw/index.php?act=ServiceInterface";
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


      init();
      
      
<?php } ?>   

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
      

</script>   
</head>
<?php if($this->ifLogin == "no") die("."); ?>


<body>
<div id="container">
   <div id="header">
      <b>Service Interface for user</b>
   </div>
   
   <div id="functions">
          <table width="100%" cellspacing="0" cellpadding="0" id=menu1 style="display:block" border="2">
            <tr BGCOLOR="#a0dc40"> 
              <td width="89" bgcolor="#6666FF"><DIV onclick="fmenux(0)" style="cursor:hand;" align=center ><font color="white" size="3"> Main </font></DIV></td>
              <td width="89" bgcolor="#6666cc"><DIV onclick="fmenux(1)" style="cursor:hand;" align=center ><font color="white" size="3"> Service </font></DIV></td>
              <td width="89" bgcolor="#333399"><DIV onclick="fmenux(2)" style="cursor:hand;" align=center ><font color="white" size="3"> Accounting </font></DIV></td>
            </tr>
          </table>
   </div>
   
   <div id="content">
   
       <table width="100%" border="0" cellspacing="0" cellpadding="0" >
       <tr>
         <td alt="obj_05">    
            <table width="100%" BORDER=0 cellspacing="0" cellpadding="0" id="submenu0" style="display:block">         
                 <?php foreach ($this->Profile as $id => $content): ?>
                     <tr><td>                             
                           <br>Hello, <font color=#309478 size="3"><?php echo $content["T_NAME"];?>: </font><br> <BR>  
                           
                           <TABLE border=1 BORDERCOLOR="#507010">
                           <TR><TD BGCOLOR="#e8f8d0" colspan=2>This is your basic information...</TD></TR>
                           <TR><TD BGCOLOR="#e8f8d0">Address</font></TD><TD><?php echo $content["T_ADDRESS"];?></TD></TR>
                           <TR><TD BGCOLOR="#e8f8d0">Tel</font></TD><TD><?php echo $content["T_TEL"];?></TD></TR>
                           <TR><TD BGCOLOR="#e8f8d0">Note</font></TD><TD><?php echo $content["T_NOTE"];?></TD></TR>
                           </TABLE>
                     </td></tr>
                 <?php endforeach; ?>
            </table>  

            <table width="100%" BORDER=0 cellspacing="0" cellpadding="0" id="submenu1" style="display:none" BORDERCOLOR="#507010">         
                 <?php foreach ($this->Profile as $id => $content): ?>
                     <tr><td>        
                         <br>Purchsed Service...<br><br>
                         <TABLE border=1 BORDERCOLOR="#507010">
                            <TR BGCOLOR="#e8f8d0"><TD>Service Name</TD><TD>Price</TD><TD>Run</TD></TR>
                            <?php foreach ($content[Service] as $sid => $scontent): ?>
                               <TR><TD><?php echo $scontent["ServiceName"];?></font></TD><TD> $ <?php echo $scontent["ServicePrice"];?></font></TD><TD><a href="http://sc.ec.nccu.edu.tw/index.php?act=<?php echo $scontent["ServiceName"]."&id=".$content["T_ID"];?>"><img src="http://sc.ec.nccu.edu.tw/theme/images/click.jpeg" alt="Angry face" border=0 width=25 height=25 /></a></TD></TR>
                            <?php endforeach; ?>
                         </TABLE>  
                     </td></tr>
                 <?php endforeach; ?>
            </table>

            <table width="100%" BORDER=0 cellspacing="0" cellpadding="0" id="submenu2" style="display:none" BORDERCOLOR="#507010">         
                 <?php $total=0; $totalFrequency=0; $totalSecs=0; foreach ($this->Profile as $id => $content): ?>
                     <tr><td>        
                         <br>Accounting Information...<br><br>
                         <TABLE border=1 BORDERCOLOR="#507010">
                            <TR BGCOLOR="#e8f8d0"><TD>Service</TD><TD>Price</TD><TD>Frequency</TD><TD>Secs</TD><TD>SubTotal</TD></TR>
                            <TR><TD> Login System</TD><TD>$ 0</TD><TD><?php echo $content["loginNum"];?></TD><TD> 0 </TD><TD>$ 0</TD></TR>
                            <?php foreach ($content[Service] as $sid => $scontent): ?>
                               <TR><TD><?php echo $scontent["ServiceName"];?></TD><TD>$ <?php echo $scontent["ServicePrice"];?></TD><TD><?php echo $scontent["ServiceFrequency"]; $totalFrequency +=$scontent["ServiceFrequency"];?> </TD><TD><?php echo $scontent["ServiceSecs"]; $totalSecs +=$scontent["ServiceSecs"]; ?> Secs</TD><TD> $ <?php $sub = ($scontent["ServicePrice"]*$scontent["ServiceFrequency"]); $total += $sub; echo $sub;?></TD></TR>
                            <?php endforeach; ?>
                            <TR><TD colspan=5>--------------------------------------------------------------------------</TD></TR>
                            <TR><TD colspan=2 BGCOLOR="#e8f8d0">Total Amount: </TD><TD colspan=3> $ <?php echo $total; ?></TD></TR>
                            <TR><TD colspan=2 BGCOLOR="#e8f8d0">Total Frequency: </TD><TD colspan=3> $ <?php echo $totalFrequency; ?></TD></TR>
                            <TR><TD colspan=2 BGCOLOR="#e8f8d0">Total Secs: </TD><TD colspan=3> <?php echo $totalSecs; ?> Secs</TD></TR>
                            <TR><TD colspan=2 BGCOLOR="#e8f8d0">Average Cost / Secs </TD><TD colspan=3> $ <?php echo ( $total/$totalSecs); ?> </TD></TR>
                            <TR><TD colspan=2 BGCOLOR="#e8f8d0">Average Cost / Frequency </TD><TD colspan=3> $ <?php echo ( $total/$totalFrequency); ?> </TD></TR>
                         </TABLE>  
                     </td></tr>
                 <?php endforeach; ?>
            </table>
            
         </td>
       </tr>
     </table>            
    </div>               

</body>


            
                
   </div>
   
<div id="footer">
   <p><?php echo APP_TAIL; ?></p>
</div>

</div>
</body>
</html>
