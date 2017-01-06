<!DOCTYPE html>
<html lang="en">
<head>
<title>SneakerMarket</title>
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
		
	
	
	<?php if(isset($_SESSION["userEmail"])){ ?>
	<div class="container">
	
		<div class="row">
	
			<div class="col-sm-12 col-sm-offset-0">
	
				<nav class="navbar navbar-inverse"> 
				
					<h2 class="navbar-text navbar-left">Tere,<a href="user.php"> <?=$_SESSION["userEmail"];?></a>!</h2>
					<p class="navbar-text navbar-left"> 
						<a href="sneakermarket.php">Esileht</a> | <a href="profile.php">Minu profiil</a> | <a href="data.php">Minu kuulutused/loo kuulutus</a> | <a href="?logout=1">Logi välja</a>
					</p>
			
				</nav>
			</div>
		</div>
	</div>	
	<?php } else { ?>
		echo "lololol";
	<?php } ?>

	

</body>