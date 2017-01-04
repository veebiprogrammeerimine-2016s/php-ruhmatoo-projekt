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
	
	$signupEmailError = "";
	$signupEmail = "";
	$signupPasswordError = "";
	$signupPassword = "";
	$signupUsernameError = "";
	$signupUsername = "";
	
	if (isset ($_POST["signupEmail"])) {
		if (empty ($_POST["signupEmail"])) {
			$signupEmailError = "Can't be empty!";
		} else {
			$signupEmail = $_POST["signupEmail"];
		}
		
	}
	
if (isset ($_POST["signupUsername"])) {
		if (empty ($_POST["signupUsername"])) {
			$signupUsernameError = "Can't be empty!";
		} else {
			$signupUsername = $_POST["signupUsername"];
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
		 isset($_POST["signupUsername"]) &&
		 isset($_POST["signupPassword"]) &&
		 $signupEmailError == "" && 
		 $signupUsernameError == "" &&
		 empty($signupPasswordError)
	   ) {
		echo "Saving...<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		$User->signUp($Helper->cleanInput($_POST['signupEmail']),$Helper->cleanInput($_POST['signupUsername']),
		$Helper->cleanInput ($password));
		
	}
	
?>

<?php require("../header.php"); ?>
<div style="width:500px; margin:100px auto;">
<div class="container">

    <div class="row">

        <div class="col-sm-3">
		
		<h1>Create an account</h1>
		
		<form method="POST">
			
			<label>Email</label><br>
			<input name="signupEmail" type="email"> <?php echo $signupEmailError; ?>
			
			<br><br>
			
			<label>Username</label><br>
			<input name="signupUsername" type="username"> <?php echo $signupUsernameError; ?>
			
			<br><br>
			
			<label>Password</label><br>
			<input placeholder="Parool" name="signupPassword" type="password"> <?php echo $signupPasswordError; ?>
						
			<br><br> 
			
			<input type="submit" value="Save">
		
		</form>
	</div>
	</body>
</html>