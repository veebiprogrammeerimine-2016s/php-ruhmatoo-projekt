<?php
	
	require("../../config.php");
	require("functions.php");
	
	//MUUTUJAD LOGIN
	$loginEmailError = $loginPasswordError = $loginEmail = "";
	$signupEmailError = $signupEmail = $signupPasswordError = "";
	//MUUTUJAD REGISTER
	$signupEmail = $signupPassword = $signupEmailError = $signupPasswordError = "";
	

	//LOOGIMINE SISSE EMAIL
	if (isset ($_POST["loginEmail"])) {
		if (empty ($_POST["loginEmail"])) {
		$loginEmailError = "* Väli on kohustuslik!";
	} else {
		//EMAIL ON KORRAS
		$loginEmail = $_POST ["loginEmail"];
		}
	}
	
	//LOOGIMINE SISSE PAROOL
	if (isset ($_POST["loginPassword"])) {
		if (empty ($_POST["loginPassword"])) {
		$loginPasswordError = "* Väli on kohustuslik!";
		} else {	
		if (strlen ($_POST["loginPassword"]) <6)
		$loginPasswordError = "* Parool peab olema vähemalt 6 tähemärkki pikk!";
		}
	}
	
	// KÕIK ON KORRAS
	if(isset($_POST["loginEmail"]) && 
		isset($_POST["loginPassword"]) &&
		!empty($_POST["loginEmail"]) && 
		!empty($_POST["loginPassword"])
		)
	
	
	//EMAILREGISTREERIMINE
	if (isset ($_POST["signupEmail"])) {
		if (empty ($_POST["signupEmail"])) {
		$signupEmailError = "* Väli on kohustuslik!";
		} else {
		//KUI EMAIL ON KORRAS
		$signupEmail = $_POST["signupEmail"];
		}
	}
	
	//PAROOL	
	if (isset ($_POST["signupPassword"])) {
		if (empty ($_POST["signupPassword"])) {
		$signupPasswordError = "* Väli on kohustuslik!";
		} else {	
		}if (strlen ($_POST["signupPassword"]) <6)
		$signupPasswordError = "* Parool peab olema vähemalt 6 tähemärkki pikk!";
	}
	
	// KÕIK ON KORRAS
	if( isset($_POST["signupEmail"]) &&
		isset($_POST["signupPassword"]) &&
		empty($signupPasswordError)&&
		empty($signupEmailError)
	)
	
	$error = "";

	{
	$error =login($_POST["loginEmail"], $_POST["loginPassword"]);
	$signupPassword = hash("sha512", $_POST["signupPassword"]);
	signup($signupEmail, $signupPassword,$_POST["signupSugu"]);
	}
?>