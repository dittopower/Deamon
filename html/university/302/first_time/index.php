<?php
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	
	if(isset($_POST['done'])){
		
		$g = false;
		if(isset($_POST['gpa'])){//GPA
			if(is_numeric($_POST['gpa']) && $_POST['gpa'] >= 0 && $_POST['gpa'] <= 7){
				$gpa = $_POST['gpa'];
				$g = true;
			}
		}else{
			$gpa = null;
			$g = true;
		}
		
		$e = false;
		if(isset($_POST['email'])){//Email
			if(preg_match("/.*@[A-Za-z0-9]+\.[A-Za-z]+/",$_POST['email'])){
				$email = $_POST['email'];
				$e = true;
			}
		}
		
		$p = false;
		if(isset($_POST['phone'])){//phone
			$phone = str_replace(' ', '', $_POST['phone']);
			if(preg_match("/^[0-9]+$/", $phone)){
				$p = true;
			}
		}
		
		$s = true; $skills = '';
		if(isset($_POST['skills'])){//skills
			if($_POST['skills'] != ""){
				$skills = explode(',',$_POST['skills']);
				for($ii = 0; $ii< count($skills);$ii++){
					$skills[$ii] = ucfirst(trim($skills[$ii]));
				}
				$skills = implode($skills,', ');
			}
		}
		
		if(isset($_POST['Blurb'])){//blurb
			$b = true;
			$blurb = $_POST['Blurb'];
		}else{
			$b = false;
		}
		
		$sk = false;
		if(isset($_POST['Skype'])){//skype
			$sk = true;
			$skype = $_POST['Skype'];
		}
		
		$f = false;
		if(isset($_POST['Facebook'])){//facebook
			$f = true;
			$facebook = $_POST['Facebook'];
		}
		
		$l = false;
		if(isset($_POST['LinkedIn'])){//linkedin
			$l = true;
			$linked = $_POST['LinkedIn'];
		}
		
		if($g && $s && $b && $l && $e && $f && $p && $sk){
		lib_login();
		lib_database();
		global $mysqli;
		$sql= mysqli_prepare($mysqli, "INSERT INTO `deamon_INB302`.`User_Details` (`UserId`, `GPA`, `Skills`, `Blurb`, `LinkedIn`, `Email`, `Facebook`, `Skype`, `Phone`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
		mysqli_stmt_bind_param($sql,"sssssssss",$_SESSION['person'],$gpa,$skills,$blurb,$linked,$email,$facebook, $skype, $phone);
		
		if(mysqli_stmt_execute($sql)){
			note('UserDetails',"Set::$nuser");
		} else {
			note('UserDetails',"Failed_Set::$nuser");
		}
		mysqli_stmt_close($sql);

		
		$_SESSION['registered'] = 1;
		header("Location: http://teamwork.deamon.info");
		echo "Details Updated - <a href='//teamwork.deamon.info/'>redirecting</a>";
		die();
		}
	}
	page();
?>
<h1>First Time Setup</h1>
<p>As this is the first time you've logged on, You need to complete your profile before continuing.</p>
<form name='reg' method='post'>
<?php
	$cardcont = "";
	$cardcont .= "<div><label for='email'>Email:";
	if(isset($e) && !$e){
		$cardcont .= "<span class='error'> Error</span>";
	}
	$cardcont .= "</label><input type='email' name='email' id='email' placeholder='email@connect.qut.edu.au'></div>";
	
	$cardcont .= "<div><label for='phone'>Phone Number:";
	if(isset($p) && !$p){
		$cardcont .= "<span class='error'> Error</span>";
	}
	$cardcont .= "</label><input type='tel' name='phone' id='phone' placeholder='0400 000 000'></div>";
	
	$cardcont .= "<div><label for='LinkedIn'>LinkedIn (optional):";
	if(isset($l) && !$l){
		$cardcont .= "<span class='error'> Error</span>";
	}
	$cardcont .= "</label><p>linkedin.com/profile/view?id=<b class='target'>Your-Profile</b>&trk=nav_responsive_tab_profile_pic</p><input type='text' name='LinkedIn' id='LinkedIn' placeholder='Your-Profile url'></div>";
	
	$cardcont .= "<div><label for='Skype'>Skype:";
	if(isset($sk) && !$sk){
		$cardcont .= "<span class='error'> Error</span>";
	}
	$cardcont .= "</label><input type='text' name='Skype' id='Skype' placeholder='skypename'><span class=target> Necessary for Group Calls from this site.</span></div>";
	
	$cardcont .= "<div><label for='Facebook'>Facebook:";
	if(isset($f) && !$f){
		$cardcont .= "<span class='error'> Error</span>";
	}
	$cardcont .= "</label><p>facebook.com/<b class='target'>Your-Profile</b></p><input type='text' name='Facebook' id='Facebook' placeholder='Your-Profile Url'></div>";
	card("Contact Details",$cardcont);
	
	$cardcont = "<div><label for='gpa'>Average Grade <i>GPA</i> (optional):";
	if(isset($g) && !$g){
		$cardcont .= "<span class='error'> Error</span>";
	}
	$cardcont .= "</label><input type='number' name='gpa' id='gpa' min=0 max=7 step=0.1 value=4></div>";
	
	$cardcont .= "<div><label for='skills'>Skills:<br><i>Enter your Skills separted by commas <b>,</b> .</i><br>";
	if(isset($s) && !$s){
		$cardcont .= "<span class='error'> Error</span>";
	}
	$cardcont .= "<textarea name='skills' id='skills' cols='40' rows='4' id='Blurb' placeholder='I.e. Researching, Programming, Tightrope walking, Maths, Statistics, Report writing'></textarea></div>";
	card("Academic Details", $cardcont);
	
	$cardcont = "<div>";
	if(isset($b) && !$b){
		$cardcont .= "<span class='error'> Error</span>";
	}
	$cardcont .= "</label><textarea type='Blurb' name='Blurb' cols='80' rows='6' id='Blurb' placeholder='Describe yourself, your expectations, your academics'></textarea></div>";
	card("About You",$cardcont);
?>
	<div><input type='submit' class='button button1' name='done'  value='Update Details'></div>
</form>