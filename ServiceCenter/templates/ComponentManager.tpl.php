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
<B>Component Manager</B>
</div>

<div id="content">
      <Br>
      <?php foreach ($this->DataForm as $id => $form): ?>
      <?php echo $form; ?>
      <?php endforeach; ?>
      <Br>
</div>
<div id="footer"></div>
</div>
</body>
</html>