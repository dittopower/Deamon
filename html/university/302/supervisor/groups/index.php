<?php

	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	supervisor();
	
	//display groups
	
	$supervisorNum = $_SESSION['SupervisorID'];
	
	echo "<h2>Your Groups (Supervisor #".$supervisorNum.")</h2>";
	
	$groups = arraySQL("SELECT g.* FROM Groups g join Projects p on g.GroupProject = p.P_Id WHERE p.Supervisor = '$supervisorNum'");//maybe it needs to go off of the projects supervisor not the groups
	
	$cardcontent = "";
	
	foreach($groups as $thing){
		$cardcontent .= "<table class='cardtable'>";	
		
		$cardcontent .= "<tr><th>GroupId</th>";
		$cardcontent .= "<th>GroupProject</th>";
		$cardcontent .= "<th>UnitCode</th>";
		$cardcontent .= "<th>Group Members</th>";
		$cardcontent .= "</tr>";
		
		$cardcontent .= "<tr>";
		
		$cardcontent .= "<td>" . $thing["GroupId"] . "</td>";
		
		$projectName = singleSQL("SELECT Name From Projects WHERE P_Id=" . $thing["GroupProject"]);
		
		$cardcontent .= "<td>" . $projectName . "</td>";
		$cardcontent .= "<td>" . $thing["UnitCode"] . "</td>";
		
		$cardcontent .= "<td><ul>";
		
		$groupmembers = arraySQL("SELECT CONCAT(`FirstName`,' ',`LastName`) as name, a.username as username FROM `D_Accounts` a JOIN `Group_Members` g WHERE g.`UserId` = a.`UserId` and `GroupId` = '".$thing["GroupId"]."'");;
		
		foreach($groupmembers as $item){
			$cardcontent .= "<li><a href='http://$_SERVER[HTTP_HOST]/supervisor/user/?u=".$item['username']."' target='_blank'>".$item['name']."</a></li>";
		}
		$cardcontent .= "</ul></td>";
		
		//$cardcontent .= "<td><input type='button' value='Generate Report' class='button button1'></td>";
		//$cardcontent .= "<td><input type='button' value='View' class='button button1' disabled></td>";
		
		$cardcontent .= "</tr>";
		$cardcontent .= "</table>";
		
		card("Group: " . $thing["GroupName"],$cardcontent,"calc(100% - 60px)");//bro
		$cardcontent = "";
	}
	
	
	
?>