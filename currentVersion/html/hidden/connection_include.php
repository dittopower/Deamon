<?php 

	

	$mysqli = new mysqli('localhost', '{{credu}}', '{{credp}}', '{{credd}}');



	if ($mysqli->connect_error) {

		die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);

		echo '<script>alert("Database Connection Failure!");</script>';

	}



?>

