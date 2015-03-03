<?php

	function singleSQL($sql, $mysqli){
	
		$p = mysqli_query($mysqli,$sql);
		$result = 0;

		if($p != NULL){
			$t = mysqli_fetch_array($p,MYSQLI_BOTH);
			$result = $t[0];
		}
		
		return $result;
	
	}//runs a command that will give a single result (or you only need the first result)
	
	function singleRowSQL($sql, $mysqli){
	
		$p = mysqli_query($mysqli,$sql);
		$row = mysqli_fetch_array($p,MYSQLI_BOTH);
		if($row != NULL){
			return $row;
		}
		else{
			return 0;
		}
	
	}//runs a command that will give a result as an single row
	
	function multiSQL($sql, $mysqli){
	
		$p = mysqli_query($mysqli,$sql);
		if($p != NULL){
			return $p;
		}
		else{
			return 0;
		}
	
	}//runs a command that will give a result as an array
	
	function runSQL($sql, $mysqli){
		return mysqli_query($mysqli,$sql);	
	}//run a command that either passes or failes (doesn't have an output)
		
	function phpFilesInDirectory(){
	
		$files = array();
		$count = 0;

		if ($handle = opendir('.')) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != ".." && strpos($entry,'.php') !== false) {
					$files[$count] = $entry;
					$count++;
				}
			}
			closedir($handle);
	    }
		
		return $files;
	
	}
	
	function distance($lat1, $long1, $lat2, $long2){
		$earthsradius = 6371;
		
		$dLat = deg2rad($lat2-$lat1);
		$dLong = deg2rad($long2-$long1);
		$lat1 = deg2rad($lat1);
		$lat2 = deg2rad($lat2);
		$hsLat = sin($dLat/2);
		$hsLong = sin($dLong/2);
		$clat1 = cos($lat1);
		$clat2 = cos($lat2);
		$a = $hsLat * $hsLat + $hsLong * $hsLong * $clat1 * $clat2;

		$c = 2 * atan2(sqrt($a), sqrt(1-$a)); 

		return $earthsradius * $c;
	}

?>