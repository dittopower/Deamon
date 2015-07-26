<?php 
	
	$mysqli = new mysqli('localhost', 'deamon_site', 'OL.qc6G?&W_bSwQ~', 'deamon_core');

	if ($mysqli->connect_error) {
		die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
		echo '<script>alert("Database Connection Failure!");</script>';
	}

?>
