<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."../core/media.php";

	media_(key($_GET));	
?>