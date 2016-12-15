<?php

class User {
	
	private $connection;
	
	function __construct($mysqli){
		$this->connection = $mysqli;
	}
	
	function login($email, $password) {
		$notice = "";
		$stmt = $this->connection->prepare("
			SELECT id, user_email, user_pass
			FROM users
			WHERE user_email = ?
			
		");
		$stmt->bind_param("s", $email);
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb);
		$stmt->execute();
		if ($stmt->fetch()) {
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb) {
				echo "User ".$id." logged in";
				
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				header("Location: data.php");
				exit();
			} else {
				$notice = "Wrong password!";
			}
			
		} else {
			$notice = " Wrong email";
		}
		return $notice;
		
	}
	function signup($email, $password) {
		$stmt = $this->connection->prepare("INSER INTO users (user_email, user_pass) VALUES (?, ?)");
		echo $this->connection->error;
		
		$stmt->bind_param("ss", $email, $password );
		if ( $stmt->execute() ) {
			echo "Registered";
		} else {
			echo "ERROR ".$stmt->error;
		}
	}
}
?>