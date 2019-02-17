<?php
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	page();
	lib_login();
	lib_group();
	lib_feed();
	
	$group = $_SESSION['group'];
	
	/*
	CREATE TABLE Milestones(
		MID int(11),
		GroupId int(11),
		Content text(1000),
		Checked int(1)
	)
	*/
	
	if(ingroup()){
		
		if(isset($_POST["newmilestone"])){
			
			$content = escapeSQL(strip_tags($_POST["newmilestone"]));
			$run = runSQL("INSERT INTO Milestones (GroupId, Content, Checked) VALUES(".$group.", '".$content."', '0')");
			
			if($run){ echo "<span class='sucess'>New milestone created.</span>"; }
			else { echo "<span class='error'>Milestone not created.</span>"; }
			
			echo "<div class='clear'></div><br>";
		
		} else if(isset($_POST["deletemilestone"]) && isset($_POST["mid"])){
			
			$del = runSQL("DELETE FROM Milestones WHERE MID=".$_POST["mid"]);
			
			if($del){ echo "<span class='sucess'>Milestone deleted.</span>"; }
			else { echo "<span class='error'>Milestone failed to delete.</span>"; }
			
			echo "<div class='clear'></div><br>";
			
		} else if(isset($_POST["mid"]) && isset($_POST["current"])){
			
			$mid = escapeSQL(strip_tags($_POST["mid"]));
			$current = escapeSQL(strip_tags($_POST["current"]));
			
			$sql = "UPDATE Milestones SET Checked=";
			$milestone = singleSQL("SELECT Content FROM Milestones WHERE MID=".$mid);
			
			if($current == "&#10004;"){//tick
				$sql .= 0;
				
				post("#$_SESSION[group]|@$_SESSION[group]","Milestone UnCompleted","<span class=error>\"" . $milestone . "\"</span>");
			}
			else if($current == "&#10066;"){//cross
				$sql .= 1;
				
				post("#$_SESSION[group]|@$_SESSION[group]","Milestone Completed","<span class=sucess>\"" . $milestone . "\"</span>");
			}
			
			$sql .= " WHERE MID=" . $mid;
			
			$run = runSQL($sql);
			
			if($run){ echo "<span class='sucess'>Milestone state changed</span>"; }
			else { echo "<span class='error'>Milestone state not changed.</span>"; }
			
			echo "<div class='clear'></div><br>";
			
		}		
		
		$milestones = arraySQL("SELECT MID, Content, Checked FROM Milestones WHERE GroupId=".$group);
		
		foreach($milestones as $v){
	
			$cardcontent .= "<form method='post' class='inline' onsubmit='return confirm(\"Do you really want to delete this milestone?\");'><input type='hidden' name='mid' value='".$v["MID"]."'><input name='deletemilestone' type='submit' value='&#10006;' class='button button5 inline smallerbtn2'></form>";
			
			$cardcontent .= "<form method='post' class='inline'><input type='hidden' name='mid' value='".$v["MID"]."'><input name='current' type='submit' ";

				if($v["Checked"]){
					$cardcontent .= "value='&#10004;' class='button button3";
				}else{
					$cardcontent .= "value='&#10066;' class='button button2";
				}
				
			$cardcontent .= " mar inline'> " . $v["Content"] . "</form><br>";
		}
		
		card2("Milestones", $cardcontent);
		
		card2("Add Milestone", "<form method='post'><input type='text' name='newmilestone' placeholder='Type here'><input type='submit' value='Add' class='button button4'></form>");
		
	}
	else{
		echo "You must be in a group to see this page.";	
	}
	
?>