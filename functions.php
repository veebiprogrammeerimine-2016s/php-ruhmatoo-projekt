<?php

require("/home/egenoor/config.php");

session_start();

$database = "if16_ege";
$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);

require("class/Helper.class.php");
$Helper = new Helper();

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

	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
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


?>