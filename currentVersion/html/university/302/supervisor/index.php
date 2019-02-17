<?php

	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	supervisor();
	
	$projectid = $_POST['projectID']; //**** EVERYONEE GETTT IINN HEEERRREEE ****//
	
	if(isset($_POST['deleteproject'])){
		
		$d1 = runSQL("DELETE FROM Project_Applications WHERE P_Id=" . $projectid);
		
		$d2 = runSQL("UPDATE Groups SET GroupProject=0 WHERE GroupProject=" . $projectid);
		
		$d3 = runSQL("DELETE FROM Projects WHERE P_Id=" . $projectid);
		
		//set the groups with the project to project 0
		
		if($d1 && $d2 && $d3){
			echo "<span class='sucess'>Project #" . $projectid . " has been deleted.</span>";
		}else{ echo "<span class='error'>Project #" . $projectid . " failed to be deleted.</span>"; }

		echo "<div class='clear'></div><br>";
		
	} else if(isset($_POST['createproject']) && $_POST['title'] != null && $_POST['description'] != null && $_POST['requirements'] != null && $_POST['type1'] != null && $_POST['type2'] != null && $_POST['type3'] != null && $_POST['skills'] != null && $_POST['unit'] != null && $_POST['start'] != null && $_POST['end'] != null && $_POST['dueby'] != null){
		$title = $_POST['title'];
		$description = $_POST['description'];
		$requirements = $_POST['requirements'];
		$type1 = $_POST['type1'];
		$type2 = $_POST['type2'];
		$type3 = $_POST['type3'];
		$skills = $_POST['skills'];
		$unit = $_POST['unit'];
		$start = $_POST['start'];
		$end = $_POST['end'];
		$dueby = $_POST['dueby'];
		
		$res = runSQL("INSERT INTO Projects (Name, ProjectType1, ProjectType2, ProjectType3, Description, skill, requirements, UnitCode, Start, End, Dueby, Supervisor) VALUES('".$title."', '".$type1."', '".$type2."', '".$type3."', '".$description."', '".$skills."', '".$requirements."', '".$unit."', '".$start."', '".$end."', '".$dueby."', '" . $_SESSION['SupervisorID'] . "')");
			
		if($res){
			echo "<span class='sucess'>Project Created.</span>";
		}else{
			echo "<span class='error'>Something went wrong. Project not created.</span>";
		}
		
		echo "<div class='clear'></div><br>";
		
	} else if(isset($_POST["appAction"])){//accept or deny applications
		
		/*echo "<h2>Application decision</h2>";
		echo $_POST["appAction"] . "<br><br>" . $_POST["appid"];*/
		
		$type = $_POST["appAction"];
		
		if($type=="Accept"){
			$type = "SupervisorAccepted";
		}
		else if($type=="Decline"){
			$type = "SupervisorDeclined";
		}
		
		$appid = $_POST["appid"];//id of the project application
		
		$val = rowSQL("SELECT GroupId, P_Id FROM Project_Applications WHERE ApplicationID=" . $appid);
		
		$gid = $val["GroupId"];//group id
		$pid = $val["P_Id"];//project id
				
		$q1 = runSQL("UPDATE Project_Applications SET Status='".$type."' WHERE ApplicationID=" . $appid);
		
		if(!$g1){ echo "<span class='sucess'>Application #".$appid." set to \"".$type."\"</span>"; }
		else{ echo "<span class='error'>Something went wrong.</span>"; }
		
		$oldproject = singleSQL("SELECT GroupProject FROM Groups WHERE GroupId=".$gid);
		if($oldproject == $pid){//if this was their project previously
			$q2 = runSQL("UPDATE Groups SET GroupProject='0' WHERE GroupId=".$gid);
			if(!$g2){ echo "<span class='sucess'>Reverted to no project.</span>"; }
			else{ echo "<span class='error'>Something went wrong.</span>"; }
		}
		
		echo "<div class='clear'></div><br>";
		
	}
	
	if(isset($_POST["viewapplication"])){
		
		$appid = $_POST["viewapplication"];
		
		echo "<span class='nospace'>";
		
		echo "<h2>Application #".$appid."</h2>";
		
		$appRows = rowSQL("SELECT * FROM Project_Applications WHERE ApplicationID=".$appid);
		
		$infocontent = "<h4>Group:</h4> " . singleSQL("SELECT GroupName FROM Groups WHERE GroupId=" . $appRows["GroupId"]);
		$infocontent .= "<br><h4>Project #".  $appRows["P_Id"] .":</h4> " . singleSQL("SELECT Name FROM Projects WHERE P_Id=" . $appRows["P_Id"]);
		
		$infocontent .= "<br><br><h4>Status:</h4> " . $appRows["Status"];
		$infocontent .= "<br><h4>Time Submitted:</h4> " . date('j/n/y g:ia', strtotime($appRows["TimeSubmitted"]));
		card2("Information",$infocontent);	
		
		
		/* members listing */
		$groupMembers = arraySQL("SELECT CONCAT(`FirstName`,' ',`LastName`) AS name, a.Username AS username FROM `D_Accounts` a JOIN `Group_Members` g WHERE g.`UserId` = a.`UserId` and `GroupId`=".$appRows["GroupId"]);
	
		$gmember = "";
		$gmember .= "<ul>";
			foreach($groupMembers as $person){
				$gmember .= "<li><a href='http://$_SERVER[HTTP_HOST]/supervisor/user/?u=".$person['username']."' target='_blank'>".$person['name']."</a></li>";
			}
		$gmember .= "</ul>";
		card2("Group Members",$gmember);

		/* Skills listing */		
		$groupSkills = arraySQL("SELECT Skills FROM User_Details u LEFT JOIN Group_Members g ON g.UserId=u.UserId WHERE g.GroupId=".$appRows["GroupId"]);
		$allskills = "";
		
		foreach($groupSkills as $skillset){
			$allskills .= $skillset["Skills"] . ",";
		}
		
		$skillArray = array_unique(explode(',', $allskills));
		$referenceArray=array();
		
		$skillist = "";
		$skillist .= "<ul class='skills'>";
		
		foreach($skillArray as $sk){
			
			if(!in_array(strtolower(trim($sk)), $referenceArray)) {
				array_push($referenceArray, strtolower(trim($sk)));
				
				if(!trim($sk) == ""){				
					$skillist .= "<li>" . trim($sk) . "</li>";
				}
			}
		}
		$skillist .= "</ul><br>";
		card2("Team Skills",$skillist,"500px");
		
		card2("Cover Letter",$appRows["CoverLetter"]);		
		
		$actionscontent = "";
		if($appRows["Status"] == "StudentAccepted" || $appRows["Status"] == "StudentDeclined"){
			$actionscontent .= "No actions available, application already processed.";
		}else{
			$actionscontent .= "<form action='' method='post' class='inline'><input type='hidden' name='appid' value='".$appid."'><input name='appAction' type='submit' value='Accept' class='button button3 inline mar'></form>";
			$actionscontent .= "<form action='' method='post' class='inline'><input type='hidden' name='appid' value='".$appid."'><input name='appAction' type='submit' value='Decline' class='button button2 inline mar'></form>";
		}
		
		echo "<div class='clear'></div>";
		
		card2("Actions",$actionscontent);
		
		echo "</span>";//to close the .nospace
		
	}
	else{
			
		$supervisorNum = $_SESSION['SupervisorID'];
		
		echo "<h2 class='searchtitle'>Your Projects (Supervisor #".$supervisorNum.")";
		
		if(isset($_GET['search']) && $_GET['search'] != "") echo " - Search results for: \"" . $_GET["search"] . "\"";
		
		?>
		
		</h2>
		
		<div class="searchbox">
			<form method="get">
				<input type="text" name="search" placeholder="Search" value="<?php if(isset($_GET["search"])) echo $_GET["search"]; ?>">
				<input type="submit" class="button button4" value="Search">
			</form>
		</div>
		
		<div class="clear"></div>
			
	<?php

		$sql = "SELECT *, DATE_FORMAT(`Start`,'%d/%c/%Y') as Start, DATE_FORMAT(`End`,'%d/%c/%Y') as End FROM Projects WHERE Supervisor=".$supervisorNum." AND P_Id <> 0";
		
		if(isset($_GET['search']) && $_GET['search'] != ""){
			$si = $_GET['search'];
			$sql .= " AND (P_Id LIKE '%" . $si . "%'";
			$sql .= " OR Name LIKE '%" . $si . "%'";
			$sql .= " OR ProjectType1 LIKE '%" . $si . "%'";
			$sql .= " OR ProjectType2 LIKE '%" . $si . "%'";
			$sql .= " OR ProjectType3 LIKE '%" . $si . "%'";
			$sql .= " OR Description LIKE '%" . $si . "%'";
			$sql .= " OR skill LIKE '%" . $si . "%'";
			$sql .= " OR requirements LIKE '%" . $si . "%'";
			$sql .= " OR UnitCode LIKE '%" . $si . "%')";
		}// SEARCHING STUFF (EVERYTHING)
		
		$sql .= " ORDER BY P_Id ASC";
		
		$projects = arraySQL($sql);
		
		//echo $sql;
		
		$cardcontent="";
		
		foreach($projects as $thing){
				
			$cardcontent .= "<span class='pinfo'><h4>Description</h4>" . $thing["Description"];
			$cardcontent .= "<form action='http://$_SERVER[HTTP_HOST]/supervisor/project/' method='post'>
			<input type='hidden' name='projectID' value='".$thing["P_Id"]."'>
			<input type='submit' name='editproject' value='Edit Project' class='button button1'>
			</form></span><br>";
			
			$cardcontent .= "<span class='pinfo'><h4>Requirements</h4>" . $thing["requirements"] . "</span><br>";
			$cardcontent .= "<span class='pinfo'><h4>Project Type</h4><ul><li>" . $thing["ProjectType1"] ."</li><li>". $thing["ProjectType2"] ."</li><li>". $thing["ProjectType3"] . "</li></ul></span>";
			
			$skills=explode(",",$thing["skill"]);
			
			$cardcontent .= "<span class='pinfo'><h4>Skills</h4><ul>";
				foreach($skills as $skill){
					$cardcontent .= "<li>" . $skill . "</li>";
				}
			$cardcontent .= "</ul></span>";
			
			$cardcontent .= "<span class='pinfo'><h4>Unit</h4>" . $thing["UnitCode"] . "</span>";
			
			$cardcontent .= "<span class='pinfo'><h4>Dates</h4>Start: " . $thing["Start"] . "<br>End: " . $thing["End"] . "</span>";
			
			$cardcontent .= "<hr><div class='pinfobottom'><h4>Applications</h4><br>";			
			$apps = arraySQL("SELECT * FROM Project_Applications WHERE P_Id=" . $thing["P_Id"]);
			foreach($apps as $single){
				
				$cardcontent .= "<span class='preText'>" . date('j/n/y g:ia', strtotime($single["TimeSubmitted"])) . "</span><br>";
				$cardcontent .= "#" . $single["ApplicationID"] . "</a> - <strong>\"" . substr($single["CoverLetter"], 0, 75) . "...\"</strong><br>";
				
				
				$cardcontent .= "<form action='' method='post'><input type='hidden' name='viewapplication' value='".$single["ApplicationID"]."'>";
					
					if($single["Status"]!="Applied"){//shows the supervisor their previous decisions
						$cardcontent .= "<input type='submit' value='(".$single["Status"].") View Application'";
						
						if($single["Status"]=="SupervisorAccepted"){ $cardcontent .= " class='button button1'>"; }
						else if($single["Status"]=="SupervisorDeclined"){ $cardcontent .= " class='button button2'>"; }
						else if($single["Status"]=="StudentDeclined"){ $cardcontent .= " class='button button5'>"; }
						else if($single["Status"]=="StudentAccepted"){ $cardcontent .= " class='button button3'>"; }
						else{ $cardcontent .= " class='button button1'>"; }
					}else{
						$cardcontent .= "<input type='submit' value='View Application' class='button button1'>";
					}
					
					$cardcontent .= "</form><br>";
				$cardcontent .= "";//fix the floating things (clear)
				
			}			
			$cardcontent .= "</div>";
			
			card2($thing["Name"],$cardcontent,"calc(100% - 60px)");//bro
			
			echo "<div class='clear'></div><br>";
			
			$cardcontent="";
			
		}
		
	}
	
?>
