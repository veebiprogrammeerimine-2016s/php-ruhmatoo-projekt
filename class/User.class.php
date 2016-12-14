<?php class User {
	
	//klassi sees saab kasutada 
	private $connection;
	
	//2 alakriipsu järjest __construct
	//$User = new User(see); jõuab siia sulgude vahele
	//$mysqli - võtan ühenduse vastu functions.php failist
	function __construct($mysqli) {
		//klassi sees muutuja kasutamiseks $this-> ...seda private $connectioni, ilma this kasutamata klassi enda uus muutuja $connection
		//$this viitab sellele klassile
		$this->connection = $mysqli;
	}
	
	/*TEISED FUNKTSIOONID*/
	
	function signup ($firstName, $lastName, $email, $password, $gender, $phoneNumber){
		//selle sees muutujad pole väljapoole nähtavad
		
		//$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $this->connection->prepare("INSERT INTO user_sample(firstname, lastname, email, password, gender, phonenumber) VALUES(?,?,?,?,?,?)");
		echo $this->connection->error;
		
		$stmt->bind_param("ssssss", $firstName, $lastName, $email, $password, $gender, $phoneNumber); //$signupEmail emailiks lihtsalt
		
		$msg = "";
		if($stmt->execute()) {
			//echo "Salvestamine õnnestus.";
			$msg = "KASUTAJA LOODUD!";
		} else {
			//echo "ERROR".$stmt->error;
			$msg = "<p style='color:red;'>SELLINE E-POST ON JUBA KASUTUSEL!</p>";
		}
		
		return $msg;
	}
	
	function login ($email, $password){
		
		$error = "";
		
		$stmt = $this->connection->prepare("
			SELECT id, firstname, email, password, created
			FROM user_sample
			WHERE email = ?
		");
		echo $this->connection->error;
		
		//asendan küsimärgi
		$stmt->bind_param("s", $email); //s-string
		
		//määran tulpadele muutujad
		$stmt->bind_result($id, $firstNameFromDb, $emailFromDb, $passwordFromDb, $created); //Db-database
		$stmt->execute(); //päring läheb läbi executiga, isegi kui ühtegi vastust ei tule
		
		if($stmt->fetch()) { //fetch küsin rea andmeid
			//oli rida
			//võrdlen paroole 
			$hash = hash("sha512", $password);
			if($hash == $passwordFromDb){
				echo "kasutaja ".$id." logis sisse";
				
				$_SESSION["userId"] = $id;
				$_SESSION["email"] = $emailFromDb;
				$_SESSION["firstName"] = $firstNameFromDb;
				
				//suunaks uuele lehele
				header("Location: data.php");
				exit();
				
			} else {
				$error = "Parool on vale!";
			}
		} else {
			//ei olnud
			$error = "Sellise emailiga ".$email." kasutajat ei ole.";
		}
		
		return $error;
	}
	
	function addToArray (){
		
		$stmt = $this->connection->prepare("
			SELECT id, firstname, lastname, email, password, gender, phonenumber
			FROM user_sample
			WHERE id=?
		");
		echo $this->connection->error;
		
		$stmt->bind_param("i", $_SESSION["userId"]);
		
		$stmt->bind_result($id, $firstname, $lastname, $email, $password, $gender, $phonenumber);
		$stmt-> execute();
		
		$userData = new StdClass();
		
		if ($stmt->fetch()){	
			
			$userData->id = $id;
			$userData->firstname = $firstname;
			$userData->lastname = $lastname;
			$userData->email = $email;
			$userData->password = $password;
			$userData->gender = $gender;
			$userData->phonenumber = $phonenumber;
		}
		
		$stmt->close();
		//$mysqli->close();
		
		return $userData;
	}
	
		function editData($edit_id){
		$stmt = $this->connection->prepare("SELECT email, phonenumber FROM user_sample WHERE id=? AND deleted IS NULL");
		echo $this->connection->error;
		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($email, $phonenumber);
		$stmt->execute();
		
		//tekitan objekti
		$person = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$person->email = $email;
			$person->phonenumber = $phonenumber;
			
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: edit.php");
			exit();
		}
		
		$stmt->close();
		return $person;
	}
	
	function deleteData($id){
		$stmt = $this->connection->prepare("UPDATE user_sample SET deleted=NOW() WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("i",$id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "kustutamine õnnestus!";
		}
		
		$stmt->close();	
	}
	
	function update($id, $email, $phonenumber){
    	
		$stmt = $this->connection->prepare("UPDATE user_sample SET email=?, phonenumber=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("ssi",$email, $phonenumber, $id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		
		$stmt->close();
	}
}



?>