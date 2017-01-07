<?php

	require("../../../../config.php");
	require("../functions.php");
	
	
	//kui on see siis suunan data lehele
	if(isset($_SESSION["userId"])){
		
		header("Location: sneakermarket.php");
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
	$signupAge = "";
	$signupAgeError= "";
	$signupCountry = "";
	$signupCity = "";
	$signupShoesize = "";
	
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
		
		if(empty($_POST["signupemail"])){
			
			$signupEmailError= "See vali on kohustuslik";
			
		}else{
			
			$signupemail = $_POST["signupemail"];
			
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
		
		if(empty($_POST["signupCountry"])) {
			
			$signupCountry = "-";
			
		} else {
			
			$signupCountry= $_POST["signupCountry"];
			
		}
		
		if(empty($_POST["signupCity"])) {
			
			$signupCity = "-";
			
		} else {
			
			$signupCity= $_POST["signupCity"];
			
		}
		
		if(empty($_POST["signupShoesize"])) {
			
			$signupShoesize = "-";
			
		} else {
			
			$signupShoesize= $_POST["signupShoesize"];
			
		}
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
			
			$reenterpasswordError= "Parool ei olnud sama";
			
		}
	}
	
	
	if(isset($_POST["signupemail"]) &&
		isset($_POST["signuppassword"]) &&
		isset($_POST["signupGender"]) &&
		isset($_POST["signupAge"]) &&
		$signupEmailError=="" &&
		$signupPasswordError=="" &&
		$signupGenderError=="" &&
		$signupAgeError== ""
		) {
		
		//echo "Salvestan... <br>";
		
		//echo "email: ".$signupemail."<br>";
		//echo "password: ".$_POST["signuppassword"]."<br>";
		//echo "gender: ".$signupGender."<br>";
		//echo "age: ".$signupAge."<br>";
		//echo "country: ".$signupCountry."<br>";
		//echo "city: ".$signupCity."<br>";
		//echo "shoesize: ".$signupShoesize."<br>";
		
		$password = hash("sha512", $_POST["signuppassword"]);
		
		//echo "password hashed: ".$password."<br>";
		
		//echo $serverUsername;
		
		$User->signUp($Helper->cleanInput($signupemail), $Helper->cleanInput($password), $Helper->cleanInput($signupGender), $Helper->cleanInput($signupAge), $Helper->cleanInput($signupCountry), $Helper->cleanInput($signupCity), $Helper->cleanInput($signupShoesize));
		
	}


?>

<?php require("../header.php"); ?>

<div class="container">
	
	<div class="row">
	
		<div class="col-sm-12 col-sm-offset-0">
			
			<div class="panel panel-default ">
				
				<div class="panel-heading">
					<h3 class="panel-title">Täida vastavad väljad</h3>
				</div>
				
				<div class="panel-body">
					
					<div class="form-group col-sm-6">
						<form method="POST">
							<text style="color:red;">Tärniga väljad on kohustuslikud</text>
							<br><br>
							<b><label>*Eesnimi</label></b><br>
							<input class="form-control" name="signupFirstname" placeholder="Santa" type="text" value="<?=$signupFirstname;?>"> <text style="color:red;"><?php echo $signupFirstnameError; ?></text>
							<br>
							
							<b><label>*Perekonnanimi:</label></b><br>
							<input class="form-control" name="signupLastname" placeholder="Claus" type="text" value="<?=$signupLastname;?>"> <text style="color:red;"><?php echo $signupLastnameError; ?></text>
							<br>
						
							<b><label>*E-mail:</label></b><br>
							<input class="form-control" name="signupemail" placeholder="example@mail.com" type="text" value="<?=$signupemail;?>"> <text style="color:red;"><?php echo $signupEmailError; ?></text>
							<br>
						
							<b><label>*Parool:</label></b><br>
							<input class="form-control" name="signuppassword" placeholder="********" type="password"> <text style="color:red;"><?php echo $signupPasswordError; ?></text>
							<br>
							
							<b><label>*Sisesta parool uuesti:</label></b><br>
							<input class="form-control" name="reenterpassword" placeholder="********" type="password"> <text style="color:red;"><?php echo $reenterpasswordError; ?></text>
							<br>
					</div>
						
					<div class="form-group col-sm-6">
							<b><label>*Sugu:</label></b> <text style="color:red;"><?php echo $signupGenderError; ?></text><br>
							<?php if($signupGender == "male") { ?>
								<input name="signupGender" type="radio" value="male" checked> Male<br>
							<?php }else { ?>
								<input name="signupGender" type="radio" value="male"> Male<br>
							<?php } ?>
							
							<?php if($signupGender == "female") { ?>
								<input name="signupGender" type="radio" value="female" checked> Female<br>
							<?php }else { ?>
								<input name="signupGender" type="radio" value="female"> Female<br>
							<?php } ?>
							
							<?php if($signupGender == "other") { ?>
								<input name="signupGender" type="radio" value="other" checked> Other<br>
							<?php }else { ?>
								<input name="signupGender" type="radio" value="other"> Other<br>
							<?php } ?>
							<br>
							
							<b><label>*Vanus:</label></b> <text style="color:red;"><?php echo $signupAgeError; ?></text><br>
							<input class="form-control" name="signupAge" type="integer" value="<?=$signupAge;?>">
							<br>
							
							<b><label>Riik:</label></b><br>
							<input class="form-control" name="signupCountry" type="text">
							<br>
							
							<b><label>Linn:</label></b><br>
							<input class="form-control" name="signupCity" type="text">
							<br>
							
							<b><label>Jalanumber (EUR):</label></b><br>
							<input class="form-control" name="signupShoesize" type="float">
							<br>
					</div>
							<input class="btn btn-success btn-block visible-xs-block" type="submit" value="Loo Kasutaja">
							<input class="btn btn-success btn-block btn-sm hidden-xs" type="submit" value="Loo Kasutaja">
							<br>
							
						</form>
				</div>
			</div>	
		</div>
	</div>
</div>
<?php require("../footer.php"); ?>