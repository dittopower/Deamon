<?php
/* Time Tracking */
	if (!(isset($_SESSION['time'])&&isset($_SESSION['t']))){
		$_SESSION['t'] = 0;
	}else if (time() > ($_SESSION['time'] + (10*60 /* Min*Sec */))){
		$_SESSION['t'] += 60;
		if (isset($_SESSION['User'])){
			$current = singleSQL("Select time from Users where username='$_SESSION[User]'", $mysqli)
		}
	}else if (time() > ($_SESSION['time'] + 60)){
		$_SESSION['t'] += time() - $_SESSION['time'];
	}chrome.csi().pageT
	$_SESSION['time'] = time();
?>