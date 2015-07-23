

//http://php.net/manual/en/function.imagepng.php

<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<?php
$target_dir = "./";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
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

// Allow certain file formats
if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
&& $fileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if file already exists
$count = 0;
while(file_exists($target_file)) {
	$target_file = $target_dir . $fileName . "_$count.". $fileType;
	$count++;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	$type = preg_match("/\.[^\.]+$/",$target_file, $match);
	$match = $match[0];
	if(preg_match("/jpg|jpeg|png|gif|tif|tiff|bmp/", $match)){
		$image = imagecreatefromstring($_FILES["fileToUpload"]["tmp_name"]);
		imagepng($image,$target_file,9);
	}else{
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
?>