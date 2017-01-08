<html>
<body style='background-color:Silver'>
    <head>
	<?php require("../header.php"); ?>
<h1>Broneeri</h1>

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
				 
// katse kas github t88tab
		foreach($animal as $c){
			$html .= "<tr>";
				$html .= "<td>".$c->id."</td>";
				$html .= "<td>".$c->type."</td>";
				$html .= "<td>".$c->name."</td>";
				$html .= "<td>".$c->age."</td>";
				$html .= "<td><a class='btn btn-default btn-sm' href='edit.php?id=".$c->id."'><span class='glyphicon glyphicon-pencil'></span>Muuda</a></td>";
				$html .= "<td><a class='btn btn-default btn-sm' href='booking.php?id=".$c->id."'><span class='glyphicon glyphicon'></span>Broneeri</a></td>";
			$html .= "</tr>";	
		}
		
	$html .= "</table>";
	echo $html;

?>
<br><br>
<?php require("../footer.php"); ?>