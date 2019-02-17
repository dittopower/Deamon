<?php
	
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	
	lib_database();
	
	function where(){
		global $w;
		global $nsql;
		if(!$w){
			$nsql .= " where";
			$w = 1;
		}else{
			$nsql .= " and";
		}
	}
	
	$cardcont = "";//BEGIN
	
	$tt = rowSQL("SELECT CONCAT(u.UnitCode, ' ', u.Unit) as uid, g.GroupName as gname FROM `Unit` u JOIN Groups g ON u.UnitCode = g.UnitCode where g.GroupId=".$_GET['groupidreport']);
	
	$cardcont .= "<h2>Group: ".$tt['gname']."</h2><h2>Unit: ".$tt['uid']."</h2><h3>Members:</h3>";
	
	$mymembers = arraySQL("SELECT `Username`, CONCAT(`FirstName`,' ',`LastName`) as Name FROM `D_Accounts` a join Group_Members m on m.`UserId` = a.`UserId` left join User_Details d on m.UserId = d.UserId WHERE m.GroupId = '".$_GET['groupidreport']."'");
	
	foreach($mymembers as $item){
		$cardcont .= "#$item[Username]: $item[Name]<br>";
	}
	
	$topic = "#".$_GET['groupidreport'];
	
	//****** COPY PASTE start **************/
	global $nsql;
	$nsql = "Select art_id, Username, user_id, DATE_FORMAT(post_date, '%H:%i %d %b %y') as postd, DATE_FORMAT(mod_date, '%H:%i %d %b %y') as modd, tags, title, contents from D_Articles a join D_Accounts u on user_id = UserId";
	$w = 0;
	
	if(strlen($topic) > 0){
		where();
		$nsql .= " tags like '%$topic|%'";
	}
	
	$nsql .= " order by post_date desc";
	
	//debug($nsql);
	$result = multiSQL($nsql);
	
	
	
	while ($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
		$cardcont .= "<article>";
		//Title
		$cardcont .= "<h3>$row[title]</h3>";
		
		//Author, Dates
		$cardcont .= "<div class='info'>";
		$cardcont .= "$row[postd] by ";
		$cardcont .= "$row[Username]";//<a class='author' href='http://$_SERVER[HTTP_HOST]/user?u=$row[Username]'>
		if ($row['postd'] != $row['modd']){
			$cardcont .= " Modified $row[modd]";
		}
		$cardcont .= "</div>";
		
		//contents
		$cardcont .= "<div class='contents'>";
		$cardcont .= $row['contents'];
		$cardcont .= "</div>";
		
		$cardcont .= "</article><hr>";
	}

	$cardcont .= "</span>";

	//==============================================================
	//==============================================================
	//==============================================================

	include($_SERVER[DOCUMENT_ROOT]."/admin/mpdf/mpdf.php");

	$mpdf=new mPDF(); 

	$mpdf->SetDisplayMode('fullpage');

	$mpdf->WriteHTML($cardcont);

	//$mpdf->Output('application.pdf','F');

	$mpdf->Output();
	exit;

	//==============================================================
	//==============================================================
	//==============================================================
?>