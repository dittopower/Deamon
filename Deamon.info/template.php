<?php //Load Template
	$layers = substr_count($_SERVER["PHP_SELF"],"/");
	$home = "";
	for($i = 1;$i < $layers;$i++){
		$home .= "../";
	}
	include $home."deamon.php";
?>
<!-- START content -->



<!-- END content -->
<?php
	include $home."/hidden/end.php";
?>