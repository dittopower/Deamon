<?php
	$pageurl = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	
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
		if(getUserLevel($what) == 1){
			return true;
		}
		return false;
	}
	
	
	function debug($thisshit){
		if (isset($_GET['debug'])){
			$thisshit = htmlentities($thisshit,ENT_QUOTES | ENT_HTML5);
			echo "<br>";
			var_dump($thisshit);
			echo "<br>";
		}
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