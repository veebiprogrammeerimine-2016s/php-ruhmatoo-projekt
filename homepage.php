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
		$carData = $Car->getAll($q, $sort);
	
	$html = "<table class='table table-striped'>";
		//iga liikme kohta massiivis
	foreach($carData as $c){
		// iga auto on $c
		//echo $c->plate."<br>";
		
		$html .= "<tr>";
			$html .= "<td>".$c->UserId."</td>";
			$html .= "<td>".$c->RegPlate."</td>";
			$html .= "<td>".$c->Mark."</td>";
			$html .= "<td>".$c->Model."</td>";
            $html .= "<td><a class='btn btn-default btn-sm' href='edit.php?id=".$c->id."'><span class='glyphicon glyphicon-pencil'></span>Muuda</a></td>";

		$html .= "</tr>";
	}
	
	$html .= "</table>";
	
	echo $html;
	
	
	$listHtml = "<br><br>";
	
	foreach($carData as $c){
		
		
		$listHtml .= "<p>RegPlate = ".$c->RegPlate."</p>";
		$listHtml .= "<p>Mark = ".$c->Mark."</p>";
		$listHtml .= "<p>Model = ".$c->Model."</p>";
	}
	
	echo $listHtml;
	
?>


<?php require ("header.php");?>
<div class="container">
<?=$msg;?>
<p>
	Tere tulemast <a class="col-md-10" href="userpage.php"><?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logi v�lja</a>
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

	
<?php require ("footer.php");?>
