<?php
class Comment {
	
	
	private $connection;
	
	//funktsioon käivitatakse siis kui on 'new User(see jõuab siia)'
	function __construct($mysqli){
		//'this' viitab sellele klassile ja klassi muutujale
		$this->connection=$mysqli;
	}
	
	/* kõik funktsioonid */
	
	function insertComment($topicid,$userid,$comment) {

		$stmt = $this->connection->prepare("
		insert into comments (topicid, userid, comment, date)
		values (?,?,?, NOW())
		");
		echo $this->connection->error;
		
		$stmt->bind_param("iis", $topicid, $userid, $comment);
		
		if ($stmt->execute()) {


			header("Location:?topicid=$topicid&posted=true");
			exit();
			
		} else {
			header("Location:?topicid=$topicid&posted=false");
			exit();
		}
		$stmt->close();
		
	}
	
	function getComments($topicid) {
		
		$stmt = $this->connection->prepare("SELECT username, comment,date
		FROM comments
		join user_sample on comments.userid=user_sample.id
		where topicid = ?");
		$stmt->bind_param("i", $topicid);

		$stmt->execute(); //Execute prepared Query
		$results2 = array();
		$stmt->bind_result($user, $comment, $aeg);
		
		while($stmt->fetch()){ //fetch values
		
			$data = new StdClass();
			$data->userid = $user;
			$data->comment = $comment;
			$data->aeg = $aeg;
			
			
			//echo $color."<br>";
			array_push($results2, $data);
		}
		
		$stmt->close();
		
		return $results2;
	}
	
	
	
	
	
	
}
?>