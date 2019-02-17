<?php
	require_once "lib.php";
	lib_database();
	lib_files();
	lib_code();
	
	if(isset($_GET['addusers'])){
		$file = "studentlistforteamworker.csv";
		if (file_exists($file)){
			$text = file_get_contents($file);
			//runSQL("TRUNCATE TABLE  D_Accounts;");
			$text = explode("\n", $text);
			$counter = 0;
			$fails = 0;
			foreach($text as $row){
				
				if($counter > 0){
				$values = explode(",",$row);
				$values[0] = intval($values[0]);
				$values[1] = escapeSQL($values[1]);
				$values[2] = escapeSQL($values[2]);
					$salt = salt();
					$pas= "student2015";
					$pass = encrypt($pas,$salt,$values[0]);
					$len = strlen($pas);
					if(!singleSQL("Select 1 from D_Accounts where UserId = '$values[0]';")){
					$sucess = runSQL("INSERT INTO D_Accounts(UserId, Username, FirstName, LastName, Email, PassPhrase, Length, salt) VALUES ('$values[0]', '$values[0]', '$values[1]', '$values[2]', '$values[0]@qut.edu.au', '$pass', '$len', '$salt')");
					if($sucess){
						note("users","Import:$counter :: Done!");
					}else{
						note("users","Import:$counter :: Failed! - $row");
						$fails++;
					}
					}
				}
				$counter++;
			}
			echo "$counter Done! There were $fails Failures.";
			//var_dump($text);
		}else{
			echo "File Not Found";
		}
	}
?>