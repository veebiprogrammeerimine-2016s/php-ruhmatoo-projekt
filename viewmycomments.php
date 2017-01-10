<?php
	
	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");
	$comments = profile_comments();
?>

<html>

<body>
	<ul>
		<li><a class="active1" href="homepage.php">HOME</a></li>
		<li><a class="active1" href="forumpage.php">FORUM</a></li>
		<li><a class="active" href="">MY ACCOUNT</a></li>
		<li><a class="active1" href="?logout=1">LOG OUT</a></li>
	</ul>

<div style="page">

<p class="down"> MY COMMENTS </p>

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


</div>	
</body>
</html>