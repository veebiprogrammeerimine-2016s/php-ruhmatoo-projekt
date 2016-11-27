<?php
class User {
	
	private $connection;
	
	//funktsioon käivitatakse siis kui on 'new User(see jõuab siia)'
	function __construct($mysqli){
		//'this' viitab sellele klassile ja klassi muutujale
		$this->connection=$mysqli;
	}
	
	/* kõik funktsioonid */
	
	function login($email, $password) {
		
		$stmt = $this->connection->prepare("
		SELECT id, email, password, created
		FROM user_sample
		WHERE email = ?
		");
		
		echo $this->connection->error;
		
		//asendan küsimärgi
		$stmt->bind_param("s", $email);
		
		//rea kohta tulba väärtus
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		
		$stmt->execute();
		
		//ainult SELECT'i puhul
		if($stmt->fetch()) {
			// oli olemas, rida käes
			//kasutaja sisestas sisselogimiseks
			$hash = hash("sha512", $password);
			
			if ($hash == $passwordFromDb) {
				echo "Kasutaja $id logis sisse";
				
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				//echo "ERROR";
				
				header("Location:/~gregness/php-ruhmatoo-projekt/page/data.php");
				exit();
				
			} else {
				$notice = "parool vale";
			}
			
		} else {
			
			//ei olnud ühtegi rida
			$notice = "Sellise emailiga ".$email." kasutajat ei ole olemas";
		}
		
		$stmt->close();
		
		
		return $notice;
		
	}
	
	
	
	function register($email, $password) {
		
		$stmt = $this->connection->prepare("INSERT INTO user_sample (email, password) VALUE (?, ?)");
		echo $this->connection->error;
		
		$stmt->bind_param("ss", $email, $password);
		
		if ($stmt->execute()) {


			header("Location:/~gregness/php-ruhmatoo-projekt/page/register.php?success");
			exit();
			
		} else {
			header("Location:/~gregness/php-ruhmatoo-projekt/page/register.php?duplicate");
			exit();
		}
		$stmt->close();
	}
	
	function getUserData($author) {
		
		$stmt = $this->connection->prepare("
		select id, caption from submissions
		where author = ?");
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