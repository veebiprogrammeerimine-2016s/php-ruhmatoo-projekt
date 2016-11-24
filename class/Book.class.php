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
	function getBooks($q, $sc) {
		$this->connection->set_charset("utf8");
		if($q == ""){
		$stmt = $this->connection->prepare("
			SELECT book_id, cat, title, author, year, bookCondition, location, description, points, created, image 
			FROM project_books
			WHERE deleted IS NULL");
		} else {
			$searchword = "%" .$q . "%";
			
			if($sc == "author"){
				$stmt = $this->connection->prepare("
				SELECT book_id, cat, title, author, year, bookCondition, location, description, points, created, image 
				FROM project_books
				WHERE deleted IS NULL AND author LIKE ?");
				$stmt->bind_param("s", $searchword);
			}
			if($sc == "title"){
				$stmt = $this->connection->prepare("
				SELECT book_id, cat, title, author, year, bookCondition, location, description, points, created, image 
				FROM project_books
				WHERE deleted IS NULL AND title LIKE ?");
				$stmt->bind_param("s", $searchword);
			}
			if($sc == "description"){
				$stmt = $this->connection->prepare("
				SELECT book_id, cat, title, author, year, bookCondition, location, description, points, created, image 
				FROM project_books
				WHERE deleted IS NULL AND description LIKE ?");
				$stmt->bind_param("s", $searchword);
			} else {
				$q = "";
				$sc = "";
				
			}
		}
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
		if(empty($result)){
			echo "Vasteid ei leitud";
		}
		
		return $result;
	}

	//konkreetne raamat id järgi
	function getSingle($id){
		$this->connection->set_charset("utf8");
		$stmt = $this->connection->prepare("
			SELECT cat, title, author, year, bookCondition, location, description, points, image 
			FROM project_books
			WHERE book_id=?
			AND deleted IS NULL");
		

		$stmt->bind_param("i", $id);
		$stmt->bind_result($categoryDb, $titleDb, $authorDb, $yearDb, $conditionDb, $locationDb, $descriptionDb, $pointsDb, $imageDb);
		$stmt->execute();
		
		//tekitan objekti
		$book = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			
			$book->category = $categoryDb;
			$book->title = $titleDb;
			$book->author = $authorDb;
			$book->year = $yearDb;
			$book->condition = $conditionDb;
			$book->location = $locationDb;
			$book->description = $descriptionDb;
			$book->coins = $pointsDb;
			$book->image = $imageDb;
				
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			
			header("Location: books.php");
			exit();
		}
		
		$stmt->close();
		return $book;
		
	}
	
}