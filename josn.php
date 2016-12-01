<?php 
require_once("simple_html_dom.php");
//var_dump(strlen(file_get_contents("movies.json")));
$movies = json_decode(file_get_contents("movies.json"));
//var_dump($movies);
//var_dump(json_last_error());
$b = 0;
echo "<ol>";
foreach($movies as $m){
	
	if($b == 100){ break; }
	
	echo "<li>".$m->title."</li>";
	echo "<a href='https://www.rottentomatoes.com".$m->url."'>link</a><br>";
	$html = file_get_html("https://www.rottentomatoes.com".$m->url);
	echo $html->find('div[class=info]')[0]->find('div[class=col]')[1]->plaintext."<br>";
	echo $html->find('div[class=info]')[0]->find('div[class=col]')[3]->plaintext."<br>";
	$directors = $html->find('div[class=info]')[0]->find('div')[5]->find("a");
	$i=0;
	echo "Directors: ";
	foreach($directors as $d){
		
		if($i < (count($directors)-1) && count($directors) > 1){
			
			echo $d->plaintext.", ";
			
		}else{
			
			echo $d->plaintext;
			
		}
		$i+=1;
	}
	echo "<br>";
	echo $html->find('div[class=info]')[0]->find('div[class=col]')[8]->plaintext."<br>";	
	foreach($m->posters as $p){
		echo $p."<br>";
	}
	$i = 0;
	echo "Actors: ";
	foreach($m->actors as $a){
		
		if($i < (count($m->actors)-1) && count($m->actors) > 1){
			
			echo $a.", ";
			
		}else{
			
			echo $a;
			
		}
		$i+=1;
	}
	echo "<br>".$m->runtime."<br>";
	echo "Tomato Score: ".$m->tomatoScore."<br>";
	echo "Synopsis: ".$m->synopsis;
	$b++;
}
echo "</ol>";


?>