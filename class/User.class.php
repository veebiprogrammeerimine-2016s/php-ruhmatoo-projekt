<?php
class User {
	
	private $connection;
	
	function __construct($mysqli){
	
		//this viitab klassile (this == User)
		$this->connection=$mysqli;
	
	}
	
	/*TEISED FUNKTSIOONID*/
	
	function signUp ($email, $password, $name, $family, $gender){
		
		
		$stmt=$this->connection->prepare("INSERT INTO user_sample (email, password, name, family, gender) VALUES (?, ?, ?, ?, ?)");
		
		echo $this->connection->error;

		$stmt->bind_param("sssss", $email, $password, $name, $family, $gender);
		
		if($stmt->execute()) {
			echo "Saved";			
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
	
	}
	
	function login ($email, $password){
	
		$error = "";
		
		$stmt=$this->connection->prepare("SELECT id, email, password, created FROM user_sample WHERE email = ?");
		
		echo $this->connection->error;
		
		//asendan k�sim�rgi
		$stmt->bind_param("s", $email);
		
		//m��ran v��rtused muutujatesse
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		$stmt->execute();
		
		//andmed tulid andmebaasist v�i mitte
		//on t�ene kui on v�hemalt �ks vaste
		if($stmt->fetch()){
		
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb) {
				echo "kasutaja logis sisse".$id;
				
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				//m��ran sessiooni muutujad millele saan ligi teistelt lehtedelt
				header("Location: data.php");
			
			}else{
				$error = "wrong password";
			}
			
		
		} else {
			//ei leidnud kasutajat selle meiliga
			$error = "e-mail does not exist";
		}
		
		return $error;
		
	}
	
}?>