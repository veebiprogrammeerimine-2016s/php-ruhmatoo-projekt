<?php
	
	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");
	$comments = profile_comments();
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

<p class="down"> MINU KOMMENTAARID </p>

<?php 
$html2 = "<table>";
	
	$html2 .= "<tr>";
		$html2 .= "<th>Postitused</th>";		
	$html2 .= "</tr>";
	
	foreach ($comments as $p) {
	$html2 .= "<tr>";
		$html2 .= "<td>".$p->feedback."</a></td>";
	$html2 .= "</tr>";
	}
$html2 .= "</table>";
echo $html2
?>


</div>	
</body>
</html>