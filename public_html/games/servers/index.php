<?php
	require_once "/home3/deamon/public_html/lib.php";
	page();
	lib_perms();
	
	enforce_perm("Server");
	global $lv;
	$lv = getUserLevel("Server");
	
	chdir("/home3/deamon/core/phpseclib/");
	include('Net/SSH2.php');

	global $pass;
	global $ssh;
	global $user;
	global $delay;

	$pass = "OverloRd10";
	$user = "demon";
	$delay = 20;

	$ssh = new Net_SSH2('play.deamon.info');
	if (!$ssh->login($user, $pass)) {
		exit('Login Failed');
	}

	function status($service){
		global $ssh;
		global $pass;
		echo ucwords(strtolower($service)) . " Server is ";

		$res = $ssh->exec("service $service status");

		if(preg_match("/ is now running\./", $res)){
			echo "Running";
		}else{
			echo "Offline";
		}
		echo ".";
	}

	function start($service){
		global $ssh;
		global $pass;
		global $delay;
		echo "Starting ".ucwords(strtolower($service)).":";

		$ssh->write("sudo service $service start\n");
		$ssh->read('Password:');
		$ssh->write("$pass\n");
		sleep($delay);

		echo "done?<br>";
		status($service);
	}

	function stop($service){
		global $ssh;
		global $pass;
		global $delay;
		echo "Stopping ".ucwords(strtolower($service)).":";

		$ssh->write("sudo service $service stop\n");
		$ssh->read('Password:');
		$ssh->write("$pass\n");
		sleep($delay);

		echo "done?<br>";
		status($service);
	}

	function restart($service){
		global $ssh;
		global $pass;
		global $delay;
		echo "Restarting ".ucwords(strtolower($service)).":";

		$ssh->write("sudo service $service restart\n");
		$ssh->read('Password:');
		$ssh->write("$pass\n");
		sleep($delay);

		echo "done?<br>";
		status($service);
	}
	
	function display_server($service){
		global $lv;
		echo "<tr><td>";
		echo ucwords(strtolower($service));
		echo "</td><td>";
		if($lv >= 2 && $_POST['server'] == $service){
			if($_POST['action'] == 'Restart'){
				restart($service);
			}else if($_POST['action'] == 'Start'){
				start($service);
			}else if($_POST['action'] == 'Stop'){
				stop($service);
			}else if($_POST['action'] == 'Backup'){
				echo "NYI";
			}else{
				status($service);
			}
		}else{
			status($service);
		}
		echo "</td><td><form method=POST><input type=text hidden name=server value='$service'><input name=action type=submit value='Restart'";if($lv < 2){echo " disabled";} echo "></form>";
		echo "</td><td><form method=POST><input type=text hidden name=server value='$service'><input name=action type=submit value='Start'";if($lv < 2){echo " disabled";} echo "></form>";
		echo "</td><td><form method=POST><input type=text hidden name=server value='$service'><input name=action type=submit value='Stop'";if($lv < 2){echo " disabled";} echo "></form>";
		echo "</td><td><form method=POST><input type=text hidden name=server value='$service'><input name=action type=submit value='Backup'";/*if($lv < 2){echo " disabled";}*/ echo " disabled></form>";
		echo "</td></tr>";
	}
	
	echo "<h1>Servers</h1>Expect long load times and <b>DO NOT SPAM CLICK</b>.<table><tr><th>Game</th><th>Status</th><th>Restart</th><th>Start</th><th>Stop</th><th>Backup</th></tr>";
	display_server("minecraft");
	display_server("terraria");
	echo "</ul>";
	
?>