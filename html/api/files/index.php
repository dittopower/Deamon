<?php
	require_once "/var/www/html/lib.php";
	lib_files();
	lib_perms();

//Check user permissions for directory access
if(dir_access("access",$home.$_GET['where'])){

	$scan = dir_list($home.$_GET['where']);

	$results = array();
	foreach($scan as $object){
		$resu = array();
		$resu['name'] = $object;

		if(is_dir($home.$_GET['where']."/".$object)){
			$resu['folder'] = true;
		}else{
			$resu['folder'] = false;
		}
		array_push($results, $resu);
	}

//output results
$results = json_encode($results);
echo $results;

}else{
toss(403);
}

?>