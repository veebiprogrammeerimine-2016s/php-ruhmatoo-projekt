<?php 
class User {
	
	private $connection;
	
	function __construct($mysqli){
		
		//this viitab klassile (this == User)
		$this->connection = $mysqli;
		
	}



	/*TEISED FUNKTSIOONID*/
	function login ($email, $password) {
		
		$error = "";
		
		$stmt = $this->connection->prepare("SELECT id, email, password, created FROM user_sample WHERE email = ?");
		echo $this->connection->error;


		// Asendan küsimärgid.
		$stmt->bind_param("s", $email);


		// Panen tagastatud vastused muutujasse.
        // SELECT statement'ga samas järiekorras.
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		$stmt->execute();


		// Andmed tulid andmebaasist või mitte
		// On tõene kui on vähemalt üks vaste
		if($stmt->fetch()){


			// Oli sellise meiliga kasutaja
			// Password millega kasutaja tahab sisse logida
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb) {


				echo "Kasutaja logis sisse ".$id;


				// Määran sessiooni muutujad, millele saan ligi
				// Teistelt lehtedelt
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				$_SESSION["message"] = "<h1>Tere tulemast!</h1>";


				header("Location: data.php");
				exit();
			}
			else
            {
				$error = "vale parool";
			}
		}
		else
        {
			// Ei leidnud kasutajat selle meiliga
			$error = "ei ole sellist emaili";
		}
		return $error;
	}



	function signUp ($email, $password) {
		
		$stmt = $this->connection->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		echo $this->connection->error;
		$stmt->bind_param("ss", $email, $password);
		
		if($stmt->execute()) {
			echo "salvestamine õnnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
        header("Location: index.php");
        exit();
		
		
	}

} 
?>