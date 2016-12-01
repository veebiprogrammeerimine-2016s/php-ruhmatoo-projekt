<?php 
require_once("simple_html_dom.php");
//var_dump(strlen(file_get_contents("movies.json")));
$movies = json_decode(file_get_contents("movies.json"));
//var_dump($movies);
//var_dump(json_last_error());
$b = 0;
echo "<ol>";
foreach($movies as $m){
	
	if($b == 2){ break; }
	
	echo "<li>".$m->title."</li>";
	echo "<a href='https://www.rottentomatoes.com".$m->url."'>link</a>";
	$html = file_get_html("https://www.rottentomatoes.com".$m->url);
	var_dump($html->find('div[class=info]')[0]->find('div[class=col]')[1]->plaintext);
	echo "<br>";
	var_dump($html->find('div[class=info]')[0]->find('div[class=col]')[3]->plaintext);
	echo "<br>";
	var_dump($html->find('div[class=info]')[0]->find('div')[5]->find("a")[0]->plaintext);
	echo "<br>";
	var_dump($html->find('div[class=info]')[0]->find('div[class=col]')[8]->plaintext);
	echo "<br>";
	
	echo $m->url."<br>";
	foreach($m->posters as $p){
		echo $p."<br>";
	}
	$i = 0;
	foreach($m->actors as $a){
		if($i <= count($a)){
			echo $a.", ";
		}else{
			echo $a;
		}
		$i+=1;
	}
	echo "<br>".$m->runtime;
	
	$b++;
}
echo "</ol>";


?>