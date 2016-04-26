<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="theme/main.css" />
<title><?php echo APP_NAME; ?></title>
</head>

<body>
<div id="container">
<div id="header">
<h1><?php echo APP_NAME; ?></h1>
</div>
   <div id="functions">
      <ul>
      <?php foreach ($this->Login as $id => $menu): ?>
      <li><?php echo $menu; ?></li>
      <?php endforeach; ?>
      </ul>
   </div>
   
<div id="content">
      <Br>
      <?php foreach ($this->DataForm as $id => $form): ?>
      <li><?php echo $form; ?></li>
      <?php endforeach; ?>
      <Br>
</div>
<div id="footer"></div>
</div>
</body>
</html>