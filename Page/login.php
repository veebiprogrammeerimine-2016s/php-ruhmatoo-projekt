<?php 
	
	require("../functions.php");
	//require("../Class/User.class.php");
	//$User = new User($mysqli);
		
	// kui on juba sisse loginud siis suunan data lehele
	if (isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: data.php");
		exit();
		
	}
	

	//echo hash("sha512", "b");

	// MUUTUJAD
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupEmail = "";
	$signupAge = "";
	$signupAgeError = "";
	$signupCounty = "";
	$signupCountyError = "";
	$signupRoll = "";
	$signupRollError = "";
	$signupName = "";
	
	//Email
	if( isset( $_POST["signupEmail"] ) ){		
		if( empty( $_POST["signupEmail"] ) ){			
			$signupEmailError = "See väli on kohustuslik";			
		} else {
			$signupEmail = $_POST["signupEmail"];			
		}		
	} 
	
	//Password
	if( isset( $_POST["signupPassword"] ) ){		
		if( empty( $_POST["signupPassword"] ) ){			
			$signupPasswordError = "Parool on kohustuslik";			
		} else {
			if ( strlen($_POST["signupPassword"]) < 8 ) {				
				$signupPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";			
			}			
		}		
	}
	
	//Name
	if( isset($_POST["signupName"] ) ){
		if(empty($_POST["signupName"])){
			$signupNameError = "Palun sisesta oma nimi!";
		} else {
			$signupName = ($_POST["signupName"]);
		}
	}
	
	//Age
	if( isset($_POST["signupAge"] ) ){
		if(empty($_POST["signupAge"])){
			$signupAgeError = "Palun sisesta oma vanus!";
		} else {
			$signupAge = ($_POST["signupAge"]);
		}
	}
			
	//County
	if( isset($_POST["signupCounty"] ) ){		
		if(empty($_POST["signupCounty"] ) ){		
			$signupCountyError = "Palun vali maakond, kus asud!";		
		} else {
			$signupCounty = ($_POST["signupCounty"]);
		}
	}

	//Seller/Buyer
	if( isset($_POST["signupRoll"])){
		if(empty($_POST["signupRoll"])){
			$signupRollError = "Vali oma roll selles keskkonnas(Ostja/Müüa)";
		} else {
			$signupRoll = ($_POST["signupRoll"]);
		}		
	}
	
	if ( isset($_POST["signupEmail"]) && 
		 isset($_POST["signupPassword"]) && 
		 isset($_POST["signupAge"]) &&
		 isset($_POST["signupCounty"]) &&
		 isset($_POST["signupRoll"]) &&
		 isset($_POST["signupFirstName"]) &&
		 $signupEmailError == "" && 
		 empty($signupPasswordError)
		) {
				
		//echo $serverUsername;
		
		// KASUTAN FUNKTSIOONI
		$signupEmail = $Helper->cleanInput($signupEmail);
		
		$User->signUp($signupEmail, $Helper->cleanInput($password), $Helper->cleanInput($signupName), $Helper->cleanInput($signupRoll),
		$Helper->cleanInput($signupAge), $Helper->cleanInput($signupCounty));
		
	
	}
	
	
	$error ="";
	if ( isset($_POST["loginEmail"]) && 
		isset($_POST["loginPassword"]) && 
		!empty($_POST["loginEmail"]) && 
		!empty($_POST["loginPassword"])
	  ) {
		  
		$error = $User->login($Helper->cleanInput($_POST["loginEmail"]), $Helper->cleanInput($_POST["loginPassword"]));
		
	}
	

?>
<?php require("../header.php"); ?>


 <div class="container">
	<div class="row">
		<a class="btn btn-primary" data-toggle="modal" href="#myModal" >Login</a>

        <div class="modal hide" id="myModal">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">x</button>
            <h3>Login to MyWebsite.com</h3>
          </div>
          <div class="modal-body">
            <form method="post" action='' name="login_form">
              <p><input type="text" class="span3" name="eid" id="email" placeholder="Email"></p>
              <p><input type="password" class="span3" name="passwd" placeholder="Password"></p>
              <p><button type="submit" class="btn btn-primary">Sign in</button>
                <a href="#">Forgot Password?</a>
              </p>
            </form>
          </div>
          <div class="modal-footer">
            New To MyWebsite.com?
            <a href="#" class="btn btn-primary">Register</a>
          </div>
        </div>
	</div>
</div> 
<div class="container">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">

			<h1>Loo kasutaja</h1>
			<form method="POST">
				
				<label>E-post</label>
				<br>
				<div class="form-group">
					<input class="form-control" name="signupEmail" type="text" value="<?=$signupEmail;?>"> <?=$signupEmailError;?>
				</div>
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
				
				
				<br>
				<input type="password" name="signupPassword" placeholder="Parool"> <?php echo $signupPasswordError; ?>
				<br><br>
				
				<input class="btn btn-info btn-sm" type="submit" value="Loo kasutaja">
				
				
			</form>
		</div>
	</div>
</div>
<?php require("../footer.php"); ?>
