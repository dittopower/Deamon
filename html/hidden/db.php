<?php

	

	require_once('connection_include.php');

	

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

	

	function rowSQL($sql){

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

	

	function escapeSQL($text){

		global $mysqli;

		return mysqli_real_escape_string($mysqli,$text);

	}

?>