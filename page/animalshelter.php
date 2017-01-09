<?php
   require("../functions.php");
   
   if (!isset ($_SESSION["userId"])) {
	   
	}
   
   if (isset($_GET["logout"])) {
	   
	   session_destroy();
	   
	   header("Location: login.php");
	   exit();
	   
   }  
   
   	if(isset($_GET["s"])){
		
		$s = $_GET["s"];
		
	}else{
		
		$s = "";
	}
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	//otsisõna fn sisse
	$shelter = $Shelter->get($s, $sort, $order);
	//kleklekle

?>
<html>
<body style='background-color:Silver'>
    <head>
	<?php require("../header.php"); ?>
<h2>Varjupaigad</h2>

<form>

	<input type="search" name="s" value="<?=$s;?>">
	<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Otsi">
	
</form>
<?php 
	
	$html = "<table class='table table-striped'>";
	
	$html .= "<tr>";
	
		$nameOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$nameOrder = "DESC";
			$arrow ="&uarr;";
		}
		
		$html .= "<th>
					<a href='?s=".$s."&sort=name&order=".$nameOrder."'>
						Nimi ".$arrow."
					</a>
				 </th>";
				 
		$countyOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$countyOrder = "DESC";
			$arrow ="&uarr;";
		}
		
		$html .= "<th>
					<a href='?q=".$s."&sort=county&order=".$countyOrder."'>
						Maakond ".$arrow."
					</a>
				 </th>";
				 
		$cityOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$cityOrder = "DESC";
			$arrow ="&uarr;";
		}
		
		$html .= "<th>
					<a href='?s=".$s."&sort=city&order=".$cityOrder."'>
						Linn ".$arrow."
					</a>
				 </th>";
				 

		foreach($shelter as $s){
			$html .= "<tr>";
				$html .= "<td>".$s->name."</td>";
				$html .= "<td>".$s->county."</td>";
				$html .= "<td>".$s->city."</td>";
			$html .= "</tr>";	
		}
		
	$html .= "</table>";
	echo $html;

?>
<br><br>
<?php require("../footer.php"); ?>