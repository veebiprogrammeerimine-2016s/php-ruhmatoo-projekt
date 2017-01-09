<?php
   require("../functions.php");
   
   if (!isset ($_SESSION["userId"])) {
	   //session_destroy();
	   
	   //header("Location: login.php");
	   //exit();
	}
   
   if (isset($_GET["logout"])) {
	   
	   session_destroy();
	   
	   header("Location: login.php");
	   exit();
	   
   }
	if (isset($_GET["returned"])) {
	   
	   $Booking->returned($_GET["returned"]);
	   session_destroy();
	   
	   header("Location: animals.php");
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
	
	if(isset($_GET["b"])){
		
		$b = $_GET["b"];
		
	}else{
		
		$b = "";
	}
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	 	if(isset($_GET["b"])){
		
		$q = $_GET["b"];
		
	}else{
		
		$b = "";
	}
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	//otsisõna fn sisse
	$animal = $Animal->get($q, $sort, $order);
	$booked = $Booking->getBooked($b, $sort, $order);
	//kleklekle

?>
<html>
<body style='background-color:Silver'>
    <head>
	<?php require("../header.php"); ?>
<h3>Rentimiseks valmis loomad</h3>

<form>

	<input type="search" name="q" value="<?=$q;?>">
	<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Otsi">
	
</form>
<?php 
	
	$html = "<table class='table table-striped'>";
	
	$html .= "<tr>";
	
		
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
		
		$shelterOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$shelterOrder = "DESC";
			$arrow ="&uarr;";
			
		}	
	
		$html .= "<th>
					<a href='?q=".$q."&sort=shelter&order=".$shelterOrder."'>
						Varjupaik ".$arrow."
					</a>
				 </th>";
				 
// katse kas github t88tab
		foreach($animal as $c){
			$html .= "<tr>";
				$html .= "<td>".$c->type."</td>";
				$html .= "<td><a href='animaldata.php?id=".$c->id."'>".$c->name."</a></td>";
				$html .= "<td>".$c->age."</td>";
				$html .= "<td>".$c->shelter."</td>";
				$html .= "<td><a class='btn btn-default btn-sm' href='edit.php?id=".$c->id."'><span class='glyphicon glyphicon-pencil'></span>Muuda</a></td>";
				$html .= "<td><a class='btn btn-default btn-sm' href='booking.php?id=".$c->id."'><span class='glyphicon glyphicon'></span>Broneeri</a></td>";
			$html .= "</tr>";	
		}
		
	$html .= "</table>";
	echo $html;
?>
<html>	
	<h3>Välja renditud loomad</h3>
</html>
<?php
	$html = "<table class='table table-striped'>";
	
	$html .= "<tr>";
	
		$typeOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$typeOrder = "DESC";
			$arrow ="&uarr;";
		}
		
		$html .= "<th>
					<a href='?b=".$b."&sort=type&order=".$typeOrder."'>
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
					<a href='?b=".$b."&sort=name&order=".$nameOrder."'>
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
					<a href='?b=".$b."&sort=age&order=".$ageOrder."'>
						Vanus ".$arrow."
					</a>
				 </th>";
				 
		$shelterOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$shelterOrder = "DESC";
			$arrow ="&uarr;";
			
		}	
	
		$html .= "<th>
					<a href='?b=".$b."&sort=shelter&order=".$shelterOrder."'>
						Varjupaik ".$arrow."
					</a>
				 </th>";
				 
// katse kas github t88tab
		foreach($booked as $b){
			$html .= "<tr>";
				$html .= "<td>".$b->type."</td>";
				$html .= "<td><a href='bookedanimaldata.php?id=".$b->id."'>".$b->name."</a></td>";
				$html .= "<td>".$b->age."</td>";
				$html .= "<td>".$b->shelter."</td>";
				$html .= "<td><a class='btn btn-default btn-sm' href='animals.php?returned=".$b->id."'><span class='glyphicon glyphicon'></span>Tagastatud</a></td>";
			$html .= "</tr>";	
		}
		
	$html .= "</table>";
	echo $html;
?>
<br><br>
<?php require("../footer.php"); ?>