<?php 
	switch($database){
		case "deamon":
			$mydb = "deamon_core";
			$mydbu = "deamon_site";
			$mydbp = "OL.qc6G?&W_bSwQ~";
			break;
		case 302:
			$mydb = "deamon_INB302";
			$mydbu = "deamon_302";
			$mydbp = "rip.Inplace2015";
			break;
	}
	if(isset($mydb)){
		$mysqli = new mysqli('localhost', $mydbu, $mydbp, $mydb);
		unset($mydb,$mydbu,$mydbp);
		if ($mysqli->connect_error) {
			die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
			echo '<script>alert("Database Connection Failure!");</script>';
		}
		
		register_shutdown_function('closeCon');
	}
	
	function closeCon(){
		global $mysqli;
		mysqli_close($mysqli);
	}
	
///Functions	
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
		}//while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
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
	
	function dump_table($table){
		table("Select * from $table");
	}
	
	function table($sql){
		//Display Table Contents
		$result = multiSQL($sql);
		$header = 1;
		echo "<table><tr><th>File Name:</th><th>Sharing Status:</th><th>Controls:</th></tr>";
		while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
			if($header){
				echo "<tr>";
				foreach($row as $key=>$value){
					echo "<th>$key</th>";
				}
				echo "</tr>";
				$header = 0;
			}
			echo "<tr>";
			foreach($row as $value){
				echo "<td>$value</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
?>