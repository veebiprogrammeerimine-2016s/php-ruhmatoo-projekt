<?php

	require("../functions.php");
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	$registerEmail="";
	$loginEmailError="";
	$loginPasswordError="";
	$userError="";
	
	if (isset($_GET["success"])) {
		$userError="
				<br>
		  		<div class='alert alert-success'>
				<strong><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Oled regatud!</strong>
				</div>";
	}
	
	if (isset($_GET["duplicate"])) {
		$userError="
				<br>
		  		<div class='alert alert-danger'>
				<strong><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Email/kasutajanimi juba kasutusel</strong>
				</div>";
	}
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
	if(isset($_POST["loginUsername"])  &&
	   isset($_POST["loginPassword"]) &&
	   !empty($_POST["loginUsername"]) &&
	   !empty($_POST["loginPassword"])
	   
	   ) {
		   
		  $User->login($Helper->cleanInput($_POST["loginUsername"]), $Helper->cleanInput($_POST["loginPassword"])); 
		  
	}
	
	
	////
	//registreerimiskontrollid
	if (isset ($_POST["registerEmail"]) or
	   isset ($_POST["registerPassword"]) or
	   isset ($_POST["confirmRegisterPassword"])
	) {
		if (empty($_POST["registerEmail"]) or
		   empty($_POST["registerPassword"]) or
		   empty($_POST["confirmRegisterPassword"])
			)  {
			$userError = "
		  		<br><div class='alert alert-danger'>
				<strong>
				 <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'> </span>
				
				Kõik väljad on kohustuslikud</strong>
				</div>";
		} else {
			
		}
		
	}
	
	
	if (isset ($_POST["registerPassword"]) or
	   isset ($_POST["confirmRegisterPassword"])) {
	
	
		if($_POST["registerPassword"] != $_POST["confirmRegisterPassword"]) {
			   
			  $userError="
					<br><div class='alert alert-danger'>
					<strong>
					 <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'> </span>
					Paroolid peavad identsed olema</strong>
					</div>";
			  
		}
		
		else if(strlen($_POST["registerPassword"])<10) {
			
				$userError="
					<br><div class='alert alert-danger'>
					<strong>
					 <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'> </span>
					Parool olema vähemalt 10 tähemärgi pikkune</strong>
					</div>";
		}
	}
	

	if (isset ($_POST["registerEmail"]) or
		isset ($_POST["registerPassword"]) or
	    isset ($_POST["confirmRegisterPassword"])) {
	
	
		if (!empty($_POST["registerEmail"]) or
		   !empty($_POST["registerPassword"]) or
		   !empty($_POST["confirmRegisterPassword"])
			)  {
			if (strlen($_POST["registerEmail"])<10) {
				$userError="
					<br><div class='alert alert-danger'>
					<strong>
					 <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'> </span>
					Email liiga lühike</strong>
					</div>";
			}
		}
	}
	
	if (isset ($_POST["registerUsername"])) {
	
	
		if (!empty($_POST["registerUsername"]))  
		{
			if (strlen($_POST["registerUsername"])<3) {
				$userError="
					<br><div class='alert alert-danger'>
					<strong>
					 <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'> </span>
					Kasutajanimi peab olema vähemalt 3 tähemärki</strong>
					</div>";
			}
		}
	}
	
	
	
	
	//kõik sobis asun kutsuma registerit
	if(isset($_POST["registerEmail"])  &&
	   isset($_POST["registerPassword"]) &&
	   isset($_POST["registerUsername"]) &&
	   isset($_POST["confirmRegisterPassword"]) &&
	   !empty($_POST["registerEmail"]) &&
	   !empty($_POST["registerUsername"]) &&
	   !empty($_POST["confirmRegisterPassword"]) &&
	   !empty($_POST["registerPassword"]) &&
	   $userError==""
	   ) {
		   
		  $hashRegisterPassword = hash("sha512", $_POST["registerPassword"]);
		  $User->register($Helper->cleanInput($_POST["registerUsername"]),$Helper->cleanInput($_POST["registerEmail"]), $Helper->cleanInput($hashRegisterPassword)); 
		  
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
          <a class="navbar-brand" href='../index.php'><span style="font-size: 30px;
			font-family: Arial, Verdana, Sans-serif;">iksd.ee  </span></h2><span class="glyphicon glyphicon-sunglasses"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
			<form class="navbar-form navbar-right" method="POST">
				<div class="form-group">
					<input name="loginUsername" type="text" class="form-control input-sm" placeholder="Username" value = "<?php if(isset($_POST['loginUsername'])) { echo $_POST['loginUsername']; } ?>">
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
	<br><br>
		<div class="col-md-4 col-md-offset-3">	  
			<div class="page-header">
				<h1>Uue konto loomine</h1>
			</div>
		<form method="POST">
		  <div class="form-group">
			<span class="glyphicon glyphicon-envelope"></span>  <label> Email</label>
			<input type="email" class="form-control input-sm" name="registerEmail" placeholder="Sisesta email" value="<?php if(isset($_POST['registerEmail'])) { echo $_POST['registerEmail']; } ?>" /required>
			<p class="help-block"></p>
		  </div>
		  <div class="form-group">
			<span class="glyphicon glyphicon-user"></span>    <label>  Kasutajanimi</label>
			<input type="text" class="form-control input-sm" name="registerUsername" placeholder="Sisesta kasutajanimi" value="<?php if(isset($_POST['username'])) { echo $_POST['username']; } ?>" /required>
			<p class="help-block"></p>
		  </div>
		  <div class="form-group">
			<span class="glyphicon glyphicon-asterisk"></span>   <label> Parool</label>
			<input type="password" class="form-control input-sm" name="registerPassword" placeholder="Sisesta parool" /required>
			<p class="help-block"></p>
		  </div>
		  <div class="form-group">
			<span class="glyphicon glyphicon-asterisk"></span>    <label> Kinnita parool</label>
			<input type="password" class="form-control input-sm" name="confirmRegisterPassword"; placeholder="Korda parooli" /required>
			<p class="help-block"></p>
		  </div>

		  <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-ok">  </span>  Salvesta</button>
		</form>
		
		<?php echo $userError; ?>
		
		</div>
	  
    </div>

<?php require("../footer.php"); ?>