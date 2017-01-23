<?php

	require("../../config.php");
	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");
	
	//SESSION
	if (isset($_SESSION["userId"]))
	{
		header("Location: homepage.php");
	}
	
	//MUUTUJAD REGISTREERIMINE
	$signupEmail = $signupPassword = $signupUsername = $signupGender = "" ; 
	$signupEmailError = $signupPasswordError = $signupUsernameError = $signupGenderError = "";
	//MUUTUJAD LOGIMINE
	$loginEmail = $loginPassword = "";
	$loginEmailError = $loginPasswordError = $error = "";
	
	
	
	//REGISTREERIMINE
	//E-POST REGISTREERIMINE
	if (isset ($_POST["signupEmail"])) {
		if (empty($_POST["signupEmail"])) {
		$signupEmailError = "See väli on kohustuslik!";
		} else {
		$signupEmail = $_POST ["signupEmail"];
		}
	}
	
	//PAROOL
	if(isset ($_POST["signupPassword"])) {
		if (empty ($_POST["signupPassword"])) {
		$signupPasswordError = "See väli on kohustuslik!";
		} else {
		if (strlen ($_POST["signupPassword"]) <6)
		$signupPasswordError = "Parool peab olema vähemalt 6 tähemärki!";
		}
	}
	
	//Kasutajanimi
	if (isset ($_POST["signupUsername"])) {
		if (empty ($_POST["signupUsername"])) {
		$signupUsernameError = "See väli on kohustuslik!";
		} else {
		if (strlen ($_POST["signupUsername"]) >30) {
		$signupUsernameError = "Kasutajanime maksimaalne pikkus on 30 tähemärki!";
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
	
	//SISSELOGIMINE
	//EMAIL LOGIMINE
	if (isset ($_POST["loginEmail"])) {
		if (empty ($_POST["loginEmail"])) {
		$loginEmailError = "See väli on kohustuslik!";
		} else {
		$loginEmail = $_POST ["loginEmail"];
		}
	}

	//PAROOLI LOGIMINE
	if (isset ($_POST["loginPassword"])) {
		if (empty ($_POST["loginPassword"])) {
		$loginPasswordError = "See väli on kohustuslik!";
		} else {
		$loginPassword = $_POST ["loginPassword"];
		}
	}
	
	//LOGIMISE LÕPP
	if (isset ($_POST["loginEmail"]) &&
		isset ($_POST["loginPassword"])  &&
		!empty ($_POST["loginEmail"]) &&
		!empty ($_POST["loginPassword"])
		)
	//LOGIMINE JA FUNKTSIOON
	{
	$error = login($_POST["loginEmail"], $_POST["loginPassword"]); //ERROR näitab et parool või email on vale
	}
	
?>


<!DOCTYPE html>
<html>

<head>
<title>Sisselogimise leht</title>
</head>

	<style>	

	body {
		background: url(image/background.png);
	}
	</style>

</html>
<body>

<center>
	
	<!--KASUTAJA SISENEB-->
	<div class="login">
	<form method="POST">
		<p class="down">Sisselogimine<p>
		<?=$error;?>
		<!--EMAILI LOGIMINE-->
		<input name="loginEmail" type="loginEmail" class="text" placeholder="E-Post" value=<?=$loginEmail;?>>
		<br><?php echo $loginEmailError;?></br>
		
		<!--PAROOLI LOGIMINE-->
		<input name="loginPassword" type="password" class="text" placeholder="Parool">
		<br><?php echo $loginPasswordError;?>
		
	
		<!--LOGIN BUTTON-->
		<input type="submit" value="Logi sisse" class="submit submit1">
		</form>
		
		<!--UUS KASUTAJA BUTTON-->
		<p class="down">VÕI</p>
		<form method="POST">
		<input type="button" value="Tee uus kasutaja" class="submit submit1" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">
		</form>
	</div>

<!--POPUP WINDOW-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
 
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Tee uus kasutaja</h4>
		</div>
        
			<div class="modal-body">
			<form method="POST">
			<label></label>
		
			<!--EMAIL REGISTREERIMINE-->
			<label for="signupEmail">E-post</label><br>
			<input name="signupEmail" type="signupEmail" placeholder="E-post" class="text" value=<?=$signupEmail;?>>
			<br><?php echo $signupEmailError;?></br>
			
			<!--PAROOL REGISTREERIMINE-->
			<br><label for="signupPassword">Parool</label></br>
			<input name="signupPassword" type = "password" placeholder="Parool" class="text">
			<br><?php echo $signupPasswordError;?></br>
			
			<!--KASUTAJANIMI REGISTREERIMINE-->
			<br><label for="signupUsername">Kasutajanimi</label></br>
			<input name="signupUsername" type = "signupUsername" placeholder="Kasutajanimi" class="text" value=<?=$signupUsername;?>>
			<br><?php echo $signupUsernameError;?></br>

			<!--SUGU REGISTREERIMINE-->
			<br><label for="signupGender">Sugu</label></br>
			<select name = "signupGender"  id="signupGender" required>
			<option value="">Avamiseks vajuta</option>
			<option value="Male">Mees</option>
			<option value="Female">Naine</option>
			<option value="Other">Muu</option>
			<option value="Alien">Tulnukas</option>
			</select>

			</div>
        <div class="modal-footer">
		<input type="submit" class="btn btn-default" value="Loo kasutaja">
		</form>
        </div>
      </div>
    </div>
  </div>
</div>
</center>
</body>
</html>