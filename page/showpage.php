<?php
	//ühendan sessionniga
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper= new Helper();

	/*require("../class/Comments.class.php");
	$Comments= new Comments($mysqli);

	require("../class/Info.class.php");
	$Info= new Info($mysqli);*/

	//kui ei ole sisse loginud, suunan login lehele
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}

	//kas aadressireal on logout
	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: login.php");
		exit();
	}

	//kontrollin kas tühi
	//	if(isset($_POST["age"]) &&
		//isset($_POST["color"]) &&
		//!empty($_POST["age"]) &&
		//!empty($_POST["color"])

		/*if(isset($_POST["tvshow"]) &&
		isset($_POST["rating"]) &&
		!empty($_POST["tvshow"]) &&
		!empty($_POST["rating"])
	) {
		$rating = $Helper->cleanInput($_POST["rating"]);
		$cast->savecast($Helper->cleanInput($_POST["tvshow"]), $rating);
		header("Location: login.php");
		exit();
	}*/

	if(isset($_GET["q"])){
		$q=$_GET["q"];
	}else{
		//ei otsi
		$q="";
	}

	//vaikimisi, kui keegi mingit linki ei vajuta
	$sort = "id";
	$order = "ASC";

	if (isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}

///////////////MILLEKS SEE ON?
	/*$people=$cast->getAll($q, $sort, $order);*/

	//echo"<pre>";
	//var_dump($people[1]);
	//echo"</pre>";

?>


<?php require("../dataheader.php");?>
<h1>Seriaali nimi</h1>

<?php //echo$_SESSION["userEmail"];?>

<?//=$_SESSION["userEmail"];?>


<p>
	Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?></a>!
	<a href="?logout=1">logi välja</a>
</p>

<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<div class="row">

<h2>Seriaali tutvustus</h2>
<?php

$html="<table class='table table-bordered table-condensed'>";
		$html .="<tr>";
			$orderInfo="ASC";
			$arr="&darr;";
			if(isset($_GET["order"])&&
				$_GET["order"]=="ASC"&&
				$_GET["sort"]=="info"){
				$orderInfo="DESC";
				$arr="&uarr;";
			}
			$html .= "<th>
						<a href='?q=".$q."&sort=info&order=".$orderInfo."'>
							Seriaali tutvustus
						</a>
					 </th>";

			$orderCast="ASC";
			$arr="&darr;";
			if(isset($_GET["order"])&&
				$_GET["order"]=="ASC"&&
				$_GET["sort"]=="cast"){
				$orderCast="DESC";
				$arr="&uarr;";
			}
			$html .="<th>
						<a href='?q=".$q."&sort=cast&order=".$orderCast."'>
							Osalised
						</a>
					</th>";
	$html .="</tr>";
	//iga liikmekohta masssiiivis
	foreach($people as $p){
		$html .="<tr>";
			$html .="<td>".$p->id."</td>";
			$html .="<td>".$p->info."</td>";
			$html .="<td>".$p->cast."</td>";
			$html .="</tr>";
	}
	$html .="</table>";
	echo $html;
?>
			</div>
		</div>


		<div class="col-sm-6">
<h2>Kommentaarid</h2>
<?php

$html="<table class='table table-bordered table-condensed'>";
		$html .="<tr>";
			$orderuser="ASC";
			$arr="&darr;";
			if(isset($_GET["order"])&&
				$_GET["order"]=="ASC"&&
				$_GET["sort"]=="user"){
				$orderuser="DESC";
				$arr="&uarr;";
			}
			$html .= "<th>
						<a href='?q=".$q."&sort=user&order=".$orderuser."'>
							Kasutajanimi
						</a>
					 </th>";

			$ordercast="ASC";
			$arr="&darr;";
			if(isset($_GET["order"])&&
				$_GET["order"]=="ASC"&&
				$_GET["sort"]=="comments"){
				$ordercast="DESC";
				$arr="&uarr;";
			}
			$html .="<th>
						<a href='?q=".$q."&sort=comments&order=".$ordercast."'>
							Kommentaarid
						</a>
					</th>";
	$html .="</tr>";
	//iga liikmekohta masssiiivis
	foreach($people as $p){
		$html .="<tr>";
			$html .="<td>".$p->id."</td>";
			$html .="<td>".$p->user."</td>";
			$html .="<td>".$p->comments."</td>";
			$html .="</tr>";
	}
	$html .="</table>";
	echo $html;
?>
		</div>
	</div>
</div>
<?php require("../datafooter.php");?>
