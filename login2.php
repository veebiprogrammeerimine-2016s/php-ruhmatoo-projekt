<?php
	
	require("functions.php");
	
	//kui on juba sisse loginud, suunan data lehele
	if(isset ($_SESSION["userId"])){
	
		//suunan sisselogimise lehele 
		header("Location: data.php");
		exit();
		
	}
	
	
	$loginEmail="";
	$loginEmailError="";
	$loginPasswordError="";	
	
	$signupEmailError="";
	$signupPasswordError="";
	$signupNameError="";
	$signupFamilyError="";
	
	$signupName="";
	$signupFamily="";
	$signupEmail="";
	$gender="";
	
	if(isset($_POST["loginEmail"])){
		if(empty($_POST["loginEmail"])){
			$loginEmailError="E-mail is missing";
		}else{
			$loginEmail=$_POST["loginEmail"];
		}
	}
	
	if(isset($_POST["loginPassword"])){
		if(empty($_POST["loginPassword"])){
			$loginPasswordError="Password is missing";
		}else{
			$loginPassword=$_POST["loginPassword"];
		}
	}
	
	
	
	if(isset($_POST["signupEmail"])){
		if(empty($_POST["signupEmail"])){
			$signupEmailError="E-mail is required";
		}else{
			$signupEmail=$_POST["signupEmail"];
		}	
	}

	
	if(isset($_POST["signupPassword"])){
		if(empty($_POST["signupPassword"])){
			$signupPasswordError="Password is required";
		}else{
			if(strlen($_POST["signupPassword"]) < 8 ){
				$signupPasswordError = "Password needs to be at least 8 characters";				
			}			
		}
	}
	
	if(isset($_POST["signupName"])){
		if(empty($_POST["signupName"])){
			$signupNameError="First name is mandatory";
		}else{
			$signupName=$_POST["signupName"];
		}
	}
	
	if(isset($_POST["signupFamily"])){
		if(empty($_POST["signupFamily"])){
			$signupFamilyError="Last name is mandatory";
		}else{
			$signupFamily=$_POST["signupFamily"];
		}
	}
	
	if(isset($_POST["gender"])){
		if(!empty($_POST["gender"])){
			$signupSex = $_POST["gender"];
		}
	} 
	
	
	if (isset($_POST["signupEmail"]) &&
		isset($_POST["signupName"]) &&
		isset($_POST["signupFamily"]) && 
		isset($_POST["signupPassword"]) &&
		isset($_POST["gender"]) &&
		
		$signupEmailError == "" && 
		empty($signupPasswordError) &&
		empty($signupNameError) &&
		empty($signupFamilyError))
		{
		
		echo "You have successfully registered <br>";
		
		//echo "email: ".$signupEmail."<br>";
		//echo "first name: ".$signupName."<br>";
		//echo "last name: ".$signupFamily."<br>";
		//echo "gender: ".$gender."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		signUp($signupEmail, $password, $signupName, $signupFamily, $gender);
	}
	
	$error="";
	if(isset($_POST["loginEmail"]) && isset ($_POST["loginPassword"]) &&
		!empty($_POST["loginEmail"]) && !empty($_POST["loginPassword"])
		){
			$error=login($_POST["loginEmail"], $_POST["loginPassword"]);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Audify</title>
	<meta name="description" content="Audify">
	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">



</head>

<style>
.error {color: #FF0000;font-size:14px}
</style>

<body>

<body background="images/city-wallpaper-18.jpg" height="22px"/>

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
		  <a class="navbar-brand" href="#"><img src="images/audify_600x220.png" height="22px"/></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
			
		  </ul>
		  <form class="navbar-form navbar-left">
			<div class="form-group">
			  <input type="text" class="form-control" placeholder="Search">
			</div>
			
		  </form>
		  <ul class="nav navbar-nav navbar-right">
			
			
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<header><center>
		<!--<div class="jumbotron">-->
			<div class="container">
				<br><br><br><br>
				<img src="images/audify.png"/>
				<div class="row">
				  <div class="col-md-4 col-md-offset-4">
					<div class="input-group">
					  <input type="text" class="form-control" placeholder="Search for tracks...">
					  <span class="input-group-btn">
						<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
					  </span>
					</div><!-- /input-group -->
				  </div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
				
				<br><br>
				
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1">Register</button>
				<div class="modal fade" id="modal-1">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							 <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>						
							</div>
							<div class="modal-body">
								<center>
								<h2>Register</h2>
						
								<form method="POST">
									
									<input name="signupEmail" placeholder="E-mail" type="text" value="<?=$signupEmail;?>"><span class="error"> <?php echo $signupEmailError; ?></span> <br><br>
									
									<input name="signupPassword" placeholder="Password" type="password"><span class="error"> <?php echo $signupPasswordError; ?></span> <br><br>
									
									<input name="signupName" placeholder="First name" type="text"><span class="error"> <?php echo $signupNameError; ?></span> <br><br>
									
									<input name="signupFamily" placeholder="Last name" type="text"><span class="error"> <?php echo $signupFamilyError; ?></span> <br><br>
									
									<h4>Gender</h4>
									
									<input type="radio" name="gender" value="Male" checked> Male
									
									<input type="radio" name="gender" value="Female"> Female <br><br>
									
									<input class="btn btn-primary btn-sm" type="submit" value="Register">
									
								</form>
								</center>
							</div>

							<div class="modal-footer">
								<a href="" class="btn btn-default" data-dismiss="modal">Close</a>						
							</div>
						</div>
					</div>
				</div>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-2">Sign in</button>
				<div class="modal fade" id="modal-2">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							 <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>						
							</div>
							<div class="modal-body">
								<center>
								<h2>Sign in</h2>
						
								<form method="POST">
									
									<input name="loginEmail" placeholder="E-mail" type="text" value="<?=$loginEmail;?>"><span class="error"> <?php echo $loginEmailError; ?></span> <br><br>
									
									<input name="loginPassword" placeholder="Password" type="password"><span class="error"> <?php echo $loginPasswordError; ?></span> <br><br>
									
									<input class="btn btn-primary btn-sm" type="submit" value="Sign in">
									
								</form>
								</center>
							</div>

							<div class="modal-footer">
								<a href="" class="btn btn-default" data-dismiss="modal">Close</a>						
							</div>
						</div>
					</div>
				</div>
				
				
				
				</center>
			</div> 
		<!--</div>-->
	</center></header>
	

	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>