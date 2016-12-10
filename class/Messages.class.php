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
			//echo "Kirju pole saabunud";
		}
		
		return $result;
	}
	//kasutja avas kirja
	function messageOpened($message_id, $receiver_id){
		$this->connection->set_charset("utf8");
		$stmt = $this->connection->prepare("
		UPDATE project_messages
		SET received = NOW()
		WHERE id=? AND receiver_id = ?
		");
		$stmt->bind_param("ii", $message_id, $receiver_id);
		// kas õnnestus salvestada
		if($stmt->execute()){
			//echo "salvestus õnnestus!";
		}else {
		 	echo "ERROR func deleteBook ".$stmt->error;               
		}
		
		$stmt->close();
	}
	
		//kasutaja saadetud kirjad
	function allSent($userId){
		$this->connection->set_charset("utf8");
		$stmt = $this->connection->prepare("
		SELECT id, receiver_id, title, message, received, sent
				FROM project_messages
				WHERE sender_deleted IS NULL AND sender_id = ?
				");
		$stmt->bind_param("i", $userId);
		echo $this->connection->error;
		
		$stmt->bind_result($messageIdDb, $receiverIdDb, $titleDb, $messageDb, $receivedDb, $sentDb);
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
			$message->receiver_id = $receiverIdDb;
			$message->title = $titleDb;
			$message->content = $messageDb;
			
			$sentTimestamp = strtotime($sentDb);
			$sentTimestamp = date("d.m.Y  H:i", $sentTimestamp);
			$message->sent = $sentTimestamp;
			if($receivedDb != NULL){                   //kui pole NULL, siis avatud
				$receivedTimestamp = strtotime($receivedDb);  
				$receivedTimestamp = date("d.m.Y", $receivedTimestamp);
				$message->received = $receivedTimestamp;
			}
			
			array_push($result, $message);
		}
		
		$stmt->close();
		if(empty($result)){
			//echo "Saadetud kirju ei leitud";
		}
		
		return $result;
	}
	//et kustutada outboxi kiri
	function deleteSentMessage($message_id, $sender_id){
    	$this->connection->set_charset("utf8");
		$stmt = $this->connection->prepare("
		UPDATE project_messages
		SET sender_deleted='del' 
		WHERE id=? AND sender_id=? AND sender_deleted IS NULL
		");
		$stmt->bind_param("ii", $message_id, $sender_id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			//echo "salvestus õnnestus!";
		}else {
		 	echo "ERROR func deleteMessage ".$stmt->error;               
		}
		
		$stmt->close();		
	}
	
	//et kustutada inboxi kiri
	function deleteReceivedMessage($message_id, $receiver_id){
    	$this->connection->set_charset("utf8");
		$stmt = $this->connection->prepare("
		UPDATE project_messages
		SET receiver_deleted='del' 
		WHERE id=? AND receiver_id=? AND receiver_deleted IS NULL
		");
		$stmt->bind_param("ii", $message_id, $receiver_id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			//echo "salvestus õnnestus!";
		}else {
		 	echo "ERROR func deleteMessage ".$stmt->error;               
		}
		
		$stmt->close();		
	}
	
}