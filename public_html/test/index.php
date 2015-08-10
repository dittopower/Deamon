<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";
	
	var_dump(dir_access("access","/test/css"));
?>