<?php 
class Upload {

	private $connection;
	
	//funktsioon käivitatakse siis kui on 'new User(see jõuab siia)'
	function __construct($mysqli){
	//'this' viitab sellele klassile ja klassi muutujale
	$this->connection=$mysqli;
	}
	
	
	function uploadAudio($userid,$caption,$url){
	

			$database = "if16_andralla_2";
			$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
			
		
			if ($mysqli->connect_error) {
				die('Connect Error: ' . $mysqli->connect_error);
			}
			
			$stmt = $mysqli->prepare("INSERT INTO uploads (author, caption, url) VALUES (?,?,?)");
			
			echo $mysqli->error;

			$stmt->bind_param("sss", $userid,$caption,$url);
			
		
			if($stmt->execute()) {
				echo "Saved";			
			} else {
				echo "ERROR ".$stmt->error;
			}
			
			$stmt->close();
			$mysqli->close();
	
	}
	

	function getAudio(/*siia ei unusta*/) {

			$stmt = $this->connection->prepare("
				SELECT uploads.id,caption,url,email
				FROM uploads 
				join user_sample on uploads.author=user_sample.id
				WHERE rating is NULL
			
			");
			
		
		$stmt->bind_result($id,$caption,$url,$email);
		$stmt->execute();

		$results = array();
		
		
		while ($stmt->fetch()) {
			
			$pictureTable = new StdClass();
			$pictureTable->id = $id;
			$pictureTable->caption = $caption;
			$pictureTable->url = $url;
			$pictureTable->author = $author;
			
			array_push($results, $pictureTable);
			
		}
		
		return $results;
		
	}
	
	
	
	
	
	
}


?>