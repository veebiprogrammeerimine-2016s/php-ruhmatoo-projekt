<?php

class User {
	
		private $connection;
		function __construct($mysqli){
			$this->connection=$mysqli;
		}
	function signUp ($email, $password, $fistname, $lastname, $gender, $username, $DoB) {
		$stmt = $this->connection->prepare("INSERT INTO prod_users(firstname, lastname, dateofbirth, gender, username, email, password, userlevel) VALUES(?, ?, ?, ?, ?, ?, ?, 1)");
		echo $this->connection->error;
		$stmt->bind_param("sssssss", $fistname, $lastname, $DoB, $gender, $username, $email, $password);
		if($stmt->execute()) {
			echo "salvestamine onnestus";
		} else {
			echo "ERROR".$stmt->error;
		}
		$stmt->close();
		$this->connection->close();
	}














?>



