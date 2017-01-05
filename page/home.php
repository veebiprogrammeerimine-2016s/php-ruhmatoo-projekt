<?php
include '../functions.php';
require('../header.php');

echo "<div class=container>";
echo "<div class=row>";
$genres = getGenreFromDb();
$i = 0;
echo "<div class=col-md-1></div>";
foreach($genres as $g){
	echo "<div class=col-md-2>";
	$i++;
	echo "<h3>".$g."</h3><br>";
	$poster = searchByGenre($g);
	foreach($poster as $p){
		
		$g = ltrim($g);
		echo "<a href='results.php?s=".rawurlencode($g)."'><img src=".$p->poster." height='212' width='160'></a><br>";

	}
	echo "</div>";
	if ($i >= 5){
		echo "</div>";
		echo "<div class=row>";
		echo "<div class=col-md-1></div>";
		$i = 0;
	}
}
echo "</div>";
	
require('../footer.php');
 
?>