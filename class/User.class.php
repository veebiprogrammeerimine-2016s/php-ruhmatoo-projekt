<?php
class User {
	
	private $connection;
	public $name;
	
	function __construct($mysqli){
		
		//This viitab klassile (THIS ==USER)
		$this->connection = $mysqli;
		
	}
	/*TEISED FUNKTSIOONID*/
	
	function signUp ($email, $password,$userFirstName,$userLastName,$aboutUser) {
	
		$stmt = $this->connection->prepare("INSERT INTO user_sample (email, password,first_name, last_name,about_user) VALUES (?, ?,?,?,?)");
	
		echo $this->connection->error;
		
		$stmt->bind_param("sssss", $email, $password,$userFirstName, $userLastName, $aboutUser);
		
		if($stmt->execute()) {
			echo "salvestamine toimis!:)";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		
	}
	
	
	function login ($email, $password) {
		
		$error = "";
		echo $email;
		$stmt = $this->connection->prepare("
		SELECT id, email, password, created ,first_name,last_name,about_user
		FROM user_sample
		WHERE email = ?");
	
		echo $this->connection->error;
		
		//asendan küsimärgi
		$stmt->bind_param("s", $email);
		
		//määran väärtused muutujatesse
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created, $firstNameFromDb, $lastNameFromDb,$aboutUserFromDb);
		$stmt->execute();
		
		//andmed tulid andmebaasist või mitte
		// on tõene kui on vähemalt üks vaste
		if($stmt->fetch()){
			
			
			$hash = hash("whirlpool", $password);
			if ($hash == $passwordFromDb) {
				
				echo "Kasutaja logis sisse ".$id;
				
				//määran sessiooni muutujad, millele saan ligi
				// teistelt lehtedelt
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				$_SESSION["message"] = "<h1>Tere tulemast!</h1>";
				$_SESSION["firstName"] = $firstNameFromDb;
				$_SESSION["lastName"] = $lastNameFromDb;
				$_SESSION["aboutUser"] = $aboutUserFromDb;
				
				
				header("Location: data.php");
				exit();
				
			}else {
				$error = "vale parool";
			}
			
			
		} else {
			
			// ei leidnud kasutajat selle meiliga
			$error = "ei ole sellist emaili";
		}
		
		return $error;
		
	}

	
	}
	?>