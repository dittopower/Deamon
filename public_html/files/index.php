<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";
	require_once $home."../core/files.php";
//Start Content
if (isUser()){
	$uploadTxt = '';
if($_POST['do'] == 'Upload'){
	
	$target_dir = $home."../media/".$_SESSION['person']."/";
	dir_Ensure($target_dir);
	
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$uploadTxt = "Sorry, there was an error uploading your file. ";
	$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$fileName = pathinfo($target_file, PATHINFO_FILENAME);

	// Check if file already exists
	$count = 0;
	while(file_exists($target_file)) {
		$target_file = $target_dir . $fileName . "_$count.". $fileType;
		$count++;
	}

	// Check file size
	if ($_FILES["fileToUpload"]["size"] > (5*1024*1024)) {
		$uploadTxt .= "Sorry, your file is too large. ";
		note('upload',"Problem::filesize");
		$uploadOk = 0;
	}

	function isOk($what){
		global $uploadOk;
		if($what) {
			$uploadOk = 1;
		} else {
			$uploadOk = 0;
			note('upload',"Problem::storefile");
			$uploadTxt .= "There was an Error Storing your file. ";
		}
	}

	// Check if $uploadOk isnt set to 1 by an error
	if ($uploadOk == 1) {
		$uploadOk = 0;
		$match = $match[0];
		switch($fileType){
			case 'gif':
				$image = imagecreatefromstring(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
				isOk(imagegif($image,$target_file));
				break;
			case 'jpg':
			case 'jpeg':
				$image = imagecreatefromstring(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
				isOk(imagejpeg($image,$target_file,50));
				break;
			case 'webp':
				$image = imagecreatefromstring(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
				isOk(imagewebp($image,$target_file));
				break;
			case 'bmp':
				$image = imagecreatefromstring(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
				isOk(image2wbmp($image,$target_file,150));
				break;
			case 'tiff':
			case 'tif':
			case 'png':
				$image = imagecreatefromstring(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
				isOk(imagepng($image,$target_file,9));
				break;
			default:
				isOk(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file));
		}
	}
	
	//Log it in the database
	if($uploadOk){
		$target_file = substr($target_file, strlen($home));
		$sql = "INSERT INTO `deamon_core`.`D_Media` (`location`, `owner`, `share`, `people`) VALUES ('$target_file', '$_SESSION[person]', '3', '');";
		runSQL($sql);
		$id = singleSQL("Select LAST_INSERT_ID();");
	}
	
	
	if ($uploadOk){
		$uploadTxt = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded to <a href='//$_SERVER[HTTP_HOST]/files/view?$id' target='_blank'>$_SERVER[HTTP_HOST]/files?$id</a>.<hr>";
		note('upload',"Uploaded::".basename( $_FILES["fileToUpload"]["name"]));
	}else{
		note('upload',"Failed::".basename( $_FILES["fileToUpload"]["name"]));
	}//note when new css green highlight uploaded file instead?
	
//Delete files
}else if($_POST['do'] == 'Delete' && is_numeric($_POST['file'])){
	$row = rowSQL("Select * from D_Media where media_id = $_POST[file]");
	if($row['owner'] == $_SESSION['person']){
		runSQL("DELETE FROM D_Media WHERE media_id=$_POST[file]");
		unlink($home.$row['location']);
		note('upload',"Deleted::media-$_POST[file]::".basename($row['location']));
		$uploadTxt = "You deleted the file ".basename($row['location']).".";
	}else{
		note('upload',"ABUSE::media-$_POST[file]::Attempt to delete someone else's file");
		$uploadTxt = "No, that's not your file. So you can't delete it.";
	}
}
//Upload form
	echo "<div class='uploadstatus'>$uploadTxt</div>";
?>
<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="do">
</form>
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