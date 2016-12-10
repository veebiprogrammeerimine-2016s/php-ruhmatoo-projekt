<?php
	
	require("functions.php");
	
	
	//kui ei ole kasutaja id'd
	
	if(!isset ($_SESSION["userId"])){
	
		//suunan sisselogimise lehele 
		header("Location: login2.php");
		exit();
		
	}

	//kui on ?logout aadressireal siis login v�lja
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login2.php");
		exit();
	}
?>


<html>
<head>
	<meta charset="utf-8">
	<title>"nimi"</title>
	<meta name="description" content="SoundScape">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	

</head>

<body>

	<header>
		<div class="jumbotron">
			<div class="container">
				<h1>"nimi"</h1><br>
				<h4>Signed in as <a href="user.php"><?=$_SESSION["userEmail"];?></a></h4>
				<h4><a href="?logout=1">Sign out</a></h4>
			</div> 
		
		</div> 

	</header>