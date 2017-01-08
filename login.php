<?php
//MinuTunne  PHP projekt
require ("functions.php");
//Kui kasutaja on sisse loginud, peab suunama DATA.PHP lehele
if (isset($_SESSION["userId"])){
	//Suunamine
	header ("Location: data.php");
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

		//siia jõuan siis kui parool oli olemas - isset
		//parool ei olnud tühi -empty
		//kas parooli pikkus on väiksem kui 8

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
	$signUpDate =  new DateTime($_POST['signUpDate']);
	$signUpDate =  $signUpDate->format('Y-m-d');
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
	$error = login( $_POST["loginEmail"], $_POST["loginPassword"]);
}
?>

<?php require ("header2.php"); ?>
<html>
	<head>
		<title>
			MinuTunne - jälgi meeleolu- ja tervisemuutusi
		</title>
	</head>
	<body>
		<div class="container">
		<em><h1>
			<b>
				<font color = #100B00>

					MinuTunne
				</h1>
			</b>
			</font></em>

		<p>
			<em>Veebirakenduse MinuTunne eesmärgiks on oma enesetundest, kaalust ja üleüldisest heaolust lugu pidavale inimesele võimaldada monitoorida enda enesetunde muutusi, liikumisaktiivsust ning vastavalt soovile jälgida kehamassiindeksi (KMI) ja kaalu muutusi. Inimene leiab veebirakendusest tuge oma enesetunde monitoorimisel ning selle seostamisel võimalike kaalumuudatustega. Samuti on rakendus hea abimees kaalumuudatuse motiveerimiseks.
				Kasutajal on võimalik tutvuda enda varasemate enesetunde hinnangutega, liikumisaktiivsusega ning neid vastavalt vajadusele analüüsida. </p>
		</em>

			<div class="container">
			 <div class="row" style="margin-top:20px">
				 	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				 	<form role="form">
						<fieldset>
							<h2><font color=#3B341F>	Logi sisse </h2> </font>
				<form method="POST">
					<div class="form-group">
					<p style="color:red;">
						<?=$error;?></p>
					<label>E-post</label>
					<input  class="form-control input-lg" name="loginEmail" type="text"> </div>
						<br>

						<div class="form-group">
						<label>Parool</label>
						<br>
						<input type="Password" class="form-control input-lg" name="loginPassword"> </div>
						<br>

						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
						<input class = "btn btn-success btn-sm"  style="height:80;width:100" type="submit" value="Logi sisse">
					</div>
					</form>
					<br><br>

			</fieldset>
		</form>


							<div class="row" style="margin-top:20px">
								<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
								<form role="form">
									<div class="form-group">
						<h2><font color=#3B341F> Registreeru kasutajaks </h2></font>
						<form method="POST">
							<div style="display: inline;">
							<label>E-post</label>
							<br>
							<input class="form-control input-xs"  name="signupEmail" type="text"  value="<?=$signupEmail;?>"><?=$signupEmailError;?>
							<br>
							<label>Parool</label>
							<br>
							<input class="form-control input-xs" type="Password" name="signupPassword" ></div>
							<?php echo $signupPasswordError; ?>
							<br>
							<label>Sünniaeg</label>
							<br>
							<input class="form-control input-xs"  name="signUpDate" type="Date"  value="<?=$signUpDate;?>"><?=$signUpDateError;?>
							<br>
							<label>Sugu</label>
							<br>
							<?php if($signupGender == "male") { ?>
							<input type="radio" name="signupGender" value="male" checked>
							Mees
							<br>
							<?php }else { ?>
							<input type="radio" name="signupGender" value="male">
							Mees
							<br>
							<?php } ?>
							<?php if($signupGender == "female") { ?>
							<input type="radio" name="signupGender" value="female" checked>
							Naine
							<br>
							<?php }else { ?>
							<input type="radio" name="signupGender" value="female">
							Naine
							<br>
							<?php } ?>
							<?php if($signupGender == "other") { ?>
							<input type="radio" name="signupGender" value="other" checked>
							Muu
							<br>
							<?php }else { ?>
							<input type="radio" name="signupGender" value="other">
							Muu
							<br>
							<?php } ?>
							<br>
							<input class = "btn btn-success btn-sm" type="submit" style="height:80;width:100" value="Registreerun">

					</fieldset>
				</div>
						</form>
					</div>
				</div>
				</body>
			</html>
