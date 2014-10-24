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
	
	function checkFilePermission($file, $mysqli){
		$file = basename($file, '.php');
		if(isset($_SESSION['User'])){
			$user = $_SESSION['User'];
			
			$t = singleSQL("SELECT Access FROM 201_filepermissions WHERE FileName='$file'",$mysqli);
			$reqCodes = explode(",",$t);
			
			$t = singleSQL("SELECT AccessCode FROM 201_users WHERE Username='$user'",$mysqli);
			$userCodes = explode(",",$t);
			
			if(in_array("SA", $userCodes) || in_array("AA", $reqCodes)){ return true; }
			
			for($i = 0; $i < count($userCodes); $i += 1){
				if(in_array($userCodes[$i], $reqCodes)){
					return true;
				}
			}
			
			return false;
		}
		
		return false;
	}
	
	function checkPermission($code, $mysqli){
		$user = $_SESSION['User'];
		$t = singleSQL("SELECT AccessCode FROM 201_users WHERE Username='$user'", $mysqli);
		$code = explode(",",$code);
		$userCodes = explode(",",$t);
		
		if(in_array("SA", $userCodes) || in_array("AA", $code)){ return true; }
		
		for($i = 0; $i < count($userCodes); $i += 1){
			if(in_array($userCodes[$i], $code)){
				return true;
			}
		}
		
		return false;
	}
	
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
	
	function searchbox(){
		echo '<div id="health_search">
			<form action="patientList.php" method="get">
				<input type="text" name="search" placeholder="Enter a Patients Name or ID" class="txt_field" />
				<input type="submit" value="Search" alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
			</form>
		</div>';
	}
	
		function usersearchbox(){
		echo '<div id="health_search">
			<form action="users.php" method="get">
				<input type="text" name="search" placeholder="Enter a Patients Name or ID" class="txt_field" />
				<input type="submit" value="Search" alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
			</form>
		</div>';
	}

?>