<?php

	require("../../../config.php");
	require("../functions.php");
	if(isset($_SESSION["userId"])){
		
		header("Location: productselect.php");
		exit();
	}

	$signupemail = "";
	$signupEmailError= "";
	$signupPasswordError= "";
	$reenterpasswordError= "";

	$signupFirstname = "";
	$signupFirstnameError = "";
	$signupLastname = "";
	$signupLastnameError = "";
	
	$signupGender = "";
	$signupGenderError = "";
	
	$signupUsername = "";
	$signupUsernameError = "";
	$signupBDay = "";
	$signupBDayError = "";
	$signupBMonth = "";
	$signupBMonthError = "";
	$signupBYear = "";
	$signupBYearError = "";

	if(isset($_POST["signupemail"])){
		if(empty($_POST["signupFirstname"])) {
			$signupFirstnameError= "See vali on kohustuslik";
		} else {
			$signupFirstname = $_POST["signupFirstname"];
		}
		
		if(empty($_POST["signupLastname"])) {
			$signupLastnameError= "See vali on kohustuslik";
		} else {
			$signupLastname = $_POST["signupLastname"];
		}
		
		if(empty($_POST["signupUsername"])) {
			$signupUsernameError= "See vali on kohustuslik";
		} else {
			$signupUsername = $_POST["signupUsername"];
		}
		
		if(empty($_POST["signupemail"])){
			$signupEmailError= "See vali on kohustuslik";
		}else{
			$signupemail = $_POST["signupemail"];
		}
		
		if(isset($_POST["signuppassword"])){
		if(empty($_POST["signuppassword"])){
			$signupPasswordError= "See vali on kohustuslik";
		} else {
			if( strlen($_POST["signuppassword"]) <8 ){
				$signupPasswordError = "Parool peab olema vahemalt 8 tahemarki pikk";
			}
		}
		}
	
		if(isset($_POST["reenterpassword"])){
		if($_POST["reenterpassword"] == $_POST["signuppassword"]){			
			$reenterpasswordError= "";
		} else {
			$reenterpasswordError= "Parool peab olema sama";
		}
		}

		if(isset($_POST["signupGender"])) {
			$signupGender = $_POST["signupGender"];
		} else {
			$signupGenderError= "See vali on kohustuslik";
		}
		
		if(empty($_POST["signupAge"])) {
			$signupAgeError= "See vali on kohustuslik";	
		} else {
			$signupAge = $_POST["signupAge"];
		}


		if(empty($_POST["signupBDay"])) {
			$signupBDayError= "Paev ";
		} else {
			
			if(32>($_POST["signupBDay"])) {
				$signupBDay = $_POST["signupBDay"];
			} else {
				$signupBDayError="Sellist paeva pole ";
			}
		}
		
		if(empty($_POST["signupBMonth"])) {
			$signupBMonthError= "Kuu ";
		} else {
			if(13>($_POST["signupBMonth"])) {
				$signupBMonth = $_POST["signupBMonth"];
			} else {
				$signupBMonthError="Sellist kuud pole ";
			}
		}
		
		if(empty($_POST["signupBYear"])) {
			
			$signupBYearError= "Aasta ";
			
		} else {
			
			if(2017>($_POST["signupBYear"])) {
				$signupBYear = $_POST["signupBYear"];
			} else {
				$signupBYearError="Sellist aastat pole ";
			}
		}
		
	}
	if(isset($_POST["signupemail"]) &&		isset($_POST["signuppassword"]) &&			isset($_POST["signupFirstname"]) &&
		isset($_POST["signupLastname"]) &&		isset($_POST["signupGender"]) &&		isset($_POST["signupUsername"]) &&
		isset($_POST["signupBDay"]) &&		isset($_POST["signupBMonth"]) &&		isset($_POST["signupBYear"]) &&
		$signupEmailError=="" &&
		$signupPasswordError=="" &&
		$signupFirstnameError=="" &&
		$signupLastnameError=="" &&
		$signupGenderError=="" &&
		$signupUsernameError=="" &&
		$signupBDayError=="" &&
		$signupBMonthError=="" &&
		$signupBYearError==""
		) {
		
		$signupDoB = $signupBYear . '-' . $signupBMonth . '-' . $signupBDay;
		$password = hash("sha512", $_POST["signuppassword"]);

		$User->signUp($Helper->cleanInput($signupemail), $Helper->cleanInput($password), $Helper->cleanInput($signupFirstname), $Helper->cleanInput($signupLastname), $Helper->cleanInput($signupGender), $Helper->cleanInput($signupUsername), $Helper->cleanInput($signupDoB)); 	
	}

