<?php 
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
	$director_str = "";
	if($b == 10){ break; }
	$html = file_get_html("https://www.rottentomatoes.com".$m->url);
	$rating = $html->find('div[class=info]')[0]->find('div[class=col]')[1]->plaintext;
	$genre = $html->find('div[class=info]')[0]->find('div[class=col]')[3]->plaintext;
	$directors = $html->find('div[class=info]')[0]->find('div')[5]->find("a");
	$release_date = $html->find('div[class=info]')[0]->find('div[class=col]')[8]->plaintext;
	$i=0;
	foreach($directors as $d){
		
		if($i < (count($directors)-1) && count($directors) > 1){
			
			$director_str=$director_str.$d->plaintext.", ";
			
		}else{
			
			$director_str=$director_str.$d->plaintext;
			
		}
		$i+=1;
	}
	
	foreach($m->posters as $p){
		
	}
	$i = 0;
	foreach($m->actors as $a){
		
		if($i < (count($m->actors)-1) && count($m->actors) > 1){
			
			$actor_str = $actor_str.$a.", ";
			
		}else{
			
			$actor_str = $actor_str.$a;
		}
		$i+=1;
	}
	insertToDb($m->title, "https://www.rottentomatoes.com".$m->url, $rating, 
					$genre, $director_str, $release_date, 
					$p, $actor_str, $m->runtime, $m->tomatoScore, $m->synopsis);
	$b++;
}
echo "</ol>";


?>