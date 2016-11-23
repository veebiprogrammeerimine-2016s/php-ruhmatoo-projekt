<?php
class Interest {
	
	//klassi sees saab kasutada
	private $connection;
	
	//$User = new user(see); j�uab siia sulgude vahele
	function __construct($mysqli){
		
		//klassi sees muutuja kasutamiseks $this->
		 //$this viitab sellele klassile
		$this-> connection = $mysqli;
		
	}
	function saveInterest ($interest) {
		
		$database = "if16_Tanelmaas_1";
		$this-> connection = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$stmt = $this-> connection->prepare("INSERT INTO g_interests (interest) VALUES (?)");
	
		echo $this-> connection->error;
		
		$stmt->bind_param("s", $interest);
		
		if($stmt->execute()) {
			echo "Salvestamine �nnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		
	}
	
	function saveUserInterest ($interest_id) {
		
		
		$database = "if16_Tanelmaas_1";		
		$this-> connection = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		//kas on juba olemas
		
		$stmt = $this-> connection->prepare("
			SELECT id FROM g_user_interest
			WHERE user_id=? AND interest_id=?
		");
		$stmt->bind_param("ii", $_SESSION["userId"], $interest_id);
		$stmt->execute();
		
		if ($stmt->fetch()) {
			// oli olemas 
			echo "Juba olemas";
			
			//�ra salvestamisega j�tka
			return;
		}
	
		$stmt->close();
		// j�tkan salvestamisega...
		
		$stmt = $this-> connection->prepare("
			INSERT INTO g_user_interest 
			(user_id, interest_id) VALUES (?, ?)
		");
	
		echo $this-> connection->error;
		
		$stmt->bind_param("ii", $_SESSION["userId"], $interest_id);
		
		if($stmt->execute()) {
			echo "Salvestamine �nnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		
	}
	
	function getAllInterests() {
		
		$database = "if16_Tanelmaas_1";
		$this-> connection= new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $this-> connection->prepare("
			SELECT id, interest
			FROM g_interests
		");
		echo $this-> connection->error;
		
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
		
		return $result;
	}

	
	function getAllUserInterests() {
		
		$database = "if16_Tanelmaas_1";
		$this-> connection = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt =$this-> connection->prepare("
			SELECT interest
			FROM g_interests
			JOIN g_user_interest
			ON g_interests.id = g_user_interest.interest_id
			WHERE g_user_interest.user_id = ?
		");
		echo $this-> connection->error;
		
		$stmt->bind_param("i", $_SESSION["userId"]);
		
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
		
		return $result;	
	}
}
?>	