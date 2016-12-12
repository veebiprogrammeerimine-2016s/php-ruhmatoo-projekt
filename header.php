
<!DOCTYPE html>
<html>
<head>
	<title>Raamaturiiul</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" > 
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" > -->
	<link rel="stylesheet" href="../style/custom.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script> 	
</head>

<div class="container">

<body>
<!--PÄIS-->

<nav class="navbar navbar-default navbar-static-top">
	<div class="navbar-header ">
    <!-- logo -->
		<a class="navbar-brand" href="books.php"><img alt="Brand" src="../image/logo.gif"></a>
    </div>
</nav>
 <?php
$quest = "";
$_GET["logout"] = "";
if (!isset($_SESSION["userId"])){
	$quest = TRUE;
	echo "Tere külaline!";
}else{
	echo "Tere " . $_SESSION["username"];
}
?>
<div class="content center-block">
<div class="container-fluid" >
     
	<div class="row ">
	
		<ul id="button" class="nav nav-pilss nav-justified">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
<?php if(!isset($_SESSION["userId"])){ ?>
			<li><a href="home.php" class="button btn btn-default" role="button">Avaleht</a></li>
			<li><a href="books.php" class="button btn btn-default" role="button">Raamatud</a></li>
			<li><a href="join.php" class="btn btn-default" role="button">Liitu</a></li>
			<li><a href="login.php" class="btn btn-default" role="button">Logi sisse</a></li>
			
<?php } else { ?>
			<li><a href="user.php"  class="btn btn-default" role="button" >Sinu riiul</a></li>
			<li><a href="books.php" class="btn btn-default " role="button" >Otsi raamatuid</a></li>
			<li><a href="add.php" class="btn btn-default" role="button">Paku raamatuid</a></li>
			<li><a href="inbox.php" class="btn btn-default" role="button">Sinu teated</a></li>
			<li><a href="login.php" class="btn btn-default" role="button">Logi välja</a></li>


<?php } ?>
		</ul>	
	
	</div>
	
<?php echo "<a href=\"javascript:history.go(-1)\">TAGASI</a>";	
?>	

</div>