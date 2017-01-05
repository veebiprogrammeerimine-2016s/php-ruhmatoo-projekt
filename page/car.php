<?php

require("../functions.php");



$cars=$Car->getWorks($_GET["id"]);

if(isset($_GET["delete"])){
	$Car->deleteWork($_GET["id"]);
}
?>
<?php require("../header.php"); ?>
<h2>Tehtud tööd</h2>
<?php

$html = "<table class='table table-hover'>";
$html .= "<tr>";
$html .= "<th>Läbisõit</th>";
$html .= "<th>Tehtud töö</th>";
$html .= "<th>Töö maksumus</th>";
$html .= "<th>Kommentaar</th>";
$html .= "</tr>";


foreach ($cars as $c) {
    $html .= "<tr>";
	$html .= "<td>".$c->Mileage."</td>";
	$html .= "<td>".$c->DoneJob."</td>";
	$html .= "<td>".$c->JobCost."</td>";
	$html .= "<td>".$c->Comment."</td>";
	if($c->userId == $_SESSION["userId"]){
		$html .= "<td><a href='?id=".$_GET["id"]."&delete=".$c->id."'>Kustuta</a></td>";
	}
    $html .= "</tr>";
}
$html .= "</table>";
echo $html;

?>

<?php require ("../footer.php");?>