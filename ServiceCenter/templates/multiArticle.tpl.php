<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="http://sc.ec.nccu.edu.tw/theme/style.css"/>
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
document.getElementById("tb0").style.display = "none";
document.getElementById("tb1").style.display = "none";
document.getElementById("tb2").style.display = "none";
document.getElementById("tb3").style.display = "none";
document.getElementById("tb4").style.display = "none";
document.getElementById("tb5").style.display = "none";
document.getElementById("tb6").style.display = "none";

  if(document.getElementById("tb"+id).style.display == "none"){
    document.getElementById("tb"+id).style.display = "";
  }
  else{
    document.getElementById("tb"+id).style.display = "none";
  }
}


function Buildkey(num) {
	var ctr=1;
	document.menu.subtype.selectedIndex=0;
	document.menu.Team_ID.value="";  
	document.menu.subtype.options[0]=new Option("請選擇組別...","");
	/*
	定義二階選單內容
	if(num=="第一階下拉選單的值") {	document.menu.subtype.options[ctr]=new Option("第二階下拉選單的顯示名稱","第二階下拉選單的值");	ctr=ctr+1;	}
	*/	

	if(num=="1") {	document.menu.subtype.options[ctr]=new Option("Web 2.0 時代網路新聞價值鏈模式－－以使用者觀點出發","1"); ctr=ctr+1; }
	if(num=="1") {	document.menu.subtype.options[ctr]=new Option("以體驗行銷觀點探討網路服務整合之研究-以婚禮服務為例x","2");	ctr=ctr+1;	}
	if(num=="1") {	document.menu.subtype.options[ctr]=new Option("匯集眾智知識萃取之創新分享機制","13");	ctr=ctr+1;	}
	if(num=="1") {	document.menu.subtype.options[ctr]=new Option("基於社會網路之協同過濾研究 - 以網路問題商品為例","4");	ctr=ctr+1;	}
	if(num=="1") {	document.menu.subtype.options[ctr]=new Option("新巴賽爾協定下SOA導向服務重組平台","5");	ctr=ctr+1;	}
	if(num=="1") {	document.menu.subtype.options[ctr]=new Option("服務創新應用在創業之動態能耐觀點","6");	ctr=ctr+1;	}
	if(num=="1") {	document.menu.subtype.options[ctr]=new Option("服務導向之老人照護整合系統","7");	ctr=ctr+1;	}
	if(num=="1") {	document.menu.subtype.options[ctr]=new Option("跨組織服務導向(SOA)服務模組下載研究-以電子發票融資為例","8");	ctr=ctr+1;	}

		
	if(num=="2") {	document.menu.subtype.options[ctr]=new Option("網路訊息交換與處理","33");	ctr=ctr+1;	}
	if(num=="2") {	document.menu.subtype.options[ctr]=new Option("價值網絡一知本創業與創投/價值創造/投資泡沫","34");	ctr=ctr+1;	}
	if(num=="2") {	document.menu.subtype.options[ctr]=new Option("學習網絡一創新學習/數位學習/知識建構","35");	ctr=ctr+1;	}
	if(num=="2") {	document.menu.subtype.options[ctr]=new Option("社群網絡一社群網絡/Web2.0/","31");	ctr=ctr+1;	}
	if(num=="2") {	document.menu.subtype.options[ctr]=new Option("社會網絡戰略一連結","32");	ctr=ctr+1;	}
	if(num=="2") {	document.menu.subtype.options[ctr]=new Option("產業網絡一維基經濟學","30");	ctr=ctr+1;	}
	if(num=="2") {	document.menu.subtype.options[ctr]=new Option("企業內網絡一ERP","25");	ctr=ctr+1;	}
	if(num=="2") {	document.menu.subtype.options[ctr]=new Option("企業間網絡一CRM","26");	ctr=ctr+1;	}
	if(num=="2") {	document.menu.subtype.options[ctr]=new Option("傳播網絡一數位匯流","27");	ctr=ctr+1;	}
	if(num=="2") {	document.menu.subtype.options[ctr]=new Option("信息網絡一/資訊經營法則","28");	ctr=ctr+1;	}
	if(num=="2") {	document.menu.subtype.options[ctr]=new Option("企業網絡一網絡互聯經濟","29");	ctr=ctr+1;	}
	if(num=="2") {	document.menu.subtype.options[ctr]=new Option("信息網絡-資訊搜尋/雲端運算","24");	ctr=ctr+1;	}

	if(num=="3") {	document.menu.subtype.options[ctr]=new Option("製造二組(傳產業)","23");	ctr=ctr+1;	}
	if(num=="3") {	document.menu.subtype.options[ctr]=new Option("製造一組(電子業)","22");	ctr=ctr+1;	}
	if(num=="3") {	document.menu.subtype.options[ctr]=new Option("金融組","18");	ctr=ctr+1;	}
	if(num=="3") {	document.menu.subtype.options[ctr]=new Option("房地產及營建組","19");	ctr=ctr+1;	}
	if(num=="3") {	document.menu.subtype.options[ctr]=new Option("通路組","20");	ctr=ctr+1;	}
	if(num=="3") {	document.menu.subtype.options[ctr]=new Option("專業與服務組","21");	ctr=ctr+1;	}
	if(num=="3") {	document.menu.subtype.options[ctr]=new Option("企業參訪","54");	ctr=ctr+1;	}
	if(num=="3") {	document.menu.subtype.options[ctr]=new Option("大國堀起","55");	ctr=ctr+1;	}
	
	if(num=="4") {	document.menu.subtype.options[ctr]=new Option("自行車租賃","45");	ctr=ctr+1;	}
	if(num=="4") {	document.menu.subtype.options[ctr]=new Option("教育文化","46");	ctr=ctr+1;	}
	if(num=="4") {	document.menu.subtype.options[ctr]=new Option("全社福","47");	ctr=ctr+1;	}
	if(num=="4") {	document.menu.subtype.options[ctr]=new Option("<紅利王>網站","48");	ctr=ctr+1;	}
	if(num=="4") {	document.menu.subtype.options[ctr]=new Option("生活精算師","49");	ctr=ctr+1;	}
	if(num=="4") {	document.menu.subtype.options[ctr]=new Option("旅遊業的春天","50");	ctr=ctr+1;	}
	if(num=="4") {	document.menu.subtype.options[ctr]=new Option("福業e護網","51");	ctr=ctr+1;	}
	if(num=="4") {	document.menu.subtype.options[ctr]=new Option("太陽能光電創投","52");	ctr=ctr+1;	}
	
	if(num=="5") {	document.menu.subtype.options[ctr]=new Option("課堂講授區","53");	ctr=ctr+1;	}
		
	document.menu.subtype.length=ctr;
	document.menu.subtype.options[0].selected=true;
} 
</script> 


