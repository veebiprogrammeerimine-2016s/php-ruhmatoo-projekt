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
	if($b == 1){ break;}
	$html = file_get_html("https://www.rottentomatoes.com".$m->url);
	$rating = $html->find('ul[class=info]')[0]->find('div[class=meta-value]')[0]->plaintext;
	
	$genre = $html->find('ul[class=info]')[0]->find('div[class=meta-value]')[1]->plaintext;

	$directors = $html->find('ul[class=info]')[0]->find('div[class=meta-value]')[2]->plaintext;

	$release_date = $html->find('ul[class=info]')[0]->find('div[class=meta-value]')[4]->children()[0]->plaintext;

	
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
					$genre, $directors, $release_date, 
					$p, $actor_str, $m->runtime, $m->tomatoScore, $m->synopsis);
	$b++;
}
echo "</ol>";


?>