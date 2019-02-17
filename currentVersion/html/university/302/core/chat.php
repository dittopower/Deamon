<?php

	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	lib_login();
	lib_group();
	lib_files();
	
	if(isset($_SESSION['person'])){
			
		$user = $_SESSION['person'];
		
		$person = $_POST['person'];
		$group = $_POST['group'];
		if(is_numeric($_POST['last'])){
			$last = $_POST['last'];
		}else{
			$last = 0;
		}
			
		$send = $_POST['send'];
		runSQL("SET time_zone = 'Australia/Brisbane';");
		
		if(isset($_POST['person']) && isset($_POST['message']) && isset($_POST['group'])){
			
			$message = escapeSQL(strip_tags($_POST['message']));
			echo runSQL("INSERT INTO Chat (UserID, UserReceive, GroupID, Message, TimeSent) VALUES(".$user.", ".$person.", ".$group.", '". $message . "', NOW())");
			
		}//send message
		else if(isset($_POST['person'])){
				
			$thesql="SELECT Chat.ChatID, Chat.UserID, D_Accounts.FirstName, Chat.Message, Chat.TimeSent";
			$thesql.=" FROM Chat LEFT JOIN D_Accounts ON Chat.UserID=D_Accounts.UserId";
			$thesql.=" WHERE Chat.UserID IN ('$user','$person') AND Chat.UserReceive IN ('$user','$person') and ChatID > '$last' order by TimeSent;";
			
			//note("chatdebug",$thesql);
			$aa = arraySQL($thesql);
			echo json_encode($aa);
			
		}//retrieve person message
		else if (isset($_POST['group'])){
			
			$timelim = "NOW()";
			
			$thesql="SELECT Chat.ChatID, Chat.UserID, D_Accounts.FirstName, D_Accounts.LastName, Chat.Message, Chat.TimeSent, Chat.UserReceive";
			$thesql.=" FROM Chat LEFT JOIN D_Accounts ON Chat.UserID=D_Accounts.UserId";
			$thesql.=" WHERE Chat.GroupID='" .$group. "'  and ChatID > '$last' order by TimeSent;";
			
			$result = arraySQL($thesql);
			
			sort($result);
			
			echo json_encode($result);
			
		}//retrieve group messages

	}
	
	/*********************
	Chat Database Layout
	**********************
	
	ChatID
	int(11)
	
	UserID
	int(11)
	
	UserReceive (-1 if no person)
	int(11)
	
	GroupID (-1 if no group)
	int(11)
	
	Message
	text(1024)
	
	TimeSent
	timestamp()
	
	CREATE TABLE Chat(
		ChatID int(11),
		UserID int(11),
		UserReceive int(11),
		GroupID int(11),
		Message text(1024),
		TimeSent timestamp
	)
	
	*/
	
?>