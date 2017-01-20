<?php
require('../functions.php'); 
require('../class/Series.class.php');

$day = "";
$month = "";
$year = "";

if(isset($_GET['d']) &&
	isset($_GET['m']) &&
	isset($_GET['y'])){
	
	$day = $_GET['d'];
	if($day < 10){
		$day = "0".$day;
	}
	$month = $_GET['m'];
	$year = $_GET['y'];
	
}

$tvshows = getSeriesByDay($_SESSION["userId"], $year.'-'.$month.'-'.$day);

if(!empty($tvshows)){
	foreach($tvshows as $t){
		
		echo $t->tv_show."<br>";
		echo "Season ".$t->season."<br>";
		echo "Episode ".$t->episode."<br>";
		
	}
} else {
	
	echo "No shows today.";
}

echo "<br><br>";
echo "<a href='calendar.php'>Go Back</a>";

?>