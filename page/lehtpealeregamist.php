<?php
//MUUTUJAD JMS VEEL �RA MUUTA LALA

require("../functions.php");

//Sisestatavad muutujad
//$nameoftheseries="";
//$genreoftheseries="";

//kui ei ole kasutaja id'd
if (!isset($_SESSION["userId"])){
	//suunan sisselogimise lehele
	header("Location: login.php");
	exit();	
}

//kui on ?logout aadressireal siis login v�lja
if (isset($_GET["logout"])) {	
	session_destroy();
	//header("Location: login.php");
	exit();	
}

$msg = "";
if(isset($_SESSION["message"])) {
	$msg = $_SESSION["message"];
	unset($_SESSION["message"]);
}
	
if (isset($_POST["nameoftheseries"]) && (isset($_POST["genreoftheseries"]) &&
	!empty($_POST["nameoftheseries"]) && !empty($_POST["genreoftheseries"])
	)) {
	
	saveSeries(cleanInput($_POST["nameoftheseries"]), $_POST["genreoftheseries"]);
	
	//header("Location: data.php");
	exit();
	}

	$seriesData=getAllSeries();
	
if( isset($_POST["nameoftheseries"] )){
	if( empty($_POST["nameoftheseries"])) {
		$seriesnameError = "Insert series name";
	}else{
		$nameoftheseries=$_POST["nameoftheseries"];
	}
}

if( isset($_POST["genreoftheseries"])) {
	if( empty($_POST["genreoftheseries"])) {
		$platfromError = "Insert genre of the series";
	} else { 
		$genreoftheseries = $_POST["genreoftheseries"];
	}		
}

?>

<h1>Data</h1>
<?=$msg;?>
<p>
	Welcome <?=$_SESSION["userName"];?>!</a>
	<a href="?logout=1">Log out</a>
</p>

<h2>Save at least one of you favorite series!</h2>
<form method="POST">
	
	<label>name of the series</label><br>
	<input name="name" type="text">
	<br><br>
	
	<label>genre of the series</label><br>
	<input type="text" name="genre" >
	<br><br>
	
	<input type="submit" value="Save">
	
</form>

<h2>Table of your current series</h2>
<?php 
$html = "<table>";	
	$html .= "<tr>";
		$html .= "<th>id</th>";
		$html .= "<th>nameoftheseries</th>";
		$html .= "<th>genreoftheseries</th>";
	$html .= "</tr>";
		
	foreach($seriesData as $c){	
		$html .= "<tr>";
			$html .= "<td>".$c->id."</td>";
			$html .= "<td>".$c->nameoftheseries."</td>";
			$html .= "<td style='background-color:".$c->genreoftheseries."'>".$c->genreoftheseries."</td>";
		$html .= "</tr>";
	}	
$html .= "</table>";
	

echo $html;
$listHtml = "<br><br>";
	
foreach(seriesData as $c){

	$listHtml .= "<h1 style='color:".$c->genreoftheseries."'>".$c->nameoftheseries."</h1>";
	$listHtml .= "<p>nameoftheseries = ".$c->genreoftheseries."</p>";
}
	
echo $listHtml;