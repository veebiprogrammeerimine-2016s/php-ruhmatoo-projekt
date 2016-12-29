<?php
require("../functions.php");
require("../header.php");

$i = 0;
$b = 0;

if(isset($_GET["l"])){
	
	$b = $_GET["l"];
	
}
echo "<div class=container>";
echo "<div class=row>";
$search = searchFromDb($s);
foreach($search as $s){
	$i++;
	$b++;
	echo "<div class=col-md-2>";
	echo $s->title."<br>";
	echo $s->release_date."<br>";
	echo "<a href=".$s->mlink."><img src=".$s->poster."></a><br>";
	echo "</div>";
	if ($b % 5 == 0) {break;}
	if ($i % 5 == 0){
		echo "</div>";
		echo "<div class=row>";
		$i = 0;
	}
	
}
echo "</div>";

?>
<div class="row">
	<div class="col-md-2">
		<a class="btn btn-info" type="button" href="results.php?s='<?php echo $s."?l=".$b; ?>'">Previous</a>
	</div>
	<div class="col-md-8">
	</div>
	<div class="col-md-2">
		<a class="btn btn-info" type="button" href="results.php?s='<?php echo $s."?l=".$b; ?>'">Next</a>
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