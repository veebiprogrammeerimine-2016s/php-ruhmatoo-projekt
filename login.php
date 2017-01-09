<?php

	require("functions.php");
	
	if (isset($_SESSION["userId"])) {
		
		header("Location: data.php");
		exit();
	}


	
	//MUUTUJAD
	$loginEmail = "";
	$loginEmailError = "*";
	$loginPasswordError = "*";
	$signupEmail = "";
	$signupEmailError = "*";
	$signupPasswordError = "*";
	$firstName = "";
	$surname = "";
	$gender = "private";


	
	//kas keegi vajutas nuppu ja see on olemas
	
	if (isset ($_POST["loginEmail"])) {
		
		if (empty ($_POST["loginEmail"])) {
			
			$loginEmailError="* Väli on kohustuslik";
		} else {
			
			$loginEmail = cleanInput($_POST["loginEmail"]);
		}
	}
	
	if (isset ($_POST["loginPassword"])) {
		
		if (empty ($_POST["loginPassword"])) {
			
			$loginPasswordError="* Väli on kohustuslik";

		}
	}
	
	if (isset ($_POST["signupEmail"])) {
		
		if (empty ($_POST["signupEmail"])) {
			
			$signupEmailError="* Väli on kohustuslik";
		} else {
			
			$signupEmail = cleanInput($_POST["signupEmail"]);
		}
	}
	
	if (isset ($_POST["signupPassword"])) {
		
		if (empty ($_POST["signupPassword"])) {
			
			$signupPasswordError="* Väli on kohustuslik";
		
		} else {
			
			if (strlen ($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError="* Parool peab olema vähemalt 8 tähemärki pikk";
			}
		}
	}

	if (isset ($_POST["firstName"])) {
			
			$firstName = cleanInput($_POST["firstName"]);
	}

	if (isset ($_POST["surname"])) {
			
			$surname = cleanInput($_POST["surname"]);
	}
	
	if (isset ($_POST["gender"])) {
		
		$gender = $_POST["gender"];
	}

	if ( $signupEmailError == "*" &&
		 $signupPasswordError == "*" &&
		 isset($_POST["signupEmail"]) &&
		 isset($_POST["signupPassword"]) &&
		 isset($_POST["firstName"]) &&
		 isset($_POST["surname"])
	) {
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		$User->signup($signupEmail, $password, $firstName, $surname, $gender);
		
		$signupEmail = "";
		$firstName = "";
		$surname = "";
		
	}
	
	$notice = "";
	
	if ( isset($_POST["loginEmail"]) &&
		 isset($_POST["loginPassword"]) &&
		 !empty($_POST["loginEmail"]) &&
		 !empty($_POST["loginPassword"])
	) {
		$notice = $User->login($_POST["loginEmail"], $_POST["loginPassword"]);
	}


?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>WasteChase</title>
		<link type="text/css" rel="stylesheet" href="stylesheet.css" />
	</head>
	
	<body>
		<header>
			<h1>WasteChase</h1>
			<p> Chasing your Spending</p>
		</header>
		<div class="wrapper">
		
			<div class="login box">
			
				<h2>Logi sisse</h2>
				<p style="color:red;" ><?=$notice;?></p>
				
				<form method="POST">
				
					<div class="inputBox" ><input name="loginEmail" placeholder="e-mail" value="<?=$loginEmail;?>" type="email" class="loginPageInput" > <?php echo $loginEmailError; ?></div>
					
					<div class="inputBox" ><input name="loginPassword" placeholder="Parool" type="password" class="loginPageInput" > <?php echo $loginPasswordError; ?></div>
					
					<input type="submit" value="Logi sisse" >
				
				</form>

			</div><!--.loginBox-->
			
			<div class="invitation">
				<p>Kui te ei ole veel kasutajaks registreerinud siis täitke palun alljärgnev vorm ning saage meie sõbraliku kogukonna liikmeks!</p>
			</div><!--.invitation-->
			
			<div class="signUp box">
			
				<h2>Loo kasutaja</h2>

				<form method="POST">
				
					<div class="inputBox" ><input name="signupEmail" placeholder="e-mail" value="<?=$signupEmail;?>" type="email" class="loginPageInput" > <?php echo $signupEmailError; ?></div>
					
					<div class="inputBox" ><input name="signupPassword" placeholder="Parool" type="password" class="loginPageInput" > <?php echo $signupPasswordError; ?></div>
					
					<div class="inputBox" ><input name="firstName" placeholder="eesnimi" value="<?=$firstName;?>" type="text" class="loginPageInput" ></div>
					
					<div class="inputBox" ><input name="surname" placeholder="perekonnanimi" value="<?=$surname;?>" type="text" class="loginPageInput" ></div>
					
					<div class="radioInputs" >

						<?php if ($gender == "male") { ?>
							<input type="radio" name="gender" value="male" checked> Mees<br>
						<?php } else { ?>
							<input type="radio" name="gender" value="male" > Mees<br>
						<?php } ?>
						
						<?php if ($gender == "female") { ?>
							<input type="radio" name="gender" value="female" checked> Naine<br>
						<?php } else { ?>
							<input type="radio" name="gender" value="female" > Naine<br>
						<?php } ?>
						
						<?php if ($gender == "private") { ?>
							<input type="radio" name="gender" value="private" checked> Ei avalda<br>
						<?php } else { ?>
							<input type="radio" name="gender" value="private" > Ei avalda<br>
						<?php } ?>
					
					</div>
					
					<br><br>

					<input type="submit" value="Loo kasutaja">

				</form>
			
			</div><!--.signUpBox-->
		</div><!--.wrapper-->
		<footer>Footer</footer>
	</body>
</html>