</head>

<body>
<div id="wrap">
  <div id="head">
    <div id="left">
      <h1>Article</h1>
        <h3>We Make Learning Fun!</h3>
    </div>
    <div id="right">
      <form action="#" method="get">
        <input name="q" class="box" type="text"/><input type="submit" class="button" value="Search" />
      </form>
    </div>
  </div>
  <div id="menu">
    <ul>
      <li><a href="#" onclick="close_open(1)">熱門文章</a></li>
      <li><a href="#" onclick="close_open(5)">課堂講授區</a></li>
      <li><a href="#" onclick="close_open(6)">最新文章</a></li>
      <li><a href="#" onclick="close_open(0)">發表文章</a></li>
    </ul>
  </div>
  <div id="content">
    <div id="sidebar">
      <h3>Menu</h3>
        <ul>
          <li><a href="#" onclick="close_open(2)">全球化與IT創新</a></li>
      	  <li><a href="#" onclick="close_open(3)">企業網絡戰略</a></li>
          <li><a href="#" onclick="close_open(4)">全球創業與投資專題</a></li>
       </ul>
        <br />
        <!--
        <h3>Login</h3>
        <form action="#" method="post">
          <fieldset>
            <p class="form">Username:</p>
              <input name="username" id="user" type="text"/>
            <p class="form">Password:</p>
              <input name="password" id="pass" type="password"/>
              <input name="login" type="submit" value="Login"/>
          </fieldset>
        </form>
        -->
    </div>
    
    
    <div id="main">
      <table width="100%" border="0"><tr><td>
        <tbody id="tb0" style="DISPLAY: none">
	    <tr>
            <td>
             <form NAME="menu" method="post" action="./index.php?act=postArticle">
             <h1>標題<input type="text" name="TOPIC" ><br></h1>
             <p>
             <textarea name="ARTICLE" rows="10" cols="50"></textarea><br>
             Google_Docs_link:<input type="text" name="Google_Doc"><br>
             Tag:<input type="text" name="TAG"><br>
              </p>
             </td>
             </tr>
	    <tr>
	    <td>
	  發表至<br>
	    <select name=type size=1 onChange="Buildkey(this.options[this.options.selectedIndex].value);">
	    <option value=0>請選擇課程...</option>
	    <option value="5" >課堂講授區</option>
	    <option value="1" >961_服務科技與創新營運模式</option>
	    <option value="2" >971_企業網絡戰略</option>
	    <option value="3" >971_全球創業與投資專題</option>
	    <option value="4" >971_全球化與IT創新</option>
	    </select>
	    <select name=subtype size=1 onChange="document.menu.Team_ID.value=this.options[this.options.selectedIndex].value;">
	    <option value="">請選擇組別..</option>
   	    </select> 
	</td>
	</tr>
	<input type="hidden" name="Team_ID" value="" size=5>
        <tr><td>
	<br>
		Username:
		<input type="text" name="M_ID">
		<br>
		Password: 
		<input type="password" name="password"><br>
		<?php echo date("Y-n-d H:i:s");?>
		<input type="submit" value="確認送出" name="B1">
	</form> 
            </td>
            </tr>
       </tbody>
       </td>
       </tr>
    </table>
   	 
   	 
     <table width="100%" border="0">
      <tbody id="tb1" style="DISPLAY: block">
      <tr><td>
      <?php foreach ($this->DataForm as $id => $content): ?>
         <h1><?php echo "<a href=\"http://sc.ec.nccu.edu.tw/index.php?act=getArticle&id=".$content["ID"]."\" target=\"top\">".$content["TOPIC"];?></h1></a><br>
         <p><?php echo $content["ARTICLE"];?></p>
        <br/>
        <br/>
      <?php endforeach; ?>
      </td>
      </tr>
      </tbody>
      </table>
           <table width="100%" border="0">
      <tbody id="tb2" style="DISPLAY: none">
      <tr><td>
      <?php foreach ($this->DataForm2 as $id => $content): ?>
     
         <h1><?php echo "<a href=\"http://sc.ec.nccu.edu.tw/index.php?act=getArticle&id=".$content["ID"]."\" target=\"top\">".$content["TOPIC"];?></h1></a><br>
        <p><?php echo $content["ARTICLE"];?></p>
        <br/>
        <br/>
      <?php endforeach; ?>
      </td>
      </tr>
      </tbody>
      </table>
           <table width="100%" border="0">
      <tbody id="tb3" style="DISPLAY: none">
      <tr><td>
      <?php foreach ($this->DataForm3 as $id => $content): ?>
     
         <h1><?php echo "<a href=\"http://sc.ec.nccu.edu.tw/index.php?act=getArticle&id=".$content["ID"]."\" target=\"top\">".$content["TOPIC"];?></h1></a><br>
        <p><?php echo $content["ARTICLE"];?></p>
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
      <?php foreach ($this->DataForm4 as $id => $content): ?>
     
         <h1><?php echo "<a href=\"http://sc.ec.nccu.edu.tw/index.php?act=getArticle&id=".$content["ID"]."\" target=\"top\">".$content["TOPIC"];?></h1></a><br>
        <p><?php echo $content["ARTICLE"];?></p>
        <br/>
        <br/>
      <?php endforeach; ?>
      </td>
      </tr>
      </tbody>
      </table>
           <table width="100%" border="0">
      <tbody id="tb5" style="DISPLAY: none">
      <tr><td>
      <?php foreach ($this->DataForm5 as $id => $content): ?>
        <h1><?php echo "<a href=\"http://sc.ec.nccu.edu.tw/index.php?act=getArticle&id=".$content["ID"]."\" target=\"top\">".$content["TOPIC"];?></h1></a><br>
        <p><?php echo $content["ARTICLE"];?></p>
        <br/>
        <br/>
         <?php endforeach; ?>
      </td>
      </tr>
      </tbody>
      </table>
           <table width="100%" border="0">
      <tbody id="tb6" style="DISPLAY: none">
      <tr><td>
      <?php foreach ($this->DataForm6 as $id => $content): ?>
     
         <h1><?php echo "<a href=\"http://sc.ec.nccu.edu.tw/index.php?act=getArticle&id=".$content["ID"]."\" target=\"top\">".$content["TOPIC"];?></h1></a><br>
        <p><?php echo $content["ARTICLE"];?></p>
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
</body>
</html>
