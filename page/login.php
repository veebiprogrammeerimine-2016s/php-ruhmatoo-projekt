<?php 
	//võtab ja kopeerib faili sisu
	require("../functions.php");
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	require("../CSS.php");
	
	//var_dump - näitab kõike, mis muutuja sees
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	
	//MUUTUJAD
	$loginEmailError = "";
	$loginPasswordError = "";
	$userNameError = "";
	$firstNameError = "";
	$lastNameError = "";
	$signupEmailError = "";
	$signupPasswordError = "";
	$phoneNumberError = "";
	
	$userName = "";
	$firstName = "";
	$lastName = "";
	$loginEmail = "";
	$signupEmail = "";
	$gender = "";
	$phoneNumber = "";
	
	$msg="";
	
	if (isset ($_POST["loginEmail"]) ){
		if (empty ($_POST["loginEmail"]) ){
			$loginEmailError = "Palun sisesta e-post! &#8194 &#8194 &#8194 &#8194";		
		} else {
			$loginEmail = $_POST["loginEmail"];
		}
	}
	
	if (isset ($_POST["loginPassword"]) ){ 
		if (empty ($_POST["loginPassword"]) ){ 
			$loginPasswordError = "Palun sisesta parool!";		
		}
	}
	
	if (isset ($_POST["userName"]) ){
		if (empty ($_POST["userName"]) ){
			$userNameError = "<br><font color='red'>See väli on kohustuslik!</font>";		
		} else {
			if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST["userName"])) { 
				$userNameError = "<br><font color='red'>Kasutajanimes võib kasutada <br> vaid tähti ja numbreid!</font>"; 
			} else {
				$userNameExists= $User->checkName($Helper->cleanInput($_POST["userName"]));
				if ($userNameExists == true ) {
					$userNameError = "<br><font color='red'>Selline kasutajanimi on juba kasutusel!</font>";
				} else {
					$userName = $_POST["userName"];
				}
			}
		}
	}
	
	if (isset ($_POST["firstName"]) ){
		if (empty ($_POST["firstName"]) ){
			$firstNameError = "<br><font color='red'>See väli on kohustuslik!</font>";		
		} else {
			//The preg_match() function searches a string for pattern, returning true if the pattern exists, and false otherwise.
			if (!preg_match("/^[a-zA-Z õäöüšž-]*$/",$_POST["firstName"])) { 
				$firstNameError = "<br><font color='red'>Pole nimi!</font>"; 
			} else {
				$firstName = $_POST["firstName"];
			}
		}
	}
	
	if (isset ($_POST["lastName"]) ){
		if (empty ($_POST["lastName"]) ){
			$lastNameError = "<br><font color='red'>See väli on kohustuslik!</font>";		
		} else {
			if (!preg_match("/^[a-zA-Z õäöüšž-]*$/",$_POST["lastName"])) { 
				$lastNameError = "<br><font color='red'>Pole nimi!</font>"; 
			} else {
				$lastName = $_POST["lastName"]; 
			}
		}
	}
	
	//kas e-post oli olemas
	if (isset ($_POST["signupEmail"]) ){ //kas keegi nuppu vajutas, kas signupEmail tekkis
		if (empty ($_POST["signupEmail"]) ){ //oli email, kuid see oli tühi
			//echo "email oli tühi";
			$signupEmailError = "<br><font color='red'>See väli on kohustuslik!</font>";		
		} else {
			$userEmailExists= $User->checkEmail($Helper->cleanInput($_POST["signupEmail"]));
			if ($userEmailExists == true ) {
				$signupEmailError = "<br><font color='red'>Selline email on juba kasutusel!</font>";
			} else {
				//email on õige, salvestan väärtuse muutujasse
				$signupEmail = $_POST["signupEmail"];
			}
		}
	}
	
	if (isset ($_POST["signupPassword"]) ){ 
		if (empty ($_POST["signupPassword"]) ){ 
			$signupPasswordError = "<font color='red'>See väli on kohustuslik!</font>";		
		} else {
			//tean, et oli parool ja see ei olnud tühi
			if (strlen($_POST["signupPassword"]) < 8){ //strlen- stringi pikkus
				$signupPasswordError = "<font color='red'>Parool peab olema vähemalt 8 tähemärki pikk!</font>";
			}
		}
	}
	
	if (isset ($_POST["gender"]) ){ 
		if (empty ($_POST["gender"]) ){ 
			$genderError = "";
		} else {
			$gender = $_POST["gender"];
		}
	}
	
	if (isset ($_POST["phoneNumber"]) ){
		if (empty ($_POST["phoneNumber"]) ){ 
			$phoneNumberError = "";
		} else {
			if (ctype_digit($_POST["phoneNumber"])){ //ctype_digit- checks if all of the characters in the Provided string, text, are numerical.
				$phoneNumberError = "";		
				$phoneNumber = $_POST["phoneNumber"];
			} else {
				$phoneNumberError = "<font color='red'>Ainult numbrid on lubatud!</font>";
			}
		}
	}
	
	//Kus tean, et ühtegi viga ei olnud ja saan kasutaja andmed salvestada.
	if (isset ($_POST["userName"])
		&& isset ($_POST["firstName"])
		&& isset ($_POST["lastName"])
		&& isset($_POST["signupEmail"])
		&& isset ($_POST["signupPassword"])
		//pole kohustuslik	&& isset ($_POST["gender"])
		//pole kohustuslik	&& isset ($_POST["phoneNumber"])
		&& empty($userNameError) 
		&& empty($firstNameError) 
		&& empty($lastNameError) 
		&& empty($signupEmailError) 
		&& empty($signupPasswordError)
		&& empty($phoneNumberError) ){
			
		/*echo "Salvestan...<br>";
		echo "eesnimi ".$firstName."<br>";
		echo "perenimi ".$lastName."<br>";
		echo "email ".$signupEmail."<br>";*/
		
		$password = hash("sha512", $_POST["signupPassword"]); //hash(algoritm,parool)
		/*echo "parool ".$_POST["signupPassword"]."<br>";
		echo "räsi".$password."<br>";
		
		echo "sugu ".$gender."<br>";
		echo "telefoni number ".$phoneNumber."<br>";*/
		
		//echo $serverPassword;
		$msg = $User->signup($Helper->cleanInput($userName), $Helper->cleanInput($firstName), $Helper->cleanInput($lastName), $Helper->cleanInput($signupEmail), $Helper->cleanInput($password), $Helper->cleanInput($gender), $Helper->cleanInput($phoneNumber)); //cleanInput igale muutujale eraldi teha
	}
	
	$notice = "";
	//Kontrollin, et kasutaja täitis välja ja võib sisse logida 
	if (isset ($_POST["loginEmail"]) && 
		isset ($_POST["loginPassword"]) && 
		!empty ($_POST["loginEmail"]) && 
		!empty ($_POST["loginPassword"])
		){
			//login sisse
			$notice= $User->login($Helper->cleanInput($_POST["loginEmail"]), $Helper->cleanInput($_POST["loginPassword"])); //functions error kandus üle notice muutujasse login funktsiooniga
		}
		
		
