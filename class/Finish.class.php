<?php 
class Finish {
	
	private $connection;
	
	function __construct($mysqli){
		
		$this->connection = $mysqli;
		
	}

	/*TEISED FUNKTSIOONID */
	function delete($id){

		$stmt = $this->connection->prepare("UPDATE idea_description SET deleted=NOW() WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("i",$id);
		
		// kas �nnestus salvestada
		if($stmt->execute()){
			// �nnestus
			//echo "Deleted!";
		}
		
		$stmt->close();
		
		
	}
		
	function get($q, $sort, $order) {
		
		$allowedSort = ["id", "idea", "description", "user"];
		
		if(!in_array($sort, $allowedSort)){
			// ei ole lubatud tulp
			$sort = "id";
		}
		
		$orderBy = "ASC";
		
		if ($order == "DESC") {
			$orderBy = "DESC";
		}
		//echo "Sorting: ".$sort." ".$orderBy." ";
		
		
		//kas otsib
		if ($q != "") {
			
			//echo "Looking for: ".$q;
			
			$stmt = $this->connection->prepare("
				SELECT id, idea, description, user
				FROM idea_description
				WHERE deleted IS NULL 
				AND (idea LIKE ? OR description LIKE ?)
				ORDER BY $sort $orderBy
			");
			$searchWord = "%".$q."%";
			$stmt->bind_param("ss", $searchWord, $searchWord);
			
		} else {
			
			$stmt = $this->connection->prepare("
				SELECT id, idea, description, user
				FROM idea_description
				WHERE deleted IS NULL
				ORDER BY $sort $orderBy
			");
			
		}
	
		echo $this->connection->error;
		
		$stmt->bind_result($id, $idea, $description, $user);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$finish = new StdClass();
			
			$finish->id = $id;
			$finish->idea = $idea;
			$finish->description = $description;
			$finish->user = $user;
			
			
			// iga kord massiivi lisan juurde nr m�rgi
			array_push($result, $finish);
		}
		
		$stmt->close();
		
		
		return $result;
	}
	
	function getSingle($edit_id){

		$stmt = $this->connection->prepare("SELECT idea, description FROM idea_description WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($idea, $description);
		$stmt->execute();
		
		//tekitan objekti
		$finish = new Stdclass();
		
		//saime �he rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$finish->idea = $idea;
			$finish->description = $description;
			
			
		}else{
			// ei saanud rida andmeid k�tte
			// sellist id'd ei ole olemas
			// see rida v�ib olla kustutatud
			header("Location: data.php");
			exit();
		}
		
		$stmt->close();
		
		
		return $finish;
		
	}

	function save ($idea, $description) {
		
		$stmt = $this->connection->prepare("INSERT INTO idea_description (idea, description, user) VALUES (?, ?, ?)");
	
		echo $this->connection->error;
		
		$stmt->bind_param("sss", $idea, $description, $_SESSION["userEmail"]);
		
		if($stmt->execute()) {
			//echo "Success!";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		
		
	}
	
	function update($idea, $description){
    	
		$stmt = $this->connection->prepare("UPDATE idea_description SET idea=?, description=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("ssi", $_POST["idea"], $_POST["description"], $_POST["id"]);
		
		// kas �nnestus salvestada
		if($stmt->execute()){
			// �nnestus
			//echo "Success!";
		}
		
		$stmt->close();
		
		
	}
	
	
	
	
}
?>