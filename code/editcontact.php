	<?php
		require("functions.php");
		if(isset($_POST["update"])){
			
			update(cleanInput($_POST["id"]), cleanInput($_POST["contact"]));
			
			header("Location: editcontact.php?id=".$_POST["id"]."&success=true");
			exit();	
			
		}
		
		//kustutan
		elseif(isset($_POST["delete"])){
			deletetask ($_POST["id"]);
		header("Location: user.php");
		exit();
	}
		
		// kui ei ole id'd aadressireal siis suunan
		if(!isset($_GET["id"])){
			header("Location: user.php");
			exit();
		}	
		$s = getSingleContact($_GET["id"]);
		
	?>
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

							<h2><a href="data.php"> Back </a></h2>
							
							
	 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
				<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
				<label>Contact</label><br>
				<input name="contact" type="text" value="<?=$s->contact;?>">
				<br>			
				<input a href="user.php" type="submit" name="update" value="Save">
				<input type="submit" name="delete" value="Delete">
	</form>
	  


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

<head>
<link rel="stylesheet" href="pikaday.css">
<link rel="stylesheet" href="site.css">
<link rel="stylesheet" href="theme.css">
<link rel="stylesheet" href="triangle.css">
</head>

