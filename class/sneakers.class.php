<?php
class Sneakers {
	
		private $connection;
		
		function __construct($mysqli){
			
			$this->connection=$mysqli;

		}

	function savesneaker ($heading, $model, $description, $price) {
		
		$stmt = $this->connection->prepare("INSERT INTO sm_posts (userid, heading, model, description, price) VALUES (?, ?, ?, ?, ?)");
	
		echo $this->connection->error;
		
		$stmt->bind_param("isssi", $_SESSION["userId"], $heading, $model, $description, $price);
		
		if($stmt->execute()) {
			
			echo "salvestamine õnnestus";
			
		} else {
			
			echo "ERROR".$stmt->error;
		}
		
		$stmt->close();
		
	}
	
	function getallsneakers($q, $sort, $direction) {
		
		$allowedSortOptions=["contactemail","description","price"];
		if(!in_array($sort, $allowedSortOptions)){
			$sort = "contactemail";
		}
		echo "Sorteerin: ".$sort." ";
		
		$orderBy="ASC";
		if($direction == "descending"){
			$orderBy="DESC";
		}
		echo "Jarjekord: ".$orderBy." ";
		
		
	
		if($q==""){
			echo "Ei otsi";
			$stmt=$this->connection->prepare("
			SELECT contactemail, description, price
			FROM sneakers
			ORDER BY $sort $orderBy
		");
		} else {
			echo "Otsib: ".$q;
			$searchword="%".$q."%";
			$stmt=$this->connection->prepare("
			SELECT contactemail, description, price
			FROM sneakers
			WHERE (description LIKE ? OR price LIKE ?)
			ORDER BY $sort $orderBy
		");
		
		$stmt->bind_param("ss", $searchword, $searchword);
		
		}
		
		
	
		
		$stmt->bind_result($contactemail, $description, $price);
		$stmt->execute();
		
		$result=array();
		
		while($stmt->fetch()) {
			
			$sneaker= new stdclass();
			
			$sneaker->contactemail=$contactemail;
			$sneaker->description=$description;
			$sneaker->price=$price;
			
			array_push($result, $sneaker);
		}
		
		$stmt->close();
		
		return $result;
	}
	
	function getallusersneakers() {
		
		$stmt=$this->connection->prepare("
			SELECT contactemail, description, price FROM sneakers WHERE user=?");
		
		$stmt->bind_param("s", $_SESSION["userEmail"]);
		$stmt->bind_result($contactemail, $description, $price);
		$stmt->execute();
		
		$result=array();
		
		while($stmt->fetch()) {
			
			$sneaker= new stdclass();
			
			$sneaker->contactemail=$contactemail;
			$sneaker->description=$description;
			$sneaker->price=$price;
			
			array_push($result, $sneaker);
		}
		
		$stmt->close();
		
		return $result;
	}

	
	
	
	
	
	
	
	// funktsioon kasutaja viimase postituse andmete kättesaamiseks
	// kontrollida - ainult sisselogitud kasutaja andmed, kasutaja sisestatud kirjetest viimane
	
	function getRecentPost() {
		$stmt = $this->connection->prepare("SELECT id, heading, model, price, description FROM sm_posts WHERE userid = ? ORDER BY id DESC LIMIT 1");
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->bind_result($id, $heading, $model, $price, $description);
		$stmt->execute();
		
		$recentPost = new StdClass();
		if($stmt->fetch()) {
			$recentPost->id = $id;
			$recentPost->heading = $heading;
			$recentPost->model = $model;
			$recentPost->price = $price;
			$recentPost->description = $description;
		} else {
			echo "Ei saanud andmeid kätte..";
		}
		$stmt->close();
		return $recentPost;
	}
	
	
	function matchPostAndImage($recentpostid) {
		$stmt = $this->connection->prepare("SELECT id, name FROM sm_uploads WHERE postid = ?");
		$stmt->bind_param("i", $recentpostid);
		$stmt->bind_result($id, $name);
		$stmt->execute();
		
		$imageId = new StdClass();
		if($stmt->fetch()) {
			$imageId->id = $id;
			$imageId->name = $name;
		} else {
			echo "Ei saanud pildinime kätte";
		}
		$stmt->close();
		return $imageId;
	}
	
	


	//****** PILTIDE ÜLESLAADIMINE ******
	
	function uploadImages($name, $postid, $primarypic) {
		$stmt = $this->connection->prepare("INSERT INTO sm_uploads (name, postid, primarypic) VALUES (?, ?, ?)");
		echo $this->connection->error;
		$stmt->bind_param("sii", $name, $postid, $primarypic);
		
		if($stmt->execute()) {
			echo "Salvestamine õnnestus";
		} else {
			echo "ERROR".$stmt->error;
		}
		$stmt->close();
	}

	

	
	/* ****** FUNKTSIOON ESILEHEL KUVATAVATE KUULUTUSTE ANDMETE JAOKS ******
	
	kontrollida:
	1 - kas tulevad kõikide kasutajate kuulutused, kus:
		1.1 - primarypic (ehk pilt, mida kuvatakse kuulutuse esilehel) on 1
		1.2. - deleted on NULL
	2 - mis saab, kui kasutaja kustutab pildi (deleted ei ole NULL)? - mida kuvatakse?
	3 - kas kasutaja saab muuta primarypici?
	
	*/
	
	function getAllPosts() {
		
		$stmt = $this->connection->prepare("SELECT heading, model, price, description, name FROM sm_posts p JOIN (SELECT * FROM sm_uploads WHERE primarypic=1 AND deleted IS NULL) u ON p.id=u.postid");
		$stmt->bind_result($heading, $model, $price, $description, $imgname);
		$stmt->execute();
		
		$result = array();
		
		while($stmt->fetch()) {
			
			$sneakerPost = new StdClass();
			$sneakerPost->heading = $heading;
			$sneakerPost->model = $model;
			$sneakerPost->price = $price;
			$sneakerPost->description = $description;
			$sneakerPost->name = $imgname;
			
			array_push($result, $sneakerPost);
		}
		$stmt->close();
		return $result;
	}














}
?>