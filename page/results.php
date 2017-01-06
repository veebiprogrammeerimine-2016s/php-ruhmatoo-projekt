<?php
require("../functions.php");
require("../header.php");

$i = 0;
$b = 0;
$page = 1;

if(isset($_GET["page"])){
	$page = $_GET["page"];
}

if(isset($_GET["s"])){
	$s = $_GET["s"];
}
if(isset($_GET["l"])){
	
	$b = $_GET["l"];
	
}
echo "<div class=container>";
echo "<div class=row>";
echo "<div class=col-md-1></div>";
$search = searchFromDb($s, $page);
foreach($search as $sr){
	$i++;
	$b++;
	echo "<div class=col-md-2>";
	echo "<h3>".$sr->title."</h3>";
	echo "<h4>".$sr->release_date."</h4>";
	echo "<a href=".$sr->mlink."><img src=".$sr->poster." height='212' width='160'></a><br>";
	echo "</div>";
	
	if ($i % 5 == 0){
		echo "</div>";
		echo "<div class=row>";
		echo "<div class=col-md-1></div>";
		$i = 0;
	}
	
}

if($b == 0){
	echo "<div class=col-md-3></div>";
	echo "<div class=col-md-5><br><br><br>";	
	if ($page > 1){
		echo "<h2>No more results to display.</h2>";
	} else {
		echo "<h2> No results found. <br>Try a different keyword. </h2>";
	}
	echo "</div>";
}
echo "</div>";
//var_dump($s);
//var_dump(rawurlencode($s));
$previous = ($page > 1) ? ($page - 1) : $page;
$next = (($b >= 0) && ($b <= 14)) ? $page : ($page + 1);
?>
<div class="row">
	<div class="col-md-2">
	<br><br>
		<a class="btn btn-success" type="button" href="results.php?s=<?php echo rawurlencode($s)."&page=".$previous; ?>">Previous</a>
	</div>
	<div class="col-md-8">
	</div>
	<div class="col-md-2">
	<br><br>
		<a class="btn btn-success" type="button" href="results.php?s=<?php echo rawurlencode($s)."&page=".$next; ?>">Next</a>

	</div>
</div>
<div class="row">
	<div class="col-md-5">
	</div>
	<div class="col-md-2">
	<br><br>
		<a class="btn btn-info" type="button" href="home.php">Back to Home</a>
	</div>
</div>
</div>
<?php require("../footer.php");?>