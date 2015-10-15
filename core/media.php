<?php
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	lib_code();
	lib_database();
	lib_login();
	lib_perms();
	lib_files();
	
	$custom = ["custom.css"=>"../media/$_SESSION[person]/custom.css"];
	
	//START content
	function media_send($file){
		global $home;
		$type = preg_match("/\.[^\.]+$/",$file, $match);
		$match = strtolower($match[0]);
		
		header('Content-Length: ' . filesize($home.$file));
		
		if(!isset($_GET['download'])){
			if(preg_match("/jpg|jpeg/", $match)){//images
				$type = "image/jpeg";
			}else if(preg_match("/png/", $match)){
				$type = "image/png";
			}else if(preg_match("/gif/", $match)){
				$type = "image/gif";
			}else if(preg_match("/tif|tiff/", $match)){
				$type = "image/tiff";
			}else if(preg_match("/webp/", $match)){
				$type = "image/webp";
			}else if(preg_match("/bmp/", $match)){
				$type = "image/bmp";
			}else if(preg_match("/pdf/", $match)){//pdf
				$type = "application/pdf";
			}else if(preg_match("/aac/", $match)){//audio
				$type = "audio/x-aac";
			}else if(preg_match("/dts/", $match)){
				$type = "audio/vnd.dts";
			}else if(preg_match("/dtshd/", $match)){
				$type = "audio/vnd.dts.hd";
			}else if(preg_match("/rip/", $match)){
				$type = "audio/vnd.rip";
			}else if(preg_match("/m3u/", $match)){
				$type = "audio/x-mpegurl";
			}else if(preg_match("/wma/", $match)){
				$type = "audio/x-ms-wma";
			}else if(preg_match("/wax/", $match)){
				$type = "audio/x-ms-wax";
			}else if(preg_match("/mid/", $match)){
				$type = "audio/midi";
			}else if(preg_match("/mpga/", $match)){
				$type = "audio/mpeg";
			}else if(preg_match("/mp3/", $match)){
				$type = "audio/mpeg";
			}else if(preg_match("/mp4a/", $match)){
				$type = "audio/mp4";
			}else if(preg_match("/oga|ogg/", $match)){
				$type = "audio/ogg";
			}else if(preg_match("/weba/", $match)){
				$type = "audio/webm";
			}else if(preg_match("/au/", $match)){
				$type = "audio/basic";
			}else if(preg_match("/wav/", $match)){
				$type = "audio/x-wav";
			}else if(preg_match("/txt|html|css|php/", $match)){
				$type = "text/plain";
			}else{
				$type = "application/octet-stream";
				header('Content-Disposition: attachment; filename='.basename($file));
			}
		}else{
			$type = "application/octet-stream";
			header('Content-Disposition: attachment; filename='.basename($file));
		}
		header('Content-Type:'.$type);
		
		readfile($home.$file);
	}
	
	function media_lookup($mymedia){
		$row = rowSQL("Select * from D_Media where media_id = $mymedia");
		if($row != 0){
			switch($row['share']){
				case 1:
					if(preg_match( "/\|$_SESSION[person]\|/", $row["people"])){
						media_send($row['location']);
					}else{
						toss(401);
					}
					break;
				case 2:
					echo "Friend sharing not yet implemented.";
					break;
				case 3:
					media_send($row['location']);
					break;
				default:
					if($_SESSION['person'] == $row['owner']){
						media_send($row['location']);
					}else{
						toss(401);
					}
					break;
			}
		}else{
			toss(404);
		}
	}
	
	function media_($mymedia){
		if(is_numeric($mymedia)){
			media_lookup($mymedia);
		}else{
			global $custom;
			debug($custom[$_GET['name']]);
			media_lookup(singleSQL("Select media_id from D_Media where location='".$custom[$_GET['name']]."'"));
		}
	}
	
	//file upload handler
	function media_upload(){
		global $home;
		if($_POST['do'] == 'Upload' && isset($_FILES['fileToUpload'])){
			$uploadTxt = "Sorry, there was an error uploading your file. ";
			global $uploadOk;
			$uploadOk = 1;
			if(strlen($_POST['location']) >= 1){
				$target_dir = $home.$_POST['location']."/";
			}else{
				$target_dir = $home."../media/".$_SESSION['person']."/";
			}
			if(dir_access("access",$target_dir)){
				dir_Ensure($target_dir);
				if(isset($_POST["filename"]) || $_POST["filename"] != ""){
					$_FILES["fileToUpload"]["name"] = $_POST["filename"];
				}
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$fileName = pathinfo($target_file, PATHINFO_FILENAME);

				// Check if file already exists
				$count = 0;
				while(file_exists($target_file)){
					if($_POST['fileoveride'] == 1){
						unlink($target_file);
					}else{
						$target_file = $target_dir . $fileName . "_$count.". $fileType;
						$count++;
					}
				}
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > (5*1024*1024)) {
					$uploadTxt .= "Sorry, your file is too large. ";
					note('upload',"Problem::filesize");
					$uploadOk = 0;
				}
				function isOk($what){
					global $uploadOk;
					if($what){
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
							imageAlphaBlending($image , true);
							imageSaveAlpha($image , true);
							isOk(imagegif($image,$target_file));
							break;
						case 'jpg':
						case 'jpeg':
							$image = imagecreatefromstring(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
							isOk(imagejpeg($image,$target_file,50));
							break;
						case 'webp':
							$image = imagecreatefromstring(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
							imageAlphaBlending($image , true);
							imageSaveAlpha($image , true);
							isOk(imagewebp($image,$target_file));
							break;
						case 'bmp':
							$image = imagecreatefromstring(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
							isOk(image2wbmp($image,$target_file,150));
							break;
						case 'png':
							$image = imagecreatefromstring(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
							imageAlphaBlending($image , true);
							imageSaveAlpha($image , true);
							isOk(imagepng($image,$target_file,9));
							break;
						default:
							isOk(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file));
					}
				}
				switch($_POST['share']){
					case 1:
						$share = 1;
						break;
					case 2:
						$share = 2;
						break;
					case 3:
						$share = 3;
						break;
					default:
						$share = 0;
						break;
				}
				//Log it in the database
				if($uploadOk){
					$target_file = substr($target_file, strlen($home));
					if($_POST['fileoveride'] == 1){
						$id = singleSQL("Select media_id from D_Media where location = '$target_file'");
						note('upload',"Replaced::".basename( $_FILES["fileToUpload"]["name"]));
					}else{
						$sql = "INSERT INTO `deamon_core`.`D_Media` (`location`, `owner`, `share`, `people`) VALUES ('$target_file', '$_SESSION[person]', '$share', '');";
						runSQL($sql);
						$id = singleSQL("Select LAST_INSERT_ID();");
						note('upload',"Uploaded::".basename( $_FILES["fileToUpload"]["name"]));
					}
					$uploadTxt = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded to <a href='//$_SERVER[HTTP_HOST]/files/view?$id' target='_blank'>$_SERVER[HTTP_HOST]/files/view?$id</a>.<hr>";
				}else{
					note('upload',"Failed::".basename( $_FILES["fileToUpload"]["name"]));
				}
			}
		}
		return $uploadTxt;
	}
	
	function media_delete(){
		global $home;
		if($_POST['do'] == 'Delete' && is_numeric($_POST['file'])){
			$row = rowSQL("Select * from D_Media where media_id = $_POST[file]");
			if($row == 0){
				return "That file doesn't exist and so can't be deleted.";
			}else{
				if($row['owner'] == $_SESSION['person']){
					runSQL("DELETE FROM D_Media WHERE media_id=$_POST[file]");
					unlink($home.$row['location']);
					note('upload',"Deleted::media-$_POST[file]::".basename($row['location']));
					return "You deleted the file ".basename($row['location']).".";
				}else{
					note('upload',"ABUSE::media-$_POST[file]::Attempt to delete someone else's file");
					return "No, that's not your file. So you can't delete it.";
				}
			}
		}
	}
	
	function media_form($where="", $filename=""){
		echo "<form method='post' enctype='multipart/form-data'>";
			if($_POST['do'] == 'Upload'){
				div(media_upload());
			}
			echo "Select file to upload:";
			echo "<input type='file' name='fileToUpload' id='fileToUpload'>";
			if($filename != ""){
				echo "<label for='filename'>File will be uploaded as: $filename</label>";
				echo "<input type='text' hidden name='filename' id='filename' value='$filename'>";
				echo "<input type='checkbox' hidden id='fileoveride' name='fileoveride' value='1'>";
			}else{
				echo "<label for='fileoveride'>Overide Existing File?</label>";
				echo "<input type='checkbox' id='fileoveride' name='fileoveride' value='1'>";
			}
			echo "<label for='share'>Sharing?</label>";
			echo "<select id='share' name='share'>";
			echo "<option value='0'>Private</option>";
			echo "<option value='1'>Specific People (Coming soon)</option>";
			echo "<option value='2'>Friends (Coming Eventually)</option>";
			echo "<option value='3' selected>Public</option>";
			echo "</select>";
			if(getUserLevel('access') != 3 && $where != ""){
				echo "<input type='text' hidden name='location' value='$where'>";
			}
			echo "<input type='submit' value='Upload' name='do'>";
		echo "</form>";
	}
?>