<?php
require("../../../config.php");
	

	session_start(); 
	
	
	$database = "if16_brigitta";
	$mysqli = new mysqli($serverHost, $serverUsername,  $serverPassword, $database);
	
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


}

?>