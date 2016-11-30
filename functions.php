<?php


	require("/home/rasmaavi/config.php");

    $database = "if16_Aavister";
    $mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);

    //require("class/user.class.php");
    //$User = new User($mysqli);

	session_start();


	function cleanInput($input){
		
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		
		return $input;
		
	}
	
	
?>