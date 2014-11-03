<head>
<script>
function pressf(e){
	e = e || event;
	
	var evt = e.type;

	while (evt.length < 10) evt += ' ';
	f = String.fromCharCode(e.keyCode || e.charCode);
	if ( f == 'F' || f == 'f'){
	document.body.style.background='pink';
	document.p.innerHTML = "<h1>GAYYYYYYYYY!!!!!!!</h1>";
	document.getElementById('d').hidden = false;
	document.getElementById('m').hidden = false;
	}
}
function normal(e){
	e = e || event;
	
	var evt = e.type;

	document.body.style.background='white';
	document.p.innerHTML = "Press F to suck dick";
	document.getElementById('d').hidden = true;
	document.getElementById('m').hidden = true;
}
</script>
<style>
#m{
	position:absolute;
	top:40%;
	right:0;
	z-index:70;
}
#d{
    -ms-transform: rotate(90deg); /* IE 9 */
    -webkit-transform: rotate(90deg); /* Chrome, Safari, Opera */
    transform: rotate(90deg);
	position:absolute;
	top:30%;
	-webkit-animation: suck 3s; /* Chrome, Safari, Opera */
	animation: suck 3s;
	-webkit-animation-iteration-count: infinite;
	animation-iteration-count: infinite;
	animation-direction: alternate;
	-webkit-animation-direction: alternate;
}
	/* Chrome, Safari, Opera */
	@-webkit-keyframes suck {
		from {left: 0;}
		to {left: 75%;}
	}
	/* Standard syntax */
	@keyframes suck {
		from {left: 0;}
		to {left: 75%;}
	}
</style>
</head>
<body onkeydown="pressf()" onkeyup='normal()'>
<form name=p>Press F to suck dick</form>
<img src='http://d3d71ba2asa5oz.cloudfront.net/73000363/images/penis-costume.jpg' id='d' hidden>
<img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSXkjHS2AOGtLP7o6jGt0nnaZMORA4hCsp_AHqbAbYiOwDAP8gGg' id='m' hidden>
</body>