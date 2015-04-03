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



<!-- END content -->
<?php
	require $home."hidden/end.php";
?>