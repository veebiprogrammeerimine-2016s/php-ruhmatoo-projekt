<?php

//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/User.class.php");      //peab olema ENNE ojekti loomist
$User = new User($mysqli);               //objekt          


// MUUTUJAD

$loginEmail = "";
$loginPassword = "";
$loginMsg = "";
$loginEmailError = $loginPasswordError = "*";

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
<div class="new">
<div class="notleft">
<br><br>
<h4>Logi sisse</h4>

<form method="post" class="form-inline">

<input name="loginEmail" type="text" placeholder="E-post" value="<?=$loginEmail;?>" class="form-control focusedInput">  <span class="text-danger"><?php echo $loginEmailError; ?></span>
<br>
<input name="loginPassword" type="password" placeholder="Salasõna" class="form-control focusedInput"> <span class="text-danger"><?php echo $loginPasswordError; ?></span>
<br>
<br>
<input name="login" type="submit" value="Logi sisse" class="btn btn-default">
</form>
<form method="post">
<br>
<br>
<p><?php echo $loginMsg; ?></p>
</div>
</div>
<?php require("../footer.php");?>