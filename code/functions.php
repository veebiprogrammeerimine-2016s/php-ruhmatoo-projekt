<?php

	require("../../../config.php");

	session_start();

	
	function signUp ($email, $password) {
		
		$database = "if16_andryzag";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
	
		echo $mysqli->error;
		
		$stmt->bind_param("ss", $email, $password);
		
		if($stmt->execute()) {
			;
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	
	function login ($email, $password) {
		
		$error = "";
		
		$database = "if16_andryzag";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$stmt = $mysqli->prepare("
		SELECT id, email, password, created 
		FROM user_sample
		WHERE email = ?");
	
		echo $mysqli->error;
		
		//asendan küsimärgi
		$stmt->bind_param("s", $email);
		
		//määran väärtused muutujatesse
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		$stmt->execute();
		
		//andmed tulid andmebaasist või mitte
		// on tõene kui on vähemalt üks vaste
		if($stmt->fetch()){
			
			//oli sellise meiliga kasutaja
			//password millega kasutaja tahab sisse logida
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb) {
				
				echo "Kasutaja logis sisse ".$id;
				
				//määran sessiooni muutujad, millele saan ligi
				// teistelt lehtedelt
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				$_SESSION["message"] = "<h1>Welcome!</h1>";
				
				header("Location: data.php");
				exit();
				
			}else {
				$error = "Wrong Password";
			}
			
			
		} else {
			
			// ei leidnud kasutajat selle meiliga
			$error = "This e-mail does not belong to any registrered account";
		}
		
		return $error;
		
	}
	
	
	function saveTask ($task, $date) {
		
		$database = "if16_andryzag";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$stmt = $mysqli->prepare("INSERT INTO task_and_date (task, date, user_id) VALUES (?, ?, ?)");
	
		echo $mysqli->error;
		
		$stmt->bind_param("ssi", $task, $date, $_SESSION ["userId"]);
		
		if($stmt->execute()) {
			;
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	
	function getAllTasks() {
		
		$database = "if16_andryzag";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("
			SELECT id, task, date
			FROM task_and_date
			WHERE user_id=?
			AND deleted IS NULL
		
		");
		echo $mysqli->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		
		echo $mysqli->error;
		
		$stmt->bind_result($id, $task, $date);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$taskdate = new StdClass();
			
			$taskdate->id = $id;
			$taskdate->task = $task;
			$taskdate->date = $date;
			
			//echo $plate."<br>";
			// iga kord massiivi lisan juurde ülesande
			array_push($result, $taskdate);
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $result;
	}
	
	
	function cleanInput($input){
		
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		
		return $input;
		
	}
	
	
	function savecontact ($contact) {
		
		$database = "if16_andryzag";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->prepare("INSERT INTO contacts (contact, user_id) VALUES (?, ?)");
	
		echo $mysqli->error;
		
		$stmt->bind_param("si", $contact, $_SESSION ["userId"]);
		
		if($stmt->execute()) {
			;
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	
	function getAllUsercontacts() {
		
		$database = "if16_andryzag";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("
			SELECT id, contact
			FROM contacts
			WHERE user_id=? 
			AND deleted IS NULL
		
		");
		echo $mysqli->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		
		echo $mysqli->error;
		
		$stmt->bind_result($id, $contact);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$contactt = new StdClass();
			
			$contactt->id = $id;
			$contactt->contact = $contact;
			
			//echo $plate."<br>";
			// iga kord massiivi lisan juurde ülesande
			array_push($result, $contactt);
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $result;
	
	}
	
	
	function saveUsercontact ($contact) {
		
		$database = "if16_andryzag";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->prepare("
			SELECT id FROM user_contacts 
			WHERE user_id=? AND contact_id=?
		");
		$stmt->bind_param("ii", $_SESSION["userId"], $contact);
		$stmt->bind_result($id);
		
		$stmt->execute();
		
		if ($stmt->fetch()) {
		
			;
			// pärast returni midagi edasi ei tehta funktsioonis
			return;
			
		} 
		
		$stmt->close();
		
		// kui ei olnud siis sisestan
		
		$stmt = $mysqli->prepare("
			INSERT INTO user_contacts
			(user_id, contact_id) VALUES (?, ?)
		");
		
		echo $mysqli->error;
		
		$stmt->bind_param("ii", $_SESSION["userId"], $contact);
		
		if ($stmt->execute()) {
			echo "Successfully saved!";
		} else {
			echo "ERROR ".$stmt->error;
		}
		
	}
	
		
	function getSingleData($edit_id){
    
        $database = "if16_andryzag";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("SELECT task, date FROM task_and_date WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($task, $date);
		$stmt->execute();
		
		$tasker = new StdClass();
		
		if($stmt->fetch()){
			$tasker->task = $task;
			$tasker->date = $date;		
			
		}else{
			header("Location: data.php");
			exit();
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $tasker;
		
	}
		

	function deletetask($id){
    	
        $database = "if16_andryzag";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("UPDATE task_and_date SET deleted=1 WHERE id=?");
		$stmt->bind_param("i", $id);
		
		
		if($stmt->execute()){
			;
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	
	function getSingleContact($id){
    
        $database = "if16_andryzag";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("SELECT contact FROM contacts WHERE id=?");
		$stmt->bind_param("i", $id);
		$stmt->bind_result($contact);
		$stmt->execute();
		
		$contacter = new StdClass();
		
		if($stmt->fetch()){
			$contacter->contact = $contact;	
		
		//echo $plate."<br>";
		// iga kord massiivi lisan juurde ülesande
		//	array_push($result, $contacter);				
		
		}else{
			header("Location: user.php");
			exit();
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $contacter;
		
	}
		
		
	function update($id, $task, $date){
    	
        $database = "if16_andryzag";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("UPDATE task_and_date SET task=?, date=? WHERE id=?");
		$stmt->bind_param("ssi", $task, $date, $id);
		
	
		if($stmt->execute()){
			;
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
		
		function updatecontact($id, $contact){
    	
        $database = "if16_andryzag";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("UPDATE contacts SET contact=? WHERE id=?");
		$stmt->bind_param("si",$contact, $id);
		
	
		if($stmt->execute()){
			echo "Successfully changed!";
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
		
		function deletecontact($id){
    	
        $database = "if16_andryzag";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("DELETE FROM contacts WHERE contacts=? id = ?");
		$stmt->bind_param("i", $id);
		
		
		if($stmt->execute()){
			echo "Successfully deleted!";
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
?>