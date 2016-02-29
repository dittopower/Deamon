<?php //Start Page
	require_once "/home3/deamon/public_html/lib.php";
	lib_perms();
	lib_files();

	
	
echo "<html><head>";
echo "<title>Deamon.(".dir_Name().")</title>";
echo "<link rel='manifest' href='/manifest.json'>";
echo "<link href='//deamon.info/delta.css' rel='stylesheet' type='text/css'/>";

if (file_exists($home."../media/$_SESSION[person]/custom.css")){
	echo '<link href="//deamon.info/files/view?name=custom.css" rel="stylesheet" type="text/css"/>';
}
echo "<script src='http://code.jquery.com/jquery-2.2.0.min.js' type='text/javascript'></script>";

echo "</head>";



//Start body
echo "<body><header>";
//title
echo "<a href='//deamon.info' class='headbar'><h1 style='display:inline;'>Deamon.(".dir_Name().")</h1></a>";
//Navbar
echo "<nav class=linksbar>";
echo "<a onclick=\"menu('tech')\" class='linkbar linktitle'>Tech</a>";
echo "<a onclick=\"menu('games')\"  class='linkbar linktitle'>Games</a>";
echo "<a onclick=\"menu('code')\"  class='linkbar linktitle'>Code</a>";
echo "<a href='/about' class='linkbar linktitle'>About</a>";
if(!isUser()){
	echo "<a onclick=\"menu('me')\"  class='linkbar linktitle'>";
	echo "Users";
}else{
	echo "<a onclick=\"menu('me')\" class='linkbar linktitle logged'>";
	echo ucfirst($_SESSION['name']);
} echo "</a>";
echo "</nav>";

echo "<script>function menu (which){
	others = $('nav:not(.linksbar, #'+which+')').hide();
	$('nav#'+which).toggle();
}</script>";


global $menus;
$menus = load($home."menus.json");
$menus = json_decode($menus, true);

function make_submenu($which,$name){
	echo "<nav id='$which' hidden>";
	echo "<a class='pagelinks' href='/$which/'>$name</a>";
	global $menus;
	foreach ($menus[$which] as $result) {
			echo "<a class='pagelinks' href='$result[link]' $result[script]>$result[Name]</a>";
	}
	echo "</nav>";
}

make_submenu("games","Games");

make_submenu("code","Code");

make_submenu("tech","Tech");

make_submenu("me","Profile");

echo "</header>

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
	echo "<a href='//deamon.info/me/'><img src='//deamon.info/me/profile.png' class='prof'></a>";
	echo "<form id='userForm' class='_pannel' method='POST'>
<input name='logout' hidden>
<input id='logoutbtn' type='submit' value='Logout'>";
}
echo "</form></footer>";
echo "</body>";
}
register_shutdown_function('myEnd');
?>