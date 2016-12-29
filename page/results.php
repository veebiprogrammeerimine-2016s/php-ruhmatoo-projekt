
<?php
require("../functions.php");
require("../header.php");

$i = 0;
$b = 0;
if(isset($_GET["limit"])){
	
	$b = $_GET["limit"];
	
}
echo "<div class=container>";
echo "<div class=row>";
$search = searchFromDb($s);
foreach($search as $s){
	echo "<div class=col-md-2>";
	$i++;
	$b++;
	echo $s->title."<br>";
	echo $s->release_date."<br>";
	echo "<a href=".$s->mlink."><img src=".$s->poster."></a><br>";
	echo "</div>";
	if ($i >= 5){
		echo "</div>";
		echo "<div class=row>";
		$i = 0;
	}
	if ($b % 5 == 0) {break;}
}
echo "</div></div>";

?>
<div class="row">
	<div class="col-md-2">
		<a class="btn btn-info" type="button" href="results.php?s='<?php echo $s."?limit=".$b-5; ?>'">Previous</a>
	</div>
	<div class="col-md-8">
	</div>
	<div class="col-md-2">
		<a class="btn btn-info" type="button" href="results.php?s='<?php echo $s."?limit=".$b+5; ?>'">Next</a>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-10">
	</div>
	<div class="col-md-2">
		<a class="btn btn-info" type="button" href="home.php">Home</a>
	</div>
</div>
<?php require("../footer.php");?>