<?php //Permissions
$home = $_SERVER['DOCUMENT_ROOT']."/";
require_once $home."../core/login.php";
require_once $home."../core/database.php";

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
	
	function dir_access($perm, $dir){
		$pe = getUserLevel($perm);
		if($pe != 3 && $pe != 1){
			if($pe > 0){
				$base_dir = getUserPerm($perm);
				if($base_dir == ''){
					$base_dir = "this_guy_doesn't_have_a_base";
				}
				$pattern = "/^(".preg_replace("/\//","\\/",$base_dir)."|\.\.\/media\/$_SESSION[person]\/)([\/#\?].*|)$/";
			}else{
				$pattern = "/^\.\.\/media\/$_SESSION[person]\/([\/#\?].*|)$/";
			}
			return preg_match($pattern,$dir);
		}
		return false;
	}
?>