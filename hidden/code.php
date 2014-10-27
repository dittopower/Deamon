<?php
	
	include 'connection_include.php';

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

	
	
	function pagename(){
		$url = $_SERVER['PHP_SELF'];
		$Nname = "";
		if (preg_match("/\/(.*)\//", $url,$result)){
			$Nname = "@".ucfirst($result[count($result)-1]);
		if (preg_match("/.*\/(.+)\./", $url,$results)& ($results[count($results)-1] !='index')){
			$Nname .= " - ".ucfirst($results[count($results)-1]);
		}
		}
		return $Nname;
	}
?>