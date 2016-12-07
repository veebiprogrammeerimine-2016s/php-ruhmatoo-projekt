<?php

require("../../config.php");

session_start();

function signUp ($Email, $Password, $Date, $Gender) {
		
		$database = "if16_mariiviita";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$stmt = $mysqli->prepare("INSERT INTO user_sample (Email, Password, Date, Gender) VALUES (?, ?, ?, ?)");
	
		echo $mysqli->error;
		
		$stmt->bind_param("sssi", $Email, $Password, $Date, $Gender);
		
		if($stmt->execute()) {
			echo "Salvestamine õnnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	
	function login ($Email, $Password) {
		
		$error = "";
		
		$database = "if16_mariiviita";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$stmt = $mysqli->prepare("
		SELECT id, Email, Password, Date, Gender 
		FROM user_sample
		WHERE email = ?");
	
		echo $mysqli->error;
		
		//asendan küsimärgi
		$stmt->bind_param("s", $Email);
		
		//määran väärtused muutujatesse
		$stmt->bind_result($id, $EmailFromDb, $PasswordFromDb, $DateFromDb, $GenderFromDb);
		$stmt->execute();
		
		//andmed tulid andmebaasist või mitte
		// on tõene kui on vähemalt üks vaste
		if($stmt->fetch()){
			
			//oli sellise meiliga kasutaja
			//password millega kasutaja tahab sisse logida
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb) {
				
				echo "Kasutaja logis sisse ".$id;
				
				//määran sessiooni muutujad, millele saan ligi
				// teistelt lehtedelt
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $EmailFromDb;
				
				
				header("Location: data.php");
				exit();
				
			}else {
				$error = "Parool on vale!";
			}
			
			
		} else {
			
			// ei leidnud sellise e-mailiga kasutajat
			$error = "Sellise e-mailiga kasutajat ei ole!";
		}
		
		return $error;
		
	}
	
	function saveUserData ($currentDate, $Feeling, $NumberofSteps) {
		
		$database = "if16_mariiviita";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$stmt = $mysqli->prepare("INSERT INTO userData (currentDate, Feeling, NumberofSteps) VALUES (?, ?, ?)");
	
		echo $mysqli->error;
		
		$stmt->bind_param("isi", $currentDate, $Feeling, $NumberofSteps);
		
		if($stmt->execute()) {
			echo "Salvestamine õnnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
?>