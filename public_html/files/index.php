<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";
	require_once $home."../core/media.php";
//Start Content
if (isUser()){
	$uploadTxt = '';
if($_POST['do'] == 'Upload'){
	div(media_upload());
//Delete files
}else if($_POST['do'] == 'Delete'){
	div(media_delete());
}
	media_form();
?>

<hr>
<?php
//Display File list
	$result = multiSQL("Select media_id, location, share from D_Media where owner = $_SESSION[person]");
	echo "<table><tr><th>File Name:</th><th>Sharing Status:</th><th>Controls:</th></tr>";
	while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
		echo "<tr><td><a href='//$_SERVER[HTTP_HOST]/files/view?$row[media_id]' target='_blank'>".basename($row['location'])."</a></td><td>";
		switch($row['share']){
			case 0:
				echo "Just Me";
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
		echo "</td><td>tba:<form method='POST'><input type='text' name='file' value='$row[media_id]' hidden><input type='submit' value='Delete' name='do'></form></td></tr>";
	}
	echo "</table>";

}else{//end page
	echo "Login Required";
}
?>