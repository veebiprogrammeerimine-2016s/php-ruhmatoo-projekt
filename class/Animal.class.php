<?php 
class Animal {
	
	private $connection;
	
	function __construct($mysqli){
		
		$this->connection = $mysqli;
		
	}

	/*TEISED FUNKTSIOONID */
	function delete($id){

		$stmt = $this->connection->prepare("UPDATE g_animals SET deleted=NOW() WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("i",$id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "Kustutamine õnnestus!";
		}
		
		$stmt->close();
		
		
	}
		
	function get($q, $sort, $order) {
		
		$allowedSort = ["id", "type", "name", "age"];
		
		if(!in_array($sort, $allowedSort)){
			// ei ole lubatud tulp
			$sort = "id";
		}
		
		//kas github t88tab??
		
		$orderBy = "ASC";
		
		if ($order == "DESC") {
			$orderBy = "DESC";
		}
		//echo "Sorteerin: ".$sort." ".$orderBy." ";
		
		
		//kas otsib
		if ($q != "") {
			
			echo "Otsib: ".$q;
			
			$stmt = $this->connection->prepare("
				SELECT id, type, name, age
				FROM g_animals
				WHERE deleted IS NULL 
				AND (type LIKE ? OR name LIKE ? OR age LIKE ?)
				ORDER BY $sort $orderBy
			");
			$searchWord = "%".$q."%";
			$stmt->bind_param("sss", $searchWord, $searchWord, $searchWord);
			
			
		} else {
			
			$stmt = $this->connection->prepare("
				SELECT id, type, name, age
				FROM g_animals
				WHERE deleted IS NULL
				ORDER BY $sort $orderBy
			");
			
		}
		
		echo $this->connection->error;
		
		$stmt->bind_result($id, $type, $name, $age);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$Animal = new StdClass();
			
			$Animal->id = $id;
			$Animal->type = $type;
			$Animal->name = $name;
			$Animal->age = $age;
			

			// iga kord massiivi lisan juurde nr märgi
			array_push($result, $Animal);
		}
		
		$stmt->close();
		
		
		return $result;
	}
	
	function getSingle($edit_id){

		$stmt = $this->connection->prepare("SELECT type, name, age FROM `g_animals` WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($type, $name, $age);
		$stmt->execute();
		
		//tekitan objekti
		$Animal = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$Animal->type = $type;
			$Animal->name = $name;
			$Animal->age = $age;
			
			
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: animals.php");
			exit();
		}
		
		$stmt->close();
		
		
		return $Animal;
		
	}

	function save ($type, $name, $age) {
		
		$stmt = $this->connection->prepare("INSERT INTO g_animals (type, name, age) VALUES (?, ?, ?)");
	
		echo $this->connection->error;
		
		$stmt->bind_param("ssi", $type, $name, $age);
		
		if($stmt->execute()) {
			echo "Salvestamine onnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		
		
	}
	
	function update($id, $type, $name, $age){
    	
		$stmt = $this->connection->prepare("UPDATE g_animals SET type=?, name=?, age=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("ssi",$type, $name, $age);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "Salvestus onnestus!";
		}
		
		$stmt->close();
		
		
	}
	
}
?>