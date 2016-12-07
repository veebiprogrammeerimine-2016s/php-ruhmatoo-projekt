<?php

    require ("functions.php");
if (isset ($_POST["RegPlate"]) &&
    isset ($_POST["Mark"]) &&
    isset ($_POST["Model"]) &&
    !empty($_POST["RegPlate"]) &&
    !empty($_POST["Mark"]) &&
    !empty($_POST["Model"])
){

    $Car->saveCar ($_POST["RegPlate"], $_POST["Mark"], $_POST["Model"]);
}

$cars=$Car->getUserCars();
?>

<?php require ("header.php");?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="Logo.png" alt="Firma logo" style="...">
        </div>
        <div class="col-md-3">
            <h1>Lisa oma sõiduk</h1>
            <form method="POST">
                <div class="form-group">
                    <input class="form-control" name="RegPlate" placeholder="Registreerimismärk" type="text">
                </div>
                <div class="form-group">
                    <input class="form-control" name="Mark" placeholder="Sõiduki mark" type="text">
                </div>
                <div class="form-group">
                    <input class="form-control" name="Model" placeholder="Sõiduki mudel" type="text">
                </div>
                <input class="btn btn-success btn-sm" type="submit" value="Sisesta">
        </div>
    </div>
</div>
<h2>Sinu Sõidukid</h2>
<?php

$html = "<table>";
$html .= "<tr>";
$html .= "<th>id</th>";
$html .= "<th>Registreerimismärk</th>";
$html .= "<th>Sõiduki mark</th>";
$html .= "<th>Sõiduki mudel</th>";
$html .= "<th>Läbisõit</th>";
$html .= "<th>Tehtud töö</th>";
$html .= "<th>Töö maksumus</th>";
$html .= "<th>Kommentaar</th>";
$html .= "</tr>";


foreach ($cars as $c) {
    $html .= "<tr>";
    $html .= "<td>".$c->id."</td>";
    $html .= "<td>".$c->Tyyp."</td>";
    $html .= "<td>".$c->Mark."</td>";
    $html .= "<td>".$c->Model."</td>";
	$html .= "<td>".$c->Mileage."</td>";
	$html .= "<td>".$c->DoneJob."</td>";
	$html .= "<td>".$c->JobCost."</td>";
	$html .= "<td>".$c->Comment."</td>";
	$html .= "<td><a class='btn btn-default btn-sm' href='edit.php?id=".$c->id."'><span class='glyphicon glyphicon-pencil'></span>Muuda</a></td>";
    $html .= "</tr>";
}
$html .= "</table>";
echo $html;

?>
<?php require ("footer.php");?>
