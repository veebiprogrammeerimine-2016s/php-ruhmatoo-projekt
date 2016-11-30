<?php 
class Coin {
	
	private $connection;
	function __construct($mysqli){
		//this viitab klassile (this == Coin)
		$this->connection = $mysqli;	
	}
	
	/*TEISED FUNKTSIOONID*/
	
	function userTransaction($BookId){
		$this->connection->set_charset("utf8");
		
		//kannan tehingut puudutavad andmed ühest tabelist (books) teise (points)
		$stmt = $this->connection->prepare("INSERT INTO project_points (book_id, user_id_give, points, created)
		SELECT book_id, user_id, points, created
		FROM project_books
		WHERE book_id = ?");
		echo $this->connection->error;
		
		$stmt->bind_param("i", $BookId);
		if($stmt->execute()) {
			//echo "teise tabelisse kantud";
		} else {
		 	echo "ERROR ".$stmt->error;               
		}
		
		$stmt->close();
	}
	
	function getCoins($id, $id){
		$this->connection->set_charset("utf8");
		
		//saadud mündid
		$stmt = $this->connection->prepare("SELECT SUM(points)  
			FROM project_points 
			WHERE seller_id = ? AND status = 'Ok' 
			");
		echo $this->connection->error;
		
		$stmt->bind_param("i", $id);
		if($stmt->execute()) {
			//echo "korras";
		}else {
			echo "ERROR ".$stmt->error;
		};
		$stmt->bind_result($addCoins);
		if($stmt->fetch()){
			$add = $addCoins;
	
		}
		$stmt->close();
		//kulutatud mündid
		$stmt = $this->connection->prepare("SELECT SUM(points) 
			FROM project_points 
			WHERE buyer_id = ? 
		");
		echo $this->connection->error;
		
		$stmt->bind_param("i", $id);
		if($stmt->execute()) {
			//echo "korras";
		}else {
			echo "ERROR ".$stmt->error;
		};
		$stmt->bind_result($subtractCoins);
		if($stmt->fetch()){
			$subtract = $subtractCoins;
		}
		//münte kokku
		$total = $add - $subtract + 10;
		
	 
		return $total;
		$stmt->close(); 
			
	}
	
	//kõik kasutaja raamatud, mis ta tahab ära anda
	function userOffers($id){
		$this->connection->set_charset("utf8");
		$stmt = $this->connection->prepare("
			SELECT project_points.book_id, project_points.points, project_points.buyer_id, project_points.status, project_books.title 
			FROM project_points, project_books
            WHERE project_points.seller_id = ?
			AND project_points.book_id = project_books.book_id
			
			
			
			");
		$stmt->bind_param("i", $id);
		echo $this->connection->error;
		
		$stmt->bind_result($bookIdDb, $pointsDb, $buyerDb, $statusDb, $titleDb);
		$stmt->execute();
		
		//tekitan massiivi
		$result = array();
		
		// tee seda, kuni on rida andmeid
	
		while ($stmt->fetch()) {
			//tekitan objekti
			$offer = new StdClass();
			$offer->book_id = $bookIdDb;
			$offer->title = $titleDb;
			$offer->points = $pointsDb;
			$offer->buyer = $buyerDb;
			$offer->status = $statusDb;
			
			
			array_push($result, $offer);
		}
		
		$stmt->close();
		return $result;
		
	}
	//kõik kasutaja raamatud, mis ta tahab saada
	function userWishes($id){
		$this->connection->set_charset("utf8");
		$stmt = $this->connection->prepare("
			SELECT project_points.book_id, project_points.points, project_points.seller_id, project_points.status, project_books.title 
			FROM project_points, project_books
            WHERE project_points.buyer_id = ?
			AND project_points.book_id = project_books.book_id
			
			
			
			");
		$stmt->bind_param("i", $id);
		echo $this->connection->error;
		
		$stmt->bind_result($bookIdDb, $pointsDb, $sellerDb, $statusDb, $titleDb);
		$stmt->execute();
		
		//tekitan massiivi
		$result = array();
		
		// tee seda, kuni on rida andmeid
	
		while ($stmt->fetch()) {
			//tekitan objekti
			$wish = new StdClass();
			$wish->book_id = $bookIdDb;
			$wish->title = $titleDb;
			$wish->points = $pointsDb;
			$wish->seller = $sellerDb;
			$wish->status = $statusDb;
			
			
			array_push($result, $wish);
		}
		
		
		$stmt->close();
		return $result;	
	} 
	
	

}
?>