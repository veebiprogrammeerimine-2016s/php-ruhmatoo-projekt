<?php
	require("../functions.php");

	require("../Class/Helper.Class.php");
	$Helper = new Helper();
	
	require("../Class/User.class.php");
	$User = new User($mysqli);
	
	if(isset ($_SESSION["userId"])) {
		header("Location: data.php");
		exit();
	}
	

	$loginEmailError = "";
	$loginEmail = "";
	$loginPasswordError = "";
	$loginPassword = "";
	
	if (isset ($_POST["signupEmail"])) {
		if (empty ($_POST["signupEmail"])) {
			$signupEmailError = "Can't be empty!";
		} else {
			$signupEmail = $_POST["signupEmail"];
		}
		
	}
	

	
	if (isset ($_POST["signupPassword"])) {
		if (empty ($_POST["signupPassword"])) {
			$signupPasswordError = "Can't be empty!";
		} else {
			if (strlen ($_POST["signupPassword"]) < 9 ) {
				$signupPasswordError = "Password must be at least 9 characters";
				
			}
			
		}
		
	}
	
	if ( isset($_POST["signupEmail"]) &&
		 isset($_POST["signupPassword"]) &&
		 $signupEmailError == "" && 
		 empty($signupPasswordError)
	   ) {
		echo "Saving...<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		$User->signUp($Helper->cleanInput($_POST['signupEmail']),
		$Helper->cleanInput ($password));
		
	}
	
	$error ="";
	if ( isset($_POST["loginEmail"]) && 
		isset($_POST["loginPassword"]) && 
		!empty($_POST["loginEmail"]) && 
		!empty($_POST["loginPassword"])
	  ) {
		  
		$error = $User->login($Helper->cleanInput($_POST["loginEmail"]), 
		$Helper->cleanInput($_POST["loginPassword"]));
		
	}
	
?>

<?php require("../header.php"); ?>

<style>
	.container-fluid {
		font-family: 'Open Sans', sans-serif;
		font-size: 13px;
	}
</style>

<div class="container-fluid">
    <div align="center">
	<div class="row">
        <div class="col-sm-4"></div>
		<div class="col-sm-4">
		<h1>Login</h1>
		<p style="color:red;"><?php echo $error; ?></p>
		<form method="POST">
			
			<label>Email</label><br>
			<input name="loginEmail" type="email"> <?php echo $loginEmailError; ?>
			
			<br><br>
			
			<label>Password</label><br>
			<input name="loginPassword" type="password"> <?php echo $loginPasswordError; ?>
						
			<br><br>
			
			<input type="submit" value="Login">
		
		</form>
	<div class="col-sm-4"></div>
	</div>	
	</div>
	</div>	
	</div>
	</div>
	</body>
</html>
<?php require("../footer.php"); ?>