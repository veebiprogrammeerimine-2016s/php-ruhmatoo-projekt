<?php class Reply {
	
	private $connection;
	
	function __construct($mysqli) {
		$this->connection = $mysqli;
	}
	
	function createNew($content, $subject_id, $username, $user_id){
		
		$stmt = $this->connection->prepare("INSERT INTO replies(content, username, topic_id, user_id) VALUES(?,?,?,?)");
		echo $this->connection->error;
		
		$stmt->bind_param("ssii", $content, $username, $subject_id, $user_id); 
		
		if($stmt->execute()) {
			$_SESSION["reply_message"] = "<p style='color:green;'>VASTUS LISATUD!</p>";
		} else {
			echo "ERROR".$stmt->error;
		}
		
	}
	
	function createNewWithFile($content, $subject_id, $username, $user_id, $target_file){
		
		$stmt = $this->connection->prepare("INSERT INTO replies(content, username, topic_id, user_id, file) VALUES(?,?,?,?,?)");
		echo $this->connection->error;
		
		$stmt->bind_param("ssiis", $content, $username, $subject_id, $user_id, $target_file); 
		
		if($stmt->execute()) {
			$_SESSION["reply_message"] = "<p style='color:green;'>VASTUS LISATUD!</p>";
		} else {
			echo "ERROR".$stmt->error;
		}
		
	}
	
	function addToArray ($topic_id){
		
		$stmt = $this->connection->prepare("
			SELECT id, content, created, username, file
			FROM replies
			WHERE topic_id=?
			AND deleted IS NULL
		");
		echo $this->connection->error;
		
		$stmt->bind_param("i", $topic_id);
		
		$stmt->bind_result($id, $content, $created, $username, $file);
		$stmt-> execute();
		
		$result = array();
		
		while ($stmt->fetch()){	
			$reply = new StdClass();
			$reply->id = $id;
			$reply->content = $content;
			$reply->created = $created;
			$reply->username = $username;
			$reply->filename = $file;
		
			array_push ($result, $reply);
		}
		
		$stmt->close();
		//$mysqli->close();
		
		return $result;
	}
	
	function checkUser($topic_id, $user_id, $reply_id) {
		$stmt = $this->connection-> prepare("SELECT content FROM replies WHERE id=? and topic_id=? and user_id=?");
		
		echo $this->connection->error;
		
		$stmt->bind_param("iii", $reply_id, $topic_id, $user_id);
		$stmt->bind_result($content);
		$stmt->execute();
		
		$change_reply = "";
		
		if($stmt->fetch()){
			
			$change_reply = "<a class='btn btn-default btn-xs' href='edit.php?topic=$topic_id&reply=$reply_id' style='text-decoration:none'><span class='glyphicon glyphicon-pencil'></span> Muuda või kustuta oma vastus</a>";
		
		}	
		$stmt->close();
		return $change_reply;
	}
	
	function checkAccess($topic_id, $reply_id, $user_id){
		$stmt = $this->connection-> prepare("SELECT content FROM replies WHERE topic_id=? and id=? and user_id=?");
		
		echo $this->connection->error;
		
		$stmt->bind_param("iii", $topic_id, $reply_id, $user_id);
		$stmt->bind_result($content);
		$stmt->execute();
		
		$access = "no";
		
		if($stmt->fetch()){
			
			$access = "yes";
		
		} 
		
		return $access;
	}
	
	
	function find($topic_id, $reply_id, $user_id ){
		$stmt = $this->connection-> prepare("SELECT content, file FROM replies WHERE topic_id=? and id=? and user_id=?");
		
		echo $this->connection->error;
		
		$stmt->bind_param("iii", $topic_id, $reply_id, $user_id);
		$stmt->bind_result($content, $file);
		$stmt->execute();

		//$reply = "";
		$reply = new StdClass();		
		
		if($stmt->fetch()){
			//$reply= $content;
			$reply->content = $content;
			$reply->filename= $file;
		}
		
		$stmt->close();
		
		return $reply;
		
	}
	
	function update($reply, $reply_id){
		$stmt = $this->connection->prepare("UPDATE replies SET content=? WHERE id=?");
		
		$stmt->bind_param("si",$reply, $reply_id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			//echo "Muudatus salvestatud!";
			$_SESSION["reply_change_message"] = "<p style='color:green;'>VASTUS MUUDETUD!</p>";
		}
		
		$stmt->close();
	}
	
	function updateTime($reply_id){
		$stmt = $this->connection->prepare("UPDATE replies SET created = current_timestamp WHERE id=?");
		
		$stmt->bind_param("i",$reply_id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
		}
		
		$stmt->close();
	}
	
	function updateWithFile($reply, $reply_id, $target_file){
		$stmt = $this->connection->prepare("UPDATE replies SET content=?, file=? WHERE id=?");
		
		$stmt->bind_param("ssi",$reply, $target_file, $reply_id);
		
		if($stmt->execute()){
			$_SESSION["reply_change_message"] = "<p style='color:green;'>VASTUS MUUDETUD!</p>";
		}
		
		$stmt->close();
	}
	
	function delPic($nofile, $topic_id, $reply_id){
		$stmt = $this->connection->prepare("UPDATE replies SET file=? WHERE id=? AND topic_id=? AND user_id=? AND deleted IS NULL");
		
		$stmt->bind_param("siii",$nofile, $reply_id, $topic_id, $_SESSION["userId"] );
		
 		if($stmt->execute()){
			$_SESSION["reply_change_message"] = "<p style='color:red;'>Pilt kustutatud!</p>";
 		}
 		
 		$stmt->close();
		
	}
	
	function del($topic_id, $reply_id){
		$stmt = $this->connection->prepare("UPDATE replies SET deleted=NOW() WHERE id=? AND topic_id=? AND deleted IS NULL");
		$stmt->bind_param("ii",$reply_id, $topic_id);

 		if($stmt->execute()){
			$_SESSION["reply_del_message"] = "<p style='color:red;'>VASTUS KUSTUTATUD!</p>";
 		}
 		
 		$stmt->close();
		
	}
	
}
?>