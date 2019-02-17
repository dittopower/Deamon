<?php 
//	$home = preg_replace("/(^.*html\/).*/","$1",$_SERVER['DOCUMENT_ROOT'])."/";
	$local = $_SERVER['DOCUMENT_ROOT']."/";
	$home = $local;

//Core Libraries
	function lib_code(){
		global $home;
		require_once $home."core/code.php";
	}

	function lib_database(){
		global $home;
		require_once $home."core/database.php";
	}

	function lib_login(){
		global $home;
		require_once $home."core/login.php";
	}

	function lib_files(){
		global $home;
		require_once $home."core/files.php";
	}

	function lib_media(){
		global $home;
		require_once $home."core/media.php";
	}

	function lib_feed(){
		global $home;
		require_once $home."core/feed.php";
	}

	function lib_perms(){
		global $home;
		require_once $home."core/perms.php";
	}

	function lib_frame(){
		global $home;
		require_once $home."core/start.php";
	}
	
	function lib_register(){
		global $home;
		require_once $home."core/register.php";
	}
	
	function lib_group(){
		global $home;
		require_once $home."core/group.php";
	}
	
	function lib_chat(){
		global $home;
		require_once $home."core/chat.php";
	}

//Local Templates	
	function page(){
		global $local;
		require_once $local."page.php";
	}

	function supervisor(){
		global $local;
		require_once $local."supervisor.php";
	}
?>