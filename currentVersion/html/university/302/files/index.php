<?php
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	page();
	lib_media();
	lib_group();
	
	//Start Content
	group_selected();
	$uploadTxt = '';
	//media_form();
	$cardcont .= "<form method='post' enctype='multipart/form-data'>";
	if($_POST['do'] == 'Delete'){//Delete files
		div(media_delete());
	}
	if($_POST['do'] == 'Upload'){
		div(media_upload());
	}
	//$cardcont .= "Select file to upload:";
	$cardcont .= "<input type='file' class='button' name='fileToUpload' id='fileToUpload'>";
	if($filename != ""){
		$cardcont .= "<label for='filename'>File will be uploaded as: $filename</label>";
		$cardcont .= "<input type='text' hidden name='filename' id='filename' value='$filename'>";
		$cardcont .= "<input type='checkbox' hidden id='fileoveride' name='fileoveride' value='1'>";
	}else{
		$cardcont .= "<label for='fileoveride'>Overide Existing File?</label>";
		$cardcont .= "<input type='checkbox' id='fileoveride' name='fileoveride' value='1'>";
	}
	$cardcont .= "<label for='share'>Sharing?</label>";
	$cardcont .= "<select id='share' name='share'>";
	$cardcont .= "<option value='0'>Private</option>";
	$cardcont .= "<option value='3' selected>Public</option>";
	$cardcont .= "</select>";
	if(getUserLevel('access') != 3 && $where != ""){
		$cardcont .= "<input type='text' hidden name='location' value='$where'>";
	}
	$cardcont .= "<input type='submit' class='button button1' value='Upload' name='do'>";
	$cardcont .= "</form>";
	
	card("File Uploader",$cardcont,"calc(100% - 60px)");
//	echo "<hr>";

	//Display File list
	$result = multiSQL("Select media_id, location, share, a.FirstName from D_Media m join D_Accounts a on m.`owner` = a.UserId where people = $_SESSION[group]");
	//echo "<table><tr><th>File Name:</th><th>Size</th><th>Owner</th><th>Sharing Status:</th><th>Controls:</th></tr>";
	while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
		echo "<div class='card file'>";
		echo "<h3><a href='//$_SERVER[HTTP_HOST]/files/view?$row[media_id]' target='_blank'>".basename($row['location'])."</a></h3><hr>";
		echo size_byte(filesize($home.$row['location']))." ";
		switch($row['share']){
			case 0:
				echo "Group Only";
				break;
			case 1:
				echo "Specific People";
				break;
			case 2:
				echo "Friends";
				break;
			case 3:
				echo "Public Link";
				break;
		}
		echo "<br>By $row[FirstName]";
		echo "<br><a href='//$_SERVER[HTTP_HOST]/files/view?$row[media_id]&download' class='button button1' target='_blank'>Download</a>";
		echo "<form method='POST'><input type='text' name='file' value='$row[media_id]' hidden><input type='submit' class='button button2' value='Delete' name='do'></form>";
		echo "</div>";
	}
?>