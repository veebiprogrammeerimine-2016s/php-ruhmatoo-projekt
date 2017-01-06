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
		if(count($result)>= 14){
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
function searchFromDb($keyword, $page){
	$perPage = 15;
	$offset = $page*$perPage - $perPage;
	// 1 lk offset = 0 ja limit = 5
	// 2 lk offset = 5 ja limit = 10
	$keyword = "%".$keyword."%";
	$mysqli = new mysqli($GLOBALS["serverHost"], 
						$GLOBALS["serverUsername"],  
						$GLOBALS["serverPassword"],  
						$GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT id, title, link, release_date, poster
							FROM movies_db
							WHERE title LIKE ? OR synopsis LIKE ? OR actors LIKE ?
							OR directors LIKE ? OR genre LIKE ?
							LIMIT ? OFFSET ?");
	
	echo $mysqli->error;
			
	$stmt->bind_param("sssssii", $keyword, $keyword, $keyword, $keyword, $keyword, $perPage, $offset);
	
	$stmt->bind_result($id, $title, $link, $release_date, $poster);
	$stmt->execute();
	$result = array();
	while($stmt->fetch()) {
		$object = new StdClass();
		$object->title = $title;
		$object->mlink = $link;
		$object->release_date = $release_date;
		$poster = getThumbnail($id, $poster, $link);
		$object->poster = $poster;
		array_push($result, $object);
		
	}
	$mysqli->close();
	return $result;
	
}

function getThumbnail($id, $poster, $link){
	
	$plink = "";
	$broken = md5_file('https://resizing.flixster.com/LmuHQvW5Lsm-RKt31c-R_O47E0M=/130x0/v1.bTsxMjA5MzQ5NDtqOzE3MTQ5OzEyMDA7MjAyNjszMDAw');
	$thumbnail = md5_file($poster);
	if($thumbnail == $broken){
		require_once("simple_html_dom.php");
		$html = file_get_html($link);
		if($html->find('img.posterImage')[0]){
			$plink = $html->find('img.posterImage')[0]->src;
			$mysqli = new mysqli($GLOBALS["serverHost"], 
					$GLOBALS["serverUsername"],  
					$GLOBALS["serverPassword"],  
					$GLOBALS["database"]);
			$stmt = $mysqli->prepare("UPDATE movies_db SET poster=? WHERE id=?");
			echo $mysqli->error;
			$stmt->bind_param('si', $plink, $id);
			$stmt->execute();
			$mysqli->close();
		}
		
	} else {
		$plink = $poster;
	}
	return $plink;
}

function searchByGenre($genre){
	
	$genre = "%".$genre."%";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT id, poster, genre, link
						FROM movies_db
						WHERE genre LIKE ? 
						ORDER BY RAND() 
						LIMIT 1");
	echo $mysqli->error;
	$stmt->bind_param("s", $genre);
	$stmt->bind_result($id, $poster, $movGenre, $link);
	$stmt->execute();
	$result = array();
	if($stmt->fetch()) {
		$object = new StdClass();
		$poster = getThumbnail($id, $poster, $link);
		$object->poster = $poster;
		$object->genre = $movGenre;
		array_push($result, $object);
	}
	return $result;
		
}

function cleanInput($input) {
	
	return htmlspecialchars(stripslashes(trim(($input))));
}

if(isset($_POST['story-id'])){
	$storyId = $_POST['story-id'];
}
?>