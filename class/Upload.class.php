<?php 
class Upload {

	private $connection;
	
	//funktsioon käivitatakse siis kui on 'new User(see jõuab siia)'
	function __construct($mysqli){
	//'this' viitab sellele klassile ja klassi muutujale
	$this->connection=$mysqli;
	}
	
	
	/*TEISED FUNKTSIOONID*/
	
	function uploadAudio($userid,$caption,$url){
			
			$database = "if16_andralla_2";
			$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

			/*
			if ($mysqli->connect_error) {
				die('Connect Error: ' . $mysqli->connect_error);
			}
			*/
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

		$stmt=$this->connection->prepare("SELECT caption, email from uploads join
		user_sample on user_sample.id=uploads.author");
		$stmt->bind_result($caption, $email);
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
			
			$audio -> caption =$caption;
			$audio -> email =$email;
			
			// iga kord massiivi lisan juurde nr m2rgi
			array_push($result, $audio);
		}
		
		$stmt->close();
		
		return $result;
		
	}
	
	
	
	
}


?>