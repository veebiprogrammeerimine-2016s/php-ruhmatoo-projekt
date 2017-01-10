<?php	
	
	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");
	$posts = profile_posts();
	
?>

<html>

<body>
	<ul>
		<li><a class="active1" href="homepage.php">AVALEHT</a></li>
		<li><a class="active1" href="forumpage.php">FOORUM</a></li>
		<li><a class="active" href="">MINU KASUTAJA</a></li>
		<li><a class="active1" href="?logout=1">LOGI VÄLJA</a></li>
	</ul>

<div style="page">

<p class="down"> MINU POSTITUSED </p>

<?php 
$html1 = "<table>";
	
	$html1 .= "<tr>";
		$html1 .= "<th>Kategooria</th>";
		$html1 .= "<th>Pealkiri</th>";
		$html1 .= "<th>Kommentaar</th>";
		$html1 .= "<th>Pealkiri</th>";		
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

</div>	
</body>
</html>