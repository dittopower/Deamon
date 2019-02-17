<?php
	require_once "/var/www/html/lib.php";
?>
<head>
<script src="http://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<style>
body{
background:white;
}
</style>
</head>
<body>
<canvas id="tabletop"></canvas>


<script>
var canvas = $("#tabletop")[0];
var ctx = canvas.getContext("2d");

//need to fix this to keep it the same shape/size
scale = 1-((9/16)-(window.innerHeight/window.innerWidth))*2;

resolution = [16,9];
size = Math.min(window.innerWidth*scale/(10*resolution[0]),window.innerHeight*scale/(10*resolution[1]));
height = size*10*resolution[1];
width = size*10*resolution[0];
canvas.width = width;
canvas.height = height;
canvas.scrollIntoViewIfNeeded();
fps = 15;


//setup stuff
player = new Sprite(5,5,1,3,1,function(){
Fill_rect(this.x,this.y,this.width,this.height/3*2,"pink");
Fill_cir(this.x+this.width/2,this.y-this.height/3*0.8,this.width*0.8,"purple")
});





//actually start things
actions = setInterval(run, 1000);
renderer = setInterval(render, (1000/fps));

function run(){
//player.Step(d_rand(10),d_rand(10));
}

function render(){
ctx.clearRect(0,0, canvas.width, canvas.height);
ctx.strokeStyle = "black";
ctx.strokeRect(0,0,size*160-1,size*90-1);
player.Update();
}


function Sprite (x,y,w,h,d,draw){
this.x = x;
this.y = y;
this.X = x;
this.Y = y;
this.speed = d;
this.width = w;
this.height = h;
this.Draw = draw;
this.Move = function (x,y){
   this.X = x; this.Y = y;
}
this.Step = function (x,y){
   this.X += x; this.Y += y;
}
this.Update = function(){
//console.log(this);
if(this.X > this.x){
   this.x += Math.min(this.speed/fps,this.X-this.x);
}else if (this.X < this.x){
   this.x -= Math.min(this.speed/fps,this.x-this.X);
}
if(this.Y > this.y){
   this.y += Math.min(this.speed/fps,this.Y-this.y);
}else if (this.X < this.x){
   this.y -= Math.min(this.speed/fps,this.y-this.Y);
}
   this.Draw();
}
this.Teleport = function(x,y){
   this.X = this.x = x;
   this.Y = this.y = y;
}
}



function dm_rand(){
return Math.round(Math.random()*2-1);
}

function d_rand(s){
return dm_rand()*Math.round(Math.random()*s);
}


function Fill_rect(x,y,w,h,colour){
ctx.fillStyle = colour;
ctx.fillRect(x*size,y*size,w*size,h*size);
}
function Fill_cir(x,y,d,colour){
ctx.beginPath();
ctx.fillStyle = colour;
ctx.arc(x*size,y*size,d/2*size,0,2*Math.PI);
ctx.fill();
}
</script></body>