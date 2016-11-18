<?php
$quest = "";
$_GET["logout"] = "";
if (!isset($_SESSION["userId"])){
	$quest = TRUE;
	echo "külaline";
}else{
	echo "Tere " . $_SESSION["username"];
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Raamaturiiul</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
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
	

<div class="container-fluid" >
     
	<div class="row center-block">
	 
		<ul class="nav nav-pilss nav-justified">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
<?php 
		
		if($quest == TRUE || $_GET["logout"]){
			$header = '<li><a href="home.php" class="btn btn-default" role="button">Avaleht</a></li>';
			$header .= '<li><a href="books.php" class="btn btn-default" role="button">Raamatud</a></li>';
			$header .= '<li><a href="join.php" class="btn btn-default" role="button">Liitu</a></li>';
			$header .= '<li><a href="login.php" class="btn btn-default" role="button">Logi sisse</a></li>';
			echo $header;
		}
		if($quest == ""){
			$header = '<li><a href="user.php" class="btn btn-default" role="button">Sinu riiul</a></li>';
			$header .= '<li><a href="books.php" class="btn btn-default" role="button">Otsi raamatuid</a></li>';
			$header .= '<li><a href="edit.php" class="btn btn-default" role="button">Paku raamatuid</a></li>';
			$header .= '<li><a href="login.php" class="btn btn-default" role="button">Logi välja</a></li>';
			echo $header;
        }
?>
		</ul>	
	
	</div>
	
 </div>
