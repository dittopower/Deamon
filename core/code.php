<?php

///Debug Functions
	$debug = isset($_GET['debug']) || isset($_POST['debug']);
	//Dump something to the page when debugging
	function debug($thisshit){
		global $debug;
		if ($debug){
			echo "<br>";
			var_dump($thisshit);
			echo "<br>";
		}
	}
	//Dump something to the page with a description.
	function Ndebug($name,$thisshit){
		global $debug;
		if ($debug){
			echo "<hr><h1>$name</h1>";
			var_dump($thisshit);
			echo "<hr>";
		}
	}
	//Dump everything
	function bugs(){
		global $debug;
		if($debug){
			echo "<hr><h1>All: </h1><h2>Variables</h2>";
			var_dump(get_defined_vars());
			echo "<h2>System Variables</h2>";
			echo "<h3>_GET</h3>";
			foreach($_GET as $key=>$val){
				echo "$key  =>  $val <br>";
			}
			echo "<h3>_POST</h3>";
			foreach($_POST as $key=>$val){
				echo "$key  =>  $val <br>";
			}
			echo "<h3>_SESSION</h3>";
			foreach($_SESSION as $key=>$val){
				echo "$key  =>  $val <br>";
			}
			echo "<h3>_SERVER</h3>";
			foreach($_SERVER as $key=>$val){
				echo "$key  =>  $val <br>";
			}
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
	
?>