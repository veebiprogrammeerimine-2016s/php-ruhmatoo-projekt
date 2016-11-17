<?php

	require("functions.php");
	
	require("class/User.class.php");
	$User = new User($mysqli);
	
	require("class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	$loginEmailError="";
	$loginPasswordError="";
	
	// kui on sisseloginud siis suunan data lehele
	if (isset($_SESSION["userId"])) {
		header("Location:../php-ruhmatoo-projekt/page/data.php");
		exit();
	}

	//kontroll
	if (isset ($_POST["loginEmail"])) {
		
		if (empty($_POST["loginEmail"]))  {
			
			$loginEmailError = "<br><span style='color: red'>Sisesta e-mail</span>";
		}
		
	}
	
	if (isset ($_POST["loginPassword"])) {
		if (empty($_POST["loginPassword"]))  {
			
			$loginPasswordError = "<br><span style='color: red'>Parool jäi sisestamata</span>";
		}
	}
	
	////
	//sisselogimise kutsumine
	if(isset($_POST["loginEmail"])  &&
	   isset($_POST["loginPassword"]) &&
	   !empty($_POST["loginEmail"]) &&
	   !empty($_POST["loginPassword"])
	   ) {
		   
		  $User->login($Helper->cleanInput($_POST["loginEmail"]), $Helper->cleanInput($_POST["loginPassword"])); 
		  
	}

	
	
	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>vahekaardi tiitel</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">		
		
		<!-- jQuery -->	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


		
	</head>
	<body>


    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Projekt</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a>Logi sisse, et saada rohkem privileege</a></li>
		  </ul>
			
			<form class="navbar-form navbar-right" method="POST">
				<div class="form-group">
					<input name="loginEmail" type="text" class="form-control input-sm" placeholder="Email" value = "<?php if(isset($_POST['loginEmail'])) { echo $_POST['loginEmail']; } ?>">
					<input name="loginPassword" type="password" class="form-control input-sm" placeholder="Parool">
				</div>
				<button type="submit" class="btn btn-sm btn-success">Logi sisse</button>
			</form>


        </div><!--/.nav-collapse -->
      </div>
    </nav>
	<br><br>
    <!-- Begin page content -->
    <div class="container">
		<style>

		</style>
      <div class="page-header">
        <h1>Changelog</h1>
      </div>
      <p class="lead"><?php echo $loginEmailError; echo $loginPasswordError; ?><code>v0.1 login, signup</code></p>
	  <p class="lead"><?php echo $loginEmailError; echo $loginPasswordError; ?><code>v0.2 added upload</code></p>
    </div>

<?php require("footer.php"); ?>