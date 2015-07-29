<?php //File IO
// "/home3/deamon/public_html"

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

?>