?<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="theme/main.css" />
<title><?php echo APP_NAME; ?></title>

</head>

<body>
<div id="container">
   <div id="header">
      scoreArticle Gadget
   </div>
   
   <div id="functions">
            
   </div>




   <div id="content">
       
    <table border="1" width="80%">
	<?php foreach ($this->DataForm as $id => $content): ?>
            <tr>
                <td height="10" align=right><?php print_r($content);?><br><br><br><br>
                          <?php print_r($this->DataForm);?>
                          <br><br><br><br>
                         
            </tr>
            <tr><td height="10" align=center>
            <?php echo $content["TOPIC"]."	by	".$content["M_ID"];?>
            </td>
            
            </tr>
            <tr>
                <td height="10" align=left>
                         <?php echo $content["ARTICLE"];?>
            		</td>
            </tr>
            <tr><td height="10" align=right>
            <?php echo "<a href=\"".$content["DOC_LINK"]."\" target=\"new\">>>read more</a> ";?></td>
            </td>
            </tr>
           
         <?php endforeach; ?>
    </table>    

  
<div id="footer">
   <p><?php echo APP_TAIL; ?></p>
</div>

</div>
</body>
</html>
