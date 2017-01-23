<?php	
	
	//FUNKTSIOONID
	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");
	
	//LOG OUT
	if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: loginpage.php");
		exit();
	}
	
	$posts = profile_posts();
	
?>

<html>

<body>
	<ul>
		<li><a class="active1" href="homepage.php">AVALEHT</a></li>
		<li><a class="active1" href="forumpage.php">FOORUM</a></li>
		<li><a class="active" href="userpage.php">MINU KASUTAJA</a></li>
		<li><a class="active1" href="?logout=1">LOGI VÄLJA</a></li>
	</ul>

<div style="page">

<p class="down"> <a href="forumpage.php"> FOORUM </a> / <a href="userpage.php"> MINU KASUTAJA</a> / MINU POSTITUSED </p>

<?php 
$html1 = "<table>";
	
	$html1 .= "<tr>";
		$html1 .= "<th>Kategooria</th>";
		$html1 .= "<th>Pealkiri</th>";
		$html1 .= "<th>Kommentaar</th>";
		$html1 .= "<th>Pealkiri</th>";
		$html1 .= "<th></th>";		
	$html1 .= "</tr>";
	
	foreach ($posts as $p) {
	$html1 .= "<tr>";
		$html1 .= "<td>".$p->category."</a></td>";
		$html1 .= "<td>".$p->pealkiri."</td>";
		$html1 .= "<td>".$p->comment."</td>";
		$html1 .= "<td>".$p->created."</td>";
		$html1 .= "<td><a href='editmyposts.php?id=".$p->id."'>Muuda</a></td>";
	$html1 .= "</tr>";
	}
$html1 .= "</table>";
echo $html1
?>

<br><br>
<p class="down"><p>

</div>	

</body>
</html>