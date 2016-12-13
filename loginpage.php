<?php

	require("../../config.php");
	require("functions.php");
	require("header.php");
	
	echo date("d.m.Y");
	
	//SESSION
	if (isset($_SESSION["userId"]))
	{
		header("Location: homepage.php");
	}
	
	//MUUTUJAD REGISTREERIMINE
	$signupEmail = $signupPassword = $signupUsername = $signupGender = "" ; 
	$signupEmailError = $signupPasswordError = $signupUsernameError = $signupGenderError = "";
	//MUUTUJAD LOOGIMINE
	$loginEmail = $loginPassword = "";
	$loginEmailError = $loginPasswordError = $error = "";
	
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
	if ( $signupEmailError == "" AND
		$signupPasswordError == "" &&
		isset($_POST["signupEmail"]) &&
		isset($_POST["signupPassword"])
	)
	if (isset($_POST["signupEmail"])&&
		!empty($_POST["signupEmail"])
		)
	
	//SALVESTAMINE JA FUNKTSIOON
	{
	$signupPassword = hash("sha512", $_POST["signupPassword"]);
	registration($signupEmail, $signupPassword, $signupUsername, $_POST["signupGender"]);
	}
	
	//SISSELOOGIMINE
	//EMAIL LOOGIMINE
	if (isset ($_POST["loginEmail"])) {
		if (empty ($_POST["loginEmail"])) {
		$loginEmailError = "* Väli on kohustuslik!";
		} else {
		$loginEmail = $_POST ["loginEmail"];
		}
	}
	
	//PAROOLI LOOGIMINE
	if (isset ($_POST["loginPassword"])) {
		if (empty ($_POST["loginPassword"])) {
		$loginPasswordError = "* Väli on kohustuslik!";
		} else {
		$loginPassword = $_POST ["loginPassword"];
		}
	}
	
	//LOOGIMISE LÕPP
	if (isset ($_POST["loginEmail"]) &&
		isset ($_POST["loginPassword"])  &&
		!empty ($_POST["loginEmail"]) &&
		!empty ($_POST["loginPassword"])
		)
	//LOOGIMINE JA FUNKTSIOON
	{
	$error = login($_POST["loginEmail"], $_POST["loginPassword"]); //ERROR näitab et parool vqi email on vale
	}
	
?>


<!DOCTYPE html>
<html>
		
<head>
<title>Sisselogimise leht</title>
</head>
	
	<style type="text/css">
	p {font-family: courier;font-size:110%;}
	#clock {color:black;}
	</style>
	
	<script type="text/javascript">
	function updateClock (){
	  var currentTime = new Date ( );
	  var currentHours = currentTime.getHours ();
	  var currentMinutes = currentTime.getMinutes ();
	  var currentSeconds = currentTime.getSeconds();
	  currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
	  currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
	  var timeOfDay = ''; 

	  var currentTimeString = currentHours + ":" + currentMinutes + ':' + currentSeconds+ " " + timeOfDay;

	  document.getElementById("clock").innerHTML = currentTimeString;
	}
	</script>
	
	<body onLoad="updateClock(); setInterval('updateClock()', 1000 )">
	<span id="clock">&nbsp;</span>
	</body>

</html>

	<center>
	<!--KASUTAJA SISENEB-->
	<br><br>
	<img src="https://lh4.googleusercontent.com/GwAbWmRpaRkh5GEW6ctGTo3I-_C0l3pTrO-Oo82h0I5o-h9rdBElpZiisM0-hh-NNwF5YKFNWD9_YXA=w1280-h894">
	<p style="color:red;"><?=$error;?></p> <!--näitab parool/email errorit-->
	<form method="POST">
		
		<!--EMAILI LOOGIMINE-->
		<p>
		<label for="loginEmail">E-post</label><br>
		<input name="loginEmail" type="loginEmail">
		<br><?php echo $loginEmailError;?></br>
		
		<!--PAROOLI LOOGIMINE-->
		<label for="loginPassword">Parool</label><br>
		<input name="loginPassword" type="password">
		<br><?php echo $loginPasswordError;?></br>
		</p>
		
		<input type="submit" value="Logi sisse"></br>
	</form>

	<!--KASUTAJA REGISTREERIB-->
	<br><br>
	<img src="https://lh4.googleusercontent.com/jORZ4neAxo2lqm9wWNm4Q9HH4uznDkRAK_CetxGyy5sD2faICEaz4QYnsPhR4fTwprdT1RQi2KFgNoA=w1280-h845">
	<form method="POST">
	<label></label>
	
		<!--EMAIL REGISTREERIMINE-->
		<p>
		<label for="signupEmail">E-post</label><br>
		<input name="signupEmail" type = "signupEmail" placeholder="E-post">
		<br><?php echo $signupEmailError;?></br>
		
		<!--PAROOL REGISTREERIMINE-->
		<br><label for="signupPassword">Parool</label></br>
		<input name="signupPassword" type = "password" placeholder="Parool">
		<br><?php echo $signupPasswordError;?></br>
		
		<!--KASUTAJANIMI REGISTREERIMINE-->
		<br><label for="signupUsername">Sinu kasutaja nimi</label></br>
		<input name="signupUsername" type = "signupUsername" placeholder="Kasutajanimi" value=<?=$signupUsername;?>>
		<br><?php echo $signupUsernameError;?></br>

		<!--SUGU REGISTREERIMINE-->
		<br><label for="signupGender">Sugu:</label></br>
		<select name = "signupGender"  id="signupGender" required>
		<option value="">Näita</option>
		<option value="Mees">Mees</option>
		<option value="Naine">Naine</option>
		<option value="Muu">Muu</option>
		</select></p>
	
		<br><input type="submit" value="Loo kasutaja"></br>
	<img src="https://lh5.googleusercontent.com/Z3AQmIoZUPSpK8IbFqXFcs1CIFKUfwVIcdTxeMbb5qlLpIlsRq7JDcYx3GIuroXf8I_FmDdEqkDa-s0=w1280-h894-rw">
	</center>
</form>
</body>
</html>

<?php
echo date("d.m.Y");
?>