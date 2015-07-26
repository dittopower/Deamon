<?php
	if (isset($_GET['e'])){
		$error = $_GET['e'];
		$url = $_GET['u'];
	}else{
		$error = $_SERVER['REDIRECT_STATUS'];
		$url = $_SERVER['REQUEST_URI'];
	}
	
	switch($error){
		//--
		case 400:
			$er_name = "Bad Request";
			$er_text = "Request Denied! To the void with you.";
			break;
		case 401:
			$er_name = "Authorization Required";
			$er_text = "psst.. Mortal  the password is...";
			break;
		//--
		case 403:
			$er_name = "Forbidden";
			$er_text = "Mortal you may only access void!";
			break;
		case 404:
			$er_name = "Not Found";
			$er_text = "Behold Mortal, You have thrown yourself into the void.";
			break;
		//--
		case 500:
			$er_name = "Server Error";
			$er_text = "Beware Mortal, my Realm has become unstable.";
			break;
		default:
			$er_name = "Other";
			$er_text = "";
			break;
	}
?>
<head>
	<link rel="shortcut icon" type="image/x-icon" href="http://deamon.info/favicon.ico">
	<link rel="icon" type="image/png" href="http://deamon.info/favicon.ico">
	<title>Deamonic Request: <?php echo $error; ?></title>
	<link href="http://deamon.info/errors.css" rel="stylesheet" type="text/css"/>
</head>


<body>
	<div id="space">
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
	</div>
	
	<h2><?php echo $er_name; ?></h2>
	<h3><?php echo $er_text; ?></h3>
	<h1>Error <?php echo $error;?> </h1>
	<p>While Trying to access "<?php echo $url; ?>"</p>
</body>