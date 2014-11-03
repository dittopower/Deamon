<head>
	<?php
		if (isset($_GET['code'])){
			$num = $_GET['code'];
		}
	?>
	<link rel="shortcut icon" type="image/x-icon" href="http://deamon.netau.net/res/site.ico">
	<link rel="icon" type="image/png" href="http://deamon.netau.net/res/site.ico">
	<link href="http://deamon.netau.net/this.css" rel="stylesheet" type="text/css"/>
	<title>Deamonic Request: <?php echo $num;?></title>
	
	<?php if (isset($_GET['code'])){ ?>
	<style>
	body{
		background:none;
		border:none;
		text-align:center;
		color:silver;
		margin:0;
		position:absolute;
		width:100%;
		height:100%;
		left:0;
		top:0;
	}
	h2{
		position:absolute;
		width:60%;
		height:15%;
		left:20%;
		top:1%;
		margin:0;
	}
	h1{
		position:absolute;
		width:16%;
		height:10%;
		left:42%;
		top:47%;
		margin:0;
		font-size:300%;
	}
	p{
		position:absolute;
		width:40%;
		height:5%;
		left:30%;
		bottom:1%;
		margin:0;
	}
	</style>
</head>


<body>
	<div id="space">
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
	</div>
	
	<h2>Behold Mortal You have been thrown to the void by</h2>
	<h1>Error <?php echo $num; ?> </h1>
	<p>Taunting Pictures Coming Eventually....</p>
	
	<?php 	
		}else{
	?>
		<iframe width="100%" height="100%" src="//www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1" frameborder="0" allowfullscreen ></iframe>
	<?php
		}
	?>
</body>