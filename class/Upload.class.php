<?php 
class Upload {

	private $connection;
	
	//funktsioon k�ivitatakse siis kui on 'new User(see j�uab siia)'
	function __construct($mysqli){
	//'this' viitab sellele klassile ja klassi muutujale
	$this->connection=$mysqli;
	}
	
	
	/*TEISED FUNKTSIOONID*/
	
	function uploadAudio($userid,$caption,$url){
		
			if ($mysqli->connect_error) {
				die('Connect Error: ' . $mysqli->connect_error);
			}
			
			$stmt=$this->connection->prepare("INSERT INTO uploads (author, caption, url) VALUES (?,?,?)");
			
			echo $this->connection->error;

			$stmt->bind_param("sss", $userid,$caption,$url);
			
		
			if($stmt->execute()) {
				echo "Saved";			
			} else {
				echo "ERROR ".$stmt->error;
			}
			
			$stmt->close();
			$mysqli->close();
	
	}
	

	function getAudio() {

		$stmt=$this->connection->prepare("SELECT uploads.id,caption,url
				FROM uploads 
				join user_sample on uploads.author=user_sample.id
				WHERE rating is NULL");
		$stmt->bind_result($id, $caption, $author);
		$stmt->execute();
		echo $this->connection->error;
		
		

		//tekitan massiivi
		$result = array();
		// tee seda seni kuni on rida andmeid
		// mis vastab select lausele
		// fetch annab andmeid yhe rea kaupa
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$audio = new StdClass();
			
			$audio -> id = $id;
			$audio -> author =$author;
			$audio -> caption =$caption;
			
			// iga kord massiivi lisan juurde nr m2rgi
			array_push($result, $audio);
		}
		
		$stmt->close();
		
		return $result;
		
	}
	
	
	
	
}


?>