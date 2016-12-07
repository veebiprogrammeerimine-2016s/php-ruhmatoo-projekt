//MinuTunne  PHP projekt

<?php

	require("functions.php");

	// kui on juba sisse loginud siis suunan data lehele
	if (isset($_SESSION["userId"])){

		//suunan sisselogimise lehele
		header("Location: data.php");
		exit();

	}


	// MUUTUJAD
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupEmail = "";
	$signupGender = "";
	$signUpDate = "";
	$signUpDateError= "";

	// Kontrollime, kas on üldse olemas selline muutja
	if( isset( $_POST["signupEmail"] ) ){
		//jah on olemas
		//kas on tühi
		if( empty( $_POST["signupEmail"] ) ){
			$signupEmailError = "See väli on kohustuslik";
		} else {
			//email olemas
			$signupEmail = $_POST["signupEmail"];
		}
	}


	if( isset( $_POST["signupEmail"] ) ){
		//jah on
		//kas on tühi
		if( empty( $_POST["signupEmail"] ) ){
			$signupEmailError = "See väli on kohustuslik";
		} else {
			//email olemas
			$signupEmail = $_POST["signUpDate"];
		}
	}

	if( isset( $_POST["signupPassword"] ) ){
		if( empty( $_POST["signupPassword"] ) ){
			$signupPasswordError = "Parool on kohustuslik";
		} else {
			// siia jõuan siis kui parool oli olemas - isset
			// parool ei olnud tühi -empty
			// kas parooli pikkus on väiksem kui 8
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				$signupPasswordError = "Parool peab olema vähemalt 8 tähemärki pikk";
			}
		}
	}

	// GENDER
	if( isset( $_POST["signupGender"] ) ){
		if(!empty( $_POST["signupGender"] ) ){
			$signupGender = $_POST["signupGender"];
		}
	}
	// peab olema email ja parool
	// ühtegi errorit
	if ( isset($_POST["signupEmail"]) &&
		 isset($_POST["signupPassword"]) &&
		 isset($_POST["signUpDate"]) &&
		 $signupEmailError == "" &&
		 empty($signupPasswordError)
		) {

		// salvestame ab'i
		echo "Salvestan... <br>";
		echo "email: ".$signupEmail."<br>";
		echo "password: ".$_POST["signupPassword"]."<br>";
		$Password = hash("sha512", $_POST["signupPassword"]);
		echo "password hashed: ".$password."<br>";

		//echo $serverUsername;

		// KASUTAN FUNKTSIOONI
		$signupEmail = cleanInput($signupEmail);
		signUp($signupEmail, cleanInput($Password), cleanInput($signUpDate));
	}

	$error ="";
	if ( isset($_POST["loginEmail"]) &&
		isset($_POST["loginPassword"]) &&
		!empty($_POST["loginEmail"]) &&
		!empty($_POST["loginPassword"])
		isset($_POST["signUpDate"]) &&
		!empty($_POST["signUpDate"]) &&
	  ) {
		$error = login(cleanInput($_POST["loginEmail"]), cleanInput($_POST["loginPassword"]), $_POST["signUpDate"]));
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Logi sisse või registreeru kasutajaks</title>
</head>
<body>

	<h1>Logi sisse</h1>
	<form method="POST">
		<p style="color:red;"><?=$error;?></p>
		<label>E-post</label>
		<br>

		<input name="loginEmail" type="text">
		<br><br>

		<input type="Password" name="loginPassword" placeholder="Parool">
		<br><br>

		<input type="submit" value="Logi sisse">
	</form>


	<h1>Registreeru kasutajaks</h1>
	<form method="POST">

		//E-POSTI KÜSIMINE

		<label>E-post</label>
		<br>
		<input name="signupEmail" type="text" placeholder = "E-post" value="<?=$signupEmail;?>"> <?=$signupEmailError;?>
		<br><br>

		//PAROOLI KÜSIMINE
		<br>
		<input type="Password" name="signupPassword" placeholder="Parool"> <?php echo $signupPasswordError; ?>
		<br><br>


		//SÜNNIAJA KÜSIMINE

		<label>Sünniaeg</label>
		<br>
		<input name="signUpDate" type="text" placeholder = "kk.pp.aaaa" value="<?=$signUpDate;?>"> <?=$signUpDateError;?>
		<br><br>


		<?php if($signupGender == "male") { ?>
			<input type="radio" name="signupGender" value="male" checked> Male<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="male"> Male<br>
		<?php } ?>
		<?php if($signupGender == "female") { ?>
			<input type="radio" name="signupGender" value="female" checked> Female<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="female"> Female<br>
		<?php } ?>

		<?php if($signupGender == "other") { ?>
			<input type="radio" name="signupGender" value="other" checked> Other<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="other"> Other<br>
		<?php } ?>

		<input type="submit" value="Registreerun">


	</form>

</body>
</html>
