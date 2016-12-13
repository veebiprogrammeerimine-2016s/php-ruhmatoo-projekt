<?php

	require("../../config.php");

	session_start();
	
	//*****************
	//**** SIGNUP *****
	//*****************	
		
	function signUp ($username, $email, $password, $website, $comment, $age)	{
		
		$database = "if16_ege";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
	
		//sqli rida
		$stmt = $mysqli->prepare("INSERT INTO user_tv (username, email, password, age) VALUES (?, ?, ?, ?)");
		
		echo $mysqli->error;
		
		$stmt->bind_param("ssss", $username, $email, $password, $age);
		
		//täida käsku
		if($stmt ->execute() ) {
			
			echo "salvestamine õnnestus";
			
		} else {
			echo "ERROR ". $stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	//*******************
	//******LOG IN*******
	//*******************
	
		
	function login ($username, $password) {
		
		$error = "";
		
		
		$database = "if16_ege";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
	
		//sqli rida
		$stmt = $mysqli->prepare("
		SELECT id, username, email, password, created 
		FROM user_tv WHERE username = ?");
		
		echo $mysqli->error;
		
		$stmt->bind_param("s", $username);
		
		$stmt->bind_result($id, $usernameFromDb, $emailFromDb, $passwordFromDb, $created);
		$stmt->execute();
		

		if($stmt->fetch()){
			
		$hash = hash("sha512", $password);
		if ($hash == $passwordFromDb) {
			echo "kasutaja logis sisse" .$id;
			
			$_SESSION["userId"] = $id;
			$_SESSION["userName"]= $usernameFromDb;
			$_SESSION["userEmail"] = $emailFromDb;
			
			$_SESSION["message"] = "<h1>Tere tulemast!</h1>";
			
			header("Location: data.php");
			exit();
			
		} else {
			$error = "vale parool";
			
		}
		
		} else {
			
			$error = "ei ole sellist kasutajanime";
		}
			
		return $error; 
		
	}	

		
		
	function cleanInput($input){
		
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		
	return $input;	
		
		
		
		
	}
		
		
		
		
		
		
		
		
		

		
		

?>