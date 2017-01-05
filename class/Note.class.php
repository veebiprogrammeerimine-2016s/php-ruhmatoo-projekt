<?php 
class nature2 {
	
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
		
		$stmt = $mysqli->prepare("INSERT INTO colorNotes (description, location, date, url)  VALUES (?,?,?,?)");
		
		$stmt->bind_param("ssss", $description, $location, $date,$url);
		
		if ($stmt->execute()) {
			
			echo "Edukalt postitatud! <br>";
		} else {
			echo "ERROR ".$stmt->error;
		}
	}
	


	
		function getAllNature ($q, $sort, $order){
			
			$allowedSort = ["id", "description", "location", "date", "url"];
			
			if(!in_array($sort, $allowedSort)){
            $sort = "id";
        }
        $orderBy = "ASC";
        if($order == "DESC") {
            $orderBy = "DESC";
        }
        echo "Sorteerin: ".$sort." ".$orderBy." ";
			
			if ($q != "") {
			
			echo "otsin: ".$q;
			
				$stmt = $this->connection->prepare("SELECT id, description, location, date, url FROM colorNotes WHERE deleted IS NULL AND ( description LIKE ? OR location LIKE ? OR date LIKE ? OR url like ? ) ORDER BY $sort $orderBy");
				$searchWord = "%".$q."%";
				$stmt->bind_param("ssss", $searchWord, $searchWord, $searchWord, $searchWord);
				
			} else {
				
				$stmt = $this->connection->prepare("SELECT id, description, location, date, url FROM colorNotes WHERE deleted IS NULL ORDER BY $sort $orderBy");
					}
			$stmt->bind_result($id, $description, $location, $date, $url);
			$stmt->execute();
			
			$results = array();
			// Tsükli sisu tehake nii mitu korda, mitu rida SQL lausega tuleb
			while($stmt->fetch()) {
				//echo $color."<br>";
				$nature2= new StdClass();
				$nature2->id = $id;
				$nature2->description = $description;
				$nature2->location = $location;
				$nature2->date = $date;
				$nature2->url = $url;
				
				array_push($results, $nature2);
			}
			
			return $results;
		}
		

	
	function getSingleNoteData($edit_id){
    		
		$stmt = $this->connection->prepare("SELECT description, location, date, url FROM colorNotes WHERE id=? AND deleted IS NULL");
		echo $this->connection->error;
		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($description, $location, $date,$url);
		$stmt->execute();
		
		//tekitan objekti
		$c = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()) {
			//echo $note."<br>";
			
			//$nature = new StdClass();
		
			$c->description = $description;
			$c->location = $location;
			$c->date = $date;
			$c->url = $url;
			
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: data.php");
			exit();
		}
		
		$stmt->close();		
		return $c;
		
	}

	function updateNote($description,$location, $date, $url){
    	
		
		$stmt = $this->connection->prepare("UPDATE colorNotes SET description=?, location=?, date=?, url=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("ssss",$description,$location, $date, $url);
		
		
		if($stmt->execute()){
			
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