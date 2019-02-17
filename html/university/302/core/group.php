<?php
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	lib_login();
	lib_database();
	lib_files();
	
	/*
	Set a users current Group
		- Defaults to GET or POST group if not specified
		- Checks that the user is a member of target group
		- returns false group setting fails.
		
		note: this function automatically runs on the inclusion of this library.
	*/
	function group($g = ""){
		if($g == ""){
			if(is_numeric($_GET['group'])){
				$g = $_GET['group'];
			}else if(isset($_SESSION['group'])){
				$g = $_SESSION['group'];
			}
		}
		if($g != ""){
			$sql = "Select 1 from Group_Members m join Groups g on m.GroupId = g.GroupId join D_Perms p on g.UnitCode = p.what where m.GroupId = '$g' and (m.UserId = '$_SESSION[person]' or Supervisor = '$_SESSION[person]' or (p.UserId = '$_SESSION[person]' and p.level > 1)) group by m.GroupId;";
			debug($sql);
			if(singleSQL($sql)){
				$_SESSION['group'] = $g;
				$_SESSION['gname'] = singleSQL("Select GroupName from `Groups` g where g.GroupId = '$g';");
			}else{
				unset($_SESSION['group']);
				return false;
			}
		}
		return true;
	}
	group();
	
	
	/*
	* Check if the user currently has a group set.
	* 	- Returns bool
	*/
	function inGroup(){
		return isset($_SESSION['group']);
	}
	
	
	/*
	Get the names of members of a group.
		- returns array
		- Defaults to currently set group
	*/
	function members($group = ""){
		if($group == ""){
			$group = $_SESSION['group'];
		}
		$result = multiSQL("SELECT CONCAT(`FirstName`,' ',`LastName`) as name FROM `D_Accounts` a JOIN `Group_Members` g WHERE g.`UserId` = a.`UserId` and g.UserId != '$_SESSION[person]' and `GroupId` = '$group'");
		$text = [];
		while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
			$text[] = $row['name'];
		}
		return $text;
	}
	
	
	/*
	Get the ids of members of a group.
		- returns array
		- Defaults to currently set group
	*/
	function members_id($group = ""){
		if($group == ""){
			$group = $_SESSION['group'];
		}
		$result = multiSQL("SELECT UserId as name FROM `Group_Members` WHERE UserId != '$_SESSION[person]' and `GroupId` = '$group' ORDER BY UserId");
		$text = [];
		while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
			$text[] = $row['name'];
		}
		return $text;
	}
	
	
	/*
	Adds a member to a group.
		- Defaults to currently set user/group
	*/
	function add_member($group = "", $user = ""){
		if($group == ""){
			$group = $_SESSION['group'];
		}
		if($user == ""){
			$user = $_SESSION['person'];
		}
		if(runSQL("INSERT INTO `Group_Members` (`GroupId`, `UserId`) VALUES ('$group', '$user');")){
			note("membership","ADDED::$user >> $group :: by $_SESSION[person]");
			return true;
		}else{
			note("membership","FAILED::$user >> $group :: by $_SESSION[person]");
			return false;
		}
	}
	
	
	/*
	Removes a member from a group.
		- Defaults to currently set user/group
	*/
	function remove_member($group = "", $user = ""){
		if($group == ""){
			$group = $_SESSION['group'];
		}
		if($user == ""){
			$user = $_SESSION['person'];
		}
		if(runSQL("DELETE FROM `Group_Members` WHERE `Group_Members`.`GroupId` = '$group' AND `Group_Members`.`UserId` = '$user';")){
			note("membership","REMOVED::$user >> $group :: by $_SESSION[person]");
			if(singleSQL("SELECT count(*) FROM Group_Members where GroupId = '$group' group by GroupId") < 1){
				runSQL("DELETE FROM `Groups` WHERE `GroupId` = '$group'");
			}
			return true;
		}else{
			note("membership","Failed-Remove::$user >> $group :: by $_SESSION[person]");
			return false;
		}
	}
	
	
	/*
	Insists the user select a group before continuing.
	*/
	function group_selected(){
		if(!inGroup()){
			echo "<h1>Select a group:</h1>";
			$sql = "SELECT g.`GroupId`,`GroupName`,`GroupProject`,`UnitCode` FROM `Groups` g join Group_Members m on g.`GroupId` = m.GroupId WHERE m.UserId = '$_SESSION[person]'";
			debug($sql);
			$result = multiSQL($sql);
			while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
				$cardcontent = "Unit: $row[UnitCode]<br>";
				$cardcontent .= "Project: $row[GroupProject]<br>";
				$cardcontent .= "<a href='./?group=$row[GroupId]'><input class='button button1' type='button' value='Open'></a>";
				card($row['GroupName'],$cardcontent,200);

			}
			echo "<hr><br><form action='http://$_SERVER[HTTP_HOST]/group/find/'><input type='submit' value='Find a Group' class='button button1'></form>";
			die();
		}
	}
?>