<?php
class Plant {
	
	private $connection;
	public $name;
	
	function __construct($mysqli){
		
		//This viitab klassile (THIS ==USER)
		$this->connection = $mysqli;
		
	}
	
	
	
	function getOptions() {
		
		
		$stmt = $this->connection->prepare("
			SELECT id, name, watering_days
			FROM f_plant
			WHERE deleted IS NULL and private IS NULL");
			
		
		$stmt->bind_result($id, $plant, $watering);
		$stmt->execute();
		
		
		
		//tekitan massiivi
		
		$result=array();
		
		//Tee seda seni, kuni on rida andmeid. ($stmt->fech)
		//Mis vastab select lausele.
		//iga uue rea andme kohta see lause seal sees
		
		while($stmt->fetch()){
			
			//tekitan objekti
			
			$plantClass = new StdClass();
			
		    $plantClass->id=$id;
			$plantClass->plants=$plant;
			$plantClass->intervals=$watering;
			
			
			
			array_push($result, $plantClass);
		}
		
		return $result;
	}
	
	
	function save ($plant, $watering,$emailFromDb) {
		
		
		$stmt = $this->connection->prepare(
		"INSERT INTO f_plant (name, watering_days,private) VALUES (?,?,?)");
		
		echo $this->connection->error;
		
		
		
		//asendan küsimärgi
		$stmt->bind_param("sss", $plant,$watering,$emailFromDb);
		
		if ( $stmt->execute() )  {
			
			echo "salvestamine õnnestus";
			
		}  else  {
			
			echo "ERROR".$stmt->error;
		}
		
	}
	
	function saveUserPlants($plant, $watering) {
		
		
		$stmt = $this->connection->prepare(
		"INSERT INTO f_userplants (plantID, userID,watering_interval) VALUES (?,?,?)");
		
		echo $this->connection->error;
		
		
		
		//asendan küsimärgi
		$stmt->bind_param("iii", $plant,$_SESSION["userId"],$watering);
		
		if ( $stmt->execute() )  {
			
			echo "salvestamine õnnestus";
			
		}  else  {
			
			echo "ERROR".$stmt->error;
		}
		
	}
	
	function getAll($q,$sort,$direction) {
		
		$allowedSortOptions = ["id", "plant", "interval"];
			
		if(!in_array($sort,$allowedSortOptions)){
			
			$sort="id";
		}	
		
		if($sort == "interval"){
			$sort = "wateringInterval";
		}
		
		echo "Sorteerin...";

		$orderBy="ASC";
		if($direction=="descending"){
			$orderBy="DESC";
		}	
		
		if($q == ""){
			echo"ei otsi...";
			$stmt = $this->connection->prepare("
			SELECT id, name, watering_days
			FROM f_plant
			WHERE deleted IS NULL
			ORDER BY $sort $orderBy");
			
		
		} else {
			echo"Otsib...".$q;
			$searchWord = "%".$q."%";
			$stmt = $this->connection->prepare(
			"SELECT id, name, watering_days from f_plant WHERE
			deleted IS NULL AND (name LIKE ? OR wateringInterval LIKE?)ORDER BY $sort $orderBy");
			$stmt->bind_param('ss', $searchWord, $searchWord);
			
		}
		echo $this->connection->error;
		
		
		$stmt->bind_result($id, $plant, $watering);
		$stmt->execute();
		
		
		
		//tekitan massiivi
		
		$result=array();
		
		//Tee seda seni, kuni on rida andmeid. ($stmt->fech)
		//Mis vastab select lausele.
		//iga uue rea andme kohta see lause seal sees
		
		while($stmt->fetch()){
			
			//tekitan objekti
			
			$plantClass = new StdClass();
			
		    $plantClass->id=$id;
			$plantClass->plants=$plant;
			$plantClass->intervals=$watering;
			
			
			
			array_push($result, $plantClass);
		}
		
		return $result;
		
		
	}
		
		
	}
	function getSingleData($edit_id){
    
		
		$stmt = $this->connection->prepare("SELECT plant, wateringInterval FROM flowers WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($plant, $wateringInterval);
		$stmt->execute();
		
		//tekitan objekti
		$plantFromDb = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$plantFromDb->plant = $plant;
			$plantFromDb->interval = $wateringInterval;
			
			
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: data.php");
			exit();
		}
		
		return $plantFromDb;
		
	}
	function deleteOne($id){
		
		$stmt = $this->connection->prepare("UPDATE flowers SET deleted='yes' WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("s",$id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "kustutamine õnnestus!";
		}
		
		
		
		
	}


	function update($id, $plant, $wateringInterval){
		
		$stmt = $this->connection->prepare("UPDATE flowers SET plant=?, wateringInterval=? WHERE id=?");
		$stmt->bind_param("ssi",$plant, $wateringInterval, $id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		
		
		
	}
	


?>