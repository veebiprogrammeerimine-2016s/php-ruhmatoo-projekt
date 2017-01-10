<?php

	require("../../config.php");
	require("functions.php");
	require("style/style.php");
	
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
	
	//PAROOLI LOOGIMINE
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
	div[class=login] {
		border: 2px solid rgba(255, 255, 255, 0.2) ;
		border-radius: 15px 50px;
		padding: 20px;
		background: rgba(255, 255, 255, 0.3);
		width: 35%;
		margin: 15%;
	}

	body {
		background: url(image/background.png);
	}
	
	input[class=text],select {
		width: 60%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}
	.submit {
		width: 50%;
		height: 50px;
		background-color: #AA7CFF;
		border: 1px solid #ADADAD;
		color: white;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		-webkit-transition-duration: 0.4s; /* Safari */
		transition-duration: 0.4s;
		cursor: pointer;
		border-radius: 12px;
	}			

	.submit1 {
		background-color: white; 
		color: black; 
	}

	.submit1:hover {
		background-color: #E6E6E6;
		color: black;
	}
	
	p {font-family:  Futura, "Trebuchet MS", Arial, sans-serif;}
	
	p[class=border]{border-bottom: 1px solid black;}
	
	</style>

</html>
<body>

<center>
	
	<!--KASUTAJA SISENEB-->
	<div class="login">
	<form method="POST">
		<p class="border">Sisselogimine<p>
		<?=$error;?>
		<!--EMAILI LOGIMINE-->
		<input name="loginEmail" type="loginEmail" class="text" placeholder="E-Post" value=<?=$loginEmail;?>>
		<br><?php echo $loginEmailError;?></br>
		
		<!--PAROOLI LOGIMINE-->
		<input name="loginPassword" type="password" class="text" placeholder="Parool">
		<br><?php echo $loginPasswordError;?></br>
		
		<!--LOGIN BUTTON-->
		<input type="submit" value="Logi sisse" class="submit submit1">
		</form>
		
		<!--UUS KASUTAJA BUTTON-->
		<p class="border">VÕI</p>
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
			<br><label for="signupUsername">Hüüdnimi</label></br>
			<input name="signupUsername" type = "signupUsername" placeholder="Hüüdnimi" class="text" value=<?=$signupUsername;?>>
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
<?php include 'footer.php';?>
</center>
</body>
</html>