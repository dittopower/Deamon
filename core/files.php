<?php //File IO
// "/home3/deamon/public_html"
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	date_default_timezone_set('Australia/Brisbane');

function dir_Ensure($directory){
	if(file_exists($directory)){
		return true;
	}
	return mkdir($directory);
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
	$handle = fopen($file, "w");
	fwrite($handle,$content);
	fclose($handle);
}
function writeA($file, $content){
	$handle = fopen($file, "a");
	fwrite($handle,$content);
	fclose($handle);
}
function note($log,$what){
	global $home;
	writeA("$home/core/logs/$log.log","\n".date('Y/m/d H:i:s-T', $_SERVER['REQUEST_TIME'])."::$_SESSION[person]-$_SESSION[name]::".$what);
}

function dir_list($dir){
	global $home;
	if(file_exists($home.$dir)){
		$out = scandir($home.$dir);
		unset($out[0]);
		unset($out[1]);
		/*$test = array_search("exclude this",$out);
		if($test > 0){
			unset($out[$test]);
		}*/
	}else{
		return [];
	}
}
?>