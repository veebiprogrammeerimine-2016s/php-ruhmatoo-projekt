<?php
	
	$signupEmailError = "";
	$signupPasswordError = "";
	
	if (isset ($_POST["signupEmail"]) ) {
	
		if (empty ($_POST["signupEmail"]) ) { 
			
			$signupEmailError = "See väli on kohustuslik!";
		}
	}

	if (isset ($_POST["signupPassword"]) ) {
	
		if (empty ($_POST["signupPassword"]) ) { 
			$signupPasswordError = "See väli on kohustuslik!";
		
		} else {
			
			if (strlen ($_POST["signupPassword"]) <= 8 ){
				$signupPasswordError = "Parool peab olema 8 tähemärki pikk!";
			}
		}
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise lehekülg</title>
	</head>
	<body>

		<h1>Logi sisse</h1>

		<form method="POST"> 
		
			<input name="loginEmail" type="email" placeholder="E-maili aadress">
			
			<br><br>
			
			<input name="loginPassword" type="password" placeholder="Parool">
			
			<br><br>
			
			<input type="submit" value="Logi sisse">
		
		</form>
		
		<br><br>
		
		<h1>Loo kasutaja</h1>
		
		<form method="POST"> 
		
			<input name="signupEmail" type="email" placeholder="E-maili aadress"> <?php echo $signupEmailError; ?>
			
			<br><br>
			
			<input name="signupPassword" type="password" placeholder="Parool"> <?php echo $signupPasswordError; ?>
			
			<br><br>
			
			<input type="submit" value="Loo kasutaja">
		
		</form>
		<!--Testing ISSUE   !-->
	</body>
</html>