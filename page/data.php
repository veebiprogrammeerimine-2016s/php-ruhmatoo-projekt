<?php
	//ühendan sessionniga
	require("../functions.php");
	
	require("../class/Helper.class.php");
	$Helper= new Helper();
	
	require("../class/Top.class.php");
	$Top= new Top($mysqli);
	
	//kui ei ole sisse loginud, suunan login lehele
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	//kas aadressireal on logout
	if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	//kontrollin kas tühi
		if ( isset($_POST["tvshow"]) && 
		isset($_POST["rating"]) && 
		!empty($_POST["tvshow"]) &&
		!empty($_POST["rating"]) 
	) {
		$rating = $Helper->cleanInput($_POST["rating"]);
		$Top->saveTop($Helper->cleanInput($_POST["tvshow"]), $rating);
		header("Location: login.php");
		exit();
	}
	
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
	
	
	$people=$Top->getAllPeople($q, $sort, $order);
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


<h2>TOP 10</h2>
<?php 
	$html="<table class='table table-striped table-condensed'>";
		$html .="<tr>";
			$orderId="ASC";
			$arr="&darr;";
			if(isset($_GET["order"])&&
				$_GET["order"]=="ASC"&&
				$_GET["sort"]=="id"){
				$orderId="DESC";
				$arr="&uarr;";
			}
			$html .= "<th>
						<a href='?q=".$q."&sort=id&order=".$orderId."'>
							ID ".$arr."
						</a>
					 </th>";
			
			
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
						<a href='?q=".$q."&sort=rating&order=".$orderrating."'
							Hinne
						</a>
					</th>";
			$html .="<th>Muuda</th>";
			
	$html .="</tr>";
	//iga liikmekohta masssiiivis
	foreach($people as $p){
		$html .="<tr>";
			$html .="<td>".$p->id."</td>";
			$html .="<td>".$p->tvshow."</td>";
			$html .="<td>".$p->rating."</td>";
			$html .= "<td>
			<a class='btn btn-default btn-xs' href='edit.php?id=".$p->id."'><span class='glyphicon glyphicon-pencil'></span> Muuda</a></td>";
			$html .="</tr>";	
	}
	$html .="</table>";
	echo $html;
?>

<?php require("../datafooter.php");?>