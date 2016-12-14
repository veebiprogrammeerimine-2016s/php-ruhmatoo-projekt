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



if(isset($_GET["q"])){

		$q = $_GET["q"];

	} else {
		//otsisõna tühi
		$q = "";
	}

	$sort = "id";

	if(isset($_GET["sort"])) {
		$sort = $_GET["sort"];
	}

	$cars=$Car->getUserCars();
		//otsisõna funktsiooni sisse
	$carData = $Car->getAll($q, $sort);
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
			</form>
        </div>
    </div>
</div>

<h2>Autod</h2>

<form method="GET">

	<input type="search" name="q" value="<?=$q;?>">
	<input type="submit" value="Otsi">
</form>
<h2>Sinu Sõidukid</h2>
<?php

$html = "<table>";
$html .= "<tr>";
$html .= "<th>id</th>";
$html .= "<th>Registreerimismärk</th>";
$html .= "<th>Sõiduki mark</th>";
$html .= "<th>Sõiduki mudel</th>";
$html .= "</tr>";


foreach ($cars as $c) {
    $html .= "<tr>";
    $html .= "<td>".$c->id."</td>";
    $html .= "<td>".$c->Tyyp."</td>";
    $html .= "<td>".$c->Mark."</td>";
    $html .= "<td>".$c->Model."</td>";
	$html .= "<td><a class='btn btn-default btn-sm' href='car.php?id=".$c->id."'><span class='glyphicon glyphicon-th-list'></span>Vaata ajalugu</a></td>";
	$html .= "<td><a class='btn btn-default btn-sm' href='edit.php?id=".$c->id."'><span class='glyphicon glyphicon-plus'></span>Lisa töid</a></td>";
    $html .= "</tr>";
}
$html .= "</table>";
echo $html;

?>
<?php require ("footer.php");?>
