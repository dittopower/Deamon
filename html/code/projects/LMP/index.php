<?php

	require_once $_SERVER['DOCUMENT_ROOT']."/lib.php";
	page();

?>

<div class=page>

	<table>

	<h1>Lecture Efficiency Monitor</h1>

	<tr><th><h2>Progress:</h2></th></tr>

	<tr><td><h2>Slide</h2></td><td><progress id=pslide value="50" max="100"></progress></td><td></td><td> No. <span id=ds></span> </td></tr>

	<tr><td><h2>Times</h2></td><td><progress id=ptime value="50" max="100"></progress></td><td><td> <span id=dt></span> Min. </td></tr>

	<tr><td><button id=next hidden>Next Slide</button></td></tr>

	<tr><td><br><br></td></tr>

	<tr><td><h2>Overall Efficiency</h2></td><td><progress id=poe value="50" max="100"></progress></td><td> <span id=do></span> % </td></tr>

	<tr><td><h2>Efficiency per Slide</h2></td><td><progress id=pes value="50" max="100"></progress></td><td> <span id=dp></span> % </td></tr>

	<tr><td><br><br></td><td><script>

		time = 0;

		timemax = 1;

		function here(){

			poe = document.getElementById("poe");

			pes = document.getElementById("pes");

			pslide = document.getElementById("pslide");

			ptime = document.getElementById("ptime");

			islide = document.getElementById("islide");

			itime = document.getElementById("itime");

			dslide = document.getElementById("ds");

			dtime = document.getElementById("dt");

			dover = document.getElementById("do");

			dper = document.getElementById("dp");

		}

		function update(){

			here();

			time++;

			ptime.value = time;

			poe.value = (1 - (time/timemax) + (pslide.value/pslide.max)) * 100;

			pes.value = ((timemax / pslide.max) * pslide.value) / time * 100;

			dtime.innerHTML = Math.round(time/0.6)/100;

			dover.innerHTML = poe.value;

			dper.innerHTML = pes.value;

			dslide.innerHTML = pslide.value;

		}

		function startme(){

			poe.value = 50;

			pes.value = 50;

			pslide.max = islide.value;

			pslide.value = 1;

			timemax = itime.value * 60 * 60;

			time = 0;

			ptime.max = timemax;

			ptime.value = 0;

			window.setInterval(function(){update();},1000);

			document.getElementById("start").innerHTML="Restart";

			document.getElementById("next").hidden = false;

			document.getElementById("next").onclick = function(){pslide.value++;};

		}

	</script></td></tr>

	</table>

	<input id=islide type=number value=40>Slides<br><br>

	

	<input id=itime type=number value=2>Hrs<br><br>

	

	<button id=start onclick='startme()' onload='here()'>Start</button>

	

	

</div>

</body>