<?php //Load Template
	$layers = substr_count($_SERVER["PHP_SELF"],"/");
	$home = "";
	if($layers <= 1){
		$home = "./";
	}else{
		for($i = 1;$i < $layers;$i++){
			$home .= "../";
		}
	}
	require $home."hidden/deamon.php";
	require $home."hidden/start.php";
	require $home."hidden/nav.php";
?>
<!-- START content -->
I wanted a site to host my work, my random projects and my opinions. So I made this one.

<br><br><br><br><br>
<hr>
<a href="#" id=seclock class='_pannel' alt="website security" title="SiteLock" onclick="window.open('https://www.sitelock.com/verify.php?site=deamon.info','SiteLock','width=600,height=600,left=160,top=170');"></a>

<!-- END content -->
<?php
	require $home."hidden/end.php";
?>