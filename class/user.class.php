<?php
class User {
    private $connection;
    function __construct($mysqli) {
        $this->connection = $mysqli;
    }
    function signup ($email, $password, $firstname, $lastname) {


        $this->connection = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

        $stmt = $this->connection->prepare("INSERT INTO repairUsers (email, password, firstname, lastname) VALUES (?, ?, ?, ?)");


        echo $this->connection->error;

        $stmt->bind_param("ssss", $email, $password, $firstname, $lastname);

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
				echo $hash;
				if ($hash == $passwordFromDb) {
					
					echo "Kasutaja logis sisse ".$id;
					
					$_SESSION["userId"] = $id;
					$_SESSION["userEmail"] = $emailFromDb;
					
					$_SESSION["message"] = "<h1>Tere tulemast!</h1>";
					
					header("Location: homepage.php");
					exit();
					
				}else {
					$error = "vale parool";
				}
				
				
			} else {
				
				$error = "ei ole sellist emaili";
			}
			
			return $error;
			
	}
	
	function delete($deleted)
    {


        $stmt = $this->connection->prepare("UPDATE repairUsers SET deleted=NOW() WHERE id=? AND deleted IS NULL");

        echo $this->connection->error;

        $stmt->bind_param("s", $deleted);

        if ($stmt->execute()) {
            echo "kustutamine �nnestus";
        } else {
            echo "ERROR " . $stmt->error;
        }

        $stmt->close();

    }
	
}
?>