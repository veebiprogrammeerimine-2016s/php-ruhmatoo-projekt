<!DOCTYPE html>
<html>
<head>


	<meta charset="utf-8" />
	<title>INDIEGOGO</title>
	<link href="style.css" rel="stylesheet">
</head>

<body>

<div class="wrapper">

	<header class="header">
		
		<div class="linkstyle"><a href="index.php"><img src="img/pattern.png" height="100px"></a></div>
		<div class="admin"><a href="index.php?p=5"><img src="img/house.png"  height="40px" ></a></div>
	</header>

	<menu class="menu">
		
		<table><tr><td>
		<a href="index.php?p=1">ABOUT US</a></td><td>
		<a href="index.php?p=2">SEARCH YOUR ITEM</a></td><td>
		<a href="index.php?p=3">REGISTER COMPUTER TO REPAIR</a></td><td>
		<a href="index.php?p=4">CONTACT</a></td><td>
		</td></tr></table>
	</menu>
	<div class="content">
	
		<?php
		ini_set("display_errors", 1);
		error_reporting(E_ERROR |E_WARNING| E_PARSE);
					if($_GET['p']=="1"){
						require "home.php";
					}
					if($_GET['p']=="2"){
						require('searching.php');
					}
					if($_GET['p']=="3"){
						require('data.php');
					}
					if($_GET['p']=="4"){
						require('contact.php');
					}
					if($_GET['p']=="5"){
						require('login.php');
					}
					if(!isset($_GET['p'])){
						require "home.php";
					}
					if($_GET['p']>5){
						require "home.php";
					}
					
	?>

	
		
	</div><!-- .content -->

</div><!-- .wrapper -->

</body>
</html>