<?php
require('../header.php');
include '../functions.php';

?>

<?php require('../footer.php'); ?>

<!DOCTYPE html>
<html>
	<head>
	
	</head>
<body>

<?php 


$genres = getGenreFromDb(); 
foreach($genres as $g){
	echo $g."<br>";
	$poster = searchByGenre($g);
	foreach($poster as $p){
		echo "<img src=".$p->poster."><br>";	
	}

	
	
}
?>

</body>

