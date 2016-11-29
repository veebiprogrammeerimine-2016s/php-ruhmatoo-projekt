<?php 
class Note {
	
    private $connection;
	
	function __construct($mysqli){
		$this->connection = $mysqli;
	}
	
	/* KLASSI FUNKTSIOONID */
    
    function saveNote($firstname,$lastname,$notebook,$serialnumber,$priority,$note,$color,$comment) {
		
		$stmt = $this->connection->prepare("INSERT INTO notebookRepair (firstname,lastname,notebook,serialnumber,priority,note,color,comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		echo $this->connection->error;
		
		$stmt->bind_param("ssssssss", $firstname,$lastname,$notebook,$serialnumber,$priority,$note,$color,$comment);

		if ( $stmt->execute() ) {
			echo "salvestamine õnnestus";	
		} else {	
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	
	function getAllNotes($q, $sort, $order) {
		
		//lubatud tulbad
		$allowedSort = ["id","firstname","lastname","notebook","serialnumber","priority","note", "color","comment"];
		
		if(!in_array($sort, $allowedSort)){
			//ei olnud lubatud tulpade sees
			$sort = "id"; //las sorteerib id järgi
		}
		
		$orderBy = "ASC";
		
		if($order == "DESC"){
			$orderBy = "DESC";
		}
		
		echo "sorteerin ".$sort." ".$orderBy." ";
		
		//otsime
		if($q != "") {
			
			echo "Otsin: ".$q;
			
			$stmt = $this->connection->prepare("
				SELECT id, firstname, lastname, notebook, serialnumber, priority, note, color, comment
				FROM notebookRepair
				WHERE deleted IS NULL
				AND (note LIKE ? OR color LIKE ?)
				ORDER BY $sort $orderBy
			");
			$searchWord = "%".$q."%";
			$stmt->bind_param("ssssssss", $searchWord, $searchWord);
		
		}else{
			//ei otsi
			$stmt = $this->connection->prepare("
				SELECT id, firstname, lastname, notebook, serialnumber, priority, note, color, comment
				FROM notebookRepair
				WHERE deleted IS NULL
				ORDER BY $sort $orderBy
			");
		}
		var_dump($stmt);
		$stmt->bind_result($id, $firstname, $lastname, $notebook, $serialnumber, $priority, $note, $color, $comment);
		$stmt->execute();
		
		$result = array();
		
		// tsükkel töötab seni, kuni saab uue rea AB'i
		// nii mitu korda palju SELECT lausega tuli
		while ($stmt->fetch()) {
			//echo $note."<br>";
			
			$object = new StdClass();
			$object->id = $id ;
			$object->firstname = $firstname;
			$object->lastname = $lastname;
			$object->notebook = $notebook;
			$object->serialnumber = $serialnumber;
			$object->priority = $priority;
			$object->note = $note;
			$object->noteColor = $color;
			$object->comment = $comment;
			
			
			
			array_push($result, $object);
			
		}
		
		return $result;
		
	}
	
	function getSingleNoteData($edit_id){
    		
		$stmt = $this->connection->prepare("SELECT note, color FROM notebookRepair WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($note, $color);
		$stmt->execute();
		
		//tekitan objekti
		$n = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$n->note = $note;
			$n->color = $color;
			
			
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
				
		$stmt = $this->connection->prepare("UPDATE notebookRepair SET note=?, color=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("ssi",$note, $color, $id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		
		$stmt->close();
		
	}
	
	function deleteNote($id){
		
		$stmt = $this->connection->prepare("
			UPDATE notebookRepair 
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