<?php
require("../functions.php");

	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}

	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
		exit();
	}
		
	if(isset($_GET["sort"]) && isset($_GET["direction"])) {
		$sort = $_GET["sort"];
		$direction = $_GET["direction"];
	} else {
		$sort = "heading";
		$direction = "ascending";
	}

require("../header.php");
?>

<div class="container">
	<ul class="nav nav-pills nav-stacked">
		<li role="presentation"><a href="createpost.php">Uus toote lisamine</a></li>
		<li role="presentation" class="active"><a href="#">Minu üleslaetud kuulutuste vaatamine</a></li>
	
	</ul>
	<br><br>