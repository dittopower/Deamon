<?php
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	page();
	lib_login();
	lib_group();
	lib_feed();
	
	//User leaving group
	if(isset($_POST['quit'])){
		post("#$_SESSION[group]|@$_SESSION[group]","Member Quit","<span class='error'>$_SESSION[name] quit Group $_SESSION[group]: $_SESSION[gname]</span>");
		remove_member();
		group();
	}
	
	//Require user to be in a group
	group_selected();
	$allowed = canUser(singleSQL("SELECT UnitCode FROM Groups where GroupId = '$_SESSION[group]'"));
	
	
	debug($_POST);
	function vote_remove($who){
		$sql = "SELECT count(*) as value FROM Group_Members where GroupId = '$_SESSION[group]'";
		$sql .= " UNION ALL SELECT count(*) from Group_Mod where Group_Id = '$_SESSION[group]' and who = '$who' and ACTION = 'REMOVE'";
		$sql .= " UNION ALL SELECT count(*) from Group_Mod where Group_Id = '$_SESSION[group]' and who = '$who'";
		$res = arraySQL($sql);
		debug($sql);
		debug($res);
		if($res[0]['value']-1 == $res[2]['value']){
			debug("right number");
			if($res[1]['value'] == $res[2]['value']){
				debug("remove");
				remove_member($_SESSION['group'],$who);
				runSQL("Delete from Group_Mod where Group_Id = '$_SESSION[group]' and who = '$who'");
				note("member_vote","COMPLETE::$_SESSION[group]::removed::$who");
				echo "<span class='error'>Vote Success: Member Evicted</span>";
				post("#$_SESSION[group]|@$_SESSION[group]","Removal vote completion","<span class='error'>The group removed $who</span>");
			}else{
				debug("dont");
				note("member_vote","COMPLETE::$_SESSION[group]::Kept::$who");
				runSQL("Delete from Group_Mod where Group_Id = '$_SESSION[group]' and who = '$who'");
				post("#$_SESSION[group]|@$_SESSION[group]","Removal vote completion","<span class='error'>The group kept $who</span>");
				echo "<span class='sucess'>Vote Failed: Member Retained</span>";
			}
		}
	}
	
	function overide_remove($who){
		remove_member($_SESSION['group'],$who);
		runSQL("Delete from Group_Mod where Group_Id = '$_SESSION[group]' and who = '$who'");
		note("member_vote","Overide::$_SESSION[group]::removed::$who");
		echo "<span class='error'>Unit Staff: Evicted Member</span>";
		post("#$_SESSION[group]|@$_SESSION[group]","Member Evicted","<span class='error'>Unit Staff removed $who from the group.</span>");
	}
	function overide_keep($who){
		note("member_vote","Overide::$_SESSION[group]::Kept::$who");
		runSQL("Delete from Group_Mod where Group_Id = '$_SESSION[group]' and who = '$who'");
		post("#$_SESSION[group]|@$_SESSION[group]","Kicking Vote Cancelled","<span class='error'>Unit Staff cancelled the vote to kick $who from the group.</span>");
		echo "<span class='sucess'>Removal Cancelled: Member Retained</span>";
	}
	
	function vote_add($who){
		$sql = "SELECT count(*) as value FROM Group_Members where GroupId = '$_SESSION[group]'";
		$sql .= " UNION ALL SELECT count(*) from Group_Mod where Group_Id = '$_SESSION[group]' and who = '$who' and ACTION = 'ADD'";
		$sql .= " UNION ALL SELECT count(*) from Group_Mod where Group_Id = '$_SESSION[group]' and who = '$who'";
		$res = arraySQL($sql);
		debug($sql);
		debug($res);
		if($res[0]['value'] == $res[2]['value']){
			debug("right number");
			if($res[1]['value'] == $res[2]['value']){
				debug("add");
				add_member($_SESSION['group'],$who);
				runSQL("Delete from Group_Mod where Group_Id = '$_SESSION[group]' and who = '$who'");
				note("member_vote","COMPLETE::$_SESSION[group]::added::$who");
				echo "<span class='Sucess'>Vote Success: Member Added</span>";
				post("#$_SESSION[group]|@$_SESSION[group]","Add vote completion","<span class='sucess'>The group added $who</span>");
			}else{
				debug("dont");
				note("member_vote","COMPLETE::$_SESSION[group]::rejected::$who");
				runSQL("Delete from Group_Mod where Group_Id = '$_SESSION[group]' and who = '$who'");
				echo "<span class='error'>Vote Failed: Applicant Rejected</span>";
				post("#$_SESSION[group]|@$_SESSION[group]","Add vote completion","The group rejected $who");
			}
		}
	}
	
	function overide_accept($who){
		add_member($_SESSION['group'],$who);
		runSQL("Delete from Group_Mod where Group_Id = '$_SESSION[group]' and who = '$who'");
		note("member_vote","Overide::$_SESSION[group]::added::$who");
		echo "<span class='Sucess'>Unit Staff: Added Member</span>";
		post("#$_SESSION[group]|@$_SESSION[group]","Member Added","<span class='sucess'>Unit staff added $who to the group.</span>");
	}
	function overide_reject($who){
		note("member_vote","Overide::$_SESSION[group]::rejected::$who");
		runSQL("Delete from Group_Mod where Group_Id = '$_SESSION[group]' and who = '$who'");
		echo "<span class='error'>Staff Overide: New Member Rejected</span>";
		post("#$_SESSION[group]|@$_SESSION[group]","New Member Rejected","Unit Staff rejected $who joining the group.");
	}
	
	if(isset($_POST['vote']) && is_numeric($_POST['who']) && $_POST['who'] != $_SESSION['person']){
		switch($_POST['vote']){
			case 'Remove':
				if($allowed){
					overide_remove($_POST['who']);
				}else{
					if(runSQL("INSERT INTO `Group_Mod` (`User_Id`, `Group_Id`, `Action`, `Who`) VALUES ('$_SESSION[person]', '$_SESSION[group]', 'Remove', '$_POST[who]') ON DUPLICATE KEY UPDATE `Action` = 'Remove';")){
						note('member_vote',"DONE:: $_POST[vote] > $_POST[who] :: $_SESSION[person]");
						post("@$_SESSION[group]","Removal Vote","<span class='error'>Voted to remove $_POST[who]</span>");
						vote_remove($_POST['who']);
					}else{
						note('member_vote',"FAILED:: $_POST[vote] > $_POST[who] :: $_SESSION[person]");
					}
				}
				break;
			case 'Keep':
				if($allowed){
					overide_keep($_POST['who']);
				}else{
					if(runSQL("INSERT INTO `Group_Mod` (`User_Id`, `Group_Id`, `Action`, `Who`) VALUES ('$_SESSION[person]', '$_SESSION[group]', 'Cancel', '$_POST[who]') ON DUPLICATE KEY UPDATE `Action` = 'Cancel';")){
						note('member_vote',"DONE:: $_POST[vote] > $_POST[who] :: $_SESSION[person]");
						post("@$_SESSION[group]","Removal Vote","<span class='error'>Voted to Keep $_POST[who]</span>");
						vote_remove($_POST['who']);
					}else{
						note('member_vote',"FAILED:: $_POST[vote] > $_POST[who] :: $_SESSION[person]");
					}
				}
				break;
			case 'Add':
			case 'Accept':
				if($allowed){
					overide_accept($_POST['who']);
				}else{
					if(runSQL("INSERT INTO `Group_Mod` (`User_Id`, `Group_Id`, `Action`, `Who`) VALUES ('$_SESSION[person]', '$_SESSION[group]', 'Add', '$_POST[who]') ON DUPLICATE KEY UPDATE `Action` = 'Add';")){
						note('member_vote',"DONE:: $_POST[vote] > $_POST[who] :: $_SESSION[person]");
						post("@$_SESSION[group]","Add Vote","<span class='sucess'>Voted to add $_POST[who]</span>");
						vote_add($_POST['who']);
					}else{
						note('member_vote',"FAILED:: $_POST[vote] > $_POST[who] :: $_SESSION[person]");
					}
				}
				break;
			case 'Decline':
				if($allowed){
					overide_reject($_POST['who']);
				}else{
					if(runSQL("INSERT INTO `Group_Mod` (`User_Id`, `Group_Id`, `Action`, `Who`) VALUES ('$_SESSION[person]', '$_SESSION[group]', 'Deny', '$_POST[who]') ON DUPLICATE KEY UPDATE `Action` = 'Deny';")){
						note('member_vote',"DONE:: $_POST[vote] > $_POST[who] :: $_SESSION[person]");
						post("@$_SESSION[group]","Add Vote","<span class='sucess'>Voted to reject $_POST[who]</span>");
						vote_add($_POST['who']);
					}else{
						note('member_vote',"FAILED:: $_POST[vote] > $_POST[who] :: $_SESSION[person]");
					}
				}
				break;
			default:
				break;
		}
	}
	
	if(isset($_POST['gdetails'])){
		if(isset($_POST['gname']) && strlen($_POST['gname']) > 1){
			$namechange = runSQL("UPDATE `Groups` SET `GroupName` = '$_POST[gname]' WHERE `Groups`.`GroupId` = '$_SESSION[group]'");
			note("Groups","Name Change::$_POST[gname]");
			post("#$_SESSION[group]|@$_SESSION[group]","Name Change","The Groups name has been changed to '$_POST[gname]'");
		}
	}
	
	//title - group name and subject
	echo "<h1>Group: $_SESSION[gname]</h1><h4>Unit: ";
	echo singleSQL("SELECT CONCAT(u.UnitCode, ' ', u.Unit) FROM `Unit` u join Groups g on u.UnitCode = g.UnitCode where g.GroupId = '$_SESSION[group]'");
	echo "</h4>";
	
	
	/*
	* Group Members display
	*/
		$mymembers = arraySQL("SELECT `Username`, CONCAT(`FirstName`,' ',`LastName`) as Name, Skype FROM `D_Accounts` a join Group_Members m on m.`UserId` = a.`UserId` left join User_Details d on m.UserId = d.UserId WHERE m.GroupId = '$_SESSION[group]' and a.UserId != '$_SESSION[person]'");
		$cardcontent = "";
		$groupcall = [];
		foreach($mymembers as $item){
			$cardcontent .= "<a href='/user/?u=$item[Username]'>#$item[Username]: $item[Name]</a>";
			if($item['Skype'] != NULL && $item['Skype'] != ""){
				$cardcontent .= "<a class='skype skype_single' href='skype:$item[Skype]?chat'><img src='http://www.skypeassets.com/content/dam/skype/images/misc/Trademark/s-logo-solid.jpg'></a>";
				$groupcall[] = $item['Skype'];
			}
			$cardcontent .= "<br><br>";
		}
		$cardcontent .= "<hr><span><h3>Group Call</h3><br><center><a class='skype skype_group' href='skype:";
		$cardcontent .= implode($groupcall,";");
		$cardcontent .= "?chat&topic=$_SESSION[gname]'><img src='http://www.skypeassets.com/content/dam/skype/images/misc/Trademark/s-logo-solid.jpg'></a></center></span>";
	card("Group Members",$cardcontent);
		
		
	/*
	* Project Information
	*/
		$cardcontent = "";
		$thing = rowSQL("SELECT Name, ProjectType1, ProjectType2, ProjectType3, Description, skill, requirements, p.UnitCode, p.Supervisor, DATE_FORMAT(`Start`, '%a %d %b %Y') as start, DATE_FORMAT(`End`, '%a %d %b %Y') as end FROM Projects p join Groups on P_Id = GroupProject WHERE GroupId='$_SESSION[group]'");
		$cardcontent .= "<strong>Project Title:</strong> " . $thing["Name"];
		$cardcontent .= "<br><strong>Duration:</strong> ".$thing['start']." to ".$thing['end']."";
		$cardcontent .= "<br><strong>Description:</strong> " . $thing["Description"];
		$cardcontent .= "<br><strong>Requirements:</strong> " . $thing["requirements"];
		$cardcontent .= "<br>";
		$cardcontent .= "<br><strong>Type:</strong> " . $thing["ProjectType1"] .", ". $thing["ProjectType2"] .", ". $thing["ProjectType3"];
		$cardcontent .= "<br><strong>Skills required:</strong> " . $thing["skill"];
		$cardcontent .= "<br>";
		$cardcontent .= "<br><strong>For Unit:</strong> " . $thing["UnitCode"];
		
		$supervisorname = singleSQL("SELECT CONCAT(FirstName, ' ', Surname) as Name FROM Supervisor WHERE SupervisorID=".$thing["Supervisor"]);
		
		$cardcontent .= "<br><strong>With supervisor:</strong> " . $supervisorname;
	card("Your Project Details",$cardcontent, 500);
	
	if($allowed){
		feed("@$_SESSION[group]","Admin Feed");
	}
	
	feed("#$_SESSION[group]","$_SESSION[gname]'s Feed");


