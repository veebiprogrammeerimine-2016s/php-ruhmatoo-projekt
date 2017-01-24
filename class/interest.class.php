<?php
class Interest {
	
		private $connection;
		
		function __construct($mysqli){
			
			$this->connection=$mysqli;
			
		}
	
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
 	}
 	
 	function getAllInterests() {
 		$stmt = $this->connection->prepare("
 			SELECT id, interest
			FROM interests
 		");
 		echo $this->connection->error;
 		$stmt->bind_result($id, $interest);
 		$stmt->execute();
 		$result = array();
 		while ($stmt->fetch()) {
 			
 			$i = new StdClass();
 			$i->id = $id;
 			$i->interest = $interest;
 			array_push($result, $i);
 		}
 		$stmt->close();
 		return $result;
 	}
	
	function getAllUserInterests() {
 		$stmt = $this->connection->prepare("
 			SELECT interest FROM interests
			JOIN user_interests
			ON interests.id=user_interests.interest_id
			WHERE user_interests.user_id = ?
 		");
 		echo $this->connection->error;
 		$stmt->bind_param("i", $_SESSION["userId"]);
 		$stmt->bind_result($interest);
 		$stmt->execute();
 		$result = array();

 		while ($stmt->fetch()) {
 			$i = new StdClass();
 			$i->interest = $interest;
 			array_push($result, $i);
 		}
 		
 		$stmt->close();
 		return $result;
 	}
	
	function saveUserInterest ($interest) {
 
		$stmt = $this->connection->prepare("SELECT id FROM user_interests WHERE user_id=? AND interest_id=?");
		$stmt->bind_param("ii", $_SESSION["userId"],$interest);
		$stmt->bind_result($id);
		$stmt->execute();
		if ($stmt->fetch()) {
			
			echo "juba olemas";
			return;
		
		}
		
		$stmt->close();
		
		$stmt = $this->connection->prepare("INSERT INTO user_interests (user_id, interest_id) VALUES (?, ?)");
		$stmt->bind_param("ii", $_SESSION["userId"],$interest);
		if($stmt->execute()) {
			echo"salvestamine onnestus";
		} else {
			echo "ERROR: ".$stmt->error;
		}
 	}
}	
?>