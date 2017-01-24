<!DOCTYPE html>
<html lang="en">
<head>
<title>Pakutavad tooted</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
</head>
<body>
		
	<?php if(isset($_SESSION["userId"])){ ?>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-sm-offset-0">
					<nav class="navbar navbar-default"> 
						<h3 class="navbar-text navbar-left">Tere tulemast  <?=$_SESSION["username"];?></h3>
						<p class="navbar-text navbar-default navbar-right"> 
							<a href="productselect.php">Tooted</a> <> <a href="data.php">Paku uus toode või vaata oma tooteid</a> <> <a href="?logout=1">Logi välja<> </a>
		</p>
		</nav>
		</div>
		</div>
		</div>	
	<?php } else { ?>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-sm-offset-0">
					<nav class="navbar navbar-default"> 
						<h3 class="navbar-text navbar-left">Tooted</h3>
						<h4 class="navbar-text navbar-right"> 
							 <a href="productselect.php">Tooted</a> <> <a href="signup.php">Loo Kasutaja</a> <> <a href="login.php">Logi sisse</a> <> 
						</h4>
						
		</nav>
		</div>
		</div>
		</div>	
	<?php } ?>
	
</body>