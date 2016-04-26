<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="theme/main.css" />
<title><?php echo APP_NAME; ?></title>
</head>

<body>
      傳Array的情況：<br>
      <?php foreach ($this->Profile as $id => $content): ?>
      <?php echo $content;?>
      <?php endforeach;  ?>
      <br><br>傳單個值的情況：<br>
      <?php echo $this->Profile; ?>
      
      
</body>
</html>
