<?php 

/// LOGIN SCREEN ////////////////////////////////////////////////////////////////////////

	require("functions.php");
	
	// kui on juba sisse loginud siis suunan data lehele
	if (isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: data.php");
		exit();
		
	}
	
	
	// MUUTUJAD
	$loginEmailError = "";
	$loginEmail = "";
	$loginPasswordError = "";
	$loginPassword = "";
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupEmail = "";
	$signupGender = "";
	
		// on üldse olemas selline muutja
	if( isset( $_POST["loginEmail"] ) ){
		
		//jah on olemas
		//kas on tühi
		if( empty( $_POST["loginEmail"] ) ){
			
			$loginEmailError = "This area is required";
			
		} else {
			
			// email olemas 
			$loginEmail = $_POST["loginEmail"];
			
		}
		
	} 
	
	if( isset( $_POST["loginPassword"] ) ){
		
		if( empty( $_POST["loginPassword"] ) ){
			
			$loginPasswordError = "Password is required";
			
		} else {
			
			// siia jõuan siis kui parool oli olemas - isset
			// parool ei olnud tühi -empty
			
			// kas parooli pikkus on väiksem kui 8 
			if ( strlen($_POST["loginPassword"]) < 8 ) {
				
				$loginPasswordError = "Password has to be at least 8 characters";
			
			}
			
		}
		
	}

	// on üldse olemas selline muutja
	if( isset( $_POST["signupEmail"] ) ){
		
		//jah on olemas
		//kas on tühi
		if( empty( $_POST["signupEmail"] ) ){
			
			$signupEmailError = "This area is required";
			
		} else {
			
			// email olemas 
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	} 
	
	if( isset( $_POST["signupPassword"] ) ){
		
		if( empty( $_POST["signupPassword"] ) ){
			
			$signupPasswordError = "Password is required";
			
		} else {
			
			// siia jõuan siis kui parool oli olemas - isset
			// parool ei olnud tühi -empty
			
			// kas parooli pikkus on väiksem kui 8 
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Password has to be at least 8 characters";
			
			}
			
		}
		
	}
	
	
	// peab olema email ja parool
	// ühtegi errorit
	
	if ( isset($_POST["signupEmail"]) && 
		 isset($_POST["signupPassword"]) && 
		 $signupEmailError == "" && 
		 empty($signupPasswordError)
		) {
		
		// salvestame ab'i
	//	echo "Saving... <br>";
		
	//	echo "email: ".$signupEmail."<br>";
	//	echo "password: ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
	//	echo "password hashed: ".$password."<br>";
		
		
		//echo $serverUsername;
		
		// KASUTAN FUNKTSIOONI
		$signupEmail = cleanInput($signupEmail);
		
		signUp($signupEmail, cleanInput($password));
		
	
	}
	
	
	$error ="";
	if ( isset($_POST["loginEmail"]) && 
		isset($_POST["loginPassword"]) && 
		!empty($_POST["loginEmail"]) && 
		!empty($_POST["loginPassword"])
	  ) {
		  
		$error = login(cleanInput($_POST["loginEmail"]), cleanInput($_POST["loginPassword"]));
		
	}
	

?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>e-Diary | Login or Sign-Up</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.html" class="logo">e-Diary</a>
					<nav id="nav">
						<a href="login.php">Home</a>
						<a href="about.php">About</a>
					</nav>
				</div>
			</header>
			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<h1>E-DIARY: <span>Accomplish more with us!<br />
					</span></h1>
					<ul class="actions">
						<h1>Login</h1>
						<form method="POST">
						
						
		<p style="color:red;"><?=$error;?></p>
	
		<input type="text" name="loginEmail" placeholder="E-Mail"  value="<?=$loginEmail;?>"> <?php echo $loginEmailError; ?>
		<br>
		<input type="password" name="loginPassword" placeholder="Password"> <?php echo $loginPasswordError; ?>
		<br><br>
		
		<input type="submit" value="Login">
		
		
	</form>
				
					<h1>Sign-Up</h1>
	<form method="POST">
		
		<input name="signupEmail" type="text" placeholder="E-Mail" value="<?=$signupEmail;?>"> <?=$signupEmailError;?>
		<br>
		<input type="password" name="signupPassword" placeholder="Password"> <?php echo $signupPasswordError; ?>
		<br><br>
		
		<input type="submit" value="Sign-Up">
		
		
	</form>
						
					</ul>
				</div>
			</section>

		<!-- One -->
			<section id="one">
				<div class="inner">
					<header>
						<h2>About us</h2>
					</header>
					<p>Sign-Up for free and carry your e-diary everywhere you go! You can access to your scheduled tasks and contacts from computer, mobile and even from Smart-TV. You dont have to worry anymore by just remembering things what you need to do on next week or next month. You can simply add in e-Diary your scheduled tasks or contacts. Sign-Up for free and enjoy! Your Brain is not a trashcan! 
					Developer: Andry Zagars
					Estonia, Tallinn </p>
					<ul class="actions">

					</ul>
				</div>
			</section>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>