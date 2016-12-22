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

	$cars=$Car->getAll($q, $sort);

?>


<?php require ("header.php");?>
<div class="container">

<p class="text-right">
	<span class="text-right" style="font-size:30px;"> Tere tulemast </span> <a style="font-size:30px; class="text-right" href="userpage.php"><?=$_SESSION["userEmail"];?></a>
	<br>
	<a class="text-right"  href="?logout=1">Logi välja <span class="glyphicon glyphicon-log-out"> </span></a>
</p>
	<head>
		<style>
			body  {
				background-image: url("Logo.png");
				background-size: 300px 300px;
				background-repeat: no-repeat;
			}
		</style>
	</head>
	<body>
</div>
	
	
<h2>Autod</h2>

<div class="container-fluid">
	<form class="form-inline">
		<div class="row">
			<form>
				<input class="form-control" type="search" name="q" value="<?=$q;?>">
				<button type="submit" class="btn btn-primary">
					<i class="glyphicon glyphicon-search"></i>
				</button>
			</form>
		</div>
	</form>
</div>
<br>

<?php

$html = "<table class='table table-hover'>";
$html .= "<tr>";
$html .= "<th>id</th>";
$html .= "<th>Registreerimismärk</th>";
$html .= "<th>Sõiduki mark</th>";
$html .= "<th>Sõiduki mudel</th>";
$html .= "<th>Ajalugu</th>";
$html .= "</tr>";


foreach ($cars as $c) {
    $html .= "<tr>";
    $html .= "<td>".$c->id."</td>";
    $html .= "<td>".$c->RegPlate."</td>";
    $html .= "<td>".$c->Mark."</td>";
    $html .= "<td>".$c->Model."</td>";
    $html .= "<td><a class='btn btn-default btn-sm' href='car.php?id=".$c->id."'><span class='glyphicon glyphicon-th-list'></span>Vaata ajalugu</a></td>";
    $html .= "</tr>";
}
$html .= "</table>";
echo $html;

?>
	
<?php require ("footer.php");?>
