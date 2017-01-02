<?php class Topic {
	
	private $connection;
	
	function __construct($mysqli) {
		$this->connection = $mysqli;
	}
	
	function createNew($subject, $content, $username, $user_id, $category){
		
		$stmt = $this->connection->prepare("INSERT INTO topics(subject, content, username, user_id, category) VALUES(?,?,?,?,?)");
		echo $this->connection->error;
		
		$stmt->bind_param("sssis", $subject, $content, $username, $user_id, $category); 
		
		if($stmt->execute()) {
			$_SESSION["topic_message"] = "<p style='color:green;'>TEEMA LISATUD!</p'>";
		} else {
			echo "ERROR".$stmt->error;
		}
		
	}
	
	function addTopicAndFile ($subject, $content, $username, $user_id, $category, $target_file){
		
		$stmt = $this->connection->prepare("INSERT INTO topics(subject, content, username, user_id, category, file) VALUES(?,?,?,?,?,?)");
		echo $this->connection->error;
		
		$stmt->bind_param("sssiss", $subject, $content, $username, $user_id, $category, $target_file); 
		
		if($stmt->execute()) {
			$_SESSION["topic_message"] = "<p style='color:green;'>TEEMA LISATUD!</p'>";
		} else {
			echo "ERROR".$stmt->error;
		}
	}
	
	function addToGeneralArray ($q, $sort, $order){
		$allowedSort = ["subject", "username", "created"];
		
		if(!in_array($sort, $allowedSort)) { //esimene asi, mis ta tahab, on nõel ja teine heinakuhi
			// ei ole lubatud tulp, siis sorteerime teema järgi
			$sort = "subject";
		}
		
		$orderBy = "ASC";
		
		//see if tagab, et orderby saab aint 2 väärtust olla
		if($order == "DESC") {
			$orderBy = "DESC";
		}
		
		//echo "Sorteerin ".$sort." ".$orderBy." ";
		
		//kas otsib
		if($q != "") {
			//echo "Otsib: ".$q;
			//NB column name inside quotes(``)!
			$stmt = $this->connection->prepare("
				SELECT id, subject, created, username
				FROM topics
				WHERE deleted IS NULL and `category` = 'general'
				AND (subject LIKE ? OR username LIKE ? OR created LIKE ?)
				ORDER BY $sort $order
			"); 
			$searchWord = "%".$q."%";
			//echo $q;
			//echo $searchWord;
			$stmt->bind_param("sss", $searchWord, $searchWord, $searchWord);
		} else {
			$stmt =  $this->connection->prepare("
				SELECT id, subject, created, username
				FROM topics
				WHERE deleted IS NULL and `category` = 'general'
				ORDER BY $sort $order				
			");
		}
		
		echo $this->connection->error;
		
		$stmt->bind_result ($id, $subject, $date, $username);
		$stmt-> execute();
		
		$result = array();

		while ($stmt->fetch()){	
			$topic = new StdClass();
			$topic->id = $id;
			$topic->subject = $subject;
			$topic->created = $date;
			$topic->username = $username;
			
			array_push ($result, $topic);
			$_SESSION["subject"] = $subject;
		}
		$stmt->close();
		//$mysqli->close();
		
		return $result;
	}
	
	function addToPartnerArray ($q, $sort, $order){
		$allowedSort = ["subject", "username", "created"];
		
		if(!in_array($sort, $allowedSort)) {
			$sort = "subject";
		}
		
		$orderBy = "ASC";
		
		if($order == "DESC") {
			$orderBy = "DESC";
		}
		

		if($q != "") {
			$stmt = $this->connection->prepare("
				SELECT id, subject, created, username
				FROM topics
				WHERE deleted IS NULL and `category` = 'partner'
				AND (subject LIKE ? OR username LIKE ? OR created LIKE ?)
				ORDER BY $sort $order
			"); 
			$searchWord = "%".$q."%";

			$stmt->bind_param("sss", $searchWord, $searchWord, $searchWord);
		} else {
			$stmt =  $this->connection->prepare("
				SELECT id, subject, created, username
				FROM topics
				WHERE deleted IS NULL and `category` = 'partner'
				ORDER BY $sort $order				
			");
		}
		
		echo $this->connection->error;
		
		$stmt->bind_result ($id, $subject, $date, $username);
		$stmt-> execute();
		
		$result = array();

		while ($stmt->fetch()){	
			$topic = new StdClass();
			$topic->id = $id;
			$topic->subject = $subject;
			$topic->created = $date;
			$topic->username = $username;
			
			array_push ($result, $topic);
			$_SESSION["subject"] = $subject;
		}
		$stmt->close();
		
		return $result;
	}
	
	function get($topic_id){
		
		$stmt = $this->connection-> prepare("SELECT subject, content, created, username, file FROM topics WHERE id=? AND deleted IS NULL");
		
		echo $this->connection->error;

		$stmt->bind_param("i", $topic_id);
		$stmt->bind_result($subject, $content, $created, $username, $file);
		$stmt->execute();
		
		//tekitan objekti
		$topic = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$topic->subject = $subject;
			$topic->content = $content;
			$topic->created = $created;
			$topic->username = $username;
			$topic->filename = $file;
			
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: data.php");
			exit();
		}
		
		$stmt->close();
		//$mysqli->close();
		
		return $topic;
	}

	function checkUser($topic_id, $user_id){
		$stmt = $this->connection-> prepare("SELECT subject, content FROM topics WHERE id=? and user_id=?");
		
		echo $this->connection->error;
		
		$stmt->bind_param("ii", $topic_id, $user_id);
		$stmt->bind_result($subject, $content);
		$stmt->execute();
		
		$del_topic = "";
		
		if($stmt->fetch()){
		
			$del_topic = "<a class='btn btn-default btn-xs' href='topic.php?id=$topic_id&delete=true' style='text-decoration:none'><font color='	 #cc0000''><span class='glyphicon glyphicon-trash'></span> Kustuta oma teema</font></a>";
			//echo $del_topic;
		
		}
		
		$stmt->close();
		return $del_topic;
	}
	
	function del($topic_id, $user_id){
		$stmt = $this->connection->prepare("UPDATE topics SET deleted=NOW() WHERE id=? AND user_id=? AND deleted IS NULL");
 		$stmt->bind_param("ii",$topic_id, $user_id);
		
		if($stmt->execute()){
			$_SESSION["topic_message"] = "<p style='color:red;'>TEEMA KUSTUTATUD!</p>";
 		}
 		
 		$stmt->close();
	}
}
?>