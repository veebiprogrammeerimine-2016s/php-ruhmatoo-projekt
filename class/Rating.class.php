<?php
class Rating {
	
	private $connection;
	
	//funktsioon käivitatakse siis kui on 'new User(see jõuab siia)'
	function __construct($mysqli){
		//'this' viitab sellele klassile ja klassi muutujale
		$this->connection=$mysqli;
	}

	function pictureRating($id){
		
		$stmt = $this->connection->prepare("
		UPDATE submissions
		SET rating=rating+1
		WHERE id = ?");
		echo $this->connection->error;
		$stmt->bind_param("i", $id);
		
		$stmt->execute();
		//Execute prepared Query
		
		$stmt->close();
	}
	
	
	
	function ratedPictures($userid){
		
		$stmt = $this->connection->prepare("
		SELECT ratings.pic_id, caption, imgurl FROM ratings 
		JOIN user_sample ON ratings.user_id = user_sample.id
		JOIN submissions ON ratings.pic_id = submissions.id
		WHERE user_sample.username = ? AND ratings.pic_id=submissions.id
		limit 10");
		echo $this->connection->error;
		$stmt->bind_param("s", $userid);
		$stmt->execute();
		//Execute prepared Query
		
		$rated_pictures = array();
		
		$stmt->bind_result($pic_id, $caption, $imgurl);
		
		while($stmt->fetch()){ //fetch values
		
			$Pdata = new StdClass();
			$Pdata->pic_id = $pic_id;
			$Pdata->caption = $caption;	
			$Pdata->imgurl = $imgurl;			
			
			array_push($rated_pictures, $Pdata);
		}

		
		
		$stmt->close();
		
		return $rated_pictures;
	}
	
}
?>