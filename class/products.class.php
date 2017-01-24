<?php
class Products {
		private $connection;
		function __construct($mysqli){
			$this->connection=$mysqli;

		}
		
		
			
	/* uue kuulutuse lisamine	createpost.php */

	function saveproduct ($postid, $heading, $condition, $description, $price, $status) {
		
		$stmt = $this->connection->prepare("INSERT INTO prod_postinfo (postid, heading, productcondition, description, price, status) VALUES (?, ?, ?, ?, ?, ?)");
		echo $this->connection->error;
		$stmt->bind_param("isssis", $postid, $heading, $condition, $description, $price, $status);
		
		if($stmt->execute()) {
			echo "salvestamine õnnestus";
		} else {
			echo "ERROR".$stmt->error;
		}
		$stmt->close();
	}
		/*andmebaasi loomine	data.php */	
	function createNewPost() {
		$stmt = $this->connection->prepare("INSERT INTO prod_posts (poststarted, status, userid) VALUES (NOW(), 0, ?)");
		echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->execute();
		$stmt->close();
	}
		
		
		
	?>