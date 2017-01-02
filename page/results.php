<?php
require("../functions.php");
require("../header.php");

$i = 0;
$b = 0;
$page = 1;

if(isset($_GET["page"])){
	$page = $_GET["page"];
}

if(isset($_GET["l"])){
	
	$b = $_GET["l"];
	
}
echo "<div class=container>";
echo "<div class=row>";
$search = searchFromDb($s, $page);
foreach($search as $sr){
	$i++;
	$b++;
	echo "<div class=col-md-2>";
	echo $sr->title."<br>";
	echo $sr->release_date."<br>";
	echo "<a href=".$sr->mlink."><img src=".$sr->poster."></a><br>";
	echo "</div>";
	//if ($b % 5 == 0) {break;}
	if ($i % 5 == 0){
		echo "</div>";
		echo "<div class=row>";
		$i = 0;
	}
	
}
echo "</div>";
var_dump($s);
var_dump(rawurlencode($s));
?>
<div class="row">
	<div class="col-md-2">
		<a class="btn btn-info" type="button" href="results.php?s=<?php echo rawurlencode($s)."&page=".($page-1); ?>">Previous</a>
	</div>
	<div class="col-md-8">
	</div>
	<div class="col-md-2">
		<a class="btn btn-info" type="button" href="results.php?s=<?php echo rawurlencode($s)."&page=".($page+1); ?>">Next</a>
	</div>
</div>
<div class="row">
	<div class="col-md-10">
	</div>
	<div class="col-md-2">
		<a class="btn btn-info" type="button" href="home.php">Home</a>
	</div>
</div>
</div>
<?php require("../footer.php");?>