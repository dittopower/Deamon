<?php

	session_start();

	include 'connection_include.php';

	include 'functions.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>TCH - Townsville Children's Hospital</title>



<!-- Our CSS stylesheet file -->

<link rel="stylesheet" href="style.css" />



<!-- Font Awesome Stylesheet -->

<link href="iconic.css" media="screen" rel="stylesheet" type="text/css" />



<link rel="icon" type="image/png" href="./images/site.ico">



</head>

<body>

<?php if(checkFilePermission(__FILE__, $mysqli)){ ?>

	<div id="health_wrapper">

	<div class="HealthIcon" id="HIl"></div>

	<div class="HealthIcon" id="HIr"></div>

	<div id="header"><h1> Townsville Children's Hospital </h1></div>

	

		<nav>

			<ul class="menu">

				<?php if(checkPermission("DD,TT", $mysqli)){ ?>

					<li class='main'><a href="./"><span class="iconic home"></span> Home</a></li>

					<li><a href="#"><span class="iconic calendar"></span> Planner</a>

						<ul>

							<li><a href="./bookTheater.php">Book Theater</a></li>

						</ul>

					</li>

				<?php } ?>

				<?php if(checkPermission("RR,NN,DD,SA", $mysqli)){ ?>

					<li class='main'><a href="#"><span class="iconic pencil"></span> Patient</a>

						<ul>

							<li><a href="./newPatient.php">New Patient</a></li>

							<li><a href="./patientList.php">Find Patient</a></li>

							<li><a href="./ward.php">Ward Info</a></li>

						</ul>

					</li>

				<?php } ?>

				<?php if(checkPermission("TT,SA", $mysqli)){ ?>

					<li class='main'><a href="#"><span class="iconic image"></span> X-ray</a>

						<ul>

							<li><a href="./xrayView.php">Find X-Ray</a></li>

							<li><a href="./xraySubmit.php">Upload X-Ray</a></li>

						</ul>

					</li>

				<?php } ?>

					<li class='main'><a href="#"><span class="iconic user"></span> Account</a>

						<ul>

							<li><a href="./user.php">Details</a></li>

							<li><a href="./mypatients.php">My Patients</a></li>

						</ul>

					</li>

				<?php if(checkPermission("HA", $mysqli)){ ?>

					<li class='main'><a href="#"><span class="iconic cog"></span> Admin</a>     

						<ul>

							<li><a href="./overview.php">Hospital Overview</a></li>

							<li><a href="./createUser.php">Create User</a></li>

							<li><a href="./users.php">Users</a></li>

							<li><a href="./filePermissions.php">File Permissions</a></li>

							<li><a href="./phpmyadmin/">Database</a></li>

						</ul>

					</li>

				<?php } ?>

					<li class='main'>

						<a href='logout.php'><span class='iconic logout'>6</span> Logout</a>

					</li>

					

			</ul>

			

		</nav>



		<div id="health_main">

    	<div id="health_content" class="left">

            <div class="content_wrapper content_mb_30">

		

<?php }else{

			echo "<script >window.location='login.php'</script>";

		}

 ?>





