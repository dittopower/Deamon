<?php
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."../core/files.php";
	require_once $home."../core/code.php";	
	if(isset($_POST['pie']) && isset($_POST['user'])){
		$file = "./".$_POST['user'].".pie";
		debug($_POST);
		if(file_exists($file)){
			$data=file_get_contents($file);
		}else{
			$data="pie$_POST[pie]\n0\n";
		}
		debug($data);
		$data=preg_replace("/$_POST[pie]\n1\n/", "$_POST[pie]\n0\n", $data,1, $out);
		echo $out;		write($file,$data);	
	}else{
		require_once $home."page.php";
		if(isUser()){
			$file = "./".$_SESSION['name'].".pie";
			if(file_exists($file)){
				$data=file_get_contents($file);
				debug($data);
				$data=preg_replace("/(pie.+)\n0\n/", "$1\n1\n", $data,1, $out);
				echo $out;
				write($file,$data);
			}else{
				echo "Connect a Pie First!!";
			}
		}else{
			echo "Please log in.";
		}	}
?>