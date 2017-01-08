<?php
	
	require("functions.php");
	$people = profile();
	$posts = profile_posts();
	$comments = profile_comments();
?>

<?php 
$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>Email</th>";
		$html .= "<th>Nickname</th>";
		$html .= "<th>Gender</th>";	
	$html .= "</tr>";
	
	foreach ($people as $p) {
	$html .= "<tr>";
		$html .= "<td>".$p->email."</a></td>";
		$html .= "<td>".$p->nickname."</td>";
		$html .= "<td>".$p->gender."</td>";
	$html .= "</tr>";
	}
$html .= "</table>";
echo $html
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