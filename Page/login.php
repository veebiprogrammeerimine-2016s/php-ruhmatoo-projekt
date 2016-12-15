<?php
	require("../functions.php");

	require("../Class/Helper.Class.php");
	$Helper = new Helper();
	
	require("../Class/User.class.php");
	$User = new User($mysqli);
	
	if(isset ($_SESSION["userId"])) {
		header("Location: data.php");
		exit();
	}
	
	$signupEmailError = "";
	$signupEmail = "";
	
	if (isset ($_POST["signupEmail"])) {
		
		if (empty ($_POST["signupEmail"])) {
			
			$signupEmailError = "See väli on kohustuslik";
			
		} else {
				
			$signupEmail = $_POST["signupEmail"];
		}
		
	}
?>