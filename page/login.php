<?php 
	
	require("../functions.php");
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	// kui on juba sisse loginud siis suunan data lehele
	if (isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: data.php");
		exit();
		
	}
	

	//echo hash("sha512", "b");
	
	
	//GET ja POSTi muutujad
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	
	//echo strlen("äö");
	
	// MUUTUJAD
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupEmail = "";
	$signupGender = "";
	$loginEmail = "";
	$loginPassword = "";
	$loginEmailError = "";
	$loginPasswordError = "";
	$nickname = "";
	$nicknameError = "";
	
	if( isset( $_POST["loginEmail"] ) ){

		if( empty( $_POST["loginEmail"] ) ){
			
			$loginEmailError = "This field is empty!";
			
		} else {
			
			// email olemas 
			$loginEmail = $_POST["loginEmail"];
			
		}
	} 
	if (isset($_POST ["loginPassword"])){
		if (empty ($_POST ["loginPassword"])){
			$loginPasswordError = "This field is empty!";
		}else {
			if (strlen($_POST["loginPassword"]) < 8) {
				$loginPasswordError = "Password is too short";
			}
		}
	}

	// on üldse olemas selline muutja
	if( isset( $_POST["signupEmail"] ) ){
		
		//jah on olemas
		//kas on tühi
		if( empty( $_POST["signupEmail"] ) ){
			
			$signupEmailError = "This field is empty!";
			
		} else {
			
			// email olemas 
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	} 
	
	if( isset( $_POST["signupPassword"] ) ){
		
		if( empty( $_POST["signupPassword"] ) ){
			
			$signupPasswordError = "This field is empty!";
			
		} else {
			
			// siia jõuan siis kui parool oli olemas - isset
			// parool ei olnud tühi -empty
			
			// kas parooli pikkus on väiksem kui 8 
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Password is too short";
			
			}
			
		}
		
	}
	
	if (isset ($_POST ["nickname"])){
		if (empty($_POST ["nickname"])){
			$nicknameError = "This field is empty!";
		}else {
			if (strlen ($_POST["nickname"])< 8) {
				$nicknameError = "Nickname is too short";
			}else {
				$nickname = $_POST ["nickname"];
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
	
	if ( isset($_POST["signupPassword"]) &&
		 isset($_POST["signupEmail"]) &&
		 isset($_POST["nickname"]) &&
		 empty($signupEmailError) && 
		 empty($signupPasswordError) &&
		 empty($nicknameError)) 
		 {
		
		// salvestame ab'i
		echo "Saving... <br>";
		
		echo "email: ".$signupEmail."<br>";
		//echo "password: ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		//echo "password hashed: ".$password."<br>";
		
		
		//echo $serverUsername;
		
		// KASUTAN FUNKTSIOONI
		$signupEmail = $Helper->cleanInput($signupEmail);
		
		$User->signUp($signupEmail, $Helper->cleanInput($password), $Helper->cleanInput($nickname));
		
	
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
	<div class="jumbotron text-center">
		<form><font face = "Comic Sans MS"><h1>EASY IDEAS FOR WEBSITE PROJECT</h1></font></form> 
	</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-md-offset-1 col-sm-offset-1">
				<form method = "POST">
					<div class="row">
						<div class="col-md-12 text-center">
							<h2 class="text-center">Sign in</h2>
						</div>
					</div>
					<p style="color:red;"><?=$error;?></p>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></span>
						<input class="form-control" id="loginEmail" name="loginEmail" type = "email" placeholder="Email" required value="<?=$loginEmail?>">
						<div class="help-block with-errors"></div>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input class="form-control" id="loginPassword" name="loginPassword" type = "password" placeholder="Password" required value="<?=$loginPassword?>">
						<div class="help-block with-errors"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4"></div>
							<div class="col-md-4 text-center">
								<input class = "btn btn-success btn-sm btn-block" type ="submit" value = "Log in">
							</div>
					</div>
				</form>
			</div>

			<div class="col-md-3 col-sm-3 col-md-offset-3 col-sm-offset-3">
				<form method = "POST">
					<div class="row">
						<div class="col-md-12 text-center">
							<h2 class="text-center">Create account</h2>
						</div>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></span>
						<input class="form-control" id="signupEmail" name="signupEmail" type = "email" placeholder="Email" value ="<?php echo $signupEmail; ?>"><?php echo $signupEmailError; ?>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input class="form-control" id="signupPassword" name="signupPassword" type="password" placeholder="Password"><?php echo $signupPasswordError; ?>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
						<input class="form-control" id="nickname" name ="nickname" type = "text" placeholder = "Nickname"><?php echo $nicknameError; ?>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4"></div>
							<div class="col-md-4 text-center">
								<input class = "btn btn-success btn-sm btn-block" type ="submit" value = "Sign up">
							</div>
					</div>
				</form>
			</div>
		</div>
</div>

<?php require("../footer.php"); ?>