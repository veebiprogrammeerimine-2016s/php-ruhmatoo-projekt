<?php
	
	require("functions.php");
	$comments = profile_comments();
?>
<?php 
$html2 = "<table>";
	
	$html2 .= "<tr>";
		$html2 .= "<th>postitus</th>";		
	$html2 .= "</tr>";
	
	foreach ($comments as $p) {
	$html2 .= "<tr>";
		$html2 .= "<td>".$p->feedback."</a></td>";
	$html2 .= "</tr>";
	}
$html2 .= "</table>";
echo $html2
?>