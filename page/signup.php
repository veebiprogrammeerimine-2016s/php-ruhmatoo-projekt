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


















?>