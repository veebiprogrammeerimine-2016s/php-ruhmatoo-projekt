<?php 
class User {
	

	private $connection;
	
	// k�ivitatakse siis kui new ja see mis saadekse
	//sulgudesse new User(?) see j�uab siia
	function __construct($mysqli){
		
		// this viitab sellele klassile siin
		// selle klassi muutuja connection
		$this->connection = $mysqli;
	}
	
	/* KLASSI FUNKTSIOONID */
	
	function login($email, $password) {
		
		$notice = "";
				
		$stmt = $this->connection->prepare("
		
			SELECT id, email, password, date_created
			FROM users
			WHERE email = ?
		
		");
		// asendan ?
		$stmt->bind_param("s", $email);
		
		// m��ran muutujad reale mis k�tte saan
		$stmt->bind_result($id, $emailFromdatabase, $passwordFromdatabase, $date_created);
		
		$stmt->execute();
		
		// ainult SLECTI'i puhul
		if ($stmt->fetch()) {
			
			// v�hemalt �ks rida tuli
			// kasutaja sisselogimise parool r�siks
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromdatabase) {
				// �nnestus 
				echo "Kasutaja ".$id." logis sisse";
				
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromdatabase;
				
				header("Location: data.php");
				exit();
			} else {
				$notice = "Vale parool!";
			}
			
		} else {
			// ei leitud �htegi rida
			$notice = "Sellist emaili ei ole!";
		}
		
		return $notice;
	}
	
	function signup($email, $password) {
		
		$stmt = $this->connection->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
		echo $this->connection->error;
		
		$stmt->bind_param("ss", $email, $password );
		if ( $stmt->execute() ) {
			echo "salvestamine �nnestus";	
		} else {	
			echo "ERROR ".$stmt->error;
		}
		
	}
	
} 
?>