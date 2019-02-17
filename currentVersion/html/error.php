<?php
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";


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
			$er_text = "";
			$er_joke = "Request Denied! To the void with you.";
			break;
		case 401:
			$er_name = "Authorization Required";
			$er_text = "You need to login.";
			$er_joke = "psst.. Mortal  the password is...";
			break;
		//--
		case 403:
			$er_name = "Forbidden";
			$er_text = "You lack the permission access this.";
			$er_joke = "Mortal you may only access void!";
			break;
		case 404:
			$er_name = "Not Found";
			$er_text = "";
			$er_joke = "Behold Mortal, You have thrown yourself into the void.";
			break;
		//--
		case 500:
			$er_name = "Server Error";
			$er_text = "Sorry....";
			$er_joke = "Beware Mortal, my Realm has become unstable.";
			break;
		default:
			$er_name = "Other";
			$er_text = "";
			$er_joke = "";
			break;
	}

?>

<link href="http://deamon.info/errors.css" rel="stylesheet" type="text/css"/>

	<div id="space">
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
	</div>

	<h1>Error <?php echo $error;?> </h1>
	<h2><?php echo $er_name; ?></h2>
	<h3><?php echo $er_text; ?></h3>
	<p>While Trying to access "<?php echo $url; ?>"</p>
	<?php echo "<br>".$er_joke; ?>