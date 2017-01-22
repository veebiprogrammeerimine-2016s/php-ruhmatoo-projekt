<?php 
class User {
	
	private $connection;
	
	// k�ivitatakse siis kui on = new User(see j�uab siia)
	function __construct($mysqli) {
		$this->connection = $mysqli;
	}
	
		function signup($email, $password, $firstName, $surname, $gender) {
		
				 
				 $stmt = $this->connection->prepare("INSERT INTO WasteChase_User (Email, Password, FirstName, LastName, Gender) VALUE (?, ?, ?, ?, ?)");
				 
				 //asendan k�sim�rgid
				 //iga m�rgi kohta tuleb lisada �ks t�ht - mis t��pi muutuja on
				 // s - string
				 // i - int
				 // d - double
				 $stmt->bind_param("sssss", $email, $password, $firstName, $surname, $gender);
				 //t'ida k�sku
				 if( $stmt->execute()){
					 echo "�nnestus";
				 } else {
						echo "<br>"."ERROR: ".$stmt->error;
					 
				 }	
		
	}
	
	function login($email, $password) {
	
				 $stmt = $this->connection->prepare("SELECT ID, Email, firstName, Password FROM WasteChase_User WHERE email = ? ");
				 
				 echo $this->connection->error;
				 
				 $stmt->bind_param("s", $email);
				
				//rea kohta tulba v��rtus
				$stmt->bind_result($id, $emailFromDb, $firstNameFromDb, $passwordFromDb);
				
				$stmt->execute();
				
				//ainult SELECT'i puhul
				if($stmt->fetch()){
					//oli olemas, rida k�es
					//kasutaja sisestas sisselogimiseks
					$hash = hash("sha512", $password);
						
					
					
					if ($hash == $passwordFromDb) {
						
						//oli sama
						echo"Kasutaja $id logis sisse";
						
						$_SESSION["userId"] = $id;
						$_SESSION["userEmail"] = $emailFromDb;
						$_SESSION["userFirstName"] = $firstNameFromDb;
						
						
						header("Location: data.php");
						
					} else {
						
						//polnud sama
						$notice ="Parool on vale";
						
					}
					
				} else {
					
					//ei olnud �htegi rida
					$notice = "Sellise emailiga: ".$email." kasutajat ei ole olemas.";
				}
				return $notice;
	}
	
	
	}
?>