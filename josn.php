<?php 

set_time_limit(0);

require_once("simple_html_dom.php");
require_once("functions.php");
//var_dump(strlen(file_get_contents("movies.json")));
$movies = json_decode(file_get_contents("movies.json"));
//var_dump($movies);
//var_dump(json_last_error());
$b = 0;
echo "<ol>";
foreach($movies as $m){
	$actor_str = "";
	$runtime = "";
	$tomato = "";
	$synopsis = "";
	$p = "";
	$rating = "";
	$genre = "";
	$directors = "";
	$release_date = "";
	echo $b." ";
	
	if($b == 425){ break;}
	echo $m->title." TITLE ===============================================<br>";
	
	if (movieExists("https://www.rottentomatoes.com".$m->url)){
		echo "OLEMAS ===============================================<br>";
		$b++;
		continue;
	}else {
		var_dump($m->title);
		if($m->url == "/m/null"){
			echo "URL PUUDU ===============================================<br>";
			$m->url = "/m/".$m->id;
			//$b++;
			//continue;
		}
		echo "UUS ===============================================<br>";
	}
	
	
	
	
	$html = file_get_html("https://www.rottentomatoes.com".$m->url);
	if ($html->find('ul[class=info]')[0]->find('div[class=meta-value]')[0]){
		$rating = $html->find('ul[class=info]')[0]->find('div[class=meta-value]')[0]->plaintext;
	} 
	
	if ($html->find('ul[class=info]')[0]->find('div[class=meta-value]')[1]){
		$genre = $html->find('ul[class=info]')[0]->find('div[class=meta-value]')[1]->plaintext;
	} 
	
	$directors = $html->find('ul[class=info]')[0]->find('div[class=meta-value]')[2]->plaintext;
	if ($html->find('ul[class=info]')[0]->find('div[class=meta-value]')[2]){
		$directors = $html->find('ul[class=info]')[0]->find('div[class=meta-value]')[2]->plaintext;
	}
	
	if ($html->find('ul[class=info]')[0]->find('div[class=meta-value]')[4]){
		$release_date = $html->find('ul[class=info]')[0]->find('div[class=meta-value]')[4]->children()[0]->plaintext;
	} 
	
	if($m->posters){
		foreach($m->posters as $p){
			
		}
	}
	
	$i = 0;
	
	if($m->actors){
		foreach($m->actors as $a){
			
			if($i < (count($m->actors)-1) && count($m->actors) > 1){
				
				$actor_str = $actor_str.$a.", ";
				
			} else {
				
				$actor_str = $actor_str.$a;
			}
			$i+=1;
		}
	}
	
	if($m->runtime){
		$runtime = $m->runtime;
	}
	
	if($m->tomatoScore){
		$tomato = $m->tomatoScore;
	}
	
	if($m->synopsis){
		$synopsis = $m->synopsis;
	}
	
	
	
	insertToDb($m->title, "https://www.rottentomatoes.com".$m->url, $rating, 
					$genre, $directors, $release_date, 
					$p, $actor_str, $runtime, $tomato, $synopsis);
	$b++;
}
echo "</ol>";


?>