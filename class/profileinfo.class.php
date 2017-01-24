<?php
class ProfileInfo {
	
		private $connection;
		
		function __construct($mysqli){
			
			$this->connection=$mysqli;

		}

	function profileEmail() {
		
		$error="";
		$stmt = $this->connection->prepare("SELECT email FROM prod_user WHERE id=?");
		echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->bind_result($profileEmail);
		$stmt->execute();
		if($stmt->fetch()){
			
			echo $profileEmail;
		}
	}
	
	function profileGender() {
		
		$error="";
		$stmt = $this->connection->prepare("SELECT gender FROM prod_user WHERE id=?");
		echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->bind_result($profileGender);
		$stmt->execute();
		if($stmt->fetch()){
			echo $profileGender;
		}
	}
	
	function profileAge() {
		
		$error="";
		$stmt = $this->connection->prepare("SELECT age FROM prod_user WHERE id=?");
		echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->bind_result($profileAge);
		$stmt->execute();
		if($stmt->fetch()){
			echo $profileAge;
			
		}
	}
	
	function profileCreated() {
		
		$error="";
		$stmt = $this->connection->prepare("SELECT created FROM prod_user WHERE id=?");
		echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->bind_result($profileCreated);
		$stmt->execute();
		if($stmt->fetch()){
			
			echo $profileCreated;
		}
	}
}
?>