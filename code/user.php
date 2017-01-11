<?php 
	
	require("functions.php");
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["message"]);
	}
	
	
	if ( isset($_POST["contact"]) && 
		!empty($_POST["contact"])
	  ) {
		  
		savecontact(cleanInput($_POST["contact"]));
		
	}
	
	if ( isset($_POST["usercontact"]) && 
		!empty($_POST["usercontact"])
	  ) {
		  
		saveUsercontact(cleanInput($_POST["usercontact"]));
		
	}
	

    $usercontacts = getAllUsercontacts();
	
?>
<head>
	<!DOCTYPE HTML>
<link rel="stylesheet" href="pikaday.css">
<html>
	<head>
		<title>e-Diary | Home</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.html" class="logo">e-Diary</a>
					<nav id="nav">
<a href="about.php"> About</a> <a href="data.php"> Home</a> <a href="user.php"> Contacts</a> <?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logout</a>
					</nav>
				</div>
			</header>
			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Main -->
			<section id="main">
				<div class="inner">
					<header class="major special">
	
<form method="POST">					
<h2>Got new contacts? How about adding them?</h2>
	<input name="contact" type="text">
	<br>
	<input type="submit" value="Save">
	
</form>
<h2>Your contacts!</h2>
<?php
    
    $listHtml = "<ul>";
	
	foreach($usercontacts as $i){
		
		
		$listHtml .= "<li>".$i->contact."</li>";
    	$listHtml .= "<td><a href='editcontact.php?id=".$i->id."'><span class='glyphicon glyphicon-pencil'></span> Change</a></td>";
	
	}

    $listHtml .= "</ul>";
	
	echo $listHtml;
	
    
?>	


		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'YYYY-MM-D',
        onSelect: function() {
            console.log(this.getMoment().format('Do MMMM YYYY'));
        }
    });
</script>
