<?php 
	
	$mysqli = new mysqli('mysql7.000webhost.com', 'a4561011_deamon', 'Overide0', 'a4561011_core');

	if ($mysqli->connect_error) {
		die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
	}

?>
