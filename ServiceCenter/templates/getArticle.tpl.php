<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="http://sc.ec.nccu.edu.tw/theme/style_getArticle.css"/>
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

function fmenux(id){
	
document.getElementById("submenu0").style.display = "none";
document.getElementById("submenu1").style.display = "none";

document.getElementById("submenu" + id).style.display = "block";
}

function close_open(id){

document.getElementById("tb1").style.display = "none";
document.getElementById("tb2").style.display = "none";
document.getElementById("tb3").style.display = "none";
document.getElementById("tb4").style.display = "none";
document.getElementById("tb5").style.display = "none";

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
 <?php foreach ($this->DataForm as $id => $content): ?>
<div id="wrap">
  <div id="head">
    <div id="left">
   
      <h1><?php echo $content["TOPIC"]?></h1>
        <h3><?php echo "By	"."<a href=\"".$content["PERSONAL_SITE"]."\" target=\"new\">".$content["NAME"];?></a></h3>
          <blockquote>
            <img src="http://sc.ec.nccu.edu.tw/theme/images/photo/icon-click.gif" alt="">點閱：<?php echo $content["CLICK_COUNT"]?>
	    <img src="http://sc.ec.nccu.edu.tw/theme/images/photo/icon-digg.gif" alt="">評分：<?php echo $content["CLICK_COUNT"]?>
	    <img src="http://sc.ec.nccu.edu.tw/theme/images/photo/icon-comm.gif" alt="">評論：<?php echo $content["COUNT_COMMENT"]?>
	    <br>
            <img src=" <?php echo $content["TREE"];?> " alt="人氣指樹" width="100" height="100">          
          </blockquote> 
    </div>
    <div id="right">
      <form action="#" method="get">
        <input name="q" class="box" type="text"/><input type="submit" class="button" value="Search" />
      </form>
    </div>
  </div>
  <div id="menu">
    <ul>
      <li><a href="#" onclick="close_open(1)">內容簡介</a></li>
      <li><a href="#" onclick="close_open(2)">作者簡介</a></li>
      <li><a href="#" onclick="close_open(3)">標籤</a></li>
      <li><a href="#" onclick="close_open(4)">評論</a></li>
      <li><a href="#" onclick="close_open(5)">評分</a></li>
      
    </ul>
  </div>
  <div id="content">
      <div id="main">
      	<table width="100%" border="0">
      	<tbody id="tb1" style="DISPLAY: block">
      	<tr><td>
      	<ul>
          	<li><?php echo $content["ARTICLE"];?><br>
          	<iframe src="<?php echo $content["DOC_LINK"];?>" frameborder="0" width="630" height="342"></iframe> </li>
      	</ul>
      	</td>
      	</tr>
      </tbody>
      </table>
      
      <table width="100%" border="0">
      <tbody id="tb2" style="DISPLAY: none">
      <tr><td>
        <?php foreach ($this->DataForm as $id => $content): ?>
        <img src=" <?php echo $content["M_IMAGE"];?> " width="60" height="60">
      	<?php echo $content["CONTENT"];?><br>
        <?php echo "<a href=\"".$content["PUB_DOC"]."\" target=\"top\">>>read more</a> ";?> 
        
      <?php endforeach; ?>
      </td>
      </tr>
      </tbody>
      </table>
      <table width="100%" border="0">
      <tbody id="tb3" style="DISPLAY: none">
      <tr><td>
      <?php foreach ($this->DataForm as $id => $content): ?>
         <p><a href="http://sc.ec.nccu.edu.tw/index.php?act=findTag&id=<?php echo $content["TAG"]; ?> "><?php echo $content["TAG"]; ?></a></p>
        <br/>
        <br/>
      <?php endforeach; ?>
      </td>
      </tr>
      </tbody>
      </table>
      <table width="100%" border="0">
      <tbody id="tb4" style="DISPLAY: none">
      <tr><td>
      <?php foreach ($this->DataForm as $id => $content): ?>
        <?php foreach ($content[CommentArr] as $id2 => $content2): ?>
            <table border="1" width="50%">
            <tr>
                <td rowspan="2" width="80">
                   <img src=" <?php echo $content2["IMAGE"];?> " width="80" height="80"><br>
                   <?php echo "<a href=\"http://sites.google.com/a/ec.nccu.edu.tw/".$content2["U_ID"]."\" target=\"new\">".$content2["U_NAME"];?></a><br>	
                </td>
                <td >
                   推薦分數:<?php echo $content2["SCORE"];?>	
                </td>
                <td>
                <?php echo $content2["TIME"];?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <?php echo $content2["DESCRIPTION"]?>
                </td>
            </tr>
            
            <?php endforeach; ?>
           </table>
         <?php endforeach; ?>
      </td>
      </tr>
      </tbody>
      </table>
      <table width="100%" border="0">
      <tbody id="tb5" style="DISPLAY: none">
      <tr><td>
      <?php foreach ($this->DataForm as $id => $content): ?>
         <h1>文章評論</h1></a><br>
         <form NAME="menu" method="post" action="./index.php?act=scoreArticle">
             <textarea name="DESCRIPTION" rows="10" cols="30"></textarea><br>
             <select id="SCORE" name="SCORE" onChange="load(this.form)" size="1" class="90V" style="background-color: rgb(196,226,103)">
		<option selected >推薦指數</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		</select></p><br>
		Username:
		<input type="text" name="U_ID">
		<br>
		Password: 
		<input type="password" name="password"><br>
		<?php echo date("Y-n-d H:i:s");?>
		<input type="hidden" name="MA_ID" value="<?php echo $content["ID"];?>"><br>
		<INPUT TYPE=SUBMIT onCLICK="return SCORE.selectedIndex=='0'?(alert('請給分'),false):true;" value="確認送出" name="B1">
		</form> 
        <br/>
        <br/>
      <?php endforeach; ?>
      </td>
      </tr>
      </tbody>
      </table>
          
    </div>
    <div class="break">
    </div>
    <div id="foot">
	<p class="foot">Copyright &copy; 2008 of EC.NCCU.EDU.TW </p>    </div>
    <div id="space">
    </div>
  </div>
</div>
  <?php endforeach; ?>
</body>
</html>
