<?php 
class Note {
	
    private $connection;
	
	function __construct($mysqli){
		$this->connection = $mysqli;
	}
	
	/* KLASSI FUNKTSIOONID */
    
    function saveNote($firstname,$lastname,$notebook,$serialnumber,$priority,$comment) {
		
		$stmt = $this->connection->prepare("INSERT INTO notebookRepair (firstname,lastname,notebook,serialnumber,priority,comment) VALUES (?, ?, ?, ?, ?, ?)");
		echo $this->connection->error;
		
		$stmt->bind_param("ssssss", $firstname,$lastname,$notebook,$serialnumber,$priority,$comment);

		if ( $stmt->execute() ) {
			echo "salvestamine õnnestus";	
		} else {	
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	
	function getAllNotes($q, $sort, $order) {
		
		//lubatud tulbad
		$allowedSort = ["id", "firstname","lastname","notebook","serialnumber", "color", "comment"];
		
		if(!in_array($sort, $allowedSort)){
			//ei olnud lubatud tulpade sees
			$sort = "id"; //las sorteerib id järgi
		}
		
		$orderBy = "ASC";
		
		if($order == "DESC"){
			$orderBy = "DESC";
		}
		
		//echo "sorteerin ".$sort." ".$orderBy." ";
		
		//otsime
		if($q != "") {
			
			echo "Searching... ".$q;
			
			$stmt = $this->connection->prepare("
				SELECT id, firstname, lastname, notebook, serialnumber, priority, comment
				FROM notebookRepair
				WHERE deleted IS NULL
				AND (firstname LIKE ? OR lastname LIKE ? OR notebook LIKE ? OR serialnumber LIKE ? OR priority LIKE ? OR comment LIKE ?)
				ORDER BY $sort $orderBy
			");
			$searchWord = "%".$q."%";
			$stmt->bind_param("ssssss", $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord);
		
		}else{
			//ei otsi
			$stmt = $this->connection->prepare("
				SELECT id, firstname, lastname, notebook, serialnumber, priority, comment
				FROM notebookRepair
				WHERE deleted IS NULL
				ORDER BY $sort $orderBy
			");
		}
		
		$stmt->bind_result($id, $firstname, $lastname, $notebook, $serialnumber, $priority, $comment);
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
			$object->comment = $comment;
			//$object->note = $note;
			//$object->noteColor = $color;
			
			
			
			
			array_push($result, $object);
			
		}
		
		return $result;
		
	}
	
	function getSingleNoteData($edit_id){
    		
		$stmt = $this->connection->prepare("SELECT firstname, lastname, notebook, serialnumber, priority, comment FROM notebookRepair WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($firstname, $lastname, $notebook, $serialnumber, $priority, $comment);
		$stmt->execute();
		
		//tekitan objekti
		$n = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$n->firstname = $firstname;
			$n->lastname = $lastname;
			$n->notebook = $notebook;
			$n->serialnumber = $serialnumber;
			$n->priority= $priority;
			$n->comment= $comment;
			
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


	function updateNote($firstname, $lastname, $notebook, $serialnumber, $priority, $comment){
				
		$stmt = $this->connection->prepare("UPDATE notebookRepair SET firstname=?, lastname=?, notebook=?, serialnumber=?, comment=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("ssssss",$firstname, $lastname, $notebook, $serialnumber, $priority, $comment);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "Edited";
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