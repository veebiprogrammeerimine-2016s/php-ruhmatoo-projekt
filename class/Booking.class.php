<?php 
class Booking {
	
	private $connection;
	
	function __construct($mysqli){
		
		$this->connection = $mysqli;
		
	}


	function save ($animal_id, $animal_return) {
		
		$stmt = $this->connection->prepare("INSERT INTO g_booking (animal_id, animal_return) VALUES (?, ?)");
	
		echo $this->connection->error;
		
		$stmt->bind_param("is", $animal_id, $animal_return);
		
		if($stmt->execute()) {
			echo "Salvestamine onnestus ";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		
		
	}
	
	function book($id){

		$stmt = $this->connection->prepare("UPDATE g_animals SET booked=NOW() WHERE id=? AND deleted IS NULL AND booked IS NULL");
		$stmt->bind_param("i",$id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "Rentimine 6nnestus!";
			header("Location: animals.php");
		}
		
		$stmt->close();
		
		
	}
	
}
?>