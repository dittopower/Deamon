/* Deamon 2016 
Image Carousel

IC_setup

*/
var IC_Car;
var IC_Mini;
var IC_Timer;
var IC_Current;
var IC_Speed = 8000;
var IC_Fadespeed = 500;
var IC_Backgroundcolour = '#fff3e0';

function IC_setup(selector){
	IC_Car = selector;
	$(IC_Car).css({
		'background-repeat': 'no-repeat',
		'background-position': 'center',
		'background-color': IC_Backgroundcolour,
		'background-size': 'contain',
		'margin': '0',
		'padding': '0'
	});
	$(IC_Car).parent().css({
		'background-color': IC_Backgroundcolour,
		'overflow': 'hidden'
	});
	$(IC_Car).children().hide();
	IC_Mini = $("<div id='ICmini'>");
	$(IC_Car).parent().append(IC_Mini);
	
	var c = $(IC_Car).children();
	var cc = '$(this).animate({ "border-width": "4px", "margin": "0"},200)';
	var ccc = '$(this).animate({ "border-width": "0px", "margin": "auto"},200)';
	for(var i = 0; i < c.length; i++){
		IC_Mini.append("<img src='"+c[i].innerHTML+"' onclick='IC_switch_a("+(i+1)+")' onmouseover='"+cc+"' onmouseout='"+ccc+"'>");
	}
	IC_Mini.children().css({
		"border": "0px #EF6C00 double",
		'display':'inline-block',
		'min-width':'3.5em',
		'max-width':'9em',
		'min-height':'5em',
		'height':'20%',
		'margin':'auto',
		'padding':'0.2em',
		'cursor':'pointer'
	});
	/* var h = (IC_Mini.height()+10);
	IC_Mini.css({'margin-top': '-'+h+'px'}); */
	IC_Mini.css({
		'margin-bottom': '1em',
		'overflow-x': 'auto',
		'overflow-y': 'hidden'
	});
	IC_Current = 1;
	IC_Timer = setInterval(IC_next, IC_Speed);
}

function IC_jump(nn){
	$(IC_Car).css(
		{'background-image' : 'url("'+$( IC_Car + ' :nth-child(' + nn + ')').text()+'")'}
	)
}

function IC_next(){
	m = $(IC_Car).children().length;
	if(IC_Current < m){
		IC_switch_a(IC_Current + 1);
	}else{
		IC_switch_a(1);
	}
}

function IC_switch_a(nn){
	IC_Current = nn;
	$(IC_Car).animate({opacity: "0"}, IC_Fadespeed, IC_switch_b);
}
function IC_switch_b(){
	IC_jump(IC_Current);
	$(IC_Car).animate({opacity: "1"}, IC_Fadespeed);
}

function IC_speed(tt){
	IC_Speed = tt;
	clearInterval(IC_Timer);
	IC_Timer = setInterval(IC_next, IC_Speed);
}

function IC_fadespeed(tt){
	IC_Fadespeed = tt;
}