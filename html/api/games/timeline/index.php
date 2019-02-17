<?php
	require_once "/var/www/html/lib.php";
	lib_database();
	lib_perms();

if(is_numeric($_GET['room'])){
if(is_numeric($_GET['play'])){
//check card is valid and check position

"SELECT `id`,`name`,`year`,`pic`FROM `Game_Timeline_Events` where id not in (1,2,3) order by RAND() limit 1"//draw random card

}else{
$sql = rowSQL("SELECT `Host`,`Players`,`Timeline`,`Hands` FROM `Game_Timeline` where Host = '$_GET[room]'");
$output = array();
array_push($output,$sql['Timeline']);

$players = explode($sql['Players'],',');
array_push($output,$players);

$hands = explode($sql['Hands'],',');
for($i = 0;$i < count($players);$i++){
if($_SESSION['person'] == $players[$i]){
array_push($output,$hands[$i]);
}
}

echo json_encode($output);
}

}else if(is_numeric($_GET['event'])){
$sql = rowSQL("SELECT `id`,`name`,`year`,`pic` FROM `Game_Timeline_Events` where id = $_GET[event]");
echo json_encode($sql);

}else{
header("HTTP/1.0 400 Not Found");
echo "Bad Request: Specify Room id.";
}

?>