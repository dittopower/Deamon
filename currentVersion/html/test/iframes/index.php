<?php
	require_once "/var/www/html/lib.php";
	page();


bugs();
?>
<iframe style="width:100%;height:100%;" src='http://<?php echo $_SERVER['SERVER_NAME']; echo "/test/iframes"; ?>'>
