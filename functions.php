<?php

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

						
}


?>