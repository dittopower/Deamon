<?php
	session_start();
	include "database.php";
	$c = singleSQL("Select count(*) from 344_sites where visited = 1");
?>

<h1>Auto Crawl</h1><hr>
Session Pages Crawled: <span id=count >0</span><br>
Total Pages Crawled: <span id=total ><?php echo $c + 1;?></span><hr>
<button id=dm onclick='domain()'>Allow Other Domains</button>  <button id=start onclick='start()'>Start</button> <button id=stop onclick='stop()' hidden>Stop</button>
<br><br>
<iframe id=pie src="" style='width:95%;height:95%;'></iframe>


<script>
var count = 0;
var total = <?php echo $c;?>;
mycount = document.getElementById("count");
mytotal = document.getElementById("total");
ta = document.getElementById("start");
to = document.getElementById("stop");
dm = document.getElementById("dm");
i = document.getElementById("pie");
d = "./?next&domain";
var ticker;

function next(){
	count++;
	total++;
	mycount.innerHTML = count;
	mytotal.innerHTML = total;
	i.src = d;
}

function domain(){
	if(d = "?next"){stop()
		d = "./?next&domain";
		dm.innerHTML = "Allow Other Domains";
	}else{
		d = "./?next";
		dm.innerHTML = "Only use Core Domain";
	}
}

function stop(){
	window.clearInterval(ticker);
	ta.hidden = false;
	to.hidden = true;
}

function start(){
	next();
	ticker = window.setInterval(next, 10100);
	ta.hidden = true;
	to.hidden = false;
}

</script>