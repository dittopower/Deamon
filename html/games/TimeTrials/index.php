<?php
	require_once "/var/www/html/lib.php";
	page();
?>


<canvas id="timezone"></canvas>

<script src='//deamon.info/api/games/score'></script>
<script>
var canvas = $("#timezone")[0];
var ctx = canvas.getContext("2d");
page=$("#page");
if(page.width() < page.height()){ 
  canvas.height = page.width();
}else{
  canvas.height = page.width()/16*9;
}
canvas.width = page.width();

if(canvas.width < canvas.height){
  radius = canvas.width;
}else{
  radius = canvas.height;
}
var radius = radius/ 4;
var halfx = canvas.width/2;
var fps = 30;
var ticks = 0;
var current = 5;
var finish = 0;
var lean = 250;
var max = 10;
var timer;

var score = new Score("Time Trials");
score.load();setTimeout( writescore(),1000);
score.load();setTimeout( writescore(),2500);
setInterval(function(){score.save();}, 300000);
window.onunload = function(){score.save();};

resetTicker();

function resetTicker(){
  ctx.clearRect(0,0, canvas.width, canvas.height);
  canvas.onclick = function(){checkTap();};
  current =  Math.floor(Math.random()*max+1);
  ticks = 0;
  finish = Date.now()+(current*1000);
  drawFace();
  centerText('Click in '+current+' Seconds', halfx , radius*0.5,'black');
  writescore();
  timer = setInterval(drawClock, (1000/fps));
}

function centerText(text,x,y, colour){
ctx.font = '40pt Calibri';
  ctx.textAlign="left";
  ctx.textBaseline="";
  ctx.fillStyle = colour;
  var textsize = ctx.measureText(text).width/2;
  ctx.fillText(text,x - textsize, y);
}

function drawClock() {
  ticks++;
  drawTime();
  drawNumbers();
  checkTime();
}
function drawNumbers() {
  var ang;
  var num;
    ctx.translate(halfx, radius*2);
  ctx.font = radius*0.15 + "px Calibri";
  ctx.textBaseline="middle";
  ctx.textAlign="center";
  for(num = 1; num < 13; num++){
    ang = num * Math.PI / 6;
    ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang);
    ctx.fillText((num*5).toString(), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, radius*0.85);
    ctx.rotate(-ang);
  }
    ctx.translate(-halfx, radius*-2);
}
function drawFace() {
  ctx.beginPath();
  ctx.arc(halfx , radius*2, radius, 0, 2*Math.PI);
  ctx.fillStyle = 'white';
  ctx.fill();
  drawEdge('black',6);
  ctx.beginPath();
  ctx.arc(halfx , radius*2, radius*0.05, 0, 2*Math.PI);
  ctx.fillStyle = 'black';
  ctx.fill();
}

function drawEdge(colour, size){
  ctx.beginPath();
  ctx.arc(halfx , radius*2, radius, 0, 2*Math.PI);
  ctx.strokeStyle = colour;
  ctx.lineWidth = size;
  ctx.stroke();
}

function drawTime(){
ctx.strokeStyle='rgba(20,20,20,0.1)';
    pos=(ticks/fps*Math.PI/30);
    length = radius*0.9;
    width = radius*0.02;
    ctx.translate(halfx, radius*2);
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0,0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
    ctx.translate(-halfx, radius*-2);
}

function checkTap(){
  clearInterval(timer);
  if(Date.now() < (finish-lean)){
     //run failure undertime
     outcome('under');
  }else if(Date.now() > (finish+lean)){
     //run failure overtime
     outcome('over');
  }else{
     outcome('win');
  }
}

function checkTime(){
  if(Date.now() > (finish+lean)){
     clearInterval(timer);
     //run failure overtime
     outcome('over');
  }
}

function writescore(){
  ctx.fillStyle = 'white';
  ctx.fillRect(0,radius*3.05,canvas.width,radius*0.8);
  centerText('Score: '+score, halfx , radius*3.5,'black');
}


function outcome(res){
  ctx.fillStyle = 'white';
  ctx.fillRect(0,0,canvas.width,radius);
switch(res){
  case 'win':
    max = max *1.2 %60;
    var diff = (Date.now()-finish);
    if(diff < (lean/20) && diff > -(lean/20)){
      score.alter(5);//if it's perfect triple points :)
      drawEdge('green',20);
      centerText('Perect!! '+current+'s', halfx, radius*0.5, 'green');
    }else{
      score.alter(1);
      drawEdge('green',10);
      centerText('You did it! ~'+current+'s', halfx, radius*0.5, 'green');
    }
    break;
  case 'over':
    score.set(0);
    drawEdge('red',10);
    centerText('Time\'s up '+current+'s', halfx, radius*0.5, 'red');
    break;
  case 'under':
    score.set(0);
    drawEdge('orange',10);

    centerText(((Date.now()-finish+(current * 1000))/ 1000).toPrecision(2)+'s instead of '+current+'s', halfx, radius*0.5, 'red');
    break;
  default:
    //error
    break;
  }
writescore();
canvas.onclick = function(){resetTicker();}
}

</script>