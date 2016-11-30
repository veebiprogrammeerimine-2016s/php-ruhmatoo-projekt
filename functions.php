<?php


	require("/home/rasmaavi/config.php");
    $database = "if16_Aavister";
    $mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	
	require("class/Car.class.php");
	$Car = new Car($mysqli);

    require("class/User.class.php");
    $User = new User($mysqli);

	session_start();
	

	function cleanInput($input){
		
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		
		return $input;
		
	}
?>