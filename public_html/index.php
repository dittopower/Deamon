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
	require $home."core/feed.php";
	
?>
<!-- START content -->

<h1>Deamon</h1><h2>Tech, Games & Code</h2><h3>Coming Soon</h3>
<br>
yeah, yeah, i'm slowly making it..

<?php 
	feed('');
?>

<!-- END content -->
<?php
	require $home."hidden/end.php";
?>