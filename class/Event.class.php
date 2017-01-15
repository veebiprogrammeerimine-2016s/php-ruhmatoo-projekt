<?php 
class Event{
	private $connection;
	//käivitataks siis kui on = new User(see jõuab siia)
	
	function __construct($mysqli){
		//this viitab sellele klassile ja selle klassi muutujale
		$this->connection=$mysqli;
	}
	/*KÕIK FUNKTSIOONID */

	function saveEvent($age, $color) {
		$stmt = $this->connection->prepare("INSERT INTO whistle (age, color) VALUE (?, ?)");
		echo $this->connection->error;
		$stmt->bind_param("is", $age, $color);
		if ( $stmt->execute() ) {
			echo "õnnestus <br>";
		} else {
			echo "ERROR ".$stmt->error;
		}
	}
	
	
	function getAllPeople($q, $sort, $order){
		
		$allowedSort = ["id", "age", "color"];
		
		// sort ei kuulu lubatud tulpade sisse 
		if(!in_array($sort, $allowedSort)){
			$sort = "id";
		}
		
		$orderBy = "ASC";
		
		if($order == "DESC") {
			$orderBy = "DESC";
		}
		echo "Sorteerin: ".$sort." ".$orderBy." ";
		
		if($q!=""){
			//otsin
			echo"otsin: ".$q;
			$stmt = $this->connection->prepare("
				SELECT id, age, color
				FROM whistle
				WHERE deleted IS NULL
				AND ( age LIKE ? OR color LIKE ? )
				ORDER BY $sort $orderBy
				");
			$searchWord="%".$q."%";
			$stmt->bind_param("ss", $searchWord, $searchWord);
		}else {
			//ei otsi
			$stmt = $this->connection->prepare("
				SELECT id, age, color
				FROM whistle
				WHERE deleted IS NULL
				ORDER BY $sort $orderBy
				");
		}
		
		
		$stmt->bind_result($id, $age, $color);
		$stmt->execute();
		$results=array();
		//tsüklissisu toiimib seni kaua, mitu rida SQL lausega tuleb
		while($stmt->fetch()) {
			$human=new StdClass();
			$human->id=$id;
			$human->age=$age;
			$human->color=$color;
			//echo $color."<br>";
			array_push($results, $human);
		}
		return $results;
	}
	
	
	function getSinglePerosonData($edit_id){
 		$stmt = $this->connection->prepare("SELECT age, color FROM whistle
		WHERE id=? AND deleted IS NULL");
 		$stmt->bind_param("i", $edit_id);
 		$stmt->bind_result($age, $color);
 		$stmt->execute();
 		//tekitan objekti
 		$p = new Stdclass();
 		//saime ühe rea andmeid
 		if($stmt->fetch()){
 			// saan siin alles kasutada bind_result muutujaid
 			$p->age = $age;
 			$p->color = $color;
 		}else{
 			// ei saanud rida andmeid kätte
 			// sellist id'd ei ole olemas
 			// see rida võib olla kustutatud
 			header("Location: data.php");
 			exit();
 		}
 		$stmt->close();
 		$this->connection->close();
 		return $p;
 	}
	
	
	function updatePerson($id, $age, $color){
 		$stmt = $this->connection->prepare("UPDATE whistle SET age=?, color=? WHERE id=? AND deleted IS NULL");
 		$stmt->bind_param("isi",$age, $color, $id);
 		// kas õnnestus salvestada
 		if($stmt->execute()){
 			// õnnestus
 			echo "salvestus õnnestus!";
 		}
 		$stmt->close();
 		$this->connection->close();
 	}
	
	
	function deletePerson($id){
 		$stmt = $this->connection->prepare("UPDATE whistle SET deleted=NOW()
 		WHERE id=? AND deleted IS NULL");
 		$stmt->bind_param("i",$id);
 		// kas õnnestus salvestada
 		if($stmt->execute()){
 			// õnnestus
 			echo "salvestus õnnestus!";
 		}
 		$stmt->close();
 		$this->connection->close();
 	}
	
	
	
}
?>