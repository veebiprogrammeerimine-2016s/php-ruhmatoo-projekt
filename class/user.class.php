<?php
class User {
    private $connection;
    function __construct($mysqli) {
        $this->connection = $mysqli;
    }
    function signup ($email, $password) {


        $this->connection = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

        $stmt = $this->connection->prepare("INSERT INTO repairUsers (email, password) VALUES (?, ?)");


        echo $this->connection->error;

        $stmt->bind_param("ss", $email, $password);

        if ($stmt->execute()) {

            echo "salvestamine õnnestus";
        } else {
            echo "ERROR ".$stmt->error;
        }
    }


	function login ($email, $password) {
			
			$error = "";
		
			$stmt = $this->connection->prepare("
			SELECT id, email, password
			FROM repairUsers
			WHERE email = ?");
		
			echo $this->connection->error;
			
			$stmt->bind_param("s", $email);
			
			$stmt->bind_result($id, $emailFromDb, $passwordFromDb);
			$stmt->execute();
			
			if($stmt->fetch()){
				
				$hash = hash("sha512", $password);
				if ($hash == $passwordFromDb) {
					
					echo "Kasutaja logis sisse ".$id;
					
					$_SESSION["userId"] = $id;
					$_SESSION["userEmail"] = $emailFromDb;
					
					$_SESSION["message"] = "<h1>Tere tulemast!</h1>";
					
					header("Location: data.php");
					exit();
					
				}else {
					$error = "vale parool";
				}
				
				
			} else {
				
				$error = "ei ole sellist emaili";
			}
			
			return $error;
			
	}
}
?>