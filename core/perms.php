<?php //Permissions
	require_once "/home3/deamon/lib.php";
	lib_login();
	lib_database();
	lib_code();

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
	
	//Throw the http error if the user isn't logged in
	function enforce_user(){
		global $home;
		if(!isUser()){
			toss(401);
		}
	}
	
	//Throw the http error if the user isn't logged in
	function enforce_perm($perm){
		global $home;
		if(!canUser($perm)){
			toss(403);
		}
	}
	
	function dir_access($perm, $dir){
		global $home;
		Ndebug("directory",$dir);
	//	$dir = realpath($dir);
	//	Ndebug("directory",$dir);
		$pe = getUserLevel($perm);
		Ndebug("User Level",$perm);
		debug($pe);
		if($pe != 3 && $pe != 1){
			if($pe > 0){
				$base_dir = getUserPerm($perm);
				if($base_dir == ''){
					$base_dir = "this_guy_doesn't_have_a_base";
				}
				Ndebug("base directory",$base_dir);
				$pattern = "/(".preg_replace("/\//","\\/",$base_dir)."|\.\.\/media\/$_SESSION[person])([\/#\?].*|)$/";
			}else{
				$pattern = "/^\.\.\/media\/$_SESSION[person]\/([\/#\?].*|)$/";
			}
			Ndebug("pattern",$pattern);
			return preg_match($pattern,$dir);
		}
		return false;
	}
?>