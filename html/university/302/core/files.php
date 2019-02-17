<?php //File IO
	date_default_timezone_set('Australia/Brisbane');

function dir_Ensure($directory){
	if(preg_match("/.*\.[a-zA-Z0-9]+/",$directory)){
		$directory = pathinfo($directory,PATHINFO_DIRNAME);
	}
	if(file_exists($directory)){
		return true;
	}
	return mkdir($directory,0777,true);
}

function dir_Name(){//check can be replaced by __DIR__?
	$mydir=getcwd();
	$temp = explode("/",$mydir);
	if($temp[count($temp)-2] == 'deamon'){
		return 'Home';
	}
	return ucfirst($temp[count($temp)-1]);
}

function write($file, $content){
	dir_Ensure($file);
	$handle = fopen($file, "w");
	fwrite($handle,$content);
	fclose($handle);
}
function writeA($file, $content){
	dir_Ensure($file);
	$handle = fopen($file, "a");
	fwrite($handle,$content);
	fclose($handle);
}
function note($log,$what){
	global $local;
	writeA("$local/core/logs/$log.log","\n".date('Y/m/d H:i:s-T', $_SERVER['REQUEST_TIME'])."::$_SESSION[person]-$_SESSION[name]::".$what);
}

function load($url){
	if (file_exists($url)){
		$text = file_get_contents($url);
	}else{
		$text = "404 - File Not Found";
	}
	return $text;
}

function dir_list($dir){
	if(file_exists($dir)){
		$out = scandir($dir);
		unset($out[0]);
		unset($out[1]);
		/*$test = array_search("exclude this",$out);
		if($test > 0){
			unset($out[$test]);
		}*/
		return $out;
	}else{
		return [];
	}
}

//Recusive deleting function
function delTree($dir){
	$files = array_diff(scandir($dir), array('.','..')); 
	foreach ($files as $file){
		(is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
	}
	return rmdir($dir);
}

  //general delete function
function delete ($thing){
	if(is_dir($thing)){
		return delTree($thing);
	}else if(is_file($thing)){
		return unlink($thing);
	}
	return false;
}
?>