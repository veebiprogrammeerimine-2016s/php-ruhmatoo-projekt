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
		$note = "";
		$this->connection->set_charset("utf8");
		$stmt = $this->connection->prepare("
		INSERT INTO project_messages (sender_id, receiver_id, title, message) 
		VALUES (?, ?, ?, ?)");
		echo $this->connection->error;
		$stmt->bind_param("iiss", $sender, $receiver, $title, $message);  //asendan küsimärgid
		
		if($stmt->execute()) {
			$note = "Kiri saadetud";
		} else {
		 	$note = "Sellist kasutajat ei leitud";                  
		}
		$stmt->close();
		return $note;
	}
	
	//kasutajale saabunud kirjad
	function allReceived($userId){
		$this->connection->set_charset("utf8");
		$stmt = $this->connection->prepare("
		SELECT id, sender_id, title, message, received, sent
				FROM project_messages
				WHERE receiver_deleted IS NULL AND receiver_id = ?
				");
		$stmt->bind_param("i", $userId);
		echo $this->connection->error;
		
		$stmt->bind_result($messageIdDb, $senderIdDb, $titleDb, $messageDb, $receivedDb, $sentDb);
		if($stmt->execute()){
			//echo "korras!";
		}else {
		 	echo "ERROR func allReceived ".$stmt->error;               
		}
		
		//tekitan massiivi
		$result = array();
		
		// tee seda, kuni on rida andmeid
	
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$message = new StdClass();
			
			$message->message_id = $messageIdDb;
			$message->sender_id = $senderIdDb;
			$message->title = $titleDb;
			$message->content = $messageDb;
			$message->received = $receivedDb;   //NULL kui pole avanud kirja
			$timestamp = strtotime($sentDb);
			$timestamp = date("d.m.Y  H:i", $timestamp);
			$message->sent = $timestamp;
			
			array_push($result, $message);
		}
		
		
		$stmt->close();
		if(empty($result)){
			echo "Kirju pole saabunud";
		}
		
		return $result;
	}
	
}