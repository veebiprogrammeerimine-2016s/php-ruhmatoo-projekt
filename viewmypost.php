<?php	
	
	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");
	$posts = profile_posts();
	
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

<p class="down"> MY POSTS </p>

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

</div>	
</body>
</html>