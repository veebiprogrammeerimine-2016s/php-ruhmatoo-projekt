<?php
	
	require("functions.php");

	$loginEmail="";
	$loginEmailError="";
	$loginPasswordError="";	
	
	$signupEmailError="";
	$signupPasswordError="";
	$signupNameError="";
	$signupFamilyError="";
	
	$signupName="";
	$signupFamily="";
	$signupEmail = "";
	
	if(isset($_POST["loginEmail"])){
		
		if(empty($_POST["loginEmail"])){
			
			$loginEmailError="E-mail is missing";
			
		}else{
			
			$loginEmail=$_POST["loginEmail"];
		}
	}
	
	if(isset($_POST["loginPassword"])){
		
		if(empty($_POST["loginPassword"])){
			
			$loginPasswordError="Password is missing";
			
		}else{
			
			$loginPassword=$_POST["loginPassword"];
		}
	}
	
	if(isset($_POST["signupEmail"])){
		
		if(empty($_POST["signupEmail"])){
			
			$signupEmailError = "E-mail is required ";
		
		}else{
			
			$signupEmail = $_POST["signupEmail"];
		}	
	}

	
	if(isset($_POST["signupPassword"])){
		
		if(empty($_POST["signupPassword"])){
			
			$signupPasswordError = "Password is required";
			
		}else{
			
			if(strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Password needs to be atleast 8 characters";				
			}			
		}
	}
	
	if(isset($_POST["signupName"])){
		
		if(empty($_POST["signupName"])){
			
			$signupNameError="First name is required";
			
		}else{
			
			$signupName=$_POST["signupName"];
		}
	}
	
	if(isset($_POST["signupFamily"])){
		
		if(empty($_POST["signupFamily"])){
			
			$signupFamilyError="Family name is required";
			
		}else{
			
			$signupFamily=$_POST["signupFamily"];
		}
	}
	
	
	if ( isset($_POST["signupEmail"]) && isset($_POST["signupName"]) && isset($_POST["signupFamily"]) && 
		 isset($_POST["signupPassword"]) && 
		 $signupEmailError == "" && 
		 empty($signupPasswordError)
		) {
		
		echo "Saving... <br>";
		
		echo "email: ".$signupEmail."<br>";
		echo "first name: ".$signupName."<br>";
		echo "family name: ".$signupFamily."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		signup($signupEmail, $password, $signupName, $signupFamily);
		
	
	}
	
	



?>

<?php require("header.php");?>
<div class="container">

	<div class="row">

		<div class="col-sm-4 col-sm-offset-4">
		
			
				<title>Log in or register</title>
				

				<body>
					<h2>Log in</h2>
				
					<form method="POST">
						
						<input name="loginEmail" placeholder="E-mail" type="text" value="<?=$loginEmail;?>"><br><br>
						
						<input name="loginPassword" placeholder="Password" type="password"><br><br>

						<input type="submit" value="Log in">
						
					</form>

				
					<h2>Register</h2>
				
					<form method="POST">
						
						<input name="signupEmail" placeholder="E-mail" type="text" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?> <br><br>
						
						<input name="signupPassword" placeholder="Password" type="password"> <?php echo $signupPasswordError; ?> <br><br>
						
						<input name="signupName" placeholder="First name" type="text"> <?php echo $signupNameError; ?> <br><br>
						
						<input name="signupFamily" placeholder="Family name" type="text"> <?php echo $signupFamilyError; ?> <br><br>
						
						<h4>Gender</h4>
						
						<input type="radio" name="Sugu" value="Male" checked> Male <br>
						
						<input type="radio" name="Sugu" value="Female"> Female <br>
						
						<input type="radio" name="Sugu" value="Other"> Other <br><br>
						
						<input type="submit" value="Register">
						
					</form>
				
				</body>
			
		
		</div>
	</div>
</div>