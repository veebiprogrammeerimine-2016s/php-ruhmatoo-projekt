<?php 
	require("functions.php");

	if (isset($_SESSION["userId"])){

		header("Location: homepage.php");
		exit();
	}
	
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupEmail = "";
	

	if( isset( $_POST["signupEmail"] ) ){

		if( empty( $_POST["signupEmail"] ) ){
			
			$signupEmailError = "See v�li on kohustuslik";
			
		} else {
			
			$signupEmail = $_POST["signupEmail"];
		}
	} 
	
	if( isset( $_POST["signupPassword"] ) ){
		
		if( empty( $_POST["signupPassword"] ) ){
			
			$signupPasswordError = "Parool on kohustuslik";
			
		} else {
			
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Parool peab olema v�hemalt 8 t�hem�rkki pikk";
			
			}
		}
	}
	
	if ( isset($_POST["signupEmail"]) && 
		 isset($_POST["signupPassword"]) && 
		 $signupEmailError == "" && 
		 empty($signupPasswordError)
		) {
		
		echo "Salvestan... <br>";
		
		echo "email: ".$signupEmail."<br>";
		echo "password: ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "password hashed: ".$password."<br>";
		
		$signupEmail = cleanInput($signupEmail);
		
		$User->signUp($signupEmail, cleanInput($password));
	}
	
	
	$error ="";
	if ( isset($_POST["loginEmail"]) && 
		isset($_POST["loginPassword"]) && 
		!empty($_POST["loginEmail"]) && 
		!empty($_POST["loginPassword"])
	  ) {
		  
		$error = $User->login(cleanInput($_POST["loginEmail"]), cleanInput($_POST["loginPassword"]));
		
	}
	
?>


<?php require ("header.php");?>

<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<img src="Logo.png" alt="Firma logo" style="width:250px;height:200px;">
			</div>
			<div class="col-sm-3">
				<h1>Logi sisse</h1>
				<form method="POST">
					<p style="color:red;"><?=$error;?></p>
					<br>
					<div class="form-group">
						<input class="form-control" name="loginEmail" placeholder="Email" type="text">
					</div>
					<class="form-group">
						<input class="form-control" type="password" name="loginPassword" placeholder="Parool">	
						<br>
					<input class="btn btn-success btn-sm" type="submit" value="Logi sisse">
					<br>
					<a class="btn btn-success btn-sm" href="create.php"> Registreeri</a>
				</form>
			</div>
		</div>
</div>
	

	
<?php require ("footer.php");?>
