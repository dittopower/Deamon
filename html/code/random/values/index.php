<?php //Start Page
	require_once "/var/www/html/lib.php";
	page();
?>
<style>
.qp{
background:rgba(200,0,0,0.2);
padding:0.5em;
border: 1px solid black;
border-radius:0.5em;
}
span.qp {
    background: rgba(255, 255, 0, 0.5);
    cursor: default;
}
</style>
<form id="quarterpounders">
<h1>How much is your thing? </h1>
Using?:
<select id="units">
  <option value=0 selected>Quater Pounder - McDonalds</option>
  <option value=1>Double Quater Pounder - McDonalds</option>
  <option value=2>1kg Gold Bar</option>
  <option value=3>Nintendo 64</option>
  <option value=4>Student: Bachelor of Games Development</option>
  <option value=5>Call of Duty: Ghosts</option>
  <option value=6>Pokemon Gold - Gameboy Colour</option>
</select>
<hr>
<label for='weight'>Object Weight: Kg </label><input type=number id=weight value=1 class=qp>
<label for='cost'>Object Value: $ </label><input type=number id=cost value=1 class=qp>
</form>
Your thing's equivalent to <span id='qp_w' class=qp></span> <span class=myunit></span> but is worth <span id='qp_c' class=qp></span> <span class=myunit></span>.
<br><br>
<script>
var k = $('#weight');
var c = $('#cost');
var un = $("#units");
var sun = $('.myunit');
var unit = 0;

var units = Array();
//weight in kg, $$, plural name
units.push([0.22,6,"Quarter Pounders"]);
units.push([0.28,7.8,"Double Quarter Pounders"]);
units.push([1,56422.80,"1kg Gold Bars"]);
units.push([1.097694,100,"Nintendo 64s"]);
units.push([70,0.01,"Games Dev Students"]);
units.push([0.136,60,'"Call of Duty: Ghosts"s']);
units.push([0.0239,27,"Pokemon Golds"]);

var qpw = $('#qp_w');
var qpc = $('#qp_c');

function kg(){
	return k.val();
}
function d(){
	return c.val();
}

function update_w(){
	qpw[0].innerHTML = kg()/units[unit][0];
}
function update_c(){
	qpc[0].innerHTML = d()/units[unit][1];
}
function update_unit(){
	unit = un.val();
	for(i = 0; i < sun.length; i++){
	sun[i].innerHTML = units[unit][2];	
	}
	update_w();
	update_c();
}

k[0].oninput = update_w;
c[0].oninput = update_c;
un[0].oninput = update_unit;
update_unit(); update_w();update_c();
</script>