<?php
require("../../../config.php");
	

	session_start(); 
	
	
	$database = "if16_brigitta";
	$mysqli = new mysqli($serverHost, $serverUsername,  $serverPassword, $database);
	
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
		
	$stmt = $mysqli->prepare("SELECT DISTINCT genre FROM movies_db ORDER BY genre");
	$stmt->bind_result($genre);
	$stmt->execute();
	$result = array();
	
	while($stmt->fetch()) {
		if(count($result)>= 26){
			break;
		}
		$x = "";
		$object = new StdClass();
		$x = explode(",", $genre);
		foreach($x as $i){
			$object->genre = $i;
			if(!in_array($object->genre, $result)){
				array_push($result, $object->genre);
			}
			
		}
	

	}

	return $result;
}
function searchFromDb($keyword){
	$keyword = str_replace("+", '%', $keyword);
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

		array_push($result, $object);
		
	}
	
	return $result;
	
}

//function getThumbnail(){
	
	//md5();
	
	//while()
//}

function searchByGenre($genre){
		$genre = "%".$genre."%";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT poster, genre
							FROM movies_db
							WHERE genre LIKE ? 
							ORDER BY RAND() 
							LIMIT 1");
		echo $mysqli->error;
		$stmt->bind_param("s", $genre);
		$stmt->bind_result($poster, $movGenre);
		$stmt->execute();
		$result = array();
		if($stmt->fetch()) {
			$object = new StdClass();
			$object->poster = $poster;
			$object->genre = $movGenre;
			array_push($result, $object);
		}
		return $result;
		
}

function cleanInput($input) {
	
	return htmlspecialchars(stripslashes(trim(($input))));
}
function makeFriendly($string){
    $string = strtolower(trim($string));
    $string = str_replace("'", '', $string);
    $string = preg_replace('#[^a-z\-]+#', '+', $string);
    $string = preg_replace('#_{2,}#', '+', $string);
    $string = preg_replace('#_-_#', '+', $string);
    return preg_replace('#(^_+|_+$)#D', '+', $string);
}
?>