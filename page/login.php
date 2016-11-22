<?php 

	require("../functions.php");
	
    require("../class/Helper.class.php");
	$Helper = new Helper();
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
	//kui on sisse loginud siis suunan data lehele
	if(isset($_SESSION["userId"])){
		header("Location: data.php");
		exit();
	}
	
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);

	// MUUTUJAD
	$signupEmailError= "*";
	$signupEmail = "";
	$loginEmail = "";
	$age = "" ;
	$firstname = "" ;
	$lastname = "" ;
	
	//PROOV Töötab 
	if(isset ($_POST["loginEmail"])) {
		if(empty ($_POST["loginEmail"])){
			$signupEmailError = "* Väli on kohustuslik!";
		} else{
		$loginEmail = $_POST["loginEmail"];
		}
	}	
	
	//kas keegi vajutas nuppu ja see on üldse olemas
	if(isset ($_POST["signupEmail"])) {
		//kas on olemas
		//kas on tühi
		if(empty ($_POST["signupEmail"])){
			//on tühi
			$signupEmailError = "* Väli on kohustuslik!";
		} else{
		//email olemas ja õige
		$signupEmail = $_POST["signupEmail"];
		}
	}	
	
	//Kasutaja loomine
	$firstnameError= "*";
	if (isset ($_POST["firstname"])) {
		if (empty ($_POST["firstname"])) {
			$firstnameError = "* Väli on kohustuslik!";
		} else {
			$firstname = $_POST["firstname"];
		}
	}
	
	$lastnameError= "*";
	if (isset ($_POST["lastname"])) {
		if (empty ($_POST["lastname"])) {
			$lastnameError = "* Väli on kohustuslik!";
		} else {
			$lastname = $_POST["lastname"];
		}
	}
	
	$ageError= "*";
	if (isset ($_POST["age"])) {
		if (empty ($_POST["age"])) {
			$ageError = "* Väli on kohustuslik!";
		} else {
		if (decimal($_POST["age"]) < 13) {
			$ageError = "Vanus peab olema vähemalt 13";
			}
		}
	} 
	
	$signupPasswordError= "*";
	if (isset ($_POST["signupPassword"])) {
		if (empty ($_POST["signupPassword"])) {
			$signupPasswordError = "* Väli on kohustuslik!";
		} else {
			// parool ei olnud tühi
			if(strlen($_POST["signupPassword"]) < 8 ) {
				$signupPasswordError = "* Parool peab olema vähemalt 8 tähemärki pikk!";
			}
		}
	}
	
	$gender = "female";
	if (isset ($_POST["gender"])) {
		if (empty ($_POST["gender"])) {
			$genderError = "* Väli on kohustuslik!";
		} else {
			$gender = $_POST["gender"];
		}	
	} 

	if ( $signupEmailError == "*" AND
		$signupPasswordError == "*" &&
		$firstnameError=="*" &&
		$lastnameError=="*" &&
		$ageError=="*" &&
		isset($_POST["signupEmail"]) &&
		isset($_POST["signupPassword"]) &&
		isset($_POST["firstname"]) &&
		isset($_POST["lastname"]) &&
		isset($_POST["age"])
	){
		//vigu ei olnud, kõik on olemas
		echo "Salvestan...<br>";
		echo "email ".$signupEmail. "<br>";
		echo "parool ".$_POST["signupPassword"]."<br>";
			$password = hash("sha512", $_POST["signupPassword"]);
		echo $password."<br>";
		$User->signup($signupEmail, $password);
		
	}
	
	$notice ="";
	//kas kasutaja tahab sisse logida
	if( isset($_POST["loginEmail"]) &&
		isset($_POST["loginPassword"]) &&
		!empty($_POST["loginEmail"]) &&
		!empty($_POST["loginPassword"]) 
	){
		$notice = $User->login($_POST["loginEmail"], $_POST["loginPassword"]);
	}
	
	
?>


<?php require("../header.php");?>
<div class="container">
	<div class="row">
		<div class="col-sm-4 col-md-3">
		<h1>Logi sisse</h1>
		<p style="color:black;"><?=$notice;?></p>
		<form method="POST" >
			<label>E-post</label><br>
			<div class="form-group">
					<input class="form-control" name="loginEmail" type="email">
			</div>
			<br><br>
			<input name="loginPassword" placeholder="Parool" type="password">
			<br><br>
			<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Logi sisse">
			<input class="btn btn-success btn-sm btn-block visible-xs-block" type="submit" value="Logi sisse2">
		</form>
		</div>
		
		<div class="col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3">
		<h1>Loo kasutaja</h1>
		
		<form method="POST">
		<input type="text" name="firstname" placeholder="Eesnimi" value="<?=$firstname;?>"> <?php echo $firstnameError;?>
		<br><br>
		<input type="text" name="lastname" placeholder="Perekonnanimi" value="<?=$lastname;?>"> <?php echo $lastnameError;?>
		<br><br>
		<input name="age" type="number" placeholder="Vanus" value="<?=$age;?>"> <?php echo $ageError;?>
		<br><br>
		<input name="signupEmail" placeholder="Email" type="email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError;?>
		<br><br>
		<input name="signupPassword" placeholder="Parool" type="password"> <?php echo $signupPasswordError;?>
	
		<br><br>
		
		<?php if ($gender == "") { ?>
			<input type="radio" name="gender" value="female" checked> female<br>
		<?php } else { ?>
			<input type="radio" name="gender" value="female" > female<br>
		<?php } ?>
			
		<?php if ($gender == "male") { ?>
			<input type="radio" name="gender" value="male" checked> male<br>
		<?php } else { ?>
			<input type="radio" name="gender" value="male" > male<br>
		<?php } ?>
			
		<?php if ($gender == "other") { ?>
			<input type="radio" name="gender" value="other" checked> other<br>
		<?php } else { ?>
			<input type="radio" name="gender" value="other" > other<br>
		<?php } ?>
			
		<input type="submit" value="Loo kasutaja">
		</form>
		</div>
	</div>
</div>
<?php require("../footer.php");?>
