<?php

	require("../../../config.php");
	require("../functions.php");
	
	if(isset($_SESSION["userId"])){
		
		header("Location: productselect.php");
		exit();	
	}
	$signinUserError= "";
	$signinPasswordError= "";
	$signinuser= "";
	
	$error="";
	if(isset($_POST["loginuser"]) && isset($_POST["loginpassword"]) &&
		!empty($_POST["loginuser"]) && !empty($_POST["loginpassword"])
		) {
		
		$error = $User->login ($Helper->cleanInput($_POST["loginuser"]), $Helper->cleanInput($_POST["loginpassword"]));
	}
	
	if(isset($_POST["loginuser"])){
		if(empty($_POST["loginuser"])){
			$signinUserError= "Kasutajanimi on kohustuslik!";
		}else{
			$signinuser = $_POST["loginuser"];
		}
	}
	
	if(isset($_POST["loginpassword"])){
		if(empty($_POST["loginpassword"])){
			$signinPasswordError= "Parool on kohustuslik!";		
		}
	}





?>





