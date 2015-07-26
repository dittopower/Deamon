<?php //Permissions

//Check if logged in
	function isUser(){
		return isset($_SESSION['person']);
	}

//Get user permission level
	function getUserLevel($what){
		if(isUser){
			$cUsql = "Select level from D_Perms where UserId = '$_SESSION[person]' and what = '$what'";
			return singleSQL($cUsql);
		}
		return 0;
	}

//Check if User has a permission
	function canUser($what){
		if(getUserLevel($what) >= 1){
			return true;
		}
		return false;
	}

//Get user permission extra/note
	function getUserPerm($what){
		if(isUser){
			$cUsql = "Select other from D_Perms where UserId = '$_SESSION[person]' and what = '$what'";
			return singleSQL($cUsql);
		}
		return 0;
	}

//Check if user has a specific permission extra/note
	function canUserPerm($what, $thing){
		if(canUser($what)){
			$sql = "/^".getUserPerm($what)."/";
			return preg_match($sql, $thing);
		}else{
			return 0;
		}
	}
?>