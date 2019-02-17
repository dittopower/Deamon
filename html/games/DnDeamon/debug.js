//fuck off page refreshing
//setTimeout(function(){clearInterval(tick)},2000);


function totalranks(){
	var ranks = 0;
	for(ib = 0; ib < Skills.length;ib++){
	for(ic = 0; ic < characters[current].stats.length; ic++){
	ranks += characters[current].stats[ic][1].skill[Skills[ib]][3];
	}
	}
	console.log(ranks);
}