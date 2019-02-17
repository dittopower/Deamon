<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";
	require_once $home."../core/media.php";

enforce_user();
echo "<h1>Custom CSS</h1>";
echo "<p>Wanna customise your experience? Then upload your own css.</p>";
media_form("", "custom.css");
if(file_exists($home.$custom['custom.css'])){
echo "<p>Edit your CSS: <a href='//deamon.info/edit?url=".$custom['custom.css']."'>custom.css</a> </p>";
}
?>