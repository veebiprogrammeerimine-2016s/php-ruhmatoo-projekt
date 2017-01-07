<?php

	require("functions.php");
	
	$p = getsingleId($_GET["id"]);
	

?>

<?php 
$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>Category</th>";
		$html .= "<th>Pealkiri</th>";
		$html .= "<th>Kommentaar</th>";
		$html .= "<th>Postitud</th>";
		$html .= "<th>Kasutaja</th>";	
	$html .= "</tr>";

	$html .= "<tr>";
		$html .= "<td>".$p->category."</a></td>";
		$html .= "<td>".$p->headline."</td>";
		$html .= "<td>".$p->comment."</td>";
		$html .= "<td>".$p->created."</td>";
		$html .= "<td>".$p->email."</td>";	
	$html .= "</tr>";

$html .= "</table>";
echo $html
?>
