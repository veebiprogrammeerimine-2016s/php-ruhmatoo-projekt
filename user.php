<?php 
	
	require("functions.php");
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login2.php");
		exit();
	}
	
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login2.php");
		exit();
	}
	
?>


<html>
<head>
	<meta charset="utf-8">
	<title>Audify</title>
	<meta name="description" content="Audify">
	

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">



</head>

<header>
	<nav class="navbar navbar-inverse navbar-static-top">
	  <div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="data.php"><img src="images/audify_600x220.png" height="22px"/></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
			<li><a href="#">Upload</a></li>
		  </ul>
		  <form class="navbar-form navbar-left">
			<div class="form-group">
			  <input type="text" class="form-control" placeholder="Search">
			</div>
		  </form>
		  <ul class="nav navbar-nav navbar-right">
			
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$_SESSION["userEmail"];?><span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="user.php">User profile</a></li>
				<li><a href="#">Settings</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="?logout=1">Sign out</a></li>
			  </ul>
			</li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</header>
	<body>
		<!--<div class="jumbotron">-->
			<div class="container">
				
				<h1>User profile</h1>

				<p>
					Signed in as <?=$_SESSION["userEmail"];?>
					<a href="?logout=1">Sign out</a>
				</p>
				
				
			</div> 
		
		<!--</div> -->

	</body></html>