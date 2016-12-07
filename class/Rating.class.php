<?php
class Rating {
	
	private $connection;
	
	//funktsioon käivitatakse siis kui on 'new User(see jõuab siia)'
	function __construct($mysqli){
		//'this' viitab sellele klassile ja klassi muutujale
		$this->connection=$mysqli;
	}

	function pictureRating($id){
		
		$stmt = $this->connection->prepare("
		UPDATE submissions
		SET rating=rating+1
		WHERE id = ?");
		echo $this->connection->error;
		$stmt->bind_param("i", $id);
		
		$stmt->execute();
		//Execute prepared Query
		
		$stmt->close();
	}
	

}
?>