<?php 
class Level {
	
	private $connection;
	
	function __construct($mysqli){
		
		$this->connection = $mysqli;
		
	}

	/*TEISED FUNKTSIOONID */
	function get() {
		
		$stmt = $this->connection->prepare("
			SELECT id, level
			FROM user_level
		");
		echo $this->connection->error;
		
		$stmt->bind_result($id, $level);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$i = new StdClass();
			
			$i->id = $id;
			$i->level = $level;
		
			array_push($result, $i);
		}
		
		$stmt->close();
		
		
		return $result;
	}
	
	function getUser() {
	
		$stmt = $this->connection->prepare("
			SELECT level FROM user_level
			JOIN user_levels 
			ON user_level.id=user_levels.level_id
			WHERE user_levels.user_id = ?
		");
		echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		
		$stmt->bind_result($level);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$i = new StdClass();
			
			$i->level = $level;
		
			array_push($result, $i);
		}
		
		$stmt->close();
		
		
		return $result;
	}
	
	function save ($level) {

		$stmt = $this->connection->prepare("INSERT INTO user_level (level) VALUES (?)");
	
		echo $this->connection->error;
		
		$stmt->bind_param("s", $level);
		
		if($stmt->execute()) {
			echo "Success!";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		
		
	}
	
	function saveUser ($level) {
	
		$stmt = $this->connection->prepare("
			SELECT id FROM user_levels
			WHERE user_id=? AND level_id=?
		");
		$stmt->bind_param("ii", $_SESSION["userId"], $level);
		$stmt->bind_result($id);
		
		$stmt->execute();
		
		if ($stmt->fetch()) {
			// oli olemas juba selline rida
			echo "Already created";
			// pärast returni midagi edasi ei tehta funktsioonis
			return;
			
		} 
		
		$stmt->close();
		
		// kui ei olnud siis sisestan
		
		$stmt = $this->connection->prepare("
			INSERT INTO user_levels
			(user_id, level_id) VALUES (?, ?)
		");
		
		echo $this->connection->error;
		
		$stmt->bind_param("ii", $_SESSION["userId"], $level);
		
		if ($stmt->execute()) {
			echo "Success!";
		} else {
			echo "ERROR ".$stmt->error;
		}
		
	}
	
}
?>