<?php 
class Book {
	
	private $connection;
	function __construct($mysqli){
		//this viitab klassile (this == Book)
		$this->connection = $mysqli;	
	}
	
	/*TEISED FUNKTSIOONID*/
	
	function addBook($userId, $category, $title, $author, $year, $bookCondition, $location, $description, $points, $image){
		$this->connection->set_charset("utf8");
		$stmt = $this->connection->prepare("
		INSERT INTO project_books (user_id, cat, title, author, year, bookCondition, location, description, points, image) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		echo $this->connection->error;
		$stmt->bind_param("isssisssis", $_SESSION["userId"], $category, $title, $author, $year, $bookCondition, $location, $description, $points, $image);  //asendan küsimärgid
		
		if($stmt->execute()) {
			//echo "salvestamine õnnestus";
		} else {
		 	echo "ERROR ".$stmt->error;               
		}
		$stmt->close();
	}
	
}