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

	function encrypt($what){
		 return md5(md5($what."Battle")."Mage");
	}
	
	
	
	function pagename(){
		$url = $_SERVER['PHP_SELF'];
		$Nname = "";
		$temp = explode("/",$url);
		$c = count($temp);
		foreach($temp as $key=>$tem){
			$temp[$key] = ucfirst($tem);
			if(substr_count($tem, "index.") > 0 || $tem === ""){
				unset($temp[$key]);
				$c--;
			}
		}
		if (count($temp) > 0){
			$Nname = "D@";
			$c = end($temp);
			foreach($temp as $key=>$tem){
				if($c != $tem){
					if($tem != ""){$Nname .= $tem[0]."/";}
				}else{
					preg_match("/([^.?&#]+)/i",$tem,$res);
					$Nname .= $res[0];
				}
			}
		}else{
			$Nname = "Deamon";
		}
		return $Nname;
	}
?>