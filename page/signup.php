<?php

	require("../../../config.php");
	require("../functions.php");
	if(isset($_SESSION["userId"])){
		
		header("Location: productselect.php");
		exit();
	}

	$signupemail = "";
	$signupEmailError= "";
	$signupPasswordError= "";
	$reenterpasswordError= "";

	$signupFirstname = "";
	$signupFirstnameError = "";
	$signupLastname = "";
	$signupLastnameError = "";
	
	$signupGender = "";
	$signupGenderError = "";
	
	$signupUsername = "";
	$signupUsernameError = "";
	$signupBDay = "";
	$signupBDayError = "";
	$signupBMonth = "";
	$signupBMonthError = "";
	$signupBYear = "";
	$signupBYearError = "";

	if(isset($_POST["signupemail"])){
		if(empty($_POST["signupFirstname"])) {
			$signupFirstnameError= "See vali on kohustuslik";
		} else {
			$signupFirstname = $_POST["signupFirstname"];
		}
		
		if(empty($_POST["signupLastname"])) {
			$signupLastnameError= "See vali on kohustuslik";
		} else {
			$signupLastname = $_POST["signupLastname"];
		}
		
		if(empty($_POST["signupUsername"])) {
			$signupUsernameError= "See vali on kohustuslik";
		} else {
			$signupUsername = $_POST["signupUsername"];
		}
		
		if(empty($_POST["signupemail"])){
			$signupEmailError= "See vali on kohustuslik";
		}else{
			$signupemail = $_POST["signupemail"];
		}
		
		if(isset($_POST["signuppassword"])){
		if(empty($_POST["signuppassword"])){
			$signupPasswordError= "See vali on kohustuslik";
		} else {
			if( strlen($_POST["signuppassword"]) <8 ){
				$signupPasswordError = "Parool peab olema vahemalt 8 tahemarki pikk";
			}
		}
		}
	
		if(isset($_POST["reenterpassword"])){
		if($_POST["reenterpassword"] == $_POST["signuppassword"]){			
			$reenterpasswordError= "";
		} else {
			$reenterpasswordError= "Parool peab olema sama";
		}
		}

		if(isset($_POST["signupGender"])) {
			$signupGender = $_POST["signupGender"];
		} else {
			$signupGenderError= "See vali on kohustuslik";
		}
		
		if(empty($_POST["signupAge"])) {
			$signupAgeError= "See vali on kohustuslik";	
		} else {
			$signupAge = $_POST["signupAge"];
		}


		if(empty($_POST["signupBDay"])) {
			$signupBDayError= "Paev ";
		} else {
			
			if(32>($_POST["signupBDay"])) {
				$signupBDay = $_POST["signupBDay"];
			} else {
				$signupBDayError="Sellist paeva pole ";
			}
		}
		
		if(empty($_POST["signupBMonth"])) {
			$signupBMonthError= "Kuu ";
		} else {
			if(13>($_POST["signupBMonth"])) {
				$signupBMonth = $_POST["signupBMonth"];
			} else {
				$signupBMonthError="Sellist kuud pole ";
			}
		}
		
		if(empty($_POST["signupBYear"])) {
			
			$signupBYearError= "Aasta ";
			
		} else {
			
			if(2017>($_POST["signupBYear"])) {
				$signupBYear = $_POST["signupBYear"];
			} else {
				$signupBYearError="Sellist aastat pole ";
			}
		}
		
	}
	if(isset($_POST["signupemail"]) &&		isset($_POST["signuppassword"]) &&			isset($_POST["signupFirstname"]) &&
		isset($_POST["signupLastname"]) &&		isset($_POST["signupGender"]) &&		isset($_POST["signupUsername"]) &&
		isset($_POST["signupBDay"]) &&		isset($_POST["signupBMonth"]) &&		isset($_POST["signupBYear"]) &&
		$signupEmailError=="" &&
		$signupPasswordError=="" &&
		$signupFirstnameError=="" &&
		$signupLastnameError=="" &&
		$signupGenderError=="" &&
		$signupUsernameError=="" &&
		$signupBDayError=="" &&
		$signupBMonthError=="" &&
		$signupBYearError==""
		) {
		
		$signupDoB = $signupBYear . '-' . $signupBMonth . '-' . $signupBDay;
		$password = hash("sha512", $_POST["signuppassword"]);

		$User->signUp($Helper->cleanInput($signupemail), $Helper->cleanInput($password), $Helper->cleanInput($signupFirstname), $Helper->cleanInput($signupLastname), $Helper->cleanInput($signupGender), $Helper->cleanInput($signupUsername), $Helper->cleanInput($signupDoB)); 	
	}

?>