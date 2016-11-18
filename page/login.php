<?php

//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/User.class.php");      //peab olema ENNE ojekti loomist
$User = new User($mysqli);               //objekt          


// MUUTUJAD

$loginEmail = "";
$loginPassword = "";
$loginMsg = "";
$loginEmailError = $loginPasswordError = "";

// kui on juba sisse loginud siis suunan avalehele
if (isset($_SESSION["userId"])){
	session_destroy();
	header("Location: login.php?logout=true");
	//exit();		
}

if(isset($_POST["loginEmail"]) && isset($_POST["loginPassword"]) &&
!empty($_POST["loginEmail"]) && !empty($_POST["loginPassword"])) {
		
		$loginEmail = $Helper->cleanInput($_POST["loginEmail"]);
		$loginPassword = $Helper->cleanInput($_POST["loginPassword"]);
		$loginMsg = $User->login($loginEmail, $loginPassword);   //kutsun funktsiooni
}
if(isset($_POST["loginEmail"])){
	if(empty($_POST["loginEmail"])){
		$loginEmailError = "Kohustuslik väli";
	}else{
		$loginEmail = $_POST["loginEmail"];
	}
}
if(isset($_POST["loginPassword"] )){
	if(empty($_POST["loginPassword"])){
		$loginPasswordError = "Kohustuslik väli";
	}
}
?>

<?php
//HTML
require("../header.php");
?>

<p>Logi sisse</p>

<form method="post">

<input name="loginEmail" type="text" placeholder="E-post" value="<?=$loginEmail;?>">  <?php echo $loginEmailError; ?>
<br>
<input name="loginPassword" type="password" placeholder="Salasõna"> <?php echo $loginPasswordError; ?>
<br>
<br>
<input name="login" type="submit" value="Logi sisse">
</form>
<form method="post">
<br>
<br>
<p><?php echo $loginMsg; ?></p>
<?php require("../footer.php");?>