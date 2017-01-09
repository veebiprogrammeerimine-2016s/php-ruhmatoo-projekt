<?php	
	
	require("functions.php");
	$posts = profile_posts();
	
?>

<?php 
$html1 = "<table>";
	
	$html1 .= "<tr>";
		$html1 .= "<th>category</th>";
		$html1 .= "<th>pealkiri</th>";
		$html1 .= "<th>comment</th>";
		$html1 .= "<th>created</th>";		
	$html1 .= "</tr>";
	
	foreach ($posts as $p) {
	$html1 .= "<tr>";
		$html1 .= "<td>".$p->category."</a></td>";
		$html1 .= "<td>".$p->pealkiri."</td>";
		$html1 .= "<td>".$p->comment."</td>";
		$html1 .= "<td>".$p->created."</td>";
	$html1 .= "</tr>";
	}
$html1 .= "</table>";
echo $html1
?>