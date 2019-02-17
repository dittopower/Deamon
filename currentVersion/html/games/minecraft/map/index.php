<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";
	
	echo "\n<script type='text/javascript' src='/core/vis/vis.js'></script>";
    echo "<link href='/core/vis/vis.css' rel='stylesheet' type='text/css' />";
	echo "<div id='mynetwork'></div>\n";

	echo "\n<script type='text/javascript'>\n";
	
		// create an array with nodes
	echo "var nodes = new vis.DataSet([";
	$result = multiSQL("SELECT * FROM MC_objects");
	while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
		echo "{id: '$row[id]', label: \"$row[Name]\"},";
	}
	echo "]);\n";

		// create an array with edges
	echo "var edges = new vis.DataSet([";
	$result = multiSQL("SELECT * FROM MC_recipes");
	while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
		echo "{from: '$row[src]', to: '$row[dst]'},";
	}
	echo "]);\n";

		// create a network
		// provide the data in the vis format
	echo "var container = document.getElementById('mynetwork');	var data = {nodes: nodes, edges: edges};";
	echo "var options = {};";

		// initialize your network!
	echo "var network = new vis.Network(container, data, options);</script>\n";
?>