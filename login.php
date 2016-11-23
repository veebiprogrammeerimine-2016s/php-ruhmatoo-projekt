<?php
	
	$signupEmailError = "";
	$signupPasswordError = "";
	
	// kas e-post oli olemas?
	if (isset ($_POST["signupEmail"]) ) {
	
		if (empty ($_POST["signupEmail"]) ) { 
			//oli email, aga t�hi
			$signupEmailError = "See v�li on kohustuslik!";
		}
	}

	if (isset ($_POST["signupPassword"]) ) {
	
		if (empty ($_POST["signupPassword"]) ) { 
			$signupPasswordError = "See v�li on kohustuslik!";
		
		} else {
			// tean et parool ja see ei olnud t�hi
			// V�HEMALT 8t�hem�rki
			
			if (strlen ($_POST["signupPassword"]) <= 8 ){
				$signupPasswordError = "Parool peab olema 8 t�hem�rki pikk!";
			}
		}
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise lehek�lg</title>
	</head>
	<body>

		<h1>Logi sisse</h1>

		<form method="POST"> <!-- varjatud salas�na jms -->
		
			<!--<label>E-post</label> ... nimi j��b v�lja �les-->
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