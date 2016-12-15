
<?php
require("../functions.php");




require("../header.php");

$search = searchFromDb($s);
echo "<ol>";
foreach($search as $s){
	echo "<li>".$s->title."</li>";
	echo $s->release_date."<br>";
	echo "<a href=".$s->mlink."><img src=".$s->poster."></a><br>";
}
echo "</ol>";
?>
<div class="row">
	<div class="col-md-9">
	</div>
	<div class="col-md-2">
		<a class="btn btn-info" type="button" href="home.php">Home</a>
	</div>
<?php require("../footer.php");?>