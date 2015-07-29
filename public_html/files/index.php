<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";
	require_once $home."../core/files.php";
//Start Content
if (isUser()){
?>

<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="do">
</form>

<?php
if($_POST['do'] == 'Upload'){
	
	$target_dir = $home."../media/".$_SESSION['person']."/";
	dir_Ensure($target_dir);
	
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$fileName = pathinfo($target_file, PATHINFO_FILENAME);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}

	// Check if file already exists
	$count = 0;
	while(file_exists($target_file)) {
		$target_file = $target_dir . $fileName . "_$count.". $fileType;
		$count++;
	}

	// Check file size
	if ($_FILES["fileToUpload"]["size"] > (5*1024*1024)) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}

	function isOk($what){
		global $uploadOk;
		if($what) {
			$uploadOk = 1;
		} else {
			$uploadOk = 0;
		}
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	}else{
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
		echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded to <a href='//$_SERVER[HTTP_HOST]/files/view?$id' target='_blank'>$_SERVER[HTTP_HOST]/files?$id</a>.";
	}else{
		echo "Sorry, there was an error uploading your file.";
	}
}

}else{
	echo "Login Required";
}
?>