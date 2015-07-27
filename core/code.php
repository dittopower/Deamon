<?php

///Debug Functions
	$debug = isset($_GET['debug']);
	//Dump something to the page when debugging
	function debug($thisshit){
		if ($debug){
			echo "<br>";
			var_dump($thisshit);
			echo "<br>";
		}
	}
	//Dump something to the page with a description.
	function Ndebug($name,$thisshit){
		if ($debug){
			echo "<hr><h1>$name</h1>";
			var_dump($thisshit);
			echo "<hr>";
		}
	}
	//Dump everything
	function bugs(){
		if($debug){
			echo "<hr><h1>All: </h1><h2>Variables</h2>";
			var_dump(get_defined_vars());
			echo "<h2>Functions</h2>";
			var_dump(get_defined_functions()['user']);
		}
	}



///Error functions
	//Throw the use to an error page. MUST be called before any output.
	function toss ($ecode){
		header("HTTP/1.0 ".$ecode);
		$_SERVER['REDIRECT_STATUS'] = $ecode;
		global $home;
		include "$home/error.php";
		die();
	}
	
///Text Functions
	//Current Hash encryption
	function encrypt($what){
		 return md5(md5($what."Battle")."Mage");
	}
	
	//Make Text html safe/ready.
	function htmlescape($string){
		return htmlentities($string,ENT_QUOTES | ENT_HTML5);
	}
	
	//Return html safe/ready Text to normal Text.
	function htmlunescape($string){
		return html_entity_decode($string,ENT_QUOTES | ENT_HTML5);
	}



///Page Functions
	//Page's URL
	$pageurl = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	
	//Make a page title that fits the site's style.
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