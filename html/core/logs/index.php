<?php
	require_once "/home3/deamon/lib.php";
	lib_files();
	page();
	
//	echo "<h1>Logs</h1><hr>";
	
	$logs = dir_list($local."core/logs");
	echo "<ul>";
	foreach($logs as $log){
		echo "<li><a href='?log=$log'>".pathinfo($log,PATHINFO_FILENAME)."</a></li>";
	}
	echo "</ul><hr><table class='table'>";
	
	if(isset($_GET['log'])){
		if(in_array($_GET['log'],$logs)){
			$text = load($local."core/logs/".$_GET['log']);
			$text = explode("\n",$text);
			foreach($text as $line){
				echo "<tr>";
				$row = preg_split("/::|\t/",$line);
				//var_dump($row[0]);
				foreach($row as $things){
					echo "<td>$things</td>";
					//var_dump($things);
				}
				echo "</tr>";
			}
		}
	}
	echo "</table>";

?>