<?php
	
	//FUNKTSIOONID
	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");
	
	//LOGOUT
	if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: loginpage.php");
		exit();
	}
	
	$comments = profile_comments();
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

<p class="down"> <a href="forumpage.php"> FOORUM </a> / <a href="userpage.php"> MINU KASUTAJA</a> / MINU KOMMENTAARID </p>

<?php 
$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>Postituse NR</th>";
		$html .= "<th>Kommentaarid</th>";
		$html .= "<th></th>";		
	$html .= "</tr>";
	
	foreach ($comments as $p) {
	$html .= "<tr>";
		$html .= "<td>".$p->comment_id."</a></td>";
		$html .= "<td>".$p->feedback."</a></td>";
	$html .= "<td><a href='editmycomments.php?id=".$p->id."'>Muuda</a></td>";
	}
$html .= "</table>";
echo $html
?>

<br><br>
<p class="down"></p>

</div>
	
</body>
</html>