///Group Alteration stuff
	echo "<hr><br><h2>Group Management</h2>";
	
	if(isset($namechange)){
		if($namechange){
			echo "<div class=sucess>Group Name Updated.<meta http-equiv='refresh' content='0'></div>";
		}else{
			echo "<div class=error>Group Name Change Failed.</div>";
		}
	}
	$cardcontent = "<span class='wideinput'><form method='POST'>";
	$cardcontent .= "<input type=text id=gname name=gname placeholder='$_SESSION[gname]'><br>";
	$cardcontent .= "<input type=submit class='button button1' name=gdetails value='Apply'></form></span>";
	card("Rename Group",$cardcontent);
	
	
	/*
	* Leaving groups and voting to remove members
	*/
		//Current in progress votes
		$sql = "Select FirstName, UserId, MAX(IF(User_Id = '$_SESSION[person]', IF(Action = 'Remove',1,2), '0')) as Voted from Group_Mod join D_Accounts on who = UserId where Who != '$_SESSION[person]' and Group_Id = '$_SESSION[group]' and (`Action` = 'Remove' or `Action` = 'Cancel') group by Who";
		$result = multiSQL($sql);
		$cardcontent = "<h4>Current Votes</h4><hr>";
		while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
			$cardcontent .= "<form method='POST'>";
			$cardcontent .= "<input type='text' id='r$row[UserId]' name='who' hidden value='$row[UserId]'><Label for='r$row[UserId]'>$row[FirstName]</label><br>";
			$cardcontent .= "<input class='button button1' type='submit' name='vote' value='Remove'";
			if($row['Voted'] == 1){
				$cardcontent .= " disabled";
			}
			$cardcontent .= ">";
			$cardcontent .= "<input class='button button1' type='submit' name='vote' value='Keep'";
			if($row['Voted'] == 2){
				$cardcontent .= " disabled";
			}
			$cardcontent .= "></form><div class='clear'></div><hr>";
		}
		//Start a vote
		$sql = "SELECT FirstName,g.UserId FROM `Group_Members` g join D_Accounts a on g.`UserId` = a.UserId where g.`UserId` != '$_SESSION[person]' and `GroupId` = '$_SESSION[group]'";
		debug($sql);
		$result = multiSQL($sql);
		$cardcontent .= "<br><h4>Start Vote</h4><hr>";
		while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
			$cardcontent .= "<form method='POST'>";
			$cardcontent .= "<div id='start_vote_person'><input type='text' id='r$row[UserId]' name='who' hidden value='$row[UserId]'><label for='r$row[UserId]'>$row[FirstName]</label><br>";
			$cardcontent .= "<input class='button button1' type='submit' name='vote' value='Remove'></div></form><br>";
		}
		//Leave
		$cardcontent .= "<div id='leave_group'><br><h4>Leave</h4><hr><form method='POST' onsubmit='return you_sure()'>
		<script>
		function you_sure(){
		return confirm('Are you sure you want leave the group:\"$_SESSION[gname]\". This may cause problems with your completion of assessment. ');
		}
		</script>
		<input class='button button1' type='submit' name='quit' value='Leave Group'></form></div>";
	card("Remove Member",$cardcontent);
	
	
	/*
	* Vote to add members
	*/
		//Current Votes
		$sql = "Select FirstName,UserId, MAX(IF(User_Id = '$_SESSION[person]', IF(Action = 'Add',1,2), '0')) as Voted from Group_Mod join D_Accounts on who = UserId where Who != '$_SESSION[person]' and Group_Id = '$_SESSION[group]' and (`Action` = 'Add' or `Action` = 'Deny') group by Who";
		$result = multiSQL($sql);
		$cardcontent = "<h4>Current Votes</h4><hr>";
		while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
			$cardcontent .= "<form method='POST'>";
			$cardcontent .= "<input type='text' id='r$row[UserId]' name='who' hidden value='$row[UserId]'><Label for='r$row[UserId]'>$row[FirstName]</label><br>";
			$cardcontent .= "<input class='button button1' type='submit' name='vote' value='Accept'";
			if($row['Voted'] == 1){
				$cardcontent .= " disabled";
			}
			$cardcontent .= "><input class='button button1' type='submit' name='vote' value='Decline'";
			if($row['Voted'] == 2){
				$cardcontent .= " disabled";
			}
			$cardcontent .= "></form><div class='clear'></div><hr>";
		}
		//Start a vote
		$sql = "SELECT FirstName,g.UserId FROM `Group_Members` g join D_Accounts a on g.`UserId` = a.UserId where g.`UserId` != '$_SESSION[person]' and `GroupId` = '$_SESSION[group]'";
		debug($sql);
		$result = multiSQL($sql);
		$cardcontent .= "<h4>Start Vote</h4><hr>";
		$cardcontent .= "<form method='POST'><input type='text' name='who'><input type='submit' class='button button1' name='vote' value='Add'></form>";
	card("Add Member",$cardcontent,280);
?>