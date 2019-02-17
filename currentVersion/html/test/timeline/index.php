<?php
	require_once "/var/www/html/lib.php";
	page();
?>

<style>
	#player{
		width:calc(100% - 1em);
		height:900px;
		background:grey;
		border-color: black;
		border-width: 1ch;
		border-style: double;
		margin: -1ch;
		padding-left: 0.5em;
		padding-right: 0.5em;
	}

.timecard{
		width:10vw;
		height:16vw;
		background:bisque;
		border: black 1px solid;
    display: inline-block;
		margin-left: 0.5em;
		margin-right: 0.5em;
		margin-top: 1em;
		margin-bottom: 1em;
position:relative;
	}
.blankcard{
background:none;
border-style:dashed;
}
</style>

<div id='player'><div id='players'></div><div id='timeline'></div><div id='hand'></div></div>

<script>
	var player = $('#player');
	var width = player.width();
	var height = width/16*9;
	player[0].scrollIntoView();

	var timeline = $('#timeline');
	var players = $('#players');
	var hand = $('#hand');
	var cards = $('.timecard:not(.blankcard)');
function getcards(){
cards = $('.timecard:not(.blankcard)');
}

timeline.append("<span class='timecard'>");

function blankspots_clear(){
$('.blankcard').remove();
}

function blankspots_create(){
timeline.prepend("<span class='timecard blankcard'>");
getcards();cards.after("<span class='timecard blankcard'>")
}

function hand_add(thing){
hand.append("<span class='timecard'>");
}
</script>