<?php

	require("../../config.php");

	session_start();

	$database = "if16_raitkeer";


	function signup($email, $password, $firstName, $surname, $gender) {

		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO WasteChase_User (Email, Password, FirstName, LastName, Gender) VALUE (?, ?, ?, ?, ?)");
		
		$stmt->bind_param("sssss", $email, $password, $firstName, $surname, $gender);
		
		$stmt->execute();
	
	}

	function login($email, $password) {
		
		$notice = "";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT ID, Email, Password FROM WasteChase_User WHERE email = ? ");
		
		echo $mysqli->error;
		
		$stmt->bind_param("s", $email);
		
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb);
		
		$stmt->execute();
		
		if($stmt->fetch()) {
			
			$hash = hash("sha512", $password);
			
			if ($hash == $passwordFromDb) {
				
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				header("Location: data.php");
				
			} else {
				$notice = "parool vale";
			}
			
			
		} else {
			
			$notice = "Sellise emailiga ".$email." kasutajat ei ole olemas";
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $notice;
		
	}
	
	function cleanInput ($input) {
		
		$input = trim($input);
		
		//võtab välja "\"
		$input = stripslashes($input);
		
		//html asendused nt.\ asemel unicode
		$input = htmlspecialchars($input);
		
		return $input;
		
	}




?>