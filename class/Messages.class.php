<?php 
class Messages {
	
	private $connection;
	function __construct($mysqli){
		//this viitab klassile (this == Messages)
		$this->connection = $mysqli;	
	}
	
	/*TEISED FUNKTSIOONID*/
	
	
	//kirja saatmine teisele kasutajale
	function newMessage($sender, $receiver, $title, $message){
		$message = "";
		$this->connection->set_charset("utf8");
		$stmt = $this->connection->prepare("
		INSERT INTO project_messages (sender_id, receiver_id, title, message) 
		VALUES (?, ?, ?, ?)");
		echo $this->connection->error;
		$stmt->bind_param("iiss", $sender, $receiver, $title, $message);  //asendan küsimärgid
		
		if($stmt->execute()) {
			$message = "Kiri saadetud";
		} else {
		 	$message = "Sellist kasutajat ei leitud";                  
		}
		$stmt->close();
		return $message;
	}
	
}