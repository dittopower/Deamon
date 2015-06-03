<?php //Load Template
	$layers = substr_count($_SERVER["PHP_SELF"],"/");
	$home = "";
	if($layers <= 1){
		$home = "./";
	}else{
		for($i = 1;$i < $layers;$i++){
			$home .= "../";
		}
	}
	require $home."hidden/deamon.php";
	
?>
<!-- START content -->


<html>
<head>
	<style>
	html{
		background:rgb(0,0,0);
	}
	body{
		margin:0;
	}
	.headbar{
		border-style: double;
		border-color: black;
		border-bottom-width: 5px;
		border-top-width: 0;
		border-left-width: 0px;
		border-right-width: 4px;
		color:black;
		display:inline-block;
		overflow:hidden;
		width:350px;
		height:100px;
		font-size: 2.5em;
		border-radius: 0px 0px 50px 0px;
		background:rgba(255,255,255,0.9);
		padding-left:30px;
	}
	.headbar:hover{
		background:rgba(200,0,0,0.9);
	//	border-color:white;
	}
	.linkbar{
		vertical-align:top;
		display:inline-block;
		width:100px;
		height:50px;
		font-size: 2em;
		color:white;
		text-align:center;
		text-decoration:none;
	}
	.linkbar:hover{
		background:rgba(200,0,0,0.8);
	}
	.linktitle{
		vertical-align: bottom;
	}
	.linksbar{
		background:rgba(0,0,0,0.5);
		vertical-align:top;
		display:inline-block;
		border-style: double;
		border-color: white;
		border-bottom-width: 5px;
		border-top-width: 0px;
		border-left-width: 0px;
		border-right-width: 5px;
		border-radius:0px 0px 30px 5px;
		height:50px;
		overflow:hidden;
	}
	header{
		border-top: white solid 5px;
		position:fixed;
		z-index:100;
	}
	footer{
		border-bottom: white solid 5px;
		position:fixed;
		z-index:100;
		bottom:0;
		right:0;
	}
	.account_pannel{
		display:inline-block;
		height:50px;
		font-size: 2em;
		color:white;
		text-align:center;
		text-decoration:none;
		padding-left:20px;
		padding-right:20px;
		background:rgba(0,0,0,0.5);
		border-style: double;
		border-color: white;
		border-bottom-width: 0px;
		border-top-width: 5px;
		border-left-width: 5px;
		border-right-width: 0px;
		border-radius:30px 0px 0px 0px;
	}
	
	#page{
		background:white;
		position:relative;
		left:5%;
		top:130px;
		width:90%;
		height:100%;
	}
	</style>
</head>
<body>

<header>
<a href=''><div class='headbar' ><h1 style='display:inline;'>Deamon</h1></div></a><span class=linksbar><a href='/tech' class='linkbar'><div class='linktitle' >Tech</div></a><a href='/games' class='linkbar'><div class='linktitle' >Games</div></a><a href='/code' class='linkbar'><div class='linktitle' >Code</div></a></span>
</header>
	
	<footer>
		<div class='account_pannel'>
			<?php
				if(!isUser()){?>
					<form id='userForm' method='POST' <?php if(isset($e_login)){
						echo "style='border: red 1px solid;background: rgba(250,0,0,0.5);'";}?>>
						<input type='text' name='username' placeholder='Username'>
						<input type='password' name='password' placeholder='Password'>
						<input type='submit' value='>'>
				<?php }else{ ?>
					<form id='userForm' method='POST'>
						<input name='logout' hidden>
						<input id='logoutbtn' type='submit' value='Logout'>
				<?php } ?>
					</form>
		</div>
	</footer>
	<div id='page'></div>
</body>