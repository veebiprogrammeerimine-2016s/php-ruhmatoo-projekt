<?php 
class Interest{
	private $connection;
	//k�ivitataks siis kui on = new User(see j�uab siia)
	
	function __construct($mysqli){
		//this viitab sellele klassile ja selle klassi muutujale
		$this->connection=$mysqli;
	}
	/*K�IK FUNKTSIOONID */
	
	function saveInterest ($interest) {	
		$stmt = $this->connection->prepare("INSERT INTO interests (interest) VALUES (?)");
		echo $this->connection->error;
		$stmt->bind_param("s", $interest);
		if($stmt->execute()) {
			echo "salvestamine �nnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		$stmt->close();
		$$this->connection->close();
	}
	
	
	function saveUserInterest ($interest) {	
		$stmt = $this->connection->prepare("SELECT id from user_interests_4 where user_id=? AND interest_id=?");
		$stmt->bind_param("ii", $_SESSION["userId"], $interest);
		$stmt->execute();
		//kas oli rida
		if($stmt->fetch()){
			//oli olemas
			echo"juba olemas";
			//p�rast returni koodi ei vaadata
			return;
		}
		//kui ei olnud
		$stmt->close();
		$stmt = $this->connection->prepare("INSERT INTO user_interests_4(user_id, interest_id) VALUES (?, ?)");
		echo $this->connection->error;
		$stmt->bind_param("ii", $_SESSION["userId"], $interest);
		if($stmt->execute()) {
			echo "salvestamine �nnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		$stmt->close();
		$this->connection->close();
	}
	
	
	function getAllInterests() {
		$stmt = $this->connection->prepare("
			SELECT id, interest
			FROM interests
		");
		echo $this->connection->error;
		$stmt->bind_result($id, $interest);
		$stmt->execute();
		//tekitan massiivi
		$result = array();
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			//tekitan objekti
			$i = new StdClass();
			$i->id = $id;
			$i->interest = $interest;
			array_push($result, $i);
		}
		$stmt->close();
		$this->connection->close();
		return $result;
	}
	
	
	function getUserInterests() {
		$stmt = $this->connection->prepare("
			????????????????
		");
		//SESSION USER ID
		echo $this->connection->error;
		$stmt->bind_result($interest);
		$stmt->execute();
		//tekitan massiivi
		$result = array();
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			//tekitan objekti
			$i = new StdClass();
			$i->interest = $interest;
			array_push($result, $i);
		}
		$stmt->close();
		$this->connection->close();
		return $result;
	}
	
	
}
?>