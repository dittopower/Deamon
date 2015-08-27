<?php //Start Page
	require_once "/home3/deamon/lib.php";
	lib_perms();
	lib_files();

echo "<html><head>";
echo "<title>Deamon.(".dir_Name().")</title>";
echo "<link rel='manifest' href='/manifest.json'>";
echo "<link href='//deamon.info/deamonic.css' rel='stylesheet' type='text/css'/>";

if (file_exists($home."../media/$_SESSION[person]/custom.css")){
	echo '<link href="//deamon.info/files/view?name=custom.css" rel="stylesheet" type="text/css"/>';
}

echo "<script src='/service-worker.js' type='text/javascript'></script>";
//echo"";analytics

//end head
echo "</head>";

//Start body
echo "<body><header>";
//title
echo "<a href='//deamon.info' class='headbar'><h1 style='display:inline;'>Deamon.(".dir_Name().")</h1></a>";
//Navbar
echo "<nav class=linksbar>";
echo "<a href='/tech' class='linkbar linktitle'>Tech</a>";
echo "<a href='/games' class='linkbar linktitle'>Games</a>";
echo "<a href='/code' class='linkbar linktitle'>Code</a>";
echo "<a href='/about' class='linkbar linktitle'>About</a>";
echo "</nav></header>
<div id='page'>";//Start body content


function myEnd(){
global $e_login;
echo "</div>
<footer>";//start footer

if(!isUser()){
	echo "<form id='userForm' class='_pannel' method='POST'"; 
	if(isset($e_login)){
		echo "style='border: red 1px solid;background: rgba(250,0,0,0.5);'";
	}
	echo ">
<input type='text' name='username' placeholder='Username'>
<input type='password' name='password' placeholder='Password'>
<input type='submit' value='>'>";
}else{
	echo "<form id='userForm' class='_pannel' method='POST'>
<input name='logout' hidden>
<input id='logoutbtn' type='submit' value='Logout'>";
}
echo "</form></footer>";
echo "</body>";
}
register_shutdown_function('myEnd');
?>