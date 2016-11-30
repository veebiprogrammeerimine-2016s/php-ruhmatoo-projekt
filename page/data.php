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
		if ( isset($_POST["age"]) &&
		isset($_POST["color"]) &&
		!empty($_POST["age"]) &&
		!empty($_POST["color"])
	) {
		$color = $Helper->cleanInput($_POST["color"]);
		$Top->saveTop($Helper->cleanInput($_POST["age"]), $color);
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



<h2>Arhiiv</h2>

<form>
	<input type="search" name="q" value="<?=$q;?>">
	<input type="submit" value="Otsi">

</form>

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


			$orderAge="ASC";
			$arr="&darr;";
			if(isset($_GET["order"])&&
				$_GET["order"]=="ASC"&&
				$_GET["sort"]=="age"){
				$orderAge="DESC";
				$arr="&uarr;";
			}
			$html .= "<th>
						<a href='?q=".$q."&sort=age&order=".$orderAge."'>
							Vanus
						</a>
					 </th>";


			$html .="<th>Värv</th>";
			$html .="<th>Muuda</th>";

	$html .="</tr>";
	//iga liikmekohta masssiiivis
	foreach($people as $p){
		$html .="<tr>";
			$html .="<td>".$p->id."</td>";
			$html .="<td>".$p->age."</td>";
			$html .="<td>".$p->color."</td>";
			$html .= "<td>
			<a class='btn btn-default btn-xs' href='edit.php?id=".$p->id."'><span class='glyphicon glyphicon-pencil'></span> Muuda</a></td>";
			$html .="</tr>";
	}
	$html .="</table>";
	echo $html;
?>


<?php require("../datafooter.php");?>
