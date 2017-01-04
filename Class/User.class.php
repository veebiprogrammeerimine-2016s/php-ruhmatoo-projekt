<?php
class User {
	
	private $connection;
	
	function __construct($mysqli){
		$this->connection = $mysqli;
	}
	
	function login($email, $password) {
		
		$error = "";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],  $GLOBALS["serverPassword"],  $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("
		
			SELECT user_id, user_name, user_email, user_pass
			FROM users
			WHERE user_email = ?
		");
		
		echo $this->connection->error;
		
		$stmt->bind_param("s", $email);
		
		$stmt->bind_result($id, $emailFromDb, $usernameFromDb, $passwordFromDb);
		
		$stmt->execute();
		
		if ($stmt->fetch()) {
			
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb) {
				echo "User ".$id." logged in";
				
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				$_SESSION["username"] = $usernameFromDb;
				$_SESSION["userPass"] = $passwordFromDb;
				
				header("Location: data.php");
				exit();
			} else {
				$error = "Wrong password!";
			}
			
		} else {
			$error = " Wrong email";
		}
		return $error;
		
	}
	function signup($email, $username, $password) {
		
		$mysqli = new mysqli(
		
		$GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"],  
		$GLOBALS["serverPassword"],  
		$GLOBALS["database"]
		
		);
		$stmt = $this->connection->prepare("INSERT INTO users (user_name, user_email, user_pass) VALUES (?, ?, ?)");
		echo $this->connection->error;
		
		$stmt->bind_param("sss", $username, $email, $password );
		if ( $stmt->execute() ) {
			echo "Registered";
		} else {
			echo "ERROR ".$stmt->error;
		}
	}
}
?>