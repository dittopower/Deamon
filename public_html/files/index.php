<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	
	//START content
	function media ($file){
		$type = preg_match("/\.[^\.]+$/",$file, $match);
		$match = $match[0];
		
		if(preg_match("/jpg|jpeg/", $match)){
			$type = "image/jpeg";
		}else if(preg_match("/png/", $match)){
			$type = "image/png";
		}else if(preg_match("/gif/", $match)){
			$type = "image/gif";
		}else if(preg_match("/tif|tiff/", $match)){
			$type = "image/tiff";
		}else if(preg_match("/bmp/", $match)){
			$type = "image/bmp";
		}else{
			echo "<META http-equiv='refresh' content='0;URL=/error.php?e=400'>";
		}
		
		header('Content-Type:'.$type);
		global $home;
		header('Content-Length: ' . filesize($home.$file));
		readfile($home.$file);
	}
	
	$mymedia = key($_GET);
	if(is_numeric($mymedia)){
		require $home."hidden/deamon.php";
		
		$row = rowSQL("Select * from D_Media where media_id = $mymedia");
		if($row != 0){
			switch($row['share']){
				case 1:
					if(preg_match( "/\|$_SESSION[person]\|/", $row["people"])){
						media($row['location']);
					}else{
						//echo "<META http-equiv='refresh' content='0;URL=/error.php?e=401'>";
						toss(401);
					}
					break;
				case 2:
					echo "Friend sharing not yet implemented.";
					break;
				case 3:
					media($row['location']);
					break;
				default:
					if($_SESSION['person'] == $row['owner']){
						media($row['location']);
					}else{
						//echo "<META http-equiv='refresh' content='0;URL=/error.php?e=401'>";
						toss(401);
					}
					break;
			}
		}else{
			//echo "<META http-equiv='refresh' content='0;URL=/error.php?e=404'>";
			toss(404);
		}
	}else{
		header('Location: '."./manager");
		die();
	}
	
?>