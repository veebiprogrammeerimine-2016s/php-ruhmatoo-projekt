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
		
	
	
	<?php if(isset($_SESSION["userId"])){ ?>
		<div class="container">
	
			<div class="row">
	
				<div class="col-sm-12 col-sm-offset-0">
	
					<nav class="navbar navbar-inverse"> 
				
						<h2 class="navbar-text navbar-left">Tere,<a href="user.php"> <?=$_SESSION["username"];?></a>!</h2>
						<p class="navbar-text navbar-left"> 
							<a href="sneakermarket.php">Esileht</a> | <a href="profile.php">Minu profiil</a> | <a href="data.php">Minu kuulutused/loo kuulutus</a> | <a href="?logout=1">Logi välja</a>
						</p>
					</nav>
				</div>
			</div>
		</div>	
	<?php } else { ?>
		<div class="container">
	
			<div class="row">
	
				<div class="col-sm-12 col-sm-offset-0">
	
					<nav class="navbar navbar-inverse"> 
				
						<h3 class="navbar-text navbar-left">SneakerMarket</h3>
						<h4 class="navbar-text"> 
							| <a href="sneakermarket.php">Esileht</a> | <a href="signup.php">Loo Kasutaja</a> | <a href="login.php">Logi sisse</a> | 
						</h4>
						
						<form class="form-inline col-sm-6 navbar-right" method="POST">
							
							<div class="form-group">
								<input class="form-control" name="loginemail" placeholder="Kasutaja" type="text">
							</div>
							
							<div class="form-group">
								<input class="form-control" name="loginpassword" placeholder="Parool" type="password">
							</div>
								
							<input class="btn btn-primary btn-block visible-xs-block" type="submit" value="Logi Sisse">
							<input class="btn btn-primary btn-sm hidden-xs" type="submit" value="Logi Sisse">
							
							<?php //require("");?>
						</form>
					</nav>
				</div>
			</div>
		</div>	
	<?php } ?>

	

</body>