?>

<?php require("../header.php"); ?>

<div class="container">
	<div class="row">
		<div class="col-sm-12 col-sm-offset-0">
			<div class="panel panel-primary ">
				<div class="panel-heading">
					<h2 class="panel-title">Palun täida väljad</h2>
				</div>
				
				<div class="panel-body">
					<div class="form-group col-sm-12">
						<form method="POST">
							
							<b><label>*Eesnimi:</label></b> <text style="color:red;"><?php echo $signupFirstnameError; ?></text>
							<input class="form-control" name="signupFirstname" placeholder="Eesnimi/Firstname" type="text" value="<?=$signupFirstname;?>"> 
							<br>
							
							<b><label>*Perekonnanimi:</label></b> <text style="color:red;"><?php echo $signupLastnameError; ?></text>
							<input class="form-control" name="signupLastname" placeholder="Perekonnanimi/Lastname" type="text" value="<?=$signupLastname;?>"> 
							<br>
						
							<b><label>*E-mail:</label></b> <text style="color:red;"><?php echo $signupEmailError; ?></text>
							<input class="form-control" name="signupemail" placeholder="mail@mail.com" type="text" value="<?=$signupemail;?>"> 
							<br>
							
							<b><label>*Sünnikuupäev (Aasta/Kuu/Päev)</label></b> <text style="color:red;"><?php echo $signupBYearError,$signupBMonthError,$signupBDayError; ?></text><br>
							
							<div class="form-group col-sm-2">
								<input class="form-control" name="signupBYear" type="integer" placeholder="1999" value="<?=$signupBYear;?>">
							</div>
							<div class="form-group col-sm-2">
								<input class="form-control" name="signupBDay" type="integer" placeholder="31" value="<?=$signupBDay;?>">
							</div>
							<div class="form-group col-sm-2">
								<input class="form-control" name="signupBMonth" type="integer" placeholder="12" value="<?=$signupBMonth;?>">
							</div>
							
								<br><br><br><br>
								
							<b><label>*Sugu:</label></b> <text style="color:red;"><?php echo $signupGenderError; ?></text>
							<?php if($signupGender == "male") { ?>
								<input name="signupGender" type="radio" value="male" checked> Male
							<?php }else { ?>
								<input name="signupGender" type="radio" value="male"> Male
							<?php } ?>
							
							<?php if($signupGender == "female") { ?>
								<input name="signupGender" type="radio" value="female" checked> Female
							<?php }else { ?>
								<input name="signupGender" type="radio" value="female"> Female
							<?php } ?>
							
							<?php if($signupGender == "other") { ?>
								<input name="signupGender" type="radio" value="other" checked> Other
							<?php }else { ?>
								<input name="signupGender" type="radio" value="other"> Other<br>
							<?php } ?>
							<br>
							
							
							<b><label>*Kasutajanimi:</label></b><text style="color:red;"> <?php echo $signupUsernameError; ?></text>
							<input class="form-control" name="signupUsername" type="text" value="<?=$signupUsername;?>">
							<br>
							
							<b><label>*Parool:</label></b> <text style="color:red;"> <?php echo $signupPasswordError; ?></text>
							<input class="form-control" name="signuppassword" type="password"> 
							<br>
							
							<b><label>*Sisesta parool uuesti:</label></b> <text style="color:red;"><?php echo $reenterpasswordError; ?></text>
							<input class="form-control" name="reenterpassword"  type="password"> 
							<br>
							</div>
							<input class="btn btn-primary btn-block visible-xs-block" type="submit" value="Create Kasutaja">
							<input class="btn btn-primary btn-block btn-sm hidden-xs" type="submit" value="Create Kasutaja">
							<br>
							
						</form>
				</div>
			</div>	
		</div>
	</div>
</div>
<?php require("../footer.php"); ?>










