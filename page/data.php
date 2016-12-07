<?php
	//ühendan sessionniga
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper= new Helper();

	require("../class/Top.class.php");
	$Top= new Top($mysqli);
	
	require("../class/Eetris.class.php");
	$Eetris= new Eetris($mysqli);
	
	require("../class/Viimati.class.php");
	$Viimati= new Viimati($mysqli);

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
		$Top->saveTop($Helper->cleanInput($_POST["tvshow"]), $rating);
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
	$people=$Top->getAll($q, $sort, $order);
	
	//echo"<pre>";
	//var_dump($people[1]);
	//echo"</pre>";

?>


<?php require("../dataheader.php");?>
<h1>Data</h1>

<?php //echo$_SESSION["userEmail"];?>

<?//=$_SESSION["userEmail"];?>


<p>
	Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?></a>!
	<a href="?logout=1">logi välja</a>
</p>

<div class="container">
	<div class="row">
		<div class="col-sm-6">

<h2>TOP 10</h2>

<?php
	$html="<table class='table table-bordered table-condensed'>";
		$html .="<tr>";
			$ordertvshow="ASC";
			$arr="&darr;";
			if(isset($_GET["order"])&&
				$_GET["order"]=="ASC"&&
				$_GET["sort"]=="tvshow"){
				$ordertvshow="DESC";
				$arr="&uarr;";
			}
			$html .= "<th>
						<a href='?q=".$q."&sort=tvshow&order=".$ordertvshow."'>
							Seriaal
						</a>
					 </th>";


			$orderrating="ASC";
			$arr="&darr;";
			if(isset($_GET["order"])&&
				$_GET["order"]=="ASC"&&
				$_GET["sort"]=="rating"){
				$orderrating="DESC";
				$arr="&uarr;";
			}
			$html .="<th>
						<a href='?q=".$q."&sort=rating&order=".$orderrating."'>
							Hinne
						</a>
					</th>";
		
	$html .="</tr>";
	//iga liikmekohta masssiiivis
	foreach($people as $p){
		$html .="<tr>";
			$html .="<td>".$p->tvshow."</td>";
			$html .="<td>".$p->rating."</td>";
			$html .="</tr>";
	}
	$html .="</table>";
	echo $html;
?>


<h2>Viimati hinnatud</h2>
<?php

$html="<table class='table table-bordered table-condensed'>";
		$html .="<tr>";
			$orderUsername="ASC";
			$arr="&darr;";
			if(isset($_GET["order"])&&
				$_GET["order"]=="ASC"&&
				$_GET["sort"]=="username"){
				$orderUsername="DESC";
				$arr="&uarr;";
			}
			$html .= "<th>
						<a href='?q=".$q."&sort=username&order=".$orderUsername."'>
							Kasutajanimi
						</a>
					 </th>";

			$orderorderComment="ASC";
			$arr="&darr;";
			if(isset($_GET["order"])&&
				$_GET["order"]=="ASC"&&
				$_GET["sort"]=="comment"){
				$orderorderComment="DESC";
				$arr="&uarr;";
			}
			$html .="<th>
						<a href='?q=".$q."&sort=comment&order=".$orderorderComment."'>
							Kommentaar
						</a>
					</th>";

			$orderRating="ASC";
			$arr="&darr;";
			if(isset($_GET["order"])&&
				$_GET["order"]=="ASC"&&
				$_GET["sort"]=="rating"){
				$orderRating="DESC";
				$arr="&uarr;";
			}
			$html .= "<th>
						<a href='?q=".$q."&sort=rating&order=".$orderRating."'>
							Hinne
						</a>
					 </th>";
	$html .="</tr>";
	//iga liikmekohta masssiiivis
	foreach($people as $p){
		$html .="<tr>";
			$html .="<td>".$p->id."</td>";
			$html .="<td>".$p->username."</td>";
			$html .="<td>".$p->comment."</td>";
			$html .="<td>".$p->rating."</td>";
			$html .="</tr>";
	}
	$html .="</table>";
	echo $html;






?>
		</div>
	
		<div class="col-sm-6">
<h2>Täna eetris</h2>
<?php

$html="<table class='table table-bordered table-condensed'>";
		$html .="<tr>";
			$ordertvshow_name="ASC";
			$arr="&darr;";
			if(isset($_GET["order"])&&
				$_GET["order"]=="ASC"&&
				$_GET["sort"]=="tvshow_name"){
				$ordertvshow_name="DESC";
				$arr="&uarr;";
			}
			$html .= "<th>
						<a href='?q=".$q."&sort=tvshow_name&order=".$ordertvshow_name."'>
							Seriaali nimi
						</a>
					 </th>";

			$ordertime="ASC";
			$arr="&darr;";
			if(isset($_GET["order"])&&
				$_GET["order"]=="ASC"&&
				$_GET["sort"]=="time"){
				$ordertime="DESC";
				$arr="&uarr;";
			}
			$html .="<th>
						<a href='?q=".$q."&sort=time&order=".$ordertime."'>
							Kellaaeg
						</a>
					</th>";

			$orderChannel="ASC";
			$arr="&darr;";
			if(isset($_GET["order"])&&
				$_GET["order"]=="ASC"&&
				$_GET["sort"]=="channel"){
				$orderChannel="DESC";
				$arr="&uarr;";
			}
			$html .= "<th>
						<a href='?q=".$q."&sort=channel&order=".$orderChannel."'>
							Kanal
						</a>
					 </th>";
	$html .="</tr>";
	//iga liikmekohta masssiiivis
	foreach($people as $p){
		$html .="<tr>";
			$html .="<td>".$p->id."</td>";
			$html .="<td>".$p->tvshow_name."</td>";
			$html .="<td>".$p->time."</td>";
			$html .="<td>".$p->channel."</td>";
			$html .="</tr>";
	}
	$html .="</table>";
	echo $html;






?>
		</div>
	</div>
</div>
<?php require("../datafooter.php");?>