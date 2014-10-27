<?php
	$mysqli = new mysqli('mysql7.000webhost.com', 'a4561011_deamon', 'Overide0', 'a4561011_core');

	if ($mysqli->connect_error) {
		die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
		echo '<meta http-equiv="refresh" content="0; url=../sos.html"/>';
	}


	function singleSQL($sql){
		global $mysqli;
		
		$p = mysqli_query($mysqli,$sql);
		$result = 0;

		if($p != NULL){
			$t = mysqli_fetch_array($p,MYSQLI_BOTH);
			$result = $t[0];
		}
		
		return $result;
	
	}//runs an sql statement and returns only a single result
	
	function singleRowSQL($sql){
		global $mysqli;
	
		$p = mysqli_query($mysqli,$sql);
		$row = mysqli_fetch_array($p,MYSQLI_BOTH);
		if($row != NULL){
			return $row;
		}
		else{
			return 0;
		}
	
	}//runs a command that will give a result as an single row
	
	function multiSQL($sql){
		global $mysqli;
	
		$p = mysqli_query($mysqli,$sql);
		if($p != NULL){
			return $p;
		}
		else{
			return 0;
		}
	
	}//runs a command that will give a result as an array
	
	function runSQL($sql){
		global $mysqli;
		return mysqli_query($mysqli,$sql);	
	}//run a command that either passes or failes (doesn't have an output)
	
?>