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
		while($stmt->fetch()){
			$subtract = $subtractCoins;

		}
		$total = $add - $subtract + 10;
		/*if($total == 0){
			$total = 10;
		}*/
	 
		return $total;
		$stmt->close(); 
			
	}
	
	

}
?>