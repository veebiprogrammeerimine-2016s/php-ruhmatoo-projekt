<?php
require('../header.php');
include '../functions.php';

echo "<div class=container>";
echo "<div class=row>";
$genres = getGenreFromDb();
$i = 0;
foreach($genres as $g){
	echo "<div class=col-md-2>";
	$i++;
	echo $g."<br>";
	$poster = searchByGenre($g);
	foreach($poster as $p){
		$movGenre = makeFriendly($g);
		echo "<a href='results.php?s=".$movGenre."'><img src=".$p->poster."></a><br>";

	}
	echo "</div>";
	if ($i >= 5){
		echo "</div>";
		echo "<div class=row>";
		$i = 0;
	}
}
echo "</div>";
	
require('../footer.php');
 
?>