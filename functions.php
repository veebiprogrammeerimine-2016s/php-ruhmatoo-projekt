<?php

	require("/home/karlkruu/config.php");

	session_start();

	function signUp ($email, $password, $name, $family, $gender){
	
		$database = "if16_andralla_2";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
	
		if ($mysqli->connect_error) {
			die('Connect Error: ' . $mysqli->connect_error);
		}
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password, name, family, gender) VALUES (?, ?, ?, ?, ?)");
		
		echo $mysqli->error;

		$stmt->bind_param("sssss", $email, $password, $name, $family, $gender);
		
	
		if($stmt->execute()) {
			echo "Saved";			
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
	
	}
	
	function login ($email, $password){
	
		$error = "";
		
		$database = "if16_andralla_2";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->prepare("SELECT id, email, password, created FROM user_sample WHERE email = ?");
		
		echo $mysqli->error;
		
		//asendan küsimärgi
		$stmt->bind_param("s", $email);
		
		//määran väärtused muutujatesse
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		$stmt->execute();
		
		//andmed tulid andmebaasist või mitte
		//on tõene kui on vähemalt üks vaste
		if($stmt->fetch()){
		
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb) {
				echo "kasutaja logis sisse".$id;
				
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				//määran sessiooni muutujad millele saan ligi teistelt lehtedelt
				// !!!!! header("Location: data.php");
			
			}else{
				$error = "wrong password";
			}
			
		
		} else {
			//ei leidnud kasutajat selle meiliga
			$error = "e-mail does not exist";
		}
		
		return $error;
		
	}
	
	
?>