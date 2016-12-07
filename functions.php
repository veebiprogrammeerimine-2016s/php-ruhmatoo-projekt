<?php

	require("../../config.php");
	session_start();
	
	$database = "if16_ksenbelo_4";
	
	//MUUTUJAD
	//REGISTREERIMINE
	$email = $password = $gender = $username = ""
	
	
	function signup($email,$password,$username,$gender) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"],
		$GLOBALS["serverUsername"],
		$GLOBALS["serverPassword"],
		$GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO grupp_user (email, password,username, gender) VALUES (?, ?, ?,?)");
		echo $mysqli->error;
		$stmt->bind_param("ssss",$email, $password,$username,$gender);
		
		if ($stmt->execute()) {
			echo "salvestamine õnnestus";
			header('Location:loginpage.php');
		} else {
			echo "ERROR ".$stmt->error;
		}
	}
?>