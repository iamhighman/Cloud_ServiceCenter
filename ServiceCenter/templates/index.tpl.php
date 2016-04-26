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
      <?php if (count($this->TopCoupon)): ?>
      <?php foreach ($this->TopCoupon as $id => $coupon): ?>
      <div class="messageBlock">
      <h2><?php echo $coupon["CLASS"]." - ".$coupon["NAME"]; ?></h2>
      <p><?php echo nl2br($coupon["DISCOUNT"]); ?></p>
      <p class="messageBlockFunctions">備註 <?php echo $coupon["README"]; ?></p>
   </div>
   
   <?php endforeach; ?>
   <?php else: ?>
   <p>沒有任何優惠券</p>
   <?php endif; ?>
</div>
   
<div id="footer">
   <p><?php echo APP_TAIL; ?></p>
</div>

</div>
</body>
</html>
