<?php
   require("../functions.php");
   
   if (!isset ($_SESSION["userId"])) {
	   
	}
   
   if (isset($_GET["logout"])) {
	   
	   session_destroy();
	   
	   header("Location: login.php");
	   exit();
	   
   }  
   
   	if(isset($_GET["q"])){
		
		$q = $_GET["q"];
		
	}else{
		
		$q = "";
	}
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	//otsisõna fn sisse
	$animal = $Animal->get($q, $sort, $order);
	

?>
<html>
<body style='background-color:Silver'>
    <head>
	<?php require("../header.php"); ?>
	<a href="data.php">Avaleht</a>
	<br>
    <a href="insert_animal.php">Sisesta loom</a>
	<br>
	<a href="?logout=1">Logi valja</a>
<h1>Loomad</h1>

<form>

	<input type="search" name="q" value="<?=$q;?>">
	<input type="submit" value="Otsi">
	
</form>
<?php 
	
	$html = "<table class='table table-striped'>";
	
	$html .= "<tr>";
	
		$idOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$idOrder = "DESC";
			$arrow ="&uarr;";
			
		}	
	
		$html .= "<th>
					<a href='?q=".$q."&sort=id&order=".$idOrder."'>
						Id ".$arrow."
					</a>
				 </th>";
				 
		$typeOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$typeOrder = "DESC";
			$arrow ="&uarr;";
		}
		
		$html .= "<th>
					<a href='?q=".$q."&sort=type&order=".$typeOrder."'>
						Liik ".$arrow."
					</a>
				 </th>";
				 
		$nameOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$nameOrder = "DESC";
			$arrow ="&uarr;";
		}
		
		$html .= "<th>
					<a href='?q=".$q."&sort=name&order=".$nameOrder."'>
						Nimi ".$arrow."
					</a>
				 </th>";
				 
		$ageOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$ageOrder = "DESC";
			$arrow ="&uarr;";
		}
		
		$html .= "<th>
					<a href='?q=".$q."&sort=age&order=".$ageOrder."'>
						Vanus ".$arrow."
					</a>
				 </th>";
				 

		foreach($Animal as $g){
			$html .= "<tr>";
				$html .= "<td>".$g->id."</td>";
				$html .= "<td>".$g->type."</td>";
				$html .= "<td>".$g->name."</td>";
				$html .= "<td>".$g->age."</td>";
				$html .= "<td><a class='btn btn-default btn-sm' href='edit.php?id=".$g->id."'><span class='glyphicon glyphicon-pencil'></span>Muuda</a></td>";
				$html .= "<td><a class='btn btn-default btn-sm' href='booking.php?id=".$g->id."'><span class='glyphicon glyphicon'></span>Broneeri</a></td>";
			$html .= "</tr>";	
		}
		
	$html .= "</table>";
	echo $html;

?>
<br><br>
<?php require("../footer.php"); ?>