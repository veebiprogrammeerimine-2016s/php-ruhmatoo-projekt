<?php 
class insert {
	private $connection;
	function __construct($mysqli){
		$this->connection = $mysqli;
	}
	
	function insert($title, $content, $author) {
		$stmt = $this->connection->prepare("INSERT INTO posts (title, content)
		VALUES (?, ?)");
		echo $this->connection->error;
		
		$stmt->bind_param("ss", $title, $content);
		if ( $stmt->execute() ) {
			echo "salvestamine �nnestus";	
		} else {	
			echo "ERROR ".$stmt->error;
		}
		
	}
	
} 
?>