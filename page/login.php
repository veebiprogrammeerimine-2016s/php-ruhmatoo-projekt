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
			$userNameError = "<font color='red'>See väli on kohustuslik!</font>";		
		} else {
			if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST["userName"])) { 
				$userNameError = "<font color='red'>Kasutajanimes võib kasutada <br> vaid tähti ja numbreid!</font>"; 
			} else {
				$userNameExists= $User->checkName($Helper->cleanInput($_POST["userName"]));
				if ($userNameExists == true ) {
					$userNameError = "<font color='red'>Selline kasutajanimi on juba kasutusel!</font>";
				} else {
					$userName = $_POST["userName"];
				}
			}
		}
	}
	
	if (isset ($_POST["firstName"]) ){
		if (empty ($_POST["firstName"]) ){
			$firstNameError = "<font color='red'>See väli on kohustuslik!</font>";		
		} else {
			//The preg_match() function searches a string for pattern, returning true if the pattern exists, and false otherwise.
			if (!preg_match("/^[a-zA-Z õäöüšž-]*$/",$_POST["firstName"])) { 
				$firstNameError = "<font color='red'>Pole nimi!</font>"; 
			} else {
				$firstName = $_POST["firstName"];
			}
		}
	}
	
	if (isset ($_POST["lastName"]) ){
		if (empty ($_POST["lastName"]) ){
			$lastNameError = "<font color='red'>See väli on kohustuslik!</font>";		
		} else {
			if (!preg_match("/^[a-zA-Z õäöüšž-]*$/",$_POST["lastName"])) { 
				$lastNameError = "<font color='red'>Pole nimi!</font>"; 
			} else {
				$lastName = $_POST["lastName"]; 
			}
		}
	}
	
	//kas e-post oli olemas
	if (isset ($_POST["signupEmail"]) ){ //kas keegi nuppu vajutas, kas signupEmail tekkis
		if (empty ($_POST["signupEmail"]) ){ //oli email, kuid see oli tühi
			//echo "email oli tühi";
			$signupEmailError = "<font color='red'>See väli on kohustuslik!</font>";		
		} else {
			$userEmailExists= $User->checkEmail($Helper->cleanInput($_POST["signupEmail"]));
			if ($userEmailExists == true ) {
				$signupEmailError = "<font color='red'>Selline email on juba kasutusel!</font>";
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
		<link rel="icon" href="../T_logo.png">
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

	<nav class="navbar_login">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="login.php">
			<img alt="Brand" src="../smaller_logo.png" width="300" >
		  </a>
		</div>
		
		<div class=" navbar-form navbar-left visible-xs">
			<p style='color:red;'><?php echo $loginEmailError; ?> <?php echo $loginPasswordError; ?><?=$notice;?></p>
			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">Logi sisse</button>

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
							
					<input type='submit' class="btn btn-sm btn-success" value = 'Logi sisse'> <br>
					
					<p style='color:red;'><?php echo $loginEmailError; ?> <?php echo $loginPasswordError; ?><?=$notice;?></p>
				</li>
			</ul>
		</form>
	  </div>
	</nav>
	
	<div class="signup col-sm-8 col-md-5" style="padding-left:20px;">
		<div class="row" style="padding-right:20px;">
			<div class="heading" style="padding-left:30px;">
			  <h1 style="color:black;">Loo kasutaja</h1> 	
			</div>
			<p style="color:green;"> <b> <?=$msg;?> </b> </p>
			
			<form method="POST">
				<div class="col-sm-5 col-md-6" style="padding-left:30px;">
					<label>Kasutajanimi<span style="color:red">*</span></label>
					<br>
					<input class="form-control" name="userName" type="text" value= "<?=$userName;?>"> <?php echo $userNameError; ?>
					
					<br>
					<label>Eesnimi<span style="color:red">*</span></label>
					<br>
					<input class="form-control" name="firstName" type="text" value= "<?=$firstName;?>"> <?php echo $firstNameError; ?>
					<br>
					
					<label>Perekonnanimi <span style="color:red">*</span></label>
					<br>
					<input class="form-control" name="lastName" type="text" value= "<?=$lastName;?>"> <?php echo $lastNameError; ?>
					<br>
					
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
				</div>
				
				<div class="col-sm-5 col-md-6" style="padding-left:30px;">
					<label>E-Post <span style="color:red">*</span></label>
					<br>
					<input class="form-control" name="signupEmail" type="email" value= "<?=$signupEmail;?>" > <?php echo $signupEmailError; ?> <!--jätab signupEmaili meelde väljale-->
					<br>
					
					<label>Parool <span style="color:red">*</span></label>
					<br>
					<input class="form-control" name="signupPassword" type="password">  <?php echo $signupPasswordError; ?>
					<br>
					
					<label>Telefoni number</label> <!--Jätan vabatahtlikuks väljaks-->
					<br>
					<input class="form-control" name="phoneNumber" type="text" value= "<?=$phoneNumber;?>"> <?php echo $phoneNumberError; ?>
					<br>
					<span style="color:red; font-size: 12pt;"> * </span><span style=" color:red; font-size: 10pt">Kohustuslik väli  &#8194 </span>
					<input type="submit" class = "btn btn-success btn-sm" value = "Loo kasutaja">
				</div>
			</form>
		  </div>
			<br><br>
	</div>
	<div class="col-sm-9 col-md-9" style="padding-left:5%; padding-top:5%;">
		<h3 class="bottom" style="color:white;"><i>Mis on TREENI.EE?</i></h3>
		<p style="color: white;"><i>TREENI.EE abil on võimalik lihtsalt ja mugavalt pidada treeningpäevikut, kasutada foorumit, kust leida vastuseid spordiga seonduvatele küsimustele ning lisaks on võimalus leida endale ka treeningpartner.</i><p>
	</div>
	
</body>
</html>
