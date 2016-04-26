<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="http://sc.ec.nccu.edu.tw/theme/style_getArticle.css" />
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
</script> 
</head>
<body>
 
<div id="wrap">
<div id="head">
    <div id="left">
      <?php foreach ($this->DataForm as $id => $content): ?>
      <h1><?php echo $content["NAME"];?></h1>
      <h3><?php echo "Go	"."<a href=\"".$content["PERSONAL_SITE"]."\" target=\"new\">Personal Web Site"; break;?></a></h3>
      <?php endforeach; ?>
    </div> 
</div>

<div id="content">
      <div id="main">
      	  <table>
      	    <tr>
	       <td>
	         <?php foreach ($this->DataForm as $id => $content): ?>
         		<h1><?php echo "<a href=\"http://sc.ec.nccu.edu.tw/index.php?act=getArticle&id=".$content["ID"]."\" target=\"new\">".$content["TOPIC"];?></h1></a><br>
        		 <p><?php echo $content["ARTICLE"];?></p>

        		<br/>
        		<br/>
      		<?php endforeach; ?>
            		
            	</td>
            </tr>
       	 </table>
          
    </div>
    <div class="break">
    </div>
    <div id="foot">
      <p class="foot">Copyright &copy; 2008 of EC.NCCU.EDU.TW </p>
    </div>
    <div id="space">
    </div>
  </div>
</div>
</body>
</html>
