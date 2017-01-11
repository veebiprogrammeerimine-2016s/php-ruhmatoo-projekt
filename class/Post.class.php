<?php
class Post {
	
	private $connection;
	
	//funktsioon käivitatakse siis kui on 'new User(see jõuab siia)'
	function __construct($mysqli){
		//'this' viitab sellele klassile ja klassi muutujale
		$this->connection=$mysqli;
	}
	
	/* kõik funktsioonid */
	
	
	
	function getLatestPosts($srch,$filter) {

		$allowedFilter = ["asc", "desc"];
		
		
		if(!in_array($filter, $allowedFilter)) {
			$filter = "asc";
		}

		if ($srch != "") {
			echo "otsin: ".$srch;
			
			$stmt = $mysqli->prepare("
			SELECT id, caption, imgurl
			FROM submissions
			where deleted is null
			AND caption like ?
			order by date $filter
			
		");
		
		$searchWord = "%".$srch."%";
		
		$stmt->bind_param("s", $searchWord);

		} else {
			$stmt = $mysqli->prepare("
			SELECT id, caption, imgurl
			FROM submissions
			where deleted is null
			order by date $filter
			
		");
		}
		
		$stmt->bind_result($id, $caption, $imgurl);
		
		if ($srch == "") { 
			
			$stmt = $mysqli->prepare("
				SELECT id,caption,imgurl
				FROM submissions WHERE deleted is NULL
				order by date $filter
			
			");
			
		}
		$stmt->bind_result($id,$caption,$imgurl);
		$stmt->execute();
		
		
		
		
		$results = array();
		
		//tsükeldab nii mitu korda kui mitu rida SQL lausega tuleb
		while ($stmt->fetch()) {
			
			$human = new StdClass();
			$human->id = $id;
			$human->caption = $caption;
			$human->imgurl = $imgurl;
			
			array_push($results, $human);
			
		}
		
		return $results;
		
	}
	
	
	function getTopicPost($topicid) {
		
		$stmt = $this->connection->prepare("SELECT submissions.id, caption, imgurl, username 
		FROM submissions 
		join user_sample on submissions.author=user_sample.id
		where submissions.id = ?");
		$stmt->bind_param("i", $topicid);

		$stmt->execute(); //Execute prepared Query
		$results = array();
		$stmt->bind_result($id, $name, $message, $author);
		
		while($stmt->fetch()){ //fetch values
		
			$data = new StdClass();
			$data->id = $id;
			$data->name = $name;
			$data->message = $message;
			$data->author = $author;
			
			
			//echo $color."<br>";
			array_push($results, $data);
		}
		
		$stmt->close();
		
		return $results;
	}
	
	
	function onlyFive($five) {
		
		$stmt = $this->connection->prepare("SELECT submissions.id, caption, imgurl
		FROM submissions WHERE deleted is NULL
		ORDER BY id DESC LIMIT ?");
		$stmt->bind_param("i", $five);
		
		$stmt->execute(); //Execute prepared Query
		$results = array();
		$stmt->bind_result($id, $name, $message);
		
		while($stmt->fetch()){ //fetch values
		
			$data = new StdClass();
			$data->id = $id;
			$data->name = $name;
			$data->message = $message;
			
			
			//echo $color."<br>";
			array_push($results, $data);
		}
		
		$stmt->close();
		
		return $results;
		
		
	}
	
	function deletePost($id) {
		$stmt = $this->connection->prepare("
		update submissions set deleted=now() where id=?
		");
		$stmt->bind_param("i", $id);
		$stmt->execute(); //Execute prepared Query
		if($stmt->execute()) {
			header("Location:?success");
		} else {
			header("Location:?failed");
		}
		$stmt->close();
	}
	
	
}
?>