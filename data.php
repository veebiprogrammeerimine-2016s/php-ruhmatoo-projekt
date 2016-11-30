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
		
			<div class="box">
				<p>
					Tere tulemast <a><?php if(!isset($_SESSION["userFirstName"])){
						
						echo $_SESSION["userEmail"];
						
					} else {
						echo $_SESSION["userFirstName"];
					}
					?></a>!
						<a href="?logout=1">logi välja</a>
				</p>

		
				<p>Datalehe sisu</p>
			
			</div><!--.box-->
		
		</div><!--.wrapper-->
		<footer>Footer</footer>
	</body>
</html>