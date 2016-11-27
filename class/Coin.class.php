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

}
?>