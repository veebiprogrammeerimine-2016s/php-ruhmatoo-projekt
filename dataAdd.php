<?php
	require("functions.php");
	
	if (!isset($_SESSION["userId"])) {
		
		header("Location: login.php");
		exit();
	}
	
	
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
	}

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>WasteChase</title>
		<link type="text/css" rel="stylesheet" href="stylesheet.css" />
	</head>
	
	<body>
		<header>
			<h1>WasteChase</h1>
			<p> Chasing your Spending</p>
		</header>
		
		<div class="wrapper">
		
			<div class="menu"> 
		
				<ul>
				  <li><a href="data.php">Data</a></li>
				  <li><a href="dataItems.php">data Items</a></li>
				  <li><a class="active" href="dataAdd.php">data Add</a></li>
				  <li><a href="dataEdit.php">data Edit</a></li>
				  <li id="logout"><a href="?logout=1" >logi välja</a></li>
				</ul>
			
			</div><!--.menu-->
		
			<div class="insert box" >
			
				<p>Siin lehel toimub sissekannete lisamine</p>
				
				<form method="POST" >
	
					<label>Siia sisestame..</label><br>
					<input type="text" >
					<br><br>
					
					<input type="submit" value="Sisesta">

				</form>
				
			</div><!--.insert box-->
			
		
		</div><!--.wrapper-->
		<footer>Footer</footer>
	</body>
</html>