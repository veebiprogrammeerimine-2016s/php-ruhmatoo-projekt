<?php
require("../../../config.php");
	

	session_start(); 
	
	
	$database = "if16_brigitta";
	$mysqli = new mysqli($serverHost, $serverUsername,  $serverPassword, $database);
	
<<<<<<< HEAD
function movieExists($link){
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],  $GLOBALS["serverPassword"],  $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT id FROM movies_db WHERE link=?");
	echo $mysqli->error;
	
	$stmt->bind_param("s", $link);	
	$stmt->bind_result($id);	
	$stmt->execute();
	if ( $stmt->fetch() ) {
		$stmt->close();
		return true;	
	} else {	
		$stmt->close();
		return false;
	}
	
}
	
=======
>>>>>>> e56efdd11d22452368b05d339b60f152ded20085
function insertToDb($title, $movie_link, $rating, 
					$genre, $directors, $release_date, 
					$poster, $actors, $runtime, $tomato_score, $synopsis){
	
	echo "<li>".$title."</li>";
	echo $movie_link."<br>"; 
	echo $rating."<br>";
	echo $genre."<br>";
	echo $directors."<br>";
	echo $release_date."<br>";
	echo $poster."<br>"; 
	echo $actors."<br>";
	echo $runtime."<br>";
	echo $tomato_score."<br>"; 
	echo $synopsis."<br>";

	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],  $GLOBALS["serverPassword"],  $GLOBALS["database"]);
	$stmt = $mysqli->prepare("INSERT INTO movies_db (title, link, 
													rating, genre,  
													directors,  release_date, 
													poster, actors, 
													runtime, tomato_score, synopsis) 
							VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	echo $mysqli->error;
	
	$stmt->bind_param("sssssssssis", $title, $movie_link, $rating, 
				$genre, $directors, $release_date, 
				$poster, $actors, $runtime, $tomato_score, $synopsis);
	if ( $stmt->execute() ) {
		echo "salvestamine õnnestus";	
	} else {	
		echo "ERROR ".$stmt->error;
	}
								
}

=======
function getGenreFromDb() {
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
	$stmt = $mysqli->prepare("SELECT DISTINCT genre from movies_db");
	$stmt->bind_result($genre);
	$stmt->execute();
	$result = array();
	
	while($stmt->fetch()) {
	
		$object = new StdClass();
		$object->genre = $genre;
		
		array_push($result, $object);
		
	}
	foreach($result as $item) {
		echo '<p>genre: '.$item->genre.'</p>';
	}
>>>>>>> e56efdd11d22452368b05d339b60f152ded20085
=======
}

>>>>>>> e56efdd11d22452368b05d339b60f152ded20085
<<<<<<< HEAD
function searchFromDb($keyword){
	$keyword = "%".$keyword."%";
	$mysqli = new mysqli($GLOBALS["serverHost"], 
						$GLOBALS["serverUsername"],  
						$GLOBALS["serverPassword"],  
						$GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT title, link, release_date, poster
							FROM movies_db
							WHERE title LIKE ? OR synopsis LIKE ? OR actors LIKE ?
							OR directors LIKE ? OR genre LIKE ?");
	
	echo $mysqli->error;
							
	$stmt->bind_param("sssss", $keyword, $keyword, $keyword, $keyword, $keyword);
	
	$stmt->bind_result($title, $link, $release_date, $poster);
	$stmt->execute();
	$result = array();
	while($stmt->fetch()) {
		$object = new StdClass();
		$object->title = $title;
		$object->mlink = $link;
		$object->release_date = $release_date;
		$object->poster = $poster;
<<<<<<< HEAD
		array_push($result, $object);
		
	}
	
	return $result;
	
}

?>