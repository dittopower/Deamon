<?php //Start Page
	require_once "/var/www/html/lib.php";
	lib_perms();
		lib_files();
		
	echo "<!DOCTYPE html>";
	echo "<html lang='en'><head>";
	echo "<title>Deamon.(".dir_Name().")</title>";
	echo "<link rel='manifest' href='/manifest.json'>";
	echo "<link href='//deamon.info/delta.css' rel='stylesheet' type='text/css'/>";

	if (file_exists($home."../media/$_SESSION[person]/custom.css")){
			echo '<link href="//deamon.info/files/view?name=custom.css" rel="stylesheet" type="text/css"/>';
	}
	echo "<script src='https://code.jquery.com/jquery-2.2.4.min.js' type='text/javascript'></script>";

	//Need to setup a proper Service worker
	echo "<script async src='//deamon.info/service-worker.js' type='text/javascript'></script>";

	//Both fixes and bugs out mobile
	//echo "<meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=yes'/>";

	echo "<meta name='keywords' content='deamon tech technology games code programming'>";
	echo "<link rel='canonical' href='https://deamon.info'/>";
	echo "<meta name='description' content=\"Deamon's website about Technology, Games, Coding and whatever else\">";
	echo "<meta name='author' content='Damon'>";

	echo '<meta name="google-site-verification" content="jkrwO63jjXnERdddFIXEyfrTUKBHx6RVApO5fhczYq8" />';
	echo '<meta name="theme-color" content="#c80000" />';
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
				<input type='text' name='username' placeholder='Username' aria-label='Username Input'>
				<input type='password' name='password' placeholder='Password' aria-label='Password Input'>
				<input type='submit' value='>'>";
		}else{
	echo "<a href='//deamon.info/me/'><img src='//deamon.info/me/profile.png' class='prof' alt='profile'></a>";
	echo "<form id='userForm' class='_pannel' method='POST'>
		<input name='logout' hidden>
		<input id='logoutbtn' type='submit' value='Logout'>";
}
echo "</form></footer>";
echo "</body>";
}
register_shutdown_function('myEnd');
?>
