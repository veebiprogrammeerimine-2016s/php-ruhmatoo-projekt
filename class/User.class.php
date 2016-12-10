<?php
class User {
	
	private $connection;
	
	//funktsioon käivitatakse siis kui on 'new User(see jõuab siia)'
	function __construct($mysqli){
		//'this' viitab sellele klassile ja klassi muutujale
		$this->connection=$mysqli;
	}
	
	/* kõik funktsioonid */
	
	function login($username, $password) {
		
		$stmt = $this->connection->prepare("
		SELECT id, username, email, password, created
		FROM user_sample
		WHERE username = ?
		");
		
		echo $this->connection->error;
		
		//asendan küsimärgi
		$stmt->bind_param("s", $username);
		
		//rea kohta tulba väärtus
		$stmt->bind_result($id, $usernameFromDb, $emailFromDb, $passwordFromDb, $created);
		
		$stmt->execute();
		
		//ainult SELECT'i puhul
		if($stmt->fetch()) {
			// oli olemas, rida käes
			//kasutaja sisestas sisselogimiseks
			$hash = hash("sha512", $password);
			
			if ($hash == $passwordFromDb) {
				//echo "Kasutaja $id logis sisse";
				
				$_SESSION["userId"] = $id;
				$_SESSION["username"] = $usernameFromDb;
				//echo "ERROR";
				
				header("Location:/~gregness/php-ruhmatoo-projekt/page/data.php");
				exit();
				
			} else {
				$notice = "parool vale";
			}
			
		} else {
			
			//ei olnud ühtegi rida
			$notice = "Kasutajanimega ".$username." kasutajat ei ole olemas";
		}
		
		$stmt->close();
		
		
		return $notice;
		
	}
	
	
	
	function register($username, $email, $password) {
		
		$stmt = $this->connection->prepare("INSERT INTO user_sample (username, email, password, admin, created) VALUE (?, ?, ?, 0,NOW())");
		echo $this->connection->error;
		
		$stmt->bind_param("sss", $username, $email, $password);
		
		if ($stmt->execute()) {


			header("Location:?success");
			exit();
			
		} else {
			//header("Location:/~gregness/php-ruhmatoo-projekt/page/register.php?duplicate");
			header("Location:?duplicate");
			exit();
		}
		$stmt->close();
	}
	
	function getUserData($author) {
		
		$stmt = $this->connection->prepare("
		select submissions.id, caption from submissions join user_sample on submissions.author=user_sample.id
		where username = ? ");
		echo $this->connection->error;
		
		$stmt->bind_param("s", $author);
		$stmt->execute();
		$results = array();
		$stmt->bind_result($id, $caption);
		
		while($stmt->fetch()){ //fetch values
		
			$data = new StdClass();
			$data->id = $id;
			$data->caption = $caption;
			
			
			//echo $color."<br>";
			array_push($results, $data);
		}
		
		$stmt->close();
		
		return $results;
	}
	

	
	
	
	
	
	
}
?>