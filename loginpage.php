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
	//MUUTUJAD LOOGIMINE
	$loginEmail = $loginPassword = "";
	$loginEmailError = $loginPasswordError = $error = "";
	
	
	
	//REGISTREERIMINE
	//E-POST REGISTREERIMINE
	if (isset ($_POST["signupEmail"])) {
		if (empty($_POST["signupEmail"])) {
		$signupEmailError = "This field is required!";
		} else {
		$signupEmail = $_POST ["signupEmail"];
		}
	}
	
	//PAROOL
	if(isset ($_POST["signupPassword"])) {
		if (empty ($_POST["signupPassword"])) {
		$signupPasswordError = "This field is required!";
		} else {
		if (strlen ($_POST["signupPassword"]) <6)
		$signupPasswordError = "Password too short: Min lenght is 6!";
		}
	}
	
	//Kasutajanimi
	if (isset ($_POST["signupUsername"])) {
		if (empty ($_POST["signupUsername"])) {
		$signupUsernameError = "This field is required!";
		} else {
		if (strlen ($_POST["signupUsername"]) >30) {
		$signupUsernameError = "Username too long: Max lenght is 30!";
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
		$loginEmailError = "This field is required!";
		} else {
		$loginEmail = $_POST ["loginEmail"];
		}
	}
	
	//PAROOLI LOOGIMINE
	if (isset ($_POST["loginPassword"])) {
		if (empty ($_POST["loginPassword"])) {
		$loginPasswordError = "This field is required!";
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
		<p class="border">LOG IN<p>
		<?=$error;?>
		<!--EMAILI LOOGIMINE-->
		<input name="loginEmail" type="loginEmail" class="text" placeholder="Email" value=<?=$loginEmail;?>>
		<br><?php echo $loginEmailError;?></br>
		
		<!--PAROOLI LOOGIMINE-->
		<input name="loginPassword" type="password" class="text" placeholder="Password">
		<br><?php echo $loginPasswordError;?></br>
		
		<!--LOGIN BUTTON-->
		<input type="submit" value="Sign In" class="submit submit1">
		</form>
		
		<!--UUS KASUTAJA BUTTON-->
		<p class="border">OR</p>
		<form method="POST">
		<input type="button" value="Create New Account" class="submit submit1" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">
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
		<h4 class="modal-title">Create new account</h4>
		</div>
        
			<div class="modal-body">
			<form method="POST">
			<label></label>
		
			<!--EMAIL REGISTREERIMINE-->
			<label for="signupEmail">Email</label><br>
			<input name="signupEmail" type="signupEmail" placeholder="Email" class="text" value=<?=$signupEmail;?>>
			<br><?php echo $signupEmailError;?></br>
			
			<!--PAROOL REGISTREERIMINE-->
			<br><label for="signupPassword">Password</label></br>
			<input name="signupPassword" type = "password" placeholder="Password" class="text">
			<br><?php echo $signupPasswordError;?></br>
			
			<!--KASUTAJANIMI REGISTREERIMINE-->
			<br><label for="signupUsername">Nickname</label></br>
			<input name="signupUsername" type = "signupUsername" placeholder="Nickname" class="text" value=<?=$signupUsername;?>>
			<br><?php echo $signupUsernameError;?></br>

			<!--SUGU REGISTREERIMINE-->
			<br><label for="signupGender">Gender</label></br>
			<select name = "signupGender"  id="signupGender" required>
			<option value="">Show</option>
			<option value="Male">Male</option>
			<option value="Female">Female</option>
			<option value="Other">Other</option>
			<option value="Alien">Alien</option>
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