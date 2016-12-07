<?php

	require("../../config.php");
	require("functions.php");
	
	//MUUTUJAD REGISTREERIMINE
	$signupEmail = $signupPassword = $signupUsername = $signupGender = "" ; 
	$signupEmailError = $signupPasswordError = $signupUsernameError = $signupGenderError = "*";
	
	//REGISTREERIMINE
	//E-POST REGISTREERIMINE
	if (isset ($_POST["signupEmail"])) {
		if (empty($_POST["signupEmail"])) {
		$signupEmailError = "* Väli on kohustuslik!";
		} else {
		$signupEmail = $_POST ["signupEmail"];
		}
	}
	
	//PAROOL
	if(isset ($_POST["signupPassword"])) {
		if (empty ($_POST["signupPassword"])) {
		$signupPasswordError = "* Väli on kohustuslik!";
		} else {
		if (strlen ($_POST["signupPassword"]) <6)
		$signupPasswordError = "* Parool peab olema vähemalt 6 tähemärkki pikk";
		}
	}
	
	//Kasutajanimi
	if (isset ($_POST["signupUsername"])) {
		if (empty ($_POST["signupUsername"])) {
		$signupUsernameError = "* Väli on kohustuslik";
		} else {
		if (strlen ($_POST["signupUsername"]) >20) {
		$signupUsernameError = "* Kasutajanimi ei tohi olla pikkem kui 20 tähemärkki";
		} else {
		$signupUsername = $_POST ["signupUsername"];
			}
		}
	}
	
	//REGISTREERIMISE LÕPP
	if ( $signupEmailError == "*" AND
		$signupPasswordError == "*" &&
		isset($_POST["signupEmail"]) &&
		isset($_POST["signupPassword"])
	)
	if (isset($_POST["signupEmail"])&&
		!empty($_POST["signupEmail"])
		)
	
	//SALVESTAMINE
	{
	$signupPassword = hash("sha512", $_POST["signupPassword"]);
	registration($signupEmail, $signupPassword, $signupUsername, $_POST["signupGender"]);
	}	
	
?>


<!DOCTYPE html>
<html>
		
	<head>
	<title>Sisselogimise leht</title>
	</head>
	
	<body>
	<h1>Loo kasutaja</h1>
	<form method="POST">
	<label></label>
		
		<!--EMAIL REGISTREERIMINE-->
		<br><label for="signupEmail">E-post</label></br>
		<input name="signupEmail" type = "signupEmail" placeholder="E-post">
		<?php echo $signupEmailError;?><br>
		
		<!--PAROOL REGISTREERIMINE-->
		<br><label for="signupPassword">Parool</label></br>
		<input name="signupPassword" type = "password" placeholder="Parool">
		<?php echo $signupPasswordError;?><br>
		
		<!--KASUTAJANIMI REGISTREERIMINE-->
		<br><label for="signupUsername">Sinu kasutaja nimi</label></br>
		<input name="signupUsername" type = "signupUsername" placeholder="Kasutajanimi" value=<?=$signupUsername;?>>
		<?php echo $signupUsernameError;?><br>
		
		<br>
		
		<!--SUGU REGISTREERIMINE-->
		<p><label for="signupGender">Sugu:</label><br>
		<select name = "signupGender"  id="signupGender" required><br><br>
		<option value="">Näita</option>
		<option value="Mees">Mees</option>
		<option value="Naine">Naine</option>
		<option value="Muu">Muu</option>
		</select>
		
		<br><br>
	
		<input type="submit" value="Loo kasutaja"></br>

	</body>
</html>