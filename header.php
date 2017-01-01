<?php 
	require("../CSS.php");
	
	$username = $_SESSION["userName"];
?>

<!DOCTYPE html>
<html>
	<head class="header">
		<title>TREENI.EE</title>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	</head>
	
<body>

	<nav class="navbar">
		<div class="container-fluid">
			<div class="navbar-header">
			 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="glyphicon glyphicon-user"></span>
			  </button>
			  <a class="navbar-brand" href="data.php">
				<img alt="Brand" src="../smaller_logo.png" width="300" height="200">
			  </a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav pull-right">
					 <li class="active1 navbar-text hidden-xs">
						<?php 
							echo "Oled sisse loginud kasutajaga " ;
						?>
					</li>
					<li class="active2">
						<?php 
						echo "<a href='user.php'><i><b>".$username."</b></i> </a>";
						?>
					</li>
					<li class="active3">
						<a href="data.php?logout=1">Logi välja</a>
					</li>
				</ul>
		  </div>
	 </div>
	</nav>
	