<?php 
class Book {
	
	private $connection;
	function __construct($mysqli){
		//this viitab klassile (this == Book)
		$this->connection = $mysqli;	
	}
	
	/*TEISED FUNKTSIOONID*/
	//raamatu lisamine andmebaasi
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
	
	//kõik raamatud andmebaasist
	function getBooks() {
		$this->connection->set_charset("utf8");
		$stmt = $this->connection->prepare("
			SELECT book_id, cat, title, author, year, bookCondition, location, description, points, created, image 
			FROM project_books
			WHERE deleted IS NULL");
		echo $this->connection->error;
		
		$stmt->bind_result($bookIdDb, $categoryDb, $titleDb, $authorDb, $yearDb, $conditionDb, $locationDb, $descriptionDb, $pointsDb, $createdDb, $imageDb);
		$stmt->execute();
		
		//tekitan massiivi
		$result = array();
		
		// tee seda, kuni on rida andmeid
	
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$book = new StdClass();
			
			$book->book_id = $bookIdDb;
			$book->category = $categoryDb;
			$book->title = $titleDb;
			$book->author = $authorDb;
			$book->year = $yearDb;
			$book->condition = $conditionDb;
			$book->location = $locationDb;
			$book->description = $descriptionDb;
			$book->coins = $pointsDb;
			$book->listed = $createdDb;
			$book->image = $imageDb;
		
			array_push($result, $book);
		}
		
		$stmt->close();
		
		
		return $result;
	}
}