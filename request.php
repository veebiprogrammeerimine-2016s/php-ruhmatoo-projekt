<?php
	echo "[";
	
	for($i = 1; $i < 6; $i++){
	$string = file_get_contents("https://www.rottentomatoes.com/api/private/v2.0/browse?page=".$i."&limit=100&type=dvd-all&services=amazon%3Bamazon_prime%3Bfandango_now%3Bhbo_go%3Bitunes%3Bnetflix_iw%3Bvudu&sortBy=release");
	echo substr_replace(substr(json_encode(json_decode($string)->results), 1), "", -1);
	echo ",";
	}
	
	
	echo "]";
?>