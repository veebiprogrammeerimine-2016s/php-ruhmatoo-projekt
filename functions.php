<?php

	require("../../config.php");

	session_start();

	$database = "if16_kristarn";
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	
	require("User.Class.php");
	$User = new User($mysqli);


	function cleanInput ($input) {
		
		$input = trim($input);
		
		//võtab välja "\"
		$input = stripslashes($input);
		
		//html asendused nt.\ asemel unicode
		$input = htmlspecialchars($input);
		
		return $input;
		
	}




?>