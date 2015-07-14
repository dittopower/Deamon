<?php
	$pageurl = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	
	function debug($thisshit){
		if (isset($_GET['debug'])){
			$thisshit = htmlentities($thisshit,ENT_QUOTES | ENT_HTML5);
			echo "<br>";
			var_dump($thisshit);
			echo "<br>";
		}
	}
	
//Current Hash encryption
	function encrypt($what){
		 return md5(md5($what."Battle")."Mage");
	}
	
//Check if is logged in
	function isUser(){
		return isset($_SESSION['person']);
	}
//Check user permissions	
	function getUserLevel($what){
		if(isUser){
			$cUsql = "Select level from D_Perms where UserId = '$_SESSION[person]' and what = '$what'";
			return singleSQL($cUsql);
		}
		return 0;
	}
	
	function canUser($what){
		if(getUserLevel($what) >= 1){
			return true;
		}
		return false;
	}
	
	function getUserPerm($what){
		if(isUser){
			$cUsql = "Select other from D_Perms where UserId = '$_SESSION[person]' and what = '$what'";
			return singleSQL($cUsql);
		}
		return 0;
	}
	
	function canUserPerm($what, $thing){
		if(canUser($what)){
			$sql = "/^".getUserPerm($what)."/";
			return preg_match($sql, $thing);
		}else{
			return 0;
		}
	}
	
	
	function get_mydir(){
		// /home3/deamon/public_html
		$mydir=getcwd();
		$temp = explode("/",$mydir);
		if($temp[count($temp)-2] == 'deamon'){
			return 'Home';
		}
		return ucfirst($temp[count($temp)-1]);
	}
	
	
	
	
	function htmlescape($string){
		return htmlentities($string,ENT_QUOTES | ENT_HTML5);
	}
	
	function htmlunescape($string){
		return html_entity_decode($string,ENT_QUOTES | ENT_HTML5);
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