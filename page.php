<html lang="en">
<?php
	include "hidden/code.php";
	include "hidden/login.php";
?>
<head>
<!-- Site Icon -->
<link rel="shortcut icon" type="image/x-icon" href="http://deamon.netau.net/res/site.ico">
<link rel="icon" type="image/png" href="http://deamon.netau.net/res/site.ico">


<!-- CSS -->
<link href="http://deamon.netau.net/this.css" rel="stylesheet" type="text/css"/>
<?php if (file_exists("./local.css")){?>
<link href="./local.css" rel="stylesheet" type="text/css"/>
<?php } ?>


<!-- Script -->
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<?php include_once("hidden/udata.php"); ?>
<?php if (file_exists("./local.js")){?>
<script src="./local.js" type="text/javascript"></script>
<?php } ?>


<title><?php echo pagename(); ?></title>
</head>

<body>
<?php include 'hidden/titlebar.php'; ?>
<span id=refresh></span>
<div class='page'>
<script>
page = document.getElementsByClassName("page")[0];
header = document.getElementsByTagName("header")[0];
page.style.marginTop = (header.clientHeight * 1.1);
</script>