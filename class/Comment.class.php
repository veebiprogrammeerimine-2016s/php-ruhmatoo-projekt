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
		
		$stmt = $this->connection->prepare("SELECT comments.id, username, comment,date
		FROM comments
		join user_sample on comments.userid=user_sample.id
		where topicid=(?) and reported<5");
		$stmt->bind_param("i", $topicid);

		$stmt->execute(); //Execute prepared Query
		$results2 = array();
		$stmt->bind_result($commentid, $user, $comment, $aeg);
		
		while($stmt->fetch()){ //fetch values
		
			$data = new StdClass();
			$data->commentid = $commentid;
			$data->userid = $user;
			$data->comment = $comment;
			$data->aeg = $aeg;
			
			
			//echo $color."<br>";
			array_push($results2, $data);
		}
		
		$stmt->close();
		
		return $results2;
	}
	
	function reportComment($commentId, $userId,$topic) {
		
		$stmt = $this->connection->prepare("SELECT user_id FROM reported WHERE user_id=? AND post_id=?");
		echo $this->connection->error;
		$stmt->bind_param("ii", $userId, $commentId);
		$stmt->execute();
		
		if($stmt->fetch()) {
			
				//sai ühe rea
				header("Location:topic.php?topicid=$topic&posted&dup");
				exit();
				
			} else {
	
				$stmt->close();
				
				$stmt = $this->connection->prepare("UPDATE comments
				SET reported=reported+1 WHERE id=(?);

				");
				$stmt->bind_param("i", $commentId);
				$stmt->execute(); //Execute prepared Query
				$stmt->close();
				
				
				$stmt = $this->connection->prepare("insert into reported (user_id, post_id)
				values (?,?)
				");
				$stmt->bind_param("ii", $userId, $commentId);
				$stmt->execute(); //Execute prepared Query
			
				header("Location:topic.php?topicid=$topic&posted&suc");
				exit();
			}
		
		
		$stmt->close();
	}
	
	
	
	
	
	
}
?>