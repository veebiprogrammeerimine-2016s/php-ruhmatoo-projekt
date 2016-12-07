<?php

	require("../../config.php");
	session_start();
	
	$database = "if16_ksenbelo_4";
	
	//MUUTUJAD
	//REGISTREERIMINE
	
	function registration($email, $password, $nickname, $gender) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"],
		$GLOBALS["serverUsername"],
		$GLOBALS["serverPassword"],
		$GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO grupp_user (email, password, username,gender) VALUE (?, ?, ?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("ssss",$email, $password, $nickname, $gender);
		
		if ( $stmt->execute() ) {
			echo "õnnestus";
		} else {
			echo "ERROR ".$stmt->error;
		}	
	}

?>