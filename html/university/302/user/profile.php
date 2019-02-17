<?php
	
	lib_code();
	
	global $mysqli;

	//Get data

	if(isset($_GET['u'])){
		$sql= mysqli_prepare($mysqli, "SELECT GPA,Skills,Blurb,LinkedIn,User_Details.Email,D_Accounts.Email as Qemail,Facebook,Skype,Phone,FirstName,LastName,Username FROM `deamon_INB302`.`User_Details` INNER JOIN D_Accounts ON D_Accounts.UserId=User_Details.UserId WHERE Username = ?");
		mysqli_stmt_bind_param($sql,"s",$_GET['u']);
	}else if(! isset($_SESSION['SupervisorID'])){
		$sql= mysqli_prepare($mysqli, "SELECT GPA,Skills,Blurb,LinkedIn,User_Details.Email,D_Accounts.Email as Qemail,Facebook,Skype,Phone,FirstName,LastName,Username FROM `deamon_INB302`.`User_Details` INNER JOIN D_Accounts ON D_Accounts.UserId=User_Details.UserId WHERE User_Details.UserId = ?");
		mysqli_stmt_bind_param($sql,"s",$_SESSION['person']);
	}
	
	if(isset($_GET['u']) || (! isset($_SESSION['SupervisorID']))){
	
		mysqli_stmt_execute($sql);
		mysqli_stmt_bind_result($sql,$GPA,$Skills,$Blurb,$LinkedIn,$Email,$Qemail,$Facebook,$Skype,$Phone,$FirstName,$LastName,$Username);
		$result = $sql->store_result();
		
		//Display data
		$cardcontent .= "";
		while (mysqli_stmt_fetch($sql)) {
			
			if(!isset($_GET['u'])){
				echo "<a href='./edit' class='button button1' style='text-decoration: none;float:right;'>Edit profile</a>";
			}
			echo "<h1>Profile: $FirstName $LastName</h1>";
			echo "<h2>ID: $Username</h2>";
			
			$cardcontent .=  "<b>QUT Email:</b> <a href='mailto:$Qemail'>$Qemail</a>";
			$cardcontent .=  "<br><b>Contact Email:</b> <a href='mailto:$Email'>$Email</a>";
			$cardcontent .=  "<br /><b>Phone:</b> <a href='tel:$Phone'>$Phone</a>";
			$cardcontent .=  "<br /><b>Skype:</b> <a href='skype:$Skype?chat'>$Skype</a>";
			$cardcontent .=  "<br /><b>LinkedIn:</b> <a href='https://www.linkedin.com/profile/view?id=$LinkedIn' target='_blank'>LinkedIn Profile</a>";
			$cardcontent .=  "<br /><b>Facebook:</b> <a href='https://www.facebook.com/$Facebook' target='_blank'>$Facebook</a>";
			card("Contact", $cardcontent);
			
			$cardcontent = "<b>GPA:</b> ".$GPA;
			$cardcontent .= "<br><b>Skills:</b> <ul>";
			$myskills = explode(", ",$Skills);
			foreach($myskills as $item){
				$cardcontent .=   "<li>".$item."</li>";
			}
			$cardcontent .=   "</ul>";
			card("About Me", $cardcontent, 250);
			card("Blurb", $Blurb);
		}

		mysqli_stmt_close($sql);
	
	}
	
?>