?>

<!DOCTYPE html>
<html>
	<head class="header">
		<title>TREENI.EE</title>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
		
	<body class="background" background="../esilehele.jpg">

	<nav class="navbar">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="login.php">
			<img alt="Brand" src="../smaller_logo.png" width="300" height="200">
		  </a>
		</div>
		
		<div class=" navbar-form navbar-left visible-xs">
			<p style='color:red;'><?php echo $loginEmailError; ?> <?php echo $loginPasswordError; ?><?=$notice;?></p>
			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Logi sisse</button>

			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">
			  
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Logi sisse</h4>
				  </div>
				  <div class="modal-body">
					<form class="pop_up_form" method='POST'>
						<ul class="nav navbar-nav">
							 <li class="active">
							 
								<input name='loginEmail' type='email' placeholder='E-post' class="form-control input-sm"  value= '<?=$loginEmail;?>'>
										
								<input name='loginPassword' type='password' class="form-control input-sm" placeholder='Parool'>
										
								<input type='submit' value = 'Logi sisse'> <br>
							
							</li>
						</ul>
					</form>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Välju</button>
				  </div>
				</div>

			  </div>
			</div>
		</div>
	
		<form class="navbar-form navbar-left pull-right hidden-xs" method='POST'>
			<ul class="nav navbar-nav">
				 <li class="active">
					<input name='loginEmail' type='email' placeholder='E-post' class="form-control input-sm"  value= '<?=$loginEmail;?>'>
							
					<input name='loginPassword' type='password' class="form-control input-sm" placeholder='Parool'>
							
					<input type='submit' value = 'Logi sisse'> <br>
					
					<p style='color:red;'><?php echo $loginEmailError; ?> <?php echo $loginPasswordError; ?><?=$notice;?></p>
				</li>
			</ul>
		</form>
	  </div>
	</nav>
	
	<!--<div class="signup col-sm-5" style="background: rgba(240, 240, 240, .5);"> Proovi bootstrap row fluid-->
	
	<div class="signup_background">
	<div class="heading" style="padding-left:30px;">
		<h1 style="color:black;">Loo kasutaja</h1>	
	</div>
	<div class="login" style="padding-left:20px;">
		<!--<div class="row">-->
		<!--<div class="col-sm-5"> -->
		<div class="first_forms">
		<!--<br>-->
		<p style="color:green;"> <b> <?=$msg;?> </b> </p>
		
		
		<form method="POST">
			<label>Kasutajanimi <span style="color:red">*</span></label>
			<br>
			<input name="userName" type="text" value= "<?=$userName;?>"> <?php echo $userNameError; ?>
			
			<br><br>
			<label>Eesnimi <span style="color:red">*</span></label>
			<br>
			<input name="firstName" type="text" value= "<?=$firstName;?>"> <?php echo $firstNameError; ?>
			<br><br>
			
			<label>Perekonnanimi <span style="color:red">*</span></label>
			<br>
			<input name="lastName" type="text" value= "<?=$lastName;?>"> <?php echo $lastNameError; ?>
			<br><br>
		
			<label>E-Post <span style="color:red">*</span></label>
			<br>
			<input name="signupEmail" type="email" value= "<?=$signupEmail;?>" > <?php echo $signupEmailError; ?> <!--jätab signupEmaili meelde väljale-->
			<br><br>
			
			</div>
			<!--<div style="padding-top:20px;">-->
			<div class="last_forms">
			
			<br>
			<label>Parool <span style="color:red">*</span></label>
			<br>
			<input name="signupPassword" type="password"> <br> <?php echo $signupPasswordError; ?>
			<br><br>
			
			
			<label>Sugu:</label> <!--Jätan vabatahtlikuks väljaks-->
			<?php if($gender == "female") { ?>
			<input type="radio" name="gender" value="female" checked>Naine
			<?php } else { ?>
			<input type="radio" name="gender" value="female">Naine
			<?php } ?>
			
			<?php if($gender == "male") { ?>
			<input type="radio" name="gender" value="male" checked>Mees
			<?php } else { ?>
			<input type="radio" name="gender" value="male">Mees
			<?php } ?>
			<br><br>
			
			<label>Telefoni number</label> <!--Jätan vabatahtlikuks väljaks-->
			<br>
			<input name="phoneNumber" type="text" value= "<?=$phoneNumber;?>"> <br> <?php echo $phoneNumberError; ?>
			<br><br>
			
			<input type="submit" value = "Loo kasutaja">
			
			<br><br><br><br>
			<p><i><span style="color:red; font-size: 20pt"> &#8194  &#8194  &#8194  &#8194  &#8194  &#8194   * </span><span style=" color:red; font-size: 12pt">Kohustuslik väli</span></i></p>
			
		</form>
		<br><br>
		</div>
		<!--</div>-->
		</div>
		<p class="bottom" style="color:white;">Mis on TREENI.EE? &#8194  &#8194 Kontakt</p>
	</div>
	</body>
</html>
