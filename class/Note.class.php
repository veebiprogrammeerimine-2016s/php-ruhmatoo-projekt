<?php 
class Note {
	
    private $connection;
	
	function __construct($mysqli){
		$this->connection = $mysqli;
	}
	
	/* KLASSI FUNKTSIOONID */
    
    function saveNote($note, $color) {
		
		$stmt = $this->connection->prepare("INSERT INTO colorNotes2 (note, color) VALUES (?, ?)");
		echo $this->connection->error;
		
		$stmt->bind_param("ss", $note, $color );

		if ( $stmt->execute() ) {
			echo "salvestamine õnnestus";	
		} else {	
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	
	
		function tabelisse2 ($description, $location, $date, $url) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO colorNotes (kirjeldus, asukoht, kuupäev, url)  VALUES (?,?,?,?)");
		
		$stmt->bind_param("ssss", $description, $location, $date,$url);
		
		if ($stmt->execute()) {
			
			echo "Edukalt postitatud! <br>";
		} else {
			echo "ERROR ".$stmt->error;
		}
	}
	


	
	function getAllNature() {
	
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, kirjeldus, asukoht, kuupäev, url FROM colorNotes");
		$stmt->bind_result($id, $description, $location, $date, $url);
		$stmt->execute();
		
		$results = array();
		
		//tsükli sisu tehakse nii mitu korda, mitu rida SQL lausega tuleb
		while($stmt->fetch()) {
			
			$nature = new StdClass();
			$nature->id = $id;
			$nature->description = $description;
			$nature->location = $location;
			$nature->day = $date;
			$nature->url = $url;
	
			
			//echo $color."<br>";
			array_push($results, $nature);
			
		}
		
		return $results;
		
	}
	
	
	
	
	function getAllNotes($q, $sort, $order) {
		$allowedSort=["id","note","color"];
		if(!in_array($sort, $allowedSort)){
			$sort="id";
		}
		$orderBy="ASC";
		if($order=="DESC"){
			$orderBy="DESC";
		}
		echo "sorteerin ".$sort." ".$orderBy." ";
		if($q!=""){
			echo "Otsin:".$q;
			
			$stmt = $this->connection->prepare("
				SELECT id, note, color
				FROM colorNotes2
				WHERE deleted IS NULL
				AND( note LIKE ? OR color LIKE ?)
				ORDER BY $sort $orderBY
			");
		
		$searchWord="%".$q."%";
		$stmt->bind_param("ss",$searchWord,$searchWord);
		
		}else{
		$stmt = $this->connection->prepare("
			SELECT id, note, color
			FROM colorNotes2
			WHERE deleted IS NULL
			
		");
		
		
		}
		$stmt->bind_result($id, $note, $color);
		$stmt->execute();
		
		$result = array();
		
		// tsükkel töötab seni, kuni saab uue rea AB'i
		// nii mitu korda palju SELECT lausega tuli
		while ($stmt->fetch()) {
			//echo $note."<br>";
			
			$object = new StdClass();
			$object->id = $id;
			$object->note = $note;
			$object->noteColor = $color;
			
			
			array_push($result, $object);
			
		}
		
		return $result;
		
	}
	
	function getSingleNoteData($edit_id){
    		
		$stmt = $this->connection->prepare("SELECT note, color FROM colorNotes WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($description, $location, $date,$url);
		$stmt->execute();
		
		//tekitan objekti
		$n = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()) {
			//echo $note."<br>";
			
			$object = new StdClass();
			$object->id = $id;
			$object->note = $note;
			$object->noteColor = $color;
			
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: data.php");
			exit();
		}
		
		$stmt->close();		
		return $n;
		
	}


	function updateNote($id, $note, $color){
				
		$stmt = $this->connection->prepare("UPDATE colorNotes SET note=?, color=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("ssss",$description, $location, $date,$url);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		
		$stmt->close();
		
	}
	
	function deleteNote($id){
		
		$stmt = $this->connection->prepare("
			UPDATE colorNotes
			SET deleted=NOW() 
			WHERE id=? AND deleted IS NULL
		");
		$stmt->bind_param("i", $id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		
		$stmt->close();
		
	}
} 
?>