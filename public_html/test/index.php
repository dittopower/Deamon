<?php //Load Template
	require_once "/home3/deamon/lib.php";
	lib_code();
	$salt = salt();
	var_dump(encrypt("Overide0",$salt,deamon));
	var_dump($salt);
?>