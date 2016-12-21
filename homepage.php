<?php 
	require("functions.php");
	
	
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: firstpage.php");
		exit();
	}
	
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui �he n�itame siis kustuta �ra, et p�rast refreshi ei n�itaks
		unset($_SESSION["message"]);
	}
	
	$error ="";
	if ( isset($_POST["loginEmail"]) && 
		isset($_POST["loginPassword"]) && 
		!empty($_POST["loginEmail"]) && 
		!empty($_POST["loginPassword"])
	  ) {
		  
		$error = $User->login(cleanInput($_POST["loginEmail"]), cleanInput($_POST["loginPassword"]));
		
	}
	
		if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: firstpage.php");
		exit();
	}
	
	//kas otsib
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

		//otsisõna funktsiooni sisse
		$carData = $Car->getUserCars();

?>


<?php require ("header.php");?>
<div class="container">
<?=$msg;?>
<p>
	Tere tulemast <a class="col-md-10" href="userpage.php"><?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logi välja</a>
</p>
		<div class="row">
			<div class="col-md-10">
				<img src="Logo.png" alt="Firma logo" style="width:250px;height:200px;">
			</div>

		</div>
	</div>
	
	
<h2>Autod</h2>

<form>

	<input type="search" name="q" value="<?=$q;?>">
	<input type="submit" value="Otsi">
</form>

<?php

$html = "<table class='table table-hover'>";
$html .= "<tr>";
$html .= "<th>id</th>";
$html .= "<th>Registreerimismärk</th>";
$html .= "<th>Sõiduki mark</th>";
$html .= "<th>Sõiduki mudel</th>";
$html .= "<th>Ajalugu</th>";
$html .= "<th>Muuda</th>";
$html .= "</tr>";


foreach ($carData as $c) {
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
