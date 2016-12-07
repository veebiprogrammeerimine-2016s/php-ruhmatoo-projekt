
<?php
//MinuTunne  PHP projekt

	require("functions.php");

//Kui kasutaja on sisse loginud, peab suunama DATA.PHP lehele
	if (isset($_SESSION["userId"])){
		//Suunamine
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


	if( isset( $_POST["signUpDate"] ) ){
		//jah on
		//kas on tühi
		if( empty( $_POST["signUpDate"] ) ){
			$signUpDateError = "See väli on kohustuslik";
		} else {
			//email olemas
			$signUpDate = $_POST["signUpDate"];
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
		echo "Password: ".$_POST["signupPassword"]."<br>";
		$Password = hash("sha512", $_POST["signupPassword"]);
		echo "password hashed: ".$Password."<br>";

		//echo $serverUsername;

		// KASUTAN FUNKTSIOONI
		// $signupEmail = cleanInput($signupEmail);
		signUp($signupEmail, $Password, $signUpDate, $signupGender);

	}

	$error ="";
	if (isset($_POST["loginEmail"]) &&
		isset($_POST["loginPassword"]) &&
		!empty($_POST["loginEmail"]) &&
		!empty($_POST["loginPassword"])
	  ) {

		// $error = login(cleanInput($_POST["loginEmail"]), cleanInput($_POST["loginPassword"]), cleanInput($_POST["signUpDate"]));
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>MinuTunne - jälgi meeleolu- ja tervisemuutusi </title>
</head>
<body>

 <h1>MinuTunne</h1><p> Veebirakenduse MinuTunne eesmärgiks on oma enesetundest, kaalust ja üleüldisest heaolust lugu pidavale inimesele võimaldada monitoorida enda enesetunde muutusi, liikumisaktiivsust ning vastavalt soovile jälgida kehamassiindeksi (KMI) ja kaalu muutusi. Inimene leiab veebirakendusest tuge oma enesetunde monitoorimisel ning selle seostamisel võimalike kaalumuudatustega. Samuti on rakendus hea abimees kaalumuudatuse motiveerimiseks.
	Kasutajal on võimalik tutvuda enda varasemate enesetunde hinnangutega, liikumisaktiivsusega ning neid vastavalt vajadusele analüüsida. </p>

	<h2>Logi sisse</h2>
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


	<h2>Registreeru kasutajaks</h2>
	<form method="POST">


		<label>E-post</label>
		<br>
		<input name="signupEmail" type="text" placeholder = "E-post" value="<?=$signupEmail;?>"> <?=$signupEmailError;?>
		<br><br>

		<label>Parool</label>
		<br>
		<input type="Password" name="signupPassword" placeholder="Parool"> <?php echo $signupPasswordError; ?>
		<br><br>


		<label>Sünniaeg</label>
		<br>
		<input name="signUpDate" type="text" placeholder = "kk.pp.aaaa" value="<?=$signUpDate;?>"> <?=$signUpDateError;?>
		<br><br>

		<label>Sugu</label>
		<br>
		<?php if($signupGender == "male") { ?>
			<input type="radio" name="signupGender" value="male" checked> Mees<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="male"> Mees<br>
		<?php } ?>
		<?php if($signupGender == "female") { ?>
			<input type="radio" name="signupGender" value="female" checked>  Naine<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="female"> Naine<br>
		<?php } ?>

		<?php if($signupGender == "other") { ?>
			<input type="radio" name="signupGender" value="other" checked> Muu<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="other"> Muu<br>
		<?php } ?>

		<input type="submit" value="Registreerun">


	</form>

</body>
</html>
