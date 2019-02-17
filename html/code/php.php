<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";
?>
So what does <button onclick="document.body.innerHTML='php';document.body.style.color = 'white';document.body.style.background = 'black';window.setInterval(function (){document.body.innerHTML=document.body.innerHTML.replace(/PHP/i,'PHP: Hypertext Preprocessor')},100)">php</button> stand for?